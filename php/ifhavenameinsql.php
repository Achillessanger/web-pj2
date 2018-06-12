<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/12
 * Time: 15:02
 */
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
$name = $_GET["name"];

$result = mysqli_query($_mysqli,"select users.name FROM users WHERE users.name = '{$name}'");
if($result= $result ->fetch_assoc()){
    echo 0;
}else{
    echo 1;
}
?>