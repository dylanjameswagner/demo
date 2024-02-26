<?php /* database.php // dylanjameswagner.com/base */

	$db_host = '';
	$db_name = '';
	$db_user = '';
	$db_pass = '';
	$db_port = '';

//	$con = mysql_pconnect($db_host.':'.$db_port, $db_user, $db_pass); // host, user, pass // persistent connection
	$con = mysql_connect($db_host.':'.$db_port, $db_user, $db_pass); // host, user, pass

	if (!$con){ die('<p><b>Could Not Connect:</b> '.mysql_error().'.</p>'); } // test connection // stop script and print error message

	mysql_select_db($db_name, $con); // name, connection

?>
