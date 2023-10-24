<?php

include_once('../Public/config.php');
include_once('./jiesuan2.php');

select_query('fn_room','*');
while($x = db_fetch_array()){
 $xx[] = $x;
}
foreach($xx as $x1){
  if(strtotime($x1['roomtime']) < time())continue;
 kaizd('mlaft','20190316173',$x1['roomid']);
}