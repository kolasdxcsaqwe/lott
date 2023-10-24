<?
include(dirname(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))))) . "/Public/config.php");
include_once('./jiesuan.php');
$arr = array();
$game = $_POST['game'];
$roomid = $_SESSION['agent_room'];

 if($game == 'pk10'){
 PK10_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '1' order by term desc limit 1");
 }
if($game == 'xyft'){
  MLAFT_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '2' order by term desc limit 1");
 }if($game == 'cqssc'){
   SSC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '3' order by term desc limit 1");
 }if($game == 'xy28'){
   PC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '4' order by term desc limit 1");
 }if($game == 'jnd28'){
   PC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '5' order by term desc limit 1");
 }if($game == 'jsmt'){
   MT_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '6' order by term desc limit 1");
 }if($game == 'jssc'){
  JSSC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '7' order by term desc limit 1");
 }if($game == 'jsssc'){
   JSSSC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '8' order by term desc limit 1");
 }if($game == 'kuai3'){
   K3_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '9' order by term desc limit 1");
 }if($game == 'bjl'){
   BJL_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '10' order by term desc limit 1");
 }if($game == '11x5'){
   X5_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '11' order by term desc limit 1");
 }if($game == 'jssm'){
   SM_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '12' order by term desc limit 1");
 }if($game == 'lhc'){
   LHC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '13' order by term desc limit 1");
 }if($game == 'jslhc'){
   JSLHC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '14' order by term desc limit 1");
 }if($game == 'twk3'){
   TWK3_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '15' order by term desc limit 1");
 }if($game == 'txffc'){
   TXFFC_jiesuan($roomid);
     $qihao = get_query_val('fn_open','term',"type = '16' order by term desc limit 1");
 }
 
 kaichat($game,$qihao, $roomid);
$arr['success'] = true;
$arr['msg'] = '结算成功';
echo json_encode($arr);
?>
