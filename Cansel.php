<?php 

session_start();


if(isset($_SESSION["Full_Name"])){

if(isset($_GET['Cans']) && !empty(trim($_GET['Cans']))){

    require_once 'Config.php';
   
    $Sql_Delete = "DELETE FROM apoointments WHERE Apoointment_Id = ?";

    if($stmt = mysqli_prepare($link,$Sql_Delete)){
        mysqli_stmt_bind_param($stmt,"i",$param_Id);

        $param_Id = $_GET['Cans'];

        if(mysqli_stmt_execute($stmt)){
            $_SESSION['msg'] = "تم إلغاء الموعد ";
            header("location: User_Appointment.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}else{
    // Check existence of id parameter
    if(empty(trim($_GET["id"]))){
        // URL doesn't contain id parameter. Redirect to error page
       echo "URL doesn't contain id parameter";
        exit();
    }
}
        
    

}else{
    header("location: login.php");
}

    


?>
