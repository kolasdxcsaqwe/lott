<?php

include_once("../../Public/config.php");
$roomid = $_SESSION['agent_room'];
function Broadcast($Content, $chat_term = '', $chat_status = '', $roomid, $game)
{
    robotBroadcast($Content,$chat_term,$chat_status,$roomid,$game,'S3','system');
}

if ($roomid) {

    $jnddjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '5' order by `term` desc limit 1")) - time();

    $jnd28open = get_query_val('fn_lottery5', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;


    if ($jnd28open) {
        $jndtime = (int)get_query_val('fn_lottery5', 'fengtime', array('roomid' => $roomid));
    }

    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));

    $daojishi = get_query_val('fn_setting', 'daojishi', "`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting', 'fengpanxiaoxi', "`roomid` = $roomid");

    $qishu5 = get_query_val('fn_open', 'next_term', "`type` = '5' order by `term` desc limit 1");


    if ($jnd28open) {
        $contest1 = str_replace("[期号]", $qishu5, $daojishi);
        $contests1 = str_replace("[换行]", "<br>", $contest1);
        $contest2 = str_replace("[期号]", $qishu5, $fengpanxiaoxi);
        $contests2 = str_replace("[换行]", "<br>", $contest2);
        $addterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='jnd28' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        $fpterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='jnd28' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if ($jndtime + 30 == $jnddjs || $jndtime + 29 == $jnddjs || $jndtime + 28 == $jnddjs || $jndtime + 27 == $jnddjs || $jndtime + 26 == $jnddjs || $jndtime + 25 == $jnddjs) {
            if ($addterm == $qishu5) {
            } else {
                Broadcast($contests1, $qishu5, 'djs', $roomid, 'jnd28');
            }
        }
        if ($jndtime == $jnddjs || $jndtime - 1 == $jnddjs || $jndtime - 2 == $jnddjs || $jndtime - 3 == $jnddjs || $jndtime - 4 == $jnddjs || $jndtime - 5 == $jnddjs) {
            if ($fpterm == $qishu5) {
            } else {
                Broadcast($contests2, $qishu5, 'fp', $roomid, 'jnd28');
            }
        }
        if ($msg1_cont != "" && $jnddjs == $msg1) {
            Broadcast($msg1_cont, $chatterm = '', $chatstatus = '', $roomid, 'jnd28');
        }
        if ($msg2_cont != "" && $jnddjs == $msg2) {
            Broadcast($msg2_cont, $chatterm = '', $chatstatus = '', $roomid, 'jnd28');
        }
        if ($msg3_cont != "" && $jnddjs == $msg3) {
            Broadcast($msg3_cont, $chatterm = '', $chatstatus = '', $roomid, 'jnd28');
        }
    }

} else {
    echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '加拿大28倒计时:' . $jnddjs;
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



