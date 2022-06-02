<?php

session_start();

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

if(empty($content_er) && empty($Subject_er) && empty($service_er)){
    $insert_cs = "INSERT INTO complaints_suggestion (Cs_Subject,Cs_Content,CS_service,Cs_State,Cs_Sender,Cs_To) 
values ('$Cs_Subject','$Cs_Content','$Cs_service','New','$Patine_Name','Manager')";

    $result_insert=mysqli_query($link,$insert_cs);
    //echo "Something's wrong with the query1: " . mysqli_error($link);

}else{
    echo "يبدو ان احد المدخلات فارغة";
    //echo "Something's wrong with the query: " . mysqli_error($link);
}
}

// Close connection
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اقتراح او شكوى</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>

</head>
<body>

<?php
include("header.php");
include("nav.php");
include("ads.php");
?>
<div id="content-area">
    <div id="content_">
        
        <div class="centre-content">
            <div class="text-right centre">
                <h1 class="register-title">تقديم شكوى او اقتراح</h1>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <div class="text-right">
                    <h5 class="register-input-title">نوع الخدمة </h5>
                    <select  name="service" class="register-input-area" >
                        <option selected>...اختار</option>
                        <option value="شكوى" >شكوى</option>
                        <option value="اقتراح">اقتراح</option>
                        <span><?php echo $service_er;?></span>
                    </select>

                    <div class="text-right">
                    <h5 class="register-input-title">الموضوع</h5>
                    <input type="text" name="subject" class="register-input-area">
                        <span><?php echo $Subject_er;?></span>
                </div>

                <br>

             <h1 class="text-right" >وصف المشكلة او الاقتراح</h1>
            <textarea  name="content" value="الرجاء ادخال الرساله هنا" id="editor" >
                </textarea>
                    <span><?php echo $content_er;?></span>
                    <script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
                    <div class="text-right">
                        <button id="form-register-button" >أنشاء</button>
                    </div>
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