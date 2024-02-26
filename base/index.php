<?php

	$base = '/demo/base';

	$pageTitle			= 'Home';
	$pageDescription	= '';
	$pageKeywords		= '';

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.php'; ?>

			<article id="primary" class="article stacked">

<?php // include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/slideshow.php'; ?>
				<p id="article-image" class="slideshow jc">
					<img alt="image" width="980" height="300" src="//placehold.it/980x300&text=articleImage&.png"/>
				</p><!--article-image-->

				<h1><?php echo pageName($pageTitle); ?></h1>

			</article><!--#primary.article-->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/footer.php'; ?>
