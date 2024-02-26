<?php

	$base = '/base';

	$pageTitle = 'Admin';

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.php'; ?>

			<article id="primary" class="article">

				<h1>Admin</h1>

				<p>Hello <?php echo $userName; ?></p>
				
				<nav>
					<ul class="navigation">
						<li><a href="<?php base(); ?>/admin/users">Users</a></li>
						<li><a href="<?php base(); ?>/admin/pages">Pages</a></li>
					</ul><!--.navigation-->
				</nav>

			</article><!--#primary.article-->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/footer.php'; ?>
