<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>河内5分彩</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
require "jiesuan2.php";
$type = 18;
$game = 'azxy5';

$kaitime = get_query_val('fn_open','next_time',"`type`=$type order by `term` desc limit 1");
if(strtotime($kaitime)>time()){
echo '河内5分彩未到开奖时间';
echo '<br>';
}else{

 //采集一 
$topcode = get_query_val('fn_open','term',"`type`= $type order by `term` desc limit 1");

$url = 'http://api.b1api.com/api?p=json&t=hn5fc&token=0F0A98EAD8969E82&limit=5';
$data = file_get_contents($url);
$json = json_decode($data,1);

$term = $json['data'][0]['expect'];
$code = $json['data'][0]['opencode'];
$opentime = date('Y-m-d H:i:s',strtotime($json['data'][0]['opentime']));
$next_term = $term+1;
$next_time =  date('Y-m-d H:i:s', strtotime("+5 minute", strtotime($json['data'][0]['opentime']) ) );

if($term != '' && $topcode<$term){
   insert_query('fn_open', array('term' => $term, 'code' => $code, 'time' => $opentime, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));
   AZXY5_jiesuan();
   AZXY5_jiesuan1($game,$term);
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

    echo "更新 $code 成功！<br>";
} else {

   echo "等待更新<br>";
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


