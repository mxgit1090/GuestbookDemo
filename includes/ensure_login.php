<?php
	//session_start();
	include_once('session.php');
	gbd_session_start();

	function isLogin() {
		if (isset($_SESSION['login_user']) && $_SESSION['login_user'] != null)
			return true;
		else
			return false;
	}

	if ( !isLogin() )
		header('location: login.php');
?>