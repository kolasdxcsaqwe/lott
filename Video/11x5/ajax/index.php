<?php	
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
date_default_timezone_set("Asia/Shanghai");
//$game=$_COOKIE['game'];
//$lotcode='';
$url = "http://api.api68.com/ElevenFive/getElevenFiveInfo.do?lotCode=10006";

//if($game=="gd11x5")$lotcode='10006';
//if($game=="sd11x5")$lotcode='10008';
//if($game=="js11x5")$lotcode='10016';
//if($game=="jx11x5")$lotcode='10015';
//$url=$url.$lotcode;
$text = file_get_contents($url);
$json = json_decode($text,true);
$data = $json['result']['data'];
$code =  $data['preDrawCode'];
$code = explode(',',$code);
$codes = $code[0].$code[1].$code[2].$code[3].$code[4];
$codes=$code;
$term = $data['preDrawIssue'];
$time = date('H:i:s',strtotime($data['drawTime']));
$count = strtotime($data['drawTime']) - time();
$sumNum = (int)$code[0] + (int)$code[1] + (int)$code[2] + (int)$code[3] + (int)$code[4];
$ds = $sumNum % 2 != 0 ? '单' : '双';
$dx = $sumNum > 29 ? '大':'小';
if($code[0] > $code[4]){
	$lh = '龙';
}elseif($code[0] < $code[4]){
	$lh = '虎';
}elseif($code[0] == $code[4]){
	$lh = '和';
}

echo json_encode(array('code'=>$codes,'term'=>$term,'nexttime'=>$time,'count'=>$count,'sumNum'=>$sumNum,'hedx'=>$dx,'heds'=>$ds,'lh'=>$lh));
exit;

?>