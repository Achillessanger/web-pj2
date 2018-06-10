<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/10
 * Time: 12:16
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

$_SESSION["currentPage"] = 1;
$result = mysqli_query($_mysqli,"select * FROM artworks WHERE orderID IS NULL limit 0,16");
//$worksnum = mysqli_num_rows($result);
//if($worksnum % 16 == 0){
//    $pagesnum = $worksnum/16;
//}else{
//    $pagesnum = intval($worksnum/16)+1;
//}

//没有搜索内容时显示第一页
if(empty($_GET["key"])){
    for ($i=0;$i<4;$i++){
        echo "<tr >";
        for ($j=0;$j<4;$j++){
            $row = $result ->fetch_assoc();
            $discut = mb_strimwidth($row["description"],0,300,'...');
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
        echo "</tr>";

    }


}
?>