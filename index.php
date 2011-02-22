<?php
/*
 * fuamble - a contraction of funambulist, which is a tightrope walker, which is a type of acrobat. Acrobats are also known as ... tumblers
 * funamble - an attempt to build a tumblelog in a single PHP file in just two hours 
 */

// Include config file
include 'config.php';

// Include libraries
include 'lib/markdown/markdown.php';

// Load templates
$template_page = file_get_contents('skins/' . $skin . '/index.html');
$template_entry = file_get_contents('skins/' . $skin . '/entry.html');
$template_tease = file_get_contents('skins/' . $skin . '/teaser.html');
$template_empty = file_get_contents('skins/' . $skin . '/blank.html');

// Set some variables that we need
if (isset($_GET['index_id'])){$index_id = $_GET['index_id'];} else { $index_id = 0;}
if (isset($_GET['search'])){$search = $_GET['search'];} else { $search = '';}

// Start by making a database connection. No database = no funamble.
$db = mysql_connect($db_host,$db_user,$db_password) or die('Could not connect to database. No database = No funamble');
// Now select the fumable db
mysql_selectdb($db_schema) or die('Could not find schema. No schema = No funamble');
// Ideally, we would now check to see if the table(s) are there and, if not, create them. If there's time, we can come back and do this.

// Having connected to the database, we need to display the page.
// There are three "modes" that funamble can appear in. 1: Homepage mode. 2: Search mode. 3: Specific item mode.
// Search mode requires that a search parameter is set. Specific item mode requires that an item ID is set. Homepage mode is the default.
if ($index_id){
	$content = content_specific_item($index_id,FALSE);
} elseif($search){
	
} else {
	$content = content_homepage();	
	if(isset($_GET['page'])){$page = $_GET['page'];} else {$page = 1;};
	$content .= '<br><a href="?page=' . ($page + 1) . '">More...</a>';
}

// Once we have the content back, embed it in the page
// Then set the page level content variables. These might have been altered earlier, hence we wait until now.
$page = str_ireplace('%content%', $content, $template_page);
foreach($index_content as $key=>$value){
	$page = str_ireplace('%' . $key . '%', $value, $page);
}

// Now, clean up the DB connection.
mysql_close($db);

// Print out the page.
print $page;

exit;

/*
 * PAGE COMPLETE. WHAT FOLLOWS ARE THE FUNCTIONS REQUIRED TO RUN THE SYSTEM
 */

/*
 * CONTENT FUNCTIONS - THEY BRING BACK THE CONTENT
 */
function content_homepage(){
	/*
	 * Get the X most recent articles and return their content.
	 */
	global $articlesperpage;
	global $template_empty;
	
	if(isset($_GET['page'])){$page = $_GET['page'];} else {$page = 1;};
	$limitStart = ($page -1) * $articlesperpage;
		
	$content = '';
	$articles = mysql_query('SELECT index_id FROM funamble_index ORDER BY index_id DESC LIMIT ' . $limitStart . ',' . $articlesperpage);
	if (mysql_num_rows($articles) > 0){
		while($article = mysql_fetch_assoc($articles)){
			$content .= content_specific_item($article['index_id'],TRUE);
		}	
	} else {
	
		$content = $template_empty;
	}
	
	return $content;
}

function content_search($search){
	
}

function content_specific_item($index_id,$tease){
	/* 
	 * Get the content of an article and output it using the template_entry template
	 * We replace any instance of %field_name% with the equivalent field from the retrieved record.
	 * When we are not in "tease" mode, we add in media.
	 */
	global $template_entry;
	global $template_tease;
	
	if($tease){$content = $template_tease;} else {$content = $template_entry;}
	
	$articles = mysql_query('SELECT * FROM funamble_index WHERE index_id = ' . $index_id);
	while($article = mysql_fetch_assoc($articles)){
		if(!($tease)){$article['content'] = content_format_media($article['media'],$article['content_type']) . $article['content'];}
		foreach($article as $key=>$value){
			if ($key == 'content' || $key == 'teaser'){$value = Markdown($value);}
			$value = utf8_decode($value);
			$content = str_ireplace('%' . $key . '%', $value, $content);
		}
	}
	// Now process out the markdown data
	return $content;
}

function content_format_media($media,$type){
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
 * UTILITY FUNCTIONS - FOR THE DOING OF USEFUL THINGS
 */

?>