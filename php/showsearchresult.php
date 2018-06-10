<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/10
 * Time: 12:16
 */

$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");

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

if(!$keywords || $keywords == ""){
    $sql = "select * FROM artworks WHERE orderID IS NULL ".$sqldisplayprin." limit 0,16";
    $result = mysqli_query($_mysqli,$sql);
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
    $sql = "select * FROM artworks WHERE (" .implode(" or ",$searchprin).") AND (orderID IS NULL) ".$sqldisplayprin." limit 0,16";


    $result = mysqli_query($_mysqli,$sql);
}



if(mysqli_num_rows($result)==0){
    echo'<p>搜索为空</p>';
}else{
    for ($i=0;$i<4;$i++) {
        echo "<tr >";
        for ($j = 0; $j < 4; $j++) {
            $row = $result->fetch_assoc();
            if ($row) {
                $discut = mb_strimwidth($row["description"], 0, 300, '...');
                echo <<<SEARCHDIV
            <td width="25%">
                <div class="artwork-img-wrapper"><a href="specificdetailpage.php?artworkID={$row["artworkID"]}">
                    <img src="../resources/img/{$row["imageFileName"]}" width="80%"></a>
                </div>
                <div class="details">
                        <ul>
                            <li class="ng-binding paintingtitle">{$row["title"]}</li>
                            <li class="ng-binding paintingauthor">{$row["artist"]}</li>
                            <li class="ng-binding paintingprice">价格：\${$row["price"]}  热度：{$row["view"]}</li>
                            <li class="ng-binding paintingdis">{$discut}</li>
                        </ul>
                </div>
            </td>
SEARCHDIV;
            }

        }
        echo "</tr>";
    }




}
?>