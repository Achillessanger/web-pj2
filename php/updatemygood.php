<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/11
 * Time: 23:33
 */


if(isset($_POST["inputTitle"])) {

    $title = $_POST["inputTitle"];
    $artist = $_POST["inputArtist"];
    $des = $_POST["exampleTextareaDes"];
    $year = $_POST["inputYear"];
    $genre = $_POST["inputGenre"];
    $length = $_POST["inputLength"];
    $width = $_POST["inputWidth"];
    $price = $_POST["inputPrice"];


   $sql = "update artworks set artist = '{$artist}',title = '{$title}',description ='{$des}',yearOfWork = '{$year}',genre = '{$genre}',width = '{$length}',height='{$width}',price = '{$price}' WHERE artworkID = '{$_SESSION["uploadID"]}'";
 //$sql = "update artworks set title = '{$title}' WHERE artworkID = '{$_SESSION["uploadID"]}'";
    mysqli_query($_mysqli,$sql);
//    header("location:personalinformationpage.php");为啥不跳转0.0？？？
    echo "<script>window.location.href=\"personalinformationpage.php\"</script>";
}

?>