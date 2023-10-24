<?php
    
    echo(json_encode($_FILES["iofq"]));
    move_uploaded_file($_FILES["iofq"]["tmp_name"],"/www/admin/localhost_8123/wwwroot/NewCode/Weijiang/7niuupload/202310201697732448.jpg");
?>