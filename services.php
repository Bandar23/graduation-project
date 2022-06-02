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

        <a  class="card-img-link" href="#">
            <div class="card">       
                <img class="card_img" src="Orthodontic.jpg" alt="تقويم الاسنان">  
                <div class="card-content">
                    <h2>
                        تقويم اسنان
                    </h2>    
                </div>
            </div>
        </a>

        <a class="card-img-link" href="#">
            <div class="card">  
                <img class="card_img" src="smail.jpg" alt="تبيض اسنان">
                <div class="card-content">
                    <h2>
                        تبيض اسنان
                    </h2>
                </div>
            </div>
        </a>

        <a  class="card-img-link" href="#">
            <div class="card">       
                <img class="card_img" src="Dentures.jpg" alt="تركيب اسنان">  
                <div class="card-content">
                    <h2>
                        تركيب اسنان
                    </h2>    
                </div>
            </div>
        </a>

        <a class="card-img-link" href="#">
            <div class="card">  
                <img class="card_img" src="Orthodontic.jpg" alt="تقويم الاسنان">
                <div class="card-content">
                    <h2>
                        تقويم اسنان
                    </h2>
                </div>
            </div>
        </a>

        
    </div>
</div>
<?php 
    include("footer.php");  
?>
    
</body>
</html>
 <?php 

}else{ ?>

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
    //include("ads.php"); 
?>

<div id="content-area">
    <div id="content_">

        <a  class="card-img-link" href="#">
            <div class="card">       
                <img class="card_img" src="Orthodontic.jpg" alt="تقويم الاسنان">  
                <div class="card-content">
                    <h2>
                        تقويم اسنان
                    </h2>    
                </div>
            </div>
        </a>

        <a class="card-img-link" href="#">
            <div class="card">  
                <img class="card_img" src="smail.jpg" alt="تبيض اسنان">
                <div class="card-content">
                    <h2>
                        تبيض اسنان
                    </h2>
                </div>
            </div>
        </a>

        <a  class="card-img-link" href="#">
            <div class="card">       
                <img class="card_img" src="Dentures.jpg" alt="تركيب اسنان">  
                <div class="card-content">
                    <h2>
                        تركيب اسنان
                    </h2>    
                </div>
            </div>
        </a>

        <a class="card-img-link" href="#">
            <div class="card">  
                <img class="card_img" src="Orthodontic.jpg" alt="تقويم الاسنان">
                <div class="card-content">
                    <h2>
                        تقويم اسنان
                    </h2>
                </div>
            </div>
        </a>

        
    </div>
</div>
<?php 
    include("footer.php");  
?>
    
</body>
</html>

<?php } ?>

