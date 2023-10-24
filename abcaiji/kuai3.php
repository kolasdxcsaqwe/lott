<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>江苏快三</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
require "jiesuan2.php";
$type = 9;
$game = 'jsk3';

$kaitime = get_query_val('fn_open','next_time',"`type`=$type order by `term` desc limit 1");
if(strtotime($kaitime)>time()){
echo '江苏快三未到开奖时间';
echo '<br>';
}else{
$url = "http://api.api68.com/lotteryJSFastThree/getBaseJSFastThree.do?issue=&lotCode=10007"; //采集接口请咨询 QQ1878336950
$json = file_get_contents($url);
$jsondata = json_decode($json);
if(empty($jsondata)){exit;}
 $data = $jsondata->result;
$i = $data -> data;
$code = $i->preDrawCode;  
$qihao = $i -> preDrawIssue;
$opentime = date('Y-m-d H:i:s',time());
$next_term = $i -> drawIssue;
$next_time = date("Y-m-d H:i:s",(strtotime($i -> drawTime)-30)); 
$topcode = get_query_val('fn_open','term',"`type`= $type order by `term` desc limit 1");
if($topcode < $qihao && $qihao != ''){
   insert_query('fn_open', array('term' => $qihao, 'code' => $code, 'time' => date('Y-m-d H:i:s',time()), 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));
    K3_jiesuan();
    K3_jiesuan1('kuai3',$qihao);
  sleep(4);
   kaichat($game, $next_term);
  select_query('fn_room','*');
while($x = db_fetch_array()){
 $xx[] = $x;
}
foreach($xx as $x1){
  if(strtotime($x1['roomtime']) < time())continue;
 kaizd($game,$qihao,$x1['roomid']);
}
    echo "更新 $code 成功！<br>";
}else{
    echo "等待 $game 刷新<br>";
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



