<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

$department_id = $department_Name = $Departments_Phone = $Clinic = $param_id ="";
if(isset($_GET["edit"]) && !empty(trim($_GET["edit"]))){

    
    require_once 'Config.php';

    $Department_Data ="SELECT * FROM departments WHERE Departments_Id = ? ";

    if($stmt = mysqli_prepare($link,$Department_Data)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["edit"]);


        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $department_Name  = $row['Departments_Name'];
            $Departments_Phone  = $row['Departments_Phone'];
            $Clinic      = $row['Clinic_Id'];

        }else {
            echo "There Is SomeThing Wrong ! ";
            echo "Something's wrong with the query: " . mysqli_error($link);

        }

    }else{
        echo "Oops! Something went wrong. Please try again later.";
    }
    mysqli_stmt_close($stmt);


}

}


$dep_name = $dep_phone = $dep_clic = $dep_id ="";
$dep_name_er = $dep_phone_er = $dep_clic_er = $done = $er ="";

if(isset($_POST['Edit'])){
    require_once 'Config.php';


    $input_name = trim($_POST['dep']);
    if(empty($input_name)){
        $dep_name_er = "الرجاء إدخال إسم الإدارة";
    }elseif(!filter_var(trim($input_name), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $dep_name_er = " الرجاء إدخال إسم الإدارة بشكل صحيح";
    }else{
        $dep_name = $input_name;
    }

     $input_Phone = trim($_POST['phone']);
     if(empty($input_Phone)){
        $dep_phone_er = "الرحاء إدخال  هاتف الإدارة";
     }else{
        $dep_phone = $input_Phone;
     }

     $input_clinic = trim($_POST['clinic']);
     if(empty($input_clinic)){
         $$dep_clic_er = "الرحاء إدخال  رقم العيادة";
     }else{
        $dep_clic = $input_clinic;
     }

     $id = $_POST['id'];

     if(empty($dep_name_er) && empty($dep_phone_er) && empty($dep_clic_er)){
         $Sql_Update   = "UPDATE departments SET Departments_Name  = '$dep_name' , Departments_Phone = $dep_phone , Clinic_Id = $dep_clic WHERE Departments_Id =  $id ";

         $Update_Result = mysqli_query($link,$Sql_Update);

            if($Update_Result){

                  $done = "تم التعديل  بنجاح";

            }else{
                $er = "خطأ في المدخلات الرجاء إدخال المدخلات بشكل صحيح";
                echo "Something's wrong with the query1: " . mysqli_error($link);


            }

        }else {
                echo "Something's wrong with the query: " . mysqli_error($link);
            }

     
        
        // Close connection
        mysqli_close($link);

        }

        if(isset($_POST['Delete'])){

            require_once 'Config.php';
            $sql = "DELETE FROM departments WHERE Departments_Id = ?";
    
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $pam_id);
                
                // Set parameters
                $pam_id = trim($_POST["id"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records deleted successfully. Redirect to landing page
                    header("location: info_management.php");
                    exit();
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($stmt);
        }
    





?>



<!DOCTYPE html>
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
<center>
<form id="userForm" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"> 
                <div class="text-right">
                    <!--Tihs for Msseage After The upadte The Department -->
                    <?php echo  $done ; ?>

                    <!--Tihs for Msseage if  in the query or user input Error  -->
                    <?php echo  $er ; ?>

                    <h5 class="register-input-title">اسم الإدارة</h5>
                    <input type="text" name="dep" class="register-input-area" value="<?php echo $department_Name; ?>" dir="rtl">
                    <span > <?php echo $dep_name_er; ?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title"> هاتف الإدارة</h5>
                    <input type="text"   name="phone" class="register-input-area" value="<?php echo $Departments_Phone; ?>" dir="rtl">
                    <span > <?php echo $dep_phone_er; ?></span>

                </div>


                <div class="text-right">
                    <h5 class="register-input-title">العيادة</h5>
                    <input type="text" name="clinic" class="register-input-area" value="<?php echo $Clinic;  ?>" dir="rtl">
                    <span > <?php echo $dep_clic_er; ?></span>

                    <div class="text-right">
                    <input type="hidden"  name="id" class="register-input-area" value="<?php echo $param_id; ?>" dir="rtl">

                </div>

                </div>
                <div class="text-right">
                <button type="submit" name="Edit" class="button2"> تعديل </button> 
                <button type="submit" name="Delete" class="button2"> حذف </button> 


                </div>
            </form>
    </center>

    </div>
</div>



</body>
</html>