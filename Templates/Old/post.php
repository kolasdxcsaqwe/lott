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
  function getfileType($file){
    return substr(strrchr($file, '.'), 1);
}
header("Content-Type: text/html;charset=utf-8");
$userid = $_POST['userid'];
$roomid = $_POST['roomid'];
$kaihu = $_POST['kaihu'];
$huming = $_POST['huming'];
$kahao = $_POST['kahao'];  
   $ok = update_query('fn_user', array('yinhang' => $kaihu,'huming'=>$huming, 'kahao'=>$kahao), array('userid'=>$userid,'roomid' => $roomid)); 
    if($ok != false){
   
   echo '<script>alert("添加成功.."); window.location.href = "/Templates/Old/yinhang.php";</script>';
    
    }else{
       echo '<script>alert("添加失败.."); window.location.href = "/Templates/Old/yinhang.php";</script>';
    exit;
    }
 
?>

  </form>
   
</body>
</html>
