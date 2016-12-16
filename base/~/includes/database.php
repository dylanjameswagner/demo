<?php /* database.php // dylanjameswagner.com/base */

	$db_host = 'db477358780.db.1and1.com';
	$db_name = 'db477358780';
	$db_user = 'dbo477358780';
	$db_pass = 'zjWz9Q3c>>3k6Q[oh83vdv)k';
	$db_port = '3306';

//	$con = mysql_pconnect($db_host.':'.$db_port,$db_user,$db_pass); // host, user, pass // persistent connection
	$con = mysql_connect($db_host.':'.$db_port,$db_user,$db_pass); // host, user, pass

	if (!$con){ die('<p><b>Could Not Connect:</b> '.mysql_error().'.</p>'); } // test connection // stop script and print error message

	mysql_select_db($db_name,$con); // name, connection

?>
