<!doctype html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">

	<title>min-width</title>

	<style>

		* {
			margin: 0;
			padding: 0;
		}

		@-webkit-viewport { width: device-width; }
		@-mos-viewport    { width: device-width; }
		@-ms-viewport     { width: device-width; }
		@-o-viewport      { width: device-width; }
		@viewport         { width: device-width; }

		*, *:before, *:after {
			box-sizing: inherit;
		}

		html {
			-webkit-box-sizing: border-box;
			   -moz-box-sizing: border-box;
					box-sizing: border-box;
		}

		html, body {
			min-width: 375px;
		}

		img {
			max-width: 100%;
		}

		p {
			margin-top: 1em;
		}

		:first-child {
			margin-top: 0;
		}

		.site {
			position: relative;
			margin: 0 auto;
			background-color: #eee;
			background-image:
				linear-gradient(white 1px, transparent 1px),
				linear-gradient(90deg, white 1px, transparent 1px),
				linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px),
				linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px);
			background-size:
				100px 100px, 100px 100px,
				20px 20px, 20px 20px;
			background-position:
				-1px -1px, -1px -1px,
				-1px -1px, -1px -1px;
		}

		.header,
		.footer,
		.primary {
			padding: 20px;
		}

		.header {
			position: absolute; top: 0; right: 0; left: 0; z-index: 3;
		}

		.content {
			padding-top: 111px;
		}

		.content__image {
			position: absolute; top: 0; right: 0; left: 0; z-index: 1;
			height: 231px; /* 111+20+100 */
			background: #ccc no-repeat 50% 50%;
			background-size: cover;
		}

		.primary {
			position: relative; z-index: 2;
		}

		.primary__heading {
			display: flex;
			flex-direction: column;
			justify-content: flex-end;
			height: 100px;
			padding-bottom: 16px;
		}

	</style>

</head>
<body>

	<div class="site">
		<header class="header">
			<h1>Header</h1>
			<p class="header__menu">
				<a href="#">Cursus</a>
				<a href="#">Aenean</a>
				<a href="#">Porta</a>
				<a href="#">Mattis</a>
			</p>
		</header>
		<section class="content">
			<p class="content__image" style="background-image: url('//placehold.it/1400x300');"></p>
			<main class="primary">
				<h1 class="primary__heading">Content</h1>
				<p>Sed posuere consectetur est at lobortis. Sed posuere consectetur est at lobortis. Donec ullamcorper nulla non metus auctor fringilla. Maecenas faucibus mollis interdum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Donec sed odio dui.</p>
				<p>Maecenas faucibus mollis interdum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Vestibulum id ligula porta felis euismod semper. Etiam porta sem malesuada magna mollis euismod. Aenean lacinia bibendum nulla sed consectetur.</p>
				<p>Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo.</p>
				<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Maecenas faucibus mollis interdum. Maecenas sed diam eget risus varius blandit sit amet non magna. Donec ullamcorper nulla non metus auctor fringilla. Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
				<p>Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
				<p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla vitae elit libero, a pharetra augue.</p>
			</main>
		</section>
		<footer class="footer">
			<h1>Footer</h1>
			<p><a href="http://lea.verou.me/css3patterns/">CSS3 Patterns</a> <a href="https://24ways.org/2011/css3-patterns-explained/">CSS3 Patterns Explained</a></p>
		</footer>
	</div>

</body>
</html>
