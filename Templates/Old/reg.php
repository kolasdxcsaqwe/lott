
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title></title> 
<script type="text/javascript" src="/Style/Home/static/js/jquery-1.9.1.min.js"></script>
</head> 
 <style>  
    body { padding:20px 20px;}
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
<p style="font-size:36px;color: #f00;">请牢记登录账号，否则无法登陆APP</p>
<p style="font-size:32px;color: #1200ff;">注册下载APP，体验真人美女百家乐!</p>
  <br>
  <form action="./regpost.php" method="post">
  <p style="font-size:24px;color: #9e9e9e;">登录账号：<input type="text" name="phone" id="phone" style="height:65px;width:60%;font-size:24px;" onkeyup="(this.v=function(){this.value=this.value.replace(/[^a-zA-Z0-9]+/,'');}).call(this)" /></p>
  <p style="font-size:24px;color: #9e9e9e;">输入密码：<input type="password" name="pass1" id="pass1" style="height:65px;width:60%;font-size:24px;" /></p> 
  <p style="font-size:24px;color: #9e9e9e;">确认密码：<input type="password" name="pass2" id="pass2" style="height:65px;width:60%;font-size:24px;" /></p>
  <br>

   <p align="center"> <button type="submit" id="loginbtn" style="height:60px;width:50%;font-size:28px;">提交</button></p>
  </form>
<script>

$(document).ready(function() {
		
		
		$('#loginbtn').click(function(){
			var myreg=/^[a-zA-Z0-9]{6,15}$/; 
			if(!myreg.test($("#phone").val())) 
			{ 
			   alert("登录账号必须为6~15位的数字或字母！");
			    return false; 
			} 
			if($("#pass1").val()!=$("#pass2").val()){
				alert("两次密码不一致！");
			    return false; 
			}		
	   });
		
	})
	
</script> 
</body>
</html>  