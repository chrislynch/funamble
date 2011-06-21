<?php
/*
 * fuamble - a contraction of funambulist, which is a tightrope walker, which is a type of acrobat. Acrobats are also known as ... tumblers
 * funamble - an attempt to build a tumblelog in a single PHP file in just two hours 
 */

// Include config file
include 'config.php';

// Include libraries
include 'lib/markdown/markdown.php';

// Set some variables that we need
if (isset($_GET['index_id'])){$index_id = $_GET['index_id'];} else { $index_id = 0;}
if (isset($_GET['search'])){$search = $_GET['search'];} else { $search = '';}

// Start by making a database connection. No database = no funamble.
$db = mysql_connect($db_host,$db_user,$db_password) or die('Could not connect to database. No database = No funamble');
// Now select the fumable db
mysql_selectdb($db_schema) or die('Could not find schema. No schema = No funamble');
// Ideally, we would now check to see if the table(s) are there and, if not, create them. If there's time, we can come back and do this.

// Having connected to the database, we need to display the content
// All content is supplied by the "get Content" function, which independently picks up parameters in the URL
$entries = getContent();

// Now output the page.
include include_template('header.php');
include include_template('content-top.php');
if (sizeof($entries) == 0){
	include include_template('blank.php');
} else {
	foreach($entries as $entry){
		if (sizeof($entries) == 1){
			include include_template('entry.php');
		} else {
			include include_template('teaser.php');
		}
	}
}			
include include_template('content-bottom.php');
include include_template('footer.php');

// Now, clean up the DB connection.
mysql_close($db);

exit;

/*
 * PAGE COMPLETE. WHAT FOLLOWS ARE THE FUNCTIONS REQUIRED TO RUN THE SYSTEM
 */

/*
 * CONTENT FUNCTIONS - THEY BRING BACK THE CONTENT AND DO STUFF TO IT
 */
function getContent(){
	global $db;
	global $articlesperpage;
	
	$entries = array();
	
	$SQL = 'SELECT 	f.*,
					CONCAT("?index_id=",f.index_id) AS url 
			FROM funamble_index f';
	
	if (isset($_GET['index_id']) && $_GET['index_id'] > 0 ){
		$SQL .= ' WHERE index_id = ' . $_GET['index_id'];
	} elseif(isset($_GET['tag'])){
		$SQL .= ' JOIN funamble_index_tags t on f.index_id = t.index_id';
		$SQL .= ' WHERE t.tag = "' . urldecode($_GET['tag']) . '"';
	} elseif(isset($_GET['date'])){
		$date = explode('-',$_GET['date']);
		$SQL .= ' WHERE MONTH(f.timestamp) = ' . $date[1] . '';
		$SQL .= ' AND YEAR(f.timestamp) = ' . $date[0] . '';
	}
	
	if(isset($_GET['page'])){$page = $_GET['page'];} else {$page = 1;};
	$limitStart = ($page -1) * $articlesperpage;
	$SQL .= ' ORDER BY f.index_id DESC LIMIT ' . $limitStart . ',' . $articlesperpage;

	$entriesData = mysql_query($SQL,$db);
	
	while($entry = mysql_fetch_assoc($entriesData)){
		// Apply markdown
		$entry['content'] = utf8_decode(Markdown($entry['content']));
		$entry['teaser'] = utf8_decode(Markdown($entry['teaser']));
		// Add media
		$entry['content_media'] = content_format_media($entry['media'],$entry['content_type'],'content');
		$entry['teaser_media'] = content_format_media($entry['media'],$entry['content_type'],'teaser');		
		
		$entries[$entry['index_id']] = $entry;
	}
	
	return $entries;
}

function content_format_media($media,$type,$template){
	/*
	 * Take a media URL and format it ready for output
	 */
	global $embedWidth;
	global $embedHeight;
	
	switch($type){
		case 'image':
			$return  = '<img src="' . $media . '" width="' . $embedWidth . '"><br/>';
			break;
		case 'video':
			parse_str(parse_url($media,PHP_URL_QUERY),$urlparams);
			$return = '<iframe title="YouTube video player" width="' . $embedWidth . '" height="' . $embedHeight . '" 
						src="http://www.youtube.com/embed/' . $urlparams['v'] . '" frameborder="0" allowfullscreen></iframe>';
			break;
		default:
			$return = '<a href="' . $media . '">' . $media . '</a>';
			break;		
	}
	
	return $return;
}

/*
 * TEMPLATE FUNCTIONS - FOR CONTROLLING TEMPLATES
 */

function include_template($template){
	global $skin;
	if (file_exists('skins/' . $skin . '/' . $template)){
		return 'skins/' . $skin . '/' . $template;
	} else {
		return 'skins/default/' . $template;
	}
}

/*
 * UTILITY FUNCTIONS - FOR THE DOING OF USEFUL THINGS
 */

?>