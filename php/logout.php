<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/6
 * Time: 22:53
 */
session_start();
unset($_SESSION['trace']);
setcookie("trace","",-1);

$_SESSION = array();
if(isset($_COOKIE[session_name()])){
    setcookie(session_name(),'',time()-42000,'/');
}
session_destroy();



?>