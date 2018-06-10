<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/10
 * Time: 13:19
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

$result0 = mysqli_query($_mysqli,"select artworkID FROM artworks WHERE orderID IS NULL");
$worksnum = mysqli_num_rows($result0);
if($worksnum % 16 == 0){
    $pagesnum = $worksnum/16;
}else{
    $pagesnum = intval($worksnum/16)+1;
}


$n = $_GET["pageIndex"];
$_SESSION["currentPage"] = $n;

$from = ($n-1)*16;
$to = $n*16;
//if($n*16>$worksnum){
//    $to = $worksnum;
//}else{
//    $to = $n*16;
//}


$result = mysqli_query($_mysqli,"select * FROM artworks WHERE orderID IS NULL limit {$from},{$to}");
for ($i=0;$i<4;$i++){
    echo "<tr >";
    for ($j=0;$j<4;$j++){
        $row = $result ->fetch_assoc();
        $discut = mb_strimwidth($row["description"],0,300,'...');
        if($row){
            echo <<<SEARCHDIV
            <td width="25%">
                <div class="artwork-img-wrapper"><a href="specificdetailpage.php?artworkID={$row["artworkID"]}">
                    <img src="../resources/img/{$row["imageFileName"]}" width="80%"></a>
                </div>
                <div class="details">
                        <ul>
                            <li class="ng-binding paintingtitle">{$row["title"]}</li>
                            <li class="ng-binding paintingauthor">{$row["artist"]}</li>
                            <li class="ng-binding paintingdis">{$discut}</li>
                        </ul>
                </div>
            </td>
SEARCHDIV;
        }

    }
    echo "</tr>";

}


?>