<?php

	// -------------------------------------------------------------------- //
	// index.php

	include('php/common.php');

?>
<!DOCTYPE html PUBLIC
	"-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
	<head>
		<meta http-equiv="content-type"			content="text/html; charset=UTF-8"/>
		<meta http-equiv="content-style-type"	content="text/css"/>
		
		<title>jQuery Demo<?php if ($r != 'home'){ if ($r == 'credits' || $r == 'contact'){ echo ' :: '.ucwords($r); } else { if ($r == 'kitchen-sink') { echo ' :: The Kitchen Sink'; } else { echo ' '.ucwords($r.$s); } } } ?> :: dylanjameswagner.com</title>
		
		<meta name="description"	content="<?php meta_description(); ?>"/>
		<meta name="keywords"		content="<?php meta_keywords(); ?>"/>
		<meta name="robots"			content="index, follow, noarchive"/>
	
		<meta name="copyright"		content="COPYRIGHT &copy; <?php echo date('Y'); ?> Dylan James Wagner. All rights reserved."/>
		<meta name="author"			content="Dylan Jamesw Wagner"/>
		<meta name="design"			content="Dylan James Wagner | Creative Design - http://dylanjameswagner.com"/>
		<meta name="developer"		content="Dylan James Wagner | Creative Design - http://dylanjameswagner.com"/>
	
		<meta name="generator"		content="hand coded"/>
		<meta name="modified"		content="<?php echo $modified; ?>"/>

		<link rel="shortcut icon"	type="image/x-icon"	href="img/favicon.ico"/> <!-- <link rel="icon" type="image/png" href="img/favicon.png"/> -->

		<link rel="stylesheet"		type="text/css" 	href="css/common.css"/>
		<link rel="stylesheet"		type="text/css" 	href="css/navigation.css"/>
		<link rel="stylesheet"		type="text/css" 	href="css/colorbox.css"/>
		<link rel="stylesheet"		type="text/css" 	href="css/prettify.css"/>
		<link rel="stylesheet"		type="text/css" 	href="css/jquery-ui_smoothness/jquery-ui-1.8.5.custom.css"/>
		<link rel="stylesheet"		type="text/css" 	href="css/jquery.tablesorter_djw/style.css"/>
		<link rel="stylesheet"		type="text/css" 	href="css/jquery.tablesorter.pager.css"/>
<?php stylesheet(); ?>
		<link rel="stylesheet"		type="text/css"		href="style.css"/>
		<link rel="stylesheet"		type="text/css"		href="print.css"	media="print"/>

		<!--[if IE]> <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->
		<!--[if lte IE 8]> <link rel="stylesheet" type="text/css" href="css/ie8.css"/> <![endif]-->
		<!--[if lte IE 7]> <link rel="stylesheet" type="text/css" href="css/ie7.css"/> <script type="text/javascript" src="js/ie8.js"></script> <![endif]-->
		<!--[if lte IE 6]> <link rel="stylesheet" type="text/css" href="css/ie6.css"/> <![endif]-->

		<style type="text/css">
			
		</style>

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
		<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
		<script type="text/javascript" src="js/jquery.scrollto-1.4.2-min.js"></script>
		<script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>
		<script type="text/javascript" src="js/jquery.colorbox-1.3.14-min.js"></script>
		<script type="text/javascript" src="js/jquery.innerfade-2008.02.14.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter-2.0.5-min.js"></script>
		<script type="text/javascript" src="js/jquery.tablesorter.pager-2.0.5.js"></script>
<?php javascript(); ?>
		<script type="text/javascript" src="js/prettify.js"></script>
		<script type="text/javascript" src="js/analytics.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body id="<?php if ($r != 'home' && $r != 'credits' && $r != 'contact' && $r != 'kitchen-sink') { echo 'demo'.$r.$s; } else { echo $r; } ?>">
		<div id="site">
			<div id="header">
				<h<?php if ($p == 'home') { echo '1'; } else { echo '3'; } ?> id="logo"><a href="/jquery/">dylanjameswagner.com</a> <span>jQuery Demo</span></<?php if ($p == 'home') { echo 'h1'; } else { echo 'h3'; } ?>>
<?php // include('php/nav_global.php'); ?>
				<ul id="nav_demo" class="navigation">
					<li class="demo1<?php activeParent('1'); ?>"><a href="?p=1">demo 1</a></li>
					<li class="demo2<?php activeParent('2'); ?>"><a href="?p=2">demo 2</a></li>
					<li class="demo3<?php activeParent('3'); ?>"><a href="?p=3">demo 3</a></li>
					<li class="demo4<?php activeParent('4'); ?>"><a href="?p=4">demo 4</a></li>
					<li class="demo5<?php activeParent('5'); ?>"><a href="?p=5">demo 5</a></li>
					<li class="demo6<?php activeParent('6'); ?>"><a href="?p=6">demo 6</a></li>
					<li class="demo7<?php activeParent('7'); ?>"><a href="?p=7">demo 7</a></li>
					<li class="demo8<?php activeParent('8'); ?>"><a href="?p=8">demo 8</a></li>
					<li class="demo9<?php activeParent('9'); ?>"><a href="?p=9">demo 9</a></li>
				</ul><!-- #nav_demo -->
				<h2 id="nav_marker" class="navigation <?php if ($r != 'home' && $r != 'credits' && $r != 'contact') { echo 'demo'; } echo $r; // $r.$s; ?>">demo <span><?php echo $r.' '.$s; ?></span></h2>
				<h3 class="labels">Subpage Navigation</h3>
				<ul id="nav_pages" class="navigation">
					<li class="a<?php activeSlug('a'); ?>"><a href="?p=<?php echo $r; ?>a">a</a></li>
					<li class="b<?php activeSlug('b'); ?>"><a href="?p=<?php echo $r; ?>b">b</a></li>
					<li class="c<?php activeSlug('c'); ?>"><a href="?p=<?php echo $r; ?>c">c</a></li>
				</ul><!-- #nav_pages -->
			</div><!-- #header -->
			<div id="content">
				<div id="primary">
					<div class="no-script">
						<h2 class="alert">Notice:</h2>
						<p>Your browser has Javascript disabled. This site is
							intended to be viewed with Javascript enabled. Your user
							experience will be simplified while it remains disabled.</p>
						<p>Instructions to <a href="http://www.google.com/support/websearch/bin/answer.py?hl=en&amp;answer=23852">enable Javascript</a>.</p>
					</div><!-- .no-script -->
<?php
	include('php/'.$p.'.php');
	nav_next();
?>
				</div><!-- #primary -->
				<div id="secondary">
					<?php nav_next(); ?>
					<p id="nav_view-source" class="navigation"><!-- javascript:void(window.open('view-source:'+window.location.href)) -->
<!--					<a class="button" href="view-source:http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" target="_blank">View Source: Native (New Tab)</a><br /> -->
						<a class="button" onclick="window.location='view-source:' + window.location.href">View Source: Native</a><br />
						<a class="button no-scroll" href="#source-code">View Source: Modal</a></p>
				</div><!-- #secondary -->
			</div><!-- #content -->
			<div id="footer">
				<ul id="nav_footer" class="navigation">
					<li><a href="?p=contact">Contact</a></li>
					<li><a href="?p=credits">Credits</a></li>
					<li><a href="?p=home">Home</a></li>
				</ul><!-- #nav_footer -->
				<p id="copyright">COPYRIGHT &copy; <?php echo date('Y'); ?> Dylan James Wagner. All rights reserved.</p>
			</div><!-- #footer -->
		</div><!-- #site -->
		<p id="nav_dev"><a href="?p=kitchen-sink">The Kitchen Sink</a></p>
		<div id="source-code">
			<p class="close"><a title="Close View Source" href="#"><img src="http://css-tricks.com/examples/ViewSourceButton/images/x.png" alt="Close View Source"/></a></p>
		</div>
	</body>
</html>
