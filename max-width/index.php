<!doctype html>
<html>
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width,minimum-scale=0.5,maximum-scale=1.0,user-scalable=no,target-densitydpi=device-dpi"/>

	<meta name="apple-mobile-web-app-capable" content="default"/>

	<title>max-width</title>

	<style>

/** base */

* {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	-o-box-sizing: border-box;
	box-sizing: border-box; /* inset padding */
}

html,
body {
	height: 100%;
}

html {
	font-family: sans-serif;
	font-size: 12px;
	line-height: 1.2;
}
@media (min-width: 320px) {

	html {
		font-size: 14px;
	}
}
@media (min-width: 768px) {

	html {
		font-size: 16px;
	}
}
@media (min-width: 1024px) {

	html {
		font-size: 18px;
	}
}
@media (min-width: 1440px) {

	html {
		font-size: 20px;
	}
}

body {
	/*min-width: 320px;*/
	min-width: 240px; /* support for really small screens */
	margin: 0;
	padding: 0;
}

header,
footer,
main,
section {
	display: block;
}

h1 { font-size: 1.4rem; }
h2 { font-size: 1.2rem; }
h3 { font-size: 1rem; }

h1,
h2,
h3,
p {
	margin: 1em 0 0;
}

pre {
	padding: 1.1em 1.2em 0;
	border: 1px solid rgba(0, 0, 0, 0.1);
	overflow: auto;
}

:first-child {
	margin-top: 0;
}

/** constructs */

.max-width {
	margin: 0 auto;
	background-color: rgba(0, 0, 0, 0.1);
}

@media (min-width: 240px) {

	.max-width {
		max-width: 240px;
	}
}
@media (min-width: 320px) {

	.max-width {
		max-width: 320px;
	}
}
@media (min-width: 375px) {

	.max-width {
		max-width: 375px;
	}
}
@media (min-width: 480px) {

	.max-width {
		max-width: 480px;
	}
}
@media (min-width: 768px) {

	.max-width {
		max-width: 768px;
	}
}
@media (min-width: 1024px) {

	.max-width {
		max-width: 1024px;
	}
}
@media (min-width: 1280px) {

	.max-width {
		max-width: 1280px;
	}
}
@media (min-width: 1440px) {

	.max-width {
		max-width: 1440px;
	}
}

.padding {
	padding: 0 2rem; /* scale margins horizontal */
	padding: 2rem 2rem; /* scale margins horizontal vertical */
}

/** layout */

.site-header,
.site-footer,
.site-content {
	padding: 5% 0; /* scale margins vertical */
	padding: 0;
}

.site         { background-color: rgba(0, 0, 0, 0.05); }
.site-header  { background-color: rgba(0, 0, 0, 0.05); }
.site-footer  { background-color: rgba(0, 0, 0, 0.05); }
.site-content { background-color: rgba(0, 0, 0, 0.075); }
.site-main    { background-color: rgba(0, 0, 0, 0.075); }
.site-aside   { background-color: rgba(0, 0, 0, 0.05); }

.col,
.column	{ background-color: rgba(0, 0, 0, 0.05); }

/** layout bottom fixed footer */

.site {
	display: flex;
	flex-direction: column;
	min-height: 100%;
	margin-bottom: -88px;
}

.site-footer {
	flex-shrink: 0;
}

.site-content {
	display: flex;
	flex-grow: 1;
}

.site-content__inner {
	display: flex;
	flex-direction: column;
	width: 100%;
	min-height: 100%;
	padding: 0;
}

@media (min-width: 1024px) {

	.site-content__inner {
		flex-direction: row;
	}
}

.site-main {
	flex-grow: 0;
	width: 100%;
}

@media (min-width: 1024px) {

	.site-main {
		flex-grow: 1;
		width: calc(100% - 320px);
	}
}

.site-aside {
	flex-grow: 1;
	flex-shrink: 0;
}

@media (min-width: 1024px) {

	.site-aside {
		flex-grow: 0;
		width: 320px;
	}
}

/** content width */

@media (min-width: 1024px) {

	.site-content h1,
	.site-content h2,
	.site-content h3,
	.site-content p,
	.site-content pre {
		max-width: 44rem;
	}
}

/**
 * Viewport Width Pixel Scale
 *
 * @link http://en.wikipedia.org/wiki/Display_resolution
 * @link http://viewportsizes.com/
*/

.site-header {
	padding-top: 21px !important; /* match scale height */
}

.scale {
	position: fixed; top: 0; left: 0;
	width: 100%;
	height: 21px;
	margin: 0;
	/*border-bottom: 1px solid;*/
	background-color: #fff;
	box-shadow: 0 0 2px 0 black;
	text-align: right;
	overflow: hidden;
	font-size: 11px;
}

.scale__width {
	display: block;
	position: absolute; top: 0; left: 0;
	width: 100%;
	padding: 5px 4px 3px;
	/*border-right: 1px solid black;*/
	box-shadow: 0 0 2px 0 black;
	background-color: rgba(0,0,0,.025);
	color: transparent;
}

.scale__width:hover {
	z-index: 2;
	background-color: #eee;
	/*background-image: linear-gradient(to left, #fff 0, transparent 100px);*/
	color: black;
}

.scale__width--240  { width:  240px; }
.scale__width--320  { width:  320px; }
.scale__width--360  { width:  360px; }
.scale__width--375  { width:  375px; }
.scale__width--480  { width:  480px; }
.scale__width--640  { width:  640px; }
.scale__width--540  { width:  540px; }
.scale__width--600  { width:  600px; }
.scale__width--640  { width:  640px; }
.scale__width--768  { width:  768px; }
.scale__width--800  { width:  800px; }
.scale__width--960  { width:  960px; }
.scale__width--1024 { width: 1024px; }
.scale__width--1140 { width: 1140px; }
.scale__width--1280 { width: 1280px; } /* macbook pro 13, macbook air 13 */
.scale__width--1366 { width: 1366px; } /* macbook air 11 */
.scale__width--1440 { width: 1440px; } /* macbook pro 15 hi-res */
.scale__width--1600 { width: 1600px; }
.scale__width--1680 { width: 1680px; } /* macbook pro 15 hi-res */
.scale__width--1900 { width: 1900px; }
.scale__width--1920 { width: 1920px; } /* imac 21 */
.scale__width--2048 { width: 2048px; }
.scale__width--2560 { width: 2560px; } /* imac 27 */
.scale__width--auto {}

	</style>

	<!-- <script src="./public/scripts/html5shiv.printshiv-3.6.2.min.js"></script> -->
	<!-- <script src="./public/scripts/prefixfree-1.0.7.min.js"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<!--[if IE 8]><script src="./public/scripts/selectivizr-1.0.2.min.js"></script><![endif]-->

</head>

<body>

	<div id="top" class="site">

		<header class="site-header">
			<div class="site-header__inner max-width padding">

				<h1>Header</h1>

			</div>
		</header>

		<section class="site-content">
			<div class="site-content__inner max-width">

				<main class="site-main padding">
					<h1>Main</h1>

					<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Nullam id dolor id nibh ultricies vehicula ut id elit. Sed posuere consectetur est at lobortis. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum.</p>

					<h2>Breakpoints</h2>

					<pre>
@media (min-width:  240px) &rarr; .max-width { max-width:  240px; }
@media (min-width:  320px) &rarr; .max-width { max-width:  320px; }
@media (min-width:  375px) &rarr; .max-width { max-width:  375px; }
@media (min-width:  480px) &rarr; .max-width { max-width:  480px; }
@media (min-width:  768px) &rarr; .max-width { max-width:  768px; }
@media (min-width: 1024px) &rarr; .max-width { max-width: 1024px; }
@media (min-width: 1440px) &rarr; .max-width { max-width: 1440px; }
					</pre>

					<p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Curabitur blandit tempus porttitor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
					<p>Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

					<p>Donec ullamcorper nulla non metus auctor fringilla. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Curabitur blandit tempus porttitor. Nulla vitae elit libero, a pharetra augue. Maecenas sed diam eget risus varius blandit sit amet non magna. Sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
					<p>Maecenas faucibus mollis interdum. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.</p>
					<p>Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Etiam porta sem malesuada magna mollis euismod. Sed posuere consectetur est at lobortis. Vestibulum id ligula porta felis euismod semper. Nullam id dolor id nibh ultricies vehicula ut id elit. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
				</main>

				<aside class="site-aside padding">
					<h1>Aside</h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
				</aside>

			</div>
		</section>

		<footer class="site-footer">
			<div class="site-footer__inner max-width padding">

				<h1>Footer</h1>

			</div>
		</footer>

	</div>

	<p class="scale">
		<span class="scale__width scale__width--auto">auto</span>
		<span class="scale__width scale__width--2560">2560</span>
		<span class="scale__width scale__width--2048">2048</span>
		<span class="scale__width scale__width--1920">1920</span>
		<span class="scale__width scale__width--1680">1680</span>
		<span class="scale__width scale__width--1600">1600</span>
		<span class="scale__width scale__width--1440">1440</span>
		<span class="scale__width scale__width--1366">1366</span>
		<span class="scale__width scale__width--1280">1280</span>
		<span class="scale__width scale__width--1140">1140</span>
		<span class="scale__width scale__width--1024">1024</span>
		<span class="scale__width scale__width--960">960</span>
		<span class="scale__width scale__width--768">768</span>
		<span class="scale__width scale__width--640">640</span>
		<span class="scale__width scale__width--540">540</span>
		<span class="scale__width scale__width--480">480</span>
		<span class="scale__width scale__width--375">375</span>
		<span class="scale__width scale__width--360">360</span>
		<span class="scale__width scale__width--320">320</span>
		<span class="scale__width scale__width--240">240</span>
	</p><!--.scale-->

</body>
</html>
