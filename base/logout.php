<?php

	$base = '/base';

	include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/base.php';
	include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/session.php';
	include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/database.php';

	if ($_SESSION['id']):
		mysql_query("UPDATE logins SET `out` = '".$datetime."', active = 0 WHERE id = ".$_SESSION['id']." LIMIT 1");
	
		session_destroy();
	endif;

	header('Location: '.$_SERVER['HTTP_REFERER']);

	mysql_close($con);

?>
