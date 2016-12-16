	<div id="top">

<?php if ($msg): ?>
		<p id="notice" class="alert jc"><?php echo $msg ? $msg : 'All is good.'; ?></p>
<?php endif; ?>

		<div id="header" class="max-device-width"><div class="inner">

			<hgroup id="brand">
				<h1 id="brand-title"><?php echo $pageID ? '<a href="'.$base.'/">' : NULL; echo $brandTitle; echo $pageID ? '</a>' : NULL; ?></h1>
				<h2 id="brand-tagline"><?php echo $brandTagline; ?></h2>
			</hgroup>

<?php include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/header-menu.php'; ?>

		</div></div><!--#header-->

		<div id="main"><div class="inner">
