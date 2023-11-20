<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$type = $_GET['type'];
$sql = $_GET['game'] == '' ? '' : "and `game` = '{$_GET['game']}'";

if (empty($_SESSION['agent_room']) || strlen($_SESSION['agent_room']) == 0) {
    echo "";
    exit();
}

switch ($type) {
    case 'first':
        $arr = array();
        select_query("fn_chat", '*', "roomid = {$_SESSION['agent_room']} $sql order by id desc limit 0,20");
        while ($x = db_fetch_array()) {
            $arr[] = array('nickname' => $x['username'], 'headimg' => $x['headimg'], 'content' => $x['content'], 'addtime' => $x['addtime'], 'type' => $x['type'], 'game' => $x['game'], 'id' => $x['id']);
        }
        echo json_encode($arr);
        break;
    case "update":
        $arr = array();
        $chatid = $_GET['id'];
        select_query("fn_chat", '*', "roomid = {$_SESSION['agent_room']} $sql and id>$chatid order by id asc");
        while ($x = db_fetch_array()) {
            if ($x['userid'] == $_SESSION['userid']) continue;
            $arr[] = array('nickname' => $x['username'], 'headimg' => $x['headimg'], 'content' => $x['content'], 'addtime' => $x['addtime'], 'type' => $x['type'], 'game' => $x['game'], 'id' => $x['id']);
        }
        echo json_encode($arr);
        break;
    case "send":
        $content = $_POST['content'];
        if ($_GET['game'] != "") {
            adminBroadcast($content, '', '', $_SESSION['agent_room'], $_GET['game'], 'S1', 'system');
        } else {
            adminBroadcast($content, '', '', $_SESSION['agent_room'], 'pk10', 'S1', 'system');
            adminBroadcast($content, '', '', $_SESSION['agent_room'], 'xyft', 'S1', 'system');
            adminBroadcast($content, '', '', $_SESSION['agent_room'], 'xy28', 'S1', 'system');
            adminBroadcast($content, '', '', $_SESSION['agent_room'], 'jnd28', 'S1', 'system');
        }
        echo json_encode(array("success" => true, "content" => $content));
        break;
}
?>