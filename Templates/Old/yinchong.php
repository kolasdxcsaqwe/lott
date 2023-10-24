<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$sql = get_query_vals('fn_room','*',"roomid = '$roomid'");
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


    <form method="post" action="./cpost.php">
      <br>
          <p style="font-size:35px;color:#A52A2A;">&nbsp;请核对好商户信息再进行银行转账！！</p><br>
      <p style="font-size:35px;">开户行：<input type="text" name="username" value="<?php echo $sql['yinhang'];?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
      <p style="font-size:35px;">户名：<input type="text" name="username" value="<?php echo $sql['huming'];?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
      <p style="font-size:35px;">卡号：<input type="text" name="username" value="<?php echo $sql['kahao'];?>" style="width:50%;height:80px;font-size:45px;margin-right:20px;" disabled></p><br>
  <p style="font-size:35px;">充值金额：<input type="text" name="money"onKeyUp="value=value.replace(/[^\d]/g,'')"style="width:50%;height:80px;font-size:45px;margin-right:20px;" placeholder="请输入充值金额"></p><br>


       <input type="submit"style="margin-left:20px;margin-right:20px;width:70%;height:85px;font-size:45px;" value="立即提现"/>
      <br><br><br>
    
    </form>  
    <br>
    <p style="font-size:35px;color:#A52A2A;">&nbsp;请先转账后在此提交充值请求！！</p><br>

  </div>
</body>
</html>
