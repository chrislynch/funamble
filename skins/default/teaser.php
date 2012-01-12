<div class="span-12">
	<h2><a href="<?php print $entry['url']; ?>"><?php print $entry['name']; ?></a></h2>
	<div>
		<h6>Posted on <?php print $entry['timestamp']; ?></h6>
	</div>
	<div>
		<?php 
			print $entry['teaser']; 
		?>
	</div>
	<div>
		<p><a href="<?php print $entry['url']; ?>">Read "<?php print $entry['name']; ?>"</a></p>
	</div>
</div>