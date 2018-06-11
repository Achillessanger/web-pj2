<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/5
 * Time: 0:47
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
    <link rel="stylesheet" href="../css/personalinformationpage.css">
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
</nav>

<div class="container welcometitle">

        <div class="welcome">
            <p style="display: inline">Welcome <p style="display: inline;color: #ff5500"><?php echo $_SESSION["userName"] ?></p></p>
        </div>
        <div class="upload">
            <a class="oriange" id="upload-orange" href="upload.php" style="text-decoration: none">发布艺术品</a>
        </div>

</div>

<?php
$sql = "select * FROM users WHERE userID = '{$_SESSION['userID']}'";
$result = $_mysqli ->query($sql);
$row = $result ->fetch_assoc();

?>

<div class="container">
    <div class="row content">
        <div class="col-md-3">

            <table class="personaldetails">
                <tr>
                    <td>用户：</td>
                    <td><?php echo $row['name'] ?></td>
                </tr>
                <tr>
                    <td>电话：</td>
                    <td><?php echo $row['tel'] ?></td>
                </tr>
                <tr>
                    <td>邮箱：</td>
                    <td><?php echo $row['email'] ?></td>
                </tr>
                <tr>
                    <td>地址：</td>
                    <td><?php echo $row['address'] ?></td>
                </tr>
                <tr>
                    <td >余额：</td>
                    <td id="balance"><?php echo $row['balance'] ?></td>
                </tr>
                <tr class="rechargetr">
                    <td colspan="2">
                        <button class="rechargebut" onclick="showCharge()">充值信仰</button>
                    </td>
                </tr>
            </table>
        </div>
        <?php
            $myOrdersForm = mysqli_query($_mysqli,"select * FROM orders WHERE ownerID ='{$_SESSION['userID']}' ");
        ?>
        <div class="col-md-9">
            <div class="row uploaded">
                <div class="card">
                    <div class="card-header">
                        <p style="text-align: left" class="card-text">我上传的艺术品：</p>
                    </div>
                    <div class="card-block">
                        <table id="uploadnotsoldtable">
                        <?php
                            $myUploadStillNotSoldForm = mysqli_query($_mysqli,"select artworkID,imageFileName,title,timeReleased FROM artworks WHERE ownerID ='{$_SESSION['userID']}' AND orderID IS NULL ");
                            while ($myUploadsStillNotSold = $myUploadStillNotSoldForm ->fetch_assoc()){
                                echo <<<MYUPLOADSNOTSOLD
                                <tr style="border-bottom: 1px solid black;">
                                <td width="15%"><img src="../resources/img/{$myUploadsStillNotSold["imageFileName"]}" width="100%"></td>
                                <td width="30%" class="text-center"><a href="specificdetailpage.php?artworkID={$myUploadsStillNotSold["artworkID"]}" style="text-decoration: none;font-weight: bolder" id="link">{$myUploadsStillNotSold["title"]}</a></td>
                                <td width="30%" >发布时间：{$myUploadsStillNotSold["timeReleased"]}</td>
                                <td width="25%"><button class="blackbutton2" style="width: 80%" id="modify" onclick="modifyContents(({$myUploadsStillNotSold["artworkID"]}))">MODIFY CONTENT</button><button class="whitebutton2" style="width: 80%">DELETE IT</button></td>
                                </tr>
MYUPLOADSNOTSOLD;

                            }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <p style="text-align: left" class="card-text">我的订单列表：</p>
                    </div>
                    <div class="card-block">
                        <table class="orderform" cellspacing="10px">
                            <?php
                                while ($myOrders = $myOrdersForm ->fetch_assoc()) {
                                    $orderInArtworks = mysqli_query($_mysqli, "select title,artworkID FROM artworks WHERE orderID='{$myOrders["orderID"]}'");
                                    $myVeryOrder = $orderInArtworks->fetch_assoc();
                                    echo <<<MYORDERS
                                    <tr>
                                <td width="15%">订单编号：{$myOrders["orderID"]}</td>
                                <td width="35%" ><a href="specificdetailpage.php?artworkID={$myVeryOrder["artworkID"]}" style="text-decoration: none;" id="ordername">商品名称：{$myVeryOrder["title"]}</a></td>
                                <td width="30%">订单时间：{$myOrders["timeCreated"]}</td>
                                <td width="20%">订单总金额：$ {$myOrders["sum"]}</td>
                                </tr>
MYORDERS;
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <p style="text-align: left" class="card-text">我的卖出列表：</p>
                    </div>
                    <div class="card-block">
                        此处是我卖出去的
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="charge-pop" class="charge-pop hide">
    <img src="../images/icons/cancel.png"  onclick="hideCharge()">
    <form method="post" id="chargeform">
        <p>充值金额：</p>
        <input type="number" placeholder="请输入充值金额" min="1" id="chargeinput" name="charge"><br>
        <button type="submit" id="chargebtn" onclick="addMoney()">确认充值</button>
    </form>

</div>





<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--<script type="text/javascript" src="linkToSearchPagereg.js"></script>-->
<script type="text/javascript" src="../js/buttons.js"></script>
<script type="text/javascript" src="../js/register.js"></script>
</body>
</html>
