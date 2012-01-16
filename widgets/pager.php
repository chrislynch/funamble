<?php
if (isset($_GET['page'])){
	$page = $_GET['page'];
	if ($page > 1){
		print '<a href="?page=' . ($page - 1) . '">&lt;&lt;&nbsp;Go Back</a>&nbsp;/&nbsp;';
	}
} else {
	$page = 1;
}
print '<a href="?page=' . ($page + 1) . '">More&nbsp;&gt;&gt;</a>';
?>