ifLoged = false;
ifAlreadyAffirmed = false;
userName = "";
userPassword = "";
canRegiste1 = false;
canRegiste2 = false;
canRegiste3 = false;
canRegiste4 = false;
canRegiste5 = false;
code0 = "";
failRegis = false;

function registerShow(){
    loginHide();
    createCode();
    canRegiste = false;
    document.getElementById('resetbut').click();
    document.getElementById('registerdiv').classList.remove('hide');
}

function registerHide() {
    document.getElementById('rm1').classList.add('hide');
    document.getElementById('rm2').classList.add('hide');
    document.getElementById('rm3').classList.add('hide');
    document.getElementById('rm4').classList.add('hide');
    document.getElementById('rm5').classList.add('hide');
    document.getElementById('rm6').classList.add('hide');
    document.getElementById('rm7').classList.add('hide');
    document.getElementById('rm8').classList.add('hide');
    document.getElementById('rm9').classList.add('hide');
    document.getElementById('rm10').classList.add('hide');
    document.getElementById('rm11').classList.add('hide');
    document.getElementById('rm13').classList.add('hide');
    canRegiste = false;
    document.getElementById('registerdiv').classList.add('hide');
}

function loginShow(){
    registerHide();
    ifLoged = false;
    document.getElementById('loginreset').click();
    document.getElementById('logindiv').classList.remove('hide');
}

function loginHide() {
    document.getElementById('r1').classList.add('hide');
    // document.getElementById('r2').classList.add('hide')
    document.getElementById('r3').classList.add('hide');
    document.getElementById('r4').classList.add('hide');
    document.getElementById('r5').classList.add('hide');
    document.getElementById('logindiv').classList.add('hide');
}

function loginAffirm() {

    document.getElementById('r1').classList.add('hide');
    // document.getElementById('r2').classList.add('hide')
    document.getElementById('r3').classList.add('hide');
    document.getElementById('r4').classList.add('hide');
    document.getElementById('r5').classList.add('hide');

    if(document.getElementById('login-username-input').value == ""){
        document.getElementById('r3').classList.remove('hide');
    }else if(document.getElementById('login-password-input').value == ""){
        document.getElementById('r4').classList.remove('hide');
    }else if(document.getElementById('login-username-input').value == "123"&document.getElementById('login-password-input').value == "123"){
        document.getElementById('r1').classList.remove('hide');
    }else if(document.getElementById('login-ic-input').value != code0 || document.getElementById('login-ic-input').value == ""){
        document.getElementById('r5').classList.remove('hide');
    }else {

        // document.getElementById('nav-notyet').classList.add('hide');
        // document.getElementById('nav-already').classList.remove('hide');
        userName = document.getElementById('login-username-input').value;
        userPassword = document.getElementById('login-password-input').value;
        loginHide();
        ifLoged = true;
        window.location.href="frontpage-registered.html";
        alert("登陆成功");
    }

}

function loginAffirmSpeP() {


    document.getElementById('r1').classList.add('hide');
    // document.getElementById('r2').classList.add('hide')
    document.getElementById('r3').classList.add('hide');
    document.getElementById('r4').classList.add('hide');
    document.getElementById('r5').classList.add('hide');

    if(document.getElementById('login-username-input').value == ""){
        document.getElementById('r3').classList.remove('hide');
    }else if(document.getElementById('login-password-input').value == ""){
        document.getElementById('r4').classList.remove('hide');
    }else if(document.getElementById('login-username-input').value == "123"&document.getElementById('login-password-input').value == "123"){
        document.getElementById('r1').classList.remove('hide');
    }else if(document.getElementById('login-ic-input').value != code0 || document.getElementById('login-ic-input').value == ""){
        document.getElementById('r5').classList.remove('hide');
    }else {

        // document.getElementById('nav-notyet').classList.add('hide');
        // document.getElementById('nav-already').classList.remove('hide');
        userName = document.getElementById('login-username-input').value;
        userPassword = document.getElementById('login-password-input').value;
        loginHide();
        ifLoged = true;
        window.location.href="specificdetailpage-registered.html";
        alert("登陆成功");
    }


}
function loginAffirmSearchP() {
    document.getElementById('r1').classList.add('hide');
    // document.getElementById('r2').classList.add('hide')
    document.getElementById('r3').classList.add('hide');
    document.getElementById('r4').classList.add('hide');
    document.getElementById('r5').classList.add('hide');

    if(document.getElementById('login-username-input').value == ""){
        document.getElementById('r3').classList.remove('hide');
    }else if(document.getElementById('login-password-input').value == ""){
        document.getElementById('r4').classList.remove('hide');
    }else if(document.getElementById('login-username-input').value == "123"&document.getElementById('login-password-input').value == "123"){
        document.getElementById('r1').classList.remove('hide');
    }else if(document.getElementById('login-ic-input').value != code0 || document.getElementById('login-ic-input').value == ""){
        document.getElementById('r5').classList.remove('hide');
    }else {
        // document.getElementById('nav-notyet').classList.add('hide');
        // document.getElementById('nav-already').classList.remove('hide');
        userName = document.getElementById('login-username-input').value;
        userPassword = document.getElementById('login-password-input').value;
        loginHide();
        ifLoged = true;
        window.location.href="searchpage-registered.html";
        alert("登陆成功");
    }


}

// function refreshNavbar() {
//     if(ifLoged){
//         document.getElementById('nav-notyet').classList.add('hide')
//         document.getElementById('nav-already').classList.remove('hide')
//     }else {
//         document.getElementById('nav-notyet').classList.remove('hide')
//         document.getElementById('nav-already').classList.add('hide')
//     }
// }
function logout() {
    ifLoged = false;
    window.location.href="frontpage.html";
}

function c1() {
    var k1 = /[0-9]/;
    var k2 = /[a-z]/i;
    stringin1 = document.getElementById('in1').value;
    ifJudegedin1 = true;
    if(document.getElementById('in1').value == ""){
        document.getElementById('rm1').classList.add('hide');
        document.getElementById('rm2').classList.add('hide');
        document.getElementById('rm3').classList.remove('hide');
        canRegiste1 = false;
    }else if(document.getElementById('in1').value.length < 6 && document.getElementById('in1').value.length > 0){
        document.getElementById('rm3').classList.add('hide');
        document.getElementById('rm2').classList.add('hide');
        document.getElementById('rm1').classList.remove('hide');
        canRegiste1 = false;
    }else if(!(k1.test(stringin1)&& k2.test(stringin1))){
        document.getElementById('rm3').classList.add('hide');
        document.getElementById('rm1').classList.add('hide');
        document.getElementById('rm2').classList.remove('hide');
        canRegiste1 = false;
    }else {
        document.getElementById('rm1').classList.add('hide');
        document.getElementById('rm2').classList.add('hide');
        document.getElementById('rm3').classList.add('hide');
        canRegiste1 = true;
    }

}
function c2() {
    stringin2 = document.getElementById('in2').value;
    if(document.getElementById('in2').value == ""){
        document.getElementById('rm4').classList.add('hide');
        document.getElementById('rm5').classList.add('hide');
        document.getElementById('rm6').classList.remove('hide');
        canRegiste2 = false;
    }else if(document.getElementById('in2').value.length < 6 && document.getElementById('in2').value.length > 0){
        document.getElementById('rm6').classList.add('hide');
        document.getElementById('rm5').classList.add('hide');
        document.getElementById('rm4').classList.remove('hide');
        canRegiste2 = false;
    }else if(stringin1 == stringin2){
        document.getElementById('rm4').classList.add('hide');
        document.getElementById('rm6').classList.add('hide');
        document.getElementById('rm5').classList.remove('hide');
        canRegiste2 = false;
    }else {
        document.getElementById('rm4').classList.add('hide');
        document.getElementById('rm5').classList.add('hide');
        document.getElementById('rm6').classList.add('hide');
        canRegiste2 = true;
    }

}
function c3() {
    stringin3 = document.getElementById('in3').value;
    if(document.getElementById('in1').value==""&&document.getElementById('in2').value == ""){
        document.getElementById('rm7').classList.add('hide');
        canRegiste3 = false;
    }else if(!(stringin3 == stringin2)){
        document.getElementById('rm7').classList.remove('hide');
        canRegiste3 = false;
    }else {
        document.getElementById('rm7').classList.add('hide');
        canRegiste3 = true;
    }
}
function c4() {
    var k3 = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
    stringin4 = document.getElementById('in4').value;
    if(stringin4 == ""){
        document.getElementById('rm9').classList.add('hide');
        document.getElementById('rm8').classList.remove('hide');
        canRegiste4 = false;
    }else if(!k3.test(stringin4)){
        document.getElementById('rm8').classList.add('hide');
        document.getElementById('rm9').classList.remove('hide');
        canRegiste4 = false;
    }else {
        document.getElementById('rm8').classList.add('hide');
        document.getElementById('rm9').classList.add('hide');
        canRegiste4 = true;
    }
}
function c5() {
    stringin5 = document.getElementById('in5').value;
    // var k4 = /^[0-9]+$/;
    var k4 = /^[\d]+$/;
    if(stringin5 == ""){
        document.getElementById('rm11').classList.add('hide');
        document.getElementById('rm10').classList.remove('hide');
        canRegiste5 = false;
    }else if(!(k4.test(stringin5)&& stringin5.length == 11)){
        document.getElementById('rm10').classList.add('hide');
        document.getElementById('rm11').classList.remove('hide');
        canRegiste5 = false;
    }else {
        document.getElementById('rm10').classList.add('hide');
        document.getElementById('rm11').classList.add('hide');
        canRegiste5 = true;
    }
}




function registerCheck() {
    c1();
    c2();
    c3();
    c4();
    c5();
    if(canRegiste1&canRegiste2&canRegiste3&canRegiste&canRegiste5){
        alert("hi?")
        document.getElementById('registerform').submit();
    }else {
        alert("hi?")
        document.getElementById('registerform').submit();
    }
}
function registeSpeP() {
    c1();
    c2();
    c3();
    c4();
    c5();
    c13();
    if(canRegiste1&canRegiste2&canRegiste3&canRegiste&canRegiste5){

        window.location.href="specificdetailpage-registered.html";
        alert("注册成功");
    }
    if(failRegis){
        window.location.href="specificdetailpage.html";
        alert("注册失败 用户名已存在");
    }
}
function registeSearchP() {
    c1();
    c2();
    c3();
    c4();
    c5();
    c13();
    if(canRegiste1&canRegiste2&canRegiste3&canRegiste&canRegiste5){
        window.location.href="searchpage-registered.html";
        alert("注册成功");
    }
    if(failRegis){
        window.location.href="searchpage.html";
        alert("注册失败 用户名已存在");
    }
}



//验证码
var code;
function createCode(){
    //首先默认code为空字符串
    code = '';
    //设置长度，这里看需求，我这里设置了4
    var codeLength = 4;
    var codeV = document.getElementById('code');
    //设置随机字符
    var random = new Array(0,1,2,3,4,5,6,7,8,9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R', 'S','T','U','V','W','X','Y','Z');
    //循环codeLength 我设置的4就是循环4次
    for(var i = 0; i < codeLength; i++){
        //设置随机数范围,这设置为0 ~ 36
        var index = Math.floor(Math.random()*36);
        //字符串拼接 将每次随机的字符 进行拼接
        code += random[index];
    }
    //将拼接好的字符串赋值给展示的Value
    codeV.value = code;
    code0 = code;
}




