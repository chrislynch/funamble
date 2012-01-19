<?php

$index_fields = array('f_index_id','f_name','f_content','f_teaser','f_media','f_content_type');
$saveXML = array();

if (isset($_POST['f_save'])){
	$saveSQL = '';
	
	foreach($_POST as $key=>$value){
		if (substr($key,0,2) == 'f_' && $key !== 'f_save'){
			if (in_array($key,$index_fields)){
				$key = substr($key,2);
				$saveSQL .= $key . ' = "' . mysql_real_escape_string($value) . '",';	
			} else {
				$key = substr($key,2);
				$saveXML[$key] = $value;	
			}				
		}
	}
	$saveXML = serialize($saveXML);
	$saveSQL .= 'data = "' . mysql_real_escape_string($saveXML) . '" ';
	
	if (isset($_GET['index_id'])){
		// Update
		$saveSQL = 'UPDATE funamble_index SET ' . $saveSQL;
		$saveSQL .= ' WHERE index_id = ' . $_GET['index_id'];
		print $saveSQL;
		mysql_query($saveSQL);
	} else {
		// Insert
		$saveSQL = 'INSERT INTO funamble_index SET ' . $saveSQL;
		print($saveSQL);
		mysql_query($saveSQL);
		$_GET['index_id'] = mysql_insert_id();
	}
}

if (isset($_GET['index_id'])){
	$entries = mysql_query("SELECT * FROM funamble_index WHERE index_id = " . $_GET['index_id']);
	$entry = mysql_fetch_assoc($entries);
	$entry['data'] = unserialize($entry['data']);
	print_r($entry);
} else {
	$entry = array();
}

?>

<h2>Add/Edit Content</h2>
<form action="?admin_action=admin_entry_edit&<?php if (isset($_GET['index_id'])){print '&index_id=' . $_GET['index_id'];} ?>" method="post">
	<h3>Name</h3>
	<input type="text" size="100" name="f_name" value="<?php if (isset($entry['name'])){print $entry['name'];} ?>"><br><br>
	<input type="text" size="100" name="f_author" value="<?php if (isset($entry['data']['author'])){print $entry['data']['author'];} ?>"><br><br>
	<h3>Content</h3>
	<textarea rows="60" cols="10" name="f_content"><?php if (isset($entry['content'])){print $entry['content'];} ?></textarea><br><br>
	<h3>Teaser</h3>
	<textarea rows="30" cols="10" name="f_teaser"><?php if (isset($entry['teaser'])){print $entry['teaser'];} ?></textarea><br><br>
	<h3>Media</h3>
	<input type="text" size="70" name="f_media" value="<?php if (isset($entry['media'])){print $entry['media'];} ?>">
	<select name="f_media_type">
		<option value="" <?php if (isset($entry['media_type']) && $entry['media_type'] = ''){print 'SELECTED';} ?>></option>
		<option value="image" <?php if (isset($entry['media_type']) && $entry['media_type'] = 'image'){print 'SELECTED';} ?>>Image</option>
		<option value="video" <?php if (isset($entry['media_type']) && $entry['media_type'] = 'video'){print 'SELECTED';} ?>>Video</option>
	</select>
	<h3>Save</h3>
	<input type="submit" value="Save" name="f_save">
</form>