<?php 

	include_once('./includes/connect.php');
	include_once('./includes/ensure_login.php');
	
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
	
		$get_comment = $conn->prepare("SELECT * FROM Comment WHERE guestbookId=:id");
		$get_comment->bindParam(":id", $_GET['id']);
		$get_comment->execute();

		$COMMENT = $get_comment->fetchAll(PDO::FETCH_ASSOC);

	}

	$conn = null;
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

	<?php if (isLogin()): ?>
		<div class="comment">
			<div class="comment_form">
				<form>
					<textarea name="content" placeholder="您想說的話？"></textarea>
					<input type="submit" value="按我送出"	/>
				</form>
			</div>
		</div>
		<?php foreach ($COMMENT as $ITEM): ?>
			<div class="comment_item">
				<?=$ITEM['userId']?> 在 <?=$ITEM['updatedDateTime']?> 時說：<br>
				<?=nl2br($ITEM['content'])?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>