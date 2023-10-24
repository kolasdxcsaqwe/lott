<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
  <link rel="stylesheet" href="css/jquery-labelauty.css">
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-labelauty.js"></script>
    <title>官方充值</title>
</head>
<style type="text/css">
  .abody{
  background-color:#f0f0f0;
  
  }
  .bianju {
  margin-top: 20px;
  margin-right: 5px;
  margin-bottom: 30px;
  margin-left: 5px;
  }
  .kuangjia{
  background-color:#ffffff;
    border-radius:10px 10px 10px 10px;
    border:1px dashed #949494;margin-top:10px
  }
  .h2{
  margin-left: 20px;
    font-size:10px;
  }
  .botton{
    border: none;
        -webkit-border-radius: 13px 13px 13px 13px;
    color: #ffffff;
      background-color: #4fab16;
   margin-right: 20px;
  margin-bottom: 10px;
  margin-left: 20px;
  text-align:center;
    width:80%;height:40px;
  }
</style>  
  
<body class="abody">

<div class="bianju">  

  <img src="./images/paylogo.png" style="width:50%;height:auto;margin:0 auto;">
 
<form class="kuangjia" name="" method="post" action="./zpayapi.php">

  <div class="h2">
<h2>&nbsp&nbsp充值金额：</h2>
    </div>
    <ul class="dowebok">         
        <li><input type="radio" name="WIDtotal_fee"  value="20.00" data-labelauty="20元" checked=""></li>       
        <li><input type="radio" name="WIDtotal_fee" value="50.00" data-labelauty="50元"></li>         
        <li><input type="radio" name="WIDtotal_fee" value="100.00" data-labelauty="100元"></li>        
        <li><input type="radio" name="WIDtotal_fee" value="200.00" data-labelauty="200元"></li>               
        <li><input type="radio" name="WIDtotal_fee" value="500.00" data-labelauty="500元" ></li>  
        <li><input type="radio" name="WIDtotal_fee"  value="1000.00" data-labelauty="1000元"></li>        
        <li><input type="radio" name="WIDtotal_fee"  value="2000.00" data-labelauty="2000元"></li>       
        <li><input type="radio" name="WIDtotal_fee"  value="5000.00" data-labelauty="5000元"></li>								
    </ul>  
  <div class="h2">
  <h2>&nbsp&nbsp充值方式：</h2>
    </div>
  <ul class="dowebok"> 
        <li><input type="radio" name="type" value="alipay" data-labelauty="支付宝支付"></li>
         <!--li><input type="radio" name="type" value="3" data-labelauty="QQ支付"></li--> 
        <li><input type="radio" name="type" value="wxpay" checked="" data-labelauty="微信支付">   </li> <br>           
        <input type="submit" class="botton" value="立即充值">  
    </ul>
    </form>
  </div>
   
<!-- Jquery files -->
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/1.11.1/jquery.min.js"></script> <script type="text/javascript">
     var jQuery_1_11_1 = $.noConflict(true);
</script>
<script type="text/javascript">
$(function(){
	$(':input').labelauty();
});
</script> 


</body>
</html>