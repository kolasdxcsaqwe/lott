<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

if($_GET['form'] == 'form1'){
    $sid = $_POST['sid'];
    $zhisdk = $_POST['zhisdk'];
    $weisdk = $_POST['weisdk'];
    $qsdk = $_POST['qsdk'];
    update_query("fn_setting", array("sid" => $sid , 'zhisdk' => $zhisdk, 'weisdk' => $weisdk, 'qsdk' => $qsdk), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=manage&a=pay";</script>';
}elseif($_GET['form'] == 'form2'){
    $dsid = $_POST['dsid'];
    $dskey = $_POST['dskey'];
    update_query("fn_setting", array("dsid" => $dsid , 'dskey' => $dskey), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=manage&a=pay";</script>';
}
?>