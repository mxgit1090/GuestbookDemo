<?php
	include_once('../includes/connect.php');
	include_once('../includes/ensure_login.php');

	gbd_session_start();
	date_default_timezone_set("Asia/Taipei");

	if ($_POST) {
		$conn = connectMysql("GuestbookDemo");

		$guestbookId = $_POST['guestbookId'];


		$insert_comment = $conn->prepare("INSERT Comment (userId, guestbookId, content, updatedDateTime) VALUES (:userId, :guestbookId, :content, :updatedDateTime)");
		$insert_comment->execute(array(
			"userId"      => $_SESSION['login_user_id'],
			"guestbookId" => $guestbookId,
			"content"     => $_POST['content'],
			"updatedDateTime" => date('Y-m-d H:i:s')
		));
	}
?>