<?php
include_once('ngapi.php');
include_once ('../Public/config.php');
include_once ('../Public/sql.php');
$api=new ngapi();
$centermoney=$_POST['centermoney'];//中心余额
$zrusrname=$_POST['zrusrname'];//真人用户名
$zrmoney=$_POST['zrmoney'];//真人余额

$credit=$api->credit();
$credit=$credit['data']['sunbet'];//sunbet余额
var_dump($credit);

if($_POST['transtype'] == 0 && $_POST['money'] > 0 && $_POST['money']<$centermoney && $_POST['money']<=$credit){ //转入条件：1，输入金额大于0;二，中心余额大于转入金额,3，
    $res=$api->trans($zrusrname,$_POST['money'],time().rand(1000,9999));               //trans($username,$money,$client_transfer_id)
    $res=$res['message'];
  	if($res='成功'){
      $centermoney=$centermoney-$_POST['money'];
      update_query('fn_user', array('money' => $centermoney), array('id' => $_POST['uid']));
    }
  	echo "$res!<br>正在返回......";
	header("refresh:1;url=./index.php");
}elseif($_POST['transtype'] == 1 && $_POST['money'] > 0 && $zrmoney >= $_POST['money']){    //转出条件：1，输入金额大于0;2，
    $res=$api->trans($zrusrname,-$_POST['money'],time().rand(1000,9999));               //trans($username,$money,$client_transfer_id)
    $res=$res['message'];
    if($res='成功'){
      $centermoney=$centermoney+$_POST['money'];
      update_query('fn_user', array('money' => $centermoney), array('id' => $_POST['uid']));
    }
  	echo "$res!<br>正在返回......";
	header("refresh:1;url=./index.php");
}else{
    echo "<script>alert('输入不正确，请检查余额是否充足');</script>";
  	header("refresh:1;url=./index.php");
}

