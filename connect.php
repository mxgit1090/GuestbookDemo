<?php
	/*
	 * TODO: Set paraments
	 */
	function connectMysql ($dbname) {
		$host = "localhost:3306";
		$username = "root";
		$passwd   = "root";
		try {
			$conn = new PDO("mysql:host=".$host.";dbname=".$dbname.";", $username, $passwd);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connection success!\n";
			return $conn;
	    }
		catch(PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}	
	}
		
?>