<!doctype html>
<html>
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width,minimum-scale=0.5,maximum-scale=1.0,user-scalable=no"/>

	<title>contact</title>

	<link rel="shortcut icon" type="image/x-icon" href="index/images/favicon.ico"/>
	<link rel="stylesheet prefetch" href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic"/>

	<style>

/* reset */

	* {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		-ms-box-sizing: border-box;
		-o-box-sizing: border-box;
		box-sizing: border-box;
		margin: 0; padding: 0;
		border: 0;
		font: inherit;
		line-height: inherit;
		vertical-align: baseline; }

/* base */

	html, body {
		height: 100%; }

	body {
		min-width: 320px;
		margin: 0; padding: 0;
		background: url('index/images/body.png') no-repeat fixed 50% 0;
		background-size: cover;
		font-family: 'Open Sans',Helvetica,Arial,sans-serif;
		font-size: 10px;
		line-height: 1.2; }

	h1, h2, h3, h4, h5, h6, address, p, ul, li, hr, section {
		margin: 16px 0 0; }

	h1, h2, h3, h4, h5, h6 {
		font-weight: 700; }

	h1 { font-size: 30px; }
	h2 { font-size: 27px; }
	h3 { font-size: 23px; }
	h4 { font-size: 20px; }
	h5 { font-size: 18px; }
	h6 { font-size: 16px; }

	h1 + p,
	h2 + p,
	h3 + p,
	h4 + p,
	h5 + p,
	h6 + p {
		margin-top: 5px; }

	ul, ol {
		padding: 0 .7em 0 1.8em; }
	li {
		list-style: disc outside none; }
	li + li {
		margin-top: .25em; }

	hr {
		margin: 32px auto;
		border-top: 1px solid;  }

	:first-child {
		margin-top: 0; }

/* base anchors */

	a {
		color: inherit; }
	a:hover,
	a:active {
		outline: 0;
		text-decoration: underline; }

	a img {
		border: 0; }
	a:hover img,
	a:active img {}

	address a,
	address a:hover,
	a[href^="tel:"],
	a[href^="tel:"]:hover,
	a[href^="tel:"]:hover * {
		text-decoration: none;
		color: inherit;
		cursor: text; }

/* constructs */

	.row {
		margin-top: 16px; }
	.row:after {
		content: '';
		display: block;
		clear: both; }

	.col {
		float: left;
		margin-top: 0; }

	.button {
		display: inline-block;
		padding: 10px 13px 8px 12px;
		border: 2px solid;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		-ms-border-radius: 3px;
		-o-border-radius: 3px;
		border-radius: 3px;
		background-color: transparent;
		`background-color: rgba(0,0,0,.5);
		text-decoration: none;
		text-transform: uppercase;
		box-shadow: 0 1px 2px rgba(0,0,0,.05);
		text-shadow: 0 1px 2px rgba(0,0,0,.05); }
	.button:hover {
		text-decoration: none; }
	.button:active,
	.button:focus {
		border-color: #000;
		color: #000; }

/* constructs forms */

	button,
	input,
	select,
	textarea {
		width: 100%;
		max-width: 100%;
		padding: 8px 7px 7px;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		-ms-border-radius: 3px;
		-o-border-radius: 3px;
		border-radius: 3px;
		text-align: left;
		font-size: 16px; }

	input,
	select,
	textarea {
		background-color: #fafafa; }

	button,
	input[type="radio"],
	input[type="checkbox"],
	input[type="submit"] {
		width: auto; }

	input:not([type="radio"]):not([type="checkbox"]) {
		-webkit-appearance: none;
		appearance: none; }

	input,
	select,
	textarea {
		border: 2px solid #ddd; }
	input:focus,
	select:focus,
	textarea:focus {
		outline: none;
		border-color: #000;
		background-color: #fff; }

	textarea {
		font: inherit; } /* firefox */

	select {
		height: 41px; }

	form,
	.notice {
		min-width: 288px; }
	fieldset {
		margin: -5px 0 15px; padding: 13px 10px 10px; }
	legend {
		margin-left: -5px; padding: 2px 5px 4px;
		font-size: 1.3em; }
	label {
		display: block;
		margin-bottom: 4px;
		vertical-align: top;
		font-weight: 700;
		font-size: .95em; }

	.notice {
		margin-bottom: 20px; padding: 10px 13px 8px 12px;
		border: 2px solid;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		-ms-border-radius: 3px;
		-o-border-radius: 3px;
		border-radius: 3px; }
	.notice.thanks {
		text-align: center; }
	.notice.error {
		color: #c00; }
	.notice ul {
		margin-top: 5px; }

	.error label {
		color: #c00; }
	.error input,
	.error textarea {
		border-color: #c00; }

	form .col + .col {
		margin-top: 0; padding-left: 6px; }

	form label {
		line-height: 1; }
	form label small {
		float: right;
		margin-left: -1em; padding-right: 1px;
		text-transform: uppercase;
		font-weight: 400;
		font-size: 10px;
		line-height: 16px; }

	form .unit {
		margin-top: 4px; }
	form .unit label {
		display: none; }

	form .preference label + label {
		float: left; }
	form .preference label + label + label {
		margin-left: 16px; }

	form .first	{ width: 50%; }
	form .last	{ width: 50%; }
	form .city	{ width: 60%; }
	form .state	{ width: 15%; }
	form .zip	{ width: 25%; }

/* layout */

	#top {
		max-width: 1024px;
		margin: 0 auto; padding: 30px 5%;
		font-size: 16px; }

	</style>

</head>

<body>

	<div id="top">

<?php include 'contact.php'; ?>

	</div><!--#top-->

</body>
</html>
