<?php
$load = 5;
header("Content-type:text/html;charset=utf-8");
echo "<span style='color:red;'>極速六合彩</span><br>";
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
$game = 'jslhc';
$type = 14;
$fixno = "500000 ";
$daynum = floor((time() - strtotime("2017-01-01 00:00:00")) / 3600 / 24);
$lastno = ($daynum - 1) * 288 + $fixno;
$tarr = ["00:00:30", "00:05:30", "00:10:30", "00:15:30", "00:20:30", "00:25:30", "00:30:30", "00:35:30", "00:40:30", "00:45:30", "00:50:30", "00:55:30", "01:00:30", "01:05:30", "01:10:30", "01:15:30", "01:20:30", "01:25:30", "01:30:30", "01:35:30", "01:40:30", "01:45:30", "01:50:30", "01:55:30", "02:00:30", "02:05:30", "02:10:30", "02:15:30", "02:20:30", "02:25:30", "02:30:30", "02:35:30", "02:40:30", "02:45:30", "02:50:30", "02:55:30", "03:00:30", "03:05:30", "03:10:30", "03:15:30", "03:20:30", "03:25:30", "03:30:30", "03:35:30", "03:40:30", "03:45:30", "03:50:30", "03:55:30", "04:00:30", "04:05:30", "04:10:30", "04:15:30", "04:20:30", "04:25:30", "04:30:30", "04:35:30", "04:40:30", "04:45:30", "04:50:30", "04:55:30", "05:00:30", "05:05:30", "05:10:30", "05:15:30", "05:20:30", "05:25:30", "05:30:30", "05:35:30", "05:40:30", "05:45:30", "05:50:30", "05:55:30", "06:00:30", "06:05:30", "06:10:30", "06:15:30", "06:20:30", "06:25:30", "06:30:30", "06:35:30", "06:40:30", "06:45:30", "06:50:30", "06:55:30", "07:00:30", "07:05:30", "07:10:30", "07:15:30", "07:20:30", "07:25:30", "07:30:30", "07:35:30", "07:40:30", "07:45:30", "07:50:30", "07:55:30", "08:00:30", "08:05:30", "08:10:30", "08:15:30", "08:20:30", "08:25:30", "08:30:30", "08:35:30", "08:40:30", "08:45:30", "08:50:30", "08:55:30", "09:00:30", "09:05:30", "09:10:30", "09:15:30", "09:20:30", "09:25:30", "09:30:30", "09:35:30", "09:40:30", "09:45:30", "09:50:30", "09:55:30", "10:00:30", "10:05:30", "10:10:30", "10:15:30", "10:20:30", "10:25:30", "10:30:30", "10:35:30", "10:40:30", "10:45:30", "10:50:30", "10:55:30", "11:00:30", "11:05:30", "11:10:30", "11:15:30", "11:20:30", "11:25:30", "11:30:30", "11:35:30", "11:40:30", "11:45:30", "11:50:30", "11:55:30", "12:00:30", "12:05:30", "12:10:30", "12:15:30", "12:20:30", "12:25:30", "12:30:30", "12:35:30", "12:40:30", "12:45:30", "12:50:30", "12:55:30", "13:00:30", "13:05:30", "13:10:30", "13:15:30", "13:20:30", "13:25:30", "13:30:30", "13:35:30", "13:40:30", "13:45:30", "13:50:30", "13:55:30", "14:00:30", "14:05:30", "14:10:30", "14:15:30", "14:20:30", "14:25:30", "14:30:30", "14:35:30", "14:40:30", "14:45:30", "14:50:30", "14:55:30", "15:00:30", "15:05:30", "15:10:30", "15:15:30", "15:20:30", "15:25:30", "15:30:30", "15:35:30", "15:40:30", "15:45:30", "15:50:30", "15:55:30", "16:00:30", "16:05:30", "16:10:30", "16:15:30", "16:20:30", "16:25:30", "16:30:30", "16:35:30", "16:40:30", "16:45:30", "16:50:30", "16:55:30", "17:00:30", "17:05:30", "17:10:30", "17:15:30", "17:20:30", "17:25:30", "17:30:30", "17:35:30", "17:40:30", "17:45:30", "17:50:30", "17:55:30", "18:00:30", "18:05:30", "18:10:30", "18:15:30", "18:20:30", "18:25:30", "18:30:30", "18:35:30", "18:40:30", "18:45:30", "18:50:30", "18:55:30", "19:00:30", "19:05:30", "19:10:30", "19:15:30", "19:20:30", "19:25:30", "19:30:30", "19:35:30", "19:40:30", "19:45:30", "19:50:30", "19:55:30", "20:00:30", "20:05:30", "20:10:30", "20:15:30", "20:20:30", "20:25:30", "20:30:30", "20:35:30", "20:40:30", "20:45:30", "20:50:30", "20:55:30", "21:00:30", "21:05:30", "21:10:30", "21:15:30", "21:20:30", "21:25:30", "21:30:30", "21:35:30", "21:40:30", "21:45:30", "21:50:30", "21:55:30", "22:00:30", "22:05:30", "22:10:30", "22:15:30", "22:20:30", "22:25:30", "22:30:30", "22:35:30", "22:40:30", "22:45:30", "22:50:30", "22:55:30", "23:00:30", "23:05:30", "23:10:30", "23:15:30", "23:20:30", "23:25:30", "23:30:30", "23:35:30", "23:40:30", "23:45:30", "23:50:30", "23:55:30"];
$c = 0;
$t = '';
if (date('H:i:s') > '23:55:30') {
    $c = 288;
    $t = date('Y-m-d ', strtotime('+1 day')) . '00:00:30';
} else {
    for ($i = 0; $i < 288; $i++) {
        if ($tarr[$i] > date('H:i:s')) {
            $c = $i + 1;
            $t = date('Y-m-d ') . $tarr[$i];
            break;
        }
    }
}
$term = ($lastno + $c) - 1;
$time = date('Y-m-d H:i:s', strtotime($t) - 300);
$next_term = ($lastno + $c);
$next_time = $t;
$aa = range(1, 49);
$a = array_rand($aa, 7);
shuffle($a);
if (strlen($aa[$a[0]]) < 2) {
    $haoma1 = '0' . $aa[$a[0]];
} else {
    $haoma1 = $aa[$a[0]];
}
if (strlen($aa[$a[1]]) < 2) {
    $haoma2 = '0' . $aa[$a[1]];
} else {
    $haoma2 = $aa[$a[1]];
}
if (strlen($aa[$a[2]]) < 2) {
    $haoma3 = '0' . $aa[$a[2]];
} else {
    $haoma3 = $aa[$a[2]];
}
if (strlen($aa[$a[3]]) < 2) {
    $haoma4 = '0' . $aa[$a[3]];
} else {
    $haoma4 = $aa[$a[3]];
}
if (strlen($aa[$a[4]]) < 2) {
    $haoma5 = '0' . $aa[$a[4]];
} else {
    $haoma5 = $aa[$a[4]];
}
if (strlen($aa[$a[5]]) < 2) {
    $haoma6 = '0' . $aa[$a[5]];
} else {
    $haoma6 = $aa[$a[5]];
}
if (strlen($aa[$a[6]]) < 2) {
    $haoma7 = '0' . $aa[$a[6]];
} else {
    $haoma7 = $aa[$a[6]];
}
$code_str = $haoma1 . ',' . $haoma2 . ',' . $haoma3 . ',' . $haoma4 . ',' . $haoma5 . ',' . $haoma6 . ',' . $haoma7;
$topcode = get_query_val('fn_open', 'term', "`type`='$type' order by `term` desc limit 1");

$tInt1 = 0;
if ($topcode != null) {
    $tInt1 = (int)$topcode;
}
$tInt2 = (int)$term;

if (empty($topcode) || $tInt1 < $tInt2) {
    insert_query('fn_open', array("term" => $term, 'code' => $code_str, 'time' => $time, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time));

    JSLHC_jiesuan();
    sleep(4);
    kaichat($game, $next_term);
    echo "更新 $code_str 成功！<br>";
} else {
    echo "等待 $code_str 刷新<br>";
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
    // var limit=4
    // if (document.images){
    // 	var parselimit=limit
    // }
    // function beginrefresh(){
    // if (!document.images)
    // 	return
    // if (parselimit==1)
    // 	window.location.reload()
    // else{
    // 	parselimit-=1
    // 	curmin=Math.floor(parselimit)
    // 	if (curmin!=0)
    // 		curtime=curmin+"秒后自动获取!"
    // 	else
    // 		curtime=cursec+"秒后自动获取!"
    // 		timeinfo.innerText=curtime
    // 		setTimeout("beginrefresh()",1000)
    // 	}
    // }
    // window.onload=beginrefresh
</script>
<input type=button name=button value="刷新" onClick="window.location.reload()">
<span id="timeinfo"></span>


