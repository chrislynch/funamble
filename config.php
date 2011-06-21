<?php
/*
 * CONFIG - Start here, setting configuration parameters for your site
 */
// Database connection parameters
$db_host = '127.0.0.1'; 		// DB Hostname/IP Address
$db_user = 'root';				// DB Username
$db_password = '';				// DB Password
$db_schema = 'funamble';		// DB Schema

// Site parameters
$index_content=array();
$index_content['title'] = 'Funamble';
$index_content['keywords'] = 'Funamble,Tumblr,PHP';
$index_content['description'] = 'Funamble is a Tumble Log and Tumblr Clone';

// Look and feel
$skin = 'planetofthepenguins';			// What template are we using? Expect this to be the skins directory

// Paging control
$articlesperpage = 10;

// Embed options for video
$embedWidth = '600';
$embedHeight = '400';

/*
 * END OF CONFIG
 */
?>