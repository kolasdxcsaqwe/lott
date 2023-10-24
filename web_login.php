<?php include_once('Public/config.php');

$action = $_GET['action'];
if($_GET['room']){
	$_SESSION['roomid'] = $_GET['room'];	
}
$fenurl = get_query_val('fn_system','content1',array('id'=>'3'));
// var_dump(" fenurl".$fenurl);
// var_dump(" HTTP_HOST".$_SERVER['HTTP_HOST']);
// if($_SERVER['HTTP_HOST'] != $fenurl){
//   $tiao = "http://".$fenurl."/web_login.php";  
//   header("location:$tiao");
//   }
  
if($action == 'login'){
	$r = web_login();
	echo json_encode($r);
	exit();
}	
?>
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
            <form method="post" id="loginform" action="web_login.php?type=user">
                <ul class="home_url">

                    <li><div class="inputtxt"><input id="loginuser" name="loginuser" type="text" placeholder="用户名" title="用户名"></div></li>
                    <li><div class="inputtxt"><input id="loginpass" type="password" name="loginpass" placeholder="密码" title="密码"></div></li>
                  	<li><input type="checkbox" id="check">是否记住密码<br></li>
                    <li>
                        <a href="javascript:void(0);" id="btsubmit">账户登录</a>
						<!--<a href="/zhuce.php" >账户注册</a>-->
                        <input type="hidden" name="checkaccess" value="JjzbPphGwor5">
                        <input type="hidden" name="verify" value="0c3dca1fcf8c9a9ad78da38ea0bbe775">
                    </li>
                </ul>
            </form>
        </div>
        <script>
            $(function(){
                $('#btsubmit').click(function(){
                    var urlstrings=$("#loginform").serialize();
                    $.post('web_login.php?action=login',urlstrings,function(data){
                    	console.debug(data);
                    	if(data == 'false'){
                    		alert('请检查帐号或者密码');
                    		window.location.reload(true);
                    	}else{
                    		window.location.href='qr2.php?room=<?php echo $_SESSION['roomid']?>';
                    	}
                    })
                });
            });
        </script>

<script>
  var loginuser = document.getElementById('loginuser');
		var loginpass = document.getElementById('loginpass');
		var check = document.getElementById('check');
		var btsubmit = document.getElementById('btsubmit');
		// 获取设置的本地存储的用户名的值
		var lologinuser = localStorage.getItem('loginuser');
		// 获取设置的本地存储的密码的值
		var loPass = localStorage.getItem('pass');
		// 将本地存储的值设置给用户名和密码
		loginuser.value= lologinuser;
		loginpass.value = loPass;
		// 判断本地存储值不为空的时候将勾选的checked设置为空
		if(lologinuser!==''&&loPass!==''){
			check.setAttribute('checked','');
		}
		btsubmit.onclick=function(){
			if(check.checked){
				// alert("选中");
				// 勾选框勾选的时候设置本地的用户名和密码的val为输入的值
				localStorage.setItem('loginuser',loginuser.value);
				localStorage.setItem('pass',loginpass.value);
			}else{
				// alert('未勾选');
				// 勾选框未勾选的时候设置本地的用户名和密码为空
				localStorage.setItem("loginuser","");
            	localStorage.setItem("pass","");
			}
		}

  </script>

    

</body></html>