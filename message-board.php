
<html>
<head>
	<title>homework</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?be4e7f454eaa1728fca74d86495c1478";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
</head>





<style type="text/css">
	#message-board{
		/*background: lightgray;	*/
		width: 95%;
		margin:0 auto;
		height: 98%;
	}

	#box{
		background: lightgray;	
		width: 100%;
		/*height: 100%;*/
	}

	.timeinfo{
		margin:0;
		font-size: 13px;
		color: grey;
		text-align: right;
	}

	body{
		padding:0;
		margin:0;
	}

</style>
 
<script language="JavaScript"> 
	$(function(){
		var height = $("#message-content").height() + 50;
		$("#box").height(height);
	});
</script> 

<body>


<div id='box'>
	<div id="message-board">
		<h3>留言板(正在完善)</h3>
		<div id="message-content">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				昵称：<input type="text" name="name">
				<br/><br/>
				<textarea name="content" rows="10" cols="40"></textarea><br/><br/>
				<input type="submit">
			</form>
			<?php 
				$con = new mysqli("localhost","root","root","homework");
		        if($con->connect_errno)
		            die('Could not connect:'. $con->connect_error);

		        $con->query("set names utf8");

		        

		       if($_SERVER['REQUEST_METHOD']== 'POST'){

			       	$sql="SELECT * FROM message ORDER BY id DESC limit 1"; 
					$result=$con->query($sql);
					$row = $result->fetch_assoc();
					$count=$row['id'] + 1; 

		       	  	$name = htmlspecialchars($_POST['name']);
			        $content = htmlspecialchars($_POST['content']);
			        // $time = htmlspecialchars($_POST['time']);

			      	$content = trim($content);

			        if(empty($content)){
			        	echo "<p style='color:red'>*内容不能为空*</p>";
			    	}
			    	else{
						date_default_timezone_set('Asia/Shanghai');
			    		$time = date("y-m-d H:i:s");
				        $sql = "INSERT INTO message VALUES ('". $name."', '".$content."','".$time."','". $count."')";
				        if(!($con->query($sql))){
							echo "请把消息告知管理员：" . "<br>谢谢<br>";
						}
			    	}
		       }

		        $result = $con->query('SELECT * FROM message ORDER BY id DESC;');

				if(!$result) {
					die($con->connetc_error);
				}

		        while($row = $result->fetch_assoc()){
		        	echo $row['name'] . ":<br/>&nbsp;&nbsp;&nbsp;&nbsp";
		        	echo $row['content'] . "<br/>";
		        	echo "<p class='timeinfo'>" . $row['time'] . "&nbsp;&nbsp;&nbsp;&nbsp;" . $row['id'] . "楼</p><hr>";
		        }
			?>
		</div>
	</div>
<div>


</body>
</html>