<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/6
 * Time: 22:39
 */
session_start();
if(empty($_SESSION['userID'])){
    echo 0;
}else{
    echo 1;
}
?>