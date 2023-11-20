<?php

include_once("../../Public/config.php");
$roomid = $_SESSION['agent_room'];
function Broadcast($Content, $chat_term = '', $chat_status = '', $roomid, $game)
{
    robotBroadcast($Content,$chat_term,$chat_status,$roomid,$game,'S3','system');
}

if ($roomid) {

    $jsscdjs = strtotime(get_query_val('fn_open', 'next_time', "`type` = '7' order by `term` desc limit 1")) - time();


    $jsscopen = get_query_val('fn_lottery7', 'gameopen', array('roomid' => $roomid)) == 'true' ? true : false;

    if ($jsscopen) {
        $jssctime = (int)get_query_val('fn_lottery7', 'fengtime', array('roomid' => $roomid));
    }

    $msg1 = (int)get_query_val('fn_setting', 'msg1_time', array('roomid' => $roomid));
    $msg1_cont = get_query_val('fn_setting', 'msg1_cont', array('roomid' => $roomid));
    $msg2 = (int)get_query_val('fn_setting', 'msg2_time', array('roomid' => $roomid));
    $msg2_cont = get_query_val('fn_setting', 'msg2_cont', array('roomid' => $roomid));
    $msg3 = (int)get_query_val('fn_setting', 'msg3_time', array('roomid' => $roomid));
    $msg3_cont = get_query_val('fn_setting', 'msg3_cont', array('roomid' => $roomid));

    $daojishi = get_query_val('fn_setting', 'daojishi', "`roomid` = $roomid");
    $fengpanxiaoxi = get_query_val('fn_setting', 'fengpanxiaoxi', "`roomid` = $roomid");

    $qishu7 = get_query_val('fn_open', 'next_term', "`type` = '7' order by `term` desc limit 1");

    if ($jsscopen) {
        $contest1 = str_replace("[期号]", $qishu7, $daojishi);
        $contests1 = str_replace("[换行]", "<br>", $contest1);
        $contest2 = str_replace("[期号]", $qishu7, $fengpanxiaoxi);
        $contests2 = str_replace("[换行]", "<br>", $contest2);
        $addterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='jssc' and `chat_status`='djs' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        $fpterm = get_query_val('fn_chat', 'chat_term', "`roomid`='{$roomid}' and `game`='jssc' and `chat_status`='fp' and `type`='S3' and `userid`='system' order by `chat_term` desc limit 1");
        if ($msg1_cont != "" && $jsscdjs == $msg1) {
            Broadcast($msg1_cont, $chatterm = '', $chatstatus = '', $roomid, 'jssc');
        }
        if ($msg2_cont != "" && $jsscdjs == $msg2) {
            Broadcast($msg2_cont, $chatterm = '', $chatstatus = '', $roomid, 'jssc');
        }
        if ($msg3_cont != "" && $jsscdjs == $msg3) {
            Broadcast($msg3_cont, $chatterm = '', $chatstatus = '', $roomid, 'jssc');
        }
        if ($jssctime + 10 == $jsscdjs || $jssctime + 9 == $jsscdjs || $jssctime + 8 == $jsscdjs || $jssctime + 7 == $jsscdjs || $jssctime + 6 == $jsscdjs || $jssctime + 5 == $jsscdjs) {
            if ($addterm == $qishu7) {
            } else {
                Broadcast($contests1, $qishu7, 'djs', $roomid, 'jssc');
            }
        }
        if ($jssctime == $jsscdjs || $jssctime - 1 == $jsscdjs || $jssctime - 2 == $jsscdjs || $jssctime - 3 == $jsscdjs || $jssctime - 4 == $jsscdjs || $jssctime - 5 == $jsscdjs || $jssctime - 6 == $jsscdjs) {
            if ($fpterm == $qishu7) {
            } else {
                Broadcast($contests2, $qishu7, 'fp', $roomid, 'jssc');
            }
        }
    }

} else {
    echo '----------喊话失败！请登录后台启动程序！----------<br><br><br>';
}

//zepto 20171013
echo '<br>';
echo '极速赛车倒计时:' . $jsscdjs;
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



