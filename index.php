<?php
/*
 * fuamble - a contraction of funambulist, which is a tightrope walker, which is a type of acrobat. Acrobats are also known as ... tumblers
 * funamble - an attempt to build a tumblelog in a single PHP file in just two hours 
 */

/*
 * CONFIG - Start here, setting configuration parameters for your site
 */
$db_host = '127.0.0.1'; 		// DB Hostname/IP Address
$db_user = 'root';				// DB Username
$db_password = '';				// DB Password
$db_schema = 'funamble';		// DB Schema
/*
 * END OF CONFIG
 */

/*
 * TEMPLATE - The other configurable component. The template for the page, and for an entry.
 */
$template_page = '<html><head></head><body>%content%</body></html>';
$template_entry = '<h1>%name%</h1>%content%';
$template_tease = '<h1>%name%</h1>%teaser%<br/><a href="?index_id=%index_id%">Read More...</a>';

/*
 * END OF TEMPLATE
 */

/*
 * And now, for the code!
 */

// Start by making a database connection. No database = no funamble.
$db = mysql_connect($db_host,$db_user,$db_password) or die('Could not connect to database. No database = No funamble');
// Now select the fumable db
mysql_selectdb($db_schema) or die('Could not find schema. No schema = No funamble');
// Ideally, we would now check to see if the table(s) are there and, if not, create them. If there's time, we can come back and do this.

// Having connected to the database, we need to display the page.
// There are three "modes" that funamble can appear in. 1: Homepage mode. 2: Search mode. 3: Specific item mode.
// Search mode requires that a search parameter is set. Specific item mode requires that an item ID is set. Homepage mode is the default.
$content = content_homepage();

$page = str_ireplace('%content%', $content, $template_page);

mysql_close($db);

print $page;

/*
 * CONTENT FUNCTIONS - THEY BRING BACK THE CONTENT
 */
function content_homepage(){
	/*
	 * Get the X most recent articles and return their content.
	 */
	$content = '';
	$articles = mysql_query('SELECT index_id FROM funamble_index ORDER BY index_id DESC');
	while($article = mysql_fetch_assoc($articles)){
		$content .= content_specific_item($article['index_id'],TRUE);
	}
	return $content;
}

function content_search($search){
	
}

function content_specific_item($index_id,$tease){
	/* 
	 * Get the content of an article and output it using the template_entry template
	 * We replace any instance of %field_name% with the equivalent field from the retrieved record.
	 */
	global $template_entry;
	global $template_tease;
	if($tease){$content = $template_tease;} else {$content = $template_entry;}
	
	$articles = mysql_query('SELECT * FROM funamble_index WHERE index_id = ' . $index_id);
	while($article = mysql_fetch_assoc($articles)){
		foreach($article as $key=>$value){
			$content = str_ireplace('%' . $key . '%', $value, $content);
		}
	}
	
	return $content;
}


/*
 * UTILITY FUNCTIONS - FOR THE DOING OF USEFUL THINGS
 */

?>