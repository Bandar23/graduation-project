<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

$Service_id = $Service_Name = $Service_Price = $Discount = $Service_id = $id = $param_id= "";
if(isset($_GET["crud"]) && !empty(trim($_GET["crud"]))){

    
    require_once 'Config.php';

    $service_Data ="SELECT Service_Id,Service_Name,Service_Price,Service_Discount FROM services WHERE Service_id = ? ";

    if($stmt = mysqli_prepare($link,$service_Data)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["crud"]);


        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $Service_Name  = $row['Service_Name'];
            $Service_Price = $row['Service_Price'];
            $Discount      = $row['Service_Discount'];

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


$S_Name = $P_Ser = $Pic = $Discount_i ="";
$S_Name_er = $P_Ser_er = $Pic_er = $Discount_er ="";
$done ="";
$er = "";


if(isset($_POST['Edit'])){
    require_once 'Config.php';


    $input_name = trim($_POST['S_Name']);
    if(empty($input_name)){
        $S_Name_er = "الرجاء إدخال إسم الخدمة";
    }else{
        $S_Name = $input_name;
    }

     $input_Price = trim($_POST['Price']);
     if(empty($input_Price)){
         $P_Ser_er = "الرحاء إدخال سعر الخدمة";
     }else{
         $P_Ser = $input_Price;
     }

     $input_Dis = trim($_POST['Discount']);
     if(empty($input_Price)){
         $Discount_er = "الرحاء إدخال سعر الخصم";
     }else{
        $Discount_i = $input_Dis;
     }

     $id = $_POST['id'];

     if(empty($S_Name_er) && empty($P_Ser_er) && empty($Discount_er)){
         $Sql_Update   = "UPDATE services SET Service_Name  = '$S_Name' , Service_Price = $P_Ser , Service_Discount = '$Discount_i' WHERE Service_Id =  $id ";

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
            $sql = "DELETE FROM services WHERE Service_Id = ?";
    
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $pam_id);
                
                // Set parameters
                $pam_id = trim($_POST["id"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    // Records deleted successfully. Redirect to landing page
                    header("location: Service_New.php");
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
    <title>services</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    </style>
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
                    <!--Tihs for Msseage After The Insert New Sercice -->
                    <?php echo  $done ; ?>

                    <!--Tihs for Msseage if  in the query or user input Error  -->
                    <?php echo  $er ; ?>

                    <h5 class="register-input-title">اسم الخدمة</h5>
                    <input type="text" name="S_Name" class="register-input-area" value="<?php echo $Service_Name; ?>" dir="rtl">
                    <span > <?php echo $S_Name_er; ?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">سعر الخدمة</h5>
                    <input type="text"   name="Price" class="register-input-area" value="<?php echo $Service_Price; ?>" dir="rtl">
                    <span > <?php echo $P_Ser_er; ?></span>

                </div>


                <div class="text-right">
                    <h5 class="register-input-title">الخصم</h5>
                    <input type="text" name="Discount" class="register-input-area" value="<?php echo $Discount;  ?>" dir="rtl">
                    <span > <?php echo $Discount_er; ?></span>

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