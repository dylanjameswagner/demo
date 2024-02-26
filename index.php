<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1">

</head>
<body>

	<h1>Demo</h1>

	<?php
	$directory = new RecursiveDirectoryIterator(dirname('./'), RecursiveDirectoryIterator::SKIP_DOTS);
	$iterator = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::SELF_FIRST);
	$paths = [];

	if ($iterator) {

		foreach ($iterator as $name => $object) {

			if (!$object->isDir()) {
				continue;
			}

			if ($iterator->getDepth() > 0) {
				continue;
			}

			if ($name) {
				$paths[] = $name;
			}
		}
	}

	if (!empty($paths)) {
		usort($paths, function ($a, $b) {
			return strnatcasecmp($a, $b);
		});

		echo '<ul>';

		foreach ($paths as $path) {
			$href = rtrim($path, '/\\') . '/';
			$text = substr($path, 2); // Remove './'

			if ($text === '.git') {
				continue;
			}

			printf('<li><a href="%s">%s</a></li>', $href, $text);
		}

		echo '</ul>';
	}
	?>

</body>
</html>
