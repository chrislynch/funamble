<div class="span-16 last">
	<div class="span-5 append-1">
		<h3 class="title"><a href="<?php print $entry['url']; ?>"><?php print $entry['name']; ?></a></h2>
		<p class="credits">
			By: Chris Lynch
			<br><?php print $entry['timestamp']; ?>
		</p>
	</div>
	<div class="span-10 last">
		<p class="excerpt">
			<?php print $entry['teaser']; ?>
		</p>
		<p class="excerpt-links">
			<a href="<?php print $entry['url']; ?>">Read "<?php print $entry['name']; ?>"</a>
			<?php
				if (strlen($entry['tags']) > 0){
					print '<br>More in: ';
					$tags = explode(',',$entry['tags']);
					foreach($tags as $tag){
						print '<a href="#"> ' . $tag . '</a>&nbsp;';
					}	
				}
				
			?>
		</p>
	</div>
</div>