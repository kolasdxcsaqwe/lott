<?php
//session_start();
include dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php";
require "function.php";
    global $mydb;
    $sing_time =$_POST['sing_time'];

 /*   $_SESSION['userid']==0;
    $s_userid = $_SESSION['userid'];
        if ($s_userid == '') {
            echo json_encode(array('res'=>-1,'msg'=>'请先登录'));
            exit;
    }*/
        $s_day = get_weeks();
        $jinbi = get_query_vals('fn_sign_set','*',array('id'=>2));
      	$info_singset['s_1'] = $jinbi['s_1'];
      	$info_singset['s_2'] = $jinbi['s_2'];
      	$info_singset['s_3'] = $jinbi['s_3'];
      	$info_singset['s_4'] = $jinbi['s_4'];
      	$info_singset['s_5'] = $jinbi['s_5'];
      	$info_singset['s_6'] = $jinbi['s_6'];
      	$info_singset['s_7'] = $jinbi['s_7'];
       // $info_singset = $mydb->table('fn_sign_set')->field('*')->where(array('id' => 1))->find();//get_query_vals('fn_sign_set', '*', array('id' => 1));//
         $_SESSION['singset']=$info_singset;
        $lx_day_momney_ = $info_singset;
        $lx_day_momney = !empty($info_singset) ? $info_singset :  $lx_day_momney_;
        $n_day = count($s_day)+1;
        $k_ = 's_'.$n_day;
        if ($sing_time <10) {
        $sing_time=sprintf ( "%02d",$sing_time);
        } 
        $sing_time =date("Ym" . $sing_time . ""); 

       if (getSign_status($sing_time)) {

         echo json_encode(array('res'=>1,'msg'=>'已签到成功','money'=>0),true);//已签到成功
         exit;
        }else{

        $data['sing_time'] = $sing_time;
        $data['userid'] = $_SESSION['userid'];
        $data['money'] =  $lx_day_momney[$k_];
        $user_money = $mydb->table('fn_user')->field('money')->where(array("userid" => $_SESSION['userid']))->find();//
        $lx_day_momney_=floatval($lx_day_momney[$k_]);
       
        $data_['money'] = $lx_day_momney_+ $user_money['money'];
        $r =insert_query("fn_sign", $data);

        if ($r) {
            $r = update_query("fn_user",$data_, array("userid" => $_SESSION['userid']));
           echo json_encode(array('res'=>1,'msg'=>'连续签到'.$n_day.'天,获得'.$lx_day_momney[$k_].'金币奖励','money'=>20),true);//签到成功
           exit;
        }else{
            echo json_encode(array('res'=>0,'msg'=>'签到失败'),true);//签到失败
            exit;
        }
        


    }

/*$info = getinfo($_SESSION['userid']);

$s_userid = $_SESSION['userid'];
        if ($s_userid == '') {
            echo -1;
            exit;
        }
        $data['addtime'] = strtotime(date("Y-m-d 00:00:00"));
        $data['uid'] = $s_userid;
        //$info = M('sign')->field("id")->where("addtime = " . $data['addtime'] . " AND uid = " . $data['uid'] . " AND status = 0")->find();//判断是否签到过
$info = get_query_val('fn_sign', 'id', array('addtime' => $data['addtime'],'uid'=>$data['uid'],'status'=>0));


        if (empty($info)) { //若是未签到则去签到
            $data['money'] = 20;
            //$lastid = M('sign')->add($data);
            insert_query("fn_sign", $data);
            if ($lastid > 0) {
//                addPoints("day_sign", $data['money'], $s_userid, "每日签到获得" . $data['money'] . "积分", 5, 1);
                echo $data['money'];
            }
        } else {
            echo -1;
        }
        */
?>

