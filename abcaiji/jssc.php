<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>极速赛车</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
$type = 7;
$game = 'jssc';

$kaitime = get_query_val('fn_open','next_time',"`type`=$type order by `term` desc limit 1");
if(strtotime($kaitime)>time()){
echo '极速赛车未到开奖时间';
echo '<br>';
}else{

$url = "http://api.api68.com/pks/getLotteryPksInfo.do?&lotCode=10037"; //采集接口请咨询 QQ1878336950
$json = file_get_contents($url);
$arr = json_decode($json,1);
if(empty($arr)){exit;}
$code = $arr['result']['data']['preDrawCode'];
$term = $arr['result']['data']['preDrawIssue'];
$opentime = $arr['result']['data']['preDrawTime'];
$next_time = $arr['result']['data']['drawTime']; 
$next_term = $arr['result']['data']['drawIssue'];

$topcode = get_query_val('fn_open','term',"`type`= $type order by `term` desc limit 1");
if($term != '' && $topcode<$term){
  insert_query('fn_open', array("term" => $term, 'code' => $code, 'time' => $opentime, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));
  JSSC_jiesuan();
  sleep(4);
  kaichat($game,$next_term);
  echo "更新 $code 成功！<br>";
}else{
  echo "等待 $next_term 刷新<br>";
}
}

?>
<style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
#timeinfo{color:#C60}
-->
</style>
<script> 
var limit=4
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"秒后自动获取!" 
	else 
		curtime=cursec+"秒后自动获取!" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 
window.onload=beginrefresh
</script>
<input type=button name=button value="刷新" onClick="window.location.reload()">
<span id="timeinfo"></span>



