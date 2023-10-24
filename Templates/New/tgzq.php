<?php
include_once("../../Public/config.php");
$fenurl = get_query_val('fn_system','content1',array('id'=>'3'));
echo "<form style='display:none;' id='form1' name='form1' method='post' action='http://".$fenurl."/'>
             
              <input name='verify' type='text' value='n2oqcvVPpk1M' />
			  <input name='tuiguang' type='text' value='tuiguang' />

              			  
            </form><script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";

?>