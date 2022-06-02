<?php 

session_start(); 

if(!isset($_SESSION["Full_Name"])){
  header("location: login.php");
  exit;
}




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include("header.php");
    include("logedin_nav.php");
?>



<div id="content-area">
 
    <div id="content_">
<!--    conternt   -->   
    <section id="content">
             <div id="First-Content">
               <centre>

               </centre>
               </div>
               </section>
    </div>
</div>
<?php 
    include("footer.php");  
?>
    
</body>
</html>



