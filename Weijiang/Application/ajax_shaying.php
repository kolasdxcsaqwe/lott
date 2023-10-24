<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

if($_POST['agent_user'] == 'guest1'){
    echo '<script>alert("演示盘，无法修改"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
    exit;
}elseif($_GET['form'] == 'form1'){
    $kongzhi = $_POST['jsmt'] == 'on' ? 1 : 0;
    $shenglv = $_POST['mtsl'];
    update_query("fn_lottery6", array("kongzhi" => $kongzhi,'shenglv'=>$shenglv), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
}elseif($_GET['form'] == 'form2'){
    $kongzhi = $_POST['jssc'] == 'on' ? 1 : 0;
    $shenglv = $_POST['jsscsl'];
    update_query("fn_lottery7", array("kongzhi" => $kongzhi,'shenglv'=>$shenglv), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
}elseif($_GET['form'] == 'form3'){
    $kongzhi = $_POST['jsssc'] == 'on' ? 1 : 0;
    $shenglv = $_POST['jssscsl'];
    update_query("fn_lottery8", array("kongzhi" => $kongzhi,'shenglv'=>$shenglv), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
}elseif($_GET['form'] == 'form4'){
    $kongzhi = $_POST['jssm'] == 'on' ? 1 : 0;
    $shenglv = $_POST['jssmsl'];
    update_query("fn_lottery12", array("kongzhi" => $kongzhi,'shenglv'=>$shenglv), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
}elseif($_GET['form'] == 'form5'){
    $kongzhi = $_POST['jslhc'] == 'on' ? 1 : 0;
    $shenglv = $_POST['jslhcsl'];
    update_query("fn_lottery14", array("kongzhi" => $kongzhi,'shenglv'=>$shenglv), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
}elseif($_GET['form'] == 'form6'){
    $kongzhi = $_POST['bjl'] == 'on' ? 1 : 0;
    $shenglv = $_POST['bjlsl'];
    update_query("fn_lottery10", array("kongzhi" => $kongzhi,'shenglv'=>$shenglv), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
}elseif($_GET['form'] == 'form7'){
    $kongzhi = $_POST['twk3'] == 'on' ? 1 : 0;
    $shenglv = $_POST['twk3sl'];
    update_query("fn_lottery15", array("kongzhi" => $kongzhi,'shenglv'=>$shenglv), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=shaying";</script>';
}
?>