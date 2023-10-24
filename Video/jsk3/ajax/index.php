<?php	
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Shanghai");
$url = "http://api.woaizy.com/chatkj.php";
$text = file_get_contents($url);
$json = json_decode($text,true);

$code = $json['data'][0]['open_result'];
$code = explode(',',$code);
$codes = $code[0].$code[1].$code[2];
$next_term = $json['data'][0]['next_phase'];
$term = $json['data'][0]['open_phase'];
$time = $json['data'][0]['next_time'];
$count = strtotime($json['data'][0]['next_time']) - time();
$sumNum = (int)$code[0] + (int)$code[1] + (int)$code[2];
$ds = $sumNum % 2 != 0 ? '单' : '双';
$dx = $sumNum > 10 ? '大':'小';

echo json_encode(array('code'=>$codes,'term'=>$term,'nexttime'=>$time,'nextterm'=>$next_term,'count'=>$count,'sumNum'=>$sumNum, 'dx'=>$dx));
exit;

?>