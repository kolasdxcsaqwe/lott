<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>纽约28</span><br>";
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
include_once "./robot/CommonRule.php";
require "jiesuan.php";
require "jiesuan2.php";
$type = 19;
$game = 'ny28';

$kaitime = get_query_val('fn_open', 'next_time', "`type`=$type order by `term` desc limit 1");

$url = "http://localhost:8123/abcaiji/api/ny28api.php";
$json = file_get_contents($url);
$jsondata = json_decode($json);

if ($jsondata == null || $jsondata->data == null) {
    echo "api或 已经过期";
    return;
}

echo "<br>当前数据->>>" . $json . "<br>";

$resp = $jsondata->data[0];
$qihao = $resp->expect;
$code = fadeGenNY28($resp->opencode);
$term = $resp->expect;
$next_term = $qihao + 1;
$opentime = $resp->opentime;
$ntime = date('Y-m-d H:i:s', strtotime($opentime) + 90);

$nntime = str_replace("/", "-", "$ntime");
if (strlen($nntime) > 11) {
    $next_times = $nntime;
} else {
    $next_times = date("Y-m-d H:i:s", strtotime($opentime) + 90);
}

$topcode = get_query_val('fn_open', 'term', "`type`= $type order by `term` desc limit 1");

//杀猪设置
$preterm = get_query_val('fn_buqi', 'term', "`type`= $type
    order by `term` desc limit 1");
if ($preterm != null && !empty($preterm) && $term == $preterm) {
    $precode = get_query_val('fn_buqi', 'code', "`type`= $type  order by `term` desc limit 1");
    $code = $precode;
    delete_query('fn_buqi', "`type`= $type and `term` = $preterm");
}

$tInt1=0;
if($topcode!=null)
{
    $tInt1=(int)$topcode;
}
$tInt2=(int)$term;

echo "当前最新期号-->" . $topcode . "    数据期号--->" . $term ."下次开奖时间".$next_times. "<br>";
if (empty($topcode) || $tInt1 < $tInt2) {
    $timeNow=time();
    insert_query('fn_open', array('term' => $term, 'code' => $code, 'time' => date('Y-m-d H:i:s', time()), 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_times));
    PC_jiesuan($game);
    PC_jiesuan1($game, $term);
    kaichat($game, $next_term);
    select_query('fn_room', '*');
    while ($x = db_fetch_array()) {
        $xx[] = $x;
    }
    foreach ($xx as $x1) {
        if (strtotime($x1['roomtime']) < time()) continue;
        kaizd($game, $term, $x1['roomid']);
    }
    echo "更新 $code 成功！<br>";

    //30秒随机
//    startBot($game, "10029",5, 30);
    $html= vpost("http://localhost:8653/robotBet", array("betPeriod" => 4, 'delay'=>0,'roomid'=>'10029','game'=>$game));
    echo "请求机器人返回 ".$html;
    echo "使用时间".(time()-$timeNow)."<br>";
} else {
    echo "等待纽约28刷新<br>";
}


function fadeGenNY28($code)
{
    //28系列 数据转换 造假数据
    echo "真数据" . $code;
    $intArray = explode(",", $code);
    $strFadeCode = "";

    $pos = 0;
    $strFadeCode = $strFadeCode . $intArray[$pos++] . ",";

    for ($i = 0; $i < 20; $i++) {

        if ($i + 1 == 6) {
            $strFadeCode = $strFadeCode . $intArray[$pos++];
        } elseif ($i + 1 == 12) {
            $strFadeCode = $strFadeCode . $intArray[$pos++];
        } else {
            $strFadeCode = $strFadeCode . "10";
        }
        if ($i != 19) {
            $strFadeCode = $strFadeCode . ",";
        }
    }

    echo "假数据字符串->>>>" . $strFadeCode . "<br>";

    $fadeCodeArray = explode(",", $strFadeCode);

    $number1 = (int)$fadeCodeArray[0] + (int)$fadeCodeArray[1] + (int)$fadeCodeArray[2] + (int)$fadeCodeArray[3] + (int)$fadeCodeArray[4] + (int)$fadeCodeArray[5];
    $number2 = (int)$fadeCodeArray[6] + (int)$fadeCodeArray[7] + (int)$fadeCodeArray[8] + (int)$fadeCodeArray[9] + (int)$fadeCodeArray[10] + (int)$fadeCodeArray[11];
    $number3 = (int)$fadeCodeArray[12] + (int)$fadeCodeArray[13] + (int)$fadeCodeArray[14] + (int)$fadeCodeArray[15] + (int)$fadeCodeArray[16] + (int)$fadeCodeArray[17];


    echo "原假数据->>>>" . $number1 . " " . $number2 . " " . $number3 . "<br>";

    $number1 = substr($number1, -1);
    $number2 = substr($number2, -1);
    $number3 = substr($number3, -1);

    echo "计算个位数的假数据->>>>" . $number1 . " " . $number2 . " " . $number3 . "<br>";
    return $strFadeCode;
}

?>
<style type="text/css">
    <!--
    body, td, th {
        font-size: 12px;
    }

    body {
        margin-left: 0px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
    }

    #timeinfo {
        color: #C60
    }

    -->
</style>
<script>
    var limit = 4
    if (document.images) {
        var parselimit = limit
    }

    function beginrefresh() {
        if (!document.images)
            return
        if (parselimit == 1)
            window.location.reload()
        else {
            parselimit -= 1
            curmin = Math.floor(parselimit)
            if (curmin != 0)
                curtime = curmin + "秒后自动获取!"
            else
                curtime = cursec + "秒后自动获取!"
            timeinfo.innerText = curtime
            setTimeout("beginrefresh()", 1000)
        }
    }

    window.onload = beginrefresh
</script>
<input type=button name=button value="刷新" onClick="window.location.reload()">
<span id="timeinfo"></span>

