</div> <!-- End Content -->
<?php
if (! isset($_GET['index_id'])){
?>
	<div class="span-5">
		<!-- First sidebar -->
		<h2>Archives</h2>
		<?php include 'widgets/archive.php'; ?>
		<h2>Tags</h2>
		<?php include 'widgets/tags.php'; ?>	
	</div>
<?php 
}
?>

<div class="span-5 prepend-1 last">
	<!-- Second sidebar -->
	<h2>Live Stream</h2>
	<?php include 'widgets/lifestream.php'; ?>
</div>
<div class="span-13 append-11">
	<?php 
		if (isset($_GET['page'])){
			$page = $_GET['page'];
			if ($page > 1){
				print '<a href="?page=' . ($page - 1) . '">Go Back</a>/';
			}
		} else {
			$page = 1;
		}
		print '<a href="?page=' . ($page + 1) . '">More</a>';
	?>
</div>
</div> <!-- End Container -->