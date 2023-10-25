<?php
include_once("../Public/config.php");

$username=$_POST['username'];
$password=$_POST['password'];
$agent=$_POST['agent'];
$roomId=$_POST['roomId'];
$returnData = array();
$code=0;
$msg="success";

if(empty($username) || empty($password) || empty($agent) || empty($roomId))
{
    $code=-1;
    $msg="参数错误";
}

create(uuid(),$username,$password,"/upload/0.png");

$returnData=array('code'=>$code,'msg'=>$msg);
echo json_encode($returnData);

function create($userid, $username, $loginpass,$headimg, $agent = "null",$level=1) {
    if ($agent == "") {
        $agent = 'null';
    }
    $username = str_replace('"',"",$username);
    //insert_query("fn_user", array("userid" => $userid, 'username' => $username, 'headimg' => $_SESSION['headimg'], 'money' => '0', 'roomid' => $_SESSION['roomid'], 'statustime' => time(), 'agent' => $agent, 'isagent' => 'false', 'jia' => 'false'));
    insert_query("fn_user", array("userid" => $userid, 'username' => $username,'loginpass' => $loginpass, 'headimg' => $headimg, 'money' => '0', 'roomid' => $roomId, 'statustime' => time(), 'agent' => $agent,'level' => $level, 'isagent' => 'false', 'jia' => 'false'));
    return true;
}

function  uuid()
{
    $chars = md5(uniqid(mt_rand(), true));
    $uuid = substr ( $chars, 0, 8 ) . '-'
        . substr ( $chars, 8, 4 ) . '-'
        . substr ( $chars, 12, 4 ) . '-'
        . substr ( $chars, 16, 4 ) . '-'
        . substr ( $chars, 20, 12 );
    return $uuid ;
}

?>