function showPicture(obj) {
    if(checkImgType(obj)){
        document.getElementById("picturepreview").style.display = "block";
        document.getElementById("picturepreview").src = window.URL.createObjectURL(obj.files[0]);
    }
}

function checkImgType(ths){
    if (ths.value == "") {
        return false;
    } else {
        if (!/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test(ths.value)) {
            ths.value = "";
            return false;
        }
    }
    return true;
}

var title_input = document.getElementById('inputTitle');
var artist_input = document.getElementById('inputArtist');
var description_input = document.getElementById('exampleTextareaDes');
var year_input = document.getElementById('inputYear');
var genre_input = document.getElementById('inputGenre');
var length_input = document.getElementById('inputLength');
var width_input = document.getElementById('inputWidth');
var price_input = document.getElementById('inputPrice');

function seeIfNoContent(obj) {
    if(obj.value == ""|| !obj.value){
        obj.classList.add("haserror");
    }else {
        obj.classList.remove("haserror");
    }
}
function seeIfPositive(obj) {
    if(parseInt(obj.value)<=0||obj.value == ""|| !obj.value){
        if(!obj.classList.contains("haserror")){

            obj.classList.add("haserror");
        }
    }else {
        obj.classList.remove("haserror");
    }
}
function seeIfInt(obj) {
    if(!(parseInt(obj.value) == obj.value)||obj.value == ""|| !obj.value){
        if(!obj.classList.contains("haserror")){
            obj.classList.add("haserror");
        }
    }else {
        obj.classList.remove("haserror");
    }
}
function seeIfPositiveInt(obj) {
    if(!(parseInt(obj.value) == obj.value)||obj.value == ""|| !obj.value||parseInt(obj.value)<=0){
        if(!obj.classList.contains("haserror")){
            obj.classList.add("haserror");
        }
    }else {
        obj.classList.remove("haserror");
    }
}
function seeIfUploadPic() {
    if(document.getElementById("picturepreview").style.display == "none"){
        document.getElementById("inputPicture").classList.add("haserror");
    }else {
        document.getElementById("inputPicture").classList.remove("haserror");
    }
}
function submitFrom() {

    if(canSubmit()){
        document.getElementById("uploadform").submit();

        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        } else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
        }
        xmlhttp.onreadystatechange = function (ev) {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                window.location.href = "../php/personalinformationpage.php";
            }
        }
            xmlhttp.open("GET","uploadnewgood.php",true);
            xmlhttp.send();
    }
}
function submitForm2(id) {
    if(canSubmit()){
        document.getElementById("uploadform").submit();

        if (window.XMLHttpRequest)
        {
            xmlhttp=new XMLHttpRequest();// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
        } else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");// IE6, IE5 浏览器执行代码
        }
        xmlhttp.onreadystatechange = function (ev) {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                alert(xmlhttp.responseText)
                // window.location.href = "../php/personalinformationpage.php";
            }
        }
        xmlhttp.open("GET","updatemygood.php?id="+id,true);
        xmlhttp.send();


    }
}
function canSubmit() {
    seeIfUploadPic();
    seeIfNoContent(title_input);seeIfNoContent(artist_input);seeIfNoContent(description_input);
    seeIfInt(year_input);
    seeIfNoContent(genre_input);
    seeIfPositive(length_input);seeIfPositive(width_input);
    seeIfPositiveInt(price_input);


    if(document.getElementsByClassName("haserror").length == 0){
        return true;
    }else {
        return false;
    }
}

