<?
 header("Content-Type: text/html;charset=utf-8");
include_once('../../Public/config.php');
$type = $_GET["id"];
$qihao = get_query_vals('fn_open','*',"`type`= '$type' order by `next_term` desc limit 1");
$time = time();
$feng = get_query_val('fn_lottery'.$type,'fengtime',"`roomid` = {$_SESSION['agent_room']}"); 
$next_time = strtotime(get_query_val('fn_open','next_time',"`type` = '$type' order by `term` desc limit 1"));
$jieguo = $next_time - $time;
if($jieguo < $feng){
$feng1 = 'style="color:red;" value="已封盘"';
}else{
$feng1 = 'value="未封盘"'; 
}         
$qihaos[] = $qihao;
 $tr .= '<div class="col-md-2">';
 $tr .= '<div class="input-group">';
 $tr .= '<div class="input-group-addon">';
 $tr .= '期号';
 $tr .= '</div>';   
 $tr .= '<input type="number" id="addterm" value="'.$qihao['next_term'].'"class="form-control pull-right" readonly="readonly">';
 $tr .= '</div>';
 $tr .= '</div>';
 $tr .= '<div class="col-md-2">';
 $tr .= '<div class="input-group">';
 $tr .= '<div class="input-group-addon">';
 $tr .= '开奖时间';
 $tr .= '</div> ';             
 $tr .= '<input type="text" id="next_time" value="'.$qihao['next_time'].'"class="form-control pull-right" readonly="readonly">';
 $tr .= '</div>';
 $tr .= '</div>';
 $tr .= '<div class="col-md-2">';
 $tr .= '<div class="input-group">';
 $tr .= '<div class="input-group-addon">';
 $tr .= ' 游戏状态';
 $tr .= '</div>';
 $tr .= '<input type="text" id="fengtime" '.$feng1.' class="form-control pull-right" readonly="readonly">';
 $tr .= '</div>';
 $tr .= '</div>';

echo $tr;


?>
