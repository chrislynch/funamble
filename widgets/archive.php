<?php
$archiveEntries = mysql_query('
	SELECT YEAR(timestamp) as y,MONTH(timestamp) as m,COUNT(0) as c
	FROM funamble_index
	GROUP BY YEAR(timestamp),MONTH(timestamp)
	ORDER BY YEAR(timestamp) DESC, MONTH(timestamp) DESC
',$db);

print '<ul>';

while($archiveentry = mysql_fetch_assoc($archiveEntries)){
	print '<li><a href="?date=' . $archiveentry['y'] . '-' . $archiveentry['m'] . '">' . $archiveentry['y'] . '/' . $archiveentry['m'] . '</a> (' . $archiveentry['c'] . ' posts)</li>';
}

print '</ul>';

?>