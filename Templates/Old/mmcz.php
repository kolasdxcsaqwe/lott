<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

</head>
<body>

<form>

<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
header("Content-Type: text/html;charset=utf-8");
$roomid = $_SESSION['roomid'];
$userid =$_SESSION['userid']; 
$mima1 = $_POST['mima1'];
$mima2 = $_POST['mima2'];
if($mima1 == $mima2 && $mima1 != '' && $mima2 != ''){ 
    update_query('fn_user', array('loginpass' => md5($mima2)), array('userid'=>$userid,'roomid' => $roomid)); 
   echo '<script>alert("修改成功.."); window.location.href = "/Templates/Old/appdown.php";</script>';
    
    exit;
   
}else{
   echo '<script>alert("两次密码输入不一致,并且不能为空");window.location.href = "/Templates/Old/appdown.php";</script>';
  exit;
}
?>

  </form>
   
</body>
</html>
