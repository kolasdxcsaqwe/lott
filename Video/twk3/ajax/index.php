<?php	
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Shanghai");
include_once('../../../Public/config.php');
$type = '15';
$roomid = $_SESSION['roomid'];
$kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
if($kong == '1'){
$json = get_query_vals('fn_sopen', '*', "`type` = '$type' and `roomid` = '$roomid'order by `term` desc limit 1");
  $haoma = $json['code'];
  $term = $json['term'];
  $opentime = $json['opentime'];
  $next_term = $json['next_term'];
  $next_time = $json['next_time'];
}else{
$json = get_query_vals('fn_open', '*', "`type` = '$type' order by `term` desc limit 1");
   $haoma = $json['code'];
  $term = $json['term'];
  $opentime = $json['time'];
  $next_term = $json['next_term'];
  $next_time = $json['next_time'];
}  
$code = explode(',',$haoma);  
$codes = $code[0].$code[1].$code[2];  

$count = strtotime($next_time) - time()-5;
$sumNum = (int)$code[0] + (int)$code[1] + (int)$code[2];
$ds = $sumNum % 2 != 0 ? '单' : '双';
$dx = $sumNum > 10 ? '大':'小';
echo json_encode(array('code'=>$codes,'term'=>$term,'nexttime'=>$next_time,'next_term'=>$next_term,'count'=>$count,'sumNum'=>$sumNum, 'dx'=>$dx,'ds'=>$ds));
exit;

?>