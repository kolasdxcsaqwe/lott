<?php
session_start();
include_once('../Public/config.php');
require_once("zpay.config.php");
require_once("lib/zpay_submit.class.php");
date_default_timezone_set('PRC');

$roomid = $_SESSION['roomid'];
$userid = $_SESSION['userid'];
$game = $_COOKIE['game'];
$headimg = $_SESSION['headimg'];
$username = $_SESSION['username'];
$status = '上分';
$money = $_POST['WIDtotal_fee'];
$out_trade_no = date('YmdHis').rand(111111,999999);
$type = $_POST['type'];
   if($type == 'alipay'){
   $fangshi = '支付宝';  
   }elseif($type == 'wxpay'){
   $fangshi = '微信扫码'; 
   }

$fenurl = get_query_val('fn_system','content1',array('id'=>'0'));
/**************************请求参数**************************/
        $notify_url = "http://".$fenurl."/dspay/notify_url.php";
        $return_url = "http://".$fenurl."/qr.php?room=".$roomid;
		$name = '在线充值';
        $sitename = 'G5支付';
/************************************************************/
	$time = date('Y-m-d H:i:s');
    insert_query('fn_upmark',array("userid"=>$userid, 'headimg'=>$headimg, 'username'=>$username, 'type'=>$status, 'money'=>$money, 'time'=>$time, 'status'=>'未处理', 'game'=>$game, 'roomid'=>$roomid, 'jia'=>'false', 'orderid'=>$out_trade_no,'czfangshi'=>$fangshi));
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"name"	=> $name,
		"money"	=> $money,
		"sitename"	=> $sitename
);

//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);

$html_text = $alipaySubmit->buildRequestForm($parameter);

echo $html_text;

?>
