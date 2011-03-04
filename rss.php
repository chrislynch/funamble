<h1>Monkeys with Machineguns<span class="dark"> Latest News</span></h1>

<?php
	require_once 'magpie/rss_fetch.inc';

	$rss = array();
	$rss = array_merge($rss,array_slice(fetch_rss('http://www.planetofthepenguins.com/category/blog/repost-to-mwm/feed')->items,0,10));
	$rss = array_merge($rss,array_slice(fetch_rss('http://stuartt1975.wordpress.com/feed/')->items,0,10));
		
	$sortrss = array();
	$kindex = 0;
	foreach ($rss as $item){
		$sortrss[$kindex] = $item['date_timestamp'];
		$sortedrss[$kindex] = $item;
		$kindex++;
	}
	arsort($sortrss);
	// print_r($sortrss);
	
	foreach ($sortrss as $key=>$pubdate ) {
		$item = $sortedrss[$key];
		$title = $item[title];
		$url   = $item[link];
		$month = date('M',$item['date_timestamp']);
		$day = date('d',$item['date_timestamp']);
		$summary = $item[summary];
		
		echo '<div class="post">';
		echo '<div class="date">';
	    echo '<span class="month">' . $month . '</span>';
	    echo '<span class="day">' . $day . '</span>';
	    echo '</div>';
		echo '<p>';
		echo "<span class='title'><a href=$url>$title</a></span>";
		if ($summary != $title){ echo $summary;} else { echo '&nbsp;<br>';}
		// print_r($item);
		echo '</div>';
	}
?>

<h1>Monkeys with Machineguns<span class="dark"> Latest Blog Posts and Tweets</span></h1>

<?php

	$rss = array();
	$rss = array_merge($rss,array_slice(fetch_rss('http://twitter.com/statuses/user_timeline/15125258.rss')->items,0,3));
	$rss = array_merge($rss,array_slice(fetch_rss('http://twitter.com/statuses/user_timeline/38630527.rss')->items,0,3));
	$rss = array_merge($rss,array_slice(fetch_rss('http://www.planetofthepenguins.com/index.php?feed=rss2&cat=-145')->items,0,5));
	$rss = array_merge($rss,array_slice(fetch_rss('http://backend.deviantart.com/rss.xml?q=by%3Astu-art1975&type=journal&formatted=1')->items,0,5));

		
	$sortrss = array();
	$kindex = 0;
	foreach ($rss as $item){
		$sortrss[$kindex] = $item['date_timestamp'];
		$sortedrss[$kindex] = $item;
		$kindex++;
	}
	arsort($sortrss);
	// print_r($sortrss);
	
	foreach ($sortrss as $key=>$pubdate ) {
		$item = $sortedrss[$key];
		$title = $item[title];
		$url   = $item[link];
		$month = date('M',$item['date_timestamp']);
		$day = date('d',$item['date_timestamp']);
		$summary = $item[summary];
		
		echo '<div class="post">';
		echo '<div class="date">';
	    echo '<span class="month">' . $month . '</span>';
	    echo '<span class="day">' . $day . '</span>';
	    echo '</div>';
		echo '<p>';
		echo "<span class='title'><a href=$url>$title</a></span>";
		if ($summary != $title){ echo $summary;} else { echo '&nbsp;<br>';}
		// print_r($item);
		echo '</div>';
	}


?>