<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$type = $_GET['type'];

switch($type){
case 'first': 
    $arr = array();
    select_query("fn_custom", '*', "`roomid` = '{$_SESSION['agent_room']}' and `userid` = '{$_GET['userid']}' order by `id` asc");
    while($x = db_fetch_array()){
        $arr[] = array('nickname' => $x['username'], 'headimg' => $x['headimg'], 'content' => $x['content'], 'addtime' => $x['addtime'], 'type' => $x['type'], 'userid' => $x['userid']);
    }
    echo json_encode($arr);
    break;
case "update": 
    $arr = array();
    $chatid = $_GET['id'];
    $userid = $_GET['userid']; 
    select_query("fn_custom", '*', "`roomid` = {$_SESSION['agent_room']} and `userid` = '$userid' order by `id` asc");
    while($x = db_fetch_array()){
        if($x['userid'] == $_SESSION['userid'])continue;
        $arr[] = array('nickname' => $x['username'], 'headimg' => $x['headimg'], 'content' => $x['content'], 'addtime' => $x['addtime'], 'type' => $x['type'], 'userid' => $x['userid']);
    }
    echo json_encode($arr);
    break;
case "send": 
    $content = $_POST['content'];
    $headimg = get_query_val('fn_setting', 'setting_sysimg', array('roomid' => $_SESSION['agent_room']));
        insert_query('fn_custom', array('username' => '管理员', 'content' => $content, 'addtime' => date('Y-m-d H:i:s'), 'headimg' => $headimg, 'type' => 'S1', 'userid' => $_GET['userid'], 'roomid' => $_SESSION['agent_room']));
        update_query('fn_custom',array('status'=>'已回'),array('userid'=>$_GET['userid']));

    echo json_encode(array("success" => true, "content" => $content));
    break;
}
?>