<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/11
 * Time: 23:33
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
error_reporting(0);
$artworkIDupdate = $_GET["id"];
//if(isset($_POST["inputTitle"])){
//    echo $_POST["inputTitle"];
//}else{
//    echo "3847777777777777777777777777777777777tgneoij";
//}

if(isset($_POST["inputTitle"])) {

    $title = $_POST["inputTitle"];
    $artist = $_POST["inputArtist"];
    $des = $_POST["exampleTextareaDes"];
    $year = $_POST["inputYear"];
    $genre = $_POST["inputGenre"];
    $length = $_POST["inputLength"];
    $width = $_POST["inputWidth"];
    $price = $_POST["inputPrice"];


    //$sql = "update artworks set artist = '{$artist}',title = '{$title}',description ='{$des}',yearOfWork = '{$year}',genre = '{$genre}',width = '{$length}',height='{$width}',price = '{$price}' WHERE artworkID = '{$_GET["id"]}'";
 $sql = "update artworks set title = '{$title}' WHERE artworkID = '{$_SESSION["uploadID"]}'";
    $xxx=mysqli_query($_mysqli,$sql);
}

if(isset($_POST["inputTitle"])){
    echo "111";
}else{
    echo "222";
}
echo $artworkIDupdate;
?>