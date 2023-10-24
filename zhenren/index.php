<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
  <link rel="stylesheet" href="css/jquery-labelauty.css">
  <link rel="stylesheet" type="text/css" href="/Templates/user/css/common.css?v=1.2" />
  <link rel="stylesheet" type="text/css" href="/Templates/user/css/new_cfb.css?v=1.2" />
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery-labelauty.js"></script>
  <title>额度转换</title>
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
    text-align: center;
    font-size:18px;
  }
  
  .botton{
   margin-right: 20px;
   margin-bottom: 10px;
   margin-left: 20px;
   text-align:center;
   width:240px;
   height:40px;
  }
  .zr{
    text-align:center; 
    vertical-align:middel;
    margin-top: 10px;
  }
  .qrzh{
    text-align:center; 
    vertical-align:middel;
    margin-top: 20px;
  }
  .qran{
    width:120px; 
    height:30px; 
    line-height:30px;
    border:0.5px solid #222;
    background-color:#000; 
    color:red;
  }
</style>  
  
<body class="abody">
<?php 
  include_once('ngapi.php');
  include_once ('../Public/config.php');
  session_start();
  $api=new ngapi();

  $_SESSION['uid']=get_query_val("fn_user", "id", array("roomid" => $_SESSION['roomid'], 'userid' => $_SESSION['userid']));
  $zrusrname=str_pad($_SESSION['uid'],8,8,STR_PAD_LEFT );
  $zrmoney=$api->balance($zrusrname);
  $centermoney=get_query_val("fn_user", "money", array("roomid" => $_SESSION['roomid'], 'userid' => $_SESSION['userid']));

  ?>
      <div class="wx_cfb_container wx_cfb_account_center_container">
        <div class="wx_cfb_account_center_wrap">
            <div class="wx_cfb_ac_fund_detail">
                <div class="user_info clearfix">
                    <div class="user_photo"><img src="<?php echo $_SESSION['headimg'];?>" style="width:45px; height:45px; "></div>
                    <div class="user_txt">
                        <div class="p1">
                            <?php echo $_SESSION['username'];?>
                        </div>
                        <div class="p2">欢迎来到【<?php echo get_query_val("fn_room", "roomname", array("roomid" => $_SESSION['roomid']));?>】</div>
                    </div>
                </div>
                <div class="fund_info">
                    <div class="kv_tb_list clearfix">
                        <div class="kv_item">
                            <span class="val"><?php echo get_query_val("fn_user", "money", array("roomid" => $_SESSION['roomid'], 'userid' => $_SESSION['userid']));?></span>
                            <span class="key">我的钱包</span>
                        </div>
                        <div class="kv_item">
                            <span class="val"></span>
                            <span class="key"></span>
                        </div>
                        <div class="kv_item">
                            <span class="val"><?php echo $zrmoney['data'];?></span>
                            <span class="key">申博账户余额</span>
                        </div>
                    </div>
                </div>
            </div>

<div class="bianju">  
  <!--img src="./images/paylogo.png" style="width:50%;height:auto;margin:0 auto;"-->
  <form class="kuangjia">
  <div class="h2"><h2>转换金额</h2></div>
    <ul class="dowebok" style="text-align:center"> 
        <span style="font-size:14px;color:red;">
          我的钱包：<?php echo $centermoney;?><br>
          申博账户余额：<?php echo $zrmoney['data'];?>
        </span>
    </ul>
  </form>
</div>
    <form id='trans' name='trans' method='post' action='trans.php'>    
        <div style="text-align:center; vertical-align:middel;"><input class="srje" name='money' id='money' type='text' value='' style="width:200px; height:30px; border:1px solid #222;"/></div>
      	<div class="zr">
             <input name='transtype' id='in' type=radio value='0' checked="checked" /><label for="in">转入</label> &nbsp;&nbsp;&nbsp;&nbsp;
             <input name='transtype' id='out' type=radio value='1' /><label for="out">转出</label>
        </div>
      	<input name='zrmoney' type='hidden' value="<?php echo $zrmoney['data']?>" /> 
      	<input name='centermoney' type='hidden' value="<?php echo $centermoney ?>" /> 
      	<input name='zrusrname' type='hidden' value="<?php echo $zrusrname ?>" />
      	<input name='uid' type='hidden' value="<?php echo $_SESSION['uid'] ?>" />
      <div class="qrzh"><input class="qran" type='submit' id='submitdemo1'value="确认转换" /></div>
    </form>
  
  <br>
  <!--input type="button" name="register" value ="进入申博" onclick="window.location.href='login.php'"/>-->
  </div>
</div>
  
      <div class="wx_cfb_fixed_btn_box">
        <div class="wx_cfb_fixed_btn_wrap">
            <div class="btn_box clearfix">
                <a href="/Templates/user/" class="btn tel_btn clearfix">
                    <em class="ico ui_ico_size_40 ui_tel_ico"></em><span class="txt">返回个人中心</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>