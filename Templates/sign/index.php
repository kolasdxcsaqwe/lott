<?php
include dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php";
require "function.php";

date_default_timezone_set("PRC");

$time = getdate();


$mday = $time["mday"];
$mon = $time["mon"];
$year = $time["year"];


if($mon==4||$mon==6||$mon==9||$mon==11){
    $day = 30;
}elseif($mon==2){
    if(($year%4==0&&$year%100!=0)||$year%400==0){
        $day = 29;
    }else{
        $day = 28;
    }
}else{
    $day = 31;
}


$dataObj = getdate(mktime(0,0,0,$mon,1,$year));
$w=$dataObj["wday"];

$date = function($day,$w){
//  echo "<table border='1'>";
//echo "<tr><th>星期日</th><th>星期一</th><th>星期二</th><th>星期三</th><th>星期四</th><th>星期五</th><th>星期六</th></tr>";
$arr = array();
for($i=1;$i<=$day;$i++){
    array_push($arr,$i);
}
if($w>=1&&$w<=6){
    for($m=1;$m<=$w;$m++){
        array_unshift($arr,"");
    }
}
$n=0;


for($j=1;$j<=count($arr);$j++){
   // array_push($da,$arr[$j-1]); 
    $n++;
    if($n==1) echo "<tr>";
    global $mday;
    if($mday==$arr[$j-1]){
        if ($arr[$j-1]>0) {
         if(getSign_status($arr[$j-1])){
            echo "<td width='80px' style='background-color: greenyellow;'>已签到".$arr[$j-1]."</td>";
         }else{
           echo "<td width='80px' class='today' style='background-color: red;color:white'  onclick='signDay($(this),".$arr[$j-1].")' >请签到".$arr[$j-1]."</td>";
         }
        }else{
            echo "<td width='80px' >-</td>";

        }

        //echo "<td width='80px' style='background-color: greenyellow;'>".$arr[$j-1]."</td>";
    }else{

       // echo "<td width='80px'>".$arr[$j-1]."</td>";
       if ($arr[$j-1]>0) {

        if(getSign_status($arr[$j-1])){

            echo "<td width='80px'  style='background-color: greenyellow;'>已签到".$arr[$j-1]."</td>";

         }else{

            if ($arr[$j-1]>$mday) {
                echo "<td width='80px' class='today' style='background-color: #f9d148;color: #666;'>未开始".$arr[$j-1]."</td>";
            }else{
                echo "<td width='80px' class='today' style='background-color: #DCDCDC;' >未签到".$arr[$j-1]."</td>";
            }
            

         }

        }else{
            echo "<td width='80px' >-</td>";

        } 
    }
    
    if($n==7){
        echo "</tr>";
        $n=0;
    }
    $da='';
}
if($n!=7)echo "</tr>";

// echo "</table>";

};
 
/*
$first = date("w", strtotime(date("Y-m-01 00:00:00")));//获取第一个月第一天是星期几
  //var_dump($first);
        $weekArr = array("日", "一", "二", "三", "四", "五", "六");//国外第一天是星期日
        $maxDay = date('t', strtotime("" . date("Y") . "-" . date("m") . ""));//当前月份最大天数，比如 28,29,30,31
        for ($j = 0; $j < $first; $j++) { //日历第一行空白期
            $blankArr[] = $j;
        }
  //var_dump($maxDay);
        for ($i = 0; $i < $maxDay; $i++) { //日历当前天数显示
            $z = $first + $i;

            $days[] = array("key" => $i, "key2" => $z % 7,'z'=>$z);
        }
        $nowtime = date("Y年m月d日 H:i:s") . "&nbsp;&nbsp;星期" . $weekArr[date("w")];//当前时间和星期几
         // var_dump($days);
        //$this->assign("nowtime", $nowtime);
        //$this->assign("days", $days);
        //$this->assign("first", $first);
        //$this->assign("blankArr", $blankArr);
        $total = $first + count($days);
 // var_dump($total);
        for ($x = 0; $x < ceil($maxDay / 7) * 7 - $total; $x++) { //日历最后一行空白处
            $other[] = $x;
        }
        var_dump($total);
       //$day_num = $total-count($other);
*/
$jinbi = get_query_vals('fn_sign_set','*',array('id'=>2));
//print_r ($jinbi);
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>会员签到</title>
        <meta name="keywords" content=" " /> 
        <meta name="description" content=" " /> 
      <meta name="description" content="Touch-friendly JavaScript image gallery for mobile and desktop, without dependencies. Responsive layout. Swipe and zoom gestures.">
      <meta name="viewport" content="width = device-width, initial-scale = 1.0">
      <meta name="author" content="Dmitry Semenov">

        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" /> 
        <link href="css/member.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/record.origin.js"></script>

    <link rel="stylesheet" type="text/css" href="css/common.css?v=1.2" />
    <link rel="stylesheet" type="text/css" href="css/new_cfb.css?v=1.2" />
    
 <style>
.table_sign th {
    font-weight: normal;
    width: 100px;
}
.table_sign{width: 90%;}
  </style>
    </head> 
    <body> 
<div class="wx_cfb_container wx_cfb_account_center_container">
        <div class="wx_cfb_account_center_wrap">
            <div class="wx_cfb_ac_fund_detail">
                <div class="user_info clearfix">
                    <div class="user_photo"><img src="<?php echo $_SESSION['headimg'];
?>" style="width:45px; height:45px; "></div>
                    <div class="user_txt">
                        <div class="p1">
                            <?php echo $_SESSION['username'];
?>
                        </div>
                        <div class="p2">欢迎来到【
                            <?php echo get_query_val("fn_room", "roomname", array("roomid" => $_SESSION['roomid']));
?>】娱乐房间</div>
                    </div>
                </div>
            </div>
        <div class="container clearfix">
            
            <div class="member_main">
                <div class="perInfo">
                    <div class="titleInfoBorder">
                        <span>提示：登录会员签到</span>
                    </div>
                </div>
                <div class="tishi">
                    <p class="tishi_text">
                        <span class="tishi_span">签到奖励提示</span>
                    </p>
                     <p class="tishi_text" >
                        <span class="tishi_span">      1：</span>
						第一天签到，获得<b><?php echo $jinbi['s_1'];?></b>金币奖励<br>
						第二天签到，获得<b><?php echo $jinbi['s_2'];?></b>金币奖励<br>
							第三天签到，获得<b><?php echo $jinbi['s_3'];?></b>金币奖励<br>
								第四天签到，获得<b><?php echo $jinbi['s_4'];?></b>金币奖励<br>
									第五天签到，获得<b><?php echo $jinbi['s_5'];?></b>金币奖励<br>
										第六天签到，获得<b><?php echo $jinbi['s_6'];?></b>金币奖励<br>
											第七天签到，获得<b><?php echo $jinbi['s_7'];?></b>金币奖励<br>
                    </p>
                    <p class="tishi_text" style="display: none;">
                        <span class="tishi_span">      1：</span>
                        每天签到，获得 <b>20</b> 金币奖励
                    </p>
                    <p class="tishi_text" style="display: none;">
                        <span class="tishi_span">      2：</span>
                        一个月内签到满 <b>20</b> 次，获得签到奖励 <b>{$Think.config.points.sign_month}</b> 积分（下个月5号之前发放签到奖励）
                    </p>
                </div>
                <table  class='table_sign' style="width: 90%;">
                    <thead>
                        <tr>
                            <th style="   background-color: #f75b5b;">周日</th>
                            <th style=" background-color: #f9ac5f;">周一</th>
                            <th style="      background-color: #FFFF00  ;">周二</th>
                            <th style="   background-color: #5ef75e;">周三</th>
                            <th style="   background-color: #66f7f7;" >周四</th>
                            <th style="  background-color: #6363f5; ">周五</th>
                            <th style="  background-color: #b461f9;" >周六</th>
                        </tr>
                    </thead>
                    <tbody id="signrili">
                       <?php $date($day,$w);?>
                        
                    </tbody>
                </table>
            </div>
        </div>



        </div>
        <div class="wx_cfb_fixed_btn_box">
        <div class="wx_cfb_fixed_btn_wrap">
            <div class="btn_box clearfix">
                <a href="/qr.php?room=<?php echo $_SESSION['roomid']?>;" class="btn tel_btn clearfix">
                    <em class="ico ui_ico_size_40 ui_tel_ico"></em><span class="txt">返回大厅</span>
                </a>
            </div>
        </div>
    </div>
        </div>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript">
            var isRequesting=false
            function getUrl(strs) {
                var url = "__APP__/" + strs;
                return url;
            }
            function signDay(obj,day_) {
                isRequesting=true
                if(!isRequesting)
                {
                    $.post('signday.php', {sing_time:day_}, function(data) {
                        isRequesting=false
                        data = JSON.parse(data);
                        if(data['res'] == -1){
                            alert("请登录！");return false;
                        }

                        console.log(data);
                        var num = obj.find("span").text();
                        var td = "<td style='background-color: greenyellow;'>" + num + "已签到"+day_+"</td>";
                        obj.before(td);
                        obj.remove();

                        if (data['res'] > 0) {
                            alert(data['msg']);
                        }

                    })
                }

            }
        </script>

</body>
</html>