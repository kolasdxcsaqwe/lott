<?php

include_once("../../Public/config.php");
$roomid = $_SESSION['agent_room'];
function Broadcast($Content, $chat_term = '', $chat_status = '', $roomid, $game)
{
    robotBroadcast($Content,$chat_term,$chat_status,$roomid,$game,'S3','system');
}

if ($roomid) {

    $pcdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '4' order by `term` desc limit 1")) - time();

    $xy28open = get_query_val('fn_lottery4', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;


    if ($xy28open) {
        $pctime = (int)get_query_val('fn_lottery4', 'fengtime', array('roomid' => $roomid));
    }

    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));

    $daojishi = get_query_val('fn_setting', 'daojishi', "`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting', 'fengpanxiaoxi', "`roomid` = $roomid");

    $qishu4 = get_query_val('fn_open', 'next_term', "`type` = '4' order by `term` desc limit 1");

    if ($xy28open) {
        $contest1 = str_replace("[期号]", $qishu4, $daojishi);
        $contests1 = str_replace("[换行]", "<br>", $contest1);
        $contest2 = str_replace("[期号]", $qishu4, $fengpanxiaoxi);
        $contests2 = str_replace("[换行]", "<br>", $contest2);
        $addterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='xy28' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        $fpterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='xy28' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if ($pctime + 30 == $pcdjs || $pctime + 29 == $pcdjs || $pctime + 28 == $pcdjs || $pctime + 27 == $pcdjs || $pctime + 26 == $pcdjs || $pctime + 25 == $pcdjs) {
            if ($addterm == $qishu4) {
            } else {
                Broadcast($contests1, $qishu4, 'djs', $roomid, 'xy28');
            }

        }
        if ($pctime == $pcdjs || $pctime - 1 == $pcdjs || $pctime - 2 == $pcdjs || $pctime - 3 == $pcdjs || $pctime - 4 == $pcdjs || $pctime - 5 == $pcdjs) {
            if ($fpterm == $qishu4) {
            } else {
                Broadcast($contests2, $qishu4, 'fp', $roomid, 'xy28');
            }
        }
        if ($msg1_cont != "" && $pcdjs == $msg1) {
            Broadcast($msg1_cont, $chatterm = '', $chatstatus = '', $roomid, 'xy28');
        }
        if ($msg2_cont != "" && $pcdjs == $msg2) {
            Broadcast($msg2_cont, $chatterm = '', $chatstatus = '', $roomid, 'xy28');
        }
        if ($msg3_cont != "" && $pcdjs == $msg3) {
            Broadcast($msg3_cont, $chatterm = '', $chatstatus = '', $roomid, 'xy28');
        }
    }

} else {
    echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '新加坡28倒计时:' . $pcdjs;
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



