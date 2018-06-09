<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/9
 * Time: 18:50
 */
//error_reporting(0);
$artworkID = $_GET["artworkID"];
$price = intval($_GET["price"]);
$total = intval($_GET["total"]);
$newTotal = $total - $price;
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
mysqli_query($_mysqli,"delete FROM carts WHERE artworkID='{$artworkID}'");
echo $newTotal;

?>