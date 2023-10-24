<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
if($_GET['form'] == 'form1'){
    $betpk10 = $_POST['betpk10'] == 'on' ? 'true' : 'false';
    $betxyft = $_POST['betxyft'] == 'on' ? 'true' : 'false';  
    $betcqssc = $_POST['betcqssc'] == 'on' ? 'true' : 'false';  
    $betjsmt = $_POST['betjsmt'] == 'on' ? 'true' : 'false';
  
  $betbjkl8 = $_POST['betbjkl8'] == 'on' ? 'true' : 'false';
  $betjnd28 = $_POST['betjnd28'] == 'on' ? 'true' : 'false';
  $betjssc = $_POST['betjssc'] == 'on' ? 'true' : 'false';
  $betjsssc = $_POST['betjsssc'] == 'on' ? 'true' : 'false';
  $betkuai3 = $_POST['betkuai3'] == 'on' ? 'true' : 'false';
  $betbjl = $_POST['betbjl'] == 'on' ? 'true' : 'false';
  $betgd11x5 = $_POST['betgd11x5'] == 'on' ? 'true' : 'false';
  $betjssm = $_POST['betjssm'] == 'on' ? 'true' : 'false';
  $betlhc = $_POST['betlhc'] == 'on' ? 'true' : 'false';
  $betjslhc = $_POST['betjslhc'] == 'on' ? 'true' : 'false';
  //补
  $bettxffc = $_POST['bettxffc'] == 'on' ? 'true' : 'false';
  $betazxy10 = $_POST['betazxy10'] == 'on' ? 'true' : 'false';
  $betazxy5 = $_POST['betazxy5'] == 'on' ? 'true' : 'false';
    update_query("fn_lottery1", array("fanshui" => $betpk10),array('roomid' => $_SESSION['agent_room']));
    update_query("fn_lottery2", array("fanshui" => $betxyft),array('roomid' => $_SESSION['agent_room']));
    update_query("fn_lottery3", array("fanshui" => $betcqssc),array('roomid' => $_SESSION['agent_room']));
    update_query("fn_lottery6", array("fanshui" => $betjsmt),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery4", array("fanshui" => $betbjkl8),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery5", array("fanshui" => $betjnd28),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery7", array("fanshui" => $betjssc),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery8", array("fanshui" => $betjsssc),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery9", array("fanshui" => $betkuai3),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery10", array("fanshui" => $betbjl),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery11", array("fanshui" => $betgd11x5),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery12", array("fanshui" => $betjssm),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery13", array("fanshui" => $betlhc),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery14", array("fanshui" => $betjslhc),array('roomid' => $_SESSION['agent_room']));
  //补
  update_query("fn_lottery16", array("fanshui" => $bettxffc),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery17", array("fanshui" => $betazxy10),array('roomid' => $_SESSION['agent_room']));
  update_query("fn_lottery18", array("fanshui" => $betazxy5),array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=tui";</script>';
}
?>