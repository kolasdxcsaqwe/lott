<?php
 function getinfo($userid,$timestart=""){
    $time = array();
    $time[0] = date('Y-m-d') . " 00:00:00";
    if(!empty($timestart))
    {
        $time[0]=$timestart;
    }
    $time[1] = date('Y-m-d') . " 23:59:59";
    $sf = (int)get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and type = '上分' and status = '已处理' and (time between '{$time[0]}' and '{$time[1]}')");
    $xf = (int) get_query_val('fn_upmark', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and type = '下分' and status = '已处理' and (time between '{$time[0]}' and '{$time[1]}')");
    $allm = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $allz = get_query_val('fn_order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
	$allm1 = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $allz1 = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $sscm = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $sscz = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $pcm = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $pcz = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $mtm = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $mtz = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $jsscm = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $jsscz = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $jssscm = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $jssscz = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
   
    $azxy10m = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $azxy10z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $azxy5m = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $azxy5z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
   
    $kuai3m = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    
    $kuai3z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    
    $bjlm = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $bjlz = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $gdx5m = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $gdx5z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $lhcm = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $lhcz = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $jslhcm = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $jslhcz = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $jssmm = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $jssmz = get_query_val('fn_smorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $twk3m = (int)get_query_val('fn_twk3order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $twk3z = get_query_val('fn_twk3order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $txffcm = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $txffcz = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
   
    $azxy10m = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $azxy10z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    $azxy5m = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = '{$_SESSION['roomid']}'  and userid = '{$userid}' and (`addtime` between '{$time[0]}' and '{$time[1]}')  and (status > 0 or status < 0)");
    $azxy5z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = '{$_SESSION['roomid']}'  and (`addtime` between '{$time[0]}' and '{$time[1]}') and status > 0 and userid = '{$userid}'");
    
    $kuai3yk = $kuai3z -  $kuai3m;;
    $bjlyk = $bjlz - $bjlm;
    $gdx5yk = $gdx5z - $gdx5m;
    $lhcyk = $lhcz - $lhcm;
    $jslhcyk = $jslhcz - $jslhcm;
    $jssmyk = $jssmz - $jssmm;
    $twk3yk = $twk3z - $twk3m;
    $txffcyk = $txffcz - $txffcm;
   $azxy10yk = $azxy10z - $azxy10m;
   $azxy5yk = $azxy5z - $azxy5m;
   
    $sscyk = $sscz - $sscm;
    $jssscyk = $jssscz - $jssscm;
    $jsscyk = $jsscz - $jsscm;
    $mtyk = $mtz - $mtm;
    $pcyk = $pcz - $pcm;
    $yk = $allz - $allm;
	$yk1 = $allz1 - $allm1;
   
    $yk += $yk1 + $pcyk + $mtyk + $sscyk + $jsscyk + $jssscyk + $kuai3yk + $bjlyk + $gdx5yk + $lhcyk + $jslhcyk  + $jssmyk + $twk3yk + $txffcyk + $azxy10yk +$azxy5yk;
    $allm += $allm1 + $pcm + $mtm + $sscm + $jsscm + $jssscm + $kuai3m + $bjlm + $gdx5m + $lhcm + $jslhcm + $jssmm + $twk3m + $txffcm + $azxy5m + $azxy10m; 
    $yk = round($yk, 2);
    return array("yk" => $yk, 'liu' => $allm);
}
function getextend($userid, $time){
    $liushui = 0;
    $yk = 0;
    $money = 0;
    $sf = 0;
   $time = explode(' - ', $time);
    if(count($time) == 2){
        $ordersql = " and (`addtime` between '{$time[0]}' and '{$time[1]}')";
        $marksql = " and (`time` between '{$time[0]}' and '{$time[1]}')";
    }else{
        $ordersql = '';
        $marksql = '';
    }
    select_query("fn_user", '*', "`roomid` = '{$_SESSION['roomid']}'  and `agent` = '{$userid}'");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
        $l = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
        $ftl = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
        $pcl = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
        $sscl = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
        $mtl = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
        $jsscl = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
        $jssscl = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
        $kuai3l = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
      $bjll = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
      $gdx5l = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
      $jssml = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
      $lhcl = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
      $jslhcl = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
      $twk3l = (int)get_query_val('fn_twk3order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);    
      $txffcl = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql); 
      
      $azxy10l = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
      $azxy5l = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);

      
        $z = get_query_val('fn_order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
        $ftz = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
        $pcz = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
        $sscz = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
        $mtz = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
        $jsscz = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
        $jssscz = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $kuai3z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $bjlz = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $gdx5z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $jssmz = get_query_val('fn_smorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $lhcz = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $jslhcz = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $txffcz = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);  
      
      $azxy10z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $azxy5z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      
      
        $y = $z - $l;
        $pcy = $pcz - $pcl;
        $sscy = $sscz - $sscl;
        $mty = $mtz - $mtl;
        $jsscy = $jsscz - $jsscl;
        $jssscy = $jssscz - $jssscl;
        $twk3y = $twk3z - $twk3l;
        $txffcy = $txffcz - $txffcl;
        $azxy10y = $azxy10z - $azxy10l;
        $azxy5y = $azxy5z - $azxy5l;
        
      
      
        $fty = $ftz - $ftl;
        $kuai3y = $kuai3z -$kuai3l;
        $bjly =  $bjlz - $bjll;
        $gdx5y = $gdx5z - $gdx5l;
        $jssmy = $jssmz - $jssml;
        $lhcy = $lhcz - $lhcl;
        $jslhcy = $jslhcz - $jslhcl;
      
        $s = get_query_val('fn_upmark', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and userid = '{$con['userid']}' and `status` = '已处理'" . $marksql);
      
        $liushui += ($l + $pcl + $sscl + $mtl + $jsscl + $jssscl +$ftl + $kuai3l + $bjll + $gdx5l + $jssml + $lhcl + $jslhcl + $twk3l + $txffcl + $azxy10l + $azxy5l);
        $yk += ($y + $pcy + $sscy + $mty + $jsscy + $jssscy + $fty + $kuai3y + $bjly + $gdx5y + $jssmy + $lhcy + $jslhcy + $twk3y + $txffcy + $azxy5y + $azxy10y);
      
        $money += $con['money'];
        $sf += $s;
    }
    $arr = array('liu' => $liushui, 'yk' => sprintf("%.2f", substr(sprintf("%.3f", $yk), 0, -2)), 'money' => $money, 'pay' => $sf);
    return $arr;
}
function getorder($userid, $time){
    $time2 = date('Y-m-d');
    switch($time){
    case 1: $time = date('Y-m-d');
        break;
    case 7: $time = date('Y-m-d', strtotime('-1 day'));
        $time2 = date('Y-m-d', strtotime("-1 day"));
        break;
    case 30: $time = date('Y-m-d', strtotime('-30 day'));
        break;
    }
    $id = $userid;
    $code = "";
    $allmoney = 0;
    $allstatus = 0;
 /*   if($code == "" || $code == 'pk10' || $code == 'xyft'){
    select_query('fn_order', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
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
    select_query('fn_order', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
    while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '北京赛车', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
    }
    }
	if($code == '' || $code == 'xyft'){
    select_query('fn_flyorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
    while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '幸运飞艇', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
    }
    }
	

if($code == '' || $code == 'jsmt'){
select_query('fn_sscorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '重庆欢乐生肖', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
if($code == '' || $code == 'xy28' || $code == 'jnd28'){
select_query('fn_pcorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $game = (int)$con['term'] > 2000000 ? '加拿大28' : '新加坡28';
    if($code == 'xy28' && $game == '加拿大28')continue;
    if($code == 'jnd28' && $game == '新加坡28')continue;
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], $game, $con['term'], $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
if($code == '' || $code == 'jsmt'){
select_query('fn_mtorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '极速摩托', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
if($code == '' || $code == 'jssc'){
select_query('fn_jsscorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '极速赛车', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
if($code == '' || $code == 'jsssc'){
select_query('fn_jssscorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '极速时时彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
  if($code == '' || $code == 'kuai3'){
select_query('fn_k3order', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '江苏快三', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
  if($code == '' || $code == 'bjl'){
select_query('fn_bjlorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '百家乐', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
if($code == '' || $code == 'gd11x5'){
select_query('fn_11x5order', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '广东11选5', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
  if($code == '' || $code == 'jssm'){
select_query('fn_smorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '极速赛马', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
  if($code == '' || $code == 'lhc'){
select_query('fn_lhcorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '六合彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
  if($code == '' || $code == 'jslhc'){
select_query('fn_jslhcorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '极速六合彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
    if($code == '' || $code == 'twk3'){
select_query('fn_twk3order', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '台湾快三', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
      if($code == '' || $code == 'txffc'){
select_query('fn_ffcorder', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '腾讯分分彩', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
  if($code == '' || $code == 'azxy10'){
select_query('fn_azxy10order', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
while($con = db_fetch_array()){
    $cons[] = $con;
    if($con['status'] != '已撤单' && $con['status'] != '未结算')$allmoney += (int)$con['money'];
    if($con['status'] > 0)$allstatus += $con['status'];
    $data['data'][] = array('#' . $con['id'], $con['username'], '澳洲幸运10', $con['term'], $con['mingci'] . '/' . $con['content'], $con['money'], $con['addtime'], $con['status']);
}
}
  if($code == '' || $code == 'azxy5'){
select_query('fn_azxy5order', '*', "roomid = '{$_SESSION['roomid']}'  and userid = '{$id}' and (`addtime` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
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
return $data;
}
function getxia($userid,$time,$time2){
$allmoney = 0;
$allliu = 0;
$allyk = 0;
$alls = 0;

select_query("fn_user", '*', "`roomid` = '{$_SESSION['roomid']}'  and `agent` = '{$userid}'");
while($con = db_fetch_array()){
$cons[] = $con;
}
foreach($cons as $con){
$l = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = {$_SESSION['roomid']}  and (`addtime` between '{$time}' and '{$time2}') and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0) ");
$l1 = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
$pcl = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
$sscl = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
$mtl = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
$jsscl = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
$jssscl = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  
  $kuai3l = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  $bjll = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  $gdx5l = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  $jssml = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  $lhcl = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  $jslhcl = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  $twk3l = (int)get_query_val('fn_twk3order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)");
  $txffcl = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)"); 
  
  $azxy10l = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)"); 
  $azxy5l = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)"); 
  
$z = get_query_val('fn_order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
$z1 = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
$pcz = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
$sscz = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
$mtz = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
$jsscz = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
$jssscz = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  
  $kuai3z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $bjlz = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $gdx5z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $jssmz = get_query_val('fn_smorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $lhcz = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $jslhcz = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $twk3z = get_query_val('fn_twk3order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $txffcz = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  
  $azxy10z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  $azxy5z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = {$_SESSION['roomid']} and (`addtime` between '{$time}' and '{$time2}')  and userid = '{$con['userid']}' and `status` > 0");
  
  
$y = $z - $l;
$y1 = $z1 - $l1;
$pcy = $pcz - $pcl;
$sscy = $sscz - $sscl;
$mty = $mtz - $mtl;
$jsscy = $jsscz - $jsscl;
$jssscy = $jssscz - $jssscl;
$txffcy = $txffcz - $txffcl;
  
  $azxy10y = $azxy10z - $azxy10l;
  $azxy5y = $azxy5z - $azxy5l;
  
  
  $kuai3y = $kuai3z - $kuai3l;
  $bjly = $bjlz - $bjll;
  $gdx5y = $gdx5z - $gdx5l;
  $jssmy = $jssmz - $jssml;
  $lhcy = $lhcz - $lhcl;
  $jslhcy = $jslhcz - $jslhcl;
  $twk3y = $twk3z - $twk3l;
  
$yk = $y + $y1 + $pcy + $sscy + $mty + $jsscy + $jssscy +$kuai3y +$bjly + $gdx5y + $jssmy + $lhcy + $jslhcy + $twk3y + $txffcy + $azxy10y + $azxy5y;
  
$yk = sprintf("%.2f", substr(sprintf("%.3f", $yk), 0, -2));
$allyk += $yk;
$liushui = $l + $l1 + $pcl + $sscl + $mtl + $jsscl + $jssscl + $kuai3l + $bjll + $gdx5l + $jssml + $lhcl + $jslhcl + $twk3l + $txffcl + $azxy10l + $azxy5l;
$allliu += $liushui;
$s = get_query_val('fn_upmark', 'sum(`money`)', "`roomid` = {$_SESSION['roomid']} and `jia` = 'false'and `userid` = '{$con['userid']}' and `type` = '上分' and `status` = '已处理' and (`time` between '{$time} 00:00:00' and '{$time2} 23:59:59')");
$alls += $s;
$arr['data'][] = array($con['id'], "<img src='{$con['headimg']}' style='width:30px;height:30px'> ", $con['username'], $con['money'], "$liushui", $yk, $s == "" ? '0.00' : $s, date('Y-m-d H:i:s', $con['statustime']));
$allmoney += $con['money'];
}
$arr['allmoney'] = sprintf("%.2f", substr(sprintf("%.3f", $allmoney), 0, -2));
$arr['allyk'] = sprintf("%.2f", substr(sprintf("%.3f", $allyk), 0, -2));
$arr['alls'] = $alls;
$arr['allliu'] = $allliu;
return $arr;
}
?>