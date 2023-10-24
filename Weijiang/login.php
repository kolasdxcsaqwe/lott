<?php

if(stripos($_SERVER['HTTP_USER_AGENT'], "micromessenger")==true){
	require "../Templates/error.php";
	exit;
}

include_once("../Public/config.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>后台管理 | 登录</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page" style="background-size:100%;background:url(upload/htdlbj.jpg);background-size: cover cover;">
<br/>
<center>
  <div align="left" id="error" class="alert alert-warning alert-dismissible" style="width:80%;display:none">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-warning"></i> 警告</h4>
      <span id="errorcontent"></span>
  </div>
</center>
<div class="login-box">
  <div class="login-logo">
    <a href="#" style="color:#fff">后台管理系统</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input id="user" name="user" type="text" class="form-control" placeholder="账号" value="<?php if($_COOKIE['agentuser'] != "")echo $_COOKIE['agentuser'];?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="pass" name="pass" type="password" class="form-control" placeholder="密码" value="<?php if($_COOKIE['agentpass'] != "")echo $_COOKIE['agentpass'];?>">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <input id="room" name="room" type="number" class="form-control" placeholder="安全码" value="" >

      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" data-toggle="tooltip" data-original-title="我们将保存您的Cookies10天">
            <label>
              <input name="check" type="checkbox" > 记住我的登录
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="loginbtn" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>-更多-</p>
      <a href="https://www.v9ym.com/" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-shopping-cart"></i>转载转载www.v9ym.com</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-tachometer"></i> 仅供学习研究代码，请勿做违法活动！</a>
    </div>
  </div>
  <!-- /.login-box-body -->
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="dist/js/app.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  $('#loginbtn').click(function(){
      var user = $('#user').val();
      var pass = $('#pass').val();
      var room = $('#room').val();


      if(user == "" || pass == "" || room == ""){
          alert('请填写完登录表单');
          return;
      }else{
          $('#loginbtn').submit();
      }
  })
  function displayerror() {
      $('#error').fadeOut(1200);
  }
</script>
</body>
<?php if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    $username = $_POST['user'];
    $password = $_POST['pass'];
    $room = $_POST['room'];

    if(get_query_val("fn_room", "roomid", array("roomid" => $room)) == ""){
        ?>
        <script>
            $('#error').fadeIn(1200)
            $('#errorcontent').html('错误代码001，请联系管理员');
            setTimeout(function() {
                displayerror();
            }, 4000);
        </script>
<?php return;
    }elseif(get_query_val("fn_room", "roomadmin", array("roomid" => $room)) != $username){
        ?>
        <script>
            $('#error').fadeIn(1200)
            $('#errorcontent').html('您的账号或者密码不正确');
            setTimeout(function() {
                displayerror();
            }, 2000);
        </script>
<?php return;
    }elseif(get_query_val("fn_room", "roompass", array("roomid" => $room)) != md5($password)){
        ?>
        <script>
            $('#error').fadeIn(1200)
            $('#errorcontent').html('您的账号或者密码不正确');
            setTimeout(function() {
                displayerror();
            }, 2000);
        </script>
<?php return;
    }elseif(strtotime(get_query_val("fn_room", "roomtime", array("roomid" => $room))) < time()){
        ?>
        <script>
            $('#error').fadeIn(1200)
            $('#errorcontent').html('您盘口已过期，请联系管理续费');
            setTimeout(function() {
                displayerror();
            }, 2000);
        </script>
<?php return;
    }else{
      
        $_SESSION['agent_user'] = $username;
        $_SESSION['agent_pass'] = md5($password);
        $_SESSION['agent_room'] = $room;
$agentt = strtolower($_SERVER['HTTP_USER_AGENT']);
if(strpos($agentt, 'android')){
$shebei = '安卓';
}elseif(strpos($agentt, 'iphone') || strpos($agentt, 'ipad')){
$shebei = '苹果';
}else{
$shebei = '电脑网页';
}      
        $ip = ip();
        insert_query('fn_roomlog',array('roomid'=>$room,'ip'=>$ip,'time'=>date('Y-m-d H:i:s',time()),'shebei'=>$shebei));
        header("Location:index.html?t=".time());
        exit;
    }
}
 function ip() {
   
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    return $res;
    
}
function city($ip){
$json=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
$arr=json_decode($json);
$gj = $arr->data->country;    //国家
$qy = $arr->data->area;    //区域
$sf = $arr->data->region;    //省份
$city = $arr->data->city;    //城市
$yys = $arr->data->isp;    //运营商
  if($gj == ''){
  $gj = '--';
  }
  if($qy == ''){
  $qy = '--';
  }
  if($sf == ''){
  $sf = '--';
  }
  if($city == ''){
  $city = '--';
  }
  if($yys == ''){
  $yys = '--';
  }
 return $gj.'|'.$sf.'|'.$qy.'|'.$city.'|'.$yys;
} 
?>
</html>
