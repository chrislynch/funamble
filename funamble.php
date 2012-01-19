<?php
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
	$SQL .= ' ORDER BY f.timestamp DESC LIMIT ' . $limitStart . ',' . $articlesperpage;
	
	$entriesData = mysql_query($SQL,$db);
	
	while($entry = mysql_fetch_assoc($entriesData)){
		// Apply markdown
		$entry['content'] = utf8_decode(Markdown($entry['content']));
		$entry['teaser'] = utf8_decode(Markdown($entry['teaser']));
		if ($entry['teaser'] == $entry['content'] || strlen(trim($entry['teaser'])) == 0){
			$entry['teaser'] = substr(strip_tags($entry['content']),0,250) . ' ...';
		}
		// Add media
		$entry['content_media'] = content_format_media($entry['media'],$entry['media_type'],'content');
		$entry['teaser_media'] = content_format_media($entry['media'],$entry['media_type'],'teaser');		
		
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
?>