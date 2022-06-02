<?php 

session_start(); 

if(!isset($_SESSION["Mang_Name"])){
    header("location:/graduationProject2/login.php");
    exit;
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدير الموظفين</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="body2">

<?php 
    include("manager_nav.php");
?>

<div id="content-area2">
    <div id="content_2">
     

    </div>
</div>
</body>
</html>