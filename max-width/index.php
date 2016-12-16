<!doctype html>
<html>
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width,minimum-scale=0.5,maximum-scale=1.0,user-scalable=no,target-densitydpi=device-dpi"/>

	<meta name="apple-mobile-web-app-capable" content="default"/>

	<title>max-width</title>

	<style>

/* scale is for dev/display purposes */
/* resources:
	http://en.wikipedia.org/wiki/Display_resolution
	http://viewportsizes.com/
*/

	#header {
		padding-top: 22px !important; }

	.scale {
		position: fixed; top: 0; left: 0;
		width: 100%;
		height: 22px;
		margin: 0;
		border-bottom: 1px solid;
		background-color: #fff;
		text-align: right;
		overflow: hidden;
		font-size: 11px; }

	.width {
		display: block;
		position: absolute; top: 0; left: 0;
		width: 100%;
		padding: 5px 4px 3px;
		border-right: 1px solid;
		background-color: rgba(0,0,0,.025); }

	.width-240	{ width:  240px; }
	.width-320	{ width:  320px; }
	.width-360	{ width:  360px; }
	.width-480	{ width:  480px; }
	.width-640	{ width:  640px; }
	.width-540	{ width:  540px; }
	.width-600	{ width:  600px; }
	.width-640	{ width:  640px; }
	.width-768	{ width:  768px; }
	.width-800	{ width:  800px; }
	.width-960	{ width:  960px; }
	.width-1024 { width: 1024px; }
	.width-1280 { width: 1280px; } /* macbook pro 13, macbook air 13 */
	.width-1366 { width: 1366px; } /* macbook air 11 */
	.width-1440 { width: 1440px; } /* macbook pro 15 hi-res */
	.width-1600 { width: 1600px; }
	.width-1680 { width: 1680px; } /* macbook pro 15 hi-res */
	.width-1900 { width: 1900px; }
	.width-1920 { width: 1920px; } /* imac 21 */
	.width-2048 { width: 2048px; }
	.width-2560 { width: 2560px; } /* imac 27 */

	.width-auto { border: 0; }

/* demo setup */

	* {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		-ms-box-sizing: border-box;
		-o-box-sizing: border-box;
		box-sizing: border-box; /* inset padding */ }

	header,
	footer,
	section {
		display: block; }

	h1 { font-size: 27px; }
	h2 { font-size: 22px; }
	h3 { font-size: 20px; }

	h1, h2, h3, p {
		margin: 1em 0 0; }

	:first-child {
		margin-top: 0; }

	body {
		min-width: 320px;
		min-width: 240px; /* support for really small screens */
		margin: 0;
		padding: 0;
		font-family: sans-serif;
		line-height: 1.2; }

	#header,
	#footer,
	#main {
		padding: 5% 0; /* scale margins vertical */
		padding: 0; }

	#top	{ background-color: rgba(0,0,0,.05); }
	#header { background-color: rgba(0,0,0,.05); }
	#footer { background-color: rgba(0,0,0,.15); }
	#main	{ background-color: rgba(0,0,0,.1); }

	.col,
	.column	{ background-color: rgba(0,0,0,.05); }

/* layout bottom fixed footer */

	html, body {
		height: 100%; }

	#top {
		min-height: 100%;
		margin-bottom: -88px; }
	#main {
		padding-bottom: 88px; }
	#footer { width: 100%; min-height: 88px;
		overflow: hidden; }

/* layout fixed width centered */

	.centered {
		max-width: 1024px;
		margin: 0 auto;
		padding: 0 5%; /* scale margins horizontal */
		padding: 2em 5%; /* scale margins horizontal vertical */
		background-color: rgba(0,0,0,.1); }

/* media queries max-width */

@media only screen and (max-width: 1023px){

	.centered {
		max-width: 768px; }

}
	
@media only screen and (max-width: 767px){

	.centered {
		max-width: 480px; }

}

@media only screen and (max-width: 479px){

	.centered {
		max-width: 320px; }

}

@media only screen and (max-width: 319px){

	.centered {
		max-width: 240px; }

}

@media only screen and (max-width: 239px){}

	</style>

	<script src="-/scripts/html5shiv.printshiv-3.6.2.min.js"></script>
	<script src="-/scripts/prefixfree-1.0.7.min.js"></script>
<!--[if IE 8]><script src="-/scripts/selectivizr-1.0.2.min.js"></script><![endif]-->

</head>

<body>

	<div id="top">

		<header id="header">
			<div id="header-inner" class="centered">

				<h1>header</h1>

			</div><!--#header-inner-->
		</header><!--#header-->

		<section id="main">
			<div id="main-inner" class="centered">

				<h2>content</h2>

				<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nullam id dolor id nibh ultricies vehicula ut id elit. Sed posuere consectetur est at lobortis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
				<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
				<p>Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

				<h3>breakpoints</h3>
				<ul>
					<li>min-width 1024px &rarr; 1024px : default</li>
					<li>max-width 1023px &rarr; 768px</li>
					<li>max-width 767px &rarr; 480px</li>
					<li>max-width 479px &rarr; 320px</li>
					<li>max-width 319px &rarr; 240px</li>
				</ul>

				<p>Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

			</div><!--#main-inner-->
		</section><!--#main-->

	</div><!--#top-->

	<footer id="footer">
		<div id="footer-inner" class="centered">

			<h3>footer</h3>
		
		</div><!--#footer-inner-->
	</footer><!--#footer-->

	<p class="scale">
		<span class="width width-auto">&nbsp;</span>
		<span class="width width-2560">2560</span>
		<span class="width width-2048">2048</span>
		<span class="width width-1920">1920</span>
		<span class="width width-1680">1680</span>
		<span class="width width-1600">1600</span>
		<span class="width width-1440">1440</span>
		<span class="width width-1366">1366</span>
		<span class="width width-1280">1280</span>
		<span class="width width-1024">1024</span>
		<span class="width width-960">960</span>
		<span class="width width-768">768</span>
		<span class="width width-640">640</span>
		<span class="width width-540">540</span>
		<span class="width width-480">480</span>
		<span class="width width-360">360</span>
		<span class="width width-320">320</span>
		<span class="width width-240">240</span>
	</p><!--.scale-->

</body>
</html>
