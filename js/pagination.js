function changePageByNav(pageIndex) {
    document.getElementsByClassName("page-item active")[0].classList.remove('active');
    document.getElementsByClassName("page-item")[pageIndex].classList.add('active');

    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("artworksArea").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","changesearchresult.php?pageIndex="+pageIndex,true);//+"&sql="+sql
    xmlhttp.send();
}

document.getElementById("searchbar-input").onkeydown = function (ev) {
    var e = event || window.event || arguments.callee.caller.arguments[0];
    var keywords = document.getElementById('searchbar-input').value;
    if(e && e.keyCode==13){ // enter 键
        document.getElementById('searchcontent').innerText=keywords;
       changePageByKeys(keywords);
    }
}
function changeSelect() {
    if(document.getElementById("searchbar-input").value != ""){
        var keywords = document.getElementById("searchbar-input").value;
    }else {
        var keywords = document.getElementById("searchcontent").innerText;
    }

    var selectbox_choice = document.getElementById("displaiedBy").value;
    var checkbox_search = document.getElementsByName("searchby");
    var search_principle = [];
    for (var k in checkbox_search) {
        if (checkbox_search[k].checked)
            search_principle.push(checkbox_search[k].value);
    }//1名字，2简介，3作家
    if (search_principle.length == 0) {
        alert("请选择搜索方式")
    } else {
        var n = search_principle.length;
        var search_principle_str = "";
        for (var i = 0; i < n; i++) {
            search_principle_str += search_principle[i] + "";
        }
        document.location.href = "../php/searchpage.php?searchprin=" + search_principle_str + "&displayprin=" + selectbox_choice + "&keywords=" + keywords;
    }
}




function changePageByKeys(keywords) {
    var selectbox_choice = document.getElementById("displaiedBy").value;
    var checkbox_search = document.getElementsByName("searchby");
    var search_principle = [];
    for(var k in checkbox_search){
        if(checkbox_search[k].checked)
            search_principle.push(checkbox_search[k].value);
    }//1名字，2简介，3作家
    if(search_principle.length == 0){
        alert("请选择搜索方式")
    }else {
        var n = search_principle.length;
        var search_principle_str="";
        for (var i = 0; i < n; i++){
            search_principle_str += search_principle[i]+"";
        }

        // if (window.XMLHttpRequest)
        // {
        //     xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        // } else {
        //     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
        // }
        // xmlhttp.onreadystatechange = function (ev) {
        //     if (xmlhttp.readyState==4 && xmlhttp.status==200) {
        //         document.getElementById("artworksArea").innerHTML = xmlhttp.responseText;
        //        //刷新分页栏
        //         refreshPagesNav();
        //     }
        // }
        // xmlhttp.open("GET","findsearchresult.php?searchprin="+search_principle_str+"&keywords="+keywords,true);
        // xmlhttp.send();
        document.location.href = "../php/searchpage.php?searchprin="+search_principle_str+"&displayprin="+selectbox_choice+"&keywords="+keywords;
    }

}

function refreshPagesNav() {
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
    }
    xmlhttp.onreadystatechange = function (ev) {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {

        }
    }
    xmlhttp.open("GET","showpagesnav.php",true);
    xmlhttp.send();
}