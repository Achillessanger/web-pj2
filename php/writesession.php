<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/5
 * Time: 23:28
 */

error_reporting(0);
$name = $_POST['userName'];
$password = $_POST['password'];

//登陆的
if(isset($_POST['userName'])){
    $sql = "select * FROM users WHERE users.name = '{$name}' AND password = '{$password}'";
    $result = $_mysqli ->query($sql);

    if($result){
        $row = $result ->fetch_assoc();
        $_SESSION["userID"] = $row['userID'];
        $_SESSION["userName"] = $name;
    }
}


//注册的
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$user_email = $_POST['user_email'];
$user_tel = $_POST['user_tel'];
$user_address = $_POST['user_address'];
$userTable = "select * from users";
$chooseUserTable = $_mysqli ->query($userTable);
$userNum = mysqli_num_rows($chooseUserTable);
$user_Id = $userNum+1;

$insertUserInfor = "insert into users(userID, users.name, email, password, tel, address, balance) VALUES ($user_Id ,'{$user_name}','{$user_email}','{$user_password}','{$user_tel}','{$user_address}',0)";
$result2 = $_mysqli ->query($insertUserInfor);
if($result2){
    $_SESSION["userID"] = $user_Id;
    $_SESSION["userName"] = "$user_name";
//   echo "<script>document.location.reload();</script>";//document.location.href = {$xxx};
}

?>