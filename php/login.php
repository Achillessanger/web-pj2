<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/5
 * Time: 13:13
 */
//session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
echo <<<LOGINDIV
<div id="logindiv" class="pop-up-2 hide">
    <img src="../images/icons/cancel.png" class="pop-box-cancel" onclick="loginHide()">
    <p class="pop-up-logo">ArtStore</p>
    <p style="text-align: center;margin-bottom:20px">Please enter your username and password.</p>
    <form method="post" id="loginform">
    <table>
        <tr><p style="text-align: center"><input type="text" placeholder="昵称" class="gray" id="login-username-input" name="userName"></p></tr>
        <tr><p style="text-align: center"><input type="password" placeholder="密码" class="gray" id="login-password-input" name="password"></p></tr>
        <tr><p><input type="text" placeholder="验证码" class="gray" id="login-ic-input" autocomplete="off"><input type = "button" id="code" onclick="createCode()" value="点击获取"></tr>
        <tr><p class="remainder" id="r0"></p><p class="remainder hide" id="r1">*密码错误/用户不存在</p><p class="remainder hide" id="r3">*用户为空</p><p class="remainder hide" id="r4">*密码为空</p><p class="remainder hide" id="r5">*验证码错误</p></tr>
        <tr><input type="reset" style="display: none" id="loginreset"> </tr>
    </table></form>
    <p class="reg-yes" onclick="loginAffirm()">LOG IN</p>
    <p class="reg-already" onclick="loginHide() ,registerShow()">CREAT ACCOUNT</p>
    
</div>
LOGINDIV;
include "writesession.php";
?>