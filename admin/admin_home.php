<?php

$entries = mysql_query("SELECT index_id,name,timestamp FROM funamble_index ORDER BY timestamp DESC");

print '<h2>My Content</h2><table><tr><th>ID</td><th>Name</th><th>Timestamp</th></tr>';
while($entry = mysql_fetch_assoc($entries)){
	print "<tr><td>" . $entry['index_id'] . "</td><td>" . $entry['name'] . "</td><td>" . $entry['timestamp'] . "</td>
			<td><a href='?admin_action=admin_entry_edit&index_id=" . $entry['index_id'] . "'>Edit</a></td></tr>";
}
print '</table>';

?>