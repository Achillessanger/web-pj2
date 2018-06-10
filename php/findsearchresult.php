<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/10
 * Time: 14:10
 */
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
$searchprin_str = $_GET["searchprin"];
$keywords = $_GET["keywords"];

//1名字，2简介，3作家
$keyArr = explode(" ",$keywords);
$key = implode(",",$keyArr);

$searchprin = [];
//$searchprin2 = "";
//$searchprin3 = "";
if(!(strpos("$searchprin_str","1")===false)){
    $searchprin[0] = "title LIKE '%{$keywords}%'";
}
if(!(strpos("$searchprin_str","2")===false)){
    $searchprin[1] = "description LIKE '%{$keywords}%'";
}
if(!(strpos("$searchprin_str","3")===false)){
    $searchprin[2] = "artist LIKE '%{$keywords}%'";
}
$sql = "select * FROM artworks WHERE (" .implode(" or ",$searchprin).") AND (orderID IS NULL)";

$_SESSION["searchsql"]=$sql;///////////////////////////////////

$result = mysqli_query($_mysqli,$sql);
if(mysqli_num_rows($result)==0){
    echo'<p>搜索为空</p>';
}else {
    for ($i = 0; $i < 4; $i++) {
        echo "<tr >";
        for ($j = 0; $j < 4; $j++) {
            $row = $result->fetch_assoc();
            $discut = mb_strimwidth($row["description"], 0, 300, '...');
            if ($row) {
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
    }
}


?>