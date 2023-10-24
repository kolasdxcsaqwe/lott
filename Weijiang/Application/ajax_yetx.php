<?php
//作者：QQ 1878336950 
//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(__FILE__))).'/Public/config.php');
$money = round(get_query_val('fn_room','money',"roomid = {$_SESSION['agent_room']}"));


$yue = $_POST['yue'];
$shiji = $_POST['shiji'];
$feilv = $_POST['feilv'];
$fangshi = $_POST['fangshi'];
if($fangshi == 'yinhangka'){
$qudao1 = get_query_vals('fn_room','*',array('roomid'=>$_SESSION['agent_room']));
  $huming = $qudao1['yinhang'];
  $kahao = $qudao1['yinhanghao'];
  $yinhang = $qudao1['kaihuhang'];
  $qudao = $huming.'/'.$kahao.'/'.$yinhang;
}elseif($fangshi == 'zhifubao'){
$qudao = get_query_val('fn_room','zhiewm',array('roomid'=>$_SESSION['agent_room']));
}elseif($fangshi == 'weixin'){
$qudao = get_query_val('fn_room','weiewm',array('roomid'=>$_SESSION['agent_room']));
}
$time = date("Y-m-d H:i:s",time());
$cha = round($yue)-$money;
if(round($yue) <= '0'){
echo json_encode(array('status'=>false,'msg' => '余额为零，无法提现'));
exit;  
}elseif($cha != '0'){
echo json_encode(array('status'=>false,'msg' => '提现金额不对'));
exit; 
  
}else{ 
  insert_query('fn_tixian',array('roomid'=>$_SESSION['agent_room'],'feilv'=>$feilv, 'shiji'=>$shiji ,'status'=>'未处理','money'=>$yue,'titime'=>$time, 'fangshi'=>$fangshi, 'qudao'=>$qudao));
  update_query('fn_room',array('money'=>$cha),array('roomid'=>$_SESSION['agent_room']));  
echo json_encode(array('status'=>true,'msg' => '已提现，等待财务处理'));
exit; 
}


?>