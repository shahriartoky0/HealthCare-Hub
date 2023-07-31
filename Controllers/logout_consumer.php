<?php
 setcookie('consumer_logged_flag',true,time()-1,'/');
 session_start();
 session_destroy();
 header('location:../home.html');

?>