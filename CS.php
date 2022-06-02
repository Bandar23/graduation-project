<?php 

session_start();

require_once 'Config.php';

if(isset($_SESSION["Full_Name"])){

    require_once 'Config.php';




    $Patine_Id = $_SESSION["Patine_Id"];
    
    
    $Cs_Subject="";
    $Cs_Content="";
    $Cs_State="";
    $Cs_Sender="";
    $Cs_To="";
    $CS_service="";
    
    $Subject_er="";
    $content_er="";
    $service_er="";

    $err ="";
    
    
    $Profile_Data = "SELECT * FROM patines WHERE  Patine_Id = $Patine_Id ";
    $Result_Data = mysqli_query($link,$Profile_Data);
    $Patine_Row = mysqli_fetch_array($Result_Data);
    
    $Patine_Name  = $Patine_Row['Patine_Full_Name'];
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_Subject = trim($_POST['subject']);
    if(empty($input_Subject)) {
        $Subject_er = "الرجاء إدخال العنوان ";
    }else{
        $Cs_Subject = $input_Subject;
    }
    
    
    $input_content = trim($_POST['content']);
    if(empty($input_content)){
        $content_er = "الرجاء إدخال الرسالة ";
    }else {
        $Cs_Content = $input_content;
    }
    
        $input_service = trim($_POST['service']);
        if(empty($input_service)){
            $service_er = "الرجاء إدخال الخدمة ";
        }else {
            $Cs_service = $input_service;
        }
    
    if(empty($Subject_er) && empty($content_er) && empty($service_er)){
        $insert_cs = "INSERT INTO complaints_suggestion (Cs_Subject,Cs_Content,CS_service,Cs_State,Cs_Sender,Cs_To,CS_DATE) 
    values ('$Cs_Subject','$Cs_Content','$Cs_service','New','$Patine_Name','Manager',NOW())";
    
        $result_insert = mysqli_query($link,$insert_cs);
        if($result_insert){
        echo "<script type='text/javascript'>alert('تم الإرسال');</script>";
        }else{
            $err ="لم يتم الإرسال";
        }
    }else{
       $err =  "    الرجاء تعبئة جميع الحقول * ";
        //echo "Something's wrong with the query: " . mysqli_error($link);
    }
}
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>لوحة التحكم</title>
<link rel="stylesheet" href="./style.css">
<style>

.error{
    color:red;
}
</style>
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
            <a href="complaint_suggestion.php" class="p-menu">تقديم شكاوي و اقترحات</a>
        </div>

        <div id="profile-content">

        <div class="centre-content">
           <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <div class="text-right">
                <h4 class="error"><?php echo $err;?></h4>
                    <h6 class="register-input-title">نوع الخدمة </h6>
                    <select  name="service" class="register-input-area" >
                        <option selected>...اختار</option>
                        <option value="شكوى" >شكوى</option>
                        <option value="اقتراح">اقتراح</option>
                        <span class="error"><?php echo $service_er;?></span>
                    </select>

                    <div class="text-right">
                    <h5 class="register-input-title">الموضوع</h5>
                    <input type="text" name="subject" class="register-input-area">
                        <span class="error"><?php echo $Subject_er;?></span>
                </div>

                <br>

             <h5 class="text-right" >وصف المشكلة او الاقتراح</h5>
            <textarea  name="content" value="الرجاء ادخال الرساله هنا" id="editor" >
                </textarea>
                    <script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
                                <span class="error"><?php echo $content_er;?></span>
                    <div class="text-right">
                        <button id="form-register-button" >إرسال </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
     

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
