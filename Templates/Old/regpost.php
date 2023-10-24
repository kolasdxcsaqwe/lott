<?php 
header("Content-Type: text/html;charset=utf-8");
include_once('../../Public/config.php');

    $phone = $_POST['phone'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    
    if($phone == ''){
    echo '<script>alert("请填下账号"); window.location.href = "/Templates/Old/reg.php";</script>';
      exit;
    }elseif($pass1 == ''){
    echo '<script>alert("请填下密码"); window.location.href = "/Templates/Old/reg.php";</script>';
      exit;
    }elseif($pass1 == ''){
    echo '<script>alert("请填下密码"); window.location.href = "/Templates/Old/reg.php";</script>';
      exit;
    }elseif($pass1 != $pass2){
    echo '<script>alert("两次密码不一致，请核对输入.."); window.location.href = "/Templates/Old/reg.php";</script>';
      exit;
    }elseif((get_query_val('fn_user', 'loginuser', array("loginuser"=>$phone))) != ''){
    echo '<script>alert("账号已存在，请重新输入.."); window.location.href = "/Templates/Old/reg.php";</script>';
      exit;
    }else{
        update_query('fn_user',array("loginuser"=>$phone,'loginpass'=>md5($pass1)),array('userid'=>$_SESSION['userid'],'roomid'=>$_SESSION['roomid']));
        echo '<script>alert("注册成功"); window.location.href = "/Templates/Old/appdown.php";</script>';
        exit;
    }  
?>