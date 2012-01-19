<?php
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
?>