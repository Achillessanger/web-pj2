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
    document.getElementById('addtocartsuccessfully').classList.remove('hide');
    setTimeout(hideAddtoSC,500);
}
function hideAddtoSC() {
    document.getElementById('addtocartsuccessfully').classList.add('hide');
}

function addToShoppingCartAlready() {
    document.getElementById('addtocartalready').classList.remove('hide');
    setTimeout(hideAddtoSCAlready,500);
}
function hideAddtoSCAlready() {
    document.getElementById('addtocartalready').classList.add('hide');
}

function alreadySold() {
    document.getElementById('alreadySold').classList.remove('hide');
    setTimeout(hidealreadySold,500);
}
function hidealreadySold() {
    document.getElementById('alreadySold').classList.add('hide');
}

function pleaseLogIn() {
    document.getElementById('pleaselogin').classList.remove('hide');
    setTimeout(hidepleaseLogIn,500);
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

//购物车页面 删除按钮
function deleteGood(obj,id,price) {
    var total = document.getElementById("puttotalmon").innerText;
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            obj.parentNode.parentNode.parentNode.removeChild(obj.parentNode.parentNode);
            document.getElementById("paybtn").innerText = "PAY $" +xmlhttp.responseText;
            document.getElementById("puttotalmon").innerText = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","deletegood.php?artworkID="+id+"&price="+price+"&total="+total,true);
    xmlhttp.send();
}

//购物车页面 结账btn
function pay() {
    var total = document.getElementById("puttotalmon").innerText;
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            if(xmlhttp.responseText.charAt(0)==0){
                payFailed_deleted();
            }
            if(xmlhttp.responseText.charAt(0)==1){
                payFailed_priceChanged();
            }
            if(xmlhttp.responseText.charAt(0)==2){
                payFailed_bought();
            }
            if(xmlhttp.responseText.charAt(0)==3){
                payFailed_noEnoughMoney();
            }
            if(xmlhttp.responseText.charAt(0)==4){
                paySuccessfully()
            }
        }
    }
    xmlhttp.open("GET","pay.php?mytotal="+total,true);
    xmlhttp.send();
}
function payFailed_deleted() {
    document.getElementById('goodDeleted').classList.remove('hide');
    setTimeout(hidepayFailed0,500);
}
function hidepayFailed0() {
    document.getElementById('goodDeleted').classList.add('hide');
}

function payFailed_priceChanged() {
    document.getElementById('priceChanged').classList.remove('hide');
    setTimeout(hidepayFailed1,500);
}
function hidepayFailed1() {
    document.getElementById('priceChanged').classList.add('hide');
}

function payFailed_bought() {
    document.getElementById('goodSold').classList.remove('hide');
    setTimeout(hidepayFailed2,500);
}
function hidepayFailed2() {
    document.getElementById('goodSold').classList.add('hide');
}

function payFailed_noEnoughMoney() {
    document.getElementById('nomoney').classList.remove('hide');
    setTimeout(hidepayFailed3,500);
}
function hidepayFailed3() {
    document.getElementById('nomoney').classList.add('hide');
}

function paySuccessfully() {
    document.getElementById('paidsuccessfully').classList.remove('hide');
    setTimeout(hidepayFailed4,500);
}
function hidepayFailed4() {
    document.getElementById('paidsuccessfully').classList.add('hide');
    document.location.reload();
}

function modifyContents(artworkID) {
    window.location.href = "../php/upload.php?artworkID="+artworkID;
}
function deleteMyGood(artworkID) {
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.location.reload();
        }
    }
    if(window.confirm("确定删除此项物品吗？")){
        xmlhttp.open("GET","deletemygood.php?artworkID="+artworkID,true)
        xmlhttp.send();
    }

}