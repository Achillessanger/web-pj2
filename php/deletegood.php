<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/9
 * Time: 18:50
 */
$artworkID = $_GET["artworkID"];
$price = $_GET["price"];
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
mysqli_query($_mysqli,"delete FROM carts WHERE artworkID='{$artworkID}'");
//include "conveytotalmoney.php";
//$newTotalMon = intval($total)-intval($price);
//echo $newTotalMon;
?>