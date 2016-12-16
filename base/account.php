<?php

	$base = '/base';

	$pageTitle = 'Account';

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.php'; ?>

			<article id="primary" class="article">

				<h1><?php echo $user ? 'Hello '.$userName : pageName($pageTitle); ?></h1>
<?php if ($user): ?>
				<p class="jc">You are currently logged in.</p>
<?php endif; ?>

			</article><!--#primary.article-->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/footer.php'; ?>
