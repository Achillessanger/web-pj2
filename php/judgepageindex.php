<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/10
 * Time: 23:51
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

$pageIndex = $_GET["pageIndex"];
if(empty($_SESSION["sql"])){
    $x = mysqli_query($_mysqli,"select artworkID FROM artworks WHERE orderID IS NULL");
    $worksnum = mysqli_num_rows($x);
}else{
    $x = mysqli_query($_mysqli,$_SESSION["sql"]);
    $worksnum = mysqli_num_rows($x);
}

if($worksnum % 16 == 0){
    $pagesnum = $worksnum/16;
    if($pagesnum == 0){
        $pagesnum =1;
    }
}else{
    $pagesnum = intval($worksnum/16)+1;
}

if(intval($pageIndex) >$pagesnum){
    echo $pagesnum;
}else if(intval($pageIndex) < 1){
    echo 1;
}else{
    echo "001";
}
?>