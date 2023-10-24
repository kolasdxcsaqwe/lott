<?php
//作者：QQ 1878336950 

//搭建/接口api/其他棋牌彩票类平台/程序修正/彩票程序定制/一条龙服务

include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

    $arr = array();
    if($_POST['roomid'] == ''){
        $arr['success'] = false;
        $arr['msg'] = '参数错误..Err(-1203)';
    }else{
        update_query("fn_user", array('money'=>'0.00'), array('roomid' => $_POST['roomid']));
        $arr['success'] = true;
    }
    echo json_encode($arr);

?>