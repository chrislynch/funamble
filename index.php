<?php
/*
 * fuamble - a contraction of funambulist, which is a tightrope walker, which is a type of acrobat. Acrobats are also known as ... tumblers
 * funamble - an attempt to build a tumblelog in a single PHP file in just two hours 
 */

// Include config file
include 'config.php';
include 'bootstrap.php';
include 'funamble.php';

// Include libraries




// Set some variables that we need
if (isset($_GET['index_id'])){$index_id = $_GET['index_id'];} else { $index_id = 0;}
if (isset($_GET['search'])){$search = $_GET['search'];} else { $search = '';}

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
 * PAGE COMPLETE. 
 */

?>