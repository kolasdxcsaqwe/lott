<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$id = $_POST['id'];
$bzname = $_POST['bzname'];

$userid = get_query_val('fn_user', 'userid', array('id' => $id));

setname($userid, $bzname, $_SESSION['agent_room']);
echo json_encode(array("success" => true, "msg" => "操作成功"));

function setname($Userid, $bzname, $room){
update_query('fn_user', array('bzname' => $bzname), array('userid' => $Userid, 'roomid' => $room));
//insert_query("fn_marklog", array("roomid" => $room, 'userid' => $Userid, 'type' => '上分', 'content' => '管理员手动上分', 'money' => $Money, 'addtime' => 'now()'));
}
?>