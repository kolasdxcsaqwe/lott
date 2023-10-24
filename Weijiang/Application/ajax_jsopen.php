<?
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

$game = $_POST['game'];
$status = $_POST['status'] == 'false' ? '1' : '0';
$arr = array();
 if($game == 'pk10'){
     update_query('fn_lottery1',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));
     
     
 }elseif($game == 'xyft'){
    update_query('fn_lottery2',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'cqssc'){
     update_query('fn_lottery3',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'xy28'){
    update_query('fn_lottery4',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'jnd28'){
    update_query('fn_lottery5',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'jsmt'){
    update_query('fn_lottery6',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'jssc'){
    update_query('fn_lottery7',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'jsssc'){
    update_query('fn_lottery8',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'kuai3'){
    update_query('fn_lottery9',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'bjl'){
    update_query('fn_lottery10',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == '11x5'){
     update_query('fn_lottery11',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'jssm'){
     update_query('fn_lottery12',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'lhc'){
     update_query('fn_lottery13',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'jslhc'){
     update_query('fn_lottery14',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'twk3'){
    update_query('fn_lottery15',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }elseif($game == 'txffc'){
    update_query('fn_lottery16',array('jsdiy'=>$status),array('roomid'=>$_SESSION['agent_room']));

 }
$arr['success'] = true;
$arr['msg']='修改成功';
echo json_encode($arr);


