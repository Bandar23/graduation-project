<?php 
session_start(); 

if(!isset($_SESSION["Admin_Name"])){
    header("location:/graduationProject/login.php");
    exit;
  }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="body2">

<?php 
    include("admin_nav.php");
?>

<div id="content-area2">
    <div id="content_2">
      

    </div>
</div>
</body>
</html>