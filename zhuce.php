<?php
include_once('Public/config.php');
header("Content-type:text/html;charset=utf-8");
if(empty($_GET['room'])){
 
	$_GET['room'] = $_SESSION['roomid'];
}
if($_POST){
$dsn = 'mysql:dbname=wdfgt_yodo8_cn;host=127.0.0.1';
$user = 'wdfgt_yodo8_cn';
$password = 'wdfgt_yodo8_cn';
try{
$pdo = new pdo($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')
);
}catch(Exception $e){
echo '错误'.$e->getmessage();
}

$userid = md5($_POST['name']);
$username = $_POST['name'];
$roomid = $_SESSION['roomid'];
$name = $_POST['name'];
$pwd = md5($_POST['pwd']);
$isagent = 'false';
$jia = 'false';
$headimg = $_POST['headimg'];
//验证注册是否为空账号密码
if($name==''||$pwd==''||$headimg==''){ 
echo "<script>alert('用户名和密码/头像不能为空！请重新输入！');location.href='zhuce.php';</script>";
exit;
}
//验证账号是否重复
$name1 = $_POST['name']; 
$result = mysql_query("SELECT username FROM fn_user WHERE username = '$name1'"); 
$num_rows = mysql_num_rows($result); 
if($num_rows == 1){
echo "<script>alert('该用户名已被注册！');location.href='zhuce.php';</script>";
exit;
}else{
$sql = "insert into fn_user (userid,username,roomid,loginuser,loginpass,isagent,jia,headimg) values ('$userid','$username','$roomid','$name','$pwd','$isagent','$jia','$headimg')";
$exec = $pdo->query($sql);
if($exec){
echo "<script>alert('注册成功！');location.href='web_login.php'</script>";
}else{
echo "<script>alert('注册失败,请重试。');location.href='zhuce.php'</script>";
}
}
}

?>
<style> 
.btn{ width: 182px;
height: 46px;
background: #ccc;
border: 1px solid #eee;
border-radius: 15px;
/*//圆角设置 */
} 
</style>
<style>
.rds{
    font-size: 45px;
}
/*.rds input{*/
/*    display: none;*/
/*}*/

/*.rds label{*/
/*    background: url("/Style/images/0.png") no-repeat 0 3px/18px;*/
/*    margin-right: 25px;*/
/*    padding-left: 20px;*/
/*}*/
#headimg0 {
	background: url("/Style/images/0.png") no-repeat 0 3px/55px;
    margin-right: 5px;
    padding-left: 55px;
}
#headimg1 {
	background: url("/Style/images/1.png") no-repeat 0 3px/55px;
    margin-right: 5px;
    padding-left: 55px;
}
</style>
<html lang="zh-cn"><head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="format-detection" content="telephone=no">
        <meta name="msapplication-tap-highlight" content="no">
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1">
        <title>欢迎光临</title>
        <script type="text/javascript" src="Style/Home/static/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="Style/Home/images/chatmsg.js"></script>
        <link rel="stylesheet" type="text/css" href="Style/Home/images/main.css" />
        <link rel="stylesheet" type="text/css" href="Style/Home/images/home.css" />
        </head>
    <body>
        <div class="back-main">
        	<form action='zhuce.php' method='post'>
                <ul class="home_url">
                    <div align="center" style="margin-top:-50%;"><img src="/upload/bdkjlogo.jpg" style="width:50%" /></div>
                    <li><div class="inputtxt"><input name="name" type="text" placeholder="用户名" title="用户名"></div></li>
                    <li><div class="inputtxt"><input type="password" name="pwd" placeholder="密码" title="密码"></div></li>
                    <li>
                    	<!--//设置头像-->
                    	<div class="rds">
                    	<!--<center><span>选择头像</span></center>-->
                    	<label id="headimg0"><input  name='headimg' type="radio" value="/Style/images/0.png"></label>
                    	<label id="headimg1"><input  name='headimg' type="radio" value="/Style/images/1.png"></label>
                    	</div>
                    </li>
                    <li>
	                    <br/>
	                    <div >
	                    	<input type='submit' value='注册' class="btn">	
	                    </div>
                    </li>
                </ul>
            </form>
        </div>
        
        
        
	</body>
</html>