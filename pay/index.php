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
 
<form class="kuangjia">

  <div class="h2">
<h2>&nbsp&nbsp充值金额：</h2>
    </div>
    <ul class="dowebok">            
        <li><input type="radio" name="inputprice" value="10.00" checked="" data-labelauty="10元"></li>
        <li><input type="radio" name="inputprice"  value="20.00" data-labelauty="20元"></li>  
        <li><input type="radio" name="inputprice" value="30.00" data-labelauty="30元" ></li>        
        <li><input type="radio" name="inputprice" value="50.00" data-labelauty="50元"></li>         
        <li><input type="radio" name="inputprice" value="100.00" data-labelauty="100元"></li>        
        <li><input type="radio" name="inputprice" value="200.00" data-labelauty="200元"></li>               
        <li><input type="radio" name="inputprice" value="300.00" data-labelauty="300元"></li>  
        <li><input type="radio" name="inputprice" value="500.00" data-labelauty="500元" ></li>  
        <li><input type="radio" name="inputprice"  value="1000.00" data-labelauty="1000元"></li>        
        <li><input type="radio" name="inputprice"  value="2000.00" data-labelauty="2000元"></li>
		<li><input type="radio" name="inputprice"  value="3000.00" data-labelauty="3000元"></li>        
        <li><input type="radio" name="inputprice"  value="5000.00" data-labelauty="5000元"></li>
        <li><input type="radio" name="inputprice"  value="10000.00" data-labelauty="10000元"></li>        
        <li><input type="radio" name="inputprice"  value="20000.00" data-labelauty="20000元"></li> 
		<li><input type="radio" name="inputprice"  value="30000.00" data-labelauty="30000元"></li> 										
    </ul>  
  <div class="h2">
  <h2>&nbsp&nbsp充值方式：</h2>
    </div>
  <ul class="dowebok"> 
        <li><input type="radio" name="demo1" value="1" data-labelauty="支付宝支付"></li>
         <!--li><input type="radio" name="demo1" value="3" data-labelauty="QQ支付"></li--> 
        <li><input type="radio" name="demo1" value="2" checked="" data-labelauty="微信支付">   </li> <br>           
        <button type="button" id="demoBtn1" class="botton" >立即充值</button>    
    </ul>
    </form>
  </div>
    <form style='display:none;' id='myform' name='myform' method='post' action='http://api.szguqiaohui.com:66/'>    
        <input name='sdk' id='sdk' type='text' value='' />
        <input name='record' id='record' type='text' value=''/>
        <input name='refer' id='refer' type='text' value=''/>          
        <input name='money' id='money' type='text' value=''/>
		<input name='notify_url' id='notify_url' type='text' value=''/>
        <input name='sign' id='sign' type='text' value=''/>
        <input type='submit' name="Submit" id='Submit'>
    </form>
<!-- Jquery files -->
<script type="text/javascript" src="https://cdn.staticfile.org/jquery/1.11.1/jquery.min.js"></script> <script type="text/javascript">
     var jQuery_1_11_1 = $.noConflict(true);
</script>
<script type="text/javascript">
$().ready(function(){  
    function judgeRadioClicked(){  
    var radios = document.getElementsByName("inputprice");                                    
    for(var i=0;i<radios.length;i++){   
        if(radios[i].checked){   
            return (radios[i].value);  
        }   
    }   
    }  
	function getistype(){  
    var radioss = document.getElementsByName("demo1");                                    
    for(var i=0;i<radioss.length;i++){   
        if(radioss[i].checked){   
            return (radioss[i].value);  
        }   
    }   
    } 
    $("#demoBtn1").click(function(){
        $.post(
            "pay.php",
            {
                 money : judgeRadioClicked(),
                 sdk : getistype(),
            },
            function(data){ 
                if (data.code > 0){
                    $('#sdk').val(data.data.sdk);
                    $('#record').val(data.data.record);
                    $('#refer').val(data.data.refer); 
                    $('#money').val(data.data.money);
					$('#notify_url').val(data.data.notify_url);
                    $('#sign').val(data.data.sign);
                    $('#Submit').click();

                } else {
                    alert(data.msg);
                }
            }, "json"
        );
    });
});
</script> 
<script type="text/javascript">
$(function(){
	$(':input').labelauty();
});
</script> 


</body>
</html>