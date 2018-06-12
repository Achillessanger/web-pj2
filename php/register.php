<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/5
 * Time: 12:18
 */
//session_start();//session只能放在最前没有输出的时候
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
echo <<<REGISTERDIV
<div id="registerdiv" class="pop-up hide">
        <img src="../images/icons/cancel.png" class="pop-box-cancel" onclick="registerHide()">
        <p class="pop-up-logo">ArtStore</p>
        <p style="text-align: center;margin-bottom:20px">Register for ArtStore</p>
    <form id="registerform" method="post" name="registerform">
        <table name="registertable">
            <tr><td><p class="reg-boxs">昵称： </p></td><td><input type="text" placeholder="昵称" class="gray" id="in1" name="user_name"></td><td class="remainder2 hide" id="rm1">*至少六位</td><td class="remainder2 hide" id="rm2">*需要数字和字母</td><td class="remainder2 hide" id="rm3">*不可为空</td><td class="remainder2 hide" id="rm13">*用户名已存在</td></tr>
            <tr><td><p class="reg-boxs">密码： </p></td><td><input type="password" placeholder="密码" class="gray"id="in2" onclick="c1()" name="user_password"></td><td class="remainder2 hide" id="rm4">*至少六位</td><td class="remainder2 hide" id="rm5">*不能与昵称相同</td><td class="remainder2 hide" id="rm6">*不可为空</td><td class="remainder2 hide" id="rm14">*需要数字和字母</td></tr>
            <tr><td><p class="reg-boxs">确认密码： </p></td><td><input type="password" placeholder="确认密码" class="gray"id="in3" onclick="c1();c2()"></td><td class="remainder2 hide" id="rm7">*需与密码相同</td></tr>
            <tr><td><p class="reg-boxs">邮箱： </p></td><td><input type="text" placeholder="邮箱" class="gray"id="in4" onclick="c3();c2();c1()" name="user_email"></td><td class="remainder2 hide" id="rm8">*不得为空</td><td class="remainder2 hide" id="rm9">*格式不正确</td></tr>
            <tr><td><p class="reg-boxs">电话： </p></td><td><input type="text" placeholder="电话" class="gray"id="in5" onclick="c1();c2();c3();c4()" name="user_tel"></td><td class="remainder2 hide" id="rm10">*不得为空</td><td class="remainder2 hide" id="rm11">*格式不正确</td></tr>
            <tr><td><p class="reg-boxs">地址： </p></td><td><input type="text" placeholder="地址" class="gray"id="in6" onclick="c5();c4();c3();c2();c1()" name="user_address"></td><td class="remainder2" id="rm12">*</td></tr>
            <tr><td><input type="reset" id="resetbut" style="display: none"></td></tr>
        </table>
    </form>
        <p class="reg-yes" onclick="registerCheck()">REGISTER</p>
        <p class="reg-already" onclick="registerHide();loginShow()">ALREADY REGISTERED?SIGN IN</p>

    <div id="regsuccess" class="pop-addtoSC hide">
        <p>Registered successfully :)</p>
    </div>
    </div>
REGISTERDIV;

include "writesession.php"
?>