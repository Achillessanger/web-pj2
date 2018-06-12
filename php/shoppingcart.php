<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/9
 * Time: 17:27
 */
session_start();

//if(!(strpos($_COOKIE['trace'] ,"shoppingcart.php")===false)){
//    $arr = explode(";",$_COOKIE['trace']);
//    $deleteIndex = count($arr) - 1;
//    foreach ($arr as $k => $item){
//        if(!(strpos($item,"shoppingcart.php")===false)){
//            $deleteIndex = $k;
//        }
//    }
//    array_splice($arr,$deleteIndex);
//    setcookie("trace",implode(";",$arr).';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//}else{
//    setcookie("trace",$_COOKIE['trace'].';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//}


if(!(strpos($_SESSION['trace'] ,"shoppingcart.php")===false)){
    $arr = explode(";",$_SESSION['trace']);
    $deleteIndex = count($arr) - 1;
    foreach ($arr as $k => $item){
        if(!(strpos($item,"shoppingcart.php")===false)){
            $deleteIndex = $k;
        }
    }
    array_splice($arr,$deleteIndex);
    $_SESSION['trace'] = implode(";",$arr).';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}else{
    $_SESSION['trace'] = $_SESSION['trace'].';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}

$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
if(empty($_SESSION["userID"]) ){
    header("location:frontpage.php?a=1");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/popout.css">
    <link rel="stylesheet" href="../css/shoppingcart.css">
</head>
<body>
<nav class="navbar navbar-fixed-top">
    <div class="container">
        <ul class="nav pull-left left-ul">
            <li class="nav-item brand"><a href="frontpage.php"style="text-decoration: none; color:black;">
                    Art Store</a>
            </li>
            <li class="nav-item slogen">
                Where you find GENIUS and EXTROORDINARY
            </li>

        </ul>
        <div id="rightnavbar">
            <?php include 'logornot.php'; ?>
        </div>
    </div>
    <div class="container">
        <div class="folat-left" id="footprintdiv">
            <!--显示足迹-->
            <?php include "footprint.php";?>
        </div>
    </div>
</nav>

<div class="container welcometitle">

    <div class="welcome">
        <p style="display: inline">Welcome <p style="display: inline;color: #ff5500"><?php echo $_SESSION["userName"] ?></p></p>
    </div>
    <div class="upload">
        <a class="oriange" id="upload-orange">My Shopping Cart</a>
    </div>

</div>

<div class="container">
    <table class="shoppinglisttab" id="shoppinglisttab">
        <?php
        $totalmon=0;
        $sql = "select * FROM carts WHERE userID = '{$_SESSION['userID']}'";
        $result = $_mysqli ->query($sql);
        while ($row = $result ->fetch_assoc()){
            $result2 = mysqli_query($_mysqli,"select imageFileName,title,description,price FROM artworks WHERE artworkID ='{$row["artworkID"]}'");
            $veryGood = $result2 ->fetch_assoc();
            $totalmon += intval($row["price"]);
            if($veryGood){
            echo <<< SHOPPINGCARTDIV
            <tr style="vertical-align: top; text-align: center">
            <td width="10%">
                <a href="specificdetailpage.php?artworkID={$row["artworkID"]}"><img src="../resources/img/{$veryGood["imageFileName"]}" class="shoppinglistphoto" width="100%"></a>
            </td>
            <td  width="20%">
                    <span class="shoppinglistlabel bold">{$veryGood["title"]}</span>
            </td>
            <td  width="10%">
                <span class="shoppinglistlabel shopplistprice">{$row["price"]}</span>
            </td>
            <td  width="50%">
                <span class="diss">{$veryGood["description"]}</span>
            </td>
            <td  width="10%">
                <button class="blackbutton2"onclick="deleteGood(this,{$row["artworkID"]},{$veryGood["price"]})">DELETE IT</button>
            </td>
        </tr>
SHOPPINGCARTDIV;
            }else{
                echo <<<CANCLE
                 <tr style="vertical-align: top; text-align: center;"><td width="10%">*ArtworkID: </td><td width="20%">{$row["artworkID"]}</td><td width="10%" class="shoppinglistlabel shopplistprice">{$row["price"]}</td><td colspan="2" width="60">取消售卖</td> </tr>
CANCLE;

            }
        }

        ?>
    </table>
</div>
<div style="display: none" id="puttotalmon"><?php echo $totalmon ?></div>
<div class="container paybtndiv">
    <div class="row" id="paybtnrow">
        <button class="whitebutton2" id="paybtn" onclick="pay();">PAY $<?php echo $totalmon ?></button>
    </div>
</div>


<div id="priceChanged" class="pop-remind-div hide">
    <p>部分商品价格改动</p>
</div>
<div id="goodDeleted" class="pop-remind-div hide">
    <p>部分商品取消售卖</p>
</div>
<div id="goodSold" class="pop-remind-div hide">
    <p>部分商品已售出</p>
</div>
<div id="nomoney" class="pop-remind-div hide">
    <p>余额不足</p>
</div>
<div id="paidsuccessfully" class="pop-remind-div hide">
    <p>支付成功</p>
</div>










<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/buttons.js"></script>
<script type="text/javascript" src="../js/register.js"></script>

</body>
</html>