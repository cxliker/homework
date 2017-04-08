
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

	#header-nav a {
	    text-decoration: none;
	    /*font-weight: 800;*/
	    /*font-size: 25px;*/
	}

	#header-nav a:link, a:visited {
	    color: black;
	}

	#header-nav a:hover, a:active {
	    color: darkgreen;
	}


	body{
		padding:0;
		margin: 0;
	}

	#main{
		width: 90%;
		margin:0 auto;
		padding-top: 80px;
	}

	#homework-content{
		width: 55%;
		overflow: hidden;
		/*background: lightblue;*/
		float: left;
	}

	#window-header{
	 	position: fixed;
	    z-index: 100;
	    width: 100%;

	    background-color: #fff;
	    border-bottom: 1px solid rgba(30,35,42,.06);
	    box-shadow: 0 1px 3px 0 rgba(0,34,77,.05);
	    background-clip: content-box;
	    height: 70px;
	    overflow: hidden;
	}

	#header-content {
		width: 90%;
		margin: 0 auto;
		min-width: 784px;
	}

	#header-nav li{
		list-style: none;
		display: inline-block;
		padding: 0 15px;
	}

	h1{
		margin-top: 15px;
		margin-left: 30px;
	}

	#title , #sub-title {
		position: absolute;
		transition: top 0.5s;
		-moz-transition: top 0.5s; /* Firefox 4 */
		-webkit-transition: top 0.5s; /* Safari 和 Chrome */
		-o-transition: top 0.5s; /* Opera */
	}

	#title{
		top:0;
	}

	#sub-title{
		top: 54px;
	}

	#header-nav{
		float: right;
		margin-top:10px;
	}

	.details > li{
		list-style: decimal;
	}

	img{
		width: 450px;
		height: 300px;
	}

	#background{
	  width: 100%;
	  height: 100%;
	  position: fixed;
	  top: 0;
	  left: 0;
	  z-index: -1;
	}

</style>

<script type="text/javascript">
	$(function(){

		  var op1 = $(document).scrollTop();
            $(window).scroll(function () {
                var op2 = $(document).scrollTop();
                if(!(!!window.ActiveXObject || "ActiveXObject" in window)){
                    if(op2 > op1){
                        $("#title").css("top","-54px");
                        $("#sub-title").css("top","0");
                    }
                    else {
                        $("#title").css("top","0");
                        $("#sub-title").css("top","54px");
                    }
                }
                op1 = $(document).scrollTop();
            });

		$.post("sortbydate.php", function(data) {
				$("#list").html(data);
		});
		$("#sortbydate").click(function() {
			$.post("sortbydate.php", function(data) {
				$("#list").html(data);
			});
			$("#sub-title").html("按日期分类");
			return false;
		});
		$("#sortbysubject").click(function() {
			$.post("sortbysubject.php", function(data) {
				$("#list").html(data);
			});
			$("#sub-title").html("按科目分类");
			return false;
		})
		

	});

</script>


<body>
	<!--<img id="background" src="images/sky.jpg" />-->
	<div id="window-header">
		<div id="header-content">
			<h1 id="title">计机4班作业通知网</h1>
			<h1 id="sub-title">按日期分类</h1>
			<div id="header-nav">
				<ul>
					<li><a href="#1" id="sortbysubject">按科目分类</a></li>
					<li><a href="#2" id="sortbydate">按日期分类</a></li>
					<li><a href="/files">资料下载站</a></li>
					<li><a href="http://xiaochan.me">返回主页</a></li>
				</ul>
			</div>
		</div>
	</div>	
	<div id="main">
		<div id="homework-content">
			<form id="emailForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				邮箱*：<input type="text" name="email">昵称：<input type="text" name="nickname"><br/><br/>
				<input type="submit" value="每当有新作业用邮件提醒我">
				<!--<input type="hidden" name="originator" value="<?=$code?>">-->
			</form>
			<?php
				if(isset($_GET['s'])){
					switch ($_GET['s']) {
						case '0':
							echo "<p style='color:red'>*登记成功，每当有新作业便会通知您！*</p>";
							break;
						
						case '1':
							echo "<p style='color:red'>*邮箱不能为空*</p>";
							break;

						case '2':
							echo "<p style='color:red'>*邮箱名不合法*</p>";
							break;

						case '3':
							echo "<p style='color:red'>*登记失败，请联系管理员*</p>";
							break;
					}
				}

				if($_SERVER['REQUEST_METHOD'] == "POST"){
					$con = connectDB();
					$email = trim($_POST['email']);
					$email = htmlspecialchars($email);
					$nickname = trim($_POST['nickname']);
					$nickname = htmlspecialchars($nickname);
					if(empty($email)){
						echo "<script>location.href='.?s=1'</script>";
					}else if(!emailCheck($email)){
						echo "<script>location.href='.?s=2'</script>";
					}else{
						$sql = "INSERT INTO emails VALUES ('" . $email . "','" . $nickname . "')";
						if($con->query($sql)){
							echo "<script>location.href='.?s=0'</script>";
						}
						else
							echo "<script>location.href='.?s=3'</script>";
					}
				}

				function emailCheck($field){
					$field = filter_var($field, FILTER_SANITIZE_EMAIL);
					if(filter_var($field,FILTER_VALIDATE_EMAIL)){
						return true;
					}else{
						return false;
					}
				}
			?>
			<ul id="list">
			</ul>
		</div>
		<iframe style="margin-top:20px; position: fixed;" frameborder="0" width="44%" height="100%" scrolling="auto" src="message-board.php"></iframe>
	</div>



</body>
</html>


