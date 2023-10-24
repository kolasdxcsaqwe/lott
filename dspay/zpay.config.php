<?php
/* *
 * 配置文件
 * 诺力支付
 * https://www.nlipay.com/
 */
//↓↓↓↓↓↓↓↓↓↓请在这里配置您的诺力支付商户信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
//商户ID

include_once('../Public/config.php');
session_start();

if(!empty($_SESSION['roomid'])){
  $roomid = $_SESSION['roomid'];
}elseif($_REQUEST){
  $arr1 = get_query_vals('fn_upmark','*',array('orderid'=> $_REQUEST['out_trade_no']));
  $roomid = $arr1['roomid'];
}
 $keys = get_query_vals('fn_setting','*',array('roomid'=>$roomid));
$alipay_config['partner']		= $keys['dsid'];

//商户KEY
$alipay_config['key']			= $keys['dskey'];


//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


//签名方式 不需修改
$alipay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'https';

//支付API地址
$alipay_config['apiurl']    = 'https://nlipay.com/';
?>