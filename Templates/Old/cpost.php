<?php
/**
 * ---------------------参数生成页-------------------------------
 * 在您自己的服务器上生成新订单，并把计算好的订单信息传给您的前端网页。
 * 注意：
 * 1.key一定要在服务端计算，不要在网页中计算。
 * 2.token只能存放在服务端，不可以以任何形式存放在网页代码中（可逆加密也不行），也不可以通过url参数方式传入网页。
 * 3.接口跑通后，如果发现收款二维码是我们官方的，请检查APP是否正在运行。为保障您收款功能正常，如果您的收款手机APP掉线超过一分钟，就会触发代收款机制，详情请看网站帮助。
 *  接口修复定制开发 ： QQ1878336950
 * --------------------------------------------------------------
 */
    session_start();
	include_once("../../Public/config.php");
    
    $price = $_POST["money"];   
    $userid = $_SESSION['username'];  
    $headimg = $_SESSION['headimg'];  
    $goodsname = '上分';
    $game = $_SESSION['game'];  
    $orderuid = $_SESSION['userid'];    
    $roomid = $_SESSION['roomid'];  
    $orderid = StrOrderOne();   
    $jieguo = '未处理';
    $jia = 'false';
    $fangshi = '银行转账';
	$time = date('Y-m-d H:i:s');
    if($price){
    insert_query('fn_upmark',array('userid'=>$orderuid,'headimg'=>$headimg,'username'=>$userid,'type'=>$goodsname,'money'=>$price,'time'=>$time,'status'=>$jieguo,'game'=>$game,'roomid'=>$roomid,'jia'=>$jia,'orderid'=>$orderid,'czfangshi'=>$fangshi));
    echo "<script> alert('充值申请已提交，请联系客服转账后，客服为您上分，祝你玩的开心！');window.location.href='http://".$_SERVER['HTTP_HOST']."/qr.php?room=$roomid';</script>";
    }else{
    echo "<script> alert('充值出错，请重试！');window.location.href='http://".$_SERVER['HTTP_HOST']."/qr.php?room=$roomid';</script>";
    }
	function StrOrderOne(){
		date_default_timezone_set('Asia/Shanghai');
		/* 选择一个随机的方案 */
		mt_srand((double) microtime() * 1000000);
		return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
	}

?>