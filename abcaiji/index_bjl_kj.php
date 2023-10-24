
	<?php 
$load = 5;
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
include_once "./Public/Bjl.php";
include_once "./Public/reopen.funcion.php";
require "jiesuan.php";
$bjl = new Bjl();
$cur = $bjl->get_period_info($bjl->getTodayCur());
if (time() - strtotime($cur['awardTime']) >= 17) {
	$diff = strtotime($cur['next_awardTime']) + 17 - time();
	BJL_jiesuan();
} elseif (time() - strtotime($cur['awardTime']) < 17) {
	$diff = 17 - (time() - strtotime($cur['awardTime']));
}
$diff2 = $diff;
if ($diff > 20) {
	$diff = 10;
}
header("refresh:$diff;url=index_bjl_kj.php");
echo $diff2;

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


