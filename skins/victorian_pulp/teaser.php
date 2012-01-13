<div class="span-16 last">
	<div class="span-5 append-1">
		<h3 class="title"><?php print $entry['name']; ?></h2>
		<p class="credits">
			Written By: Chris Lynch<br>Illustrated By: Jordan Mock
			<br><br><?php print $entry['timestamp']; ?>
		</p>
	</div>
	<div class="span-10 last">
		<p class="excerpt">
			<?php print $entry['teaser']; ?>
		</p>
		<p class="excerpt-links">
			<a href="<?php print $entry['url']; ?>">Read "<?php print $entry['name']; ?>"</a>
		</p>
	</div>
</div>