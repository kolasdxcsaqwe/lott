<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>澳洲幸运10</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
require "jiesuan2.php";
$type = 17;
$game = 'azxy10';

$kaitime = get_query_val('fn_open','next_time',"`type`=$type order by `term` desc limit 1");
if(strtotime($kaitime)>time()){
echo '澳洲幸运10未到开奖时间';
echo '<br>';
}else{
 //采集一 
$topcode = get_query_val('fn_open','term',"`type`= $type order by `term` desc limit 1");

$url = 'http://api.api68.com/pks/getLotteryPksInfo.do?issue=&lotCode=10012';
$data = file_get_contents($url);
$json = json_decode($data,1);
$term = $json['result']['data']['preDrawIssue'];
$code = $json['result']['data']['preDrawCode'];
$opentime = date('Y-m-d H:i:s',strtotime($json['result']['data']['preDrawTime']));
$next_term = $json['result']['data']['drawIssue'];
$next_time =  date('Y-m-d H:i:s',strtotime($json['result']['data']['drawTime']));
  
if($term != '' && $topcode<$term){
   insert_query('fn_open', array('term' => $term, 'code' => $code, 'time' => $opentime, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));
   AZXY10_jiesuan();
   AZXY10_jiesuan1($game,$term);
  sleep(4);

   kaichat($game, $next_term);
  select_query('fn_room','*');
while($x = db_fetch_array()){
 $xx[] = $x;
}
foreach($xx as $x1){
  if(strtotime($x1['roomtime']) < time())continue;
 kaizd($game,$term,$x1['roomid']);
}

    echo "更新 $code 成功！";
} else {

   echo $game."等待更新";
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
var limit=5
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


