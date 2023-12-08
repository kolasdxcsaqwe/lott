<?php
include_once("../Public/config.php");

$loginName=$_POST['username'];
$password=$_POST['password'];
$types=$_POST['types'];
$reapeatpassword=$_POST['reapeatpassword'];
$agent=$_POST['agent'];
$roomId=$_POST['room'];
$returnData = array();
$code=0;
$msg="success";

if(is_null($loginName) || is_null($password) || is_null($agent) || is_null($roomId) || is_null($types))
{
    $code=-1;
    $msg="参数错误";
    $returnData=array('code'=>$code,'msg'=>$msg);
    echo json_encode($returnData);
    exit();
}

$reUrl="";
if($types==0)
{
    if(strlen($loginName)<6 || strlen($loginName)>20)
    {
        $msg="用户名长度需要在6到20位之间";
        $code=-6;
    }

    if(strlen($password)<6 || strlen($password)>20)
    {
        $msg="密码长度需要在6到20位之间";
        $code=-7;
    }

    $json= vpost(constant("javaServiceUrl")."login",array('loginName'=>$loginName,'password'=>$password,'roomId'=>$roomId,'agent'=>$agent));
    $jsonObj= json_decode($json);
    $datas=$jsonObj->datas;
    $msg=$jsonObj->msg;
    $code=$jsonObj->code;
    if($datas!=null)
    {
        $reUrl="../qr.php?room=" . $datas->roomid."&agent=".$datas->agent."&userid=".$datas->userid."&username=".$datas->username."&headimg=".$datas->headimg;
    }
}
else if($types==1)
{
    if(strlen($loginName)<6 || strlen($loginName)>20)
    {
        $msg="用户名长度需要在6到20位之间";
        $code=-2;
    }

    if($password!=$reapeatpassword)
    {
        $msg="两次密码输入不一致！";
        $code=-3;
    }

    if(strlen($password)<6 || strlen($password)>20)
    {
        $msg="密码长度需要在6到20位之间";
        $code=-4;
    }

    if($code==0)
    {
        $json= vpost(constant("javaServiceUrl")."register",array('loginName'=>$loginName,'password'=>$password,'roomId'=>$roomId,'agent'=>$agent));
        $jsonObj= json_decode($json);
        $datas=$jsonObj->datas;
        $msg=$jsonObj->msg;
        $code=$jsonObj->code;
        if($datas!=null)
        {
            $reUrl="../qr.php?room=" . $datas->roomid."&agent=".$datas->agent."&userid=".$datas->userid."&username=".$datas->username."&headimg=".$datas->headimg;
        }
    }
}

$returnData=array('code'=>$code,'msg'=>$msg,'reurl'=>$reUrl);

echo json_encode($returnData);


function create($roomid,$userid, $username,$loginuser, $loginpass,$headimg, $agent = "null",$level=1) {
    if ($agent == "") {
        $agent = 'null';
    }
    $loginuser = str_replace(' ',"",$loginuser);
    $loginpass = str_replace(' ',"",$loginpass);
    //insert_query("fn_user", array("userid" => $userid, 'username' => $username, 'headimg' => $_SESSION['headimg'], 'money' => '0', 'roomid' => $_SESSION['roomid'], 'statustime' => time(), 'agent' => $agent, 'isagent' => 'false', 'jia' => 'false'));
    insert_query("fn_user", array("userid" => $userid, 'loginuser' => $loginuser,'username' => $username,'loginpass' => md5($loginpass), 'headimg' => $headimg, 'money' => '0', 'roomid' => $roomid, 'statustime' => time(), 'agent' => $agent,'level' => $level, 'isagent' => 'false', 'jia' => 'false'));
    return true;
}

function login($loginuser,$loginpass) {

    $result=get_query_vals("fn_user","*",array('username' => $loginuser,'loginpass' => md5($loginpass)));

    if (!is_null($result)) {
        $_SESSION['userid'] = $result['userid'];
        $_SESSION['username'] = $result['username'];
        $_SESSION['headimg'] = $result['headimg'];
        $_SESSION['roomid'] = $result['roomid'];


        $reurl="../qr.php?room=" . $result['roomid']."&agent=".$result['agent']."&userid=".$result['userid']."&username=".$result['username']."&headimg=".$result['headimg'];
        return $reurl;
    } else {
        return '';
    }
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