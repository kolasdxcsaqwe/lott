<?php	
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
include_once('../../../Public/config.php');
$type = '12';
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
$codes = (int)$code[0].','.(int)$code[1].','.(int)$code[2].','.(int)$code[3].','.(int)$code[4].','.(int)$code[5].','.(int)$code[6].','.(int)$code[7].','.(int)$code[8].','.(int)$code[9];
   
$count = strtotime($next_time) - time()-15;
$sumNum = (int)$code[0] + (int)$code[1];
$ds = $sumNum % 2 != 0 ? '单' : '双';
$dx = $sumNum > 11 ? '大':'小';
if($code[0] > $code[9]){
	$lh1 = '龙';
}else{
	$lh1 = '虎';
}
if($code[1] > $code[8]){
	$lh2 = '龙';
}else{
	$lh2 = '虎';
}
if($code[2] > $code[7]){
	$lh3 = '龙';
}else{
	$lh3 = '虎';
}
if($code[3] > $code[6]){
	$lh4 = '龙';
}else{
	$lh4 = '虎';
}
if($code[4] > $code[5]){
	$lh5 = '龙';
}else{
	$lh5 = '虎';
}
echo json_encode(array('code'=>$codes,'term'=>$term,'nextterm'=>$next_term,'count'=>$count,'sumNum'=>$sumNum,'hedx'=>$dx,'heds'=>$ds,'lh1'=>$lh1,'lh2'=>$lh2,'lh3'=>$lh3,'lh4'=>$lh4,'lh5'=>$lh5));
exit;


?>