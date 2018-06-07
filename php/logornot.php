

<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/4
 * Time: 17:20
 */


if(empty($_SESSION['userID'])){
    showNavLef_tourist();
}else{
    showNavLef_loged();
}


function showNavLef_tourist(){
        echo '
<ul class="nav pull-right">
     <li class="nav-item">
            <a href="frontpage.php" class="nav-link right-a">首页</a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link right-a">搜索</a>
            </li>
            <li class="nav-item ">
                <a href="specificdetailpage.php?artworkID=351" class="nav-link right-a">详情</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link right-a" onclick="loginShow();">登陆</a>
            </li>
            <li class="nav-item">
                <a class="nav-link right-a" onclick="registerShow();">注册</a>
            </li></ul>
    ';
}

function showNavLef_loged(){
//    $quitRefresh = "{$_SERVER['PHP_SELF']}".'?'.$_SERVER['QUERY_STRING']."?quit=1";

    echo '
<ul class="nav pull-right">
            <li class="nav-item">
            <a href="personalinformationpage.php" class="nav-link right-a"><i class="fa fa-user">'.$_SESSION["userName"].'</i> </a>
            </li>
            <li class="nav-item ">
                <a href="#" class="nav-link right-a"><i class="fa fa-shopping-cart">购物车</i> </a>
            </li>
            <li class="nav-item ">
                <a href="specificdetailpage.php?artworkID=351" class="nav-link right-a"><i class="fa fa-navicon">详情</i></a>
            </li>
            <li class="nav-item ">
                <a class="nav-link right-a" onclick="logOut();"><i class="fa fa-mail-reply">登出</i></a>
            </li>
          
            <form class="form-inline navbar-form pull-right">
    <input class="form-control" type="text" placeholder="Search" width="100px" >
        <a href="#" class="nav-link right-a" ><i class="fa fa-search"></i></a>
  </form>
    ';
}

?>

