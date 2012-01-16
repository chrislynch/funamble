<?php
/*
 * Admin file. All admin functions are run by this file and must be called by it.
 * First thing to do is make sure that we are allowed to be here!
 */

include 'config.php';
include 'bootstrap.php';
include 'funamble.php';

if (!isset($_COOKIE['funamble_admin']) && $root_password !== ''){
	// No log in cookie, so pootle off to the login script.	
	$admin_action = 'admin_login';	
} else {
	// We are logged in, so let's see what actions we are trying to do
	if (isset($_REQUEST['admin_action'])){
		$admin_action = $_REQUEST['admin_action'];
	} else {
		$admin_action = 'admin_home';
	}
}

/*
 * Now that we have decided what we are doing, output the appropriate form inside a nice form.
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Title and SEO information -->
		<title>Funamble</title>
		
		<!-- Blueprint CSS http://www.blueprintcss.org -->
		<link rel="stylesheet" href="lib/blueprint/screen.css" type="text/css" media="screen, projection">
		<!--[if lt IE 8]>
  		<link rel="stylesheet" href="@@site.warpcore@@templates/default/blueprint/ie.css" type="text/css" media="screen, projection">
		<![endif]-->
		
		<!-- TODO: Could include some JQuery libraries by default, for things we like -->
</head>
<body>
<div class="container">
	<div class="span 24 last"><a href="admin.php"><h1>My Funamble</h1></a></div>
	<div class="span 24 last"></div>
		<div class="span-18">
		<?php 
			// include 'lib/phpminiadmin/phpminiadmin.php';
			include 'admin/' . $admin_action . '.php';
		?>
		</div>
		<div class="span-6 last">
		<?php 
			if (file_exists('admin/sidebars/' . $admin_action . '.php')){
				include 'admin/sidebars/' . $admin_action . '.php';
			} else {
				include 'admin/sidebars/admin_home.php';
			}
		?>
		</div>
	</div>
</div>
</body>
</html>