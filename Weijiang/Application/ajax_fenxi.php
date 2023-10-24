<?php
include(dirname(dirname(dirname(preg_replace('@\(.*\(.*$@', '', __FILE__)))) . "/Public/config.php");
$room = $_SESSION['agent_room'];
$duichong = $_GET['dui'] == '' ? 'false' : 'true';
if($_GET['t'] == 'getterm'){
   if($_GET['code'] == 'jsmt'){
        $term = get_query_val('fn_open', 'next_term', "type = 6 order by term desc limit 1");
        $money = (int)get_query_val('fn_mtorder', 'sum(`money`)', "status = '未结算' and roomid = '$room' and term = '$term'");
    }
	
    echo $term . '|' . $money;
    exit();
}
if($_GET['code'] == 'jsmt'){ 
    $type = 6;  
    }
    $term = get_query_val('fn_open', 'next_term', "type = $type order by term desc limit 1");
    $yi = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '龙' => 0, '虎' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $er = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '龙' => 0, '虎' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $san = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '龙' => 0, '虎' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $si = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '龙' => 0, '虎' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $wu = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '龙' => 0, '虎' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $liu = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $qi = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $ba = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $jiu = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $shi = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '0' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0, '大单' => 0, '小单' => 0, '大双' => 0, '小双' => 0);
    $he = array('3' => 0, '4' => 0, '5' => 0, '6' => 0, '7' => 0, '8' => 0, '9' => 0, '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0, '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0, '大' => 0, '小' => 0, '单' => 0, '双' => 0);
    if($_GET['code'] == 'jsmt'){
    select_query('fn_mtorder', '*', "roomid = $room and `status` = '未结算' and term = '$term' and jia = 'false'");
}while($con = db_fetch_array()){
    if($con['mingci'] == '1'){
        switch($con['content']){
        case '1': $yi['1'] += $con['money'];
            break;
        case '2': $yi['2'] += $con['money'];
            break;
        case '3': $yi['3'] += $con['money'];
            break;
        case '4': $yi['4'] += $con['money'];
            break;
        case '5': $yi['5'] += $con['money'];
            break;
        case '6': $yi['6'] += $con['money'];
            break;
        case '7': $yi['7'] += $con['money'];
            break;
        case '8': $yi['8'] += $con['money'];
            break;
        case '9': $yi['9'] += $con['money'];
            break;
        case '0': $yi['0'] += $con['money'];
            break;
        case "大": $yi['大'] += $con['money'];
            break;
        case "小": $yi['小'] += $con['money'];
            break;
        case "单": $yi['单'] += $con['money'];
            break;
        case "双": $yi['双'] += $con['money'];
            break;
        case "龙": $yi['龙'] += $con['money'];
            break;
        case "虎": $yi['虎'] += $con['money'];
            break;
        case "小单": $yi['大单'] += $con['money'];
            break;
        case "大单": $yi['小单'] += $con['money'];
            break;
        case "小双": $yi['大双'] += $con['money'];
            break;
        case "大双": $yi['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '2'){
        switch($con['content']){
        case '1': $er['1'] += $con['money'];
            break;
        case '2': $er['2'] += $con['money'];
            break;
        case '3': $er['3'] += $con['money'];
            break;
        case '4': $er['4'] += $con['money'];
            break;
        case '5': $er['5'] += $con['money'];
            break;
        case '6': $er['6'] += $con['money'];
            break;
        case '7': $er['7'] += $con['money'];
            break;
        case '8': $er['8'] += $con['money'];
            break;
        case '9': $er['9'] += $con['money'];
            break;
        case '0': $er['0'] += $con['money'];
            break;
        case "大": $er['大'] += $con['money'];
            break;
        case "小": $er['小'] += $con['money'];
            break;
        case "单": $er['单'] += $con['money'];
            break;
        case "双": $er['双'] += $con['money'];
            break;
        case "龙": $er['龙'] += $con['money'];
            break;
        case "虎": $er['虎'] += $con['money'];
            break;
        case "小单": $er['大单'] += $con['money'];
            break;
        case "大单": $er['小单'] += $con['money'];
            break;
        case "小双": $er['大双'] += $con['money'];
            break;
        case "大双": $er['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '3'){
        switch($con['content']){
        case '1': $san['1'] += $con['money'];
            break;
        case '2': $san['2'] += $con['money'];
            break;
        case '3': $san['3'] += $con['money'];
            break;
        case '4': $san['4'] += $con['money'];
            break;
        case '5': $san['5'] += $con['money'];
            break;
        case '6': $san['6'] += $con['money'];
            break;
        case '7': $san['7'] += $con['money'];
            break;
        case '8': $san['8'] += $con['money'];
            break;
        case '9': $san['9'] += $con['money'];
            break;
        case '0': $san['0'] += $con['money'];
            break;
        case "大": $san['大'] += $con['money'];
            break;
        case "小": $san['小'] += $con['money'];
            break;
        case "单": $san['单'] += $con['money'];
            break;
        case "双": $san['双'] += $con['money'];
            break;
        case "龙": $san['龙'] += $con['money'];
            break;
        case "虎": $san['虎'] += $con['money'];
            break;
        case "小单": $san['大单'] += $con['money'];
            break;
        case "大单": $san['小单'] += $con['money'];
            break;
        case "小双": $san['大双'] += $con['money'];
            break;
        case "大双": $san['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '4'){
        switch($con['content']){
        case '1': $si['1'] += $con['money'];
            break;
        case '2': $si['2'] += $con['money'];
            break;
        case '3': $si['3'] += $con['money'];
            break;
        case '4': $si['4'] += $con['money'];
            break;
        case '5': $si['5'] += $con['money'];
            break;
        case '6': $si['6'] += $con['money'];
            break;
        case '7': $si['7'] += $con['money'];
            break;
        case '8': $si['8'] += $con['money'];
            break;
        case '9': $si['9'] += $con['money'];
            break;
        case '0': $si['0'] += $con['money'];
            break;
        case "大": $si['大'] += $con['money'];
            break;
        case "小": $si['小'] += $con['money'];
            break;
        case "单": $si['单'] += $con['money'];
            break;
        case "双": $si['双'] += $con['money'];
            break;
        case "龙": $si['龙'] += $con['money'];
            break;
        case "虎": $si['虎'] += $con['money'];
            break;
        case "小单": $si['大单'] += $con['money'];
            break;
        case "大单": $si['小单'] += $con['money'];
            break;
        case "小双": $si['大双'] += $con['money'];
            break;
        case "大双": $si['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '5'){
        switch($con['content']){
        case '1': $wu['1'] += $con['money'];
            break;
        case '2': $wu['2'] += $con['money'];
            break;
        case '3': $wu['3'] += $con['money'];
            break;
        case '4': $wu['4'] += $con['money'];
            break;
        case '5': $wu['5'] += $con['money'];
            break;
        case '6': $wu['6'] += $con['money'];
            break;
        case '7': $wu['7'] += $con['money'];
            break;
        case '8': $wu['8'] += $con['money'];
            break;
        case '9': $wu['9'] += $con['money'];
            break;
        case '0': $wu['0'] += $con['money'];
            break;
        case "大": $wu['大'] += $con['money'];
            break;
        case "小": $wu['小'] += $con['money'];
            break;
        case "单": $wu['单'] += $con['money'];
            break;
        case "双": $wu['双'] += $con['money'];
            break;
        case "龙": $wu['龙'] += $con['money'];
            break;
        case "虎": $wu['虎'] += $con['money'];
            break;
        case "小单": $wu['大单'] += $con['money'];
            break;
        case "大单": $wu['小单'] += $con['money'];
            break;
        case "小双": $wu['大双'] += $con['money'];
            break;
        case "大双": $wu['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '6'){
        switch($con['content']){
        case '1': $liu['1'] += $con['money'];
            break;
        case '2': $liu['2'] += $con['money'];
            break;
        case '3': $liu['3'] += $con['money'];
            break;
        case '4': $liu['4'] += $con['money'];
            break;
        case '5': $liu['5'] += $con['money'];
            break;
        case '6': $liu['6'] += $con['money'];
            break;
        case '7': $liu['7'] += $con['money'];
            break;
        case '8': $liu['8'] += $con['money'];
            break;
        case '9': $liu['9'] += $con['money'];
            break;
        case '0': $liu['0'] += $con['money'];
            break;
        case "大": $liu['大'] += $con['money'];
            break;
        case "小": $liu['小'] += $con['money'];
            break;
        case "单": $liu['单'] += $con['money'];
            break;
        case "双": $liu['双'] += $con['money'];
            break;
        case "小单": $liu['大单'] += $con['money'];
            break;
        case "大单": $liu['小单'] += $con['money'];
            break;
        case "小双": $liu['大双'] += $con['money'];
            break;
        case "大双": $liu['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '7'){
        switch($con['content']){
        case '1': $qi['1'] += $con['money'];
            break;
        case '2': $qi['2'] += $con['money'];
            break;
        case '3': $qi['3'] += $con['money'];
            break;
        case '4': $qi['4'] += $con['money'];
            break;
        case '5': $qi['5'] += $con['money'];
            break;
        case '6': $qi['6'] += $con['money'];
            break;
        case '7': $qi['7'] += $con['money'];
            break;
        case '8': $qi['8'] += $con['money'];
            break;
        case '9': $qi['9'] += $con['money'];
            break;
        case '0': $qi['0'] += $con['money'];
            break;
        case "大": $qi['大'] += $con['money'];
            break;
        case "小": $qi['小'] += $con['money'];
            break;
        case "单": $qi['单'] += $con['money'];
            break;
        case "双": $qi['双'] += $con['money'];
            break;
        case "小单": $qi['大单'] += $con['money'];
            break;
        case "大单": $qi['小单'] += $con['money'];
            break;
        case "小双": $qi['大双'] += $con['money'];
            break;
        case "大双": $qi['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '8'){
        switch($con['content']){
        case '1': $ba['1'] += $con['money'];
            break;
        case '2': $ba['2'] += $con['money'];
            break;
        case '3': $ba['3'] += $con['money'];
            break;
        case '4': $ba['4'] += $con['money'];
            break;
        case '5': $ba['5'] += $con['money'];
            break;
        case '6': $ba['6'] += $con['money'];
            break;
        case '7': $ba['7'] += $con['money'];
            break;
        case '8': $ba['8'] += $con['money'];
            break;
        case '9': $ba['9'] += $con['money'];
            break;
        case '0': $ba['0'] += $con['money'];
            break;
        case "大": $ba['大'] += $con['money'];
            break;
        case "小": $ba['小'] += $con['money'];
            break;
        case "单": $ba['单'] += $con['money'];
            break;
        case "双": $ba['双'] += $con['money'];
            break;
        case "小单": $ba['大单'] += $con['money'];
            break;
        case "大单": $ba['小单'] += $con['money'];
            break;
        case "小双": $ba['大双'] += $con['money'];
            break;
        case "大双": $ba['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '9'){
        switch($con['content']){
        case '1': $jiu['1'] += $con['money'];
            break;
        case '2': $jiu['2'] += $con['money'];
            break;
        case '3': $jiu['3'] += $con['money'];
            break;
        case '4': $jiu['4'] += $con['money'];
            break;
        case '5': $jiu['5'] += $con['money'];
            break;
        case '6': $jiu['6'] += $con['money'];
            break;
        case '7': $jiu['7'] += $con['money'];
            break;
        case '8': $jiu['8'] += $con['money'];
            break;
        case '9': $jiu['9'] += $con['money'];
            break;
        case '0': $jiu['0'] += $con['money'];
            break;
        case "大": $jiu['大'] += $con['money'];
            break;
        case "小": $jiu['小'] += $con['money'];
            break;
        case "单": $jiu['单'] += $con['money'];
            break;
        case "双": $jiu['双'] += $con['money'];
            break;
        case "小单": $jiu['大单'] += $con['money'];
            break;
        case "大单": $jiu['小单'] += $con['money'];
            break;
        case "小双": $jiu['大双'] += $con['money'];
            break;
        case "大双": $jiu['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '0'){
        switch($con['content']){
        case '1': $shi['1'] += $con['money'];
            break;
        case '2': $shi['2'] += $con['money'];
            break;
        case '3': $shi['3'] += $con['money'];
            break;
        case '4': $shi['4'] += $con['money'];
            break;
        case '5': $shi['5'] += $con['money'];
            break;
        case '6': $shi['6'] += $con['money'];
            break;
        case '7': $shi['7'] += $con['money'];
            break;
        case '8': $shi['8'] += $con['money'];
            break;
        case '9': $shi['9'] += $con['money'];
            break;
        case '0': $shi['0'] += $con['money'];
            break;
        case "大": $shi['大'] += $con['money'];
            break;
        case "小": $shi['小'] += $con['money'];
            break;
        case "单": $shi['单'] += $con['money'];
            break;
        case "双": $shi['双'] += $con['money'];
            break;
        case "小单": $shi['大单'] += $con['money'];
            break;
        case "大单": $shi['小单'] += $con['money'];
            break;
        case "小双": $shi['大双'] += $con['money'];
            break;
        case "大双": $shi['小双'] += $con['money'];
            break;
        }
        continue;
    }elseif($con['mingci'] == '和'){
        switch($con['content']){
        case '3': $he['3'] += $con['money'];
            break;
        case '4': $he['4'] += $con['money'];
            break;
        case '5': $he['5'] += $con['money'];
            break;
        case '6': $he['6'] += $con['money'];
            break;
        case '7': $he['7'] += $con['money'];
            break;
        case '8': $he['8'] += $con['money'];
            break;
        case '9': $he['9'] += $con['money'];
            break;
        case "10": $he['10'] += $con['money'];
            break;
        case "11": $he['11'] += $con['money'];
            break;
        case "12": $he['12'] += $con['money'];
            break;
        case "13": $he['13'] += $con['money'];
            break;
        case "14": $he['14'] += $con['money'];
            break;
        case "15": $he['15'] += $con['money'];
            break;
        case "16": $he['16'] += $con['money'];
            break;
        case "17": $he['17'] += $con['money'];
            break;
        case "18": $he['18'] += $con['money'];
            break;
        case "19": $he['19'] += $con['money'];
            break;
        case "大": $he['大'] += $con['money'];
            break;
        case "小": $he['小'] += $con['money'];
            break;
        case "单": $he['单'] += $con['money'];
            break;
        case "双": $he['双'] += $con['money'];
            break;
        }
        continue;
    }
}
if($duichong == 'true'){
    $arr = array($yi['1'], $yi['2'], $yi['3'], $yi['4'], $yi['5'], $yi['6'], $yi['7'], $yi['8'], $yi['9'], $yi['0']);
    sort($arr);
    $yi['1'] = $yi['1'] - $arr[0];
    $yi['2'] = $yi['2'] - $arr[0];
    $yi['3'] = $yi['3'] - $arr[0];
    $yi['4'] = $yi['4'] - $arr[0];
    $yi['5'] = $yi['5'] - $arr[0];
    $yi['6'] = $yi['6'] - $arr[0];
    $yi['7'] = $yi['7'] - $arr[0];
    $yi['8'] = $yi['8'] - $arr[0];
    $yi['9'] = $yi['9'] - $arr[0];
    $yi['0'] = $yi['0'] - $arr[0];
    $arr = array($er['1'], $er['2'], $er['3'], $er['4'], $er['5'], $er['6'], $er['7'], $er['8'], $er['9'], $er['0']);
    sort($arr);
    $er['1'] = $er['1'] - $arr[0];
    $er['2'] = $er['2'] - $arr[0];
    $er['3'] = $er['3'] - $arr[0];
    $er['4'] = $er['4'] - $arr[0];
    $er['5'] = $er['5'] - $arr[0];
    $er['6'] = $er['6'] - $arr[0];
    $er['7'] = $er['7'] - $arr[0];
    $er['8'] = $er['8'] - $arr[0];
    $er['9'] = $er['9'] - $arr[0];
    $er['0'] = $er['0'] - $arr[0];
    $arr = array($san['1'], $san['2'], $san['3'], $san['4'], $san['5'], $san['6'], $san['7'], $san['8'], $san['9'], $san['0']);
    sort($arr);
    $san['1'] = $san['1'] - $arr[0];
    $san['2'] = $san['2'] - $arr[0];
    $san['3'] = $san['3'] - $arr[0];
    $san['4'] = $san['4'] - $arr[0];
    $san['5'] = $san['5'] - $arr[0];
    $san['6'] = $san['6'] - $arr[0];
    $san['7'] = $san['7'] - $arr[0];
    $san['8'] = $san['8'] - $arr[0];
    $san['9'] = $san['9'] - $arr[0];
    $san['0'] = $san['0'] - $arr[0];
    $arr = array($si['1'], $si['2'], $si['3'], $si['4'], $si['5'], $si['6'], $si['7'], $si['8'], $si['9'], $si['0']);
    sort($arr);
    $si['1'] = $si['1'] - $arr[0];
    $si['2'] = $si['2'] - $arr[0];
    $si['3'] = $si['3'] - $arr[0];
    $si['4'] = $si['4'] - $arr[0];
    $si['5'] = $si['5'] - $arr[0];
    $si['6'] = $si['6'] - $arr[0];
    $si['7'] = $si['7'] - $arr[0];
    $si['8'] = $si['8'] - $arr[0];
    $si['9'] = $si['9'] - $arr[0];
    $si['0'] = $si['0'] - $arr[0];
    $arr = array($wu['1'], $wu['2'], $wu['3'], $wu['4'], $wu['5'], $wu['6'], $wu['7'], $wu['8'], $wu['9'], $wu['0']);
    sort($arr);
    $wu['1'] = $wu['1'] - $arr[0];
    $wu['2'] = $wu['2'] - $arr[0];
    $wu['3'] = $wu['3'] - $arr[0];
    $wu['4'] = $wu['4'] - $arr[0];
    $wu['5'] = $wu['5'] - $arr[0];
    $wu['6'] = $wu['6'] - $arr[0];
    $wu['7'] = $wu['7'] - $arr[0];
    $wu['8'] = $wu['8'] - $arr[0];
    $wu['9'] = $wu['9'] - $arr[0];
    $wu['0'] = $wu['0'] - $arr[0];
    $arr = array($liu['1'], $liu['2'], $liu['3'], $liu['4'], $liu['5'], $liu['6'], $liu['7'], $liu['8'], $liu['9'], $liu['0']);
    sort($arr);
    $liu['1'] = $liu['1'] - $arr[0];
    $liu['2'] = $liu['2'] - $arr[0];
    $liu['3'] = $liu['3'] - $arr[0];
    $liu['4'] = $liu['4'] - $arr[0];
    $liu['5'] = $liu['5'] - $arr[0];
    $liu['6'] = $liu['6'] - $arr[0];
    $liu['7'] = $liu['7'] - $arr[0];
    $liu['8'] = $liu['8'] - $arr[0];
    $liu['9'] = $liu['9'] - $arr[0];
    $liu['0'] = $liu['0'] - $arr[0];
    $arr = array($qi['1'], $qi['2'], $qi['3'], $qi['4'], $qi['5'], $qi['6'], $qi['7'], $qi['8'], $qi['9'], $qi['0']);
    sort($arr);
    $qi['1'] = $qi['1'] - $arr[0];
    $qi['2'] = $qi['2'] - $arr[0];
    $qi['3'] = $qi['3'] - $arr[0];
    $qi['4'] = $qi['4'] - $arr[0];
    $qi['5'] = $qi['5'] - $arr[0];
    $qi['6'] = $qi['6'] - $arr[0];
    $qi['7'] = $qi['7'] - $arr[0];
    $qi['8'] = $qi['8'] - $arr[0];
    $qi['9'] = $qi['9'] - $arr[0];
    $qi['0'] = $qi['0'] - $arr[0];
    $arr = array($ba['1'], $ba['2'], $ba['3'], $ba['4'], $ba['5'], $ba['6'], $ba['7'], $ba['8'], $ba['9'], $ba['0']);
    sort($arr);
    $ba['1'] = $ba['1'] - $arr[0];
    $ba['2'] = $ba['2'] - $arr[0];
    $ba['3'] = $ba['3'] - $arr[0];
    $ba['4'] = $ba['4'] - $arr[0];
    $ba['5'] = $ba['5'] - $arr[0];
    $ba['6'] = $ba['6'] - $arr[0];
    $ba['7'] = $ba['7'] - $arr[0];
    $ba['8'] = $ba['8'] - $arr[0];
    $ba['9'] = $ba['9'] - $arr[0];
    $ba['0'] = $ba['0'] - $arr[0];
    $arr = array($jiu['1'], $jiu['2'], $jiu['3'], $jiu['4'], $jiu['5'], $jiu['6'], $jiu['7'], $jiu['8'], $jiu['9'], $jiu['0']);
    sort($arr);
    $jiu['1'] = $jiu['1'] - $arr[0];
    $jiu['2'] = $jiu['2'] - $arr[0];
    $jiu['3'] = $jiu['3'] - $arr[0];
    $jiu['4'] = $jiu['4'] - $arr[0];
    $jiu['5'] = $jiu['5'] - $arr[0];
    $jiu['6'] = $jiu['6'] - $arr[0];
    $jiu['7'] = $jiu['7'] - $arr[0];
    $jiu['8'] = $jiu['8'] - $arr[0];
    $jiu['9'] = $jiu['9'] - $arr[0];
    $jiu['0'] = $jiu['0'] - $arr[0];
    $arr = array($shi['1'], $shi['2'], $shi['3'], $shi['4'], $shi['5'], $shi['6'], $shi['7'], $shi['8'], $shi['9'], $shi['0']);
    sort($arr);
    $shi['1'] = $shi['1'] - $arr[0];
    $shi['2'] = $shi['2'] - $arr[0];
    $shi['3'] = $shi['3'] - $arr[0];
    $shi['4'] = $shi['4'] - $arr[0];
    $shi['5'] = $shi['5'] - $arr[0];
    $shi['6'] = $shi['6'] - $arr[0];
    $shi['7'] = $shi['7'] - $arr[0];
    $shi['8'] = $shi['8'] - $arr[0];
    $shi['9'] = $shi['9'] - $arr[0];
    $shi['0'] = $shi['0'] - $arr[0];
    if($yi['大'] > $yi['小']){
        $yi['大'] = $yi['大'] - $yi['小'];
        $yi['小'] = 0;
    }elseif($yi['小'] > $yi['大']){
        $yi['小'] = $yi['小'] - $yi['大'];
        $yi['大'] = 0;
    }elseif($yi['大'] == $yi['小']){
        $yi['大'] = 0;
        $yi['小'] = 0;
    }
    if($yi['单'] > $yi['双']){
        $yi['单'] = $yi['单'] - $yi['双'];
        $yi['双'] = 0;
    }elseif($yi['双'] > $yi['单']){
        $yi['双'] = $yi['双'] - $yi['单'];
        $yi['单'] = 0;
    }elseif($yi['单'] == $yi['双']){
        $yi['单'] = 0;
        $yi['双'] = 0;
    }
    if($er['大'] > $er['小']){
        $er['大'] = $er['大'] - $er['小'];
        $er['小'] = 0;
    }elseif($er['小'] > $er['大']){
        $er['小'] = $er['小'] - $er['大'];
        $er['大'] = 0;
    }elseif($er['大'] == $er['小']){
        $er['大'] = 0;
        $er['小'] = 0;
    }
    if($er['单'] > $er['双']){
        $er['单'] = $er['单'] - $er['双'];
        $er['双'] = 0;
    }elseif($er['双'] > $er['单']){
        $er['双'] = $er['双'] - $er['单'];
        $er['单'] = 0;
    }elseif($er['单'] == $er['双']){
        $er['单'] = 0;
        $er['双'] = 0;
    }
    if($san['大'] > $san['小']){
        $san['大'] = $san['大'] - $san['小'];
        $san['小'] = 0;
    }elseif($san['小'] > $san['大']){
        $san['小'] = $san['小'] - $san['大'];
        $san['大'] = 0;
    }elseif($san['大'] == $san['小']){
        $san['大'] = 0;
        $san['小'] = 0;
    }
    if($san['单'] > $san['双']){
        $san['单'] = $san['单'] - $san['双'];
        $san['双'] = 0;
    }elseif($san['双'] > $san['单']){
        $san['双'] = $san['双'] - $san['单'];
        $san['单'] = 0;
    }elseif($san['单'] == $san['双']){
        $san['单'] = 0;
        $san['双'] = 0;
    }
    if($si['大'] > $si['小']){
        $si['大'] = $si['大'] - $si['小'];
        $si['小'] = 0;
    }elseif($si['小'] > $si['大']){
        $si['小'] = $si['小'] - $si['大'];
        $si['大'] = 0;
    }elseif($si['大'] == $si['小']){
        $si['大'] = 0;
        $si['小'] = 0;
    }
    if($si['单'] > $si['双']){
        $si['单'] = $si['单'] - $si['双'];
        $si['双'] = 0;
    }elseif($si['双'] > $si['单']){
        $si['双'] = $si['双'] - $si['单'];
        $si['单'] = 0;
    }elseif($si['单'] == $si['双']){
        $si['单'] = 0;
        $si['双'] = 0;
    }
    if($wu['大'] > $wu['小']){
        $wu['大'] = $wu['大'] - $wu['小'];
        $wu['小'] = 0;
    }elseif($wu['小'] > $wu['大']){
        $wu['小'] = $wu['小'] - $wu['大'];
        $wu['大'] = 0;
    }elseif($wu['大'] == $wu['小']){
        $wu['大'] = 0;
        $wu['小'] = 0;
    }
    if($wu['单'] > $wu['双']){
        $wu['单'] = $wu['单'] - $wu['双'];
        $wu['双'] = 0;
    }elseif($wu['双'] > $wu['单']){
        $wu['双'] = $wu['双'] - $wu['单'];
        $wu['单'] = 0;
    }elseif($wu['单'] == $wu['双']){
        $wu['单'] = 0;
        $wu['双'] = 0;
    }
    if($liu['大'] > $liu['小']){
        $liu['大'] = $liu['大'] - $liu['小'];
        $liu['小'] = 0;
    }elseif($liu['小'] > $liu['大']){
        $liu['小'] = $liu['小'] - $liu['大'];
        $liu['大'] = 0;
    }elseif($liu['大'] == $liu['小']){
        $liu['大'] = 0;
        $liu['小'] = 0;
    }
    if($liu['单'] > $liu['双']){
        $liu['单'] = $liu['单'] - $liu['双'];
        $liu['双'] = 0;
    }elseif($liu['双'] > $liu['单']){
        $liu['双'] = $liu['双'] - $liu['单'];
        $liu['单'] = 0;
    }elseif($liu['单'] == $liu['双']){
        $liu['单'] = 0;
        $liu['双'] = 0;
    }
    if($qi['大'] > $qi['小']){
        $qi['大'] = $qi['大'] - $qi['小'];
        $qi['小'] = 0;
    }elseif($qi['小'] > $qi['大']){
        $qi['小'] = $qi['小'] - $qi['大'];
        $qi['大'] = 0;
    }elseif($qi['大'] == $qi['小']){
        $qi['大'] = 0;
        $qi['小'] = 0;
    }
    if($qi['单'] > $qi['双']){
        $qi['单'] = $qi['单'] - $qi['双'];
        $qi['双'] = 0;
    }elseif($qi['双'] > $qi['单']){
        $qi['双'] = $qi['双'] - $qi['单'];
        $qi['单'] = 0;
    }elseif($qi['单'] == $qi['双']){
        $qi['单'] = 0;
        $qi['双'] = 0;
    }
    if($ba['大'] > $ba['小']){
        $ba['大'] = $ba['大'] - $ba['小'];
        $ba['小'] = 0;
    }elseif($ba['小'] > $ba['大']){
        $ba['小'] = $ba['小'] - $ba['大'];
        $ba['大'] = 0;
    }elseif($ba['大'] == $ba['小']){
        $ba['大'] = 0;
        $ba['小'] = 0;
    }
    if($ba['单'] > $ba['双']){
        $ba['单'] = $ba['单'] - $ba['双'];
        $ba['双'] = 0;
    }elseif($ba['双'] > $ba['单']){
        $ba['双'] = $ba['双'] - $ba['单'];
        $ba['单'] = 0;
    }elseif($ba['单'] == $ba['双']){
        $ba['单'] = 0;
        $ba['双'] = 0;
    }
    if($jiu['大'] > $jiu['小']){
        $jiu['大'] = $jiu['大'] - $jiu['小'];
        $jiu['小'] = 0;
    }elseif($jiu['小'] > $jiu['大']){
        $jiu['小'] = $jiu['小'] - $jiu['大'];
        $jiu['大'] = 0;
    }elseif($jiu['大'] == $jiu['小']){
        $jiu['大'] = 0;
        $jiu['小'] = 0;
    }
    if($jiu['单'] > $jiu['双']){
        $jiu['单'] = $jiu['单'] - $jiu['双'];
        $jiu['双'] = 0;
    }elseif($jiu['双'] > $jiu['单']){
        $jiu['双'] = $jiu['双'] - $jiu['单'];
        $jiu['单'] = 0;
    }elseif($jiu['单'] == $jiu['双']){
        $jiu['单'] = 0;
        $jiu['双'] = 0;
    }
    if($shi['大'] > $shi['小']){
        $shi['大'] = $shi['大'] - $shi['小'];
        $shi['小'] = 0;
    }elseif($shi['小'] > $shi['大']){
        $shi['小'] = $shi['小'] - $shi['大'];
        $shi['大'] = 0;
    }elseif($shi['大'] == $shi['小']){
        $shi['大'] = 0;
        $shi['小'] = 0;
    }
    if($shi['单'] > $shi['双']){
        $shi['单'] = $shi['单'] - $shi['双'];
        $shi['双'] = 0;
    }elseif($shi['双'] > $shi['单']){
        $shi['双'] = $shi['双'] - $shi['单'];
        $shi['单'] = 0;
    }elseif($shi['单'] == $shi['双']){
        $shi['单'] = 0;
        $shi['双'] = 0;
    }
    if($yi['龙'] > $yi['虎']){
        $yi['龙'] = $yi['龙'] - $yi['虎'];
        $yi['虎'] = 0;
    }elseif($yi['虎'] > $yi['龙']){
        $yi['虎'] = $yi['虎'] - $yi['龙'];
        $yi['龙'] = 0;
    }elseif($yi['龙'] == $yi['虎']){
        $yi['龙'] = 0;
        $yi['虎'] = 0;
    }
    if($er['龙'] > $er['虎']){
        $er['龙'] = $er['龙'] - $er['虎'];
        $er['虎'] = 0;
    }elseif($er['虎'] > $er['龙']){
        $er['虎'] = $er['虎'] - $er['龙'];
        $er['龙'] = 0;
    }elseif($er['龙'] == $er['虎']){
        $er['龙'] = 0;
        $er['虎'] = 0;
    }
    if($san['龙'] > $san['虎']){
        $san['龙'] = $san['龙'] - $san['虎'];
        $san['虎'] = 0;
    }elseif($san['虎'] > $san['龙']){
        $san['虎'] = $san['虎'] - $san['龙'];
        $san['龙'] = 0;
    }elseif($san['龙'] == $san['虎']){
        $san['龙'] = 0;
        $san['虎'] = 0;
    }
    if($si['龙'] > $si['虎']){
        $si['龙'] = $si['龙'] - $si['虎'];
        $si['虎'] = 0;
    }elseif($si['虎'] > $si['龙']){
        $si['虎'] = $si['虎'] - $si['龙'];
        $si['龙'] = 0;
    }elseif($si['龙'] == $si['虎']){
        $si['龙'] = 0;
        $si['虎'] = 0;
    }
    if($wu['龙'] > $wu['虎']){
        $wu['龙'] = $wu['龙'] - $wu['虎'];
        $wu['虎'] = 0;
    }elseif($wu['虎'] > $wu['龙']){
        $wu['虎'] = $wu['虎'] - $wu['龙'];
        $wu['龙'] = 0;
    }elseif($wu['龙'] == $wu['虎']){
        $wu['龙'] = 0;
        $wu['虎'] = 0;
    }
}
?>
<tr>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $yi['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $er['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $san['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $si['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $wu['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $liu['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $qi['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $ba['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $jiu['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_1">1</span></td>
  <td>
    <?php $m = $shi['1'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和3</span></td>
  <td>
    <?php $m = $he['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $yi['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $er['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $san['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $si['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $wu['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $liu['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $qi['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $ba['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $jiu['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_2">2</span></td>
  <td>
    <?php $m = $shi['2'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和4</span></td>
  <td>
    <?php $m = $he['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $yi['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $er['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $san['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $si['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $wu['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $liu['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $qi['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>   
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $ba['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $jiu['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_3">3</span></td>
  <td>
    <?php $m = $shi['3'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和5</span></td>
  <td>
    <?php $m = $he['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $yi['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $er['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $san['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $si['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $wu['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $liu['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $qi['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $ba['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $jiu['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_4">4</span></td>
  <td>
    <?php $m = $shi['4'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和6</span></td>
  <td>
    <?php $m = $he['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $yi['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $er['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $san['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $si['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $wu['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $liu['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $qi['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $ba['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $jiu['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_5">5</span></td>
  <td>
    <?php $m = $shi['5'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和7</span></td>
  <td>
    <?php $m = $he['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $yi['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $er['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $san['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $si['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $wu['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $liu['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $qi['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $ba['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $jiu['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_6">6</span></td>
  <td>
    <?php $m = $shi['6'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和8</span></td>
  <td>
    <?php $m = $he['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $yi['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $er['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $san['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $si['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $wu['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $liu['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $qi['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $ba['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $jiu['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_7">7</span></td>
  <td>
    <?php $m = $shi['7'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和9</span></td>
  <td>
    <?php $m = $he['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $yi['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $er['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $san['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $si['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $wu['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $liu['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $qi['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $ba['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $jiu['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_8">8</span></td>
  <td>
    <?php $m = $shi['8'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和10</span></td>
  <td>
    <?php $m = $he['10'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $yi['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $er['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $san['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $si['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $wu['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $liu['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $qi['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $ba['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $jiu['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_9">9</span></td>
  <td>
    <?php $m = $shi['9'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和11</span></td>
  <td>
    <?php $m = $he['11'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $yi['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $er['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $san['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $si['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $wu['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $liu['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $qi['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $ba['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $jiu['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td style="width:20px"><span class="pk_10">10</span></td>
  <td>
    <?php $m = $shi['0'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和12</span></td>
  <td>
    <?php $m = $he['12'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $yi['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $er['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $san['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $si['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $wu['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $liu['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $qi['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $ba['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $jiu['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大</span></td>
  <td>
    <?php $m = $shi['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和13</span></td>
  <td>
    <?php $m = $he['13'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $yi['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $er['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $san['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $si['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $wu['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $liu['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $qi['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $ba['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $jiu['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小</span></td>
  <td>
    <?php $m = $shi['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和14</span></td>
  <td>
    <?php $m = $he['14'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $yi['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $er['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $san['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $si['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $wu['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $liu['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $qi['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $ba['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $jiu['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">单</span></td>
  <td>
    <?php $m = $shi['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和15</span></td>
  <td>
    <?php $m = $he['15'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $yi['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $er['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $san['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $si['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $wu['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $liu['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>

    <?php $m = $qi['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $ba['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $jiu['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">双</span></td>
  <td>
    <?php $m = $shi['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和16</span></td>
  <td>
    <?php $m = $he['16'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $yi['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $er['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $san['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $si['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $wu['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $liu['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $qi['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $ba['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $jiu['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大单</span></td>
  <td>
    <?php $m = $shi['大单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和17</span></td>
  <td>
    <?php $m = $he['17'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $yi['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $er['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $san['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $si['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $wu['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $liu['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $qi['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $ba['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $jiu['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小单</span></td>
  <td>
    <?php $m = $shi['小单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和18</span></td>
  <td>
    <?php $m = $he['18'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $yi['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $er['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $san['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $si['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $wu['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $liu['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $qi['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $ba['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $jiu['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">大双</span></td>
  <td>
    <?php $m = $shi['大双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_he">和19</span></td>
  <td>
    <?php $m = $he['19'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $yi['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $er['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $san['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $si['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $wu['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $liu['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $qi['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $ba['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $jiu['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">小双</span></td>
  <td>
    <?php $m = $shi['小双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">和大</span></td>
  <td>
    <?php $m = $he['大'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_pink">龙</span></td>
  <td>
    <?php $m = $yi['龙'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">龙</span></td>
  <td>
    <?php $m = $er['龙'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">龙</span></td>
  <td>
    <?php $m = $san['龙'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">龙</span></td>
  <td>
    <?php $m = $si['龙'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_pink">龙</span></td>
  <td>
    <?php $m = $wu['龙'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td><span class="pk_blue">和小</span></td>
  <td>
    <?php $m = $he['小'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td><span class="pk_blue">虎</span></td>
  <td>
    <?php $m = $yi['虎'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">虎</span></td>
  <td>
    <?php $m = $er['虎'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">虎</span></td>
  <td>
    <?php $m = $san['虎'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">虎</span></td>
  <td>
    <?php $m = $si['虎'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td><span class="pk_blue">虎</span></td>
  <td>
    <?php $m = $wu['虎'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td><span class="pk_pink">和单</span></td>
  <td>
    <?php $m = $he['单'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td></td>
  <td><span class="pk_blue">和双</span></td>
  <td>
    <?php $m = $he['双'];
if($m > 0){
    echo '<span class="money_y">' . $m . '</span>';
}else{
    echo '<span class="money_n">0</span>';
}
?>
  </td>
</tr>