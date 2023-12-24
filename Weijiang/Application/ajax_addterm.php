<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/abcaiji/jiesuan.php");

//include(dirname(dirname(dirname(__FILE__))).'/Public/config.php');

$feng_time = $_POST['fengtime'];
$qihao = $_POST['addterm'];
$code = $_POST['addcode'];
$kaitime = $_POST['next_time'];
$opentime = strtotime($kaitime);
$roomid = isset($_POST['roomid'])?$_POST['roomid']:0;
$type = $_POST['game'];
$jietime = $opentime - time();
//判断预设号码长度是否准确
$changdu = count(explode(",",$code));
if($type == '1' && $changdu != 10){
    echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
    exit;
}
if($type == '2' && $changdu != 10){
    echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
    exit;
}
if($type == '3' && $changdu != 5){
    echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
    exit;
}
if($type == '6' && $changdu != 10){
    echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
    exit;
}
// if($jietime>15 && $feng_time=='已封盘'){
//     $jietime1 = $jietime-15;
//     echo json_encode(array('status'=>false,'msg' => '请在【'.$jietime1.'】秒后提交'));
//     exit;
// }
// elseif($jietime>15 && $feng_time=='未封盘'){
//     echo json_encode(array('status'=>false,'msg' => '还未封盘，请封盘后在提交'));
//     exit;
// }
if($game == 'cqssc' && $open_term == '120'){
    $open_term1 = substr($qihao, 0, 8);
    $next_term = ($open_term1+1).'001';
}elseif($game == 'xyft' && $open_term == '180'){
    $open_term1 = substr($qihao, 0, 8);
    $next_term = ($open_term1+1).'001';
}else{
    $next_term = $qihao + 1;
}

if($type == '4'){
    if($changdu != 3)
    {
           echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
            exit; 
    }
    else
    {
          //新加坡28
        $code=fadeGenXY28($code);
    }
}

if($type == '20'){
    if($changdu != 4)
    {
        echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
        exit;
    }
}

if($type == '21'){
    if($changdu != 3)
    {
        echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
        exit;
    }
}

if($type == '22'){
    if($changdu != 5)
    {
        echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
        exit;
    }
}

if($type == '19'){
    if($changdu != 3)
    {
        echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
        exit;
    }
    else
    {
        //纽约28
        $code=fadeGenXY28($code);
    }
}


if($type == '5'){
     if($changdu != 3)
    {
           echo json_encode(array('status'=>false,'msg' => '预设号码有误，注意格式！'));
            exit; 
    }
    else
    {
    //加拿大28
    $code=fadeGenJND28($code);
    }
}


//视频需要多一条数据源，从房间号判断该房间游戏的视频开奖号
//判断游戏种类，和下期开奖时间加多少。
switch($type){
    case '1':
        $game = 'bjpk10';
        $times = pk10time($opentime);
        break;
    case '2':
        $game = 'mlaft';
        $times = xyfttime($opentime);
        break;
    case '3':
        $game = 'cqssc';
        $times = cqssctime($opentime);
        break;
    case '4':
        $game = 'xy28';
        $times = 150;
        break;
    case '5':
        $game = 'jnd28';
        $times = 210;
        break;
    case '6':
        $game = 'jsmt';
        $times = 5*60;
        break;
    case '7':
        $game = 'jssc';
        $times = 5*60;
        break;
    case '8':
        $game = 'jsssc';
        $times = 5*60;
        break;
    case '9':
        $game = 'jsk3';
        $times = 5*60;
        break;
}
$topcode = get_query_val('fn_open','term',"`type`= $type order by `term` desc limit 1");
if ($roomid!=0){
    $topcode1 = get_query_val('fn_buqi','term',"`type`= $type and `roomid` = $roomid order by `term` desc limit 1");
    if($topcode1 == $qihao){
        echo json_encode(array('status'=>false,'msg' => '已提交过，无需再提交'));
        exit;
    }
}
$opentime = $opentime + $times;
$next_time = date('Y-m-d H:i:s',$opentime);
if($topcode != $qihao){
    insert_query('fn_buqi', array('game'=>$game,'term' => $qihao, 'code' => $code, 'opentime' => $kaitime, 'type' => $type, 'next_term' => $next_term, 'next_time' => $next_time, 'roomid' => $roomid));
    if($game == 'bjpk10'){
        PK10_jiesuan($roomid);
    }
    if($game == 'mlaft'){
        MLAFT_jiesuan($roomid);
    }
    if($game == 'cqssc'){
        SSC_jiesuan($roomid);
    }
    if($game == 'xy28'){
        PC_jiesuan($roomid);
    }
    if($game == 'cakeno'){
        PC_jiesuan($roomid);
    }
    if($game == 'jnd28'){
        PC_jiesuan($roomid);
    }
    if($game == 'jsmt'){
        MT_jiesuan($roomid);
    }
    if($game == 'jssc'){
        JSSC_jiesuan($roomid);
    }
    if($game == 'jsssc'){
        JSSSC_jiesuan($roomid);
    }
    if($game == 'jsk3'){
        K3_jiesuan($roomid);
    }
    // kaichat($game,$next_term,$roomid);
    ob_end_clean();
    echo json_encode(array('status'=>true,'msg' => '开奖成功'));
}else{
    echo json_encode(array('status'=>false,'msg' => '已开奖，无法再次开奖'));
}




function pk10time($next_time){
    $fengtime = strtotime(date('Y-m-d',$next_time).' 09:06'.':00');
    $fengtime1 = strtotime(date('Y-m-d',$next_time).' 23:51'.':00');
    if((time() >= $fengtime) && (time() <= $fengtime1)){
        return $times = 5*60;
    }else{
        return $times = 32983;
    }
}

function cqssctime($next_time){
    $fengtime1 = strtotime(date('Y-m-d',$next_time).' 10:00'.':00');
    $fengtime2 = strtotime(date('Y-m-d',$next_time).' 23:59'.':59');
    $fengtime3 = strtotime(date('Y-m-d',$next_time).' 00:00'.':00');
    $fengtime4 = strtotime(date('Y-m-d',$next_time).' 01:54'.':00');
    if(((time() >= $fengtime1) && (time() <= $fengtime2)) || ((time() >= $fengtime3) && (time() <= $fengtime4))){
        return $times = shijian();
    }else{
        return $times = 29050;
    }

}


function fadeGenXY28($code)
{
  //28系列 数据转换 造假数据
  $intArray=explode(",",$code);
  $strFadeCode="";

  $pos=0;
  $strFadeCode=$strFadeCode.$intArray[$pos++].",";

  for ($i=0; $i < 20; $i++) { 

    if($i+1==6)
    {
      $strFadeCode=$strFadeCode.$intArray[$pos++];
    }
    elseif ($i+1==12) {
      $strFadeCode=$strFadeCode.$intArray[$pos++];
    }
    else{
     $strFadeCode=$strFadeCode."10";
   }
   
   if($i!=19)
   {
    $strFadeCode=$strFadeCode.",";
  }
}


$fadeCodeArray=explode(",", $strFadeCode);

$number1 = (int)$fadeCodeArray[0] + (int)$fadeCodeArray[1] + (int)$fadeCodeArray[2] + (int)$fadeCodeArray[3] + (int)$fadeCodeArray[4] + (int)$fadeCodeArray[5];
$number2 = (int)$fadeCodeArray[6] + (int)$fadeCodeArray[7] + (int)$fadeCodeArray[8] + (int)$fadeCodeArray[9] + (int)$fadeCodeArray[10] + (int)$fadeCodeArray[11];
$number3 = (int)$fadeCodeArray[12] + (int)$fadeCodeArray[13] + (int)$fadeCodeArray[14] + (int)$fadeCodeArray[15] + (int)$fadeCodeArray[16] + (int)$fadeCodeArray[17];


$number1 = substr($number1, -1);
$number2 = substr($number2, -1);
$number3 = substr($number3, -1);


return $strFadeCode;
}

function fadeGenJND28($code)
{
  //28系列 数据转换 造假数据
  $intArray=explode(",",$code);
  $strFadeCode="";

  $strFadeCode=$strFadeCode."10,";
  $strFadeCode=$strFadeCode.$intArray[0].",";
  $strFadeCode=$strFadeCode.$intArray[1].",";
  $strFadeCode=$strFadeCode.$intArray[2].",";

  for ($i=0; $i < 17; $i++) { 
    $strFadeCode=$strFadeCode."10";
    if($i!=16)
    {
      $strFadeCode=$strFadeCode.",";
    }
  }

  $fadeCodeArray=explode(",", $strFadeCode);

  $number1 = (int)$fadeCodeArray[1] + (int)$fadeCodeArray[4] + (int)$fadeCodeArray[7] + (int)$fadeCodeArray[10] + (int)$fadeCodeArray[13] + (int)$fadeCodeArray[16];
  $number2 = (int)$fadeCodeArray[2] + (int)$fadeCodeArray[5] + (int)$fadeCodeArray[8] + (int)$fadeCodeArray[11] + (int)$fadeCodeArray[14] + (int)$fadeCodeArray[17];
  $number3 = (int)$fadeCodeArray[3] + (int)$fadeCodeArray[6] + (int)$fadeCodeArray[9] + (int)$fadeCodeArray[12] + (int)$fadeCodeArray[15] + (int)$fadeCodeArray[18];

  $number1 = substr($number1, -1);
  $number2 = substr($number2, -1);
  $number3 = substr($number3, -1);

  return $strFadeCode;
}


function shijian(){
    $kongzhi = date('Y-m-d', time());
    $time = time();
    $time1 = strtotime($kongzhi . "22:00" . ":00");
    $time2 = strtotime($kongzhi . "02:00" . ":00");
    $time3 = strtotime($kongzhi . "23:59" . ":59");
    $time4 = strtotime($kongzhi . "00:00" . ":00");
    if($time >= $time1 && $time <= $time3){
        $kaitime = 5*60;
        return $kaitime;
    }elseif($time >= $time4 && $time <= $time2){
        $kaitime = 5*60+5;
        return $kaitime;
    }else{
        $kaitime = 10*60;
        return $kaitime;
    }
}

function xyfttime($next_time){
    $fengtime1 = strtotime(date('Y-m-d',$next_time).' 13:08'.':00');
    $fengtime2 = strtotime(date('Y-m-d',$next_time).' 23:59'.':59');
    $fengtime3 = strtotime(date('Y-m-d',$next_time).' 00:00'.':00');
    $fengtime4 = strtotime(date('Y-m-d',$next_time).' 04:03'.':00');
    if(((time() >= $fengtime1) && (time() <= $fengtime2)) || ((time() >= $fengtime3) && (time() <= $fengtime4))){
        return $times = 5*60;
    }else{
        return $times = 32700;
    }
}



?>