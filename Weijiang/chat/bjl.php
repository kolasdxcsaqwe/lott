<?php

include_once("../../Public/config.php");
$roomid = $_SESSION['agent_room'];
function Broadcast($Content, $chat_term = '', $chat_status = '', $roomid, $game)
{
    robotBroadcast($Content, $chat_term, $chat_status, $roomid, $game, 'S3', 'system');
}

if ($roomid) {
    $bjldjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '10' order by `term` desc limit 1")) - time();

    $bjlopen = get_query_val('fn_lottery10', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;

    if ($bjlopen) {
        $bjltime = (int)get_query_val('fn_lottery10', 'fengtime', array('roomid' => $roomid));
    }

    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));

    $daojishi = get_query_val('fn_setting', 'daojishi', "`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting', 'fengpanxiaoxi', "`roomid` = $roomid");

    $qishu10 = get_query_val('fn_open', 'next_term', "`type` = '10' order by `term` desc limit 1");

    if ($bjlopen) {
        $contest1 = str_replace("[期号]", $qishu10, $daojishi);
        $contests1 = str_replace("[换行]", "<br>", $contest1);
        $contest2 = str_replace("[期号]", $qishu10, $fengpanxiaoxi);
        $contests2 = str_replace("[换行]", "<br>", $contest2);
        $addterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='bjl' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        $fpterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='bjl' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if ($bjltime + 30 == $bjldjs || $bjltime + 29 == $bjldjs || $bjltime + 28 == $bjldjs || $bjltime + 27 == $bjldjs || $bjltime + 26 == $bjldjs || $bjltime + 25 == $bjldjs) {
            if ($addterm == $qishu10) {
            } else {
                Broadcast($contests1, $qishu10, 'djs', $roomid, 'bjl');
            }
        }
        if ($bjltime == $bjldjs || $bjltime - 1 == $bjldjs || $bjltime - 2 == $bjldjs || $bjltime - 3 == $bjldjs || $bjltime - 4 == $bjldjs || $bjltime - 5 == $bjldjs) {
            if ($fpterm == $qishu10) {
            } else {
                Broadcast($contests2, $qishu10, 'fp', $roomid, 'bjl');
            }
        }
        if ($msg1_cont != "" && $bjldjs == $msg1) {
            Broadcast($msg1_cont, $chatterm = '', $chatstatus = '', $roomid, 'bjl');
        }
        if ($msg2_cont != "" && $bjldjs == $msg2) {
            Broadcast($msg2_cont, $chatterm = '', $chatstatus = '', $roomid, 'bjl');
        }
        if ($msg3_cont != "" && $bjldjs == $msg3) {
            Broadcast($msg3_cont, $chatterm = '', $chatstatus = '', $roomid, 'bjl');
        }
    }

} else {
    echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '百家乐倒计时:' . $bjldjs;
echo '<br>';
//<!--JS 页面自动刷新 -->
echo("<script type=\"text/javascript\">");
echo("function fresh_page()");
echo("{");
echo("window.location.reload();");
echo("}");
echo("setTimeout('fresh_page()',1000);");
echo("</script>");
?>



