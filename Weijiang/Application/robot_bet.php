<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$time = get_query_vals('fn_setting', '*', array('roomid' => $_SESSION['agent_room']));
$refreshset = rand((int)$time['setting_robot_min'], (int)$time['setting_robot_max']);
if($time['setting_robot_min'] == ""){
    $refreshset = rand(3, 8);
}
$BetGame = $_GET['g'];
runrobot($BetGame, $name, $headimg, $content);
function str_replace_once($needle, $replace, $haystack){
    $pos = strpos($haystack, $needle);
    if ($pos === false){
        return $haystack;
    }
    return substr_replace($haystack, $replace, $pos, strlen($needle));
}
function 管理员喊话($Content, $game){
    $headimg = get_query_val('fn_setting', 'setting_robotsimg', array('roomid' => $_SESSION['agent_room']));
    insert_query("fn_chat", array("userid" => "system", "username" => "播报员", "game" => $game, 'headimg' => $headimg, 'content' => $Content, 'addtime' => date('H:i:s'),  'time'=>date('Y-m-d H:i:s',time()),'type' => 'S3', 'roomid' => $_SESSION['agent_room']));
}
function runrobot($BetGame, & $name, & $headimg, & $plan){
    if($BetGame == 'pk10'){
        if(get_query_val('fn_lottery1', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'xyft'){
        if(get_query_val('fn_lottery2', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'cqssc'){
        if(get_query_val('fn_lottery3', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'xy28'){
        if(get_query_val('fn_lottery4', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'jnd28'){
        if(get_query_val('fn_lottery5', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'jsmt'){
        if(get_query_val('fn_lottery6', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'jssc'){
        if(get_query_val('fn_lottery7', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'jsssc'){
        if(get_query_val('fn_lottery8', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'kuai3'){
        if(get_query_val('fn_lottery9', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'bjl'){
        if(get_query_val('fn_lottery10', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'gd11x5'){
        if(get_query_val('fn_lottery11', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'jssm'){
        if(get_query_val('fn_lottery12', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'lhc'){
        if(get_query_val('fn_lottery13', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'jslhc'){
        if(get_query_val('fn_lottery14', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'twk3'){
        if(get_query_val('fn_lottery15', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'txffc'){
        if(get_query_val('fn_lottery16', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'azxy10'){
        if(get_query_val('fn_lottery17', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }elseif($BetGame == 'azxy5'){
        if(get_query_val('fn_lottery18', 'gameopen', array('roomid' => $_SESSION['agent_room'])) == 'false')$BetGame = 'feng';
    }
  
    if($BetGame == 'pk10'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 1 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery1', 'fengtime', array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 1 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 1 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'xyft'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 2 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery2', 'fengtime', array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 2 order by term desc limit 1')) - time();
       $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 2 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'cqssc'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 3 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery3', 'fengtime', array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 3 order by term desc limit 1')) - time();
       $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 3 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'xy28'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 4 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery4', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 4 order by term desc limit 1')) - time();
      $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 4 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'jnd28'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 5 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery5', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 5 order by term desc limit 1')) - time();
      $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 5 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'jsmt'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 6 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery6', 'fengtime',array('roomid' => $_SESSION['agent_room']));
      $kongzhi = get_query_val('fn_lottery6', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 6 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 6 order by term desc limit 1"));
        
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 6 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 6 order by term desc limit 1"));
        
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'jssc'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 7 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery7', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $kongzhi = get_query_val('fn_lottery7', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 7 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 7 order by term desc limit 1"));
       
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 7 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 7 order by term desc limit 1"));
        
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'jsssc'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 8 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery8', 'fengtime',array('roomid' => $_SESSION['agent_room']));
         $kongzhi = get_query_val('fn_lottery8', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 8 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 8 order by term desc limit 1"));
        
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 8 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 8 order by term desc limit 1"));
       
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'kuai3'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 9 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery9', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 9 order by term desc limit 1')) - time();
      $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 9 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'bjl'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 10 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery10', 'fengtime',array('roomid' => $_SESSION['agent_room']));
     $kongzhi = get_query_val('fn_lottery10', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 10 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 10 order by term desc limit 1"));
       
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 10 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 10 order by term desc limit 1"));
       
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'gd11x5'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 11 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery11', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 11 order by term desc limit 1')) - time();
      $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 11 order by term desc limit 1"));
        if($opentime < 9)exit;
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'jssm'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 12 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery12', 'fengtime',array('roomid' => $_SESSION['agent_room']));
       $kongzhi = get_query_val('fn_lottery12', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 12 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 12 order by term desc limit 1"));
       
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 12 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 12 order by term desc limit 1"));
       
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'lhc'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 13 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery13', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 13 order by term desc limit 1')) - time();
      $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 13 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'jslhc'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 14 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery14', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $kongzhi = get_query_val('fn_lottery14', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 14 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 14 order by term desc limit 1"));
       
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 14 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 14 order by term desc limit 1"));
        
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'twk3'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 15 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery15', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $kongzhi = get_query_val('fn_lottery15', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 15 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 15 order by term desc limit 1"));
       
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 15 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 15 order by term desc limit 1"));
       
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'txffc'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 16 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery16', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $kongzhi = get_query_val('fn_lottery16', 'kongzhi',array('roomid' => $_SESSION['agent_room']));
      if($kongzhi == '1'){
       $roomid = $_SESSION['agent_room']; 
      $djs = strtotime(get_query_val('fn_sopen', 'next_time', "`type` = 16 and `roomid` = '$roomid'order by `term` desc limit 1")) - time();
        $opentime = time()-strtotime(get_query_val('fn_sopen', 'opentime', "type = 16 order by term desc limit 1"));
       
      }else{
      $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 16 order by term desc limit 1')) - time();
        $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 16 order by term desc limit 1"));
       
      }
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'azxy10'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 17 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery17', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 17 order by term desc limit 1')) - time();
      $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 17 order by term desc limit 1"));
      
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'azxy5'){
        $BetTerm = get_query_val('fn_open', 'next_term', "type = 18 order by term desc limit 1");
        $time = (int)get_query_val('fn_lottery18', 'fengtime',array('roomid' => $_SESSION['agent_room']));
        $djs = strtotime(get_query_val('fn_open', 'next_time', 'type = 18 order by term desc limit 1')) - time();
      $opentime = time()-strtotime(get_query_val('fn_open', 'time', "type = 18 order by term desc limit 1"));
       
        if($djs < $time){
            $fengpan = true;
        }else{
            $fengpan = false;
        }
    }elseif($BetGame == 'feng'){
        $fengpan = true;
    }
    if(!$fengpan){
        $robots = get_query_vals('fn_robots', '*', "roomid = {$_SESSION['agent_room']} and game = '{$BetGame}' order by rand() desc limit 1");
        $headimg = $robots['headimg'];
        $name = $robots['name'];
        $plan = $robots['plan'];
        $plan = explode('|', $plan);
        if($headimg == ''){
            exit;
        }
        if($headimg == '' || $name == '' || $plan == '')return;
        $use = rand(0, count($plan)-1);
        $plan = get_query_val('fn_robotplan', 'content', array('id' => $plan[$use]));
        if($plan == '')exit;
        if(preg_match("/{随机名次}/", $plan)){
            $i2 = substr_count($plan, '{随机名次}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机名次}", rand(0, 9), $plan);
            }
        }
       if(preg_match("/{随机位数}/", $plan)){
            $i2 = substr_count($plan, '{随机位数}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机位数}", rand(1, 5), $plan);
            }
        }
      if(preg_match("/{随机三军}/", $plan)){
            $i2 = substr_count($plan, '{随机三军}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机三军}", rand(1, 6), $plan);
            }
        }
        if(preg_match("/{随机特码}/", $plan)){
            $i2 = substr_count($plan, '{随机特码}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机特码}", rand(0, 9), $plan);
            }
        }
        if(preg_match("/{随机定胆}/", $plan)){
            $i2 = substr_count($plan, '{随机定胆}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机定胆}", rand(1, 11), $plan);
            }
        }
        if(preg_match("/{随机平特}/", $plan)){
            $i2 = substr_count($plan, '{随机平特}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机平特}", rand(1, 7), $plan);
            }
        }
        if(preg_match("/{随机双面}/", $plan)){
            $val = rand(1, 4);
            if($val == 1){
                $val = '大';
            }elseif($val == 2){
                $val = '小';
            }elseif($val == 3){
                $val = '单';
            }elseif($val == 4){
                $val = '双';
            }
            $plan = str_replace('{随机双面}', $val, $plan);
        }
       if(preg_match("/{随机通选}/", $plan)){
            $val = rand(1, 5);
            if($val == 1){
                $val = '豹子';
            }elseif($val == 2){
                $val = '对子';
            }elseif($val == 3){
                $val = '顺子';
            }elseif($val == 4){
                $val = '三杂';
            }elseif($val == 5){
                $val = '二杂';
            }
            $plan = str_replace('{随机通选}', $val, $plan);
        }
    if(preg_match("/{随机豹子}/", $plan)){
            $val = rand(1, 6);
            if($val == 1){
                $val = '111';
            }elseif($val == 2){
                $val = '222';
            }elseif($val == 3){
                $val = '333';
            }elseif($val == 4){
                $val = '444';
            }elseif($val == 5){
                $val = '555';
            }elseif($val == 6){
                $val = '666';
            }
            $plan = str_replace('{随机豹子}', $val, $plan);
        }
       if(preg_match("/{随机对子}/", $plan)){
            $val = rand(1, 6);
            if($val == 1){
                $val = '11';
            }elseif($val == 2){
                $val = '22';
            }elseif($val == 3){
                $val = '33';
            }elseif($val == 4){
                $val = '44';
            }elseif($val == 5){
                $val = '55';
            }elseif($val == 6){
                $val = '66';
            }
            $plan = str_replace('{随机对子}', $val, $plan);
        }
       if(preg_match("/{随机顺子}/", $plan)){
            $val = rand(1, 4);
            if($val == 1){
                $val = '123';
            }elseif($val == 2){
                $val = '234';
            }elseif($val == 3){
                $val = '345';
            }elseif($val == 4){
                $val = '456';
            }
            $plan = str_replace('{随机顺子}', $val, $plan);
        }
      if(preg_match("/{随机三杂}/", $plan)){
            $val = rand(1, 20);
            if($val == 1){
                $val = '123';
            }elseif($val == 2){
                $val = '124';
            }elseif($val == 3){
                $val = '125';
            }elseif($val == 4){
                $val = '126';
            }elseif($val == 5){
                $val = '134';
            }elseif($val == 6){
                $val = '135';
            }elseif($val == 7){
                $val = '136';
            }elseif($val == 8){
                $val = '145';
            }elseif($val == 9){
                $val = '146';
            }elseif($val == 10){
                $val = '156';
            }elseif($val == 11){
                $val = '234';
            }elseif($val == 12){
                $val = '235';
            }elseif($val == 13){
                $val = '236';
            }elseif($val == 14){
                $val = '245';
            }elseif($val == 15){
                $val = '246';
            }elseif($val == 16){
                $val = '256';
            }elseif($val == 17){
                $val = '345';
            }elseif($val == 18){
                $val = '346';
            }elseif($val == 19){
                $val = '356';
            }elseif($val == 20){
                $val = '456';
            }
            $plan = str_replace('{随机三杂}', $val, $plan);
        }
      if(preg_match("/{随机二杂}/", $plan)){
            $val = rand(1, 15);
            if($val == 1){
                $val = '12';
            }elseif($val == 2){
                $val = '13';
            }elseif($val == 3){
                $val = '14';
            }elseif($val == 4){
                $val = '15';
            }elseif($val == 5){
                $val = '16';
            }elseif($val == 6){
                $val = '23';
            }elseif($val == 7){
                $val = '24';
            }elseif($val == 8){
                $val = '25';
            }elseif($val == 9){
                $val = '26';
            }elseif($val == 10){
                $val = '34';
            }elseif($val == 11){
                $val = '35';
            }elseif($val == 12){
                $val = '36';
            }elseif($val == 13){
                $val = '45';
            }elseif($val == 14){
                $val = '46';
            }elseif($val == 15){
                $val = '56';
            }
            $plan = str_replace('{随机二杂}', $val, $plan);
        }
      
        if(preg_match("/{随机单肖}/", $plan)){
            $val = rand(1, 12);
            if($val == 1){
                $val = '猴';
            }elseif($val == 2){
                $val = '羊';
            }elseif($val == 3){
                $val = '马';
            }elseif($val == 4){
                $val = '蛇';
            }elseif($val == 5){
                $val = '龙';
            }elseif($val == 6){
                $val = '兔';
            }elseif($val == 7){
                $val = '虎';
            }elseif($val == 8){
                $val = '牛';
            }elseif($val == 9){
                $val = '鼠';
            }elseif($val == 10){
                $val = '猪';
            }elseif($val == 11){
                $val = '狗';
            }elseif($val == 12){
                $val = '鸡';
            }
            $plan = str_replace('{随机单肖}', $val, $plan);
        }
       $shengxiao = ['猴','羊','马','蛇','龙','兔','虎','牛','鼠','猪','狗','鸡'];
       shuffle($shengxiao);
       if(preg_match("/{随机二肖}/", $plan)){
         $plan = str_replace('{随机二肖}',$shengxiao[0].$shengxiao[1], $plan);
        }
       if(preg_match("/{随机三肖}/", $plan)){
         $plan = str_replace('{随机三肖}',$shengxiao[0].$shengxiao[1].$shengxiao[2], $plan);
        }
       if(preg_match("/{随机四肖}/", $plan)){
         $plan = str_replace('{随机四肖}',$shengxiao[0].$shengxiao[1].$shengxiao[2].$shengxiao[3], $plan);
        }
       if(preg_match("/{随机五肖}/", $plan)){
         $plan = str_replace('{随机五肖}',$shengxiao[0].$shengxiao[1].$shengxiao[2].$shengxiao[3].$shengxiao[4], $plan);
        }
      
      if(preg_match("/{随机波色}/", $plan)){
            $val = rand(1, 3);
            if($val == 1){
                $val = '红波';
            }elseif($val == 2){
                $val = '蓝波';
            }elseif($val == 3){
                $val = '绿波';
            }
            $plan = str_replace('{随机波色}', $val, $plan);
        }
        if(preg_match("/{随机龙虎}/", $plan)){
            $val = rand(1, 2);
            if($val == 1){
                $val = '龙';
            }elseif($val == 2){
                $val = '虎';
            }
            $plan = str_replace('{随机龙虎}', $val, $plan);
        }
        if(preg_match("/{随机极值}/", $plan)){
            $val = rand(1, 2);
            if($val == 1){
                $val = '极大';
            }elseif($val == 2){
                $val = '极小';
            }
            $plan = str_replace('{随机极值}', $val, $plan);
        }
        if(preg_match("/{随机组合1}/", $plan)){
            $val = rand(1, 2);
            if($val == 1){
                $val = '大单';
            }elseif($val == 2){
                $val = '大双';
            }
            $plan = str_replace('{随机组合1}', $val, $plan);
        }
        if(preg_match("/{随机组合2}/", $plan)){
            $val = rand(1, 2);
            if($val == 1){
                $val = '小单';
            }elseif($val == 2){
                $val = '小双';
            }
            $plan = str_replace('{随机组合2}', $val, $plan);
        }
        if(preg_match("/{随机数字}/", $plan)){
            $i2 = substr_count($plan, '{随机数字}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机数字}", rand(0, 27), $plan);
            }
        }
        if(preg_match("/{随机和值}/", $plan)){
            $i2 = substr_count($plan, '{随机和值}');
            for($i = 0;$i < $i2;$i++){
                $plan = str_replace_once("{随机和值}", rand(3, 19), $plan);
            }
        }
        if(preg_match("/{随机特殊}/", $plan)){
            $val = rand(1, 3);
            if($val == 1){
                $val = '豹子';
            }elseif($val == 2){
                $val = '对子';
            }elseif($val == 3){
                $val = '顺子';
            }
            $plan = str_replace('{随机特殊}', $val, $plan);
        }
       if(preg_match("/{随机庄闲}/", $plan)){
            $val = rand(1, 2);
            if($val == 1){
                $val = '庄';
            }elseif($val == 2){
                $val = '闲';
            }
            $plan = str_replace('{随机庄闲}', $val, $plan);
        }
      if(preg_match("/{随机和对}/", $plan)){
            $val = rand(1, 4);
            if($val == 1){
                $val = '庄对';
            }elseif($val == 2){
                $val = '闲对';
            }elseif($val == 3){
                $val = '和';
            }elseif($val == 4){
                $val = '任意对';
            }
            $plan = str_replace('{随机和对}', $val, $plan);
        }
       $jine1 = ['10','20','30','40','50','60','100','120','150','110','55','70','130','140','160','170','180','190','200','210','220','230','35','45','65','75','88','80','90','120','100','135','215','245','265','255','155','270'];
       shuffle($jine1);   
       $jine2 = ['100','200','300','400','500','600','700','800','900','550','650','450','350','750','850','950','1000','1100','1150','1200','1250','1280','350','120','115','165','460','480','580','680','520','720','780','380','880','355','640','690','666','888','222','1260','310'];
       shuffle($jine2);
       $jine3 = ['1100','1250','2000','3000','4000','5000','6000','7000','8000','9000','10000','11000','12000','13000','14000','15000','1300','1550','8500','7500','6500','3500','4500','5500','2500','1800','9500','3300','7750','8800','2600'];
       shuffle($jine3);
       if(preg_match("/{随机金额1}/", $plan)){
            $plan = str_replace('{随机金额1}',$jine1[0], $plan);
        }
        if(preg_match("/{随机金额2}/", $plan)){
            $plan = str_replace('{随机金额2}', $jine2[0], $plan);
        }
        if(preg_match("/{随机金额3}/", $plan)){
            $plan = str_replace('{随机金额3}', $jine3[0], $plan);
        }
       $temac = ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38','39','40','41','42','43','44','45','46','47','48'];
       shuffle($temac);
       if(preg_match("/{随机号数}/", $plan)){
         $plan = str_replace('{随机号数}',$temac[0], $plan);
        }
       if(preg_match("/{随机连码2}/", $plan)){
       $plan = str_replace('{随机连码2}',$temac[0].'.'.$temac[1], $plan);
       }
      if(preg_match("/{随机连码3}/", $plan)){
       $plan = str_replace('{随机连码3}',$temac[0].'.'.$temac[1].'.'.$temac[2], $plan);
       }
      if(preg_match("/{随机连码4}/", $plan)){
       $plan = str_replace('{随机连码4}',$temac[0].'.'.$temac[1].'.'.$temac[2].'.'.$temac[3], $plan);
       }
       $mnj  = explode('/',$plan);
      if(count($mnj)!=3){
      $mingci = '';
      $neirong = $mnj[0];  
      $jine_1 = $mnj[1];  
      }else{
      $mingci = $mnj[0];
      $neirong = $mnj[1];  
      $jine_1 = $mnj[2]; 
      }
 
      
      
        
        insert_query("fn_chat", array("userid" => "robot", "username" => $name, 'headimg' => $headimg, 'term'=>$BetTerm,'content' => $plan, 'mingci'=>$mingci,'neirong'=>$neirong, 'jine'=>$jine_1, 'status'=>'未结算','addtime' => date('H:i:s'), 'time'=>date('Y-m-d H:i:s',time()), 'game' => $BetGame, 'roomid' => $_SESSION['agent_room'], 'type' => 'U3'));
        if(get_query_val("fn_setting", "setting_tishi", array("roomid" => $_SESSION['agent_room'])) == 'open'){
            管理员喊话("@$name,投注成功！请选择左侧菜单核对投注！", $BetGame);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="refresh" content="<?=$refreshset?>" />
	<title>聊天下注播报员</title>
</head>
<body>
<?php
 echo $BetGame . "已自动发言: <img src=\"" . $headimg . "\" alt=\"\" width=\"28\" height=\"28\" /> " . $name . "[$content]";
?>
</body>
</html>