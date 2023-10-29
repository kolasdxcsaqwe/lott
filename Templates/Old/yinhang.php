<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$game = $_COOKIE['game'];
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$roomid = $_SESSION['roomid'];
$headimg = $_SESSION['headimg'];
$sql = get_query_vals('fn_user','*',"userid = '$userid' and roomid = '$roomid'");
 if((int)$sql['money'] < 10 && $sql['tixian'] == ''){
 echo"<script>alert('首次提现余额小于10，无法提现。');window.location.href='/Templates/Old/Bet.php';</script>";
 }elseif($sql['kahao'] == ''){
      echo"<script>alert('请先完善收款银行信息');window.location.href='http://".$_SERVER['HTTP_HOST']."/Templates/Old/gaiyh.php?userid=$userid&roomid=$roomid';</script>";
      }

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<link rel="stylesheet" type="text/css" href="/Style/Old/css/bootstrap.min.css" />
<script src="/Style/Old/js/jquery.min.js"></script>
<script src="/Style/Old/lib/table/bootstrap-table.js"></script>
<script src="/Style/Old/lib/table/locale/bootstrap-table-zh-CN.js"></script>
<link rel="stylesheet" href="/Style/Old/lib/table/bootstrap-table.css" />

</head>
<style>
body {
	font-family: Arial, Helvetica, sans-serif;
	background: #000 url(/Style/Xs/Public/images/bg.png);
	font-size: 24px;
	font-weight:bold;
}
  .p{
  font-size:45px;
  }
</style>
<body>
  <div>
    <br>


    <form id="formtijiao" method="post" action="./yinadd.php" style="margin-left:2%;">
      <p style="font-size:35px;">微信昵称：<input type="text" name="username" value="<?php echo "$username";?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
      <p style="font-size:35px;">提现银行：<input type="text" name="username" value="<?php echo $sql['yinhang'];?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
      <p style="font-size:35px;">开户姓名：<input type="text" name="username" value="<?php echo $sql['huming'];?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
      <p style="font-size:35px;">提现卡号：<input type="text" name="username" value="<?php echo $sql['kahao'];?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
      <p style="font-size:35px;">提现金额：<input type="text" name="money" id="money2" onblur="value_to()" onKeyUp="value=value.replace(/[^\d]/g,'')"style="width:50%;height:80px;font-size:45px;margin-right:20px;" placeholder="请输入提现金额"></p><br>
                         <input name='game'  type='text' value="<?php echo "$game";?>" style='display:none;'/>                         
                         <input name='userid'  type='text' value="<?php echo "$userid";?>" style='display:none;'/>
                         <input name='roomid' type='text' value="<?php echo "$roomid";?>" style='display:none;'/>
                         <input name='headimg' type='text' value="<?php echo "$headimg";?>" style='display:none;'/> 
                         <input name='tixian' type='text' value="<?php echo "$tixian";?>" style='display:none;'/> 
       <input type="button"  id="demoBtn2" style="margin-left:20px;margin-right:20px;width:70%;height:85px;font-size:45px;" value="立即提现"/>
      <br><br><br>  
    </form>  
    <br>
    <p style="font-size:35px;color:#A52A2A;">&nbsp;<a href="http://<? echo $_SERVER['HTTP_HOST'];?>/Templates/Old/gaiyh.php?userid=<? echo $userid;?>&roomid=<? echo $roomid;?>">点击这里更改银行信息</a></p><br>
  </div>
  <script type="text/javascript">

      $("#demoBtn2").click(function(){
          $("#demoBtn2").attr("disabled","disabled");
          $("#formtijiao").submit()
      })

    function value_to(){
    var x = document.getElementById("money2").value;
   if (x<2 || ''){
     alert ("金额不小于2或无输入");
     $("#demoBtn2").attr("disabled","disabled");
   }else{
      document.getElementById("money2").value = x;
     $("#demoBtn2").removeAttr("disabled");
   }
 }
  </script>
</body>
</html>
