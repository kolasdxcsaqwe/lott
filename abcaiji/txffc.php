<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>腾讯分分彩</span><br>"; 
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
require "jiesuan2.php";
$type = 16;
$game = 'txffc';
$kaitime = get_query_val('fn_open','next_time',"`type`=$type order by `term` desc limit 1");
if(strtotime($kaitime)>time()){
echo '腾讯分分彩未到开奖时间';
echo '<br>';
}else{

$url = 'http://api.b1api.com/api?p=json&t=txffc&token=0F0A98EAD8969E82&limit=5';
  $data = file_get_contents($url);
  $json = json_decode($data,1);
  $term = $json['data'][0]['expect'];
  $opentime = $json['data'][0]['opentime'];
  $code = $json['data'][0]['opencode'];
  $next_term = $json['data'][0]['expect']+1;
  $next_time = date("Y-m-d H:i:s",strtotime($json['data'][0]['opentime'])+55);
$topcode = get_query_val('fn_open','term',"`type`=$type order by `term` desc limit 1");
if($term != '' && $term > $topcode){
   insert_query('fn_open', array('term' => $term, 'code' => $code, 'time' => $opentime, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));
   TXFFC_jiesuan();
 //  TXFFC_jiesuan1($game,$term);
  sleep(4);
   kaichat($game, $next_term);

    echo "更新 $code 成功！<br>";
}else{
    echo "等待 $game 刷新<br>";
}
}



function getcode($szUrl){
$UserAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; .NET CLR 3.5.21022; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $szUrl);
curl_setopt($curl, CURLOPT_HEADER, 0);  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_ENCODING, '');
curl_setopt($curl, CURLOPT_USERAGENT, $UserAgent);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
$data = curl_exec($curl); 
return $data;
exit();
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
var limit=6
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


