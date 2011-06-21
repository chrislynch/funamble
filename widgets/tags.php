<?php
$archiveEntries = mysql_query('
	SELECT tag as t,COUNT(0) as c
	FROM funamble_index_tags
	GROUP BY tag
	ORDER BY COUNT(0) DESC,tag ASC
',$db);

print '<ul>';

while($archiveentry = mysql_fetch_assoc($archiveEntries)){
	print '<li><a href="?tag=' . urlencode($archiveentry['t']) . '">' . $archiveentry['t'] . '</a> (' . $archiveentry['c'] . ' posts)</li>';
}

print '</ul>';

?>