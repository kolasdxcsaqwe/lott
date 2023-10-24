<?php
header("Content-Type: text/html;charset=utf-8");
include_once("../../Public/config.php");
$time = date('Y-m-d H:i:s');
$userid = $_POST['userid'];
$headimg = $_POST['headimg'];
$username = $_POST['username'];
$moneys = $_POST['money'];
$game = $_POST['game'];
$roomid = $_POST['roomid'];
$xiafen = '下分';
$status = '未处理';
$jia = 'false';
$orderid = '无';
$page = 'http://'.$_SERVER['HTTP_HOST'].'/Templates/Old/tixian.php';
$xianzhi = get_query_val('fn_setting','setting_tixian',array('roomid' => $roomid));
$userxian = get_query_vals('fn_user','*',array('roomid' => $roomid ,'userid' => $userid));
$userxian[] = $userxian;
$timee = date("Y-m-d");
$money = $userxian['money'];
$username = $userxian['username'];
$tixian = $userxian['tixian'];
$timeold = $userxian['timeold'];
$tixianxianzhi = $userxian['tixianxianzhi'];

  if($money < 0){
          echo  "<script> alert('余额不足');window.location = \"".$page."\"; </script>";
    }else if($money == 0){
          echo  "<script> alert('您的余额为零，不能提现') ;window.location = \"".$page."\";</script>";
    }else if($moneys > $money){
          echo "<script> alert('提现金额大于账户余额，请重新输入！') ;window.location = \"".$page."\";</script>";
    }else if($moneys == 0){
          echo "<script> alert('您输入了0元，请重新输入') ;window.location = \"".$page."\";</script>";
    }elseif($timee > $timeold){
          $tixianxianzhi1 = 0;
          update_query("fn_user", array("tixianxianzhi" => $tixianxianzhi1 ,"timeold" => $timee), array('roomid' => $roomid ,'userid' => $userid));
          echo "<script>alert('已刷新提现次数，有{$xianzhi}次提现机会。刚才提现不成功，请再次提现。');window.location.href='$page';</script>";
    }else if($timee == $timeold  && ($tixianxianzhi< $xianzhi)){
          $tixianxianzhi2 = $tixianxianzhi+1; 
          $qian = ($money - $moneys);
          $xianzhi1 = $xianzhi-$tixianxianzhi2;
          update_query("fn_user", array("tixianxianzhi" => $tixianxianzhi2 , "timeold" => $timee, "money" => $qian), array('roomid' => $roomid ,'userid' => $userid));
          insert_query('fn_upmark', array("userid" => $userid ,'headimg' => $headimg,'username'=> $username ,'type'=>$xiafen,'money'=>$moneys,'time'=>$time,'status'=>$status,'game'=>$game,'roomid'=>$roomid,'jia'=>$jia,'orderid'=>$orderid,'tixian'=>$tixian));  
          echo "<script> alert('已提现:{$moneys}元，剩余提现次数{$xianzhi1}次，十分钟内到账');window.location='$page'; </script>";  
    }else{
          echo "<script>alert('你的提现次数已用完，每天限制{$xianzhi}次提现,请过了凌晨12点后再提交！');window.location.href='$page';</script>";
    }
  


    

?>