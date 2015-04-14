<?php
	//session_start();
	include_once('./session.php');
	gbd_session_start();

	if (!isset($_SESSION['login_user']) || $_SESSION['login_user'] == null)
		header('location: login.php');
?>