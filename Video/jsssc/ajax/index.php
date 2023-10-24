<?php	
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
include_once('../../../Public/config.php');
$type = '8';
$roomid = $_SESSION['roomid'];
$kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
$pre_open = get_query_vals('fn_sopen', '*', "`type` = '$type' and `roomid` = '$roomid'order by `term` desc limit 1");
if($kong == '1' && $pre_open ){
$json = get_query_vals('fn_sopen', '*', "`type` = '$type' and `roomid` = '$roomid'order by `term` desc limit 1");
  $code = $json['code'];
  $term = $json['term'];
  $opentime = $json['opentime'];
  $next_term = $json['next_term'];
  $next_time = $json['next_time'];
}else{
$json = get_query_vals('fn_open', '*', "`type` = '$type' order by `term` desc limit 1");
   $code = $json['code'];
  $term = $json['term'];
  $opentime = $json['time'];
 $next_term = $json['next_term'];
 $next_time = $json['next_time'];
}  

$code = explode(',',$code);
$codes = (int)$code[0].(int)$code[1].(int)$code[2].(int)$code[3].(int)$code[4];
$count = strtotime($next_time) - time();
$sumNum = (int)$code[0] + (int)$code[1] + (int)$code[2] + (int)$code[3] + (int)$code[4];
$ds = $sumNum % 2 != 0 ? '单' : '双';
$dx = $sumNum > 22 ? '大':'小';
if($code[0] > $code[4]){
	$lh = '龙';
}elseif($code[0] < $code[4]){
	$lh = '虎';
}elseif($code[0] == $code[4]){
	$lh = '和';
}

echo json_encode(array('code'=>$codes,'term'=>$term,'nexttime'=>$next_time,'count'=>$count,'sumNum'=>$sumNum,'hedx'=>$dx,'heds'=>$ds,'lh'=>$lh));
exit;

?>