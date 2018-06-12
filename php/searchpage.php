<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/7
 * Time: 12:22
 */
session_start();
error_reporting(0);

//if(!(strpos($_COOKIE['trace'] ,"searchpage.php")===false)){
//    $arr = explode(";",$_COOKIE['trace']);
//    $deleteIndex = count($arr) - 1;
//    foreach ($arr as $k => $item){
//        if(!(strpos($item,"searchpage.php")===false)){
//            $deleteIndex = $k;
//        }
//    }
//    array_splice($arr,$deleteIndex);
//    setcookie("trace",implode(";",$arr).';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//}else{
//    if(isset($_COOKIE['trace'])){
//        setcookie("trace",$_COOKIE['trace'].';http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//    }else{
//        setcookie("trace", 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
//    }
//}


if(!(strpos($_SESSION['trace'] ,"searchpage.php")===false)){
    $arr = explode(";",$_SESSION['trace']);
    $deleteIndex = count($arr) - 1;
    foreach ($arr as $k => $item){
        if(!(strpos($item,"searchpage.php")===false)){
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

<!--注册弹窗-->
<?php include 'register.php';?>

<!--登陆弹窗-->
<?php include 'login.php';?>

<div class="container searchbar">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="checkbox" id="searchBy">
            <!--按什么搜索-->
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox1" value="1" name="searchby" checked="checked"> 按照艺术品名称
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox2" value="2" name="searchby"> 按照艺术品简介
                </label>
                <label class="checkbox-inline">
                    <input type="checkbox" id="inlineCheckbox3" value="3" name="searchby"> 按照作者名
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <a  onclick="goSearch();" id="fa-search"><i class="fa fa-search" style="margin-top: 22px"></i></a>
        <input type="text" placeholder="search" class="searchbar-input" id="searchbar-input" maxlength="50" value="<?php echo $_GET["keywords"];?>">
    </div>
</div>

<div class="selectHolder container">
    <div class="searchcontent" id="searchcontent"><?php echo $_GET["keywords"]?> </div>
    <select class="select" id="displaiedBy" onchange="changeSelect();">
        <?php
        $selectvalue = $_GET["displayprin"];
        if(!$selectvalue||$selectvalue == ""||$selectvalue == 1){
            echo '<option value="1" selected>价格</option><option value="2">热度</option><option value="3">标题</option>';
        }else{
            if($selectvalue == 2){
                echo '<option value="1">价格</option><option value="2" selected>热度</option><option value="3">标题</option>';
            }
            if($selectvalue == 3){
                echo '<option value="1">价格</option><option value="2">热度</option><option value="3" selected>标题</option>';
            }
        }

        ?>
    </select>

</div>

<div class="container allArtworksHolder">
    <table class="artworksArea" id="artworksArea">
        <?php include "showsearchresult.php"; ?>
    </table>
</div>

<div class="container pagescontainer">
    <div class="pagesnav">

            <ul class="pagination" style="width: 80%" id="searchresultul">
                <li class="page-item"><a class="page-link" onclick="prePage();" id="previous">Previous</a></li>
                <?php include "showpagesnav.php"; ?>
                <li class="page-item"><a class="page-link" onclick="nextPage();">Next</a></li>
                <div style="margin-left: 20px;padding-top: 5px;color: #333333;font-weight: bolder"><input type="number" style="width: 60px;" min="1" id="jumpinput"> /<?php
                    if(empty($_SESSION["sql"])){
                        $x = mysqli_query($_mysqli,"select artworkID FROM artworks WHERE orderID IS NULL");
                        $worksnum = mysqli_num_rows($x);
                        if($worksnum % 16 == 0){
                            $pagesnum = $worksnum/16;
                            if($pagesnum == 0){
                                $pagesnum =1;
                            }
                        }else{
                            $pagesnum = intval($worksnum/16)+1;
                        }
                        echo $pagesnum;
                    }else{
                        $x = mysqli_query($_mysqli,$_SESSION["sql"]);
                        $worksnum = mysqli_num_rows($x);
                        if($worksnum % 16 == 0){
                            $pagesnum = $worksnum/16;
                            if($pagesnum == 0){
                                $pagesnum =1;
                            }
                        }else{
                            $pagesnum = intval($worksnum/16)+1;
                        }
                        echo $pagesnum;
                    }
                    ?> <a id="jump" onclick="changePageByNav2()">跳转</a></div>
<?php // echo "<script>alert(111);setCurrentPage();</script>";?>
            </ul>

    </div>



</div>



<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="../js/register.js" type="text/javascript"></script>
<script src="../js/pagination.js" type="text/javascript"></script>
</body>

</html>

