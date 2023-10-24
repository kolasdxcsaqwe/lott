<?php
include(dirname(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__))))) . "/Public/config.php");
if($_GET['form'] == 'form1'){
	$shengxiao = $_POST['peilv_shengxiao'];
	$shengxiaonian = $_POST['peilv_shengxiaonian'];
	
    $da = $_POST['peilv_da'];
    $xiao = $_POST['peilv_xiao'];
    $dan = $_POST['peilv_dan'];
    $shuang = $_POST['peilv_shuang'];
	
    $hongbo = $_POST['peilv_hongbo'];
	$lanbo = $_POST['peilv_lanbo'];
	$lvbo = $_POST['peilv_lvbo'];
	
    $haoma = $_POST['peilv_haoma'];
	 $zhengma = $_POST['peilv_zhengma'];
    $xiao2 = $_POST['peilv_xiao2'];
	$xiao2nian = $_POST['peilv_xiao2nian'];
    $xiao3 = $_POST['peilv_xiao3'];
	$xiao3nian = $_POST['peilv_xiao3nian'];
    $xiao4 = $_POST['peilv_xiao4'];
	$xiao4nian = $_POST['peilv_xiao4nian'];
	$xiao5 = $_POST['peilv_xiao5'];
	$xiao5nian = $_POST['peilv_xiao5nian'];
	
    $zheng2 = $_POST['peilv_zheng2'];
	$zheng3 = $_POST['peilv_zheng3'];
	$zheng4 = $_POST['peilv_zheng4'];
	
    update_query("fn_lottery13", array("shengxiao" => $shengxiao, "shengxiaonian" => $shengxiaonian, "da" => $da, 'xiao' => $xiao, 'dan' => $dan, 'shuang' => $shuang, 'hongbo' => $hongbo, 'lanbo' => $lanbo, 'lvbo' => $lvbo, 'haoma' => $haoma, 'zhengma' => $zhengma, 'xiao2' => $xiao2, 'xiao3' => $xiao3, 'xiao4' => $xiao4, 'xiao5' => $xiao5, 'xiao2nian' => $xiao2nian, 'xiao3nian' => $xiao3nian, 'xiao4nian' => $xiao4nian, 'xiao5nian' => $xiao5nian, 'zheng2' => $zheng2, 'zheng3' => $zheng3, 'zheng4' => $zheng4), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=g_setting&g=lhc";</script>';
}elseif($_GET['form'] == 'form2'){
	$shengxiao_min = $_POST['shengxiao_min'];
    $shengxiao_max = $_POST['shengxiao_max'];
    $daxiao_min = $_POST['daxiao_min'];
    $daxiao_max = $_POST['daxiao_max'];
    $danshuang_min = $_POST['danshuang_min'];
    $danshuang_max = $_POST['danshuang_max'];
	$sebo_min = $_POST['sebo_min'];
    $sebo_max = $_POST['sebo_max'];
    $haoma_min = $_POST['haoma_min'];
    $haoma_max = $_POST['haoma_max'];
    $lianxiao_min = $_POST['lianxiao_min'];
    $lianxiao_max = $_POST['lianxiao_max'];
    $lianma_min = $_POST['lianma_min'];
    $lianma_max = $_POST['lianma_max'];
    update_query("fn_lottery13", array("shengxiao_min" => $shengxiao_min, 'shengxiao_max' => $shengxiao_max,"daxiao_min" => $daxiao_min, 'daxiao_max' => $daxiao_max, 'danshuang_min' => $danshuang_min, 'danshuang_max' => $danshuang_max, 'sebo_min' => $sebo_min, 'sebo_max' => $sebo_max, 'haoma_min' => $haoma_min, 'haoma_max' => $haoma_max, 'lianxiao_min' => $lianxiao_min, 'lianxiao_max' => $lianxiao_max, 'lianma_min' => $lianma_min, 'lianma_max' => $lianma_max), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=g_setting&g=lhc";</script>';
}elseif($_GET['form'] == 'form3'){
    $open = $_POST['opengame'] == 'on' ? 'true' : 'false';
    $fengtime = $_POST['fengtime'];
    update_query("fn_lottery13", array("fengtime" => $fengtime, 'gameopen' => $open), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=g_setting&g=lhc";</script>';
}elseif($_GET['form'] == 'form4'){
    $content = $_POST['customcont'];
    update_query("fn_lottery13", array("rules" => $content), array('roomid' => $_SESSION['agent_room']));
    echo '<script>alert("保存成功~感谢使用!"); window.location.href="/Weijiang/index.php?m=g_setting&g=lhc";</script>';
}
?>