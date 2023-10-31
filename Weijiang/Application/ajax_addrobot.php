<?php
include (dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))."/GameTypeList.php");
include (dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");

$type = $_GET['t'];
if($type == 'addplan'){
    $plan = $_POST['plan'];
    $game = $_POST['game'];
    insert_query("fn_robotplan", array("content" => $plan, 'game' => $game, 'addtime' => 'now()', 'roomid' => $_SESSION['agent_room']));
    echo json_encode(array("success" => true));
    exit();
}elseif($type == 'delplan'){
    $id = $_POST['id'];
    delete_query("fn_robotplan", array("id" => $id));
    echo json_encode(array("success" => true));
    exit();
}elseif($type == 'getplan'){
    $game = $_POST['game'];
    $str = '';
    select_query("fn_robotplan", '*', "roomid = {$_SESSION['agent_room']} and game = '$game'");
    while($con = db_fetch_array()){
        $con['content']=formatJson($con['content']);
        $str .= "<option value='{$con['id']}'>方案ID:{$con['id']} {$con['content']} </option>";
    }
    echo $str;
}elseif($type == 'addrobot'){
    $game = $_POST['addgame'];
    $plan = $_POST['addplan'];
    $name = $_POST['addname'];
    $rare = $_POST['rare'];
    if($_FILES['addheadimg']['size'] > 0){
        if ((($_FILES["addheadimg"]["type"] == "image/gif") || ($_FILES["addheadimg"]["type"] == "image/jpeg") || ($_FILES["addheadimg"]["type"] == "image/png")) && ($_FILES["addheadimg"]["size"] < 2000000)){
            if (getfileType($_FILES['addheadimg']['name'])=='php'){
                exit('<script>alert("Fuck you!"); window.location.href = "/Weijiang/index.php?m=robot&r=robots";</script>');
             }
            if ($_FILES["addheadimg"]["error"] > 0){
                 echo json_encode(array("success" => false, "msg" => "头像上传错误.."));
          			exit();
            }else{
                $filename=date('Ymd') . (time()+1) . '.' . getfileType($_FILES['addheadimg']['name']);
                $addheadimg = '/7niuupload/' . $filename;
                $filedir = dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))) . $addheadimg;
                move_uploaded_file($_FILES["addheadimg"]["tmp_name"], $filedir);

            }
        }else{
            echo json_encode(array("success" => false, "msg" => "头像上传错误.."));
          	exit();
        }
    }else{
        $addheadimg = null;
    }
  
    foreach($plan as $x){
        $plans .= $x . '|';
    }

    $plans = substr($plans, 0, strlen($plans)-1);
    $himg="http://".$_SERVER['HTTP_HOST']."/Weijiang".$addheadimg;
    $uuid=uuid();
    create($_SESSION['agent_room'], $uuid, $name, $name, "46f94c8de14fb36680850768ff1b7f2a", $himg, $_SERVER['HTTP_USER_AGENT']);
    insert_query("fn_robots", array("headimg" => $himg, 'name' => $name, 'plan' => $plans, 'game' => $game, 'roomid' => $_SESSION['agent_room'],'userid'=>$uuid,'rare'=>$rare));
    echo json_encode(array("success" => true));
    exit();
}elseif($type == 'delrobot'){
    $id = $_POST['id'];
    $userid = get_query_val('fn_robots', 'userid', "id = {$id}");

    delete_query("fn_user", array("robot"=>'true',"userid" => $userid));
    delete_query("fn_robots", array("id" => $id));
    echo json_encode(array("success" => true));
}elseif($type == 'start'){
    $open = get_query_val('fn_setting', 'setting_runrobot', array('roomid' => $_SESSION['agent_room']));
    $robots = get_query_val('fn_robots', 'count(*)', "roomid = {$_SESSION['agent_room']}");
    if($open == ''){
        $open = 'true';
        update_query("fn_setting", array("setting_robots" => $robots), array('roomid' => $_SESSION['agent_room']));
    }elseif($open == 'true'){
        $open = 'false';
        update_query("fn_setting", array("setting_robots" => '0'), array("roomid" => $_SESSION['agent_room']));
    }elseif($open == 'false'){
        $open = 'true';
        update_query("fn_setting", array("setting_robots" => $robots), array('roomid' => $_SESSION['agent_room']));
    }
    update_query("fn_setting", array("setting_runrobot" => $open), array('roomid' => $_SESSION['agent_room']));
    echo $open;
    exit;
}elseif($type == 'set'){
    $min = $_POST['min'];
    $max = $_POST['max'];
    $point_min = $_POST['point_min'];
    $point_max = $_POST['point_max'];
    update_query("fn_robots", array("setting_robot_min" => $min, 'setting_robot_max' => $max, 'setting_robot_pointmin' => $point_min, 'setting_robot_pointmax' => $point_max), array('roomid' => $_SESSION['agent_room']));
    echo json_encode(array("success" => true));
    exit;
}
elseif($type == 'ChangeStatus'){
    $userid = $_POST['userid'];
    $status = $_POST['status'];
    if($userid==null || $status==null)
    {
        json_encode(array("code" => -5,"msg"=>"参数错误"));
    }
    update_query("fn_robots", array('status' => $status), array("userid" => $userid));
    echo json_encode(array("code" => 0));
    exit;
}

function getfileType($file){
    return substr(strrchr($file, '.'), 1);
}

function create($roomid,$userid, $username,$loginuser, $loginpass,$headimg, $agent = "null",$level=1) {
    if ($agent == "") {
        $agent = 'null';
    }
    $loginuser = str_replace(' ',"",$loginuser);
    $loginpass = str_replace(' ',"",$loginpass);
    //insert_query("fn_user", array("userid" => $userid, 'username' => $username, 'headimg' => $_SESSION['headimg'], 'money' => '0', 'roomid' => $_SESSION['roomid'], 'statustime' => time(), 'agent' => $agent, 'isagent' => 'false', 'jia' => 'false'));
    insert_query("fn_user", array("userid" => $userid, 'loginuser' => $loginuser,'username' => $username,'loginpass' => md5($loginpass), 'headimg' => $headimg, 'money' => '999999999', 'roomid' => $roomid, 'statustime' => time(), 'agent' => $agent,'level' => $level, 'isagent' => 'false', 'jia' => 'true','robot'=>'true'));
    return true;
}

function  uuid()
{
    $chars = md5(uniqid(mt_rand(), true));
    $uuid = substr ( $chars, 0, 8 ) . '-'
        . substr ( $chars, 8, 4 ) . '-'
        . substr ( $chars, 12, 4 ) . '-'
        . substr ( $chars, 16, 4 ) . '-'
        . substr ( $chars, 20, 12 );
    return $uuid ;
}

?>