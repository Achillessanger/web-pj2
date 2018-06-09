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