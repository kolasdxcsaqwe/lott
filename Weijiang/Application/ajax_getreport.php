<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$type = $_GET['t'];
if($type == '1'){
    $id = $_GET['userid'];
    $time = $_GET['time'] == '' ? date('Y-m-d'): $_GET['time'];
    $username = get_query_val('fn_user', 'username', array('id' => $id));
    $id = get_query_val('fn_user', 'userid', array('id' => $id));
    select_query("fn_marklog", '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
    while($con = db_fetch_array()){
        $cons[] = $con;
        $data['data'][] = array($con['id'], $username, $con['type'], $con['money'], $con['content'], $con['addtime']);
    }
    if (count($cons) == 0){
        $data['data'][] = null;
    }
    echo json_encode($data);
    exit();
}elseif($type == 'uip'){
    $id = $_GET['userid'];
    $arrs = get_query_vals('fn_user', '*', array('id' => $id));
    select_query("fn_userlog", '*', "`roomid` = '{$_SESSION['agent_room']}' and `userid` = '{$arrs['userid']}' order by time desc limit 30");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
  foreach($cons as $con){
      $data['data'][] = array($con['id'], $arrs['username'], $con['ip'],city($con['ip']), ($con['addtime']), $con['userid']);
  }
  
    if (count($cons) == 0){
        $data['data'][] = null;
    }
    echo json_encode($data);
    exit();
}elseif($type == '2'){
    $id = $_GET['userid'];
    $time = $_GET['time'] == "" ? date('Y-m-d'): $_GET['time'];
    $code = $_GET['code'];
    $allmoney = 0;
    $allstatus = 0;
    $id = get_query_val('fn_user', 'userid', array('id' => $id));
   /* if($code == "" || $code == 'pk10' || $code == 'xyft'){
        select_query('fn_order', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $game = strlen($con['term']) < 8 ? '北京赛车' : '幸运飞艇';
            if($code == 'pk10' && $game == '幸运飞艇')continue;
            if($code == 'xyft' && $game == '北京赛车')continue;
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], $game, $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }*/
	  if($code == '' || $code == 'pk10'){
        select_query('fn_order', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '北京赛车', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    } if($code == '' || $code == 'xyft'){
        select_query('fn_flyorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '幸运飞艇', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
    if($code == '' || $code == 'cqssc'){
        select_query('fn_sscorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '重庆时时彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
    if($code == '' || $code == 'xy28' || $code == 'jnd28'){
        select_query('fn_pcorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $game = (int)$con['term'] > 2000000 ? '加拿大28' : '幸运28';
            if($code == 'xy28' && $game == '加拿大28')continue;
            if($code == 'jnd28' && $game == '幸运28')continue;
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], $game, $con['term'], $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
    if($code == '' || $code == 'jsmt'){
        select_query('fn_mtorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '极速摩托', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
    if($code == '' || $code == 'jssc'){
        select_query('fn_jsscorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '极速赛车', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
    if($code == '' || $code == 'jsssc'){
        select_query('fn_jssscorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '极速时时彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
   if($code == '' || $code == 'kuai3'){
        select_query('fn_k3order', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '江苏快三', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
   if($code == '' || $code == 'bjl'){
        select_query('fn_bjlorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '百家乐', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
   if($code == '' || $code == 'gd11x5'){
        select_query('fn_11x5order', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '广东11选5', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
   if($code == '' || $code == 'jssm'){
        select_query('fn_smorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '极速赛马', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
   if($code == '' || $code == 'lhc'){
        select_query('fn_lhcorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '六合彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
     if($code == '' || $code == 'jslhc'){
        select_query('fn_jslhcorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '极速六合彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
  if($code == '' || $code == 'twk3'){
        select_query('fn_twk3order', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '台湾快三', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
    if($code == '' || $code == 'txffc'){
        select_query('fn_ffcorder', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '腾讯分分彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
  if($code == '' || $code == 'azxy10'){
        select_query('fn_azxy10order', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '澳洲幸运10', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
  if($code == '' || $code == 'azxy5'){
        select_query('fn_azxy5order', '*', "roomid = '{$_SESSION['agent_room']}' and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time} 23:59:59')");
        while($con = db_fetch_array()){
            $cons[] = $con;
            if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
            if($con['status'] > 0)$allstatus += $con['status'];
            $data['data'][] = array('#' . $con['id'], $con['username'], '河内5分彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
        }
    }
    if (count($cons) == 0){
        $data['data'][] = null;
    }
    $allstatus = $allstatus - $allmoney;
    $data['allmoney'] = sprintf("%.2f", substr(sprintf("%.3f", $allmoney), 0, -2));
    $data['allstatus'] = sprintf("%.2f", substr(sprintf("%.3f", $allstatus), 0, -2));
    echo json_encode($data);
    exit();
}elseif($type == '3'){
    $term = $_GET['term'];
    $game = $_GET['game'];
  /*  if($game == 'pk10' || $game == 'xyft'){
        select_query('fn_order', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        $allz = 0;
        $allm = 0;
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }*/
	if($game == 'pk10'){
        select_query('fn_order', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
		$allz = 0;
        $allm = 0;
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'xyft'){
        select_query('fn_flyorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'cqssc'){
        select_query('fn_sscorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'xy28' || $game == 'jnd28'){
        select_query('fn_pcorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'jsmt'){
        select_query('fn_mtorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'jssc'){
        select_query('fn_jsscorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'jsssc'){
        select_query('fn_jssscorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'kuai3'){
        select_query('fn_k3corder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'bjl'){
        select_query('fn_bjlorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'gd11x5'){
        select_query('fn_11x5order', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'jssm'){
        select_query('fn_smorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'lhc'){
        select_query('fn_lhcorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
    }elseif($game == 'jslhc'){
        select_query('fn_jslhcorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'twk3'){
        select_query('fn_twk3order', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'txffc'){
        select_query('fn_ffcorder', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'azxy10'){
        select_query('fn_azxy10order', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }elseif($game == 'azxy5'){
        select_query('fn_azxy5order', '*', "roomid = {$_SESSION['agent_room']} and term = {$term}");
        while($con = db_fetch_array()){
            $cons[] = $con;
            $arr['data'][] = array($con['id'], $con['username'], $con['content'], $con['money'], $con['addtime'], $con['status']);
            $allm += (int)$con['money'];
            if((int)$con['status'] > 0){
                $allz += (int)$con['status'];
            }
        }
        $arr['allm'] = $allm;
        $arr['allz'] = number_format($allz - $allm, 2);
        if(count($cons) == 0){
            $arr['data'][0] = 'null';
        }
        echo json_encode($arr);
        exit;
    }
}

function ip() {
    //strcasecmp 比较两个字符，不区分大小写。返回0，>0，<0。
    if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
        $ip = getenv('HTTP_CLIENT_IP');
    } elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    } elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
        $ip = getenv('REMOTE_ADDR');
    } elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $res =  preg_match ( '/[\d\.]{7,15}/', $ip, $matches ) ? $matches [0] : '';
    return $res;
    //dump(phpinfo());//所有PHP配置信息
}
function city($ip){
$json=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$ip);
$arr=json_decode($json);
$gj = $arr->data->country;    //国家
$qy = $arr->data->area;    //区域
$sf = $arr->data->region;    //省份
$city = $arr->data->city;    //城市
$yys = $arr->data->isp;    //运营商
  if($gj == ''){
  $gj = '--';
  }
  if($qy == ''){
  $qy = '--';
  }
  if($sf == ''){
  $sf = '--';
  }
  if($city == ''){
  $city = '--';
  }
  if($yys == ''){
  $yys = '--';
  }
 return $gj.'|'.$sf.'|'.$qy.'|'.$city.'|'.$yys;
}
?>