<?php header("Content-Type: text/html;charset=utf-8");
$userid = $_GET['userid'];
$roomid = $_GET['roomid'];
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
  <p style="font-size:38px;color: #9e9e9e;margin-left:2%;">请上传您的【支付宝】或【微信】收款二维码&ensp;&ensp;&ensp;&ensp;<br>不要设定金额,大额建议使用支付宝</p>
<form action="spost.php" method="post" class="smart-green" enctype="multipart/form-data" style="margin-left:2%;">
    <input type="file" name="qrcode"class="file" value="选择文件"/>   
    <input type="text" name="roomid" style="display:none" value="<?php echo $roomid; ?>" /> 
    <input type="text" name="userid" value="<?php echo $userid; ?>" style="display:none;"/>
<br><br><br><br>
<input type="submit" class="button" value="上传" onclick="check(this.form)"style="margin-left:20px;margin-right:20px;width:85%;height:95px;font-size:45px;" />
</form>
  <br>
  <p style="font-size:38px;color: #9e9e9e;margin-left:2%;">微信样板：&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;支付宝样板：</p>
  <img src="./weixin.png" style="width:40%;height:500px;margin-left:2%;">

  <img src="./zhifubao.jpg" style="width:40%;height:500px;margin-left:40px;">
  <br>
  <p style="font-size:38px;color: red;">支付宝如何找到收款二维码？：</p>
  <p style="font-size:38px;color: #9e9e9e;">1、在【支付宝】点击右上角 + </p>
  <p style="font-size:38px;color: #9e9e9e;">2、点击【收钱】 </p>
  <p style="font-size:38px;color: #9e9e9e;">3、保存收款码【保存图片】 </p>
  <br>
   <p style="font-size:38px;color: red;">微信如何找到收款二维码？：</p>
  <p style="font-size:38px;color: #9e9e9e;">1、在【微信】点击右上角 + </p>
  <p style="font-size:38px;color: #9e9e9e;">2、点击【收付款】 </p>
  <p style="font-size:38px;color: #9e9e9e;">3、点击【二维码收款】 </p>
  <p style="font-size:38px;color: #9e9e9e;">4、保存收款码【保存图片】 </p>
  
  </body>
  </html>  