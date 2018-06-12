<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/12
 * Time: 22:05
 */

$myTrace = explode(";", $_SESSION['trace']);
foreach ($myTrace as $traceValue){
    if(!(strpos($traceValue,"frontpage.php")===false)){
        echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">首页 ></a>';
    }
    if(!(strpos($traceValue,"specificdetailpage.php")===false)){
        echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">详情 ></a>';
    }
    if(!(strpos($traceValue,"searchpage.php")===false)){
        echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">搜索 ></a>';
    }if(isset($_SESSION['userID'])){
        if(!(strpos($traceValue,"personalinformationpage.php")===false)){
            echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">个人信息 ></a>';
        }
        if(!(strpos($traceValue,"shoppingcart.php")===false)){
            echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">购物车 ></a>';
        }
    }
}

//$myTrace = explode(";", $_COOKIE['trace']);
//foreach ($myTrace as $traceValue){
//    if(!(strpos($traceValue,"frontpage.php")===false)){
//        echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">首页 ></a>';
//    }
//    if(!(strpos($traceValue,"specificdetailpage.php")===false)){
//        echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">详情 ></a>';
//    }
//    if(!(strpos($traceValue,"searchpage.php")===false)){
//        echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">搜索 ></a>';
//    }if(isset($_SESSION['userID'])){
//        if(!(strpos($traceValue,"personalinformationpage.php")===false)){
//            echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">个人信息 ></a>';
//        }
//        if(!(strpos($traceValue,"shoppingcart.php")===false)){
//            echo '<a href="'.$traceValue.'" style="text-decoration: none;margin-right: 10px">购物车 ></a>';
//        }
//    }
//}
?>