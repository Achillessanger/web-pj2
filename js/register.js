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

    document.getElementById('r1').classList.add('hide');//用户名密码错误，后端返回
    document.getElementById('r3').classList.add('hide');//用户为空，前端判断
    document.getElementById('r4').classList.add('hide');//密码为空，前端判断


    if(document.getElementById('login-username-input').value == ""){
        document.getElementById('r3').classList.remove('hide');
    }else if(document.getElementById('login-password-input').value == ""){
        document.getElementById('r4').classList.remove('hide');
    }else {

        document.getElementById('loginform').submit();
        loginHide();
        writeSession();
    }

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
    // if(canRegiste1&canRegiste2&canRegiste3&canRegiste&canRegiste5){
    //     alert("hi?")
    //     document.getElementById('registerform').submit();
    // }else {
    //     alert("hi?")
    //     document.getElementById('registerform').submit();
    // }
    document.getElementById('registerform').submit();

    writeSession();
}


function writeSession() {
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.location.reload();
                seeIfLoged();
        }
    }
    xmlhttp.open("POST","writesession.php",true)
    xmlhttp.send();
}
function seeIfLoged() {
    if (window.XMLHttpRequest)
    {
        xmlhttp2=new XMLHttpRequest();
    } else {
        xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp2.onreadystatechange = function (ev) {
        if (xmlhttp2.readyState==4 && xmlhttp2.status==200) {
            if(xmlhttp2.responseText == 0){
                showPopLoginFail();
                setTimeout(hidePopLoginFail,4000);
            }else if(xmlhttp2.responseText == 1){
                showPopLoginSuccess();
                setTimeout(hidePopLoginSuccess,2000);
            }
        }
    }
    xmlhttp2.open("POST","iflogsuccess.php",true)
    xmlhttp2.send();
}




function showPopLoginSuccess() {
    document.getElementById('loginsuccessfully').classList.remove('hide');
}
function hidePopLoginSuccess() {
    document.getElementById('loginsuccessfully').classList.add('hide');
}
function showPopLoginFail() {
    document.getElementById('loginfailed').classList.remove('hide');
}
function hidePopLoginFail() {
    document.getElementById('loginfailed').classList.add('hide');
}

function logOut() {
    if (window.XMLHttpRequest)
    {
        xmlhttp3=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp3=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp3.onreadystatechange = function (ev) {
        if (xmlhttp3.readyState==4 && xmlhttp3.status==200) {
            document.location.reload();
        }
    }
    xmlhttp3.open("POST","logout.php",true)
    xmlhttp3.send();
}







