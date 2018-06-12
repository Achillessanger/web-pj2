<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/9
 * Time: 21:07
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
$mytotal = $_GET["mytotal"];
$servertotal = 0;



$result = mysqli_query($_mysqli,"select * FROM carts WHERE userID = '{$_SESSION['userID']}'");
while ($row = $result ->fetch_assoc()){
    $result2 = mysqli_query($_mysqli,"select imageFileName,title,description,price FROM artworks WHERE artworkID ='{$row["artworkID"]}'");

    $veryGood = $result2 ->fetch_assoc();
    if(!$veryGood){
        echo 0;//被删了
    }else{
        $servertotal += $veryGood["price"];
    }

}
if($mytotal != $servertotal){
    echo 1;//价格变动
}
$ifGo = true;
$result3 = mysqli_query($_mysqli,"select * FROM carts WHERE userID = '{$_SESSION['userID']}'");
while ($row3 = $result3 ->fetch_assoc()){
    $result4 = mysqli_query($_mysqli,"select orderID FROM artworks WHERE artworkID ='{$row3["artworkID"]}'");
    $veryGood2 = $result4 ->fetch_assoc();
    if($veryGood2["orderID"] != NULL){
        echo 2;//有人已经买了
        mysqli_query($_mysqli,"delete FROM carts WHERE artworkID ='{$row3["artworkID"]}' AND userID = '{$_SESSION['userID']}'");
        $ifGo = false;
    }
}

$getBalance = mysqli_query($_mysqli,"select balance FROM users WHERE userID = '{$_SESSION['userID']}'");
$resultBalance = $getBalance ->fetch_assoc();
if($servertotal > intval($resultBalance["balance"])){
    echo 3;//余额不足
}else{
    if($ifGo){
        $newbalance = $resultBalance["balance"] - $servertotal;
        mysqli_query($_mysqli,"update users set balance = {$newbalance} WHERE userID = '{$_SESSION['userID']}'");


        $orderForm = $_mysqli ->query("select artworkID FROM carts WHERE userID = '{$_SESSION['userID']}'");
        while ($singleOrder = $orderForm ->fetch_assoc()){//$singleOrder为某个用户carts表单中每一个商品ID
            mysqli_query($_mysqli,"insert into orders(ownerID,orders.sum) VALUE ({$_SESSION["userID"]},$servertotal)");
            $result5=mysqli_query($_mysqli,"select orderID FROM orders WHERE ownerID='{$_SESSION["userID"]}' ORDER by orderID DESC limit 1");//用于获取orderID
//        $rownum = mysqli_num_rows($result5);
//        mysqli_data_seek($result5,$rownum);
            $rowTogetorderID = $result5 ->fetch_assoc();
            mysqli_query($_mysqli,"update artworks set orderID ={$rowTogetorderID["orderID"]} WHERE artworkID='{$singleOrder["artworkID"]}'");
            mysqli_query($_mysqli,"delete FROM carts WHERE artworkID='{$singleOrder["artworkID"]}'AND userID = '{$_SESSION['userID']}'");
        }
        echo 4;//下单成功
    }

}

?>