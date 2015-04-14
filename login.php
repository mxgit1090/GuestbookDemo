<?php
	//session_start();
	include_once('./connect.php');
	include_once('./session.php');
	gbd_session_start();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		$conn = connectMysql("GuestbookDemo");
		$q = $conn->prepare("SELECT * FROM User WHERE username = :username AND password = :password");
		
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		

		//$q->setFetchMode(PDO::FETCH_ASSOC);


		$q->execute(array(
			"username" => $username,
			"password" => $password
		)) or die(print_r($q->errorInfo(), true));


		// Why fetchColumn makes the result empty
		$count = $q->rowCount();
		//$row = $q->fetch();
		
		if ($count >= 1) {
			$row = $q->fetch();
			//print_r($row);
			//session_register($row['username']);
			$_SESSION['login_user'] = $row['username'];
			header("location: index.php");
		}

	}
?>

<div class="page_container">
	<form action="login.php" method="POST">
		<table>
			<tr>
				<td><label  for="username">帳號</label></td>
				<td><input name="username"></input></td>
			</tr>
			<tr>
				<td><label  for="password">密碼</label></td>
				<td><input name="password" type="password"></input></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="登入"></input>
					<input type="reset"  value="重置"></input>
				</td>
			</tr>
		</table>
	</form>
</div>