<?php
include_once('../Public/config.php');
if($_GET['kf'] != 'lywl'){
   echo 'error'; exit;
}
$riqi = date("Y-m-d", strtotime('+1 month')).' 23:59:59';
$room = get_query_val('fn_room',"roomid",'`roomid`>0 order by `roomid` desc limit 1');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>代理开房间</title>
</head>
<body>
  
	<form action="post.php" method="post">
	<p>账号:</p>
	<p><input type="text" name="username" value="输入账号" /></p>
	<p>密码:</p>
	<p><input type="text" name="password" value="输入密码" /></p>
	<p>房间号:</p>
	<p><input type="text" name="roomid" value="<? echo $room+1;?>" /></p>
	<p>到期日期:</p>
	<p><input type="text" name="enddate" value="<?php echo $riqi?> "/></p>
    <?php echo '最后申请房间号为：'.$room;?>  
	<button type="submit">提交</button>
	</form>
	
</body>
</html>
