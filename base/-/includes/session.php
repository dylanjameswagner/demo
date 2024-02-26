<?php /* session.php */

	session_start();

/* mobile redirect */
/*
		if ($_GET['m'] == 'mobile'){ $_SESSION['m'] =  'mobile'; }
	elseif ($_GET['m'] == 'full'){	 $_SESSION['m'] =    'full'; }
	elseif (!$_SESSION['m']){		 $_SESSION['m'] = 'default'; }

	if ($_SESSION['m'] == 'mobile'){ header('Location: http://'.$_SERVER['SERVER_NAME'].$base.'/m/'); }
*/

/* login */

	include $_SERVER['DOCUMENT_ROOT'].$base.'/-/includes/database.php';

	if ($_POST['submit'] == 'Login'){
		$sql = "SELECT id, role, email, password, nameFirst, nameMiddle, nameLast, created FROM users";
		$res = mysql_query($sql);

		while ($row = mysql_fetch_array($res)){
			$username = $row['email'];
			$password = $row['password'];

			$msg = NULL;

			if ($_POST['username'] == $username && $password == md5($_POST['password'].$row['created'])){
				$_SESSION['userRole'] = $row['role'];
				$_SESSION['userID']	  = $row['id'];
				$_SESSION['userName'] = $row['nameFirst'].' '.$row['nameMiddle'].' '.$row['nameLast']; // combine user's name

				// log user login
				$sql = "INSERT INTO logins (id, userID, `in`, `out`, active) VALUES (NULL, '".$row['id']."', NULL, '0000-00-00 00:00:00', 1)";
				$res = mysql_query($sql);

				if ($res){
					$sql = "SELECT id FROM logins WHERE userID = ".$row['id']." ORDER BY logins.id DESC LIMIT 1"; // get login id for last entry for user
					$res = mysql_query($sql);
					$row = mysql_fetch_array($res);

					$_SESSION['id'] = $row['id'];							// assign session id
				} // end if $res

				// login timeout cleanup
				mysql_query("UPDATE logins SET active = 0 WHERE id != ".$_SESSION['id']." AND active = 1 AND `out` < '".date('Y-m-d H:i:s',strtotime('-1 day'))."'");

				if ($_SESSION['userURL']){
					header('Location: '.$_SESSION['userURL']);				// redirect logged in user

					unset($_SESSION['userURL']);
				} else {
					switch($_SESSION['userRole']){
						case 100: header('Location: '.$base.'/admin/'); break; // Administrator
						default: break;
					} // end switch
				} // end if session url
			} else {

				$msg = 'The username or password is invalid.';

			}
 		} // end while
	} // end if post

	$user	  = $_SESSION['userID'] ? true : false;
	$userID	  = $_SESSION['userID'];
	$userName = $_SESSION['userName'];
	$userRole = $_SESSION['userRole'];

	// restricted sections
	$restricted = array('admin','account');

	// $pageID from functions.php
	if (in_array($pageID,$restricted) && $userRole != 100){
		$_SESSION['userURL'] = $_SERVER['PHP_SELF'];

		header('Location: '.$base.'/login/'); // ?error=protected
	}

	mysql_close($con);

?>
