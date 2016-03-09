<?php 
	// Use session
	//session_start();
	include_once('./includes/connect.php');
	include_once('./includes/session.php');
	include_once('./includes/ensure_login.php');

	// 啟動 session
	gbd_session_start();
	
	// 建立連線後，執行 MySQL
	$conn = connectMysql("GuestbookDemo");

	// Add Timezone to fit DateTime
	// Or set date.timezone="Asia/Taipei" in php.ini
	date_default_timezone_set("Asia/Taipei");

	// 若為 POST 方法，插入新的留言。
	if ($_POST) {
		$insertContent = $conn->prepare("INSERT INTO Guestbook (userId, title, content, createdDateTime) VALUES (:userId, :title, :content, :createdDateTime)");
		$insertContent->execute(array(
			"userId"  => 0,
			"title"   => $_POST['title'],
			"content" => $_POST['content'],
			"createdDateTime" => date('Y-m-d H:i:s')
		));
	}
?>

<link rel="stylesheet" type="text/css" href="public/css/style.css">

<div class="page_container">
<h1> 超簡易留言版 </h1>
<?php if (isset($_SESSION['login_user'])): ?>
	<p>
		Hi, <?=$_SESSION['login_user']?>!!
		<a href="logout.php">按我登出</a>
	</p>
<?php else: ?>
		<p><a href="login.php">登入</a></p>
<?php endif; ?>
<hr>

<?php
	// $guestbookRows 為 PDOStatement object
	$guestbookRows = $conn->query("SELECT * FROM Guestbook ORDER BY createdDateTime DESC");

	// 若有取得列，則顯示結果
	// $guestbookRows 為什麼無法直接用 foreach 取得資料庫內容呢？
	if ( $guestbookRows->fetchColumn() > 0 ) {
		try {
			//print_r($guestbookRows);
			// 呈現留言板內容
			foreach ($conn->query("SELECT * FROM Guestbook ORDER BY createdDateTime DESC") as $item): ?>
				
				<!-- 本區為 HTML !!-->
				<div class='guestbook_item'>
					<div class='item_title'><?= $item['title']?></div>
					<div class='item_date'><?=  $item['createdDateTime']?></div>
					<hr>
					<div>
						<?= nl2br(substr($item['content'], 0, 100))?> ...
						<a href="guestbook.php?&id=<?=$item['id']?>">閱讀更多</a>
					</div>
					<?php if ( isLogin() ): ?>
						<a href="resources/delete.php?id=<?=$item['id']?>">刪除本文</a>
					<?php endif; ?>
				</div>


			<?php endforeach;
			$conn = null;
		}
		catch(PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
    		die("Ahhh! ");
		}
	}
	else {
		echo "<p>目前留言板沒有內容</p>";
	}
?>


<hr>

<?php if ( isLogin() ): ?>
	
	<form action="index.php" method="POST">
		<table id="table_create" align="center">
			<tr>
				<td><label for="title">文章主題</label></td>
				<td><input name="title" style="width: 100%;"></input></td>
			</tr>
			<tr>
				<td><label for="content">文章內容</label></td>
				<td><textarea name="content"></textarea></td>
			</tr>
			<tr align="center">
				<td colspan="2">
					<input type="submit" value="發布"></input>
					<input type="reset" value="清除"></input>
				</td>
			</tr>
		</table>
	</form>

<?php else:  ?>
	
	<h3>請先<a href="login.php">登入</a>以留言</h3>

<?php endif; ?>

</div>