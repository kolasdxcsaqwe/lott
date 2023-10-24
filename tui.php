<?php
    session_start();
    header('Content-type:text/html;charset=utf-8');
          $_SESSION = array(); //清除SESSION值.
           session_unset();
          if(isset($_COOKIE[session_name()])){  //判断客户端的cookie文件是否存在,存在的话将其设置为过期.
                setcookie(session_name(),'',time()-1,'/');
            }
                session_destroy();  //清除服务器的sesion文件
 echo '<script>alert("退出成功！"); window.location.href = "/web_login.php";</script>';

?>