<?php

session_start();

require_once 'Config.php';

$Patine_Id = $_SESSION["Patine_Id"];

$Profile_Data = "SELECT * FROM patines WHERE  Patine_Id = $Patine_Id ";
$Result_Data = mysqli_query($link,$Profile_Data);
$Patine_Row = mysqli_fetch_array($Result_Data);

$Patine_Name  = $Patine_Row['Patine_Full_Name'];
$Patine_Email  = $Patine_Row['Patine_Email'];
$Patine_Dob  = $Patine_Row['Patine_Brith_Date'];
$Patine_Mobile  = $Patine_Row['Patine_Mobile'];
$Patine_Addrees  = $Patine_Row['Patine_Address'];
$P_Number   = $Patine_Row['Patine_Number'];

$name = $Eamil = $Mobile = $Address = $DateBirth = $Patine_Number ="";
$name_err = $Eamil_err = $Mobile_err = $Address_err = $DateBirth_err = $Patine_Number_err =  "";

if(isset($_POST['submit']) && !empty($_POST['submit'])){

    $input_Name = trim($_POST['P_Name']);
    if(empty($input_Name)){
      $name_err = "الرجاء كتابة الأسم ";
    }else {
        $name = $input_Name;
    }

    $input_Eamil = trim($_POST['P_Email']);
    if(empty($input_Eamil)){
        $Eamil_err = "الرجاء إدخال الإيميل ";
    }elseif(!filter_var($input_Eamil,FILTER_VALIDATE_EMAIL)){
        $Eamil_err = "الرجاء كتابة الإيميل بشكل صحيح";
    }else{
        $Eamil = $input_Eamil;
    }

    // Check The Phone Number It's  a 10 Numbers ?  
    $input_Mobile = trim($_POST['P_Mobile']);
    if(empty($input_Mobile)){
        $Mobile_err = "الرجاء إدخال رقم الجوال ";
    }elseif(strlen($input_Mobile) < 10 OR strlen($input_Mobile) > 10){
        $Mobile_err = "رقم ليس 10 أرقام !";
    }else {
        $Mobile = $input_Mobile;
    }

    // Check The Address It's Not Empty !
    $input_Address = trim($_POST['P_Addrees']);
    if(empty($input_Address)){
        $Address_err = "الرجاء إدخال العنوان ";
    }else{
        $Address = $input_Address;
    }

        // Check The DateBirth It's Not Empty !
    $input_DataBirth = trim($_POST['DateBirth']);
    if(empty($input_DataBirth)){
        $DateBirth_err = "الرجاء إدخال تاريخ الميلاد";
    }else{
        $DateBirth = $input_DataBirth;
    }

   

    if(empty($name_err) && empty($Eamil_err) && empty($Mobile_err) && empty($Address_err) && empty($DateBirth_err)){
        $Patine_Update = "UPDATE patines SET Patine_Full_Name ='$name', Patine_Email ='$Eamil', Patine_Brith_Date ='$DateBirth', Patine_Mobile = $Mobile, Patine_Address = '$Address'
         WHERE Patine_Id = $Patine_Id ";
         $Result_Update = mysqli_query($link,$Patine_Update);

             if($Result_Update){
                 $User_Update = "UPDATE users SET User_Email = '$Eamil' WHERE User_Number = $P_Number ";
                 mysqli_query($link,$User_Update);
                 header("location: profile.php");

             }else {
                 echo "SomeThing Wrong. Try Later ! ". mysqli_error($link);;
             }
        }else {
            echo "Something's wrong with the query: " . mysqli_error($link);
        }
       
    mysqli_close($link);

}





if(isset($_SESSION["Full_Name"])){ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

<?php 
    include("./header.php");
    include("./logedin_nav.php");
?>

<div id="content-area">
    <div id="content_">
    
        <div id="contenr-p">
            <div id="profile-menu">
                <div id="p-img-name">
                    <img id="profile-img" src="./user_icon.png">
                    <p id="user-name"><?php echo $_SESSION["Full_Name"];?></p>

                </div>
                <a href="profile.php" class="p-menu">الملف الشخصي</a>
                <a href="User_Appointment.php" class="p-menu">المواعيد</a>
                <a href="UserBills.php" class="p-menu">الفواتير</a>
                <a href="User_Reports.php" class="p-menu">التقارير الطبيية</a>
                <a href="CS.php" class="p-menu">تقديم شكاوي و اقترحات</a>
            </div>

            <div id="profile-content">
      
                <h1 class="register-title">تعديل البيانات الشخصية </h1>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="text-right">
                    <h5 class="register-input-title">الاسم</h5>
                    <input type="text" name="P_Name" value ="<?php echo $Patine_Name; ?>" class="register-input-area">
                    <span class="Error"><?php echo $name_err; ?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">البريد الكتروني</h5>
                    <input type="text" name="P_Email" value ="<?php echo $Patine_Email ?>" class="register-input-area">
                    <span class="Error"><?php echo $Eamil_err; ?></span>

                </div>


                <div class="text-right">
                    <h5 class="register-input-title">رقم الجوال</h5>
                    <input type="text" name="P_Mobile" value ="<?php echo $Patine_Mobile; ?>" class="register-input-area">
                    <span class="Error"><?php echo $Mobile_err; ?></span>
                </div>
                <div class="text-right">
                    <h5 class="register-input-title">العنوان</h5>
                    <input type="text" name="P_Addrees" value ="<?php echo $Patine_Addrees; ?>" class="register-input-area">
                    <span class="Error"><?php echo $Address_err; ?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">تاريخ الميلاد</h5>
                    <input type="date" name="DateBirth" value ="<?php echo $Patine_Dob; ?>" class="register-input-area">
                    <span class="Error"><?php echo $DateBirth_err; ?></span>
                </div>
               

                <div class="text-right">
                <input type="submit"  name="submit" value="تعديل" id="form-register-button" ><br>
                </div>
            </form>
      
            </div>
        </div>
        </div>
    </div>
</div>
<?php 
    include("./footer.php");  
?>
    
</body>
</html>

<?php } else {
      header("location:login.php");
      exit;
}
