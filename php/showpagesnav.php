<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/10
 * Time: 12:18
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

error_reporting(0);
$searchprin_str = $_GET["searchprin"];
$keywords = $_GET["keywords"];
$diaplayprin = $_GET["displayprin"];

//1价格2热度3标题
if($diaplayprin == 1){
    $sqldisplayprin = " ORDER BY price ";
}
if($diaplayprin == 2){
    $sqldisplayprin = " ORDER BY artworks.view DESC ";
}
if($diaplayprin == 3){
    $sqldisplayprin = " ORDER BY title ";
}


if(!$keywords|| $keywords==""){
    $sql = "select * FROM artworks WHERE orderID IS NULL ".$sqldisplayprin;
    $result = mysqli_query($_mysqli,$sql);
    $worksnum = mysqli_num_rows($result);
    if($worksnum % 16 == 0){
        $pagesnum = $worksnum/16;
    }else{
        $pagesnum = intval($worksnum/16)+1;
    }
}else{
    $searchprin = [];
    if(!(strpos("$searchprin_str","1")===false)){
        $searchprin[0] = "title LIKE '%{$keywords}%'";
    }
    if(!(strpos("$searchprin_str","2")===false)){
        $searchprin[1] = "description LIKE '%{$keywords}%'";
    }
    if(!(strpos("$searchprin_str","3")===false)){
        $searchprin[2] = "artist LIKE '%{$keywords}%'";
    }
    $sql = "select * FROM artworks WHERE (" .implode(" or ",$searchprin).") AND (orderID IS NULL) ".$diaplayprin;
    $result = mysqli_query($_mysqli,$sql);
    $worksnum = mysqli_num_rows($result);
    if($worksnum % 16 == 0){
        $pagesnum = $worksnum/16;
    }else{
        $pagesnum = intval($worksnum/16)+1;
    }
}

$_SESSION["sql"]=$sql;

    for ($i=1; $i<=$pagesnum;$i++) {
        if ($i == 1) {
            echo <<<PAGESSELECTF
<li class="page-item active"><a class="page-link" onclick="changePageByNav(this.innerText);" >{$i}</a></li>
PAGESSELECTF;
        } else {
            echo <<<PAGESSELECT
<li class="page-item"><a class="page-link"  onclick="changePageByNav(this.innerText);">{$i}</a></li>
PAGESSELECT;

        }
    }



?>