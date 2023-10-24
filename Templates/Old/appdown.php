<?php 
header("Content-Type: text/html;charset=utf-8");
include_once('../../Public/config.php');
session_start();
$arr = get_query_vals('fn_user','*',array('userid'=>$_SESSION['userid'],'roomid'=>$_SESSION['roomid']));
if($arr['loginuser'] == ''){
echo '<script>window.location.href = "/Templates/Old/reg.php";</script>';
  exit;
}
//elseif($arr['money'] < 50){
//echo '<script>alert("金额小于50无法下载.."); window.location.href = "/qr.php?room='.$_SESSION['roomid'].'&g='.$_COOKIE['game'].'";</script>';
//  exit;
//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title></title> 
<style> 
</style> 

</head> 
 <style>  
    
        /*样式2*/  
        .file {  
            position: relative;  
            display: inline-block;  
            background: #D0EEFF;  
            border: 1px solid #99D3F5;  
            border-radius: 20px;  
            padding: 5%; 
          width:85%;
            height:95px; 
            overflow: hidden;  
            color: #1E88C7;  
            text-decoration: none;  
            text-indent: 0;  
            line-height: 20px;  
          font-size:45px;
        }  
        .file input {  
            position: absolute;  
            font-size: 100px;  
            right: 0;  
            top: 0;  
            opacity: 0;  
        }  
        .file:hover {  
            background: #AADFFD;  
            border-color: #78C3F3;  
            color: #004974;  
            text-decoration: none;  
        }  
    </style>
<body>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
  <br>
    <p style="font-size:38px;color: #000;margin-left:7%;">&ensp;&ensp;&ensp;你的用户名：<? echo $arr['loginuser']?></p>
    <p style="font-size:38px;color: #9e9e9e;margin-left:7%;">&ensp;&ensp;&ensp;<a href="./mimacz.php">点击重置密码</a></p>
    <p style="font-size:38px;color: #9e9e9e;">&ensp;&ensp;&ensp;<a href="/appxz/index.html" target="_blank"><img src="./images/down.png"></a></p>

  </body>

  </html>  