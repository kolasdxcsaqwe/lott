<?php
echo "<span style='color:red;'>采集结算</span><br>"; 
$load = 5;
header("Content-type:text/html;charset=utf-8");
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
include_once "./Public/config.php";
require "jiesuan.php";
if($_GET['t'] == 'test'){
    SSC_jiesuan();
    exit;
}
$url = "http://fl.yodo8.cn/abcaiji/jiesuan.php"; //采集接口请咨询 QQ1878336950
$json = file_get_contents($url);
$jsondata = json_decode($json);
//$typearr['bjpk10'] = 1;
//$typearr['mlaft'] = 2;
//$typearr['cqssc'] = 3;
//$typearr['bjkl8'] = 4;
//$typearr['cakeno'] = 5;
//$typearr['jsmt'] = 6;
//$typearr['jssc'] = 7;
//$typearr['jsssc'] = 8;
//$typearr['jsk3'] = 9;
$jsondata = $jsondata -> data;
foreach($jsondata as $i){
    $code = $i -> code;
    $jump = false;
    switch($code){
    case 'cqklsf':$jump = true;
    case "fc3d":$jump = true;
    case "gd11x5":$jump = true;
    case "gdklsf":$jump = true;
    case "pl3":$jump = true;
    case "shssl":$jump = true;
    case "tjssc":$jump = true;
    case "xjssc":$jump = true;
    case "jsk3":$jump = true;
    case "gxk3":$jump = true;
    case "baccarat":$jump = true;
    case  "cakeno":$jump = true;
    case  "jsssc":$jump = true; 
    case  "jssc":$jump = true;       
    case  "bjkl8":$jump = true;   
    case  "marksix":$jump = true;  
    case 'bjpk10':$jump = true;
    case 'jsmt':$jump = true;
     case 'cqssc':$jump = true;  
         case 'mlaft':$jump = true;  
    }
    if($jump){
    continue;
}
$opencode = $i -> open_result;
$qihao = $i -> open_phase;
$opentime = $i -> load_time;
$openindex = $i -> open_index;
$next_term = $i -> next_phase;
$nexttime = $i -> next_time;
$typeid = $typearr[$code];
$topcode = db_query("select term from fn_open where `type` = '$typeid' order by `term` desc limit 1");
$topcode = db_fetch_array($topcode);
if($code == 'cakeno'){
    $next_term = (int)$qihao + 1;
    $yy = explode(" ", $opentime);
    $yy = $yy[0];
    $tt = date('H:i:s', strtotime($opentime));
    $tt2 = explode(":", $tt);
    $ss = (int)$tt2[2];
    if($ss != 0 || $ss != 30){
        if($ss < 30){
            $ss2 = '00';
            $sstime = $yy . " " . str_replace($ss, $ss2 , $tt);
            $nexttime = date('Y-m-d H:i:s', strtotime("$sstime +3 minute +30 seconds"));
        }elseif($ss > 30){
            $ss2 = '30';
            $sstime = $yy . " " . str_replace($ss, $ss2 , $tt);
            $nexttime = date('Y-m-d H:i:s', strtotime("$sstime +3 minute +30 seconds"));
        }
    }
}

if(($topcode[0] != $qihao) && ($qihao != '') && ($qihao != '0')){
    insert_query('fn_open', array('term' => $qihao, 'code' => $opencode, 'time' => $opentime, 'type' => $typeid, 'next_term' => $next_term, 'next_time' => $nexttime));
//    if($code == 'bjkl8' || $code == 'cakeno'){
//        PC_jiesuan();
//    }
//    if($code == 'jsmt'){
//        MT_jiesuan();
//    }
 //   if($code == 'cqssc'){
 //       SSC_jiesuan();
//    }
//    if($code == 'jsssc'){
//        JSSSC_jiesuan();
//    }
//    if($code == 'jssc'){
//        JSSC_jiesuan();
//    }
//    if($code == 'bjpk10'){
//        PK10_jiesuan();
//    }
//    if($code == 'mlaft'){
//       MLAFT_jiesuan();
//    }
//	if($code == 'jsk3'){
//        K3_jiesuan();
//    }
//    kaichat($code, $next_term);
    echo "更新 $code 成功！<br>";
}else{
    echo "等待 $code 刷新<br>";
}
}



echo "系统当前时间戳为 ";
echo ":";
echo time();
//<!--JS 页面自动刷新 -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',5000);");      
echo ("</script>");
?>