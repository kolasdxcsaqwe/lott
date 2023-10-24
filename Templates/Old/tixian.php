<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$game = $_COOKIE['game'];
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
$roomid = $_SESSION['roomid'];
$headimg = $_SESSION['headimg'];
$sql = get_query_vals('fn_user','*',"userid = '$userid' and roomid = '$roomid'");
//  if((int)$sql['money'] < 10 && $sql['tixian'] == ''){
//  echo"<script>alert('首次提现余额小于10，无法提现。');window.location.href='/Templates/Old/Bet.php';</script>";
//  }
//  elseif($sql['tixian'] == ''){
//       echo"<script>alert('请先上传微信/支付宝收款二维码');window.location.href='http://".$_SERVER['HTTP_HOST']."/Templates/Old/shangchuan.php?userid=$userid&roomid=$roomid';</script>";
//       }

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


    <form method="post" action="./add.php">
  <p style="font-size:35px;margin-left:3%;">微信昵称：<input type="text" name="username" value="<?php echo "$username";?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
  <!--<p style="font-size:35px;margin-left:3%;">提现金额：<input type="text" name="money" id="money1" onblur="value_to()" onKeyUp="value=value.replace(/[^\d]/g,'')"style="width:50%;height:80px;font-size:45px;margin-right:20px;" placeholder="请输入提现金额"></p>-->
  <br>
                         <input name='game'  type='text' value="<?php echo "$game";?>" style='display:none;'/>                         
                         <input name='userid'  type='text' value="<?php echo "$userid";?>" style='display:none;'/>
                         <input name='roomid' type='text' value="<?php echo "$roomid";?>" style='display:none;'/>
                         <input name='headimg' type='text' value="<?php echo "$headimg";?>" style='display:none;'/> 
                         <input name='tixian' type='text' value="<?php echo "$tixian";?>" style='display:none;'/> 
       <!--<input type="submit" id="demoBtn2" style="margin-left:2%;margin-right:20px;width:70%;height:85px;font-size:45px;" value="提现到微信或支付宝"/>-->
      <br><br><br>
      <a href ="./yinhang.php" style="width:70%;height:60px;font-size:45px;margin-left:3%;"><img src="./images/yinhang.png"></a><br><br>
     <!--<?php echo "<p style='font-size:35px;color: #9e9e9e; margin-left:15%;'>您的收款二维码是：<br><br><img src='".$sql['tixian']."' style='width:50%;height:auto;'><br><br>如需更改，请联系客服</p>"; ?>                     -->
    </form>  
    
    
    
    <!--<br>-->
    <!--<p style="font-size:35px;color:#A52A2A;margin-left:2%;">注意：第一次提现，请先上传您的收款二维码，<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 财务只认此二维码。</p><br>-->
    <!--<p style='font-size:35px;margin-left:2%;'>1·提现是通过您微信二维码收款，方便快捷。</p><br>-->
    <!--<p style='font-size:35px;margin-left:2%;'>2·每次提现，十分钟内到账。</p><br>-->
    <!--<p style='font-size:35px;margin-left:2%;'>3·任何疑问可咨询【客服】或者【财务】。</p>-->
  </div>
  <script type="text/javascript">
    function value_to(){
    var x = document.getElementById("money1").value;
   if (x<10 || ''){
     alert ("金额不小于10或无输入");
     $("#demoBtn2").attr("disabled","disabled");
   }else{
      document.getElementById("money1").value = x;
     $("#demoBtn2").removeAttr("disabled");
   }
 }
  </script>
</body>
</html>
