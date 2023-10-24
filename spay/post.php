<?php
header("Content-Type: text/html;charset=utf-8");
$roomid = $_POST['orderuid'];
 echo "<script> alert('充值申请已提交，请联系客服转账后，客服为您上分，祝你玩的开心！');window.location.href='http://".$_SERVER['HTTP_HOST']."/qr.php?room=$roomid';</script>";

?>