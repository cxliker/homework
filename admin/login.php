<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
User:<input type="text" name="user"><br/><br/>
Password:<input type="password" name="password">
<br/><br/>
<input type="submit">
</form>

<?php
header("Content-Type:text/html;charset=utf-8");
	if($_SERVER['REQUEST_METHOD']== 'POST'){
		$user = $_POST['user'];
		$password = $_POST['password'];

		if($user === 'chenxiao' && $password === 'xiaochan'){
			session_start();
			$_SESSION["admin"] = true;
			echo "<script>location.href='default.php';</script>";
		}
		else{
			echo "错误！";
		}

	}
?>