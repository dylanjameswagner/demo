<?php

	$base = '/demo/base';

	$brandTitle		= 'brandTitle';
	$brandTagline	= 'brandTagline';

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/base.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/functions.php'; ?>
<?php // include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/session.php'; ?>
<!doctype html>
<html lang="en" id="<?php echo pageID(); ?>" class="max-device-width<?php echo pageClass(); ?>">
<head><!--profile="http://gmpg.org/xfn/11"-->

	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width,minimum-scale=0.5,maximum-scale=1.0,user-scalable=yes,target-densitydpi=device-dpi"/>

	<meta name="robots" content="index,follow,noarchive"/>
	<meta name="description" content="<?php echo pageDescription($pageDescription); ?>"/>
	<meta name="keywords" content="<?php echo pageKeywords($pageKeywords); ?>"/>

	<meta name="apple-mobile-web-app-capable" content="default"/>

	<title><?php echo pageTitle($pageTitle); ?></title>

	<link rel="shortcut icon" type="image/x-icon" href="<?php base(); ?>/-/images/favicon.ico"/>

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php base(); ?>/-/images/apple/apple-touch-icon-144x144-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php base(); ?>/-/images/apple/apple-touch-icon-114x114-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="72x72"	 href="<?php base(); ?>/-/images/apple/apple-touch-icon-72x72-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed" sizes="57x57"	 href="<?php base(); ?>/-/images/apple/apple-touch-icon-57x57-precomposed.png"/>
	<link rel="apple-touch-icon-precomposed"			 	 href="<?php base(); ?>/-/images/apple/apple-touch-icon-precomposed.png"/>
	<link rel="apple-touch-icon"							 href="<?php base(); ?>/-/images/apple/apple-touch-icon.png"/>

	<link rel="stylesheet" href="<?php base(); ?>/-/styles/bebas-neue.css"/>
	<link rel="stylesheet" href="<?php base(); ?>/-/styles/reset.css"/>
	<link rel="stylesheet" href="<?php base(); ?>/-/styles/base.css"/>
	<link rel="stylesheet" href="<?php base(); ?>/-/styles/development.css"/>

<!--[if gt IE 8]><!-->

	<link rel="stylesheet" href="<?php base(); ?>/-/styles/jquery-ui-1.9.1.smoothness.min.css"/>
	<link rel="stylesheet" href="<?php base(); ?>/-/styles/style.css"/>

	<link rel="stylesheet" href="<?php base(); ?>/-/styles/jquery.tablesorter.css"/>
	<link rel="stylesheet" href="<?php base(); ?>/-/styles/jquery.rainbow.css"/>
	<link rel="stylesheet" href="<?php base(); ?>/-/styles/navigation.css"/>

<!--<![endif]-->

<!--[if lte IE 8]>

	<link rel="stylesheet" href="<?php base(); ?>/-/styles/ie8.css"/>

<![endif]-->

	<script src="<?php base(); ?>/-/scripts/analytics.js"></script>
	<script src="<?php base(); ?>/-/scripts/html5shiv.printshiv-3.6.2.min.js"></script>
<!-- script src="<?php base(); ?>/-/scripts/modernizr-2.6.2.js"></script-->

</head>
<body class="max-device-width">

	<!--

	  Love source? Me too.
	  Want to work with me? I want to work with you.
	  If you're reading this, we should talk. ;)

	  hello@dylanjameswagner.com

	  -->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/development.php'; ?>

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.inc.php'; ?>
