<?php

$entries = mysql_query("SELECT * FROM funamble_index");

print '<ul>';
while($entry = mysql_fetch_assoc($entries)){
	print '<li>' . $entry['index_id'] . '</li>';
}
print '</ul>';

?>