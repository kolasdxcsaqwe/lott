<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$roomid= $_POST['roomid'];

//沉淀用户清理
delete_query('fn_user',"`roomid` = $roomid && `tixian` = '' && `money` = '0.00'");
echo json_encode(array("success" => true, "msg" => "清空用户成功"));
exit;
 

?>