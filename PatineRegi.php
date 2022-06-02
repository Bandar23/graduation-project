<?php

require_once 'Config.php';

// Script For Singup The [Patine]

$Full_name = $Eamil = $Password = $Vpassword = $Mobile = $Address = $DateBirth = $Sex = "";
$Full_name_err = $Eamil_err = $Password_err = $Vpassword_err = $Mobile_err = $Address_err = $DateBirth_err = $Sex_err = "";



if($_SERVER["REQUEST_METHOD"] === "POST"){

    // Check the name if it is empty or in the thread any HTML tags!
    $input_Name = trim($_POST['Name']);
    if(empty($input_Name)){
        $Full_name_err = "الرجاء كتابة الأسم كاملاً";
    }elseif(!filter_var(trim($input_Name), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $Full_name_err = "الرجاء إدخال اسماً صحيحاً ";
    }else{
        $Full_name = $input_Name;
    }

    // CHECK The Email if it is empty or The Email Is Not Valid.
    $input_Eamil = trim($_POST['Eamil']);
    if(empty($input_Eamil)){
        $Eamil_err = "الرجاء إدخال الإيميل ";
    }elseif(!filter_var($input_Eamil,FILTER_VALIDATE_EMAIL)){
        $Eamil_err = "الرجاء كتابة الإيميل بشكل صحيح";
    }else{
        $Eamil = $input_Eamil;
    }
    
    // Check The Password < 8 Or Empty !   
    $input_Password = trim($_POST['Password']);
    if(empty($input_Password)){
        $Password_err = "الرجاء كتابة كلمة المرور";
    }elseif(strlen($input_Password) < 8 ){
        $Password_err = "الرجاء كتابة كلمة المرور من أو أكبر 8 أحرف و كلمات ";
    }else{
        $Password = $input_Password;
    }

    // Check If The Password It's Equle The Same Password 
    $input_Vpassword = trim($_POST['Vpassword']);
    if(empty($input_Vpassword)){
        $Vpassword_err = "الرجاء إدخال تأكيد كملة المرور";
    }elseif($input_Vpassword !== $Password){
        $Vpassword_err = "كلمة المرور ليست متطابقة ";
    }else{
        $Vpassword = $input_Password
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
    $input_Address = trim($_POST['Address']);
    if(empty($input_Address)){
        $Address_err = "الرجاء إدخال العنوان ";
    }else{
        $FILTER_VAR = filter_var($input_Address,FILTER_SANITIZE_STRING,FILTER_LAG_STRIP_HIGH);
        $Address = $FILTER_VAR;
    }

        // Check The DateBirth It's Not Empty !
    $input_DataBirth = trim($_POST['dateBirth']);
    if(empty($input_DataBirth)){
        $DateBirth_err = "الرجاء إدخال تاريخ الميلاد";
    }else{
        $DateBirth = $input_DataBirth;
    }

    $input_Sex = $_POST['Sex'];
    $Sex       = $input_Sex;

    if(!empty($Full_name_err) && !empty($Eamil_err) && !empty($Password_err) && !empty($Vpassword_err) && !empty($Mobile_err) && !empty($Address_err) && !empty($DateBirth_err) && !empty($Sex_err)){
        $sql = "INSERT INTO patines(Patine_Id,Patine_Full_Name,Patine_Email,Patine_Birth_Date,Patine_Mobile,Patine_Address,Patine_Img) VALUES 
               (?,?,?,?,?,?,?)";
         // prepare Statment
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"sssisss",$param_name,$param_Email,$param_Vpassword,$param_Mobile,$parma_Address,$param_DateBirth,$param_Sex);
            $param_name      = $Full_name;
            $param_Email     = $Eamil;
            $param_Vpassword = $Vpassword;
            $param_Mobile    = $Mobile;
            $parma_Address   = $Address;
            $param_DateBirth = $DateBirth;
            $param_Sex       = $Sex; 

            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Insert Into Users Tables And Redirect to landing page
                $SqlUser = "INSERT INTO Users(User_Email,User_Password,Authorization) VALUES ($param_Email,$param_Email,'Patine')";
                mysqli_query($link,$SqlUser);
                header("location: index.php");
                exit();
        } else{
            echo "Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($link);
}


?>