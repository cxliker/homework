
<?php
	include_once("authority.php");
	
	$con = connectDB();
					
    $sql = "SELECT * FROM Everyday_subjects ORDER BY date DESC";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();
	everyDay($row);

  	function connectDB(){
		$con = new mysqli("localhost","root","root","homework");
        if($con->connect_errno)
            die('Could not connect:'. $con->connect_error);
        $con->query("set names utf8");
        return $con;
    }

	function everyDay($row){
		$GLOBALS['message'] .= "<p>$row[date]</p>";
		$GLOBALS['subject'] = "Homework For $row[date]";
    	everySubject($row);
	}

	function everySubject($row){
		$GLOBALS['message'] .= "<ul class='details'>";
		foreach ($row as $key => $value) {
			if(!is_numeric($key) && $key != 'date' && $value == 1){
				switch ($key) {
					case 'OOP':
						$subj = "程序设计与算法";
						break;
					case 'Marx':
						$subj = "马克思注意基本原理概论";
						break;
					case 'Math':
						$subj = "线性代数";
						break;			
					case 'Computer':
						$subj = "计算机组成原理";
						break;				
					
					default:
						$subj = $key;
						break;
				}
				$GLOBALS['message'] .= "<li style='list-style:decimal'>$subj";
				everyDetails($row['date'],$key);
				$GLOBALS['message'] .= "</li>";
			}
			// else {
			// 	$GLOBALS['message'] .= "<li>$key -> $value</li>";
			// }
		}
		$GLOBALS['message'] .= "</ul>";
	}

	function everyDetails($date,$subject){
		$con = connectDB();
		$GLOBALS['message'] .= "<ul>";
		$query = "SELECT content FROM $subject WHERE date = '".$date."'";
		// $GLOBALS['message'] .= "<li>$query</li>";
		$rst = $con->query($query);
		while($row = $rst->fetch_assoc()){
			$GLOBALS['message'] .= "<li>$row[content]</li>";
		}
		$GLOBALS['message'] .= "</ul>";
	}
		
    function smtp_mail($address,$nickname, $subject,$body){    
	    require("PHPMailer-master/class.phpmailer.php");  /*一个人发*/  
	    require("PHPMailer-master/PHPMailerAutoload.php");  /*
   		 // require_once("PHPMailer-master/class.phpmailer.php"); /*群发*/
  		date_default_timezone_set('PRC');
  		$mail = new PHPMailer(); // defaults to using php "mail()"
	    $mail->IsSMTP();
	    $mail->CharSet = "UTF-8";   
	    $mail->Host = "smtp.stu.scau.edu.cn";            // SMTP 服务器 
	    $mail->SMTPAuth = true;                  // 打开SMTP 认证 
	    $mail->Username = "imcx@stu.scau.edu.cn";   // 用户名
	    $mail->Password = "IKU67AkzBMUaH55";          // 密码 

     	$mail->AddReplyTo("123989596@qq.com","ChenXiao");
	    $mail->SetFrom("imcx@stu.scau.edu.cn","xiaochan.me");
	    $mail->Subject = $subject;
	    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!";

	    // foreach ($arry as $nickname => $address) {
	    // 	  $mail->AddAddress($address,$nickname);
	    // }
		$mail->AddAddress($address,$nickname);
	    $nicknamewithhi = "<p>hi $nickname<br/>下面是今天的作业：</p>";
	    // $nicknamewithhi = "<p>hi <br/>下面是今天的作业：</p>";
	    $body = $nicknamewithhi . $body . "<p>Have a nice Day!</p>";

	   
	    // $mail->AddAddress($address,$nickname);
	    $mail->MsgHTML($body);


        if(!$mail->Send())    
        {    
            echo "邮件发送有误 <p>";    
            echo "邮件错误信息: " . $mail->ErrorInfo;    
            exit;    
        }    
        else {    
            echo "$address 邮件发送成功!<br />";    
        }    
    }    
    // 参数说明(发送到, 邮件主题, 邮件内容, 附加信息, 用户名)    
    // smtp_mail("xiao","cxliker@qq.com",$GLOBALS['subject'],$message);  

    if($_SERVER['REQUEST_METHOD'] == "GET"){
	  	// $con = connectDB();
	  	// $sql = "SELECT * FROM emails";
	  	// $result = $con->query($sql);
	  	// while($row = $result->fetch_array()){
	  	// 	// echo $row['nickname'] . $row['account'] . "<br/>";
	  	// 	$arry[$row['nickname']] = $row['account'];
	  	// }
	  	// foreach ($arry as $key => $value) {
	  	// 	# code...
	  	// 	echo $key . $value . "<br/>";
	  	// }
	  	smtp_mail($_GET['address'],$_GET['nickname'],$GLOBALS['subject'],$message);
  	}
  	else {
  		echo "error";
  	}