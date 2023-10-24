<?php

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
if($_GET['t'] == 'logout'){
    $_SESSION['agent_user'] = '';
    $_SESSION['agent_pass'] = '';
    $_SESSION['agent_room'] = '';
    echo json_encode(array("success" => true));
    exit;
}
$arr = array();
//北京赛车

$m = (int)get_query_val('fn_order', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
//幸运飞艇
$m += (int)get_query_val('fn_flyorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
$m += (int)get_query_val('fn_pcorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
//重庆时时彩
$m += (int)get_query_val('fn_sscorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
//极速赛车
$m += (int)get_query_val('fn_jsscorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
$m += (int)get_query_val('fn_jssscorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
$m += (int)get_query_val('fn_mtorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
$m += (int)get_query_val('fn_k3order', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
$m += (int)get_query_val('fn_11x5order', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
$m += (int)get_query_val('fn_smorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
$m += (int)get_query_val('fn_twk3order', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
//腾讯分分彩
$m += (int)get_query_val('fn_ffcorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
//澳洲幸运十
$m += (int)get_query_val('fn_azxy10order', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
//澳洲幸运五
$m += (int)get_query_val('fn_azxy5order', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");

//香港六合彩
$mlhc = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");
//极速六合彩
$mlhc += (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");

//百家乐
$mbjl = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and (`status` > 0 or `status` < 0)");

//北京赛车
$z = (int)get_query_val('fn_order', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//幸运飞艇
$z += (int)get_query_val('fn_flyorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
$z += (int)get_query_val('fn_pcorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//重庆时时彩
$z += (int)get_query_val('fn_sscorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//极速赛车
$z += (int)get_query_val('fn_jsscorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
$z += (int)get_query_val('fn_jssscorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
$z += (int)get_query_val('fn_mtorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
$z += (int)get_query_val('fn_k3order', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
$z += (int)get_query_val('fn_11x5order', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
$z += (int)get_query_val('fn_smorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
$z += (int)get_query_val('fn_twk3order', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//腾讯分分彩
$z += (int)get_query_val('fn_ffcorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//澳洲幸运十
$z += (int)get_query_val('fn_azxy10order', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//澳洲幸运五
$z += (int)get_query_val('fn_azxy5order', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//香港六合彩
$zlhc = (int)get_query_val('fn_lhcorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//极速六合彩
$zlhc += (int)get_query_val('fn_jslhcorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");
//百家乐
$zbjl = (int)get_query_val('fn_bjlorder', 'sum(`status`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `addtime` like '" . date('Y-m-d') . "%' and status >= 0");

$arr['zyk'] = $z+$zlhc+$zbjl - ($m+$mlhc+$mbjl);
$allsf = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and time like '" . date('Y-m-d') . "%' and status = '已处理' and type = '上分' and `jia` = 'false'");
$allxf = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and time like '" . date('Y-m-d') . "%' and status = '已处理' and type = '下分' and `jia` = 'false'");

$arr['allsf'] = $allsf . "/" . $allxf;
$arr['allprice'] = $m ."/" . $mlhc ."/" . $mbjl ;
$arr['zye'] = (int)get_query_val('fn_user', 'sum(`money`)', "`roomid` = '{$_SESSION['agent_room']}' and `jia` = 'false' and `money` > '0'");

$hastj = get_query_val('fn_everyday', 'id', " `shijian` = '".date('Y-m-d')."'");
if(!$hastj){
insert_query("fn_everyday", array("zyk" => $arr['zyk'], 'allprice' => $arr['allprice'],'allsf' => $arr['allsf'], 'zye' => $arr['zye'], 'shijian' => date('Y-m-d')));
}else {
update_query('fn_everyday', array("zyk" => $arr['zyk'], 'allprice' => $arr['allprice'],'allsf' => $arr['allsf'], 'zye' => $arr['zye']), array('shijian' => date('Y-m-d')));
}

select_query('fn_everyday', 'zyk,allprice,allsf,zye', " `shijian` = '".date("Y-m-d",strtotime("-1 day"))."'");
while($con = db_fetch_array()){
	$cons[] = $con;
}
foreach($cons as $con){
	$arr['zr_zyk'] = $con["zyk"];
	$arr['zr_allprice'] = $con["allprice"] ;
	$arr['zr_allsf'] = $con["allsf"];
	$arr['zr_zye'] = $con["zye"];
}
echo json_encode($arr);
?>