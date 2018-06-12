<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/4
 * Time: 16:35
 */
session_start();
error_reporting(0);

//if(!(strpos($_COOKIE['trace'] ,"frontpage.php")===false)){
//    $arr = explode(";",$_COOKIE['trace']);
//    $deleteIndex = count($arr) - 1;
//    foreach ($arr as $k => $item){
//        if(!(strpos($item,"frontpage.php")===false)){
//            $deleteIndex = $k;
//        }
//    }
//
//    array_splice($arr,$deleteIndex);
//    setcookie("trace",implode(";",$arr).';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//}else{
//    if(isset($_COOKIE['trace'])){
//        setcookie("trace",$_COOKIE['trace'].';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//    }else{
//        setcookie("trace",'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//    }
//}



if(!(strpos($_SESSION['trace'] ,"frontpage.php")===false)){
    $arr = explode(";",$_SESSION['trace']);
    $deleteIndex = count($arr) - 1;
    foreach ($arr as $k => $item){
        if(!(strpos($item,"frontpage.php")===false)){
            $deleteIndex = $k;
        }
    }
    array_splice($arr,$deleteIndex);
    $_SESSION['trace'] = implode(";",$arr).';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
}else{
    if(isset($_SESSION['trace'])){
        $_SESSION['trace'] = $_SESSION['trace'].';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    }else{
        $_SESSION['trace'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
    }
}


$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
if(isset($_GET['a'])){
    $_SESSION['trace'] = "";
    echo "<script>alert(\"请先登录\");window.location.href=\"frontpage.php\"</script>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Art Store</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/popout.css">
    <link rel="stylesheet" href="../css/frontpage.css">
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
    <div class="container">
        <div class="folat-left" id="footprintdiv">
            <!--显示足迹-->
            <?php include "footprint.php";?>
        </div>

    </div>
</nav>

<!--注册弹窗-->
<?php include 'register.php';?>

<!--登陆弹窗-->
<?php include 'login.php';?>


<!--画廊，最热艺术品展示-->
<div class="container">
    <div id="gallery" class="carousel slide " data-ride="carousel">
        <!-- 指示符 -->
        <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
        </ul>
        <!--轮播图片-->
        <div class="carousel-inner">
            <?php
            $carouselPics = "select imageFileName,title,description,artworkID FROM artworks WHERE orderID IS NULL ORDER BY artworks.view DESC limit 3";
            $result = $_mysqli -> query($carouselPics);

            //第一张要有active属性
            $row = $result -> fetch_assoc();
            echo  '
                <div class="carousel-item active">
                                <a href="specificdetailpage.php?artworkID='.$row['artworkID'].'"><img src="../resources/img/'.$row['imageFileName'].'" class="card-img-top gallery"></a>
                <div class="carousel-caption">
                <h3>'.$row['title'].'</h3>
                <p>'.$row['description'].'</p>
                </div>
                </div>
            ';

            while ($row = $result -> fetch_assoc()){
                $discut = mb_strimwidth($row["description"], 0, 400, '...');
                echo  '
                <div class="carousel-item">
                                <a href="specificdetailpage.php?artworkID='.$row['artworkID'].'"><img src="../resources/img/'.$row['imageFileName'].'" class="card-img-top  gallery"></a>
                                 <div class="carousel-caption">
                <h3>'.$row['title'].'</h3>
                <p>'.$discut.'</p>
                </div>
                </div>
            ';
            };
            ?>
        </div>
        <!-- 左右切换按钮 -->
        <a class="carousel-control-prev" href="#gallery" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#gallery" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</div>


<!--最新艺术品展示-->
<div class="container container-fluid thenewest">
    <div class="row">
        <div class="col-md-12 text-center text-muted newreleased">
            NEWEST RELEASED
        </div>
    </div>
    <div class="row text-center align-items-top">
        <?php

        $newestPics = "select imageFileName,title,description,artworkID FROM artworks WHERE orderID IS NULL ORDER BY artworks.timeReleased DESC limit 3";
        $result = $_mysqli -> query($newestPics);
        while ($row = $result -> fetch_assoc()){
            echo '
             <div class="col-md-4">
            <a href="specificdetailpage.php?artworkID='.$row['artworkID'].'"><img src="../resources/img/'.$row['imageFileName'].'"  class="hottest-vbox" width="100%"></a>
                <p class="title">'.$row['title'].'</p>
                <p class="dis">'.$row['description'].'</p>
                <button type="button" class="btn btn-secondary" onclick="window.location.href=\'specificdetailpage.php?artworkID='.$row['artworkID'].'\'">Learn More</button>
        </div>
            ';
        }
        ?>
    </div>
</div>


<div id="loginsuccessfully" class="pop-remind-div hide">
    <p>登陆成功！</p>
</div>
<div id="loginfailed" class="pop-remind-div hide">
    <p>登陆失败！</p>
</div>

<footer>
    <div class="container">
        <p class="copyright">&copyArtStore.Produced and maintained by Achillessanger at 2018.6.4. All Rights Reserved</p>
    </div>
</footer>


<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/register.js" type="text/javascript"></script>
</body>

</html>
