<?php include_once("authority.php"); ?>
header("Content-Type:text/html;charset=utf-8");
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.0.js"></script>
<script>
	$.getJSON("getEmails.php", function(data) {
		var i = data.length;
		var tbody = $("tbody");
		while (i--) {
			tbody.append("<tr><td>"+data[i].account+"</td><td>"+data[i].nickname+"</td></tr>");
		}
		$("#send").click(function () {
			i = data.length;
			while (i--) {
				$.get("sendmail.php",{
					address: data[i].account,
					nickname: data[i].nickname
				},function (data) {
					$("#message").append(data);
				});
			}
		});
	})
</script>
<a style="text-align:right"href="default.php">返回</a>
<table>
	<colgroup>
		<col width="50%">
		<col width="50%">
	</colgroup>
	<thead>
		<tr>
			<th>邮箱地址</th>
			<th>昵称</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>
<button id="send">发送</button>
<div id="message"></div>