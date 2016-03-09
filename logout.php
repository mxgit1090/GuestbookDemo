<?php
	include_once('./includes/session.php');
	gbd_session_start();

	// Get session parameters
	$cookieParams = session_get_cookie_params();

	setcookie(session_name(), '', time() - 20 * 60 * 1000, 
		$cookieParams['path'],
		$cookieParams['domain'],
		$cookieParams['secure'],
		$cookieParams['httponly']
	);
	
	// Destroy sessions
	session_destroy();
	header('location: index.php');
?>