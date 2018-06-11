<?php
/**
 * Created by PhpStorm.
 * User: ShiRuixin
 * Date: 2018/6/11
 * Time: 12:03
 */
session_start();
$_mysqli = mysqli_connect('localhost','root','');
mysqli_select_db($_mysqli,'artstore');
$_mysqli -> query("SET NAMES utf8");
error_reporting(0);
if(empty($_SESSION["userID"]) ){
    header("location:frontpage.php?a=1");
}
$artworkno = $_GET["artworkID"];
if(isset($artworkno)){
    $contentForm = mysqli_query($_mysqli,"select * FROM artworks WHERE artworkID = '{$artworkno}'");
    $veryArtwork = $contentForm ->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload</title>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/upload.css">
</head>
<body>
<nav class="navbar navbar-fixed-top">
    <div class="container">
        <ul class="nav pull-left left-ul">
            <li class="nav-item brand"><a href="frontpage.php"style="text-decoration: none; color:black;">
                    Art Store</a>
            </li>
            <li class="nav-item slogen">
                Where you find GENIUS and EXTROORDINARY
            </li>

        </ul>
        <div id="rightnavbar">
            <?php include 'logornot.php'; ?>
        </div>
    </div>
</nav>
<div class="container welcometitle">
    <div class="welcome">
        <p style="display: inline">Welcome <p style="display: inline;color: #ff5500"><?php echo $_SESSION["userName"] ?></p></p>
    </div>
</div>

<div class="container uploaddiv">

    <form id="uploadform" method="post" enctype="multipart/form-data">
        <fieldset class="form-group">
            <div class="container">
                <label for="exampleInputPicture">Upload your painting</label>
                <input type="file" class="form-control" id="inputPicture" onchange="showPicture(this);seeIfUploadPic();" name="file">
                <img  class="form-control" width="400px"  <?php
                 if(isset($artworkno)){
                     echo 'src="../resources/img/'.$veryArtwork["imageFileName"].'"';
                 }else{
                     echo 'style="display: none"';
                 }
                     ?>  id="picturepreview">
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="container">
                <label for="exampleInputTitle">Painting Title</label>
                <input type="text" class="form-control" id="inputTitle" name="inputTitle" placeholder="This item cannot be empty" onblur="seeIfNoContent(this)" <?php
                if(isset($artworkno)){
                    echo 'value="'.$veryArtwork["title"].'"';
                } ?> >
                <!--            <small class="text-muted">We'll never share your email with anyone else.</small>-->
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="container">
                <label for="exampleInputArtist">The Artist</label>
                <input type="text" class="form-control" id="inputArtist" name="inputArtist" placeholder="This item cannot be empty"  onblur="seeIfNoContent(this)" <?php
                if(isset($artworkno)){
                    echo 'value="'.$veryArtwork["artist"].'"';
                } ?> >
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="container">
                <label for="exampleTextareaDes">Description</label>
                <textarea class="form-control" id="exampleTextareaDes" rows="3" name="exampleTextareaDes" onblur="seeIfNoContent(this)" placeholder="This item cannot be empty" ><?php
                    if(isset($artworkno)){
                        echo $veryArtwork["description"];
                    } ?> </textarea>
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="container">
                <label for="exampleInputYear">Year Of Work</label>
                <input type="text" class="form-control" id="inputYear" name="inputYear" placeholder="Please input an integer"  onblur="seeIfInt(this);" <?php
                if(isset($artworkno)){
                    echo 'value="'.$veryArtwork["yearOfWork"].'"';
                } ?> >
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="container">
                <label for="exampleInputGenre">Genre</label>
                <input type="text" class="form-control" id="inputGenre" name="inputGenre" placeholder="This item cannot be empty" onblur="seeIfNoContent(this)" <?php
                if(isset($artworkno)){
                    echo 'value="'.$veryArtwork["genre"].'"';
                } ?>  >
            </div>
        </fieldset>
        <fieldset class="form-group">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleInputLength">Length</label>
                        <input type="number" class="form-control" id="inputLength" name="inputLength" min="0" placeholder="positive" onblur="seeIfPositive(this);"  <?php
                        if(isset($artworkno)){
                            echo 'value="'.$veryArtwork["width"].'"';
                        } ?> >
                    </div>
                    <div class="col-md-6">
                        <label for="exampleInputWidth">Width</label>
                        <input type="number" class="form-control" id="inputWidth" name="inputWidth" min="0" placeholder="positive" onblur="seeIfPositive(this);" <?php
                        if(isset($artworkno)){
                            echo 'value="'.$veryArtwork["height"].'"';
                        } ?> >
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="container">
                <label for="exampleInputPrice">Price $</label>
                <input type="number" class="form-control" id="inputPrice" min="0" name="inputPrice" placeholder="Please enter a positive integer" onblur="seeIfPositiveInt(this)" <?php
                if(isset($artworkno)){
                    echo 'value="'.$veryArtwork["price"].'"';
                } ?> >
            </div>
        </fieldset>

        <div class="container">
            <button type="button" class="btn btn-primary" <?php if(isset($artworkno)){
                echo 'onclick="submitForm2('.$artworkno.');"';//update
            }else{
                echo ' onclick="submitFrom();"';//insert
            }
            ?>>Submit</button>
        </div>
    </form>


</div>
<?php

if(isset($artworkno)){
    include "updatemygood.php";
}else{
    include "uploadnewgood.php";
}
?>


<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/upload.js"></script>
<script type="text/javascript" src="../js/register.js"></script>
</body>
</html>
