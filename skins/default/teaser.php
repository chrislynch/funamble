<div class="span-12">
	<h2><a href="<?php print $entry['url']; ?>"><?php print $entry['name']; ?></a></h2>
	<div>
		Posted on <?php print $entry['timestamp']; ?>
	</div>
	<div>
		<?php 
			if ($entry['teaser'] == $entry['content'] || strlen(trim($entry['teaser'])) == 0){
				$entry['teaser'] = substr(strip_tags($entry['content']),0,250) . ' ...';
			}
			print $entry['teaser']; 
		?>
	</div>
	<div>
		<a href="<?php print $entry['url']; ?>">Read "<?php print $entry['name']; ?>"</a>
	</div>
</div>