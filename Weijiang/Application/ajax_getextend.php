<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$type = $_GET['t'];
if($type == 'get'){
    $id = $_GET['id'];
    $time = $_GET['time'];
    if(empty($time)){
    $time[0] = date("Y-m-d")." 00:00:00";
    $time[1] = date("Y-m-d")." 23:59:59";  
    }else{
    $time = explode(' - ', $time);
    }
    $userid = get_query_val('fn_user', 'userid', array('id' => $id));
    $allmoney = 0;
    $allliu = 0;
    $allyk = 0;
    $alls = 0;
    $allx = 0;
    select_query("fn_user", '*', "roomid = {$_SESSION['agent_room']} and jia='false' and isagent='false' and agent = '{$userid}'");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
        $l = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
		$l1 = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
        $pcl = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
        $sscl = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
        $mtl = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
        $jsscl = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
        $jssscl = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
      
        $kuai3l = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
      $bjll = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
      $gd11x5l = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
      $jssml = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
      $lhcl = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
      $jslhcl = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");
      $twk3l = (int)get_query_val('fn_twk3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)");      
      $txffcl = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)"); 
      $azxy10l = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)"); 
      $azxy5l = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and (`status` > 0 or `status` < 0)"); 
      
        $z = get_query_val('fn_order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
		$z1 = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
        $pcz = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
        $sscz = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
        $mtz = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
        $jsscz = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
        $jssscz = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
      
       $kuai3z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
       $bjlz = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
       $gd11x5z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
       $jssmz = get_query_val('fn_smorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
       $lhcz = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
       $jslhcz = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
      $twk3z = get_query_val('fn_twk3order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
      $txffcz = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
      
      $azxy10z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
      $azxy5z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`addtime` between '{$time[0]}' and '{$time[1]}') and `status` > 0");
      
      
        $y = $z - $l;
		$y1 = $z1 - $l1;
        $pcy = $pcz - $pcl;
        $sscy = $sscz - $sscl;
        $mty = $mtz - $mtl;
        $jsscy = $jsscz - $jsscl;
        $jssscy = $jssscz - $jssscl;
      
        $kuai3y = $kuai3z - $kuai3l;
        $bjly = $bjlz - $bjll;
        $gd11x5y =  $gd11x5z - $gd11x5l; 
        $jssmy = $jssmz - $jssml;
        $lhcy = $lhcz - $lhcl;
        $jslhcy = $jslhcz - $jslhcl; 
        $twk3y = $twk3z - $twk3l;   
        $txffcy = $txffcz - $txffcl;
      
      $azxy10y = $azxy10z - $azxy10l;
      $azxy5y = $azxy5z - $azxy5l;
          
        $yk = $y + $y1 + $pcy + $sscy + $mty + $jsscy + $jssscy + $kuai3y + $bjly + $gd11x5y + $jssmy + $lhcy + $jslhcy + $twk3y + $txffcy + $azxy10y + $azxy5y;
        $yk = sprintf("%.2f", substr(sprintf("%.3f", $yk), 0, -2));
        $allyk += $yk;
        $liushui = $l + $l1 + $pcl + $sscl + $mtl + $jsscl + $jssscl + $kuai3l + $bjll + $gd11x5l + $jssml + $lhcl + $jslhcl + $twk3l + $txffcl + $azxy5l + $azxy10l;
        $allliu += $liushui;
        $s = get_query_val('fn_upmark', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}'  and jia='false' and `type` = '上分' and `status` = '已处理'");
        $alls += $s;
        $x = get_query_val('fn_upmark', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}'  and jia='false' and `type` = '下分' and `status` = '已处理'");
        $allx += $x;
        $arr['data'][] = array($con['id'], "<img src='{$con['headimg']}' height='30' width='30'> " . $con['username'], $con['money'], "$liushui", $yk, $s, $x, date('Y-m-d H:i:s', $con['statustime']));
        $allmoney += $con['money'];
    }
    if(count($cons) == 0){
        $arr['data'][0] = 'null';
    }
    $arr['allmoney'] = sprintf("%.2f", substr(sprintf("%.3f", $allmoney), 0, -2));
    $arr['allyk'] = sprintf("%.2f", substr(sprintf("%.3f", $allyk), 0, -2));
    $arr['alls'] = $alls;
    $arr['allx'] = $allx;
    $arr['allliu'] = $allliu;
    echo json_encode($arr);
    exit();
}elseif($type == 'giveone'){
    $id = $_POST['id'];
    $num = $_POST['num'];
    $mode = $_POST['mode'];
    $time = $_POST['time'] == '' ? '总报表账目' : $_POST['time'];
    $num = $num / 100;
    $userid = get_query_val('fn_user', 'userid', array('id' => $id));
    if($_POST['time'] != ""){
        $a = explode(' - ', $_POST['time']);
        $ordersql = " and (`addtime` between '{$a[0]}' and '$a[1]')";
        $marksql = " and (`time` between '{$a[0]}' and '$a[1]')";
    }else{
        $ordersql = '';
        $marksql = '';
    }
    select_query("fn_user", '*', "roomid = {$_SESSION['agent_room']} and jia='false' and agent = '{$userid}'");
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
        switch($mode){
        case 'liushui': 
            $l = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
		    $l1 = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $pcl = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $sscl = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $mtl = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jsscl = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jssscl = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
            $kuai3l = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $bjll = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $gdx5l = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jssml = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $lhcl = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jslhcl = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $twk3l = (int)get_query_val('fn_twk3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $txffcl = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
            $azxy10l = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $azxy5l = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
            
            $liushui = $l + $l1 + $pcl + $sscl + $mtl + $jsscl + $jssscl + $kuai3l + $bjll + $gdx5l + $jssml + $lhcl + $jslhcl + $twk3l + $txffcl + $azxy10l + $azxy5l;
            $money = $liushui * $num;
            用户_上分($userid, $money, $_SESSION['agent_room'], $time);
           // echo json_encode(array("success" => true, "msg" => "分红完毕,获得" . $money . '元', 'money' => getmoney($userid)));
            break;
        case "yingli": 
            $l = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
		    $l1 = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $pcl = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $sscl = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $mtl = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jsscl = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jssscl = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
           
            $kuai3l = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $bjll = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $gdx5l = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jssml = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $lhcl = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jslhcl = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $twk3l = (int)get_query_val('fn_twk3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $txffcl = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
             $azxy10l = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
             $azxy5l = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
            $z = get_query_val('fn_order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $z1 = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $pcz = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $sscz = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $mtz = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $jsscz = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $jssscz = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       
       $kuai3z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $bjlz = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $gd11x5z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $jssmz = get_query_val('fn_smorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $lhcz = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $jslhcz = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $twk3z = get_query_val('fn_twk3order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $txffcz = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            
            $azxy10z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql); 
            $azxy5z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql); 
            
            $yk = $z - $l;
			$yk += $z1 - $l1;
            $yk += $pcz - $pcl;
            $yk += $sscz - $sscl;
            $yk += $mtz - $mtl;
            $yk += $jsscz - $jsscl;
            $yk += $jssscz - $jssscl;
            
            $yk += $azxy10z - $azxy10l;
            $yk += $azxy5z - $azxy5l;
            
            $yk += $kuai3z - $kuai3l;
            $yk += $bjlz - $bjll;
            $yk += $gd11x5z - $gd11x5l;
            $yk += $jssmz - $jssml;
            $yk += $lhcz - $lhcl;
            $yk += $jslhcz - $jslhcl;
            $yk += $twk3z - $twk3l;
            $yk += $txffcz - $txffcl;
            if($yk > 0){
                $money = $yk * $num;
                用户_上分($userid, $money, $_SESSION['agent_room'], $time);
             //   echo json_encode(array("success" => true, "msg" => "分红完毕,获得" . $money . '元', 'money' => getmoney($userid)));
            }else{
             //   echo json_encode(array("success" => true, "msg" => "该团队并无盈利", "money" => getmoney($userid)));
            }
            break;
        case "kuisun": 
            $l = (int)get_query_val('fn_order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
		    $l1 = (int)get_query_val('fn_flyorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $pcl = (int)get_query_val('fn_pcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $sscl = (int)get_query_val('fn_sscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $mtl = (int)get_query_val('fn_mtorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jsscl = (int)get_query_val('fn_jsscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jssscl = (int)get_query_val('fn_jssscorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
            $kuai3l = (int)get_query_val('fn_k3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $bjll = (int)get_query_val('fn_bjlorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $gdx5l = (int)get_query_val('fn_11x5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jssml = (int)get_query_val('fn_smorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $lhcl = (int)get_query_val('fn_lhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $jslhcl = (int)get_query_val('fn_jslhcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $twk3l = (int)get_query_val('fn_twk3order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            $txffcl = (int)get_query_val('fn_ffcorder', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
             $azxy10l = (int)get_query_val('fn_azxy10order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
             $azxy5l = (int)get_query_val('fn_azxy5order', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and (`status` > 0 or `status` < 0)" . $ordersql);
            
            
            $z = get_query_val('fn_order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
			$z1 = get_query_val('fn_flyorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql); 
            $pcz = get_query_val('fn_pcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $sscz = get_query_val('fn_sscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $mtz = get_query_val('fn_mtorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $jsscz = get_query_val('fn_jsscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $jssscz = get_query_val('fn_jssscorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            
       $kuai3z = get_query_val('fn_k3order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $bjlz = get_query_val('fn_bjlorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $gd11x5z = get_query_val('fn_11x5order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $jssmz = get_query_val('fn_smorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $lhcz = get_query_val('fn_lhcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
       $jslhcz = get_query_val('fn_jslhcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $twk3z = get_query_val('fn_twk3order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
      $txffcz = get_query_val('fn_ffcorder', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);   
            $azxy10z = get_query_val('fn_azxy10order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            $azxy5z = get_query_val('fn_azxy5order', 'sum(`status`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` > 0" . $ordersql);
            
            $yk = $z - $l;
			$yk += $z1 - $l1; 
            $yk += $pcz - $pcl;
            $yk += $sscz - $sscl;
            $yk += $mtz - $mtl;
            $yk += $jsscz - $jsscl;
            $yk += $jssscz - $jssscl;
            
            $yk += $kuai3z - $kuai3l;
            $yk += $bjlz - $bjll;
            $yk += $gd11x5z - $gd11x5l;
            $yk += $jssmz - $jssml;
            $yk += $lhcz - $lhcl;
            $yk += $jslhcz - $jslhcl;
            $yk += $twk3z - $twk3l;
            $yk += $txffcz - $txffcl;
            
            $yk += $azxy10z - $azxy10l;
            $yk += $azxy5z - $azxy5l;
            
            if($yk < 0){
                $money = $yk * $num;
                用户_上分($userid, $money, $_SESSION['agent_room'], $time);
               // echo json_encode(array("success" => true, "msg" => "分红完毕,获得" . $money . '元', 'money' => getmoney($userid)));
            }else{
               // echo json_encode(array("success" => true, "msg" => "该团队并无亏损"));
            }
            break;
        case "chongzhi": $s = get_query_val('fn_upmark', 'sum(`money`)', "roomid = {$_SESSION['agent_room']} and userid = '{$con['userid']}' and `status` = '已处理'" . $marksql);
            $money = $s * $num;
            用户_上分($userid, $money, $_SESSION['agent_room'], $time);
           // echo json_encode(array("success" => true, "msg" => "分红完毕,获得" . $money . '元', 'money' => getmoney($userid)));
            break;
        }

    }
        echo json_encode(array("success" => true, "msg" => "分红完毕"));
}elseif($type == 'add'){
    $id = $_GET['id'];
    update_query("fn_user", array("isagent" => "true"), array("id" => $id));
    echo json_encode(array("success" => true));
  exit;
}elseif($type == 'delxia'){
    $id = $_GET['id'];
    update_query("fn_user", array("isagent" => "false"), array("id" => $id));
    echo json_encode(array("success" => true));
  exit;
}elseif($type == 'addxia'){
    $id = $_GET['id'];
    $agent = $_GET['agent'];
    if(get_query_val("fn_user", "agent", array("id" => $id)) != 'null'){
        echo json_encode(array('success' => false, 'msg' => '该玩家已经拥有下线,无法手动为该玩家添加下线..'));
        exit;
    }else{
        $userid = get_query_val('fn_user', 'userid', array('id' => $agent));
        update_query("fn_user", array("agent" => $userid), array('id' => $id));
        echo json_encode(array("success" => true));
        exit;
    }
}elseif($type == 'removexia'){
    $id = $_GET['id'];
    update_query("fn_user", array("agent" => "null"), array("id" => $id));
    echo json_encode(array("success" => true));
    exit;
}
function 用户_上分($Userid, $Money, $room, $time){
    update_query('fn_user', array('money' => '+=' . $Money), array('userid' => $Userid, 'roomid' => $room));
    insert_query("fn_marklog", array("roomid" => $room, 'userid' => $Userid, 'type' => '上分', 'content' => $time . '推广分红', 'money' => $Money, 'addtime' => 'now()'));
}
function getmoney($userid){
    return get_query_val('fn_user', 'money', array('roomid' => $_SESSION['agent_room'], 'userid' => $userid));
}
?>