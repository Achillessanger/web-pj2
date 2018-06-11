<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/11
 * Time: 19:46
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
error_reporting(0);

if(isset($_POST["inputTitle"])) {

    $title = $_POST["inputTitle"];
    $artist = $_POST["inputArtist"];
    $des = $_POST["exampleTextareaDes"];
    $year = $_POST["inputYear"];
    $genre = $_POST["inputGenre"];
    $length = $_POST["inputLength"];
    $width = $_POST["inputWidth"];
    $price = $_POST["inputPrice"];

    $result = mysqli_query($_mysqli,"select artworkID FROM artworks ORDER BY artworkID DESC limit 1");
    $row = $result ->fetch_assoc();
    $no = $row["artworkID"];
    $newartworkID = intval($no)+1;
    $ownerID = $_SESSION["userID"];


//    if(isset($update)){
////        $sql = "update artworks set artist = '{$artist}',title = '{$title}',description ='{$des}',yearOfWork = '{$year}',genre = '{$genre}',width = '{$length}',height='{$width}',price = '{$price}' WHERE artworkID = '{$_GET["id"]}'";
//        $sql = "update artworks set title = '{$title}' WHERE artworkID = '{$artworkIDupdate}'";
//        $xxx =mysqli_query($_mysqli,$sql);
//
//    }else{
        if ($_FILES["file"]["error"] > 0) {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        } else {

            // 判断当期目录下的 img目录是否存在该文件
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            } else {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                $_FILES["file"]["name"] = $newartworkID.".jpg";
                move_uploaded_file($_FILES["file"]["tmp_name"], "../resources/img/" . $_FILES["file"]["name"]);
                $sql = "insert into artworks(artworkID,artist,imageFileName,title,description,yearOfWork,genre,width,height,price,artworks.view,ownerID) VALUES ($newartworkID,'{$artist}','{$_FILES["file"]["name"]}','{$title}','{$des}','{$year}','{$genre}','{$length}','{$width}',$price,0,$ownerID)";
                mysqli_query($_mysqli,$sql);
            }
        }
//    }

}






?>