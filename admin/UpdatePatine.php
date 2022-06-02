<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

 $P_Name = $P_email = $P_Date = $P_Mobile = $P_Address = $P_Number = $p_number = $param_id ="";
if(isset($_GET["edit"]) && !empty(trim($_GET["edit"]))){

    
    require_once 'Config.php';

    $Department_Data ="SELECT * FROM patines WHERE Patine_Id = ? ";

    if($stmt = mysqli_prepare($link,$Department_Data)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["edit"]);
    

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
             $P_Name          =  $row['Patine_Full_Name'];
             $P_email         =  $row['Patine_Email'];
             $P_Date   =  $row['Patine_Brith_Date']; 
             $P_Mobile        =  $row['Patine_Mobile'];
             $P_Address       =  $row['Patine_Address'];
             $p_number        =  $row['Patine_Number'];

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

$name = $Eamil = $Mobile = $Address = $DateBirth = $Patine_Number =  $done = $er = "";
$name_err = $Eamil_err = $Mobile_err = $Address_err = $DateBirth_err = $Patine_Number_err =  "";

if(isset($_POST['Edit'])){

    require_once 'Config.php';

$input_Name = trim($_POST['name']);
if(empty($input_Name)){
  $name_err = "الرجاء كتابة الأسم ";
}else {
    $name = $input_Name;
}

$input_Eamil = trim($_POST['email']);
if(empty($input_Eamil)){
    $Eamil_err = "الرجاء إدخال الإيميل ";
}elseif(!filter_var($input_Eamil,FILTER_VALIDATE_EMAIL)){
    $Eamil_err = "الرجاء كتابة الإيميل بشكل صحيح";
}else{
    $Eamil = $input_Eamil;
}

// Check The Phone Number It's  a 10 Numbers ?  
$input_Mobile = trim($_POST['mobile']);
if(empty($input_Mobile)){
    $Mobile_err = "الرجاء إدخال رقم الجوال ";
}elseif(strlen($input_Mobile) < 10 OR strlen($input_Mobile) > 10){
    $Mobile_err = "رقم ليس 10 أرقام !";
}else {
    $Mobile = $input_Mobile;
}

// Check The Address It's Not Empty !
$input_Address = trim($_POST['addrees']);
if(empty($input_Address)){
    $Address_err = "الرجاء إدخال العنوان ";
}else{
    $Address = $input_Address;
}

    // Check The DateBirth It's Not Empty !
$input_DataBirth = trim($_POST['date']);
if(empty($input_DataBirth)){
    $DateBirth_err = "الرجاء إدخال تاريخ الميلاد";
}else{
    $DateBirth = $input_DataBirth;
}

$id = $_POST['id'];
$p_number = $_POST['p_number'];



if(empty($name_err) && empty($Eamil_err) && empty($Mobile_err) && empty($Address_err) && empty($DateBirth_err)){
    $Patine_Update = "UPDATE patines SET Patine_Full_Name ='$name', Patine_Email ='$Eamil', Patine_Brith_Date ='$DateBirth', Patine_Mobile = $Mobile, Patine_Address = '$Address'
     WHERE Patine_Id = $id ";
     $Result_Update = mysqli_query($link,$Patine_Update);

         if($Result_Update){
             $User_Update = "UPDATE users SET User_Email = '$Eamil' WHERE User_Number = $p_number ";
             mysqli_query($link,$User_Update);
             $done = "تم التعديل  بنجاح";
             header("location: info_management.php");

         }else {
            $er = "خطأ في المدخلات الرجاء إدخال المدخلات بشكل صحيح";

             echo "SomeThing Wrong. Try Later ! ". mysqli_error($link);;
         }
    }else {
        echo "Something's wrong with the query: " . mysqli_error($link);
    }
   
mysqli_close($link);

}


if(isset($_POST['Delete'])){

    require_once 'Config.php';
    $sql = "DELETE FROM patines WHERE Patine_Id = ?";

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

                    <h5 class="register-input-title">اسم </h5>
                    <input type="text" name="name" class="register-input-area" value="<?php echo $P_Name; ?>" dir="rtl">
                    <span > <?php echo $name_err; ?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">  الايميل</h5>
                    <input type="text"   name="email" class="register-input-area" value="<?php echo $P_email; ?>" dir="rtl">
                    <span > <?php echo $Eamil_err; ?></span>

                </div>


                <div class="text-right">
                    <h5 class="register-input-title">تاريخ الولادة</h5>
                    <input type="date" name="date" class="register-input-area" value="<?php echo $P_Date;  ?>" dir="rtl">
                    <span > <?php echo $DateBirth_err; ?></span>

                    <div class="text-right">
                    <h5 class="register-input-title">الهاتف</h5>
                    <input type="text"  name="mobile" class="register-input-area" value="<?php echo $P_Mobile; ?>" dir="rtl">
                    <span > <?php echo $Mobile_err; ?></span>

                </div>
                <div class="text-right">
                <h5 class="register-input-title">العنوان</h5>
                    <input type="text"  name="addrees" class="register-input-area" value="<?php echo $P_Address; ?>" dir="rtl">
                    <span > <?php echo $DateBirth_err; ?></span>


                </div> <div class="text-right"> 
                    <input type="hidden"  name="id" class="register-input-area" value="<?php echo $param_id; ?>" dir="rtl">

                </div>
                </div> <div class="text-right"> 
                    <input type="hidden"  name="p_number" class="register-input-area" value="<?php echo $p_number; ?>" dir="rtl">

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