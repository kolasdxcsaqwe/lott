<?php header("Content-Type: text/html;charset=utf-8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>00</title> 
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
  <p style="font-size:38px;color: #9e9e9e;margin-left:7%;">APP登录密码重置</p>
<form action="mmcz.php" method="post" class="smart-green" enctype="multipart/form-data">
  <p style="font-size:35px;margin-left:7%;">输入新密码：<input type="text" name="mima1" style="width:80%;height:80px;font-size:45px;margin-right:20px;"></p>

  <p style="font-size:35px;margin-left:7%;">重新输入密码：<input type="text" name="mima2" style="width:80%;height:80px;font-size:45px;margin-right:20px;"></p>

<br><br><br><br>
<input type="submit" style="width:80%;height:80px;font-size:45px;margin-right:20px;margin-left:7%;">
  <br>
  </form>

  
  </body>
  </html>  