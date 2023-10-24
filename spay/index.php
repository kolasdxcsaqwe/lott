<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
  <link rel="stylesheet" href="css/jquery-labelauty.css">
  <link rel="stylesheet" type="text/css" href="css/userPay.css">
    <link rel="stylesheet" type="text/css" href="css/new_cfb.css">
  
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
  
   margin-right: 20px;
  margin-bottom: 10px;
  margin-left: 20px;
  text-align:center;
    width:240px;height:40px;
  }
</style>  
  
<body class="abody">
<?php 
  session_start();
  	include_once("../Public/config.php");
$_SESSION['game'] = $_GET['g'];
$_SESSION['roomid'] = $_GET['roomid'];
$_SESSION['headimg'] = $_GET['img']; 
$_SESSION['username'] = $_GET['m'];
$_SESSION['userid'] = $_GET['id'];
$roomid = $_SESSION['roomid']; 
$sql = get_query_vals('fn_setting','*',array('roomid'=>$roomid));
  ?>
<div class="bianju">  

  <!--img src="./images/paylogo.png" style="width:50%;height:auto;margin:0 auto;"-->
 
  <div class="g-Total gray9">请先扫码付款再提交申请！</div>
  <section class="clearfix g-member">

    <form id="form3"  class="kuangjia">
      <article class="clearfix mt10 m-round g-pay-ment g-bank-ct">
        <li class="gray6" style="width: 100%;padding: 5px 0px 0px 0px;height: 40px;    text-align: center;">
          <span style="">选择充值方式：</span>
          <div class="col-sm-6" style="width:40%;display: inline-block;">
            <select name="rgfs" class="form-control type_choose">
              <option value="1">微信扫码</option>
              <option value="2">支付宝扫码</option>
            </select> </div></li>
        <li class="gray6" style="width: 100%;padding: 5px 0px 0px 0px;height: 200px;max-height: 200px;text-align: center;">
          <div class="wximg" style="display: block;">
            <img class="sk" src="<?php echo $sql['wechatpaycode'];?>">
          </div>
          <div class="zfbimg" style="display: none;">
            <img class="sk" src=" <?php echo $sql['alipaycode'];?>">
          </div>

        </li>
        </li>
        <li class="gray6" style="width: 100%;padding: 0px 0px 0px 10px;height: 35px;">
          为加快到帐速度，扫码付款时请留言备注：<span id="num2"style="font-size: 18px;color: #ff1212;"></span>
        </li><input style="display: none;"type="text" name="num" id="num"value="" >
        <li class="gray6" style="width: 100%;padding: 5px 0px 0px 10px;height: 40px;">输入充值金额：<label
                class="input" style="border: 1px solid #EAEAEA;height: 35px;font-size:30px;">
          <input id="chargemoney" type="text" name="money2"placeholder="如：1000"
                 style="width: 170px;color: red;font-size:20px;">
        </label> 元

        </li>
        <li class="gray6" style="width: 100%;padding: 5px 0px 0px 10px;height: 30px;">
          提醒:如发现恶意提交造成财务审核工作量增高，将做禁号处理！
          </section>

  <button id="demoBtn1" type="button"  class="orgBtn"style="">提交申请</button>
  
        <br>
          <button  type="button" onclick="window.location.href='/qr.php?room=<?php echo $_SESSION['roomid'];?>'" class="orgBtn"style="">返回大厅</button>
</form>  <br><br>
 

  </div>
    <form style='display:none;' id='formpay' name='formpay' method='post' action='./post.php'>    
        <input name='goodsname' id='goodsname' type='text' value='' />
        <input name='istype' id='istype' type='text' value='' />
        <input name='key' id='key' type='text' value=''/>
        <input name='notify_url' id='notify_url' type='text' value=''/>
        <input name='orderid' id='orderid' type='text' value=''/>    
        <input name='orderuid' id='orderuid' type='text' value=''/>
        <input name='price' id='price' type='text' value=''/>
        <input name='return_url' id='return_url' type='text' value=''/>
        <input name='uid' id='uid' type='text' value=''/>
        <input type='submit' id='submitdemo1'>
    </form>
  
<!-- Jquery files -->
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/1.11.1/jquery.min.js"></script> <script type="text/javascript">

     var jQuery_1_11_1 = $.noConflict(true);

</script>
  <script type="text/javascript">
  
   $('.type_choose').change(function(){
    var index = $(this).val();
    if (index == 1) {
      $('.wximg').show();
      $('.zfbimg').hide();
      $('.yhk').hide();
    } else if(index ==2){
      $('.wximg').hide();
      $('.zfbimg').show();
      $('.yhk').hide();
    } else if(index == 3){
      $('.wximg').hide();
      $('.zfbimg').hide();
      $('.yhk').show();
    }
  })
  
  
   $("#demoBtn1").click(function(){
       if($("#chargemoney").val()=='' || $("#chargemoney").val()<20)
       {
            alert("最低可充值20");
            return;
       }
       
        $.post(
            "pay.php",
            {
                 price: $("#chargemoney").val(),
                 istype : "fix",
            },
            function(data){ 
                if (data.code > 0){
                    $("#goodsname").val(data.data.goodsname);
                    $("#istype").val(data.data.istype);
                    $('#key').val(data.data.key);
                    $('#notify_url').val(data.data.notify_url);
                    $('#orderid').val(data.data.orderid);
                    $('#orderuid').val(data.data.orderuid);
                    $('#price').val(data.data.price);
                    $('#return_url').val(data.data.return_url);
                    $('#uid').val(data.data.uid);
                    $('#submitdemo1').click();

                } else {
                    alert(data.msg);
                }
            }, "json"
        );
    });
    
    function check(){
    document.getElementById("qita1").checked = true;
    }
    function value_to(){
    var x = document.getElementById("qita2").value;
   if (x<1){
  alert ("金额不小于1");
$("#demoBtn1").attr("disabled","disabled");
   }else{
      document.getElementById("qita1").value = x;
$("#demoBtn1").removeAttr("disabled");
   }
 }
  </script>

<script type="text/javascript">
$().ready(function(){
    
  function getistype(){  
    var radioss = document.getElementsByName("demo1");                                    
    for(var i=0;i<radioss.length;i++){   
        if(radioss[i].checked){   
            return (radioss[i].value);  
        }   
    }   
    }  
 
  
    function judgeRadioClicked(){  
    var radios = document.getElementsByName("inputprice");                                    
    for(var i=0;i<radios.length;i++){   
        if(radios[i].checked){   
            return (radios[i].value);  
        }   
    }   
    }  
   
});
</script> 
<script type="text/javascript">
$(function(){
	$(':input').labelauty();
});
</script> 


</body>
</html>