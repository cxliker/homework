
<html>
<head>
	<title>homework</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="js/jquery-3.2.0.min.js"></script>
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

	#header-nav a:link, a:visited{
	    color: black;
	}

	#header-nav a:hover, a:active{
	    color: darkgreen;
	}


	body{
		padding:0;
		margin: 0;
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

	#header-content{
		width: 90%;
		margin: 0 auto;
		min-width: 1024px;
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

	#content{
		padding-top: 70px;
		width: 100%;
		margin:0 auto
	}

	.details > li{
		list-style: decimal;
	}

	img{
		width: 500px;
		height: 300px;
	}

	table {
		width: 100%;
	    border: 1px solid #aaa;
	    border-left: 0px;
	    border-right: 0px;
	    /*float: left;*/
	    margin-bottom: 20px;
	}

	tr.even {
	    background:#EEE;
	}
	table th,td {
	    padding: 0em 0.6em;
	    height: 1.8em;
	}
	th {
	    text-align:left;
	    font-weight:bold;
	    background:#EEE;
	    border-bottom:1px solid #aaa;
	}
	table a {
	    color: rgb(0, 0, 205);
	    text-decoration: none;
	}
	
	table a:visited{
	    color: blue;
	}

	table a:hover {
	    text-decoration: underline;
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

	});


</script>


<body>
	<div id="window-header">
		<div id="header-content">
			<h1 id="title">计机4班作业通知网</h1>
			<h1 id="sub-title">资料下载站</h1>
			<div id="header-nav">
				<ul>
					<li>按科目分类</li>
					<li><a href="/">按日期分类</a></li>
					<li><a href="/files">资料下载站</a></li>
					<li><a href="http://xiaochan.me">返回主页</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div id="content">
		
		<table cellpadding="0" cellspacing="0">
			<colgroup>
				<col width="50%">
				<col width="25%">
				<col width="25%">
			</colgroup>
			<thead>
				<tr>
					<th>文件名</th>
					<th>大小</th>
					<th>上次更新时间</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$arr = getSortDir(".");
					$ct = 1;
					$nDirCt = 0;
					foreach($arr as $file){
			        	$nfile = mb_convert_encoding ($file,'UTF-8','GBK'); 
			        	// windows
			        	$path =  "./" . $file;

			        	if(is_dir($path)){
							if($ct%2==0) $className = "even";
							else $className = "odd";
							echo "<tr class = $className>";
			        		echo "<td><a href='$path'>" . $file ."/</a></td>";
			        		// echo "<td><a href='$path'>" . $nfile ."/</a></td>";
			        		echo "<td>dir</td>";
			        		// echo "<td> 2017-08-09 </td>";
							date_default_timezone_set("Asia/Shanghai");
							echo "<td>" . date("Y-m-d H:i:s", filemtime($path)) . "</td>";
							echo "</tr>";
			        		$ct++;
			        	} else {
			        		if($file !== "index.php")
			        			$nDirArr[$nDirCt++] = $file;
			        	}
				    }

				    asort($nDirArr);
				    foreach($nDirArr as $file){
				    	if($ct%2==0) $className = "even";
							else $className = "odd";

				    	$nfile = mb_convert_encoding ($file,'UTF-8','GBK'); 
			        	// windows
			        	$path =  "./" . $file;
			        	echo "<tr class = $className>";
			        	echo "<td><a href='$path'>" . $file . "</a></td>";
			        	// echo "<td><a href='$path'>" . $nfile . "</a></td>";
			        	echo "<td>" . getFileSize($path) ."</td>";
			        	date_default_timezone_set("Asia/Shanghai");
						echo "<td>" . date("Y-m-d H:i:s", filemtime($path)) . "</td>";
						echo "</tr>";
			        	$ct++;
				    }

				?>
			</tbody>
		</table>

		<?php 

			function getFileSize($path)
			{
				$bytes = filesize($path);
			    $bytes = floatval($bytes);
			        $arBytes = array(
			            0 => array(
			                "UNIT" => "TB",
			                "VALUE" => pow(1024, 4)
			            ),
			            1 => array(
			                "UNIT" => "GB",
			                "VALUE" => pow(1024, 3)
			            ),
			            2 => array(
			                "UNIT" => "MB",
			                "VALUE" => pow(1024, 2)
			            ),
			            3 => array(
			                "UNIT" => "KB",
			                "VALUE" => 1024
			            ),
			            4 => array(
			                "UNIT" => "B",
			                "VALUE" => 1
			            ),
			        );

			    foreach($arBytes as $arItem)
			    {
			        if($bytes >= $arItem["VALUE"])
			        {
			            $result = $bytes / $arItem["VALUE"];
			            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
			            break;
			        }
			    }
			    return $result;
			}

			function getSortDir($dir){
				$handler = opendir($dir);
				$i = 0;
				$arr = array();
				while(($file = readdir($handler)) !== false) {
					if($file != "." && $file != ".."){
						$arr[$i] = $file;
						$i++;
					}
				}
				closedir($handler);  
				asort($arr);
				return $arr;
			}

			function printInfo($dir){
				$arr = getSortDir($dir);
				echo "<ul>";
				foreach($arr as $file){
		        	// $nfile = mb_convert_encoding ($file,'UTF-8','GBK'); 
		        	// windows
		        	$path = $dir . "/" . $file;

		        	if(is_dir($path)){
		        		echo "<li><a href='$path'>" . $file ."/</a>";
		        		// echo "<li>" . $nfile;
		        		// printInfo($path);
		        		echo "</li>";
		        	}
			    }  
			    echo "</ul>";
			}



			// printInfo(".");
			
			function prin($dir){
				$files = scandir($dir);
				if($files == false)
					echo "hello";
				echo "<ul>";
				var_dump($files);
				print_r($files);
				foreach($files as $file){
					echo $file;
					if($file != "." && $file != "..") {
						// $nfile = mb_convert_encoding ($file,'UTF-8','GBK'); 
			        	// windows
			      
			        	$path = $dir . "/" . $file;
			        	echo $path;

			        	if(is_dir($path)){
			        		echo "<li>" . $file;
			        		// echo "<li>" . $nfile;
			        		prin($path);
			        		echo "</li>";
			        	}
			        	else{
			        		echo "<li><a href='$path'> " . $file . "</a></li>";
			        		// echo "<li><a href='$path'> " . $nfile . "</a></li>";

			        	}
					}
				}
				echo "</ul>";

			}

			// prin("images");

		      
		?>
	</div>

</body>
</html>