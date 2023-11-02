<?php
include_once("../Public/config.php");
include_once("../Public/Bjl.php");
$type = $_GET['type'];
$BetGame = $_POST['gametype'];
$postRoomid = $_POST['roomid'];
$postUserid = $_POST['userid'];
$postHeadimg = $_POST['headimg'];
$postNickname = $_POST['username'];

switch ($type) {
    case 'first':
        $arr = array();
        select_query("fn_chat", '*', "roomid = '{$postRoomid}' and game = '{$BetGame}' order by id desc limit 0,50");
        while ($x = db_fetch_array()) {
            if ($x['userid'] == $postUserid) {
                $type = 'U2';
            } else {
                $type = $x['type'];
            }
            $arr[] = array('nickname' => $x['username'], 'headimg' => $x['headimg'], 'content' => $x['content'], 'addtime' => $x['addtime'], 'type' => $type, 'game' => $BetGame, 'id' => $x['id']);
        }
        echo json_encode($arr);
        break;
    case "update":
        $arr = array();
        $chatid = $_GET['id'];
        $postRoomid = str_replace(";", "", $postRoomid);
        select_query("fn_chat", '*', "roomid = {$postRoomid} and game = '{$BetGame}' and id>$chatid order by id asc");
        while ($x = db_fetch_array()) {
            if ($x['userid'] == $postUserid) continue;
            $arr[] = array('nickname' => $x['username'], 'headimg' => $x['headimg'], 'content' => $x['content'], 'addtime' => $x['addtime'], 'type' => $x['type'], 'game' => $BetGame, 'id' => $x['id']);
        }
        echo json_encode($arr);
        break;
    case "send":
        $content = $_POST['content'];
        $nickname = $_POST['username'];
        $headimg = $_POST['headimg'];

        if ($BetGame == 'pk10') {
            if (get_query_val('fn_lottery1', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'xyft') {
            if (get_query_val('fn_lottery2', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'cqssc') {
            if (get_query_val('fn_lottery3', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'xy28') {
            if (get_query_val('fn_lottery4', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'ny28') {
            if (get_query_val('fn_lottery19', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'jnd28') {
            if (get_query_val('fn_lottery5', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'jsmt') {
            if (get_query_val('fn_lottery6', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'jssc') {
            if (get_query_val('fn_lottery7', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'jsssc') {
            if (get_query_val('fn_lottery8', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'kuai3') {
            if (get_query_val('fn_lottery9', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'bjl') {
            if (get_query_val('fn_lottery10', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'gd11x5') {
            if (get_query_val('fn_lottery11', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'jssm') {
            if (get_query_val('fn_lottery12', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'lhc') {
            if (get_query_val('fn_lottery13', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'jslhc') {
            if (get_query_val('fn_lottery14', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'twk3') {
            if (get_query_val('fn_lottery15', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'txffc') {
            if (get_query_val('fn_lottery16', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'azxy10') {
            if (get_query_val('fn_lottery17', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        } elseif ($BetGame == 'azxy5') {
            if (get_query_val('fn_lottery18', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
        }
        if ($BetGame == 'pk10') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 1 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery1', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 1 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'xyft') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 2 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery2', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 2 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'cqssc') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 3 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery3', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 3 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'xy28') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 4 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery4', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 4 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        }elseif ($BetGame == 'ny28') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 19 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery19', 'fengtime', array('roomid' => $_SESSION['roomid']));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 19 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'jnd28') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 5 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery5', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 5 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'jsmt') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 6 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery6', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 6 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'jssc') {
            /*if(get_query_val('fn_lottery7','kongzhi',array('roomid'=>$postRoomid)) == '1'){
              $BetTerm = get_query_val('fn_sopen', 'next_term', "type = 7 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery7', 'fengtime', array('roomid' => $postRoomid));
        $djs = strtotime(get_query_val('fn_sopen', 'next_time', 'type = 7 order by term desc limit 1')) - time();
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
      }else{*/
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 7 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery7', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 7 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
            //}
        } elseif ($BetGame == 'jsssc') {
            /* if(get_query_val('fn_lottery8','kongzhi',array('roomid'=>$postRoomid)) == '1'){
              $BetTerm = get_query_val('fn_sopen', 'next_term', "type = 8 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery8', 'fengtime', array('roomid' => $postRoomid));
        $djs = strtotime(get_query_val('fn_sopen', 'next_time', 'type = 8 order by term desc limit 1')) - time();
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
      }else{*/
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 8 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery8', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 8 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
            // }
        } elseif ($BetGame == 'kuai3') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 9 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery9', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 9 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'bjl') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 10 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery10', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 10 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'gd11x5') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 11 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery11', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 11 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'jssm') {
            //$pre_open = get_query_vals('fn_sopen', '*', "`type` = '12' and `roomid` = $postRoomid order by `term` desc limit 1");
            /*if(get_query_val('fn_lottery12','kongzhi',array('roomid'=>$postRoomid)) == '1' && $pre_open){
              $BetTerm = get_query_val('fn_sopen', 'next_term', "type = 12 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery12', 'fengtime', array('roomid' => $postRoomid));
        $djs = strtotime(get_query_val('fn_sopen', 'next_time', 'type = 12 order by term desc limit 1')) - time();
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
      }else{*/
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 12 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery12', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 12 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
            //}
        } elseif ($BetGame == 'lhc') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 13 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery13', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 13 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'jslhc') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 14 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery14', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 14 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'twk3') {
            /*if(get_query_val('fn_lottery15','kongzhi',array('roomid'=>$postRoomid)) == '1'){
              $BetTerm = get_query_val('fn_sopen', 'next_term', "type = 15 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery15', 'fengtime', array('roomid' => $postRoomid));
        $djs = strtotime(get_query_val('fn_sopen', 'next_time', 'type = 15 order by term desc limit 1')) - time();
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
      }else{*/
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 15 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery15', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 15 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
            // }
        } elseif ($BetGame == 'txffc') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 16 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery16', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 16 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'azxy10') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 17 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery17', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 17 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'azxy5') {
            $BetTerm = get_query_val('fn_open', 'next_term', "type = 18 order by term desc limit 1");
            $time = (int)get_query_val('fn_lottery18', 'fengtime', array('roomid' => $postRoomid));
            $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 18 order by term desc limit 1')) - time();
            if ($djs < $time) {
                $fengpan = true;
            } else {
                $fengpan = false;
            }
        } elseif ($BetGame == 'feng') {
            $fengpan = true;
        }
        if (substr($content, 0, 1) == '@') {
            $type = "U1";
        } else {
            $type = "U3";
        }
        if (get_query_val("fn_ban", "id", array("roomid" => $postRoomid, 'userid' => $postUserid)) != "") {
            echo json_encode(array('success' => false, 'msg' => '您已经被该房间禁言！无法发言与投注！'));
            break;
        } elseif (!wordkeys($content)) {
            echo json_encode(array('success' => false, 'msg' => '您发送的内容内含有屏蔽词汇,请删除后重试.'));
            break;
        }
        if ($type == 'U3') {
            if (substr($content, 0, 6) == '上分') {
                $fenshuchange = true;
                $sfmoney = substr($content, 6);
                if ((int)$sfmoney > 0) 插入上分($postNickname, $postUserid, $sfmoney);
            } elseif (substr($content, 0, 3) == '上') {
                $fenshuchange = true;
                $sfmoney = substr($content, 3);
                if ((int)$sfmoney > 0) 插入上分($postNickname, $postUserid, $sfmoney);
            } elseif (substr($content, 0, 3) == '查') {
                $fenshuchange = true;
                $sfmoney = substr($content, 3);
                if ((int)$sfmoney > 0) 插入上分($postNickname, $postUserid, $sfmoney);
            } /*  elseif(substr($content, 0, 6) == '下分'){
            $fenshuchange = true;
            $xfmoney = substr($content, 6);
            if((int)$xfmoney > 0)插入下分($postNickname, $postUserid, $xfmoney);
        }elseif(substr($content, 0, 3) == '下'){
            $fenshuchange = true;
            $xfmoney = substr($content, 3);
            if((int)$xfmoney > 0)插入下分($postNickname, $postUserid, $xfmoney);
        }elseif(substr($content, 0, 3) == '回'){
            $fenshuchange = true;
            $xfmoney = substr($content, 3);
            if((int)$xfmoney > 0)插入下分($postNickname, $postUserid, $xfmoney);
        }*/
            else {
                $fenshuchange = false;
            }
            if ($content == "取消") {
                CancelBet($postUserid, $BetTerm, $BetGame, $fengpan);
                echo json_encode(array("success" => true, "content" => $content));
                insert_query("fn_chat", array("username" => $nickname, 'content' => $content, 'addtime' => date('H:i:s'), 'time' => date('Y-m-d H:i:s', time()), 'game' => $BetGame, 'headimg' => $headimg, 'type' => $type, 'userid' => $postUserid, 'roomid' => $postRoomid));
                break;
            }
        }

        if ($type == 'U3' && $fenshuchange == false && ($BetGame == 'ny28' || $BetGame == 'xy28' || $BetGame == 'jnd28')) {
            $co = addPCBet($postUserid, $postNickname, $postHeadimg, $content, $BetTerm, $fengpan);
        } elseif ($type == 'U3' && $fenshuchange == false && $BetGame == 'bjl') {
            //myy 判断游戏是封盘
            //是否可以投注
            $bjl = new Bjl();
            $cur = $bjl->get_period_info($bjl->getTodayCur());
            $myy_time = strtotime($cur['awardTime']);
            if (time() - $myy_time < 10) {
                管理员喊话("@" . $postNickname . " ,[$BetTerm]期还未开始投注！");
                exit;
            } else {
                $co = addBJLBet($postUserid, $postNickname, $postHeadimg, $content, $BetTerm, $fengpan);
            }

        } elseif ($type == 'U3' && $fenshuchange == false && ($BetGame == 'lhc' || $BetGame == 'jslhc')) {
            $co = addLHCBet($postUserid, $postNickname, $postHeadimg, $content, $BetTerm, $fengpan);
        } elseif ($type == 'U3' && $fenshuchange == false && ($BetGame == 'cqssc' || $BetGame == 'jsssc' || $BetGame == 'txffc' || $BetGame == 'azxy5')) {
            $co = addSSCBet($postUserid, $postNickname, $postHeadimg, $content, $BetTerm, $fengpan);
        } elseif ($type == 'U3' && $fenshuchange == false && ($BetGame == 'kuai3' || $BetGame == 'twk3')) {
            $co = addK3Bet($postUserid, $postNickname, $postHeadimg, $content, $BetTerm, $fengpan);
        } elseif ($type == 'U3' && $fenshuchange == false && ($BetGame == 'gd11x5')) {
            $co = add11X5Bet($postUserid, $postNickname, $postHeadimg, $content, $BetTerm, $fengpan);
        } elseif ($type == 'U3' && $fenshuchange == false) {
            $co = addBet($postUserid, $postNickname, $postHeadimg, $content, $BetTerm, $fengpan);
        }
        if (get_query_val("fn_setting", "setting_ischat", array("roomid" => $postRoomid)) == 'open' && !$co[0] && !$fenshuchange) {
            echo json_encode(array('success' => false, 'msg' => "警告:投注格式不正确或已经封盘"));
            break;
        } else {
            echo json_encode(array("success" => true, "content" => $content));
            insert_query("fn_chat", array("username" => $nickname, 'content' => $content, 'addtime' => date('H:i:s'), 'time' => date('Y-m-d H:i:s', time()), 'game' => $BetGame, 'headimg' => $headimg, 'type' => $type, 'userid' => $postUserid, 'roomid' => $postRoomid, 'chatid' => $co[1]));

        }
        break;
}
function sum_betmoney($table, $mc, $cont, $user, $term)
{
    global $postRoomid;
    $re = get_query_val($table, 'sum(`money`)', array('userid' => $user, 'term' => $term, 'mingci' => $mc, 'content' => $cont));
    return (int)$re;
}

function sum_bjlmoney($table, $cont, $user, $term)
{
    global $postRoomid;
    $re = get_query_val($table, 'sum(`money`)', array('userid' => $user, 'term' => $term, 'content' => $cont));
    return (int)$re;
}

function str_replace_once($needle, $replace, $haystack)
{
    global $postRoomid;
    $pos = strpos($haystack, $needle);
    if ($pos === false) {
        return $haystack;
    }
    return substr_replace($haystack, $replace, $pos, strlen($needle));
}

function runrobot($BetGame)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    $open = get_query_val('fn_setting', 'setting_runrobot', array('roomid' => $postRoomid));
    if ($open != 'true') {
        return;
    }
    if ($BetGame == 'pk10') {
        if (get_query_val('fn_lottery1', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'xyft') {
        if (get_query_val('fn_lottery2', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'cqssc') {
        if (get_query_val('fn_lottery3', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'xy28') {
        if (get_query_val('fn_lottery4', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    }elseif ($BetGame == 'ny28') {
        if (get_query_val('fn_lottery19', 'gameopen', array('roomid' => $_SESSION['roomid'])) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'jnd28') {
        if (get_query_val('fn_lottery5', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'jsmt') {
        if (get_query_val('fn_lottery6', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'jssc') {
        if (get_query_val('fn_lottery7', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'jsssc') {
        if (get_query_val('fn_lottery8', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'kuai3') {
        if (get_query_val('fn_lottery9', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'bjl') {
        if (get_query_val('fn_lottery10', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'gd11x5') {
        if (get_query_val('fn_lottery11', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'jssm') {
        if (get_query_val('fn_lottery12', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'lhc') {
        if (get_query_val('fn_lottery13', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'jslhc') {
        if (get_query_val('fn_lottery14', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'twk3') {
        if (get_query_val('fn_lottery15', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'txffc') {
        if (get_query_val('fn_lottery16', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'azxy10') {
        if (get_query_val('fn_lottery17', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    } elseif ($BetGame == 'azxy5') {
        if (get_query_val('fn_lottery18', 'gameopen', array('roomid' => $postRoomid)) == 'false') $BetGame = 'feng';
    }
    if ($BetGame == 'pk10') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 1 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery1', 'fengtime', array('roomid' => $postRoomid));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 1 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'xyft') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 2 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery2', 'fengtime', array('roomid' => $postRoomid));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 2 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'cqssc') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 3 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery3', 'fengtime', array('roomid' => $postRoomid));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 3 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'xy28') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 4 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery4', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 4 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    }elseif ($BetGame == 'ny28') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 19 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery19', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 19 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'jnd28') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 5 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery5', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 5 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'jsmt') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 6 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery6', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 6 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'jssc') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 7 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery7', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 7 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'jsssc') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 8 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery8', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 8 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'kuai3') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 9 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery9', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 9 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'bjl') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 10 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery10', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 10 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'gd11x5') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 11 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery11', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 11 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'jssm') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 12 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery12', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 12 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'lhc') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 13 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery13', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 13 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'jslhc') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 14 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery14', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 14 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'twk3') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 15 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery15', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 15 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'txffc') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 16 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery16', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 16 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'azxy10') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 17 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery17', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 17 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'azxy5') {
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 18 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery18', 'fengtime');
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 18 order by term desc limit 1')) - time();
        if ($djs < $time) {
            $fengpan = true;
        } else {
            $fengpan = false;
        }
    } elseif ($BetGame == 'feng') {
        $fengpan = true;
    }

}

function wordkeys($content)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    $keys = get_query_val('fn_setting', 'setting_wordkeys', array('roomid' => $postRoomid));
    $arr = explode("|", $keys);
    foreach ($arr as $con) {
        if ($con == "") {
            continue;
        }
        if (preg_match("/$con/", $content)) {
            return false;
        }
    }
    return true;
}

function 文本_逐字分割($str, $split_len = 1)
{
    if (!preg_match('/^[0-9]+$/', $split_len) || $split_len < 1) return false;
    $len = mb_strlen($str, 'UTF-8');
    if ($len <= $split_len) return array($str);
    preg_match_all("/.{" . $split_len . '}|[^x00]{1,' . $split_len . '}$/us', $str, $ar);
    return $ar[0];
}

function 前中后分割($str)
{
    $arr = 文本_逐字分割($str);
    $new = array();
    foreach ($arr as $ii) {
        if ($ii == "前") {
            $new[] = "前三";
            continue;
        }
        if ($ii == "中") {
            $new[] = "中三";
            continue;
        }
        if ($ii == "后") {
            $new[] = "后三";
            continue;
        }
        continue;
    }
    return $new;
}

function 和值分割($str)
{
    $arr = 文本_逐字分割($str);
    $new = array();
    $ii_1_b = true;
    $ii_1 = '';
    foreach ($arr as $ii) {
        if (!$ii_1_b && $ii_1 == "1") $ii = "1" . $ii;
        $ii_1 = $ii;
        if ($ii_1_b) $ii_1_b = false;
        if ($ii == "1") continue;
        array_push($new, $ii);
    }
    return $new;
}

function 查询用户余额($Userid)
{
    global $postRoomid;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    return (int)get_query_val('fn_user', 'money', array('userid' => $Userid, 'roomid' => $postRoomid));
}

function 用户_下分($Userid, $Money)
{
    global $postRoomid;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    update_query('fn_user', array('money' => '-=' . $Money), array('userid' => $Userid, 'roomid' => $postRoomid));
    insert_query("fn_marklog", array("userid" => $Userid, 'type' => '下分', 'content' => '彩票投注', 'money' => $Money, 'roomid' => $postRoomid, 'addtime' => 'now()'));
}

function 用户_上分($Userid, $Money)
{
    global $postRoomid;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    update_query('fn_user', array('money' => '+=' . $Money), array('userid' => $Userid, 'roomid' => $postRoomid));
    insert_query("fn_marklog", array("userid" => $Userid, 'type' => '上分', 'content' => '投注撤单退还', 'money' => $Money, 'roomid' => $postRoomid, 'addtime' => 'now()'));
}

function 管理员喊话($Content)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $postRoomid));
    insert_query("fn_chat", array("userid" => "system", "username" => "播报员", "game" => $BetGame, 'headimg' => $headimg, 'content' => $Content, 'addtime' => date('H:i:s'), 'time' => date('Y-m-d H:i:s', time()), 'type' => 'S3', 'roomid' => $postRoomid));
}

function 插入上分($username, $userid, $money)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    $jia = get_query_val('fn_user', 'jia', array('userid' => $userid));
    insert_query("fn_upmark", array("userid" => $userid, 'headimg' => $postHeadimg, 'username' => $username, 'type' => '上分', 'money' => $money, 'status' => '未处理', 'time' => 'now()', 'game' => $BetGame, 'roomid' => $postRoomid, 'jia' => $jia));
}

function 插入下分($username, $userid, $money)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    $m = (int)get_query_val('fn_user', 'money', array('roomid' => $postRoomid, 'userid' => $userid));
    if (($m - (int)$money) < 0) {
        管理员喊话("@$username,您的分数不够回这么多分!", $game);
        return;
    }
    $jia = get_query_val('fn_user', 'jia', array('userid' => $userid));
    insert_query("fn_upmark", array("userid" => $userid, 'headimg' => $postHeadimg, 'username' => $username, 'type' => '下分', 'money' => $money, 'status' => '未处理', 'time' => 'now()', 'game' => $BetGame, 'roomid' => $postRoomid, 'jia' => $jia));
    if (get_query_val("fn_setting", "setting_downmark", array("roomid" => $postRoomid)) == 'true') {
        update_query('fn_user', array('money' => '-=' . $money), array('userid' => $userid, 'roomid' => $postRoomid));
        insert_query("fn_marklog", array("roomid" => $postRoomid, 'userid' => $userid, 'type' => '下分', 'content' => '系统自动同意下分' . $money, 'money' => $money, 'addtime' => 'now()'));
        $headimg = get_query_val('fn_setting', 'setting_sysimg', array('roomid' => $postRoomid));
        insert_query("fn_chat", array("userid" => "system", "username" => "管理员", "game" => $BetGame, 'headimg' => $headimg, 'content' => "@{$username}, 您的下分请求已接收,请稍后查账!", 'addtime' => date('H:i:s'), 'time' => date('Y-m-d H:i:s', time()), 'type' => 'S1', 'roomid' => $postRoomid));
    }
}

function CancelBet($userid, $term, $game, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    $chedan = get_query_val('fn_setting', 'setting_cancelbet', array('roomid' => $postRoomid)) == 'open' ? true : false;
    if ($chedan) {
        return;
    } else {
        if ($fengpan) {
            管理员喊话("@" . $postNickname . " ,[$term]期已经停止投注！无法取消！");
            return false;
        }
        switch ($game) {
            case 'pk10':
                $table = "fn_order";
                break;
            case 'xyft':
                $table = "fn_flyorder";
                break;
            case 'cqssc':
                $table = "fn_sscorder";
                break;
            case 'xy28':
                $table = "fn_pcorder";
                break;
            case 'ny28':
                $table = "fn_pcorder";
                break;
            case "jnd28":
                $table = "fn_pcorder";
                break;
            case "jsmt":
                $table = "fn_mtorder";
                break;
            case "jssc":
                $table = "fn_jsscorder";
                break;
            case "jsssc":
                $table = "fn_jssscorder";
                break;
            case "cqssc":
                $table = "fn_sscorder";
                break;
            case "pk10":
                $table = "fn_order";
                break;
            case "xyft":
                $table = "fn_flyorder";
                break;
            case "kuai3":
                $table = "fn_k3order";
                break;
            case "bjl":
                $table = "fn_bjlorder";
                break;
            case "gd11x5":
                $table = "fn_11x5order";
                break;
            case "jssm":
                $table = "fn_smorder";
                break;
            case "lhc":
                $table = "fn_lhcorder";
                break;
            case "jslhc":
                $table = "fn_jslhcorder";
                break;
            case "twk3":
                $table = "fn_twk3order";
                break;
            case "txffc":
                $table = "fn_txffcorder";
                break;
            case "azxy10":
                $table = "fn_azxy10order";
                break;
            case "azxy5":
                $table = "fn_azxy5order";
                break;

        }
        $all = (int)get_query_val($table, 'sum(`money`)', "userid = '$userid' and term = '$term' and status = '未结算' and roomid = {$postRoomid}");
        update_query($table, array('status' => '已撤单'), "userid = '$userid' and term = '$term' and roomid = {$postRoomid}");
        用户_上分($userid, $all);
        管理员喊话("@{$postNickname} ,[$term]期投注已经退还!");
    }
}

function addLHCBet($userid, $nickname, $headimg, $content, $addQihao, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    if ($fengpan) {
        管理员喊话("@" . $nickname . " ,[$addQihao]期已经停止投注！下注无效！");
        $carr[0] = false;
        $carr[1] = $chat_id;
        return $carr;
    }
    /*
        $content = str_replace("冠亚和", "和", $content);
        $content = str_replace("冠亚", "和", $content);
        $content = str_replace("冠军", "1/", $content);
        $content = str_replace("亚军", "2/", $content);
        $content = str_replace("冠", "1/", $content);
        $content = str_replace("亚", "2/", $content);
        $content = str_replace("一", "1/", $content);
        $content = str_replace("二", "2/", $content);
        $content = str_replace("三", "3/", $content);
        $content = str_replace("四", "4/", $content);
        $content = str_replace("五", "5/", $content);
        $content = str_replace("六", "6/", $content);
        $content = str_replace("七", "7/", $content);
        $content = str_replace("八", "8/", $content);
        $content = str_replace("九", "9/", $content);
        $content = str_replace("十", "0/", $content);
        $content = str_replace(".", "/", $content);
        $content = preg_replace("/[位名各-]/u", "/", $content);
        $content = preg_replace("/(和|合|H|h)\//u", "$1", $content);
        $content = preg_replace("/[和合Hh]/u", "和/", $content);
        $content = preg_replace("/(大单|小单|大双|小双|大|小|单|双|龙|虎)\//u", "$1", $content);
        $content = preg_replace("/\/(大单|小单|大双|小双|大|小|单|双|龙|虎)/u", "$1", $content);
        $content = preg_replace("/(大单|小单|大双|小双|大|小|单|双|龙|虎)/u", "/$1/", $content);*/
    //$content = preg_replace("/(鼠|牛|虎|兔|龙|蛇|马|羊|猴|鸡|狗|猪|大|小|单|双|红波|蓝波|绿波)\//u", "$1", $content);
    //$content = preg_replace("/\/(鼠|牛|虎|兔|龙|蛇|马|羊|猴|鸡|狗|猪|大|小|单|双|红波|蓝波|绿波)/u", "$1", $content);
    //$content = preg_replace("/(鼠|牛|虎|兔|龙|蛇|马|羊|猴|鸡|狗|猪|大|小|单|双|红波|蓝波|绿波)/u", "/$1/", $content);

    if ($BetGame == 'lhc') {
        $table = 'fn_lottery13';
    } elseif ($BetGame == 'jslhc') {
        $table = 'fn_lottery14';
    }
    switch ($BetGame) {
        case 'lhc':
            $table = 'fn_lottery13';
            $ordertable = "fn_lhcorder";
            break;
        case 'jslhc':
            $table = 'fn_lottery14';
            $ordertable = "fn_jslhcorder";
            break;
    }
    $sx_min = get_query_val($table, 'shengxiao_min', array('roomid' => $postRoomid));
    $sx_max = get_query_val($table, 'shengxiao_max', array('roomid' => $postRoomid));
    $dx_min = get_query_val($table, 'daxiao_min', array('roomid' => $postRoomid));
    $dx_max = get_query_val($table, 'daxiao_max', array('roomid' => $postRoomid));
    $ds_min = get_query_val($table, 'danshuang_min', array('roomid' => $postRoomid));
    $ds_max = get_query_val($table, 'danshuang_max', array('roomid' => $postRoomid));
    $sb_min = get_query_val($table, 'sebo_min', array('roomid' => $postRoomid));
    $sb_max = get_query_val($table, 'sebo_max', array('roomid' => $postRoomid));
    $hm_min = get_query_val($table, 'haoma_min', array('roomid' => $postRoomid));
    $hm_max = get_query_val($table, 'haoma_max', array('roomid' => $postRoomid));
    $lx_min = get_query_val($table, 'lianxiao_min', array('roomid' => $postRoomid));
    $lx_max = get_query_val($table, 'lianxiao_max', array('roomid' => $postRoomid));
    $lm_min = get_query_val($table, 'lianma_min', array('roomid' => $postRoomid));
    $lm_max = get_query_val($table, 'lianma_max', array('roomid' => $postRoomid));

    $zym_8 = get_query_val('fn_user', 'jia', array('userid' => $userid, 'roomid' => $postRoomid)) == 'true' ? 'true' : 'false';
    $touzhu = false;
    $A = explode(" ", $content);
    $zym_2 = "";
    foreach ($A as $ai) {
        $ai = str_replace(" ", "", $ai); //把空格替换没
        if (empty($ai)) continue; //判断是否空
        //if (substr($ai, 0, 1) == '/') $ai = '7' . $ai; //默认是7
        $b = explode("/", $ai); //$b用/分割
        //if (count($b) != 3) continue; //添加完不等于3的话 结束循环
        $zym_9 = 查询用户余额($userid); //查询用户余额
        if (count($b) == 3) {
            if ($b[0] == "" || $b[1] == "" || (int)$b[2] < 1) continue; //第一位或者第二位不存在，第三位小于0 结束循环
            $zym_10 = $b[0];
            $zym_6 = $b[1];
            $zym_5 = (int)$b[2];
        } else {
            $zym_10 = '';
            $zym_6 = $b[0];
            $zym_5 = (int)$b[1];
        }
        //正特码波色竞猜
        //竞猜对象为正特码，默认竞猜特码，也可竞猜正码1~6。竞猜位置波色与开奖相同则为中奖，否则为不中！
        //红波：01，02，07，08，12，13，18，19，23，24，29，30，34，35，40，45，46
        //蓝波：03，04，09，10，14，15，20，25，26，31，36，37，41，42，47，48
        //绿波：05，06，11，16，17，21，22，27，28，32，33，38，39，43，44，49
        //竞猜奖励：
        //红波】2.8倍含本，单限：2000，总限：50000
        //【蓝波】2.97倍含本，单限：2000，总限：50000
        //【绿波】2.97倍含本，单限：2000，总限：50000
        //最小限额：10
        //竞猜格式：球号码/波色/金额
        //竞猜例子：
        //1/红波/100 为 正码1买红波100
        //红波/100 为 特码买红波100
        //12/红波/100 为 正码1，2买红波各100
        //红波/100 = 7/红波/100 特码快捷下注。
        if ($zym_6 == '红波' || $zym_6 == '蓝波' || $zym_6 == '绿波') {
            /*默认7 start*/
            if (count($b) == 2) { //如果分割完就两个的话 添加默认第一个数是7 特码
                $ai = '7/' . $ai;
                $b = explode("/", $ai);
            }
            if (count($b) != 3) continue; //添加完不等于3的话 结束循环
            if ($b[0] == "" || $b[1] == "" || (int)$b[2] < 1) continue; //第一位或者第二位不存在，第三位小于0 结束循环
            $zym_10 = $b[0];
            $zym_6 = $b[1];
            $zym_5 = (int)$b[2];
            /*默认7 end*/
            //分割
            $zym_10_分割 = 文本_逐字分割($zym_10); //分割竞猜号
            foreach ($zym_10_分割 as $ii) {
                //检查
                if (!is_numeric($ii)) { //判断是否是数字
                    break;
                } elseif ($zym_9 < count($zym_10_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $sb_min || sum_betmoney($ordertable, $ii, $zym_6, $userid, $addQihao) + $zym_5 > $sb_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            }
        }

        if (empty($zym_10)) {
            //正特生肖（单肖）竞猜
            //竞猜对象正特码。一个生肖为竞猜单位，开奖结果含竞猜的生肖则为中奖，否则为不中！
            //如：竞猜狗，开奖结果中含有生肖狗，则中奖，否则为不中。
            //竞猜奖励：
            //【生肖狗】1.77倍含本，单限：2000，总限:50000
            //【其他生肖】2.09倍含本，单限：2000，总限:50000
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：生肖/金额
            //竞猜例子：
            //狗/100 为 买生肖狗各100
            //狗牛/100 为 买生肖狗牛各100。
            if (strpos($zym_6, '鼠') !== false || strpos($zym_6, '牛') !== false || strpos($zym_6, '虎') !== false || strpos($zym_6, '兔') !== false || strpos($zym_6, '龙') !== false || strpos($zym_6, '蛇') !== false || strpos($zym_6, '马') !== false || strpos($zym_6, '羊') !== false || strpos($zym_6, '猴') !== false || strpos($zym_6, '鸡') !== false || strpos($zym_6, '狗') !== false || strpos($zym_6, '猪') !== false) {
                $zym_6_分割 = 文本_逐字分割($zym_6);
                foreach ($zym_6_分割 as $ii) {
                    if ($zym_9 < count($zym_6_分割) * (int)$zym_5) {
                        $zym_2 = $zym_2 . $zym_6 . "/" . $zym_5 . " ";
                        break;
                    } else if ($zym_5 < $sx_min || sum_betmoney($ordertable, '', $ii, $userid, $addQihao) + $zym_5 > $sx_max) {
                        $zym_2 = $zym_2 . $zym_6 . "/" . $zym_5 . " ";
                        $chaozhu = true;
                        continue;
                    }
                    $touzhu = true;
                    用户_下分($userid, $zym_5);

                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => '', 'content' => $ii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }


            //正码竞猜
            //竞猜对象为正码(开奖的前6个球)。一个数字1注（竞猜01~49）开奖结果中含竞猜数字既中奖，否则不中。
            //竞猜奖励：含本7.21倍
            //下注限额：10-2000
            //单期上限50000
            //竞猜格式：数字/金额
            //竞猜例子：
            //45/100 为 45号买100
            //33.48/100 为 43,48号各买100 总200
            $zym_6_分割 = explode('.', $zym_6);
            foreach ($zym_6_分割 as $ii) {
                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) {
                    $zym_2 = $zym_2 . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } else if (!is_numeric($ii)) {
                    continue;
                } else if ($ii > 49) {
                    continue;
                } else if ($zym_5 < $hm_min || $zym_5 > $hm_max) {
                    $zym_2 = $zym_2 . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => '', 'content' => $ii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            }

        }
        if (!empty($zym_10)) {

            //2肖竞猜
            //竞猜对象为正特码。一注竞猜2个不同生肖，开奖结果中含竞猜的2各生肖即中奖，否则为不中。
            //竞猜奖励：
            //【含狗】4.06倍含本，单限：2000，总限：50000
            //【不含狗】4.57倍含本，单限：2000，总限：50000
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：2肖/生肖/金额
            //竞猜例子：
            //2肖/牛狗/100 为 购买牛狗100
            //2肖/牛狗.牛鸡/100 为 购买牛狗，牛鸡各100总200
            //2肖/牛狗鸡/100 为 复式购买牛狗，牛鸡，狗鸡各100，总300
            //如果竞猜的生肖超过2各则用复式下注
            if ($zym_10 == '2肖') {
                $shengxiao = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
                if (mb_strlen($zym_6, 'UTF-8') == 2) {
                    $zym_6_分割[0] = $zym_6;
                } elseif (strpos($zym_6, '.') !== false) {
                    $zym_6_分割 = explode('.', $zym_6);
                    foreach ($zym_6_分割 as $v) {
                        if (mb_strlen($v, 'UTF-8') != 2) {
                            break;
                        }
                    }
                } elseif (mb_strlen($zym_6, 'UTF-8') > 2) {
                    $zym_6_分割 = 文本_逐字分割($zym_6);
                    if (count($zym_6_分割) != count(array_unique($zym_6_分割))) break; //有重复
                    for ($i = count($zym_6_分割) - 1; $i >= 0; $i--) {
                        for ($ii = 0; $ii < $i; $ii++) {
                            $_zym_6_分割[] = $zym_6_分割[$i] . $zym_6_分割[$ii];
                        }
                    }
                    $zym_6_分割 = $_zym_6_分割;
                }

                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                }

                if ($zym_5 < $lx_min || $zym_5 > $lx_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }

                foreach ($zym_6_分割 as $v) {
                    $v_分割 = 文本_逐字分割($v);
                    foreach ($v_分割 as $vv) {
                        if (!in_array($v, $shengxiao)) {
                            break;
                        }
                    }
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $v, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }

            //3肖竞猜
            //竞猜对象为正特码。一注竞猜3个不同生肖，开奖结果中含竞猜的3各生肖即中奖，否则为不中。
            //竞猜奖励：
            //【含狗】10.76倍含本，单限：2000，总限：50000
            //【不含狗】11.65倍含本，单限：2000，总限：50000
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：3肖/生肖/金额
            //竞猜例子：
            //3肖/牛狗鸡/100 为 购买牛狗鸡100
            //3肖/牛狗鸡.牛鸡猪/100 为 购买牛狗鸡，牛鸡猪各100总200
            //3肖/牛狗鸡猪/100 为 复式购买牛狗，牛狗鸡，牛狗主，牛鸡猪，狗鸡猪各100，总400
            //如果竞猜的生肖超过3各则用复式下注
            if ($zym_10 == '3肖') {
                $shengxiao = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
                if (mb_strlen($zym_6, 'UTF-8') == 3) {
                    if ($zym_6_分割[0] == $zym_6_分割[1] || $zym_6_分割[1] == $zym_6_分割[2] || $zym_6_分割[0] == $zym_6_分割[2]) {
                        break;
                    }
                    $zym_6_分割[0] = $zym_6;
                } elseif (strpos($zym_6, '.') !== false) {
                    $zym_6_分割 = explode('.', $zym_6);
                    foreach ($zym_6_分割 as $v) {
                        if (mb_strlen($v, 'UTF-8') != 3) {
                            break;
                        }
                    }
                } elseif (mb_strlen($zym_6, 'UTF-8') > 3) {
                    $zym_6_分割 = 文本_逐字分割($zym_6);
                    if (count($zym_6_分割) != count(array_unique($zym_6_分割))) break; //有重复
                    for ($i = count($zym_6_分割) - 1; $i >= 0; $i--) {
                        for ($ii = 0; $ii < $i; $ii++) {
                            for ($iii = 0; $iii < $ii; $iii++) {
                                $_zym_6_分割[] = $zym_6_分割[$i] . $zym_6_分割[$ii] . $zym_6_分割[$iii];
                            }
                        }
                    }
                    $zym_6_分割 = $_zym_6_分割;
                }

                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                }

                if ($zym_5 < $lx_min || $zym_5 > $lx_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }

                foreach ($zym_6_分割 as $v) {
                    $v_分割 = 文本_逐字分割($v);
                    foreach ($v_分割 as $vv) {
                        if (!in_array($v, $shengxiao)) {
                            break;
                        }
                    }
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $v, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }

            //4肖竞猜
            //竞猜对象为正特码。一注竞猜4个不同生肖，开奖结果中含竞猜的4各生肖即中奖，否则为不中。
            //竞猜奖励：
            //【含狗】32.07倍含本，单限：2000，总限：50000
            //【不含狗】34.08倍含本，单限：2000，总限：50000
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：4肖/生肖/金额
            //竞猜例子：
            //4肖/牛狗鸡猪/100 为 购买牛狗鸡猪100
            //4肖/牛狗.牛鸡/100 为 购买牛狗，牛鸡各100总200
            //多注之间生肖.分开
            //如果竞猜的生肖超过4各则用复式下注
            if ($zym_10 == '4肖') {
                $shengxiao = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
                if (mb_strlen($zym_6, 'UTF-8') == 4) {
                    if ($zym_6_分割[0] == $zym_6_分割[1] || $zym_6_分割[1] == $zym_6_分割[2] || $zym_6_分割[2] == $zym_6_分割[3] || $zym_6_分割[0] == $zym_6_分割[3]) {
                        break;
                    }
                    $zym_6_分割[0] = $zym_6;
                } elseif (strpos($zym_6, '.') !== false) {
                    $zym_6_分割 = explode('.', $zym_6);
                    foreach ($zym_6_分割 as $v) {
                        if (mb_strlen($v, 'UTF-8') != 4) {
                            break;
                        }
                    }
                } elseif (mb_strlen($zym_6, 'UTF-8') > 4) {
                    $zym_6_分割 = 文本_逐字分割($zym_6);
                    if (count($zym_6_分割) != count(array_unique($zym_6_分割))) break; //有重复
                    for ($i = count($zym_6_分割) - 1; $i >= 0; $i--) {
                        for ($ii = 0; $ii < $i; $ii++) {
                            for ($iii = 0; $iii < $ii; $iii++) {
                                for ($iiii = 0; $iiii < $iii; $iiii++) {
                                    $_zym_6_分割[] = $zym_6_分割[$i] . $zym_6_分割[$ii] . $zym_6_分割[$iii] . $zym_6_分割[$iiii];
                                }
                            }
                        }
                    }
                    $zym_6_分割 = $_zym_6_分割;
                }

                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                }

                if ($zym_5 < $lx_min || $zym_5 > $lx_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }

                foreach ($zym_6_分割 as $v) {
                    $v_分割 = 文本_逐字分割($v);
                    foreach ($v_分割 as $vv) {
                        if (!in_array($v, $shengxiao)) {
                            break;
                        }
                    }
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $v, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }

            //5肖竞猜
            //竞猜对象为正特码。一注竞猜5个不同生肖，开奖结果中含竞猜的5各生肖即中奖，否则为不中。
            //竞猜奖励：
            //【含狗】115.01倍含本，单限：2000，总限：50000
            //【不含狗】120.86倍含本，单限：2000，总限：50000
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：5肖/生肖/金额
            //竞猜例子：
            //5肖/牛狗鸡猪鼠/100 为 购买牛狗鸡猪鼠100
            //多注之间生肖.分开
            //如果竞猜的生肖超过5各则用复式下注
            if ($zym_10 == '5肖') {
                $shengxiao = array('鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪');
                if (mb_strlen($zym_6, 'UTF-8') == 5) {
                    if ($zym_6_分割[0] == $zym_6_分割[1] || $zym_6_分割[1] == $zym_6_分割[2] || $zym_6_分割[2] == $zym_6_分割[3] || $zym_6_分割[3] == $zym_6_分割[4] || $zym_6_分割[0] == $zym_6_分割[4]) {
                        break;
                    }
                    $zym_6_分割[0] = $zym_6;
                } elseif (strpos($zym_6, '.') !== false) {
                    $zym_6_分割 = explode('.', $zym_6);
                    foreach ($zym_6_分割 as $v) {
                        if (mb_strlen($v, 'UTF-8') != 5) {
                            break;
                        }
                    }
                } elseif (mb_strlen($zym_6, 'UTF-8') > 5) {
                    $zym_6_分割 = 文本_逐字分割($zym_6);
                    if (count($zym_6_分割) != count(array_unique($zym_6_分割))) break; //有重复
                    for ($i = count($zym_6_分割) - 1; $i >= 0; $i--) {
                        for ($ii = 0; $ii < $i; $ii++) {
                            $_zym_6_分割[] = $zym_6_分割[$i] . $zym_6_分割[$ii];
                        }
                    }
                    $zym_6_分割 = $_zym_6_分割;
                }

                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                }

                if ($zym_5 < $lx_min || $zym_5 > $lx_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }

                foreach ($zym_6_分割 as $v) {
                    $v_分割 = 文本_逐字分割($v);
                    foreach ($v_分割 as $vv) {
                        if (!in_array($v, $shengxiao)) {
                            break;
                        }
                    }
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $v, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }

            //正码2中2竞猜
            //竞猜对象为正码。一主竞猜2个不同的数字，开奖结果正码（前6个数字）中含竞猜的2数字即中奖，否则为 不中
            //竞猜奖励：含本65倍
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：2中/数字/金额
            //竞猜例子:
            //2中/12.13/100 为 购买12.13一注100
            //2中/12.13.22/100 为 购买 12.13，12.22，12.13共3注 总300
            if ($zym_10 == '2中') {
                if (strpos($zym_6, '.') === false) {
                    break;
                }
                $zym_6_分割 = explode('.', $zym_6);
                if ($zym_6_分割[0] == $zym_6_分割[1]) break;
                if (count($zym_6_分割) >= 2) {
                    if (count($zym_6_分割) != count(array_unique($zym_6_分割))) break; //有重复
                    for ($i = count($zym_6_分割) - 1; $i >= 0; $i--) {
                        for ($ii = 0; $ii < $i; $ii++) {
                            $_zym_6_分割[] = $zym_6_分割[$i] . '.' . $zym_6_分割[$ii];
                        }
                    }
                    $zym_6_分割 = $_zym_6_分割;
                }

                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                }

                if ($zym_5 < $lm_min || $zym_5 > $lm_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }

                foreach ($zym_6_分割 as $v) {
                    if (count(explode('.', $v)) != 2) {
                        $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                        break;
                    }
                    foreach (explode('.', $v) as $vv) {
                        if (!is_numeric($vv)) {
                            break;
                        }
                    }
                }
                foreach ($zym_6_分割 as $v) {
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $v, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }

            //正码3中3竞猜
            //竞猜对象为正码。一主竞猜2个不同的数字，开奖结果正码（前6个数字）中含竞猜的2数字即中奖，否则为 不中
            //竞猜奖励：含本680倍
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：3中/数字/金额
            //竞猜例子:
            //3中/12.13.18/100 为 购买12.13.18一注100
            //如果竞猜数字超过3个则使用复式购买
            if ($zym_10 == '3中') {
                if (strpos($zym_6, '.') === false) {
                    break;
                }
                $zym_6_分割 = explode('.', $zym_6);
                if ($zym_6_分割[0] == $zym_6_分割[1] || $zym_6_分割[1] == $zym_6_分割[2] || $zym_6_分割[0] == $zym_6_分割[2]) break;
                if (count($zym_6_分割) >= 3) {
                    if (count($zym_6_分割) != count(array_unique($zym_6_分割))) break; //有重复
                    for ($i = count($zym_6_分割) - 1; $i >= 0; $i--) {
                        for ($ii = 0; $ii < $i; $ii++) {
                            for ($iii = 0; $iii < $ii; $iii++) {
                                $_zym_6_分割[] = $zym_6_分割[$i] . '.' . $zym_6_分割[$ii] . '.' . $zym_6_分割[$iii];
                            }
                        }
                    }
                    $zym_6_分割 = $_zym_6_分割;
                }

                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                }

                if ($zym_5 < $lm_min || $zym_5 > $lm_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }

                foreach ($zym_6_分割 as $v) {
                    if (count(explode('.', $v)) != 3) {
                        $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                        break;
                    }
                    foreach (explode('.', $v) as $vv) {
                        if (!is_numeric($vv)) {
                            break;
                        }
                    }
                }
                foreach ($zym_6_分割 as $v) {
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $v, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }

            //正码4中4竞猜
            //竞猜对象为正码。一主竞猜2个不同的数字，开奖结果正码（前6个数字）中含竞猜的2数字即中奖，否则为 不中
            //竞猜奖励：含本4800倍
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：2中/数字/金额
            //竞猜例子:
            //4中/12.13.32.44/100 为 购买12.13.32.44一注100
            //如果竞猜数字超过4个则使用复式购买
            if ($zym_10 == '4中') {
                if (strpos($zym_6, '.') === false) {
                    break;
                }
                $zym_6_分割 = explode('.', $zym_6);
                if ($zym_6_分割[0] == $zym_6_分割[1] || $zym_6_分割[1] == $zym_6_分割[2] || $zym_6_分割[2] == $zym_6_分割[3] || $zym_6_分割[0] == $zym_6_分割[3]) break;
                if (count($zym_6_分割) >= 4) {
                    if (count($zym_6_分割) != count(array_unique($zym_6_分割))) break; //有重复
                    for ($i = count($zym_6_分割) - 1; $i >= 0; $i--) {
                        for ($ii = 0; $ii < $i; $ii++) {
                            for ($iii = 0; $iii < $ii; $iii++) {
                                for ($iiii = 0; $iiii < $iii; $iiii++) {
                                    $_zym_6_分割[] = $zym_6_分割[$i] . '.' . $zym_6_分割[$ii] . '.' . $zym_6_分割[$iii] . '.' . $zym_6_分割[$iiii];
                                }
                            }
                        }
                    }
                    $zym_6_分割 = $_zym_6_分割;
                }

                if ($zym_9 < count($zym_6_分割) * (int)$zym_5) { //检查超注
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                }

                if ($zym_5 < $lm_min || $zym_5 > $lm_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }

                foreach ($zym_6_分割 as $v) {
                    if (count(explode('.', $v)) != 4) {
                        $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                        break;
                    }
                    foreach (explode('.', $v) as $vv) {
                        if (!is_numeric($vv)) {
                            break;
                        }
                    }
                }
                foreach ($zym_6_分割 as $v) {
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $v, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }


            //竞猜大小单双
            //精彩对象为正特码（1~7球）.开奖结果与所竞猜相同则为中奖，其余为不中，如果竞猜结果是49为和竞猜还本。
            //小：01~24为小（含24）
            //大：25~48为大（含48）
            //单：01，03...45，47，不能整除2的奇数。
            //双：02，04...46，48；整除2的偶数。
            //和：49（开和竞猜大小单双还本）
            //竞猜奖励：含本1.98倍
            //下注限额10-2000
            //竞猜格式：球号/大小单双/金额
            //竞猜例子：大100 为 竞猜特码大100
            //12大100 为 1，2号球大各100 总200
            if ($zym_6 == '大' || $zym_6 == '小' || $zym_6 == '单' || $zym_6 == '双') {
                //分割
                $zym_10_分割 = 文本_逐字分割($zym_10); //分割竞猜号
                foreach ($zym_10_分割 as $ii) {
                    //检查
                    if (!is_numeric($ii)) { //判断是否是数字
                        break;
                    } elseif ($zym_9 < count($zym_10_分割) * (int)$zym_5) { //检查超注
                        $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                        break;
                    } elseif (($zym_6 == '大' || $zym_6 == '小') && $zym_5 < $dx_min || $zym_5 > $dx_max) {
                        echo $dx_min . '-' . $dx_max . '|' . $zym_5;
                        exit;
                        $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                        $chaozhu = true;
                        continue;
                    } elseif (($zym_6 == '单' || $zym_6 == '双') && $zym_5 < $ds_min || $zym_5 > $ds_max) {
                        $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                        $chaozhu = true;
                        continue;
                    }
                    $touzhu = true;
                    用户_下分($userid, $zym_5);
                    insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                }
            }

            //正特生肖定位竞猜
            //竞猜对象为正特码（1~7球）.竞猜生肖与开奖相同则为中奖，否则为不中！
            //如：竞猜特码狗，开奖结果为特码为狗，则中奖，其他情况为不中
            //如：竞猜正码1狗，开奖结果正码1为狗，则中奖，其他情况为不中。
            //竞猜奖励：生肖狗9.36倍含本，单限：2000，总限：50000
            //1/狗牛/100 为 正码1买生肖狗牛各100
            //7/狗牛/100 为 特码买生肖狗牛各100
            //12/狗牛/100 为 正码1,2买生肖狗牛各100
            if ((strpos($zym_6, '鼠') !== false || strpos($zym_6, '牛') !== false || strpos($zym_6, '虎') !== false || strpos($zym_6, '兔') !== false || strpos($zym_6, '龙') !== false || strpos($zym_6, '蛇') !== false || strpos($zym_6, '马') !== false || strpos($zym_6, '羊') !== false || strpos($zym_6, '猴') !== false || strpos($zym_6, '鸡') !== false || strpos($zym_6, '狗') !== false || strpos($zym_6, '猪') !== false) && ($zym_10 != '2肖' && $zym_10 != '3肖' && $zym_10 != '4肖' && $zym_10 != '5肖')) {
                //分割
                $zym_10_分割 = 文本_逐字分割($zym_10); //分割竞猜号
                $zym_6_分割 = 文本_逐字分割($zym_6);
                foreach ($zym_10_分割 as $ii) {
                    //检查
                    if (!is_numeric($ii)) { //判断是否是数字 必要
                        break;
                    } elseif ($ii > 7) {
                        break;
                    } elseif ($zym_9 < count($zym_10_分割) * count($zym_6_分割) * (int)$zym_5) { //检查超注 必要
                        $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                        break;
                    }
                    foreach ($zym_6_分割 as $iii) {
                        if ($zym_5 < $sx_min || sum_betmoney($ordertable, $ii, $iii, $userid, $addQihao) + $zym_5 > $sx_max) { //检查单注最大投注 必要
                            $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                            $chaozhu = true;
                            continue;
                        }
                        $touzhu = true;
                        用户_下分($userid, $zym_5);
                        insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $iii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                    }
                }
            }

            //正特码定位竞猜
            //竞猜对象为正特码（1~7球）。一个数字1注（竞猜01~49），竞猜球号数字与开奖数字相同则为中奖，否则为不中！
            //竞猜奖励：含本47.25倍
            //下注限额：10-2000
            //单期上限：50000
            //竞猜格式：球号/数字/金额
            //竞猜例子：7/45/100 为 特码45号100
            //7/33.48/100 为 特码43，48号各100 总200
            //12/20.12/100 为1,2号球20,12号各100 总400
            if ($zym_10 != '2中' && $zym_10 != '3中' && $zym_10 != '4中') {
                $zym_6_分割 = explode('.', $zym_6);
                $zym_10_分割 = 文本_逐字分割($zym_10);
                foreach ($zym_10_分割 as $ii) {
                    if ($zym_9 < count($zym_10_分割) * count($zym_6_分割) * (int)$zym_5) {
                        $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                        break;
                    } else if (!is_numeric($ii)) {
                        continue;
                    } else if ($ii > 7) {
                        continue;
                    }
                    foreach ($zym_6_分割 as $iii) {
                        if (!is_numeric($iii)) {
                            continue;
                        } else if ($zym_5 < $hm_min || sum_betmoney($ordertable, $ii, $iii, $userid, $addQihao) + $zym_5 > $hm_max) {
                            $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                            $chaozhu = true;
                            continue;
                        } else if ($iii > 49) {
                            continue;
                        }
                        $touzhu = true;
                        用户_下分($userid, $zym_5);
                        insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $iii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                    }
                }
            }
        }
    }

    if ($zym_2 != "") {
        if ($chaozhu) {
            管理员喊话("@{$nickname},您的:{$zym_2}未接<br>您的投注已超出限制！<br>本房投注限制如下:<br>大小最低{$dx_min}起,最高{$dx_max}<br>单双最低{$ds_min}起,最高{$ds_max}<br>龙虎最低{$lh_min}起,最高{$lh_max}<br>特码最低{$tm_min}起,最高{$tm_max}<br>和值最低{$hz_min}起,最高{$hz_max}<br>------------<br>最高投注均为已下注总注");

            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } else {
            管理员喊话("@{$nickname},您的:{$zym_2}未接，您的余额：" . 查询用户余额($userid));
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        }
    } elseif (get_query_val("fn_setting", "setting_tishi", array("roomid" => $postRoomid)) == 'open' && $touzhu == true) {
        管理员喊话("@$nickname,投注成功！请选择左侧菜单核对投注！");
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    } elseif ($touzhu) {
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    }
    $carr[0] = false;
    $carr[1] = $chat_id;
    return $carr;
}

function addK3Bet($userid, $nickname, $headimg, $content, $addQihao, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    if ($fengpan) {
        管理员喊话("@" . $nickname . " ,[$addQihao]期已经停止投注！下注无效！");
        $carr[0] = false;
        $carr[1] = $chat_id;
        return $carr;
    }
    $content = str_replace(".", "/", $content);
    $content = preg_replace("/[点草艹操,-]/u", "/", $content);
    switch ($BetGame) {
        case 'kuai3':
            $table = 'fn_lottery9';
            $ordertable = 'fn_k3order';
            break;
        case 'twk3':
            $table = 'fn_lottery15';
            $ordertable = 'fn_twk3order';
            break;
    }
    $touzhu = false;
    $chaozhu = false;
    $jinzhi = false;
    $A = explode(' ', $content);
    $jia = get_query_val('fn_user', 'jia', array('userid' => $userid, 'roomid' => $postRoomid)) == 'true' ? 'true' : 'false';
    $zym_2 = "";
    foreach ($A as $i) {
        $i = str_replace(" ", "", $i);
        if (empty($i))
            continue;
        $b = explode('/', $i);
        $yue = 查询用户余额($userid);
        $mingci = $b[0];
        $neirong = $b[1];
        $jine = (int)$b[2];
        if ((int)$yue < (int)$jine) {
            $zym_2 .= $mingci . "/" . $neirong . "/" . $jine . " ";
            continue;
        }
        $dx_max = (int)get_query_val($table, 'dx_max', array('roomid' => $postRoomid));
        $dx_min = (int)get_query_val($table, 'dx_min', array('roomid' => $postRoomid));
        $ds_max = (int)get_query_val($table, 'ds_max', array('roomid' => $postRoomid));
        $ds_min = (int)get_query_val($table, 'ds_min', array('roomid' => $postRoomid));
        $dadan_max = (int)get_query_val($table, 'dadan_max', array('roomid' => $postRoomid));
        $dadan_min = (int)get_query_val($table, 'dadan_min', array('roomid' => $postRoomid));
        $xiaodan_max = (int)get_query_val($table, 'xiaodan_max', array('roomid' => $postRoomid));
        $xiaodan_min = (int)get_query_val($table, 'xiaodan_min', array('roomid' => $postRoomid));
        $dashuang_max = (int)get_query_val($table, 'dashuang_max', array('roomid' => $postRoomid));
        $dashuang_min = (int)get_query_val($table, 'dashuang_min', array('roomid' => $postRoomid));
        $xiaoshuang_max = (int)get_query_val($table, 'xiaoshuang_max', array('roomid' => $postRoomid));
        $xiaoshuang_min = (int)get_query_val($table, 'xiaoshuang_min', array('roomid' => $postRoomid));
        $tong_baozi_max = (int)get_query_val($table, 'tong_baozi_max', array('roomid' => $postRoomid));
        $tong_baozi_min = (int)get_query_val($table, 'tong_baozi_min', array('roomid' => $postRoomid));
        $tong_shunzi_max = (int)get_query_val($table, 'tong_shunzi_max', array('roomid' => $postRoomid));
        $tong_shunzi_min = (int)get_query_val($table, 'tong_shunzi_min', array('roomid' => $postRoomid));
        $tong_duizi_max = (int)get_query_val($table, 'tong_duizi_max', array('roomid' => $postRoomid));
        $tong_duizi_min = (int)get_query_val($table, 'tong_duizi_min', array('roomid' => $postRoomid));
        $tong_sanza_max = (int)get_query_val($table, 'tong_sanza_max', array('roomid' => $postRoomid));
        $tong_sanza_min = (int)get_query_val($table, 'tong_sanza_min', array('roomid' => $postRoomid));
        $tong_erza_max = (int)get_query_val($table, 'tong_erza_max', array('roomid' => $postRoomid));
        $tong_erza_min = (int)get_query_val($table, 'tong_erza_min', array('roomid' => $postRoomid));
        $zhi_baozi_max = (int)get_query_val($table, 'zhi_baozi_max', array('roomid' => $postRoomid));
        $zhi_baozi_min = (int)get_query_val($table, 'zhi_baozi_min', array('roomid' => $postRoomid));
        $zhi_shunzi_max = (int)get_query_val($table, 'zhi_shunzi_max', array('roomid' => $postRoomid));
        $zhi_shunzi_min = (int)get_query_val($table, 'zhi_shunzi_min', array('roomid' => $postRoomid));
        $zhi_duizi_max = (int)get_query_val($table, 'zhi_duizi_max', array('roomid' => $postRoomid));
        $zhi_duizi_min = (int)get_query_val($table, 'zhi_duizi_min', array('roomid' => $postRoomid));
        $zhi_sanza_max = (int)get_query_val($table, 'zhi_sanza_max', array('roomid' => $postRoomid));
        $zhi_sanza_min = (int)get_query_val($table, 'zhi_sanza_min', array('roomid' => $postRoomid));
        $zhi_erza_max = (int)get_query_val($table, 'zhi_erza_max', array('roomid' => $postRoomid));
        $zhi_erza_min = (int)get_query_val($table, 'zhi_erza_min', array('roomid' => $postRoomid));
        $zhi_sanjun_max = (int)get_query_val($table, 'zhi_sanjun_max', array('roomid' => $postRoomid));
        $zhi_sanjun_min = (int)get_query_val($table, 'zhi_sanjun_min', array('roomid' => $postRoomid));
        switch ($neirong) {
            case '大':
            case '小':
                $max = $dx_max;
                $min = $dx_min;
                break;
            case '单':
            case '双':
                $max = $ds_max;
                $min = $ds_min;
                break;
            case '大单':
                $max = $dadan_max;
                $min = $dadan_min;
                break;
            case '小单':
                $max = $xiaodan_max;
                $min = $xiaodan_min;
                break;
            case '大双':
                $max = $dashuang_max;
                $min = $dashuang_min;
                break;
            case '小双':
                $max = $xiaoshuang_max;
                $min = $xiaoshuang_min;
                break;
            case '顺子':
                $max = $tong_shunzi_max;
                $min = $tong_shunzi_min;
                break;
            case '豹子':
                $max = $tong_baozi_max;
                $min = $tong_baozi_min;
                break;
            case '对子':
                $max = $tong_duizi_max;
                $min = $tong_duizi_min;
                break;
            case '三杂':
                $max = $tong_sanza_max;
                $min = $tong_sanza_min;
                break;
            case '二杂':
                $max = $tong_erza_max;
                $min = $tong_erza_min;
                break;
            case '111':
            case '222':
            case '333':
            case '444':
            case '555':
            case '666':
                $max = $zhi_baozi_max;
                $min = $zhi_baozi_min;
                break;
            case '11':
            case '22':
            case '33':
            case '44':
            case '55':
            case '66':
                $max = $zhi_duizi_max;
                $min = $zhi_duizi_min;
                break;
            case '123':
            case '234':
            case '345':
            case '456':
                $max = $zhi_shunzi_max;
                $min = $zhi_shunzi_min;
                break;
            case '123':
            case '124':
            case '125':
            case '126':
            case '134':
            case '135':
            case '136':
            case '145':
            case '146':
            case '156':
            case '234':
            case '235':
            case '236':
            case '245':
            case '246':
            case '256':
            case '345':
            case '346':
            case '356':
            case '456':
                $max = $zhi_sanza_max;
                $min = $zhi_sanza_min;
                break;
            case '12':
            case '13':
            case '14':
            case '15':
            case '16':
            case '23':
            case '24':
            case '25':
            case '26':
            case '34':
            case '35':
            case '36':
            case '45':
            case '46':
            case '56':
                $max = $zhi_erza_max;
                $min = $zhi_erza_min;
                break;
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
                $max = $zhi_sanjun_max;
                $min = $zhi_sanjun_min;
                break;

        }
        if ($neirong == '大' || $neirong == '小' || $neirong == '单' || $neirong == '双' || $neirong == '大单' || $neirong == '小单' || $neirong == '大双' || $neirong == '小双' || $neirong == '顺子' || $neirong == '豹子' || $neirong == '对子' || $neirong == '三杂' || $neirong == '二杂' || $neirong == '123' || $neirong == '234' || $neirong == '345' || $neirong == '456' || $neirong == '111' || $neirong == '222' || $neirong == '333' || $neirong == '444' || $neirong == '555' || $neirong == '666' || $neirong == '1' || $neirong == '2' || $neirong == '3' || $neirong == '4' || $neirong == '5' || $neirong == '6' || $neirong == '11' || $neirong == '22' || $neirong == '33' || $neirong == '44' || $neirong == '55' || $neirong == '66' || $neirong == '123' || $neirong == '124' || $neirong == '125' || $neirong == '126' || $neirong == '134' || $neirong == '135' || $neirong == '136' || $neirong == '145' || $neirong == '146' || $neirong == '156' || $neirong == '234' || $neirong == '235' || $neirong == '236' || $neirong == '245' || $neirong == '246' || $neirong == '256' || $neirong == '345' || $neirong == '346' || $neirong == '356' || $neirong == '456' || $neirong == '12' || $neirong == '13' || $neirong == '14' || $neirong == '15' || $neirong == '16' || $neirong == '23' || $neirong == '24' || $neirong == '25' || $neirong == '26' || $neirong == '34' || $neirong == '35' || $neirong == '36' || $neirong == '45' || $neirong == '46' || $neirong == '56') {
            if ($jine > $max) {
                $chaozhu = true;
                $zym_2 = $mingci . '/' . $neirong . '/' . $jine;
                continue;
            } else if ($min > $jine) {
                $zym_2 = $mingci . '/' . $neirong . '/' . $jine;
                continue;
            }

            $touzhu = true;
            用户_下分($userid, $jine);
            insert_query($ordertable, array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'mingci' => $mingci, 'content' => $neirong, 'money' => $jine, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $jia));
            continue;
        }
    }
    if ($zym_2 != "") {
        if ($chaozhu) {
            管理员喊话("@$nickname,本次投注已超注！投注无效");
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } elseif ($jinzhi) {
            $nr = "";
            if ($zym_4 == 'true') {
                $nr .= '[禁止杀组合]';
            }
            if ($zym_1 == 'true') {
                $nr .= '[禁止同向组合]';
            }
            if ($zym_3 == 'true') {
                $nr .= '[禁止反向组合]';
            }
            if ($zym_14_例外 != 0) {
                $nr2 = '<br>当您的总注达到' . $zym_14_例外 . '时,方可投注此类玩法!';
            } else {
                $nr2 = "";
            }
            管理员喊话("@{$nickname},您的:{$zym_2}未接<br>本房$nr" . $nr2);
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } else {
            管理员喊话("@{$nickname},您的:{$zym_2}未接，您的余额：" . 查询用户余额($userid));
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        }
    } elseif (get_query_val("fn_setting", "setting_tishi", array("roomid" => $postRoomid)) == 'open' && $touzhu == true) {
        管理员喊话("@{$nickname},投注成功！请选择左侧菜单核对投注！");
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    } elseif ($touzhu) {
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    }

    $carr[0] = false;
    $carr[1] = $chat_id;
    return $carr;
}

function addBJLBet($userid, $nickname, $headimg, $content, $addQihao, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    if ($fengpan) {
        管理员喊话("@" . $nickname . " ,[$addQihao]期已经停止投注！下注无效！");
        $carr[0] = false;
        $carr[1] = $chat_id;
        return $carr;
    }
    $content = str_replace(".", "/", $content);
    $content = preg_replace("/[点草艹操,-]/u", "/", $content);
    $content = preg_replace("/庄对/u", "zd", $content);
    $content = preg_replace("/闲对/u", "xd", $content);
    $content = preg_replace("/(庄|闲|和|zd|xd|任意对|哈)\//u", "$1", $content);
    $content = preg_replace("/(庄|闲|和|zd|xd|任意对|哈)/u", "$1/", $content);
    $content = preg_replace("/zd/u", "庄对", $content);
    $content = preg_replace("/xd/u", "闲对", $content);
    switch ($BetGame) {
        case 'bjl':
            $table = 'fn_lottery10';
            $ordertable = 'fn_bjlorder';
            break;
    }
    $touzhu = false;
    $chaozhu = false;
    $jinzhi = false;
    $A = explode(' ', $content);
    $zym_8 = get_query_val('fn_user', 'jia', array('userid' => $userid, 'roomid' => $postRoomid)) == 'true' ? 'true' : 'false';
    $zym_2 = "";
    foreach ($A as $i) {
        $i = str_replace(" ", "", $i);
        if (empty($i))
            continue;
        $b = explode('/', $i);
        $zym_9 = 查询用户余额($userid);
        if (count($b) == 3 && $b[0] == '哈') {
            unset($b[2]);
            $b[0] = $b[1];
            $b[1] = $zym_9;
        }
        if (count($b) != 2)
            continue;
        if ($b[0] == "" || (int)$b[1] < 1)
            continue;
        $zym_6 = $b[0];
        $zym_5 = (int)$b[1];
        if ((int)$zym_9 < (int)$zym_5) {
            $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
            continue;
        }
        $zhuang_max = (int)get_query_val($table, 'zhuang_max', array('roomid' => $postRoomid));
        $zhuang_min = (int)get_query_val($table, 'zhuang_min', array('roomid' => $postRoomid));
        $xian_max = (int)get_query_val($table, 'xian_max', array('roomid' => $postRoomid));
        $xian_min = (int)get_query_val($table, 'xian_min', array('roomid' => $postRoomid));
        $he_max = (int)get_query_val($table, 'he_max', array('roomid' => $postRoomid));
        $he_min = (int)get_query_val($table, 'he_min', array('roomid' => $postRoomid));
        $zhuangdui_max = (int)get_query_val($table, 'zhuangdui_max', array('roomid' => $postRoomid));
        $zhuangdui_min = (int)get_query_val($table, 'zhuangdui_min', array('roomid' => $postRoomid));
        $xiandui_max = (int)get_query_val($table, 'xiandui_max', array('roomid' => $postRoomid));
        $xiandui_min = (int)get_query_val($table, 'xiandui_min', array('roomid' => $postRoomid));
        $anydui_max = (int)get_query_val($table, 'anydui_max', array('roomid' => $postRoomid));
        $anydui_min = (int)get_query_val($table, 'anydui_min', array('roomid' => $postRoomid));
        switch ($zym_6) {
            case '庄':
                $max = $zhuang_max = (int)get_query_val($table, 'zhuang_max', array('roomid' => $postRoomid));
                $min = $zhuang_min = (int)get_query_val($table, 'zhuang_min', array('roomid' => $postRoomid));
                break;
            case '闲':
                $max = $xian_max = (int)get_query_val($table, 'xian_max', array('roomid' => $postRoomid));
                $min = $xian_min = (int)get_query_val($table, 'xian_min', array('roomid' => $postRoomid));
                break;
            case '和':
                $max = $he_max = (int)get_query_val($table, 'he_max', array('roomid' => $postRoomid));
                $min = $he_min = (int)get_query_val($table, 'he_min', array('roomid' => $postRoomid));
                break;
            case '庄对':
                $max = $zhuangdui_max = (int)get_query_val($table, 'zhuangdui_max', array('roomid' => $postRoomid));
                $min = $zhuangdui_min = (int)get_query_val($table, 'zhuangdui_min', array('roomid' => $postRoomid));
                break;
            case '闲对':
                $max = $xiandui_max = (int)get_query_val($table, 'xiandui_max', array('roomid' => $postRoomid));
                $min = $xiandui_min = (int)get_query_val($table, 'xiandui_min', array('roomid' => $postRoomid));
                break;
            case '任意对':
                $max = $anydui_max = (int)get_query_val($table, 'anydui_max', array('roomid' => $postRoomid));
                $min = $anydui_min = (int)get_query_val($table, 'anydui_min', array('roomid' => $postRoomid));
                break;

        }
        if ($zym_6 == '庄' || $zym_6 == '闲' || $zym_6 == '和' || $zym_6 == '庄对' || $zym_6 == '闲对' || $zym_6 == '任意对') {
            if ($zym_5 < $min || (sum_bjlmoney($ordertable, $zym_6, $userid, $addQihao) + $zym_5 > $max)) {
                $chaozhu = true;
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            }

            $touzhu = true;
            用户_下分($userid, $zym_5);
            insert_query("fn_bjlorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            continue;
        }
    }
    if ($zym_2 != "") {
        if ($chaozhu) {
            管理员喊话("@$nickname,本次投注已超注！<br>本房投注限制如下:<br>庄最低{$zhuang_min},最高{$zhuang_max}<br>闲最低{$xian_min },最高{$xian_max }<br>和最低{$he_min},最高{$he_max}<br>庄对最低{$zhuangdui_min},最高{$zhuangdui_max}<br>闲对最低{$xiandui_min},最高{$xiandui_max}<br>任意对最低{$anydui_min},最高{$anydui_max}<br>");
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } elseif ($jinzhi) {
            $nr = "";
            if ($zym_4 == 'true') {
                $nr .= '[禁止杀组合]';
            }
            if ($zym_1 == 'true') {
                $nr .= '[禁止同向组合]';
            }
            if ($zym_3 == 'true') {
                $nr .= '[禁止反向组合]';
            }
            if ($zym_14_例外 != 0) {
                $nr2 = '<br>当您的总注达到' . $zym_14_例外 . '时,方可投注此类玩法!';
            } else {
                $nr2 = "";
            }
            管理员喊话("@{$nickname},您的:{$zym_2}未接<br>本房$nr" . $nr2);
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } else {
            管理员喊话("@{$nickname},您的:{$zym_2}未接，您的余额：" . 查询用户余额($userid));
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        }
    } elseif (get_query_val("fn_setting", "setting_tishi", array("roomid" => $postRoomid)) == 'open' && $touzhu == true) {
        管理员喊话("@{$nickname},投注成功！请选择左侧菜单核对投注！");
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    } elseif ($touzhu) {
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    }
    $carr[0] = false;
    $carr[1] = $chat_id;
    return $carr;
}

function addBet($userid, $nickname, $headimg, $content, $addQihao, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    if ($fengpan) {
        管理员喊话("@" . $nickname . " ,[$addQihao]期已经停止投注！下注无效！");
        $carr[0] = false;
        $carr[1] = $chat_id;
        return $carr;
    }
    $content = str_replace("冠亚和", "和", $content);
    $content = str_replace("冠亚", "和", $content);
    $content = str_replace("冠军", "1/", $content);
    $content = str_replace("亚军", "2/", $content);
    $content = str_replace("冠", "1/", $content);
    $content = str_replace("亚", "2/", $content);
    $content = str_replace("一", "1/", $content);
    $content = str_replace("二", "2/", $content);
    $content = str_replace("三", "3/", $content);
    $content = str_replace("四", "4/", $content);
    $content = str_replace("五", "5/", $content);
    $content = str_replace("六", "6/", $content);
    $content = str_replace("七", "7/", $content);
    $content = str_replace("八", "8/", $content);
    $content = str_replace("九", "9/", $content);
    $content = str_replace("十", "0/", $content);
    $content = str_replace(".", "/", $content);
    $content = preg_replace("/[位名各-]/u", "/", $content);
    $content = preg_replace("/(和|合|H|h)\//u", "$1", $content);
    $content = preg_replace("/[和合Hh]/u", "和/", $content);
    $content = preg_replace("/(大单|小单|大双|小双|大|小|单|双|龙|虎)\//u", "$1", $content);
    $content = preg_replace("/\/(大单|小单|大双|小双|大|小|单|双|龙|虎)/u", "$1", $content);
    $content = preg_replace("/(大单|小单|大双|小双|大|小|单|双|龙|虎)/u", "/$1/", $content);

    switch ($BetGame) {
        case 'pk10':
            $table = 'fn_lottery1';
            $ordertable = "fn_order";
            break;
        case "xyft":
            $table = 'fn_lottery2';
            $ordertable = "fn_flyorder";
            break;
        case "jsmt":
            $table = 'fn_lottery6';
            $ordertable = "fn_mtorder";
            break;
        case "jssc":
            $table = 'fn_lottery7';
            $ordertable = "fn_jsscorder";
            break;
        case "jssm":
            $table = 'fn_lottery12';
            $ordertable = "fn_smorder";
            break;
        case "azxy10":
            $table = 'fn_lottery17';
            $ordertable = "fn_azxy10order";
            break;
    }
    $dx_min = get_query_val($table, 'daxiao_min', array('roomid' => $postRoomid));
    $dx_max = get_query_val($table, 'daxiao_max', array('roomid' => $postRoomid));
    $ds_min = get_query_val($table, 'danshuang_min', array('roomid' => $postRoomid));
    $ds_max = get_query_val($table, 'danshuang_max', array('roomid' => $postRoomid));
    $lh_min = get_query_val($table, 'longhu_min', array('roomid' => $postRoomid));
    $lh_max = get_query_val($table, 'longhu_max', array('roomid' => $postRoomid));
    $tm_min = get_query_val($table, 'tema_min', array('roomid' => $postRoomid));
    $tm_max = get_query_val($table, 'tema_max', array('roomid' => $postRoomid));
    $hz_min = get_query_val($table, 'he_min', array('roomid' => $postRoomid));
    $hz_max = get_query_val($table, 'he_max', array('roomid' => $postRoomid));
    $zh_min = get_query_val($table, 'zuhe_min', array('roomid' => $postRoomid));
    $zh_max = get_query_val($table, 'zuhe_max', array('roomid' => $postRoomid));
    $zym_8 = get_query_val('fn_user', 'jia', array('userid' => $userid, 'roomid' => $postRoomid)) == 'true' ? 'true' : 'false';
    $touzhu = false;
    $A = explode(" ", $content);
    $zym_2 = "";
    foreach ($A as $ai) {
        $ai = str_replace(" ", "", $ai);
        if (empty($ai)) continue;
        if (substr($ai, 0, 1) == '/') $ai = '1' . $ai;
        $b = explode("/", $ai);
        if (count($b) == 2) {
            $ai = '1/' . $ai;
            $b = explode("/", $ai);
        }
        if (count($b) != 3) continue;
        if ($b[0] == "" || $b[1] == "" || (int)$b[2] < 1) continue;
        $zym_9 = 查询用户余额($userid);
        $zym_10 = $b[0];
        $zym_6 = $b[1];
        $zym_5 = (int)$b[2];
        if ($zym_6 == '和') {
            管理员喊话("@" . $nickname . " ,下注格式出错！冠亚和值下注格式为:和3/100");
            continue;
        }
        if ($zym_10 == '和') {
            if ($zym_6 == "大单" || $zym_6 == "大双" || $zym_6 == "小双" || $zym_6 == "小单") {
                管理员喊话("@" . $nickname . " ,下注格式出错！冠亚和值无此类型下注！");
                continue;
            }
            if ($zym_6 == "大" || $zym_6 == "小" || $zym_6 == "单" || $zym_6 == "双") {
                if ((int)$zym_9 < (int)$zym_5) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $hz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $hz_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                $touzhu = true;
                continue;
            }
            $zym_6_分割 = 和值分割($zym_6);
            foreach ($zym_6_分割 as $ii) {
                if ($ii < 3 || $ii > 19) {
                    管理员喊话("@" . $nickname . " ,下注格式出错！冠亚和值为3 - 19！入单失败！");
                    break;
                }
                if (!is_numeric($ii)) {
                    continue;
                } elseif ((int)$zym_9 < count($zym_6_分割) * (int)$zym_5) {
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $hz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $hz_max) {
                    $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $ii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                continue;
            }
            continue;
        }
        if ($zym_6 == "大单" || $zym_6 == "大双" || $zym_6 == "小双" || $zym_6 == "小单") {
            $zym_10_分割 = 文本_逐字分割($zym_10);
            foreach ($zym_10_分割 as $ii) {
                if (!is_numeric($ii)) {
                    continue;
                } elseif ($zym_9 < count($zym_10_分割) * (int)$zym_5) {
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $zh_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $zh_max) {
                    $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            }
            continue;
        }
        if ($zym_6 == "大" || $zym_6 == "小" || $zym_6 == "单" || $zym_6 == "双" || $zym_6 == "龙" || $zym_6 == "虎") {
            $zym_10_分割 = 文本_逐字分割($zym_10);
            foreach ($zym_10_分割 as $ii) {
                if (!is_numeric($ii)) {
                    continue;
                } elseif ($zym_9 < count($zym_10_分割) * (int)$zym_5) {
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $dx_min || sum_betmoney($ordertable, $ii, $zym_6, $userid, $addQihao) + $zym_5 > $dx_max && $zym_6 == "大") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $dx_min || sum_betmoney($ordertable, $ii, $zym_6, $userid, $addQihao) + $zym_5 > $dx_max && $zym_6 == "小") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $ds_min || sum_betmoney($ordertable, $ii, $zym_6, $userid, $addQihao) + $zym_5 > $ds_max && $zym_6 == "单") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $ds_min || sum_betmoney($ordertable, $ii, $zym_6, $userid, $addQihao) + $zym_5 > $ds_max && $zym_6 == "双") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $lh_min || sum_betmoney($ordertable, $ii, $zym_6, $userid, $addQihao) + $zym_5 > $lh_max && $zym_6 == "龙") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $lh_min || sum_betmoney($ordertable, $ii, $zym_6, $userid, $addQihao) + $zym_5 > $lh_max && $zym_6 == "虎") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                if ((int)$ii > 5 && $zym_6 == '龙' || (int)$ii > 5 && $zym_6 == '虎') {
                    管理员喊话("@{$nickname},龙虎投注仅限1~5名！");
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            }
            continue;
        }
        $zym_6_分割 = 文本_逐字分割($zym_6);
        $zym_10_分割 = 文本_逐字分割($zym_10);
        foreach ($zym_10_分割 as $ii) {
            if ($zym_9 < count($zym_10_分割) * count($zym_6_分割) * (int)$zym_5) {
                $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                break;
            } else if (!is_numeric($ii)) {
                continue;
            }
            foreach ($zym_6_分割 as $iii) {
                if (!is_numeric($iii)) {
                    continue;
                } else if ($zym_5 < $tm_min || sum_betmoney($ordertable, $ii, $iii, $userid, $addQihao) + $zym_5 > $tm_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $iii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            }
        }
    }
    if ($zym_2 != "") {
        if ($chaozhu) {
            管理员喊话("@{$nickname},您的:{$zym_2}未接<br>您的投注已超出限制！<br>本房投注限制如下:<br>大小最低{$dx_min}起,最高{$dx_max}<br>单双最低{$ds_min}起,最高{$ds_max}<br>龙虎最低{$lh_min}起,最高{$lh_max}<br>特码最低{$tm_min}起,最高{$tm_max}<br>和值最低{$hz_min}起,最高{$hz_max}<br>------------<br>最高投注均为已下注总注");
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } else {
            管理员喊话("@{$nickname},您的:{$zym_2}未接，您的余额：" . 查询用户余额($userid));
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        }
    } elseif (get_query_val("fn_setting", "setting_tishi", array("roomid" => $postRoomid)) == 'open' && $touzhu == true) {
        管理员喊话("@$nickname,投注成功！请选择左侧菜单核对投注！");
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    } elseif ($touzhu) {
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    }
    $carr[0] = false;
    $carr[1] = $chat_id;
    return $carr;
}

function addPCBet($userid, $nickname, $headimg, $content, $addQihao, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    if ($fengpan) {
        管理员喊话("@" . $nickname . " ,[$addQihao]期已经停止投注！下注无效！");
        $carr[0] = false;
        $carr[1] = $chat_id;
        return $carr;
    }
    $content = str_replace(".", "/", $content);
    $content = preg_replace("/[点草艹操,-]/u", "/", $content);
    $content = preg_replace("/(极大|极小|豹子|对子|顺子|大单|大双|小单|小双|大|小|单|双|哈)\//u", "$1", $content);
    $content = preg_replace("/(极大|极小|豹子|对子|顺子|大单|大双|小单|小双|大|小|单|双|哈)/u", "$1/", $content);
    switch ($BetGame) {
        case 'xy28':
            $table = 'fn_lottery4';
            $ordertable = 'fn_pcorder';
            break;
        case 'ny28':
            $table = 'fn_lottery19';
            $ordertable = 'fn_pcorder';
            break;
        case "jnd28":
            $table = 'fn_lottery5';
            $ordertable = 'fn_pcorder';
            break;
    }
    $zym_17_min = (int)get_query_val($table, 'danzhu_min', array('roomid' => $postRoomid));
    $zym_16_max = (int)get_query_val($table, 'shuzi_max', array('roomid' => $postRoomid));
    $zym_15_max = (int)get_query_val($table, 'dxds_max', array('roomid' => $postRoomid));
    $zym_19_max = (int)get_query_val($table, 'zuhe_max', array('roomid' => $postRoomid));
    $zym_11_max = (int)get_query_val($table, 'jidx_max', array('roomid' => $postRoomid));
    $zym_20_max = (int)get_query_val($table, 'baozi_max', array('roomid' => $postRoomid));
    $zym_18_max = (int)get_query_val($table, 'duizi_max', array('roomid' => $postRoomid));
    $zym_13_max = (int)get_query_val($table, 'shunzi_max', array('roomid' => $postRoomid));
    $zym_12_max = (int)get_query_val($table, 'zongzhu_max', array('roomid' => $postRoomid));
    $zym_4 = get_query_val($table, 'setting_shazuhe', array('roomid' => $postRoomid));
    $zym_3 = get_query_val($table, 'setting_fanxiangzuhe', array('roomid' => $postRoomid));
    $zym_1 = get_query_val($table, 'setting_tongxiangzuhe', array('roomid' => $postRoomid));
    $zym_14_例外 = (int)get_query_val($table, 'setting_liwai', array('roomid' => $postRoomid));
    $touzhu = false;
    $chaozhu = false;
    $jinzhi = false;
    $A = explode(' ', $content);
    $zym_8 = get_query_val('fn_user', 'jia', array('userid' => $userid, 'roomid' => $postRoomid)) == 'true' ? 'true' : 'false';
    $zym_2 = "";
    foreach ($A as $i) {
        $i = str_replace(" ", "", $i);
        if (empty($i)) continue;
        $b = explode('/', $i);
        $zym_9 = 查询用户余额($userid);
        if (count($b) == 3 && $b[0] == '哈') {
            unset($b[2]);
            $b[0] = $b[1];
            $b[1] = $zym_9;
        }
        if (count($b) != 2) continue;
        if ($b[0] == "" || (int)$b[1] < 1) continue;
        $zym_6 = $b[0];
        $zym_5 = (int)$b[1];
        if ($zym_5 < $zym_17_min) {
            $chaozhu = true;
            $zym_2 = $zym_6 . '/' . $zym_5;
            continue;
        }
        $zym_7 = (int)get_query_val('fn_pcorder', 'sum(`money`)', "`userid` = '{$userid}' and `status` = '未结算' and `term` = '$addQihao'");
        if ($zym_7 + $zym_5 > $zym_12_max) {
            $chaozhu = true;
            $zym_2 = $zym_6 . '/' . $zym_5;
            continue;
        }
        if ($zym_6 == '大' || $zym_6 == '小' || $zym_6 == '单' || $zym_6 == '双') {
            if ($zym_5 > $zym_15_max) {
                $chaozhu = true;
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            } else if ($zym_9 < $zym_5) {
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            }
            if ($zym_4 == 'true') {
                switch ($zym_6) {
                    case '大':
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '小单'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '小双'));
                        break;
                    case "小":
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '大单'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '大双'));
                        break;
                    case "单":
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '小双'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '大双'));
                        break;
                    case "双":
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '小单'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '大单'));
                        break;
                }
                if ($betting1 != "" || $betting2 != "") {
                    if ($zym_14_例外 > 0 && $zym_7 + $zym_5 > $zym_14_例外) {
                        $touzhu = true;
                        用户_下分($userid, $zym_5);
                        insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                    } else {
                        $jinzhi = true;
                        $zym_2 = $zym_6 . '/' . $zym_5;
                        continue;
                    }
                }
            }
            $touzhu = true;
            用户_下分($userid, $zym_5);
            insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            continue;
        } elseif ($zym_6 == '大单' || $zym_6 == '小单' || $zym_6 == '大双' || $zym_6 == '小双') {
            if ($zym_5 > $zym_19_max) {
                $chaozhu = true;
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            } else if ($zym_9 < $zym_5) {
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            }
            if ($zym_4 == 'true') {
                switch ($zym_6) {
                    case '大单':
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '双'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '小'));
                        break;
                    case "小单":
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '大'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '双'));
                        break;
                    case "大双":
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '小'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '单'));
                        break;
                    case "小双":
                        $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '大'));
                        $betting2 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => '单'));
                        break;
                }
                if ($betting1 != "" || $betting2 != "") {
                    if ($zym_14_例外 > 0 && $zym_7 + $zym_5 > $zym_14_例外) {
                        $touzhu = true;
                        用户_下分($userid, $zym_5);
                        insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                    } else {
                        $jinzhi = true;
                        $zym_2 = $zym_6 . '/' . $zym_5;
                        continue;
                    }
                }
            }
            if ($zym_1 == 'true') {
                switch ($zym_6) {
                    case '大单':
                        $sql = '小单';
                        break;
                    case "小单":
                        $sql = '大单';
                        break;
                    case "大双":
                        $sql = '小双';
                        break;
                    case "小双":
                        $sql = '大双';
                        break;
                }
                $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => $sql));
                if ($betting1 != "") {
                    if ($zym_14_例外 > 0 && $zym_7 + $zym_5 > $zym_14_例外) {
                        $touzhu = true;
                        用户_下分($userid, $zym_5);
                        insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                    } else {
                        $jinzhi = true;
                        $zym_2 = $zym_6 . '/' . $zym_5;
                        continue;
                    }
                }
            }
            if ($zym_3 == 'true') {
                switch ($zym_6) {
                    case '大单':
                        $sql = '小双';
                        break;
                    case "小单":
                        $sql = '大双';
                        break;
                    case "大双":
                        $sql = '小单';
                        break;
                    case "小双":
                        $sql = '大单';
                        break;
                }
                $betting1 = get_query_val('fn_pcorder', 'content', array('userid' => $userid, 'term' => $addQihao, 'roomid' => $postRoomid, 'status' => '未结算', 'content' => $sql));
                if ($betting1 != "") {
                    if ($zym_14_例外 > 0 && $zym_7 + $zym_5 > $zym_14_例外) {
                        $touzhu = true;
                        用户_下分($userid, $zym_5);
                        insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                    } else {
                        $jinzhi = true;
                        $zym_2 = $zym_6 . '/' . $zym_5;
                        continue;
                    }
                }
            }
            $touzhu = true;
            用户_下分($userid, $zym_5);
            insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            continue;
        } elseif ($zym_6 == '极大' || $zym_6 == '极小') {
            if ($zym_5 > $zym_11_max) {
                $chaozhu = true;
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            } else if ($zym_9 < $zym_5) {
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            }
            $touzhu = true;
            用户_下分($userid, $zym_5);
            insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            continue;
        } elseif ($zym_6 == '豹子' || $zym_6 == '对子' || $zym_6 == '顺子') {
            switch ($zym_6) {
                case '豹子':
                    if ($zym_20_max == 0) {
                        continue;
                    } else {
                        if ($zym_5 > $zym_20_max) {
                            $chaozhu = true;
                            $zym_2 = $zym_6 . '/' . $zym_5;
                            continue;
                        }
                    }
                    break;
                case "对子":
                    if ($zym_18_max == 0) {
                        continue;
                    } else {
                        if ($zym_5 > $zym_18_max) {
                            $chaozhu = true;
                            $zym_2 = $zym_6 . '/' . $zym_5;
                            continue;
                        }
                    }
                    break;
                case "顺子":
                    if ($zym_13_max == 0) {
                        continue;
                    } else {
                        if ($zym_5 > $zym_13_max) {
                            $chaozhu = true;
                            $zym_2 = $zym_6 . '/' . $zym_5;
                            continue;
                        }
                    }
                    break;
            }
            if ($zym_9 < $zym_5) {
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            }
            $touzhu = true;
            用户_下分($userid, $zym_5);
            insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            continue;
        } else {
            if ($zym_5 > $zym_16_max) {
                $chaozhu = true;
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            } else if ($zym_9 < $zym_5) {
                $zym_2 = $zym_6 . '/' . $zym_5;
                continue;
            } else if (!is_numeric($zym_6)) {
                continue;
            }
            $touzhu = true;
            用户_下分($userid, $zym_5);
            insert_query("fn_pcorder", array("term" => $addQihao, 'userid' => $userid, 'username' => $postNickname, 'headimg' => $postHeadimg, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            continue;
        }
    }
    if ($zym_2 != "") {
        if ($chaozhu) {
            管理员喊话("@$nickname,本次投注已超注！<br>本房投注限制如下:<br>单点数字最低{$zym_17_min},最高{$zym_16_max}<br>大小单双最低{$zym_17_min},最高{$zym_15_max}<br>组合最低{$zym_17_min},最高{$zym_19_max}<br>极大极小最低{$zym_17_min},最高{$zym_11_max}<br>豹子最低{$zym_17_min},最高{$zym_20_max}<br>对子最低{$zym_17_min},最高{$zym_18_max}<br>顺子最低{$zym_17_min},最高{$zym_13_max}<br>-----------<br>总注不得超过:{$zym_12_max},您已投注:{$zym_7}");
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } elseif ($jinzhi) {
            $nr = "";
            if ($zym_4 == 'true') {
                $nr .= '[禁止杀组合]';
            }
            if ($zym_1 == 'true') {
                $nr .= '[禁止同向组合]';
            }
            if ($zym_3 == 'true') {
                $nr .= '[禁止反向组合]';
            }
            if ($zym_14_例外 != 0) {
                $nr2 = '<br>当您的总注达到' . $zym_14_例外 . '时,方可投注此类玩法!';
            } else {
                $nr2 = "";
            }
            管理员喊话("@{$nickname},您的:{$zym_2}未接<br>本房$nr" . $nr2);
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } else {
            管理员喊话("@{$nickname},您的:{$zym_2}未接，您的余额：" . 查询用户余额($userid));
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        }
    } elseif (get_query_val("fn_setting", "setting_tishi", array("roomid" => $postRoomid)) == 'open' && $touzhu == true) {
        管理员喊话("@{$nickname},投注成功！请选择左侧菜单核对投注！");
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    } elseif ($touzhu) {
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    }
    $carr[0] = false;
    $carr[1] = $chat_id;
    return $carr;
}

function add11X5Bet($userid, $nickname, $headimg, $content, $addQihao, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    if ($fengpan) {
        管理员喊话("@" . $nickname . " ,[$addQihao]期已经停止投注！下注无效！");
        $carr[0] = false;
        $carr[1] = $chat_id;
        return $carr;
    }
    $content = str_replace(".", "/", $content);
    $content = str_replace(",", "/", $content);
    $content = str_replace("，", "/", $content);
    $content = preg_replace("/[球号位名各-]/u", "/", $content);
    $content = str_replace("总和", "总", $content);
    $content = str_replace("合", "和", $content);
    $content = str_replace("前三", "前", $content);
    $content = str_replace("中三", "中", $content);
    $content = str_replace("后三", "后", $content);
    $content = str_replace("包/", "包", $content);
    $content = preg_replace("/(万|一)\//u", "$1", $content);
    $content = preg_replace("/(千|二)\//u", "$1", $content);
    $content = preg_replace("/(百|三)\//u", "$1", $content);
    $content = preg_replace("/(十|四)\//u", "$1", $content);
    $content = preg_replace("/(个|五)\//u", "$1", $content);
    $content = preg_replace("/(万|一)/u", "1/", $content);
    $content = preg_replace("/(千|二)/u", "2/", $content);
    $content = preg_replace("/(百|三)/u", "3/", $content);
    $content = preg_replace("/(十|四)/u", "4/", $content);
    $content = preg_replace("/(个|五)/u", "5/", $content);
    $content = preg_replace("/(龙|虎|和)\//u", "$1", $content);
    $content = preg_replace("/\/(龙|虎|和)/u", "$1", $content);
    $content = preg_replace("/(龙|虎|和)/u", "总/$1/", $content);
    $content = preg_replace("/[前Qq]/u", "前三/", $content);
    $content = preg_replace("/[中Zz]/u", "中三/", $content);
    $content = preg_replace("/[后Hh]/u", "后三/", $content);
    $content = preg_replace("/[包]/u", "包/", $content);
    $content = preg_replace("/(大|小|单|双|豹子|顺子|对子|半顺|杂六|前三|中三|后三)\//u", "$1", $content);
    $content = preg_replace("/\/(大|小|单|双|豹子|顺子|对子|半顺|杂六)/u", "$1", $content);
    $content = preg_replace("/(大|小|单|双|豹子|顺子|对子|半顺|杂六)/u", "/$1/", $content);
    $table = 'fn_lottery11';
    $ordertable = 'fn_11x5order';

    $dx_min = get_query_val($table, 'dx_min', array('roomid' => $postRoomid));
    $dx_max = get_query_val($table, 'dx_max', array('roomid' => $postRoomid));
    $ds_min = get_query_val($table, 'ds_min', array('roomid' => $postRoomid));
    $ds_max = get_query_val($table, 'ds_max', array('roomid' => $postRoomid));
    $lh_min = get_query_val($table, 'lh_min', array('roomid' => $postRoomid));
    $lh_max = get_query_val($table, 'lh_max', array('roomid' => $postRoomid));
    $tm_min = get_query_val($table, 'tm_min', array('roomid' => $postRoomid));
    $tm_max = get_query_val($table, 'tm_max', array('roomid' => $postRoomid));
    $zh_min = get_query_val($table, 'zh_min', array('roomid' => $postRoomid));
    $zh_max = get_query_val($table, 'zh_max', array('roomid' => $postRoomid));
    $bz_min = get_query_val($table, 'bz_min', array('roomid' => $postRoomid));
    $bz_max = get_query_val($table, 'bz_max', array('roomid' => $postRoomid));
    $dz_min = get_query_val($table, 'dz_min', array('roomid' => $postRoomid));
    $dz_max = get_query_val($table, 'dz_max', array('roomid' => $postRoomid));
    $sz_min = get_query_val($table, 'sz_min', array('roomid' => $postRoomid));
    $sz_max = get_query_val($table, 'sz_max', array('roomid' => $postRoomid));
    $bs_min = get_query_val($table, 'bs_min', array('roomid' => $postRoomid));
    $bs_max = get_query_val($table, 'bs_max', array('roomid' => $postRoomid));
    $zl_min = get_query_val($table, 'zl_min', array('roomid' => $postRoomid));
    $zl_max = get_query_val($table, 'zl_max', array('roomid' => $postRoomid));
    $zym_8 = get_query_val('fn_user', 'jia', array('userid' => $userid, 'roomid' => $postRoomid)) == 'true' ? 'true' : 'false';
    $touzhu = false;
    $A = explode(" ", $content);
    $zym_2 = "";
    foreach ($A as $ai) {
        $ai = str_replace(" ", "", $ai);
        if (empty($ai)) continue;
        if (substr($ai, 0, 1) == '/') $ai = '1' . $ai;
        $b = explode("/", $ai);
        if (count($b) == 2) {
            if (preg_match("/(大|小|单|双)/u", $ai)) {
                $ai = '1/' . $ai;
            } else {
                $ai = '包/' . $ai;
            }
            $b = explode("/", $ai);
        }
        if (count($b) != 3) continue;
        if ($b[0] == "" || $b[1] == "" || (int)$b[2] < 1) continue;
        $zym_9 = 查询用户余额($userid);
        $zym_10 = $b[0];
        $zym_6 = $b[1];
        $zym_5 = (int)$b[2];
        if ($zym_10 == '总') {
            if ($zym_6 == '大' || $zym_6 == '小') {
                if ((int)$zym_9 < (int)$zym_5) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $zh_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $zh_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8, 'game' => $BetGame), $chat_id);
                $touzhu = true;
                continue;
            } elseif ($zym_6 == '单' || $zym_6 == '双') {
                if ((int)$zym_9 < (int)$zym_5) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $zh_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $zh_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8, 'game' => $BetGame), $chat_id);
                $touzhu = true;
                continue;
            } elseif ($zym_6 == '龙' || $zym_6 == '虎' || $zym_6 == '和') {
                if ((int)$zym_9 < (int)$zym_5) {
                    $zym_2 .= $zym_6 . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $lh_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $lh_max) {
                    $zym_2 .= $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8, 'game' => $BetGame), $chat_id);
                $touzhu = true;
                continue;
            }
            continue;
        }
        if ($zym_6 == "大" || $zym_6 == "小" || $zym_6 == "单" || $zym_6 == "双") {
            $zym_10_分割 = 文本_逐字分割($zym_10);
            foreach ($zym_10_分割 as $ii) {
                if ((int)$ii > 5) {
                    管理员喊话("时时彩没有5球以上!本次投注请自行核对与撤单!");
                    break;
                }
                if ($zym_9 < count($zym_10_分割) * (int)$zym_5) {
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $dx_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $dx_max && $zym_6 == "大") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $dx_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $dx_max && $zym_6 == "小") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $ds_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $ds_max && $zym_6 == "单") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $ds_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $ds_max && $zym_6 == "双") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8, 'game' => $BetGame), $chat_id);
                continue;
            }
            continue;
        }
        if ($zym_10 == '前三' || $zym_10 == '中三' || $zym_10 == '后三' || preg_match("/(前三|中三|后三)/u", $zym_10)) {
            $arr = 前中后分割($zym_10);
            foreach ($arr as $i) {
                if ($zym_9 < (int)$zym_5) {
                    $zym_2 = $zym_2 . $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $bz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $bz_max && $zym_6 == "豹子") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $dz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $dz_max && $zym_6 == "对子") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $sz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $sz_max && $zym_6 == "顺子") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $bs_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $bs_max && $zym_6 == "半顺") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $zl_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $zl_max && $zym_6 == "杂六") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $i, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8, 'game' => $BetGame), $chat_id);
                continue;
            }
            continue;
        }
        if ($zym_10 == "包") {
            $zym_6_分割 = 文本_逐字分割($zym_6);
            foreach ($zym_6_分割 as $ii) {
                if (!is_numeric($ii)) {
                    continue;
                } elseif ((int)$zym_9 < (int)$zym_5 * 5 * count($zym_6_分割)) {
                    $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $tm_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $tm_max) {
                    $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5 * 5);
                db_query("INSERT INTO {$ordertable}(userid, username, headimg, term, mingci, content, `money`, addtime, `status`, jia, roomid,game) VALUES('$userid', '$nickname', '$headimg', '$addQihao', '1', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}','{$BetGame}'), ('$userid', '$nickname', '$headimg', '$addQihao', '2', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}','{$BetGame}'), ('$userid', '$nickname', '$headimg', '$addQihao', '3', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}','{$BetGame}'), ('$userid', '$nickname', '$headimg', '$addQihao', '4', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}','{$BetGame}'), ('$userid', '$nickname', '$headimg', '$addQihao', '5', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}','{$BetGame}')");
                $touzhu = true;
                continue;
            }
            continue;
        }
        $zym_6_分割 = 文本_逐字分割($zym_6);
        $zym_10_分割 = 文本_逐字分割($zym_10);
        foreach ($zym_10_分割 as $ii) {
            if ($zym_9 < count($zym_10_分割) * count($zym_6_分割) * (int)$zym_5) {
                $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                break;
            }
            if ((int)$ii > 5) {
                管理员喊话("时时彩没有5球以上!本次投注请自行核对与撤单!");
                break;
            }
            foreach ($zym_6_分割 as $iii) {
                if (!is_numeric($iii)) {
                    continue;
                }
                if ($zym_5 < $tm_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $tm_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $iii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8, 'game' => $BetGame), $chat_id);
            }
        }
        continue;
    }
    if ($zym_2 != "") {
        if ($chaozhu) {
            管理员喊话("@{$nickname},您的:{$zym_2}未接<br>您的投注已超出限制！<br>本房投注限制如下:<br>大小最低{$dx_min}起,最高{$dx_max}<br>单双最低{$ds_min}起,最高{$ds_max}<br>龙虎最低{$lh_min}起,最高{$lh_max}<br>特码最低{$tm_min}起,最高{$tm_max}<br>豹子最低{$bz_min}起,最高{$bz_max}<br>对子最低{$dz_min}起,最高{$dz_max}<br>顺子最低{$sz_min}起,最高{$sz_max}<br>半顺最低{$bs_min}起,最高{$bs_max}<br>杂六最低{$zl_min}起,最高{$zl_max}<br>总和大小单双最低{$zh_min}起,最高{$zh_max}");
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } else {
            管理员喊话("@{$nickname},您的:{$zym_2}未接，您的余额：" . 查询用户余额($userid));
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        }
    } elseif (get_query_val("fn_setting", "setting_tishi", array("roomid" => $postRoomid)) == 'open' && $touzhu == true) {
        管理员喊话("@$nickname,投注成功！请选择左侧菜单核对投注！");
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    } elseif ($touzhu) {
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    }
    $carr[0] = false;
    $carr[1] = $chat_id;
    return $carr;
}

function addSSCBet($userid, $nickname, $headimg, $content, $addQihao, $fengpan)
{
    global $postRoomid;
    global $BetGame;
    global $postUserid;
    global $postHeadimg;
    global $postNickname;

    if ($fengpan) {
        管理员喊话("@" . $nickname . " ,[$addQihao]期已经停止投注！下注无效！");
        $carr[0] = false;
        $carr[1] = $chat_id;
        return $carr;
    }
    $content = str_replace(".", "/", $content);
    $content = str_replace(",", "/", $content);
    $content = str_replace("，", "/", $content);
    $content = preg_replace("/[球号位名各-]/u", "/", $content);
    $content = str_replace("总和", "总", $content);
    $content = str_replace("合", "和", $content);
    $content = str_replace("前三", "前", $content);
    $content = str_replace("中三", "中", $content);
    $content = str_replace("后三", "后", $content);
    $content = str_replace("包/", "包", $content);
    $content = preg_replace("/(万|一)\//u", "$1", $content);
    $content = preg_replace("/(千|二)\//u", "$1", $content);
    $content = preg_replace("/(百|三)\//u", "$1", $content);
    $content = preg_replace("/(十|四)\//u", "$1", $content);
    $content = preg_replace("/(个|五)\//u", "$1", $content);
    $content = preg_replace("/(万|一)/u", "1/", $content);
    $content = preg_replace("/(千|二)/u", "2/", $content);
    $content = preg_replace("/(百|三)/u", "3/", $content);
    $content = preg_replace("/(十|四)/u", "4/", $content);
    $content = preg_replace("/(个|五)/u", "5/", $content);
    $content = preg_replace("/(龙|虎|和)\//u", "$1", $content);
    $content = preg_replace("/\/(龙|虎|和)/u", "$1", $content);
    $content = preg_replace("/(龙|虎|和)/u", "总/$1/", $content);
    $content = preg_replace("/[前Qq]/u", "前三/", $content);
    $content = preg_replace("/[中Zz]/u", "中三/", $content);
    $content = preg_replace("/[后Hh]/u", "后三/", $content);
    $content = preg_replace("/[包]/u", "包/", $content);
    $content = preg_replace("/(大|小|单|双|豹子|顺子|对子|半顺|杂六|前三|中三|后三)\//u", "$1", $content);
    $content = preg_replace("/\/(大|小|单|双|豹子|顺子|对子|半顺|杂六)/u", "$1", $content);
    $content = preg_replace("/(大|小|单|双|豹子|顺子|对子|半顺|杂六)/u", "/$1/", $content);
    switch ($BetGame) {
        case 'cqssc':
            $table = 'fn_lottery3';
            $ordertable = 'fn_sscorder';
            break;
        case "jsssc":
            $table = 'fn_lottery8';
            $ordertable = 'fn_jssscorder';
            break;
        case "txffc":
            $table = 'fn_lottery16';
            $ordertable = 'fn_ffcorder';
            break;
        case "azxy5":
            $table = 'fn_lottery18';
            $ordertable = 'fn_azxy5order';
            break;
    }
    $dx_min = get_query_val($table, 'dx_min', array('roomid' => $postRoomid));
    $dx_max = get_query_val($table, 'dx_max', array('roomid' => $postRoomid));
    $ds_min = get_query_val($table, 'ds_min', array('roomid' => $postRoomid));
    $ds_max = get_query_val($table, 'ds_max', array('roomid' => $postRoomid));
    $lh_min = get_query_val($table, 'lh_min', array('roomid' => $postRoomid));
    $lh_max = get_query_val($table, 'lh_max', array('roomid' => $postRoomid));
    $tm_min = get_query_val($table, 'tm_min', array('roomid' => $postRoomid));
    $tm_max = get_query_val($table, 'tm_max', array('roomid' => $postRoomid));
    $zh_min = get_query_val($table, 'zh_min', array('roomid' => $postRoomid));
    $zh_max = get_query_val($table, 'zh_max', array('roomid' => $postRoomid));
    $bz_min = get_query_val($table, 'bz_min', array('roomid' => $postRoomid));
    $bz_max = get_query_val($table, 'bz_max', array('roomid' => $postRoomid));
    $dz_min = get_query_val($table, 'dz_min', array('roomid' => $postRoomid));
    $dz_max = get_query_val($table, 'dz_max', array('roomid' => $postRoomid));
    $sz_min = get_query_val($table, 'sz_min', array('roomid' => $postRoomid));
    $sz_max = get_query_val($table, 'sz_max', array('roomid' => $postRoomid));
    $bs_min = get_query_val($table, 'bs_min', array('roomid' => $postRoomid));
    $bs_max = get_query_val($table, 'bs_max', array('roomid' => $postRoomid));
    $zl_min = get_query_val($table, 'zl_min', array('roomid' => $postRoomid));
    $zl_max = get_query_val($table, 'zl_max', array('roomid' => $postRoomid));
    $zym_8 = get_query_val('fn_user', 'jia', array('userid' => $userid, 'roomid' => $postRoomid)) == 'true' ? 'true' : 'false';
    $touzhu = false;
    $A = explode(" ", $content);
    $zym_2 = "";
    foreach ($A as $ai) {
        $ai = str_replace(" ", "", $ai);
        if (empty($ai)) continue;
        if (substr($ai, 0, 1) == '/') $ai = '1' . $ai;
        $b = explode("/", $ai);
        if (count($b) == 2) {
            if (preg_match("/(大|小|单|双)/u", $ai)) {
                $ai = '1/' . $ai;
            } else {
                $ai = '包/' . $ai;
            }
            $b = explode("/", $ai);
        }
        if (count($b) != 3) continue;
        if ($b[0] == "" || $b[1] == "" || (int)$b[2] < 1) continue;
        $zym_9 = 查询用户余额($userid);
        $zym_10 = $b[0];
        $zym_6 = $b[1];
        $zym_5 = (int)$b[2];
        if ($zym_10 == '总') {
            if ($zym_6 == '大' || $zym_6 == '小') {
                if ((int)$zym_9 < (int)$zym_5) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $zh_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $zh_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                $touzhu = true;
                continue;
            } elseif ($zym_6 == '单' || $zym_6 == '双') {
                if ((int)$zym_9 < (int)$zym_5) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $zh_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $zh_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                $touzhu = true;
                continue;
            } elseif ($zym_6 == '龙' || $zym_6 == '虎' || $zym_6 == '和') {
                if ((int)$zym_9 < (int)$zym_5) {
                    $zym_2 .= $zym_6 . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $lh_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $lh_max) {
                    $zym_2 .= $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $zym_10, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                $touzhu = true;
                continue;
            }
            continue;
        }
        if ($zym_6 == "大" || $zym_6 == "小" || $zym_6 == "单" || $zym_6 == "双") {
            $zym_10_分割 = 文本_逐字分割($zym_10);
            foreach ($zym_10_分割 as $ii) {
                if ((int)$ii > 5) {
                    管理员喊话("时时彩没有5球以上!本次投注请自行核对与撤单!");
                    break;
                }
                if ($zym_9 < count($zym_10_分割) * (int)$zym_5) {
                    $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $dx_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $dx_max && $zym_6 == "大") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $dx_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $dx_max && $zym_6 == "小") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $ds_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $ds_max && $zym_6 == "单") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                } elseif ($zym_5 < $ds_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $ds_max && $zym_6 == "双") {
                    $zym_2 .= $ii . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                continue;
            }
            continue;
        }
        if ($zym_10 == '前三' || $zym_10 == '中三' || $zym_10 == '后三' || preg_match("/(前三|中三|后三)/u", $zym_10)) {
            $arr = 前中后分割($zym_10);
            foreach ($arr as $i) {
                if ($zym_9 < (int)$zym_5) {
                    $zym_2 = $zym_2 . $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    break;
                } elseif ($zym_5 < $bz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $bz_max && $zym_6 == "豹子") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $dz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $dz_max && $zym_6 == "对子") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $sz_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $sz_max && $zym_6 == "顺子") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $bs_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $bs_max && $zym_6 == "半顺") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                } elseif ($zym_5 < $zl_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $zl_max && $zym_6 == "杂六") {
                    $zym_2 .= $i . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    break;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $i, 'content' => $zym_6, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
                continue;
            }
            continue;
        }
        if ($zym_10 == "包") {
            $zym_6_分割 = 文本_逐字分割($zym_6);
            foreach ($zym_6_分割 as $ii) {
                if (!is_numeric($ii)) {
                    continue;
                } elseif ((int)$zym_9 < (int)$zym_5 * 5 * count($zym_6_分割)) {
                    $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                    continue;
                } elseif ($zym_5 < $tm_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $tm_max) {
                    $zym_2 .= $zym_10 . "/" . $ii . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                用户_下分($userid, $zym_5 * 5);
                db_query("INSERT INTO {$ordertable}(userid, username, headimg, term, mingci, content, `money`, addtime, `status`, jia, roomid) VALUES('$userid', '$nickname', '$headimg', '$addQihao', '1', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}'), ('$userid', '$nickname', '$headimg', '$addQihao', '2', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}'), ('$userid', '$nickname', '$headimg', '$addQihao', '3', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}'), ('$userid', '$nickname', '$headimg', '$addQihao', '4', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}'), ('$userid', '$nickname', '$headimg', '$addQihao', '5', '{$ii}', '{$zym_5}', now(), '未结算', '{$zym_8}', '{$postRoomid}')");
                $touzhu = true;
                continue;
            }
            continue;
        }
        $zym_6_分割 = 文本_逐字分割($zym_6);
        $zym_10_分割 = 文本_逐字分割($zym_10);
        foreach ($zym_10_分割 as $ii) {
            if ($zym_9 < count($zym_10_分割) * count($zym_6_分割) * (int)$zym_5) {
                $zym_2 = $zym_2 . $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                break;
            }
            if ((int)$ii > 5) {
                管理员喊话("时时彩没有5球以上!本次投注请自行核对与撤单!");
                break;
            }
            foreach ($zym_6_分割 as $iii) {
                if (!is_numeric($iii)) {
                    continue;
                }
                if ($zym_5 < $tm_min || sum_betmoney($ordertable, $zym_10, $zym_6, $userid, $addQihao) + $zym_5 > $tm_max) {
                    $zym_2 .= $zym_10 . "/" . $zym_6 . "/" . $zym_5 . " ";
                    $chaozhu = true;
                    continue;
                }
                $touzhu = true;
                用户_下分($userid, $zym_5);
                insert_query($ordertable, array('term' => $addQihao, 'userid' => $userid, 'username' => $nickname, 'headimg' => $headimg, 'mingci' => $ii, 'content' => $iii, 'money' => $zym_5, 'addtime' => 'now()', 'roomid' => $postRoomid, 'status' => '未结算', 'jia' => $zym_8), $chat_id);
            }
        }
        continue;
    }
    if ($zym_2 != "") {
        if ($chaozhu) {
            管理员喊话("@{$nickname},您的:{$zym_2}未接<br>您的投注已超出限制！<br>本房投注限制如下:<br>大小最低{$dx_min}起,最高{$dx_max}<br>单双最低{$ds_min}起,最高{$ds_max}<br>龙虎最低{$lh_min}起,最高{$lh_max}<br>特码最低{$tm_min}起,最高{$tm_max}<br>豹子最低{$bz_min}起,最高{$bz_max}<br>对子最低{$dz_min}起,最高{$dz_max}<br>顺子最低{$sz_min}起,最高{$sz_max}<br>半顺最低{$bs_min}起,最高{$bs_max}<br>杂六最低{$zl_min}起,最高{$zl_max}<br>总和大小单双最低{$zh_min}起,最高{$zh_max}");
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        } else {
            管理员喊话("@{$nickname},您的:{$zym_2}未接，您的余额：" . 查询用户余额($userid));
            $carr[0] = true;
            $carr[1] = $chat_id;
            return $carr;
        }
    } elseif (get_query_val("fn_setting", "setting_tishi", array("roomid" => $postRoomid)) == 'open' && $touzhu == true) {
        管理员喊话("@$nickname,投注成功！请选择左侧菜单核对投注！");
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    } elseif ($touzhu) {
        $carr[0] = true;
        $carr[1] = $chat_id;
        return $carr;
    }
    $carr[0] = false;
    $carr[1] = $chat_id;
    return $carr;
}

?>