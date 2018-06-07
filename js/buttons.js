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
    xmlhttp.open("POST","addmoney.php",true)
    xmlhttp.send();

    // hideCharge();
}
function showCharge() {
    document.getElementById('charge-pop').classList.remove('hide');
}

function hideCharge() {
    document.getElementById('charge-pop').classList.add('hide');
}