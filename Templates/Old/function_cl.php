<?
include_once("../../Public/config.php");
function SSC_WW($type,$roomid){
  $arr['大'] = array(5,6,7,8,9);
  $arr['小'] = array(0,1,2,3,4);
  $arr['单'] = array(1,3,5,7,9);
  $arr['双'] = array(0,2,4,6,8);
  
  $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
  
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 100");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 100");
  }
    while($con = db_fetch_array()){
        $cons[] = $con;
    }

	foreach($cons as $cod){
	  
      $code = $cod['code'];
      $cds = explode(',',$code);
      $hezhi = (int)$cds[0]+(int)$cds[1]+(int)$cds[2]+(int)$cds[3]+(int)$cds[4];
      $mc[1][1][] = (int)$cds[0] > 4 ? '大' : '小';
      $mc[1][2][] = (int)$cds[0] % 2 == 0 ? '双' : '单';
      $mc[1][3][] = (int)$cds[0] > (int)$cds[4] ? '龙':((int)$cds[0] == (int)$cds[4] ? '和': '虎');
      $mc[2][1][] = (int)$cds[1] > 4 ? '大' : '小';
      $mc[2][2][] = (int)$cds[1] % 2 == 0 ? '双' : '单';
      $mc[3][1][] = (int)$cds[2] > 4 ? '大' : '小';
      $mc[3][2][] = (int)$cds[2] % 2 == 0 ? '双' : '单';
      $mc[4][1][] = (int)$cds[3] > 4 ? '大' : '小';
      $mc[4][2][] = (int)$cds[3] % 2 == 0 ? '双' : '单';
      $mc[5][1][] = (int)$cds[4] > 4 ? '大' : '小';
      $mc[5][2][] = (int)$cds[4] % 2 == 0 ? '双' : '单';
      $gyds[] = $hezhi % 2 == 0 ? '双' : '单';
      $gydx[] = $hezhi > 22 ?  '大':'小';

     
      

	}
  
    $dydx = array_count_values($mc[1][1]);
   $dyds = array_count_values($mc[1][2]);
   //$dylh = array_count_values($mc[1][3]);
  /*
   if($dydx['大'] > $dydx['小']){
   $haoma1 = $arr['小'];
   }else{
   $haoma1 = $arr['大'];
   }
   if($dyds['单'] > $dyds['双']){
   $haoma2 = $arr['双'];
   }else{
   $haoma2 = $arr['单'];
   }
  */
   $arrcode = $dydx+$dyds;
  return $arrcode;
  
 
  
  /*
   $diyi1 = 0;
   $diyi2 = 0;
   $diyi3 = 0;
   $dier1 = 0;
   $dier2 = 0;
   $disan1 = 0;
   $disan2 = 0;
   $disi1 = 0;
   $disi2 = 0;
   $diwu1 = 0;
   $diwu2 = 0;
   $gyds1 = 0;
   $gydx1 = 0;

//第一名计算
   foreach($mc[1][1] as $val){
     if($val == '小'){
     $mc11 = '第一名小';  
     $diyi1++;
     }else{
     break;
     }  
   }
   if($diyi1 == 0){
   foreach($mc[1][1] as $val){
     if($val == '大'){
     $mc11 = '第一名大';  
     $diyi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[1][2] as $val){
     if($val == '单'){
     $mc12 = '第一名单';  
     $diyi2++;
     }else{
     break;
     }  
   }
   if($diyi2 == 0){
   foreach($mc[1][2] as $val){
     if($val == '双'){
     $mc12 = '第一名双';  
     $diyi2++;
     }else{
     break;
     }  
   }
   }
   foreach($mc[1][3] as $val){
     if($val == '龙'){
     $mc13 = '第一名龙';  
     $diyi3++;
     }else{
     break;
     }  
   }
   if($diyi3 == 0){
   foreach($mc[1][3] as $val){
     if($val == '虎'){
     $mc13 = '第一名虎';  
     $diyi3++;
     }else{
     break;
     }  
   }
   }
   if($diyi3 == 0){
   foreach($mc[1][3] as $val){
     if($val == '和'){
     $mc13 = '第一名和';  
     $diyi3++;
     }else{
     break;
     }  
   }
   }
//第二名计算 
   foreach($mc[2][1] as $val){
     if($val == '小'){
     $mc21 = '第二名小';  
     $dier1++;
     }else{
     break;
     }  
   }
   if($dier1 == 0){
   foreach($mc[2][1] as $val){
     if($val == '大'){
     $mc21 = '第二名大';  
     $dier1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[2][2] as $val){
     if($val == '单'){
     $mc22 = '第二名单';  
     $dier2++;
     }else{
     break;
     }  
   }
   if($dier2 == 0){
   foreach($mc[2][2] as $val){
     if($val == '双'){
     $mc22 = '第二名双';  
     $dier2++;
     }else{
     break;
     }  
   }
   }
//第三名计算
   foreach($mc[3][1] as $val){
     if($val == '小'){
     $mc31 = '第三名小';  
     $disan1++;
     }else{
     break;
     }  
   }
   if($disan1 == 0){
   foreach($mc[3][1] as $val){
     if($val == '大'){
     $mc31 = '第三名大';  
     $disan1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[3][2] as $val){
     if($val == '单'){
     $mc32 = '第三名单';  
     $disan2++;
     }else{
     break;
     }  
   }
   if($disan2 == 0){
   foreach($mc[3][2] as $val){
     if($val == '双'){
     $mc32 = '第三名双';  
     $disan2++;
     }else{
     break;
     }  
   }
   }

//第四名计算
   foreach($mc[4][1] as $val){
     if($val == '小'){
     $mc41 = '第四名小';  
     $disi1++;
     }else{
     break;
     }  
   }
   if($disi1 == 0){
   foreach($mc[4][1] as $val){
     if($val == '大'){
     $mc41 = '第四名大';  
     $disi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[4][2] as $val){
     if($val == '单'){
     $mc42 = '第四名单';  
     $disi2++;
     }else{
     break;
     }  
   }
   if($disi2 == 0){
   foreach($mc[4][2] as $val){
     if($val == '双'){
     $mc42 = '第四名双';  
     $disi2++;
     }else{
     break;
     }  
   }
   }
//第五名计算
   foreach($mc[5][1] as $val){
     if($val == '小'){
     $mc51 = '第五名小';  
     $diwu1++;
     }else{
     break;
     }  
   }
   if($diwu1 == 0){
   foreach($mc[5][1] as $val){
     if($val == '大'){
     $mc51 = '第五名大';  
     $diwu1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[5][2] as $val){
     if($val == '单'){
     $mc52 = '第五名单';  
     $diwu2++;
     }else{
     break;
     }  
   }
   if($diwu2 == 0){
   foreach($mc[5][2] as $val){
     if($val == '双'){
     $mc52 = '第五名双';  
     $diwu2++;
     }else{
     break;
     }  
   }
   }
   foreach($gyds as $val){
     if($val == '单'){
     $gyds11 = '总和单';  
     $gyds1++;
     }else{
     break;
     }  
   }
   if($gyds1 == 0){
   foreach($gyds as $val){
     if($val == '双'){
     $gyds11 = '总和双';  
     $gyds1++;
     }else{
     break;
     }  
   }
   }
  foreach($gydx as $val){
     if($val == '大'){
     $gydx11 = '总和大';  
     $gydx1++;
     }else{
     break;
     }  
   }
   if($gydx1 == 0){
   foreach($gydx as $val){
     if($val == '小'){
     $gydx11 = '总和小';  
     $gydx1++;
     }else{
     break;
     }  
   }
   }
   
 $aa = array($mc11=>$diyi1,$mc12=>$diyi2,$mc13=>$diyi3,$mc21=>$dier1,$mc22=>$dier2,$mc31=>$disan1,$mc32=>$disan2,$mc41=>$disi1,$mc42=>$disi2,$mc51=>$diwu1,$mc52=>$diwu2,$gyds11=>$gyds1,$gydx11=>$gydx1);
 arsort($aa);
  return $aa;
  */
}

function PK10_cl($type) {
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
  
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 20");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 20");
  }
    while($con = db_fetch_array()){
        $cons[] = $con;
    }

	foreach($cons as $cod){
	  
      $code = $cod['code'];
      $cds = explode(',',$code);
      $hezhi = (int)$cds[0]+(int)$cds[1];
      $mc[1][1][] = (int)$cds[0] > 5 ? '大' : '小';
      $mc[1][2][] = (int)$cds[0] % 2 == 0 ? '双' : '单';
      $mc[1][3][] = (int)$cds[0] > (int)$cds[9] ? '龙':((int)$cds[0] == (int)$cds[9] ? '和': '虎');
      $mc[2][1][] = (int)$cds[1] > 5 ? '大' : '小';
      $mc[2][2][] = (int)$cds[1] % 2 == 0 ? '双' : '单';
      $mc[2][3][] = (int)$cds[1] > (int)$cds[8] ? '龙':((int)$cds[0] == (int)$cds[9] ? '和': '虎');
      $mc[3][1][] = (int)$cds[2] > 5 ? '大' : '小';
      $mc[3][2][] = (int)$cds[2] % 2 == 0 ? '双' : '单';
      $mc[3][3][] = (int)$cds[2] > (int)$cds[7] ? '龙':((int)$cds[0] == (int)$cds[9] ? '和': '虎');
      $mc[4][1][] = (int)$cds[3] > 5 ? '大' : '小';
      $mc[4][2][] = (int)$cds[3] % 2 == 0 ? '双' : '单';
      $mc[4][3][] = (int)$cds[3] > (int)$cds[6] ? '龙':((int)$cds[0] == (int)$cds[9] ? '和': '虎');
      $mc[5][1][] = (int)$cds[4] > 5 ? '大' : '小';
      $mc[5][2][] = (int)$cds[4] % 2 == 0 ? '双' : '单';
      $mc[5][3][] = (int)$cds[4] > (int)$cds[5] ? '龙':((int)$cds[0] == (int)$cds[9] ? '和': '虎');
      $mc[6][1][] = (int)$cds[5] > 5 ? '大' : '小';
      $mc[6][2][] = (int)$cds[5] % 2 == 0 ? '双' : '单';
      $mc[7][1][] = (int)$cds[6] > 5 ? '大' : '小';
      $mc[7][2][] = (int)$cds[6] % 2 == 0 ? '双' : '单';
      $mc[8][1][] = (int)$cds[7] > 5 ? '大' : '小';
      $mc[8][2][] = (int)$cds[7] % 2 == 0 ? '双' : '单';
      $mc[9][1][] = (int)$cds[8] > 5 ? '大' : '小';
      $mc[9][2][] = (int)$cds[8] % 2 == 0 ? '双' : '单';
      $mc[10][1][] = (int)$cds[9] > 5 ? '大' : '小';
      $mc[10][2][] = (int)$cds[9] % 2 == 0 ? '双' : '单';
      $gyds[] = $hezhi % 2 == 0 ? '双' : '单';
      $gydx[] = $hezhi > 11 ?  '大':'小';
      

	}
   $diyi1 = 0;
   $diyi2 = 0;
   $diyi3 = 0;
   $dier1 = 0;
   $dier2 = 0;
   $dier3 = 0;
   $disan1 = 0;
   $disan2 = 0;
   $disan3 = 0;
   $disi1 = 0;
   $disi2 = 0;
   $disi3 = 0;
   $diwu1 = 0;
   $diwu2 = 0;
   $diwu3 = 0;
   $diliu1 = 0;
   $diliu2 = 0;
   $diqi1 = 0;
   $diqi2 = 0;
   $diba1 = 0;
   $dijiu1 = 0;
   $dijiu2 = 0;
   $dishi1 = 0;
   $dishi2 = 0;
   $gyds1 = 0;
   $gydx1 = 0;
//第一名计算
   foreach($mc[1][1] as $val){
     if($val == '小'){
     $mc11 = '第一名小';  
     $diyi1++;
     }else{
     break;
     }  
   }
   if($diyi1 == 0){
   foreach($mc[1][1] as $val){
     if($val == '大'){
     $mc11 = '第一名大';  
     $diyi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[1][2] as $val){
     if($val == '单'){
     $mc12 = '第一名单';  
     $diyi2++;
     }else{
     break;
     }  
   }
   if($diyi2 == 0){
   foreach($mc[1][2] as $val){
     if($val == '双'){
     $mc12 = '第一名双';  
     $diyi2++;
     }else{
     break;
     }  
   }
   }
   foreach($mc[1][3] as $val){
     if($val == '龙'){
     $mc13 = '第一名龙';  
     $diyi3++;
     }else{
     break;
     }  
   }
   if($diyi3 == 0){
   foreach($mc[1][3] as $val){
     if($val == '虎'){
     $mc13 = '第一名虎';  
     $diyi3++;
     }else{
     break;
     }  
   }
   }
   if($diyi3 == 0){
   foreach($mc[1][3] as $val){
     if($val == '和'){
     $mc13 = '第一名和';  
     $diyi3++;
     }else{
     break;
     }  
   }
   }
//第二名计算 
   foreach($mc[2][1] as $val){
     if($val == '小'){
     $mc21 = '第二名小';  
     $dier1++;
     }else{
     break;
     }  
   }
   if($dier1 == 0){
   foreach($mc[2][1] as $val){
     if($val == '大'){
     $mc21 = '第二名大';  
     $dier1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[2][2] as $val){
     if($val == '单'){
     $mc22 = '第二名单';  
     $dier2++;
     }else{
     break;
     }  
   }
   if($dier2 == 0){
   foreach($mc[2][2] as $val){
     if($val == '双'){
     $mc22 = '第二名双';  
     $dier2++;
     }else{
     break;
     }  
   }
   }
   foreach($mc[2][3] as $val){
     if($val == '龙'){
     $mc23 = '第二名龙';  
     $dier3++;
     }else{
     break;
     }  
   }
   if($dier3 == 0){
   foreach($mc[2][3] as $val){
     if($val == '虎'){
     $mc23 = '第二名虎';  
     $dier3++;
     }else{
     break;
     }  
   }
   }
   if($dier3 == 0){
   foreach($mc[2][3] as $val){
     if($val == '和'){
     $mc23 = '第二名和';  
     $dier3++;
     }else{
     break;
     }  
   }
   }
//第三名计算
   foreach($mc[3][1] as $val){
     if($val == '小'){
     $mc31 = '第三名小';  
     $disan1++;
     }else{
     break;
     }  
   }
   if($disan1 == 0){
   foreach($mc[3][1] as $val){
     if($val == '大'){
     $mc31 = '第三名大';  
     $disan1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[3][2] as $val){
     if($val == '单'){
     $mc32 = '第三名单';  
     $disan2++;
     }else{
     break;
     }  
   }
   if($disan2 == 0){
   foreach($mc[3][2] as $val){
     if($val == '双'){
     $mc32 = '第三名双';  
     $disan2++;
     }else{
     break;
     }  
   }
   }
   foreach($mc[3][3] as $val){
     if($val == '龙'){
     $mc33 = '第三名龙';  
     $disan3++;
     }else{
     break;
     }  
   }
   if($disan3 == 0){
   foreach($mc[3][3] as $val){
     if($val == '虎'){
     $mc33 = '第三名虎';  
     $disan3++;
     }else{
     break;
     }  
   }
   }
   if($disan3 == 0){
   foreach($mc[3][3] as $val){
     if($val == '和'){
     $mc33 = '第三名和';  
     $disan3++;
     }else{
     break;
     }  
   }
   }
//第四名计算
   foreach($mc[4][1] as $val){
     if($val == '小'){
     $mc41 = '第四名小';  
     $disi1++;
     }else{
     break;
     }  
   }
   if($disi1 == 0){
   foreach($mc[4][1] as $val){
     if($val == '大'){
     $mc41 = '第四名大';  
     $disi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[4][2] as $val){
     if($val == '单'){
     $mc42 = '第四名单';  
     $disi2++;
     }else{
     break;
     }  
   }
   if($disi2 == 0){
   foreach($mc[4][2] as $val){
     if($val == '双'){
     $mc42 = '第四名双';  
     $disi2++;
     }else{
     break;
     }  
   }
   }
   foreach($mc[4][3] as $val){
     if($val == '龙'){
     $mc43 = '第四名龙';  
     $disi3++;
     }else{
     break;
     }  
   }
   if($disi3 == 0){
   foreach($mc[4][3] as $val){
     if($val == '虎'){
     $mc43 = '第四名虎';  
     $disi3++;
     }else{
     break;
     }  
   }
   }
   if($disi3 == 0){
   foreach($mc[4][3] as $val){
     if($val == '和'){
     $mc43 = '第四名和';  
     $disi3++;
     }else{
     break;
     }  
   }
   }
//第五名计算
   foreach($mc[5][1] as $val){
     if($val == '小'){
     $mc51 = '第五名小';  
     $diwu1++;
     }else{
     break;
     }  
   }
   if($diwu1 == 0){
   foreach($mc[5][1] as $val){
     if($val == '大'){
     $mc51 = '第五名大';  
     $diwu1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[5][2] as $val){
     if($val == '单'){
     $mc52 = '第五名单';  
     $diwu2++;
     }else{
     break;
     }  
   }
   if($diwu2 == 0){
   foreach($mc[5][2] as $val){
     if($val == '双'){
     $mc52 = '第五名双';  
     $diwu2++;
     }else{
     break;
     }  
   }
   }
   foreach($mc[5][3] as $val){
     if($val == '龙'){
     $mc53 = '第五名龙';  
     $diwu3++;
     }else{
     break;
     }  
   }
   if($diwu3 == 0){
   foreach($mc[5][3] as $val){
     if($val == '虎'){
     $mc53 = '第五名虎';  
     $diwu3++;
     }else{
     break;
     }  
   }
   }
   if($diwu3 == 0){
   foreach($mc[5][3] as $val){
     if($val == '和'){
     $mc53 = '第五名和';  
     $diwu3++;
     }else{
     break;
     }  
   }
   }
//第六名计算
   foreach($mc[6][1] as $val){
     if($val == '小'){
     $mc61 = '第六名小';  
     $diliu1++;
     }else{
     break;
     }  
   }
   if($diliu1 == 0){
   foreach($mc[6][1] as $val){
     if($val == '大'){
     $mc61 = '第六名大';  
     $diliu1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[6][2] as $val){
     if($val == '单'){
     $mc62 = '第六名单';  
     $diliu2++;
     }else{
     break;
     }  
   }
   if($diliu2 == 0){
   foreach($mc[6][2] as $val){
     if($val == '双'){
     $mc62 = '第六名双';  
     $diliu2++;
     }else{
     break;
     }  
   }
   }
//第七名计算
   foreach($mc[7][1] as $val){
     if($val == '小'){
     $mc71 = '第七名小';  
     $diqi1++;
     }else{
     break;
     }  
   }
   if($diqi1 == 0){
   foreach($mc[7][1] as $val){
     if($val == '大'){
     $mc71 = '第七名大';  
     $diqi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[7][2] as $val){
     if($val == '单'){
     $mc72 = '第七名单';  
     $diqi2++;
     }else{
     break;
     }  
   }
   if($diqi2 == 0){
   foreach($mc[7][2] as $val){
     if($val == '双'){
     $mc72 = '第七名双';  
     $diqi2++;
     }else{
     break;
     }  
   }
   }
//第八名计算
   foreach($mc[8][1] as $val){
     if($val == '小'){
     $mc81 = '第八名小';  
     $diba1++;
     }else{
     break;
     }  
   }
   if($diba1 == 0){
   foreach($mc[8][1] as $val){
     if($val == '大'){
     $mc81 = '第八名大';  
     $diba1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[8][2] as $val){
     if($val == '单'){
     $mc82 = '第八名单';  
     $diba2++;
     }else{
     break;
     }  
   }
   if($diba2 == 0){
   foreach($mc[8][2] as $val){
     if($val == '双'){
     $mc82 = '第八名双';  
     $diba2++;
     }else{
     break;
     }  
   }
   }
//第九名计算
   foreach($mc[9][1] as $val){
     if($val == '小'){
     $mc91 = '第九名小';  
     $dijiu1++;
     }else{
     break;
     }  
   }
   if($dijiu1 == 0){
   foreach($mc[9][1] as $val){
     if($val == '大'){
     $mc91 = '第九名大';  
     $dijiu1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[9][2] as $val){
     if($val == '单'){
     $mc92 = '第九名单';  
     $dijiu2++;
     }else{
     break;
     }  
   }
   if($dijiu2 == 0){
   foreach($mc[9][2] as $val){
     if($val == '双'){
     $mc92 = '第九名双';  
     $dijiu2++;
     }else{
     break;
     }  
   }
   }
//第十名计算
   foreach($mc[10][1] as $val){
     if($val == '小'){
     $mc101 = '第十名小';  
     $dishi1++;
     }else{
     break;
     }  
   }
   if($dishi1 == 0){
   foreach($mc[10][1] as $val){
     if($val == '大'){
     $mc101 = '第十名大';  
     $dishi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[10][2] as $val){
     if($val == '单'){
     $mc102 = '第十名单';  
     $dishi2++;
     }else{
     break;
     }  
   }
   if($dishi2 == 0){
   foreach($mc[10][2] as $val){
     if($val == '双'){
     $mc102 = '第十名双';  
     $dishi2++;
     }else{
     break;
     }  
   }
   }
   foreach($gyds as $val){
     if($val == '单'){
     $gyds11 = '冠亚和单';  
     $gyds1++;
     }else{
     break;
     }  
   }
   if($gyds1 == 0){
   foreach($gyds as $val){
     if($val == '双'){
     $gyds11 = '冠亚和双';  
     $gyds1++;
     }else{
     break;
     }  
   }
   }
  foreach($gydx as $val){
     if($val == '大'){
     $gydx11 = '冠亚和大';  
     $gydx1++;
     }else{
     break;
     }  
   }
   if($gydx1 == 0){
   foreach($gydx as $val){
     if($val == '小'){
     $gydx11 = '冠亚和小';  
     $gydx1++;
     }else{
     break;
     }  
   }
   }
  
   
 $aa = array($mc11=>$diyi1,$mc12=>$diyi2,$mc13=>$diyi3,$mc21=>$dier1,$mc22=>$dier2,$mc23=>$dier3,$mc31=>$disan1,$mc32=>$disan2,$mc33=>$disan3,$mc41=>$disi1,$mc42=>$disi2,$mc43=>$disi3,$mc51=>$diwu1,$mc52=>$diwu2,$mc53=>$diwu3,$mc61=>$diliu1,$mc62=>$diliu2,$mc71=>$diqi1,$mc72=>$diqi2,$mc81=>$diba1,$mc82=>$diba2,$mc91=>$dijiu1,$mc92=>$dijiu2,$mc101=>$dishi1,$mc102=>$dishi2,$gyds11=>$gyds1,$gydx11=>$gydx1);
 arsort($aa);
  return $aa;
  }
  

function CQSSC_cl($type) {
    $kong = get_query_val('fn_lottery'.$type,'kongzhi',array('roomid'=>$roomid));
  
  if($kong == '1'){
   select_query("fn_sopen", '*', "`type` = '$type' and `roomid` = '$roomid' order by `term` desc limit 10");
  }else{
   select_query("fn_open", '*', "`type` = '$type' order by `term` desc limit 10");
  }
    while($con = db_fetch_array()){
        $cons[] = $con;
    }

	foreach($cons as $cod){
	  
      $code = $cod['code'];
      $cds = explode(',',$code);
      $hezhi = (int)$cds[0]+(int)$cds[1]+(int)$cds[2]+(int)$cds[3]+(int)$cds[4];
      $mc[1][1][] = (int)$cds[0] > 4 ? '大' : '小';
      $mc[1][2][] = (int)$cds[0] % 2 == 0 ? '双' : '单';
      $mc[1][3][] = (int)$cds[0] > (int)$cds[4] ? '龙':((int)$cds[0] == (int)$cds[4] ? '和': '虎');
      $mc[2][1][] = (int)$cds[1] > 4 ? '大' : '小';
      $mc[2][2][] = (int)$cds[1] % 2 == 0 ? '双' : '单';
      $mc[3][1][] = (int)$cds[2] > 4 ? '大' : '小';
      $mc[3][2][] = (int)$cds[2] % 2 == 0 ? '双' : '单';
      $mc[4][1][] = (int)$cds[3] > 4 ? '大' : '小';
      $mc[4][2][] = (int)$cds[3] % 2 == 0 ? '双' : '单';
      $mc[5][1][] = (int)$cds[4] > 4 ? '大' : '小';
      $mc[5][2][] = (int)$cds[4] % 2 == 0 ? '双' : '单';
      $gyds[] = $hezhi % 2 == 0 ? '双' : '单';
      $gydx[] = $hezhi > 22 ?  '大':'小';

     
      

	}
   $diyi1 = 0;
   $diyi2 = 0;
   $diyi3 = 0;
   $dier1 = 0;
   $dier2 = 0;
   $disan1 = 0;
   $disan2 = 0;
   $disi1 = 0;
   $disi2 = 0;
   $diwu1 = 0;
   $diwu2 = 0;
   $gyds1 = 0;
   $gydx1 = 0;

//第一名计算
   foreach($mc[1][1] as $val){
     if($val == '小'){
     $mc11 = '第一名小';  
     $diyi1++;
     }else{
     break;
     }  
   }
   if($diyi1 == 0){
   foreach($mc[1][1] as $val){
     if($val == '大'){
     $mc11 = '第一名大';  
     $diyi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[1][2] as $val){
     if($val == '单'){
     $mc12 = '第一名单';  
     $diyi2++;
     }else{
     break;
     }  
   }
   if($diyi2 == 0){
   foreach($mc[1][2] as $val){
     if($val == '双'){
     $mc12 = '第一名双';  
     $diyi2++;
     }else{
     break;
     }  
   }
   }
   foreach($mc[1][3] as $val){
     if($val == '龙'){
     $mc13 = '第一名龙';  
     $diyi3++;
     }else{
     break;
     }  
   }
   if($diyi3 == 0){
   foreach($mc[1][3] as $val){
     if($val == '虎'){
     $mc13 = '第一名虎';  
     $diyi3++;
     }else{
     break;
     }  
   }
   }
   if($diyi3 == 0){
   foreach($mc[1][3] as $val){
     if($val == '和'){
     $mc13 = '第一名和';  
     $diyi3++;
     }else{
     break;
     }  
   }
   }
//第二名计算 
   foreach($mc[2][1] as $val){
     if($val == '小'){
     $mc21 = '第二名小';  
     $dier1++;
     }else{
     break;
     }  
   }
   if($dier1 == 0){
   foreach($mc[2][1] as $val){
     if($val == '大'){
     $mc21 = '第二名大';  
     $dier1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[2][2] as $val){
     if($val == '单'){
     $mc22 = '第二名单';  
     $dier2++;
     }else{
     break;
     }  
   }
   if($dier2 == 0){
   foreach($mc[2][2] as $val){
     if($val == '双'){
     $mc22 = '第二名双';  
     $dier2++;
     }else{
     break;
     }  
   }
   }
//第三名计算
   foreach($mc[3][1] as $val){
     if($val == '小'){
     $mc31 = '第三名小';  
     $disan1++;
     }else{
     break;
     }  
   }
   if($disan1 == 0){
   foreach($mc[3][1] as $val){
     if($val == '大'){
     $mc31 = '第三名大';  
     $disan1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[3][2] as $val){
     if($val == '单'){
     $mc32 = '第三名单';  
     $disan2++;
     }else{
     break;
     }  
   }
   if($disan2 == 0){
   foreach($mc[3][2] as $val){
     if($val == '双'){
     $mc32 = '第三名双';  
     $disan2++;
     }else{
     break;
     }  
   }
   }

//第四名计算
   foreach($mc[4][1] as $val){
     if($val == '小'){
     $mc41 = '第四名小';  
     $disi1++;
     }else{
     break;
     }  
   }
   if($disi1 == 0){
   foreach($mc[4][1] as $val){
     if($val == '大'){
     $mc41 = '第四名大';  
     $disi1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[4][2] as $val){
     if($val == '单'){
     $mc42 = '第四名单';  
     $disi2++;
     }else{
     break;
     }  
   }
   if($disi2 == 0){
   foreach($mc[4][2] as $val){
     if($val == '双'){
     $mc42 = '第四名双';  
     $disi2++;
     }else{
     break;
     }  
   }
   }
//第五名计算
   foreach($mc[5][1] as $val){
     if($val == '小'){
     $mc51 = '第五名小';  
     $diwu1++;
     }else{
     break;
     }  
   }
   if($diwu1 == 0){
   foreach($mc[5][1] as $val){
     if($val == '大'){
     $mc51 = '第五名大';  
     $diwu1++;
     }else{
     break;
     }  
   }
   }
   
   foreach($mc[5][2] as $val){
     if($val == '单'){
     $mc52 = '第五名单';  
     $diwu2++;
     }else{
     break;
     }  
   }
   if($diwu2 == 0){
   foreach($mc[5][2] as $val){
     if($val == '双'){
     $mc52 = '第五名双';  
     $diwu2++;
     }else{
     break;
     }  
   }
   }
   foreach($gyds as $val){
     if($val == '单'){
     $gyds11 = '总和单';  
     $gyds1++;
     }else{
     break;
     }  
   }
   if($gyds1 == 0){
   foreach($gyds as $val){
     if($val == '双'){
     $gyds11 = '总和双';  
     $gyds1++;
     }else{
     break;
     }  
   }
   }
  foreach($gydx as $val){
     if($val == '大'){
     $gydx11 = '总和大';  
     $gydx1++;
     }else{
     break;
     }  
   }
   if($gydx1 == 0){
   foreach($gydx as $val){
     if($val == '小'){
     $gydx11 = '总和小';  
     $gydx1++;
     }else{
     break;
     }  
   }
   }
   
 $aa = array($mc11=>$diyi1,$mc12=>$diyi2,$mc13=>$diyi3,$mc21=>$dier1,$mc22=>$dier2,$mc31=>$disan1,$mc32=>$disan2,$mc41=>$disi1,$mc42=>$disi2,$mc51=>$diwu1,$mc52=>$diwu2,$gyds11=>$gyds1,$gydx11=>$gydx1);
 arsort($aa);
  return $aa;
  }

   


   
