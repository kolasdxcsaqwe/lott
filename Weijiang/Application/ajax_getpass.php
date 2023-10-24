<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

$loginpass1 = $_POST['loginpass1'];
$loginpass2 = $_POST['loginpass2'];
$id = $_POST['id'];
//file_put_contents('log.txt',json_encode($_POST));
$arr = array();
if( $loginpass1 =='' || $loginpass2 == ''){
        $arr['success'] = false;
        $arr['msg'] = '密码不能为空';
        echo json_encode($arr);
        exit();
}elseif($loginpass1 != $loginpass2){
        $arr['success'] = false;
        $arr['msg'] = '两次密码不一致';
        echo json_encode($arr);
        exit();
}else{
        $arr['success'] = true;
        $arr['msg'] = '添加成功';
         update_query("fn_user", array('loginpass'=>md5($loginpass1)),array("id" => $id, 'roomid' => $_SESSION['agent_room']));
        echo json_encode($arr);
        exit();
}


?>