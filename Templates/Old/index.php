<?php
include_once(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$sql = get_query_vals('fn_setting', '*', array('roomid' => $_SESSION['roomid']));
if ($_POST['g'] == '') {
    setcookie('game', $sql['setting_game'], time() + 36000000);
    $_COOKIE['game'] = $sql['setting_game'];
} else {
    $version = get_query_val('fn_room', 'version', array('roomid' => $_SESSION['roomid']));
    if ($version != '会员版' && $version != '尊享版') {
        echo '<center><strong style="color:red;font-size:150px">不支持此功能</strong></center>';
        exit;
    }
    setcookie("game", $_POST['g'], time() + 36000000);
    $_COOKIE['game'] = $_POST['g'];
}
select_query("fn_welcome", '*', array("roomid" => $_SESSION['roomid']));
while ($con = db_fetch_array()) {
    $welcome .= "\"{$con['content']}\",";
}
$welcome = substr($welcome, 0, strlen($welcome) - 1);
$game = $_COOKIE['game'];
switch ($game) {
    case 'pk10':
        require 'lottery/pk10.php';
        break;
    case "xyft":
        require "lottery/pk10.php";
        break;
    case "cqssc":
        require "lottery/ssc.php";
        break;
    case "jsssc":
        require "lottery/ssc.php";
        break;
    case "jssc":
        require "lottery/pk10.php";
        break;
    case "xy28":
        require "lottery/pc.php";
        break;
    case "ny28":
        require "lottery/pc.php";
        break;
    case "jnd28":
        require "lottery/pc.php";
        break;
    case "jsmt":
        require "lottery/pk10.php";
        break;
    case "kuai3":
        require "lottery/k3.php";
        break;
    case "bjl":
        require "lottery/bjl.php";
        break;
    case "gd11x5":
        require "lottery/11x5.php";
        break;
    case "jssm":
        require "lottery/pk10.php";
        break;
    case "lhc":
        require "lottery/lhc.php";
        break;
    case "jslhc":
        require "lottery/lhc.php";
        break;
    case "twk3":
        require "lottery/k3.php";
        break;
    case "txffc":
        require "lottery/ssc.php";
        break;
    case "azxy10":
        require "lottery/pk10.php";
        break;
    case "azxy5":
        require "lottery/ssc.php";
        break;
    case "qxc":
        require "lottery/qxc.php";
        break;
    case "pl5":
        require "lottery/pl5.php";
        break;
    case "fc3d":
        require "lottery/fc3d.php";
        break;
}
function formatgame($game)
{
    switch ($game) {
        case 'pk10':
            return '北京赛车';
        case "xyft":
            return "幸运飞艇";
        case "cqssc":
            return "重庆欢乐生肖";
        case "xy28":
            return "新加坡28";
        case "ny28":
            return "纽约28";
        case "jnd28":
            return "加拿大28";
        case "jsmt":
            return "极速摩托";
        case "jssc":
            return "极速赛车";
        case "jsssc":
            return "极速时时彩";
        case "kuai3":
            return "江苏快三";
        case "bjl":
            return "百家乐";
        case "gd11x5":
            return "广东11选5";
        case "jssm":
            return "极速赛马";
        case "lhc":
            return "六合彩";
        case "jslhc":
            return "极速六合彩";
        case "twk3":
            return "台湾快三";
        case "txffc":
            return "腾讯分分彩";
        case "azxy10":
            return "澳洲幸运10";
        case "azxy5":
            return "河内5分彩";
        case "qxc":
            return "七星彩";
    }
}

?>