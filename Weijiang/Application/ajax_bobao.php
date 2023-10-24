<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
if($_GET['form'] == 'form1'){
    $daojishi = $_POST['daojishi'];
    update_query("fn_setting", array("daojishi" => $daojishi), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=setting&s=s_bobao";</script>';
}
if($_GET['form'] == 'form2'){
    $fengpanxiaoxi = $_POST['fengpanxiaoxi'];
    update_query("fn_setting", array("fengpanxiaoxi" => $fengpanxiaoxi), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=setting&s=s_bobao";</script>';
}
?>