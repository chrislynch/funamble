<?php

if (isset($_POST['f_save'])){
	if (isset($_GET['index_id'])){
		// Update
		$saveSQL = 'UPDATE funamble_index SET ';
		foreach($_POST as $key=>$value){
			if (substr($key,0,2) == 'f_' && $key !== 'f_save'){
				$key = substr($key,2);
				$saveSQL .= $key . ' = "' . mysql_real_escape_string($value) . '",';
			}
		}
		$saveSQL = substr($saveSQL,0,strlen($saveSQL)-1);
		$saveSQL .= ' WHERE index_id = ' . $_GET['index_id'];
		mysql_query($saveSQL);
	} else {
		// Insert
		$saveSQL = 'INSERT INTO funamble_index SET ';
		foreach($_POST as $key=>$value){
			if (substr($key,0,2) == 'f_' && $key !== 'f_save'){
				$key = substr($key,2);
				$saveSQL .= $key . ' = "' . mysql_real_escape_string($value) . '",';
			}
		}
		$saveSQL = substr($saveSQL,0,strlen($saveSQL)-1);
		print($saveSQL);
		mysql_query($saveSQL);
		$_GET['index_id'] = mysql_insert_id();
	}
}

if (isset($_GET['index_id'])){
	$entries = mysql_query("SELECT * FROM funamble_index WHERE index_id = " . $_GET['index_id']);
	$entry = mysql_fetch_assoc($entries);
} else {
	$entry = array();
}

?>

<h2>Add/Edit Content</h2>
<form action="?admin_action=admin_entry_edit&<?php if (isset($_GET['index_id'])){print '&index_id=' . $_GET['index_id'];} ?>" method="post">
	<h3>Name</h3>
	<input type="text" size="100" name="f_name" value="<?php if (isset($entry['name'])){print $entry['name'];} ?>"><br><br>
	<h3>Content</h3>
	<textarea rows="60" cols="10" name="f_content"><?php if (isset($entry['content'])){print $entry['content'];} ?></textarea><br><br>
	<h3>Teaser</h3>
	<textarea rows="30" cols="10" name="f_teaser"><?php if (isset($entry['teaser'])){print $entry['teaser'];} ?></textarea><br><br>
	<h3>Media</h3>
	<input type="text" size="70" name="f_media" value="<?php if (isset($entry['media'])){print $entry['media'];} ?>">
	<input type="text" size="30" name="f_content_type" value="<?php if (isset($entry['content_type'])){print $entry['content_type'];} ?>"><br><br>
	<h3>Save</h3>
	<input type="submit" value="Save" name="f_save">
</form>