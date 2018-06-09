// 充值界面btn的onclick（）
function addMoney() {
    document.getElementById('chargeform').submit();
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById('balance').innerText = xmlhttp.responseText;
        }
    }
    if(parseInt(document.getElementById('chargeinput').value)==parseFloat(document.getElementById('chargeinput').value)&&document.getElementById('chargeinput').value>0){
        xmlhttp.open("GET","addmoney.php?add="+document.getElementById('chargeinput').value,true)
        xmlhttp.send();
    }else if(document.getElementById('chargeinput').value<=0){
        alert("请选择正整数充值");
    } else {
        alert("请按整数充值");
    }

    hideCharge();
}
function showCharge() {
    document.getElementById('charge-pop').classList.remove('hide');
}

function hideCharge() {
    document.getElementById('charge-pop').classList.add('hide');
}

//商品详情页面 添加购物车btn 的onclick()
function addToShoppingCart() {
    showAddtoSC();
    setTimeout(hideAddtoSC,500);
}
function showAddtoSC() {
    document.getElementById('addtocartsuccessfully').classList.remove('hide');
}
function hideAddtoSC() {
    document.getElementById('addtocartsuccessfully').classList.add('hide');
}

function addToShoppingCartAlready() {
    showAddtoSCAlready();
    setTimeout(hideAddtoSCAlready,500);
}
function showAddtoSCAlready() {
    document.getElementById('addtocartalready').classList.remove('hide');
}
function hideAddtoSCAlready() {
    document.getElementById('addtocartalready').classList.add('hide');
}

function alreadySold() {
    showalreadySold();
    setTimeout(hidealreadySold,500);
}
function showalreadySold() {
    document.getElementById('alreadySold').classList.remove('hide');
}
function hidealreadySold() {
    document.getElementById('alreadySold').classList.add('hide');
}

function pleaseLogIn() {
    showpleaseLogIn();
    setTimeout(hidepleaseLogIn,500);
}
function showpleaseLogIn() {
    document.getElementById('pleaselogin').classList.remove('hide');
}
function hidepleaseLogIn() {
    document.getElementById('pleaselogin').classList.add('hide');
}

function operateCart() {
    //js获取artworkID
    var url = document.location.toString();
    var arrUrl = url.split("=");
    var para = arrUrl[1];
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            if(xmlhttp.responseText == 1){
                addToShoppingCart();
            }
            if(xmlhttp.responseText == 2){
                addToShoppingCartAlready();
            }
            if(xmlhttp.responseText == 3){
                alreadySold();
            }
            if(xmlhttp.responseText == 4){
                pleaseLogIn();
            }
        }
    }
    xmlhttp.open("GET","addtocart.php?artworkID="+para,true)
    xmlhttp.send();

}