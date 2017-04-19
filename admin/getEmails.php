<?php
header("Content-Type:text/html;charset=utf-8");
	$admin = false;
	session_start();
	if(isset($_SESSION["admin"]) && $_SESSION["admin"] === true){
	}
	else {
		$_SESSION["admin"] = false;
		die("您无权访问");
	}


  	$con = connectDB();
  	$sql = "SELECT * FROM emails";
  	$result = $con->query($sql);
    $arr = [];
  	while($row = $result->fetch_assoc()){
        $arr[] = $row;
  	}
    // $arr[] = ['nickname'=>'cx1','account'=>'cxliker@qq.com'];
    // $arr[] = ['nickname'=>'cx2','account'=>'123989596@qq.com'];
    echo json_encode($arr);


  	function connectDB() {
		$con = new mysqli("localhost","root","root","homework");
        if($con->connect_errno)
            die('Could not connect:'. $con->connect_error);
        $con->query("set names utf8");
        return $con;
    }

?> 