<?php

session_start();

if(isset($_SESSION["Full_Name"])){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include("header.php");
    include("logedin_nav.php");
   // include("ads.php"); 
?>

<div id="content-area">
    <div id="content_">
        <div class="text-right centre">
            <h1 id="h1">:انظم الينا</h1>
            <p id="par">966 563 2135 354: رقم التواصل</p>
            <p id="par">dental_clinic@gmail.com: الايميل</p>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
<?php 
    include("footer.php");  
?>
    
</body>
</html>

<?php }else{ ?>

    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
   include("header.php");
   include("nav.php");
   include("ads.php"); 
?>

<div id="content-area">
    <div id="content_">
        <div class="text-right centre">
            <h1 id="h1">:انظم الينا</h1>
            <p id="par">966 563 2135 354: رقم التواصل</p>
            <p id="par">dental_clinic@gmail.com: الايميل</p>
        </div>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
<?php 
    include("footer.php");  
?>
    
</body>
</html>
<?php } ?>