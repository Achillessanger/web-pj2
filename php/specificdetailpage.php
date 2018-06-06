<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/4
 * Time: 22:15
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
$artworkID = $_GET['artworkID'];
//print_r($_GET);
$artworkForm = "select * FROM artworks WHERE artworkID = '{$artworkID}'";
$artworkChoose = $_mysqli -> query($artworkForm);
$artwork = $artworkChoose -> fetch_assoc();
//$viewNum = $artwork['view'];
//mysqli_query($_mysqli,"UPDATE artworks SET artworks.view ={($viewNum+1)}");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>details</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/popout.css">
    <link rel="stylesheet" href="../css/specificdetailpage.css">
</head>
<body>
<!-- 导航栏，右侧部分由php生成-->
<nav class="navbar navbar-fixed-top">
    <div class="container">
        <ul class="nav pull-left left-ul">
            <li class="nav-item brand"><a href="frontpage.php"style="text-decoration: none; color:black;">
                    Art Store
                </a>
            </li>
            <li class="nav-item slogen">
                Where you find GENIUS and EXTROORDINARY
            </li>

        </ul>

        <?php include 'logornot.php'; ?>

    </div>
</nav>

<!--注册弹窗-->
<?php include 'register.php';?>

<!--登陆弹窗-->
<?php include 'login.php';?>

<div class="container subTitle">
    <div class="row">
        <div class="col-md-12 text-center paintertitlesmaller">
            <?php

            echo <<<TITLESMALL
            <div class="paintertitle">{$artwork['title']}</div>
            <div class="paintername"><a>Artist: {$artwork['artist']}</a></div>
TITLESMALL;
            ?>
        </div>
    </div>
</div>

<div class="container contentContainer">
    <div class="row">
        <div class="col-md-7">
            <?php
            echo <<<PHOTO
        <img src="../resources/img/{$artwork['imageFileName']}" width="100%" id="pic">
PHOTO;
            ?>
        </div>
        <div class="col-md-5 picdetails">
            <div class="card">
                <div class="card-body part1">
                    <?php
                    echo <<<DETAILS
                <p>Painted in:   {$artwork['yearOfWork']}</p>
                <p>Genre:   {$artwork['genre']}</p>
                <p>Dimensions:   {$artwork['width']} * {$artwork['height']}</p>
                <p>Released time:   {$artwork['timeReleased']} </p>
                <p>view:    {$artwork['view']}</p>
DETAILS;
                    ?>
                </div>
            </div>
            <div class="card">
                <div class="card-body part2">
                    <?php
                    echo <<<DIS
                    <p>{$artwork['description']}</p>
DIS;
                    ?>
                </div>
            </div>
            <div class="card">
                <div class="card-body part3">
                    <?php
                    echo <<<PRICE
                    <p>Price: {$artwork['price']}</p>
PRICE;
                    if($artwork['orderID'] == NULL){
                        echo'
                          <p class="state1">STATE: UNSOLD</p>
                        ';
                    }else{
                        echo'
                          <p class="state2">STATE: ALREADY SOLD</p>
                        ';
                    }
                    echo <<<BUTTONS
                <div class="buttons text-center">
                    <button class="blackbutton" onclick="">ADD TO WISH LIST</button>
                    <button class="whitebutton" onclick="">ADD TO SHOPPING CART</button>
                </div>
BUTTONS;

                    ?>
                </div>
            </div>
        </div>
    </div>
</div>





<!--<footer>-->
<!---->
<!--</footer>-->
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/register.js" type="text/javascript"></script>
<!--<script type="text/javascript" src="register.js"></script>-->
<!--<script type="text/javascript" src="Buttons.js"></script>-->
<!--<script type="text/javascript" src="enlarge.js"></script>-->
<!--<script type="text/javascript" src="linkToSearchPage.js"></script>-->

</body>
</html>