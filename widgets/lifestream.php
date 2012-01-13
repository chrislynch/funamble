<?php

$twitterRSS = file_get_contents('http://search.twitter.com/search.atom?from=chrislynch_mwm');
$twitterXML = simplexml_load_string($twitterRSS);

foreach($twitterXML->entry as $entry){
	print '<div>' . $entry->content . '</div><br>';
}

?>