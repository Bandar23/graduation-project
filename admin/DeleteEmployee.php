<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

require_once 'Config.php';


if(isset($_GET["del"]) && !empty(trim($_GET["del"]))){

    $Id = trim($_GET['del']);

    $Sql = "DELETE FROM employees WHERE Employee_id = ? ";

     if($stmt = mysqli_prepare($link,$Sql)){
         mysqli_stmt_bind_param($stmt,'i',$param_Id);

         $param_Id = $Id;

         if(mysqli_stmt_execute($stmt)){
            header("location: info_Management.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
} else{
    // Check existence of id parameter
    if(empty(trim($_GET["del"]))){
        // URL doesn't contain id parameter. Redirect to error page
        echo "Something's wrong with the query2: " . mysqli_error($link);
    }
}
?>
