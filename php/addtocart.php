<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/9
 * Time: 15:08
 */
session_start();
error_reporting(0);
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

$artworkID = intval($_GET["artworkID"]);

$sql = "SELECT * FROM carts WHERE userID = '{$_SESSION["userID"]}' AND artworkID='{$artworkID}'";
$result = $_mysqli ->query($sql);
$row = $result ->fetch_assoc();
$rownum = mysqli_num_rows($row);



$result2 = mysqli_query($_mysqli,"SELECT orderID,price FROM artworks WHERE artworkID = '{$artworkID}'");
$row2 = $result2 ->fetch_assoc();
$price = $row2["price"];
if(empty($_SESSION["userID"])){
    echo 4;
}else{
    if($row2["orderID"] != NULL){
        echo 3;
    }else{
        if($row){
            echo 2;
        }else{
            if( mysqli_query($_mysqli,"ALTER TABLE carts ADD price INT ")){}

            mysqli_query($_mysqli,"insert into carts(userID,artworkID,price) VALUES ({$_SESSION["userID"]},{$artworkID},{$price})");
            echo 1;
        }
    }
}


?>