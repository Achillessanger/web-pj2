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

//$sql = $_GET["sql"];
$sql = $_SESSION["sql"];

//$result0 = mysqli_query($_mysqli,$sql);
//$worksnum = mysqli_num_rows($result0);
//if($worksnum % 16 == 0){
//    $pagesnum = $worksnum/16;
//}else{
//    $pagesnum = intval($worksnum/16)+1;
//}

$n = $_GET["pageIndex"];
$from = ($n-1)*16;
$to = $n*16;
$sql = $sql." limit {$from},{$to}";


$result = mysqli_query($_mysqli,$sql);
for ($i=0;$i<4;$i++){
    echo "<tr >";
    for ($j=0;$j<4;$j++){

        if($row = $result ->fetch_assoc()){
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


?>