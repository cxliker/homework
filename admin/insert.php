<?php include_once("authority.php"); ?>
header("Content-Type:text/html;charset=utf-8");
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>

<script type="text/javascript">
	function addDetails(){
		var value = parseInt($('#ct').attr("value")) + 1;
		$('#ct').attr("value",value);
		$("form").append("第" + value +"条：<textarea name='details[]'' rows='5' cols='50'></textarea><br/><br/>");
	}
</script>


<a style="text-align:right"href="default.php">返回</a>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	日期：<input type="text" name="date"><br/><br/>
	科目：<!-- <input type="text" name="subject"><br/><br/> -->
	<select name="subject">
		<option value="IBM_PC">汇编</option>
		<option value="Math">线性代数</option>
		<option value="Marx">马概</option>
		<option value="Operating_System">操作系统</option>
		<option value="Computer">计算机组成原理</option>
		<option value="OOP">OOP</option>
	</select>
	<input id="ct" type="hidden" name="ct" value="3">
	<button type="button" onclick="addDetails()">加作业</button>
	<button type="button" onclick="addSubject()">加科目</button>
	<input type="submit"><br/><br/>
	第一条：<textarea name="details[]" rows="5" cols="50"></textarea><br/><br/>
	第二条：<textarea name="details[]" rows="5" cols="50"></textarea><br/><br/>
	第三条：<textarea name="details[]" rows="5" cols="50"></textarea><br/><br/>
</form>


<?php

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$con = new mysqli("localhost","root","root","homework");
	    if($con->connect_errno)
	        die('Could not connect:'. $con->connect_error);

	    $con->query("set names utf8");

	    $sql_insert = "INSERT INTO Everyday_subjects (date, $_POST[subject]) VALUES ('" .$_POST['date'] ."','1')";
	    $sql_update = "UPDATE Everyday_subjects set $_POST[subject] = '1' where date = '" . $_POST['date'] ."'";

	    $query = "SELECT date FROM Everyday_subjects WHERE date = '". $_POST['date'] ."' limit 1";
	    $rst = $con->query($query);
	    $row = $rst->fetch_assoc();
	    if($row) {
	    	if($con->query($sql_update)){
	    		echo "table1 成功<br/>";
	    	}
	    	else {
	    		echo "table1 失败:"  . "</br>";
	    	}
	    }
	    else{
	    	if($con->query($sql_insert)){
	    		echo "table1 成功<br/>";
	    	}
	    	else{
	    		echo "table1 失败:"  . "</br>";
	    	}
	 
	    }

	    $ct = $_POST['ct'];
	    for($i=0;$i<$ct;$i++){
	    	$str = trim($_POST['details'][$i]);
	    	if(!empty($str)){
		    	$sql_insertforsub = "INSERT INTO $_POST[subject] VALUES ('".$_POST['date']."', '".$_POST['details'][$i]."')";
		    	if($con->query($sql_insertforsub)){
		    		echo "第$i 条成功<br/>";
		    	}
		    	else{
		    		echo "第$i 条失败<br/>";
		    	}
	    	}
		
		}
	}
?>