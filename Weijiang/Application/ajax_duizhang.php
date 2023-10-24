<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
function getfileType($file){
    return substr(strrchr($file, '.'), 1);
}

    $yinhang = $_POST['yinhang'];
    $zhanghao = $_POST['zhanghao'];
    $huming = $_POST['huming'];

    if($_FILES['zhifubaoimg']['size'] > 0){
        if ((($_FILES['zhifubaoimg']['type'] == 'image/gif') || ($_FILES['zhifubaoimg']['type'] == 'image/jpeg') || ($_FILES['zhifubaoimg']['type'] == 'image/png')) && ($_FILES['zhifubaoimg']['size'] < 2000000)){
            if ($_FILES['zhifubaoimg']['error'] > 0){
                echo '<script>alert("上传文件出错..错误代码:' . $_FILES['zhifubaoimg']['error'] . '"); window.location.href = "/Weijiang/index.php?m=manage&a=duizhang";</script>';
            }else{
                $zhifubaoimg = '/Weijiang/upload/' . date('Ymd') . time() . '.' . getfileType($_FILES['zhifubaoimg']['name']);
                $filedir = dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . $zhifubaoimg;
                move_uploaded_file($_FILES['zhifubaoimg']['tmp_name'], $filedir);
            }
        }else{
            echo "支付宝二维码上传错误..<br />";
        }
    }else{
        $zhifubaoimg = null;
    }
    if($_FILES['weixinimg']['size'] > 0){
        if ((($_FILES['weixinimg']['type'] == 'image/gif') || ($_FILES['weixinimg']['type'] == 'image/jpeg') || ($_FILES['weixinimg']['type'] == 'image/png')) && ($_FILES['weixinimg']['size'] < 2000000)){
            if ($_FILES['weixinimg']['error'] > 0){
                echo '<script>alert("上传文件出错..错误代码:' . $_FILES['weixinimg']['error'] . '"); window.location.href="/Weijiang/index.php?m=manage&a=duizhang";</script>';
            }else{
                $weixinimg = '/Weijiang/upload/' . date('Ymd') . (time() + 1) . '.' . getfileType($_FILES['weixinimg']['name']);
                $filedir = dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . $weixinimg;
                move_uploaded_file($_FILES['weixinimg']['tmp_name'], $filedir);
            }
        }else{
            echo "微信二维码上传错误.. <br />";
        }
    }else{
        $weixinimg = null;
    }
    
  
    if($zhifubaoimg != null)update_query('fn_room',array('zhiewm' => $zhifubaoimg), array('roomid' => $_SESSION['agent_room']));
    if($weixinimg != null)update_query('fn_room',array('weiewm' => $weixinimg), array('roomid' => $_SESSION['agent_room']));

    update_query("fn_room",array("kaihuhang" => $yinhang, 'yinhang' => $huming,'yinhanghao' => $zhanghao), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=manage&a=duizhang";</script>';

?>