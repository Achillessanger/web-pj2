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


$sql = "select * FROM users WHERE userID = '{$_SESSION['userID']}'";
$result = $_mysqli ->query($sql);
$row = $result ->fetch_assoc();
$premon = $row['balance'];

$addmon = $_GET['add'];
$newbalance = intval($premon)+intval($addmon);
$add = "update users set balance = {$newbalance} WHERE userID = {$_SESSION['userID']}";
$result2 = $_mysqli ->query($add);
echo $newbalance;
?>