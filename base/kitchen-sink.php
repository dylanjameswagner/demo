<?php

	$base = '/base';

	$pageTitle = 'The Kitchen Sink';

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.php'; ?>

			<article id="primary" class="article">

				<!--h1><?php echo pageName($pageTitle); ?></h1-->

<?php include $_SERVER['DOCUMENT_ROOT'].'/kitchen-sink/kitchen-sink.php'; ?>
<?php

//	$includeFile = file_get_contents('http://dylanjameswagner.com/kitchen-sink/kitchen-sink.php');
//	echo $includeFile;

?>
			</article><!--#primary.article-->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/footer.php'; ?>
