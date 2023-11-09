<?php
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>北京赛车PK10</span><br>";
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
require "jiesuan2.php";
$type = 1;
$game = 'bjpk10';

function defaultHeader()
{
    $header = "User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36\r\n";
    $header .= "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n";
    $header .= "Accept-language: zh-cn,zh;q=0.5\r\n";
    $header .= "Accept-Charset: GB2312,utf-8;q=0.7,*;q=0.7\r\n";
    return $header;
}

function curlGet($url, $timeout = 10, $header = "")
{
    $header = empty($header) ? defaultHeader() : $header;
    $ch = curl_init();
    $t = parse_url($durl);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));//模拟的header头
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$url = 'https://kaijiang-api.com/token/795f9cb66dcb11ee81a4f723515861c2/code/bjpk10/rows/1.json';
$data = curlGet($url);
$jsondata = json_decode($data);

$resp = $jsondata->data[0];
if ($resp == null) {
    echo "也许过期了，数据错误";
    return;
}

echo "数据返回------>" . json_encode($resp) . "<br>";

$term = $resp->expect;
$opentime = $resp->opentime;
$code = $resp->opencode;
$qihao = $resp->expect;
$next_term = $qihao + 1;

$opentime = $resp->opentime;
$next_time = date('Y-m-d H:i:s', strtotime($opentime) + 300);

$topcode = get_query_val('fn_open', 'term', "`type`= $type order by `term` desc limit 1");

$tInt1 = 0;
if ($topcode != null) {
    $tInt1 = (int)$topcode;
}
$tInt2 = (int)$term;

echo "当前最新期号-->" . $topcode . "    数据期号--->" . $term . "<br>";
if (empty($topcode) || $tInt1 < $tInt2) {
    insert_query('fn_open', array('term' => $term, 'code' => $code, 'time' => $opentime, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));

    PK10_jiesuan();
    PK10_jiesuan1('pk10', $term);
    sleep(4);
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
} else {

    echo "等待更新<br>";
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
    // var limit = 6
    // if (document.images) {
    //     var parselimit = limit
    // }
    //
    // function beginrefresh() {
    //     if (!document.images)
    //         return
    //     if (parselimit == 1)
    //         window.location.reload()
    //     else {
    //         parselimit -= 1
    //         curmin = Math.floor(parselimit)
    //         if (curmin != 0)
    //             curtime = curmin + "秒后自动获取!"
    //         else
    //             curtime = cursec + "秒后自动获取!"
    //         timeinfo.innerText = curtime
    //         setTimeout("beginrefresh()", 1000)
    //     }
    // }
    //
    // window.onload = beginrefresh
</script>
<input type=button name=button value="刷新" onClick="window.location.reload()">
<span id="timeinfo"></span>


