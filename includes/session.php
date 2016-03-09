<?php
	// @see: http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL
	/**
	 * 使用 Cookie 來存取 Session，不單純啟用
	 */
	function gbd_session_start() {
		$session_name = "gbd_session_info";

		// 使用安全連線
		// 安全連線無法建立 session，因為現在不是用安全連線
		$secure   = false;
		// 只允許 HTTP 連線
		$httponly = true;

		// Set cookie to store session id to increase security
		// If the cookie is deleted, the session can't be got!
		if (ini_set("session.use_only_cookies", 1) == false) {
			echo "<h1>Error: Can't set security connection.</h1>";
			exit();
		}

		// Get Current Cookies
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params(
			$cookieParams['lifetime'],
			$cookieParams['path'],
			$cookieParams['domain'],
			$secure,
			$httponly);

		// 設定 session 名稱
		session_name($session_name);
		session_start();
		// 重新產生 session_id
		session_regenerate_id(true);
	}
?>