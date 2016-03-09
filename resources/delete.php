<?php
	include_once('../includes/connect.php');
	include_once('../includes/ensure_login.php');
	
	$conn = connectMysql("GuestbookDemo");

	if ($_GET) {
		$get_article = $conn->prepare("DELETE FROM Guestbook WHERE id=:id");
		$get_article->bindParam(":id", $_GET['id']);
		$get_article->execute();
		
		$conn = null;
		header("location: ../index.php");	
	}
	

?>