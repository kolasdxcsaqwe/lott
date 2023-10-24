<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
function 用户_下分($Userid, $Money, $room, $game, $term, $content){
    update_query('fn_user', array('money' => '-=' . $Money), array('userid' => $Userid, 'roomid' => $room));
    delete_query("fn_marklog", array("userid" => $Userid, 'type' => '上分', 'content' => $term . '期' . $game . '中奖派彩' . $content, 'money' => $Money, 'roomid' => $room)); 
}
$arr = array();
$roomid = $_SESSION['agent_room'];
$id = $_POST['id'];
$mingci = $_POST['mingci'];
$content = $_POST['content'];
$chat_id = $_POST['chat_id'];
$game = $_POST['game'];

if($id == '' || $mingci=='' || $content=='' || $game==''){
        $arr['success'] = false;
        $arr['msg'] = '不能为空';
        echo json_encode($arr);
        exit();
}else{
 switch($game){
case 'pk10': 
     $order = 'fn_order'; 
     $games = '北京赛车';
     break;
case 'xyft': 
     $order = 'fn_flyorder';
     $games = '幸运飞艇';
     break;
case 'cqssc': 
     $order = 'fn_sscorder'; 
     $games = '重庆时时彩';
     break;
case 'xy28': 
     $order = 'fn_pcorder';
     $games = '幸运28';
     break;
case 'jnd28': 
     $order = 'fn_pcorder';
     $games = '加拿大28';
     break;
case 'jsmt': 
     $order = "fn_mtorder";
     $games = '极速摩托';
     break;
case 'jssc': 
     $order = 'fn_jsscorder';
     $games = '极速赛车';
     break;
case 'jsssc':
     $order = 'fn_jssscorder'; 
     $games = '极速时时彩';
     break;
case 'kuai3':
     $order = 'fn_k3corder'; 
     $games = '江苏快三';
     break;
case 'bjl': 
     $order = 'fn_bjlorder';
     $games = '百家乐';
     break;
case '11x5':
     $order = 'fn_11x5order'; 
     $games = '广东11选5';
     break;
case 'jssm':
     $order = 'fn_smorder'; 
     $games = '极速赛马';
     break;
case 'lhc': 
     $order = 'fn_lhcorder'; 
     $games = '香港六合彩';
     break;
case 'jslhc':
     $order = 'fn_jslhcorder'; 
     $games = '极速六合彩';
     break;
case 'twk3':
     $order = 'fn_jslhcorder'; 
     $games = '台湾快三';
     break;
case 'txffc':
     $order = 'fn_jslhcorder'; 
     $games = '腾讯分分彩';
     break;
}
  
  $arr = get_query_vals($order,'*',array('id'=>$id));
  if($arr['status']>0){ 
    
  用户_下分($arr['userid'], $arr['status'], $roomid, $games, $arr['term'], $arr['mingci'].'/'.$arr['content'].'/'.$arr['money']);
   $status = '-'.$arr['money']; 
     update_query($order, array("mingci"=>$mingci,'content'=>$content,'status'=>$status), array('id'=>$id));
     update_query('fn_chat', array('content'=>$chat_id), array('chatid'=>$id));
     $arr['success'] = true;
  }else{
   echo json_encode(array('status'=>false,'msg' => '玩家已经为输，修改失败'));
    exit;
  } 
}
echo json_encode($arr);
?>