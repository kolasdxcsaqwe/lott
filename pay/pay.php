<?php
/*参数生成*/
session_start();
include_once('../Public/config.php');
date_default_timezone_set('PRC');
$roomid = $_SESSION['roomid'];
$userid = $_SESSION['userid'];
$game = $_COOKIE['game'];
$headimg = $_SESSION['headimg'];
$username = $_SESSION['username'];
$status = '上分';
$money = $_POST['money'];  
$sdks = $_POST['sdk'];
   $sdkk = get_query_vals('fn_setting','*',array('roomid'=>$roomid));
   if($sdks == '1'){
   $sdk = $sdkk['zhisdk'];
   $fangshi = '支付宝';  
   }elseif($sdks == '2'){
   $sdk = $sdkk['weisdk'];
   $fangshi = '微信扫码'; 
   }elseif($sdks == '3'){
   $sdk = $sdkk['qsdk'];
   $fangshi = 'QQ扫码'; 
   }
	$refer = 'http://'.$_SERVER['SERVER_NAME'].'/qr.php?room='.$roomid; //跳转地址
	$notify_url = 'http://'.$_SERVER['SERVER_NAME'].'/pay/paynotify.php';//回调通知
	$record = date("YmdHis") . mt_rand(10000,99999);  
    $sign = sign($money,$record,$sdk);
    $returndata['sdk'] = $sdk;
    $returndata['record'] = $record;
    $returndata['refer'] = $refer;
	$returndata['money'] = $money;
	$returndata['notify_url'] = $notify_url;
	$returndata['sign'] = $sign;
	echo jsonSuccess("ok",$returndata);
	//file_put_contents("log1.txt", json_encode($returndata));//测试打印POST值
	//插入数据
	$time = date('Y-m-d H:i:s');
    insert_query('fn_upmark',array("userid"=>$userid, 'headimg'=>$headimg, 'username'=>$username, 'type'=>$status, 'money'=>$money, 'time'=>$time, 'status'=>'未处理', 'game'=>$game, 'roomid'=>$roomid, 'jia'=>'false', 'orderid'=>$record,'czfangshi'=>$fangshi));


    //返回正确
    function jsonSuccess($message = '',$returndata = '') 
    {
        $return['msg']  = $message;
        $return['data'] = $returndata;
        $return['code'] = 1;
        return json_encode($return);
    }
    //加密签名
	function sign($money,$record,$sdk) {
    $sign = md5(number_format($money, 2, '.','') . trim($record) . $sdk);
    return $sign;
    }
?>