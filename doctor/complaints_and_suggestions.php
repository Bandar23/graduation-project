<?php 

session_start(); 

if(!isset($_SESSION["Emp_Name"])){
  header("location: login.php");
  exit;
}

$Cs_Subject = $Cs_Content = $Cs_State = $Cs_Sender = $Cs_To = $CS_service="";

$Subject_er = $Content_er = $Service_er = $err ="";

$Docrot_Name = $_SESSION["Emp_Name"];


if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $input_service = trim($_POST['service']);
    if(empty($input_service)){
        $Service_er = "الرجاء إدخال الخدمة * ";
    }else {
        $Cs_service = $input_service;
    }

    $input_Subject = trim($_POST['subject']);
    if(empty($input_Subject)) {
        $Subject_er = "الرجاء إدخال العنوان * ";
    }else{
        $Cs_Subject = $input_Subject;
    }
    
    
    $input_content = trim($_POST['content']);
    if(empty($input_content)){
        $Content_er = "الرجاء إدخال الرسالة * ";
    }else {
        $Cs_Content = $input_content;
    }
    
       
      
    if(empty($service_er) && empty($Subject_er) && empty($content_er)){
        $insert_cs = "INSERT INTO complaints_suggestion (Cs_Subject,Cs_Content,CS_service,Cs_State,Cs_Sender,Cs_To,CS_Date) 
    values ('$Cs_Subject','$Cs_Content','$Cs_service','New','$Docrot_Name','Manager',NOW())";
    
        $result_insert=mysqli_query($link,$insert_cs);
        echo "<script type='text/javascript'>alert('تم إرسال الإرسال');</script>";
    
    }else{
       $err =  "  يبدو ان احد المدخلات فارغة  الرجاء تعبئة جميع الحقول * ";
        //echo "Something's wrong with the query: " . mysqli_error($link);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.ckeditor.com/ckeditor5/11.0.1/classic/ckeditor.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> الشكاوي و الإقتراحات </title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="body2">

<?php 
    include("doc_nav.php");
?>

<div id="content-area2">
    <div id="content_2">


    <div class="centre-content">
           <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <div class="text-right">
                <h4 class="Error"><?php echo $err;?></h4>
                    <h6 class="register-input-title">نوع الخدمة </h6>
                    <select  name="service" class="register-input-area" >
                        <option selected>...اختار</option>
                        <option value="شكوى" >شكوى</option>
                        <option value="اقتراح">اقتراح</option>
                        <span class="Error"><?php echo $Service_er;?></span>
                    </select>

                    <div class="text-right">
                    <h5 class="register-input-title">الموضوع</h5>
                    <input type="text" name="subject" class="register-input-area">
                        <span class="Error"><?php echo $Subject_er;?></span>
                </div>

                <br>

             <h5 class="text-right" >وصف المشكلة او الاقتراح</h5>
            <textarea  name="content" value="الرجاء ادخال الرساله هنا" id="editor" >
                </textarea>
                 <span class="Error"><?php echo $Content_er;?></span><br/>

                    <div class="text-right">
                        <button id="form-register-button" >إرسال </button>
                    </div>
            </div>
            </form>
        </div>

    </div>
       

    </div>
</div>

<script>
                ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
            </script>
</body>
</html>