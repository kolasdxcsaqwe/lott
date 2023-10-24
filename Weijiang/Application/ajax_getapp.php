<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

$userid = $_SESSION['agent_room'] . date("YmdHis") . mt_rand(10000,99999);
$loginuser = $_POST['loginuser'];
$loginpass = md5($_POST['loginpass']);
$username = $_POST['username'];
$isagent = $_POST['isagent'];
$jia = $_POST['jia'];
$money = $_POST['money'];
if(empty($money)){
$money = '0';
}

$headimg = get_query_val('fn_robots','headimg',array('id'=>rand(0,30000)));
$iuser = get_query_val('fn_user','loginuser',array('loginuser'=>$loginuser));
$arr = array();
if($loginuser=='' || $loginpass =='' || $username == ''){
        $arr['success'] = false;
        $arr['msg'] = '用户名，账号或密码不能为空';
        echo json_encode($arr);
        exit();
}elseif($loginuser == $iuser){
    $arr['success'] = false;
    $arr['msg'] = '账号已被注册，请重新填写';
    echo json_encode($arr);
    exit();
}else{
        $arr['success'] = true;
        $arr['msg'] = '添加成功';
         insert_query("fn_user", array("userid" => $userid, 'username' => $username, 'headimg' => $headimg, 'money' => $money, 'roomid' => $_SESSION['agent_room'], 'statustime' => time(), 'agent' => 'null', 'isagent' => $isagent, 'jia' => $jia,'loginuser'=>$loginuser,'loginpass'=>$loginpass));
        echo json_encode($arr);
        exit();
}


?>