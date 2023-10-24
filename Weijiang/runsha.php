<?php
include_once("../Public/config.php");
function MT_sha(){
    select_query("fn_mtorder", '*', array("status" => "未结算"));
    while($con = db_fetch_array()){
        $cons[] = $con;
    }
    foreach($cons as $con){
      echo '{id:'.$id = $con['id'];
      echo '}{roomid:'.$roomid = $con['roomid'];
      echo '}{userid:'.$user = $con['userid'];
      echo '}{期号:'.$term = $con['term'];
      echo '}{名次:'.$zym_1 = $con['mingci'];
      echo '}{下注玩法:'.$zym_8 = $con['content'];
       echo '}{下注金额:'.$zym_7 = $con['money'];
      echo '}';
    return;
    }
}
print_r(MT_sha());
    //    if($zym_1 == '1'){
      //      if($zym_8 == '大'){
      //          $peilv = get_query_val('fn_lottery6', 'da', "`roomid` = '$roomid'");
              
              
              
              
              
              //未开奖就插入开奖，需要从上一开奖时间计算当前开奖插入时间
    //          $opencode = updata_query('fn_open', 'code', "`term` = '$term' and `type` = '6'");
              
              
        //开奖后不修改      
   //     $opencode = get_query_val('fn_open', 'code', "`term` = '$term' and `type` = '6'");
    //    $opencode = str_replace('10', '0', $opencode);
    //    if($opencode != ""){ echo '已开奖';};
 echo "系统当前时间";
echo ":";
echo date("Y-m-d h:m:s",time());
echo '<br>';
echo '五秒后再次检测';
//<!--JS 页面自动刷新 -->
echo ("<script type=\"text/javascript\">");
echo ("function fresh_page()");    
echo ("{");
echo ("window.location.reload();");
echo ("}"); 
echo ("setTimeout('fresh_page()',5000);");      
echo ("</script>");             
?>  