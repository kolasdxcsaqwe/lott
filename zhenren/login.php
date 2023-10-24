<?php
include_once('ngapi.php');
include_once ('../Public/config.php');
//从session获得用户ID并填充8至8位数
session_start();
$_SESSION['uid']=get_query_val("fn_user", "id", array("roomid" => $_SESSION['roomid'], 'userid' => $_SESSION['userid']));
$zrusrname=str_pad($_SESSION['uid'],8,8,STR_PAD_LEFT );
//实例化并登录游戏
$api = new ngapi;
$res = $api->login($zrusrname,1);
header("location:".$res['data']);