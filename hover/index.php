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

		:first-child {
			margin-top: 0;
		}

		a {
			text-decoration: none;
		}

		a:hover {
			text-decoration: underline;
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
					<h1 class="primary__heading">Content</h1>
					<p>Sed posuere consectetur est at lobortis.</p>
				</a>
				<a href="#">Edit</a>
			</main>
		</section>
		<footer class="footer">
			<h1>Footer</h1>
		</footer>
	</div>

</body>
</html>
