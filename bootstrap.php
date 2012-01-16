<?php
// Start by making a database connection. No database = no funamble.
$db = mysql_connect($db_host,$db_user,$db_password) or die('Could not connect to database. No database = No funamble');
// Now select the fumable db
mysql_selectdb($db_schema) or die('Could not find schema. No schema = No funamble');
// Ideally, we would now check to see if the table(s) are there and, if not, create them. If there's time, we can come back and do this.

include 'lib/markdown/markdown.php';
?>