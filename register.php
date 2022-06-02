<?php 

require_once 'Config.php';


// Script For Singup The [Patine]



$Full_name = $Eamil = $Password = $Vpassword = $Mobile = $Address = $DateBirth = $Gender = $Patine_Number = "";
$Full_name_err = $Eamil_err = $Password_err = $Vpassword_err = $Mobile_err = $Address_err = $DateBirt_err = $Gender_err = $Patine_Number_err = "";
$Somthing ="";
$Insert_Done ="";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check the name if it is empty or in the thread any HTML tags!
    $input_Name = $_POST['Name'];
    if(empty($input_Name)){
        $Full_name_err = "الرجاء كتابة الأسم كاملاً";
    }elseif(!filter_var(trim($input_Name), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $Full_name_err = "الرجاء إدخال اسماً صحيحاً ";
    }else{
        $Full_name = $input_Name; 

    }

    // CHECK The Email if it is empty or The Email Is Not Valid.
    $input_Eamil = trim($_POST['Email']);
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
        $Vpassword_err  = "الرجاء إدخال تأكيد كملة المرور";
    }elseif($input_Vpassword !== $Password){
        $Vpassword_err  = "كلمة المرور ليست متطابقة ";
    }else{
        $Vpassword = password_hash($input_Password,PASSWORD_DEFAULT);
      
    }

    // Check The Phone Number It's  a 10 Numbers ?  
    $input_Mobile = trim($_POST['Mobile']);
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
        $input_Address;
        $Address = $input_Address;
      
    }

        // Check The DateBirth It's Not Empty !
    $input_DataBirth = trim($_POST['DateBirth']);
    if(empty($input_DataBirth)){
        $DateBirt_err = "الرجاء إدخال تاريخ الميلاد";
    }else{
        $DateBirth = $input_DataBirth;

    }

    $input_Gender = $_POST['Gender'];
    if(empty($input_Gender)){
        $Gender_err = "الرجاءإختيار النوع";
    }else {
   
    $Gender       = $input_Gender;

}

    $input_Number = trim($_POST['Number']);
    if(empty($input_Number)){
        $Patine_Number_err = "الرجاء إدخال رقم الهوية  ";
    }elseif(strlen($input_Number) < 10 OR strlen($input_Number) > 10){
        $Patine_Number_err = "رقم ليس 10 أرقام !";
    }else {
        $Patine_Number = $input_Number;
    }


    if(empty($Full_name_err && empty($Eamil_err) && empty($Password_err) && empty($Vpassword_err) && empty($DateBirt_err) && empty($Mobile_err) && empty($Address_err)  && empty($Gender_err) && empty($Patine_Number_err))){
  

        $sql = "INSERT INTO patines(Patine_Full_Name,Patine_Email,Patine_Brith_Date,Patine_Mobile,Patine_Address,Gender,Patine_Number) VALUES (?,?,?,?,?,?,?)";
         // prepare Statment
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt,"sssssss",$param_name,$param_Email,$param_DateBirth,$param_Mobile,$parma_Address,$param_Gender,$param_Number);
            $param_name        = $Full_name;
            $param_Email       = $Eamil;
            $param_DateBirth   = $DateBirth;
            $param_Mobile      = $Mobile;
            $parma_Address     = $Address;
            $param_Gender      = $Gender; 
            $param_Number      = $Patine_Number;

            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Insert Into Users Tables And Redirect to landing page
                echo "<script type='text/javascript'>alert('تم تسجيل الحساب بنجاح  ');</script>";
                $SqlUser ="INSERT INTO users(User_Email,User_Password,User_Number,Authorization) VALUES ('$param_Email','$Vpassword',$param_Number,3)";
                mysqli_query($link,$SqlUser);
                header("location: login.php");
                exit();
        }else{
           // echo "<script type='text/javascript'>alert('خطأ في أحد المدخلات، رجاءاً أدخل البيانات بشكلٍ صحيح ');</script>";
            echo "Something's wrong with the query: " . mysqli_error($link);

        }
            // Close statement

    } else {
        echo "Something's wrong with the query: " . mysqli_error($link);
    }
    mysqli_stmt_close($stmt);
}else {

}


// Close connection
mysqli_close($link);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<script src='https://code.jquery.com/jquery-2.1.3.min.js'></script>
<script src='CodingJ.js'></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
           <!--AJAX-->
<style>

.Error{
    color:red;
}
.Insert{
    color:green;
}
</style>

</head>
<body>

<?php 
    include("header.php");
    include("nav.php");
?>

<div id="content-area">
    <div id="content_">
        
        <div class="centre-content">
            <div class="text-right centre">
                <h1 class="register-title">تسجيل حساب جديد</h1>
                <span class="Error"><?php echo $Somthing;?></span> 
                <span class="Insert"><?php echo $Insert_Done;?></span> 

                <p id="message"></p> 
            </div>
            <form id="userForm" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="text-right">
                    <h5 class="register-input-title">الاسم</h5>
                    <input type="text" id="Name" name="Name" class="register-input-area" value="<?php echo $Full_name; ?>">
                    <span class="Error"><?php echo "*".$Full_name_err;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">البريد الكتروني</h5>
                    <input type="email" id="Email" name="Email" class="register-input-area" value="<?php echo $Eamil; ?>">
                    <span class="Error"><?php echo "*".$Eamil_err;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">الكلمة السرية</h5>
                    <input type="password" id="Password" name="Password" class="register-input-area"> 
                    <span class="Error"><?php echo "*".$Password_err;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">تأكيد الكلمة السرية</h5>
                    <input type="password" id="Vpassword" name="Vpassword" class="register-input-area" > 
                    <span class="Error"><?php echo "*".$Vpassword_err;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">رقم الجوال</h5>
                    <input type="text" id="Mobile" name="Mobile" class="register-input-area" value="<?php echo $Mobile;?>"> 
                    <span class="Error"><?php echo "*".$Mobile_err;?></span>
                </div>
                <div class="text-right">
                    <h5 class="register-input-title">العنوان</h5>
                    <input type="text" id="Address" name="Address" class="register-input-area" value="<?php echo $Address;?>">
                    <span class="Error"><?php echo "*".$Address_err;?></span> 
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">تاريخ الميلاد</h5>
                    <input type="date" id="DateBirth" name="DateBirth" class="register-input-area" value="<?php echo $DateBirth;?>"> 
                    <span class="Error"><?php echo "*".$DateBirt_err;?></span> 

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">الجنس</h5>
                    <select  id="Gender" name="Gender" class="register-input-area" value="<?php echo $Gender;?>">
                        <option selected>...اختار</option>
                        <option >ذكر</option>
                        <option >انثى</option>
                    </select>
                    <span class="Error"><?php echo "*".$Gender_err;?></span>
                </div>
                <div class="text-right">
                    <h5 class="register-input-title">رقم الهوية</h5>
                    <input type="text" id="Number" name="Number" class="register-input-area" value="<?php echo $Patine_Number;?>">
                    <span class="Error"><?php echo "*".$Patine_Number_err;?></span>
                </div>

                <div class="text-right" id="form-checkbox">
                    <span> أوفق على شروط</span><a href=""> سياسة الخصوصية والاستخدام</a><input type="checkbox" name="Privacy" ><br>
                </div>

                <div class="text-right">
                    <button id="form-register-button">إنشاء</button>

                </div>
            </form>
        </div>
        
    </div>
</div>
<?php 
    include("footer.php");  
?>
 
</body>
</html>