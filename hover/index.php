<!doctype html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width">

	<title>hover</title>

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
			min-width: 320px;
		}

		img {
			max-width: 100%;
		}

		p {
			margin-top: 1em;
		}

		a {
			text-decoration: none;
		}
		a:hover {
			text-decoration: underline;
		}

		:first-child {
			margin-top: 0;
		}

		.site {
			padding: 1em;
			max-width: 480px;
		}

		.footer,
		.content {
			margin-top: 1em;
		}

		.card {
			display: block;
			padding: 1em;
			border: 1px solid;
			color: #000;
		}
		.card:hover {
			background: #eee;
			text-decoration: none;
		}

		.button {
			display: inline-block;
			padding: 0.6em;
			background-color: #ccc;
		}
		.button:hover {
			text-decoration: underline;
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
				<a class="card" href="#">
					<h1 class="card__heading">Content</h1>
					<div class="card__content">
						<p>Sed posuere consectetur est at lobortis.</p>
					</div>
					<p class="card__action"><span class="button">Button</span></p>
				</a>
				<p class="primary__edit"><a href="#">Edit Primary</a></p>
			</main>
		</section>
		<footer class="footer">
			<h1>Footer</h1>
		</footer>
	</div>

</body>
</html>
