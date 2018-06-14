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
//$mytotal = $_GET["mytotal"];
$servertotal = 0;
$mytotal = 0;


$ifGo = true;

$result = mysqli_query($_mysqli,"select * FROM carts WHERE userID = '{$_SESSION['userID']}'");
while ($row = $result ->fetch_assoc()){
    $mytotal += intval($row["price"]);
    $result2 = mysqli_query($_mysqli,"select imageFileName,title,description,price FROM artworks WHERE artworkID ='{$row["artworkID"]}'");

    $veryGood = $result2 ->fetch_assoc();
    if(!$veryGood){
        mysqli_query($_mysqli,"delete FROM carts WHERE artworkID ='{$row["artworkID"]}'");
        echo 0;//被删了
        $ifGo = false;

    }else{
        $servertotal += intval($veryGood["price"]);
        $refreshPrice = intval($veryGood["price"]);
        mysqli_query($_mysqli,"update carts set price = {$refreshPrice} WHERE artworkID ='{$row["artworkID"]}'");
    }


}
if($mytotal != $servertotal){

    echo 1;//价格变动
    $ifGo = false;

}

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
    $ifGo = false;
}else{
    if($ifGo){
        $newbalance = $resultBalance["balance"] - $servertotal;
        mysqli_query($_mysqli,"update users set balance = {$newbalance} WHERE userID = '{$_SESSION['userID']}'");

        $orderForm = $_mysqli ->query("select artworkID FROM carts WHERE userID = '{$_SESSION['userID']}'");
        mysqli_query($_mysqli,"insert into orders(ownerID,orders.sum) VALUE ({$_SESSION["userID"]},$servertotal)");
        $result9 = mysqli_query($_mysqli,"select orderID FROM orders ORDER BY orderID DESC limit 1");
        $getCurrentOrderID = $result9 ->fetch_assoc();
        $currentOrderID = $getCurrentOrderID["orderID"];//新生成的订单编号,用于修改artworks里的orderID
        while ($singleOrder = $orderForm ->fetch_assoc()){//$singleOrder为某个用户carts表单中每一个商品ID

            $result6 = mysqli_query($_mysqli,"select ownerID,price FROM artworks WHERE artworkID='{$singleOrder["artworkID"]}'");
            $userToAddBalance = $result6 ->fetch_assoc();
            $addMoney = intval($userToAddBalance["price"]);
            $result7 = mysqli_query($_mysqli,"select balance FROM users WHERE userID = '{$userToAddBalance["ownerID"]}'");
            $moneyIhave = $result7 ->fetch_assoc();
            $previousMoney =intval( $moneyIhave["balance"]);
            $newAddedBalance = $addMoney + $previousMoney;
            mysqli_query($_mysqli,"update artworks set orderID ={$currentOrderID} WHERE artworkID='{$singleOrder["artworkID"]}'");
            mysqli_query($_mysqli,"update users set balance = {$newAddedBalance} WHERE userID = '{$userToAddBalance["ownerID"]}'");//卖家获得钱
            mysqli_query($_mysqli,"delete FROM carts WHERE artworkID='{$singleOrder["artworkID"]}'AND userID = '{$_SESSION['userID']}'");
        }
        echo 4;//下单成功
    }

}

?>