<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/10
 * Time: 12:18
 */
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

if(empty($_GET["key"])){
    $result = mysqli_query($_mysqli,"select artworkID FROM artworks WHERE orderID IS NULL");
    $worksnum = mysqli_num_rows($result);
    if($worksnum % 16 == 0){
        $pagesnum = $worksnum/16;
    }else{
        $pagesnum = intval($worksnum/16)+1;
    }
}else{
    $result = mysqli_query($_mysqli,$_SESSION["searchsql"]);
    $worksnum = mysqli_num_rows($result);
    if($worksnum % 16 == 0){
        $pagesnum = $worksnum/16;
    }else{
        $pagesnum = intval($worksnum/16)+1;
    }
}


    for ($i=1; $i<=$pagesnum;$i++) {
        if ($i == 1) {
            echo <<<PAGESSELECTF
<li class="page-item active"><a class="page-link" href="#" >{$i}</a></li>
PAGESSELECTF;
        } else {
            echo <<<PAGESSELECT
<li class="page-item"><a class="page-link" href="#" onclick="changePageByNav(this.innerText);">{$i}</a></li>
PAGESSELECT;
        }
    }



?>