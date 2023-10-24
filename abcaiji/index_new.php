<?
header("Content-type:text/html;charset=utf-8");
echo "<br><span style='color:red;'>百家乐</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

?>
<html>
<head></head>
<body>
     <p>封盘倒计时</p>
	<iframe src="bjl.php"></iframe>
     <p>开奖倒计时</p>
	<iframe src="index_bjl_kai.php"></iframe>



</body>
</html>
