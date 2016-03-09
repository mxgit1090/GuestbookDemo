<?php
	/*
	 * TODO: Set paraments
	 */
	require("./config.php");

	function connectMysql () {
		$host     = MYSQL_HOST;
		$username = MYSQL_USER;
		$passwd   = MYSQL_PASSWORD;
		$dbname   = MYSQL_DBNAME;
		try {
			$conn = new PDO("mysql:host=".$host.";dbname=".$dbname.";", $username, $passwd);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			return $conn;
	    }
		catch(PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}	
	}
		
?>