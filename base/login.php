<?php

	$base = '/base';

	$pageTitle = 'Login';

?>
<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header.php'; ?>

			<article id="primary" class="article">

				<h1><?php echo $user ? 'Hello '.$userName : pageName($pageTitle); ?></h1>
<?php if ($user): ?>
				<p class="jc">You are currently logged in.</p>
<?php else: ?>
				<form id="login-form" method="post" action="<?php echo $base.'/login/'; ?>">
					<fieldset>
						<p class="fl"><label>Username<br/>
							<input type="text" name="username"/></label></p>
						<p class="fl m0"><label>Password<br/>
							<input type="password" name="password"/></label></p>
					</fieldset>
					<p class="submit fc"><input type="submit" name="submit" value="Login"/></p>
				</form>
<?php endif; ?>

			</article><!--#primary.article-->

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/footer.php'; ?>
