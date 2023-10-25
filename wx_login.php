<?php
include_once('Public/config.php');


$openid=$_GET['userid'];
$nickname=$_GET['nickname'];
$headimg=$_GET['headimg'];
$agent=$_GET['agent'];
$room=$_GET['room'];
        
if(empty($openid) || empty($nickname) || empty($headimg) || empty($agent) || empty($room))
{
    echo "参数错误";
}
else
{
    $_SESSION['userid'] = $openid;
    $_SESSION['username'] = $nickname;
    $_SESSION['headimg'] = $headimg;
    $_SESSION['agent'] =  $agent;
    $_SESSION['roomid']=$room;
    if (U_isOK($openid, $headimg)) {
        $r = $mydb->table('fn_user')->where(array(
            'userid' => $openid
        ))->find();
        auto_login($r['id']);
        // var_dump("Location: qr.php?room=" . $room."&agent=".$agent."&userid=".$openid."&username=".$nickname."&headimg=".$headimg);
          header("Location: qr.php?room=" . $room."&agent=".$agent."&userid=".$openid."&username=".$nickname."&headimg=".$headimg);
    } else {
        U_create($openid, $nickname, $headimg, $agent);
        $r = $mydb->table('fn_user')->where(array(
            'userid' => $openid
        ))->find();
        auto_login($r['id']);
        header("Location: qr.php?room=" . $room."&agent=".$agent."&userid=".$openid."&username=".$nickname."&headimg=".$headimg);
        //   var_dump("22Location: qr.php?room=" . $room."&agent=".$agent."&userid=".$openid."&username=".$nickname."&headimg=".$headimg);
    }

}




// if (empty($_SESSION['userid'])) {
//     if (!empty($_GET['code'])) {
//         $token = wx_gettoken($wx['ID'], $wx['key'], $_GET['code']);
//         $userinfo = wx_getinfo($token['token'], $token['openid']);
        
        
//         if (U_isOK($token['openid'], $userinfo['headimg'])) {
//             $r = $mydb->table('fn_user')->where(array(
//                 'userid' => $token['openid']
//             ))->find();
//             auto_login($r['id']);
//                header("Location: qr.php?room=" . $_GET['room']."&code=".$_GET['code']."&agent=".$_GET['agent']);
//         } else {
//             U_create($token['openid'], $userinfo['nickname'], $userinfo['headimg'], $_COOKIE['agent']);
//             $r = $mydb->table('fn_user')->where(array(
//                 'userid' => $token['openid']
//             ))->find();
//             auto_login($r['id']);
//               header("Location: qr.php?room=" . $_GET['room']."&code=".$_GET['code']."&agent=".$_GET['agent']);
//         }
//     } else {
//         header("Location:" . $oauth);
//     }
// } else {

//         //   header("Location:" . $oauth);
//     if(empty($_GET['code']) || $_GET['code']==''){
//         header("Location:" . $oauth);
//     }
//     else {
//           header("Location: qr.php?room=" . $_GET['room']."&code=".$_GET['code']."&agent=".$_GET['agent']);
//     }
  
// }

?>