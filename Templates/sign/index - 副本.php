<?php

include dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php";
require "function.php";
$info = getinfo($_SESSION['userid']);
?>
<?php

$first = date("w", strtotime(date("Y-m-01 00:00:00")));//获取第一个月第一天是星期几
        $weekArr = array("日", "一", "二", "三", "四", "五", "六");//国外第一天是星期日
        $maxDay = date('t', strtotime("" . date("Y") . "-" . date("m") . ""));//当前月份最大天数，比如 28,29,30,31
        for ($j = 0; $j < $first; $j++) { //日历第一行空白期
            $blankArr[] = $j;
        }

        for ($i = 0; $i < $maxDay; $i++) { //日历当前天数显示
            $z = $first + $i;
            $days[] = array("key" => $i, "key2" => $z % 7);
        }
        $nowtime = date("Y年m月d日 H:i:s") . "&nbsp;&nbsp;星期" . $weekArr[date("w")];//当前时间和星期几
        //$this->assign("nowtime", $nowtime);
        //$this->assign("days", $days);
        //$this->assign("first", $first);
        //$this->assign("blankArr", $blankArr);
        $total = $first + count($days);

        for ($x = 0; $x < ceil($maxDay / 7) * 7 - $total; $x++) { //日历最后一行空白处
            $other[] = $x;
        }

        function getSign($row) {
    $t = $row + 1;
    if ($t > date('d')) {
        $td = "<td style='background-color:lemonchiffon' valign='top'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span>
</div><div align='left'> </div><div align='left'> </div></td>";
    } else {
        if (strlen($t) == 1) {
            $day = "0" . $t;
        } else {
            $day = $t;
        }
        $t2 = strtotime(date("Y-m-" . $day . ""));
        $info = M("sign")->field("id")->where("addtime = " . $t2 . " AND status = 0 AND uid = " . session('userid') . "")->find();

        if ($info) {
            $td = "<td style='background-color:navajowhite;navajowhite ;'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span>
</div><div align='left'>
<img width='35px' height='35px' src='" . __APP__ . "/Public/images/other/cart_3.gif' style='position:relative;left:10px;'> 已签到
</div></td>";
        } else {
            if ($t == date('d')) {
                $td = "<td  class='today' onclick='signDay($(this))'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span></div>
<div align='center'><a style='cursor:pointer;color:#ffffff;' >签到</a></div></td>";
            } else {
                $td = "<td style='background-color:#DCDCDC;'>
<div align='right' valign='top'><span style='position:relative;right:20px;'>" . $t . "</span>
</div><div align='left'style='height:47px'>
</div></td>";
            }
        }
    }
    return $td;
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>会员签到</title>
        <meta name="keywords" content=" " /> 
        <meta name="description" content=" " /> 
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" /> 
        <link href="css/member.css" rel="stylesheet" type="text/css" />
    </head> 
    <body> 

        <div class="container clearfix">
            <include file="Member:right" />
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
                    <p class="tishi_text">
                        <span class="tishi_span">      1：</span>
                        每天签到，获得 <b>20</b> 金币奖励
                    </p>
                    <p class="tishi_text" style="display: none;">
                        <span class="tishi_span">      2：</span>
                        一个月内签到满 <b>20</b> 次，获得签到奖励 <b>{$Think.config.points.sign_month}</b> 积分（下个月5号之前发放签到奖励）
                    </p>
                </div>
                <table  class='table_sign'>
                    <thead>
                        <tr>
                            <th>周日</th>
                            <th>周一</th>
                            <th>周二</th>
                            <th>周三</th>
                            <th>周四</th>
                            <th>周五</th>
                            <th>周六</th>
                        </tr>
                    </thead>
                    <tbody id="signrili">

<?php
if(($blankArr){
?>
<tr>
<?php foreach ($blankArr as $key => $row) {
    ?>
<td>-</td>
    <?php if($row%7  == $first){?>
</tr>
    <?php
    }
}
                             
<?php
}
?>

<?php foreach ($days as $key => $row) {?>
    <?php if($row['key2']  == 0){?>
    <tr>
    <?php }?>
    <?php echo getSign($row['key']); ?>
    <?php if($row['key2']  == 7){?>
    </tr>
    <?php }?>
<?php }?>

<?php foreach ($other as $key => $row) {?>
<td>-</td>
<?php }?>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <script src="js/jquery.js" type="text/javascript"></script>
        <script type="text/javascript">
            function getUrl(strs) {
                var url = "__APP__/" + strs;
                return url;
            }
            function signDay(obj) {
                $.post(getUrl("Ajax/signDay"), {}, function(data) {
                    if(data == -1){
                        alert("请登录！");return false;
                    }
                    var num = obj.find("span").text();
                    var td = "<td  style='background-color:navajowhite;navajowhite ;'>\n\
  <div align='right' valign='top'><span style='position:relative;right:20px;'>" + num + "</span></div>\n\
  <div align='left'><img width='35px' height='35px' src='" + getUrl('Public') + "/images/other/cart_3.gif' alt='已签到' style='position:relative;left:10px;'>\n\
    已签到</div></td>";
                    obj.before(td);
                    obj.remove();
                    if (data > 0) {
                        alert("签到成功获取 " + data + " 积分");
                    } else {
                        alert("今天您已签到！");
                    }

                })
            }
        </script>

</body>
</html>