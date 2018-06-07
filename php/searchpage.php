<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/7
 * Time: 12:22
 */
session_start();
error_reporting(0);
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/popout.css">
    <link rel="stylesheet" href="../css/searchpage.css">
</head>

<body>
<!-- 导航栏，右侧部分由php生成-->
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

<!--注册弹窗-->
<?php include 'register.php';?>

<!--登陆弹窗-->
<?php include 'login.php';?>

<div class="container searchbar">
        <select class=""></select>
        <i class="fa fa-search"></i>
        <input type="text" placeholder="search" class="searchbar-input" id="searchbar-input" maxlength="50">
</div>




<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/register.js" type="text/javascript"></script>
</body>

</html>

