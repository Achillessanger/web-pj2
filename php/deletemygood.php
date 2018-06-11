<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/12
 * Time: 1:54
 */

$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

$artworkID = $_GET["artworkID"];
mysqli_query($_mysqli,"delete FROM artworks WHERE artworkID='{$artworkID}'")

?>