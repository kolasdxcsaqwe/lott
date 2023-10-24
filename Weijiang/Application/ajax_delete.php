<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$time = $_POST['time'];
$pass = $_POST['pass'];
$roomid =$_POST['roomid'];
if($pass != '123123'){
    echo json_encode(array('success' => false, 'msg' => '验证安全码错误!请联系管理员进行该操作'));
    exit;
}
db_query("TRUNCATE fn_chat");
//客服表清理
delete_query('fn_custom',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
//客户投注记录
delete_query('fn_order',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_flyorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_pcorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_sscorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_mtorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_jsscorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_jssscorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_k3order',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_bjlorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_11x5order',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_smorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_lhcorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_jslhcorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_twk3order',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_ffcorder',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
delete_query('fn_marklog',"`addtime` < '$time 23:59:59' and `roomid` = $roomid");
//上下分记录
delete_query('fn_upmark',"`time` < '$time 23:59:59' and `roomid` = $roomid");
//飞单记录
delete_query('fn_feiorder',"`time` < '$time 23:59:59' and `roomid` = $roomid");
/**
delete_query('fn_custom',"`addtime` < '$time 23:59:59'");
delete_query('fn_open',"`time` < '$time 23:59:59'");
delete_query('fn_order',"`addtime` < '$time 23:59:59'");
delete_query('fn_flyorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_pcorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_sscorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_mtorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_jsscorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_jssscorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_k3order',"`addtime` < '$time 23:59:59'");
delete_query('fn_bjlorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_11x5order',"`addtime` < '$time 23:59:59'");
delete_query('fn_smorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_lhcorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_jslhcorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_twk3order',"`addtime` < '$time 23:59:59'");
delete_query('fn_ffcorder',"`addtime` < '$time 23:59:59'");
delete_query('fn_marklog',"`addtime` < '$time 23:59:59'");
delete_query('fn_sopen',"`time` < '$time 23:59:59'");
//开奖记录
delete_query('fn_upmark',"`time` < '$time 23:59:59'");
delete_query('fn_feiorder',"`time` < '$time 23:59:59'");
**/

echo json_encode(array("success" => true, "msg" => "删除成功"));
exit;
?>