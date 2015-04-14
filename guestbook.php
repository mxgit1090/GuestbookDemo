<?php 

	include_once('./connect.php');
	include_once('./ensure_login.php');
	
	$conn = connectMysql("GuestbookDemo");

	// Initialize the block
	$RESULT = array(
		"title"   => "無標題",
		"content" => "本文章無內容<br>",
		"createdDateTime" => ""
	);

	if ($_GET) {
		$get_article = $conn->prepare("SELECT * FROM Guestbook WHERE id=:id");
		$get_article->bindParam(":id", $_GET['id']);
		$get_article->execute();
		
		$RESULT = $get_article->fetch(PDO::FETCH_ASSOC);
	}
?>

<link rel="stylesheet" type="text/css" href="style.css">

<div class="page_container" style="text-align:center;">
	<h1>
		<?= $RESULT['title']?>
	</h1>
	
	<?= $RESULT['createdDateTime']?>
	<hr>
	<div class='guestbook_item'>
		<?=nl2br($RESULT['content'])?>
	</div>
</div>