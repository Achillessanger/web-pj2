<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/7
 * Time: 11:15
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

//$_addMon =intval( $_POST['charge']);
//$userID = $_SESSION['userID'];
//$sql = "select * FROM users WHERE userID = {$_SESSION['userID']}";
//$result = $_mysqli ->query($sql);
//$row = $result ->fetch_assoc();
//$premon =intval( $row['balance']);
//$totalmon = $_addMon + $premon;
$add = "update users set balance = {$_SESSION['balance']} WHERE userID = {$_SESSION['userID']}";
$result2 = $_mysqli ->query($add);
echo $_SESSION['balance'];
?>