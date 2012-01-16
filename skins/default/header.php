<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<!-- Title and SEO information -->
	<title><?php if(isset($index_content['title'])) {print $index_content['title'];}?></title>
	
	<meta name="keywords" content="<?php if(isset($index_content['keywords'])) {print $index_content['keywords'];}?>" />
	<meta name="description" content="<?php if(isset($index_content['description'])) {print $index_content['description'];}?>" />
	
	<meta name="abstract" content="<e4.data.abstract/>" />
	
	<meta name="copyright" CONTENT="<e4.data.copyright/>" />
	<!-- Google, Yahoo, and Bing tracking -->
	<meta name="google-site-verification" content="" />
	<META name="y_key" content="" />
	<meta name="msvalidate.01" content="" />
	<!-- URL canonicalisation -->
	<link rel="canonical" href="" />
	<!-- ROBOTS directives -->
	<meta name="robots" content="index,follow" />
	
	<!-- Blueprint CSS http://www.blueprintcss.org -->
	<link rel="stylesheet" href="lib/blueprint/screen.css" type="text/css" media="screen, projection">
	<link rel="stylesheet" href="skins/<?php print $skin;?>/index.css">
	<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica:400,400italic' rel='stylesheet' type='text/css'>
	<!--[if lt IE 8]>
		<link rel="stylesheet" href="engine4.net/lib/blueprint/ie.css" type="text/css" media="screen, projection">
	<![endif]-->
   	
   	
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '']);
		_gaq.push(['_trackPageview']);
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
</head>
<body>
