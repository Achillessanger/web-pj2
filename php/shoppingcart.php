<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/9
 * Time: 17:27
 */
session_start();
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
    <link rel="stylesheet" href="../css/shoppingcart.css">
</head>
<body>
<nav class="navbar navbar-fixed-top">
    <div class="container">
        <ul class="nav pull-left left-ul">
            <li class="nav-item brand">
                Art Store
            </li>
            <li class="nav-item slogen">
                Where you find GENIUS and EXTROORDINARY
            </li>

        </ul>
        <div id="rightnavbar">
            <?php include 'logornot.php'; ?>
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
            $totalmon += intval($veryGood["price"]);
            echo <<< SHOPPINGCARTDIV
            <tr style="vertical-align: top; text-align: center">
            <td width="10%">
                <a href="specificdetailpage.php?artworkID="+{$row["artworkID"]}><img src="../resources/img/{$veryGood["imageFileName"]}" class="shoppinglistphoto" width="100%"></a>
            </td>
            <td  width="20%">
                    <span class="shoppinglistlabel bold">{$veryGood["title"]}</span>
            </td>
            <td  width="10%">
                <span class="shoppinglistlabel shopplistprice">{$veryGood["price"]}</span>
            </td>
            <td  width="50%">
                <span class="diss">{$veryGood["description"]}</span>
            </td>
            <td  width="10%">
                <button class="blackbutton2"onclick="deleteGood(this,{$row["artworkID"]})">DELETE IT</button>
            </td>
        </tr>
SHOPPINGCARTDIV;
//        include "conveytotalmoney.php";
        }

        ?>
    </table>
</div>
<!--<div style="display: none" id="puttotalmon">--><?php //echo $totalmon ?><!--</div>-->
<div class="container paybtndiv">
    <div class="row">
        <button class="whitebutton2" id="paybtn">PAY $<?php echo $totalmon?></button>
    </div>
</div>













<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/buttons.js"></script>

</body>
</html>