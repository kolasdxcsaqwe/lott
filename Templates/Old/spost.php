<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>上传收款二维码</title>


</head>
<body>

<form>

<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
include_once('7niu/up.php');
  function getfileType($file){
    return substr(strrchr($file, '.'), 1);
}
header("Content-Type: text/html;charset=utf-8");
$userid = $_POST['userid'];
$roomid = $_POST['roomid'];

    if($_FILES['qrcode']['size'] > 0){
        if ((($_FILES["qrcode"]["type"] == "image/gif") || ($_FILES["qrcode"]["type"] == "image/jpeg") || ($_FILES["qrcode"]["type"] == "image/png")) && ($_FILES["qrcode"]["size"] < 2000000)){
            if (getfileType($_FILES['qrcode']['name'])=='php'){
                exit('<script>alert("Fuck you!"); window.location.href = "/Templates/Old/tixian.php";</script>');
             }
            if ($_FILES["qrcode"]["error"] > 0){
                echo '<script>alert("上传文件出错..错误代码:' . $_FILES["qrcode"]["error"] . '"); window.location.href = "/Templates/Old/tixian.php";</script>';
            }else{
                $filename=$domain1.date('Ymd') . time() . '.' . getfileType($_FILES['qrcode']['name']);
                $qrcode = '/7niuupload/' . $filename;
                $filedir = dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))) . $qrcode;
                move_uploaded_file($_FILES["qrcode"]["tmp_name"], $filedir);
                list($ret, $err) = $uploadMgr->putFile($token, '7niuupload/'.$filename, $filedir);
                unlink(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))) .$qrcode);
            }
        }else{
           exit('<script>alert("提现二维码上传错误.."); window.location.href = "/Templates/Old/tixian.php";</script>');
        }
    }else{
        $qrcode = null;
        exit('<script>alert("提现二维码上传错误.."); window.location.href = "/Templates/Old/tixian.php";</script>');
    }
   update_query('fn_user', array('tixian' =>$uploadurl.$qrcode), array('userid'=>$userid,'roomid' => $roomid)); 
   exit('<script>alert("上传成功.."); window.location.href = "/Templates/Old/tixian.php";</script>');

    
 
?>

  </form>
   
</body>
</html>
