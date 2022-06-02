<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

require_once 'Config.php';

$S_Name = $P_Ser = $Pic = $Discount ="";
$S_Name_er = $P_Ser_er = $Pic_er = $Discount_er ="";
$done ="";
$er = "";


if($_SERVER["REQUEST_METHOD"] =="POST"){
    $input_name = trim($_POST['S_Name']);
    if(empty($input_name)){
        $S_Name_er = "الرجاء إدخال إسم الخدمة";
    }else{
        $S_Name = $input_name;
    }


    $file_name = $_FILES['pic']['name'];
    $file_size = $_FILES['pic']['size'];
    $file_tmp =  $_FILES['pic']['tmp_name'];
    $file_type = $_FILES['pic']['type'];
    $temp= explode('.',$file_name);
    $file_te = end($temp);
         
    $extensions= array("jpeg","jpg","png");
    
    if(in_array($file_te,$extensions) === false){
        $Pic_er = "مسار الصورة غير مسموح به ، يرجى اختيار ملف JPEG أو PNG أو png.";
    }
    
    if($file_size > 2097152) {
        $Pic_er = "يجب أن يكون حجم الملف 2 ميغا بايت  ";
    }

    if(empty($Pic_er) == true) {
        move_uploaded_file($file_tmp,"images/".$file_name);
        //echo "Success";
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
         $Discount = $input_Dis;
     }

     if(empty($S_Name_er) && empty($P_Ser_er) && empty($Pic_er) && empty($Discount_er)){
         $sql = "INSERT INTO services(Service_Name,Service_Price,Service_Pic,Service_Discount) VALUES (?,?,?,?)";

         if($stmt = mysqli_prepare($link,$sql)){
             
            mysqli_stmt_bind_param($stmt,"siss",$param_Name,$param_Price,$param_file,$param_Dis);
            $param_Name  = $S_Name;
            $param_Price = $P_Ser;
            $param_file  = $file_name;
            $param_Dis   = $Discount;

            if(mysqli_stmt_execute($stmt)){

                  $done = "تم إضافة الخدمة بنجاح";
            }else{
                $er = "خطأ في المدخلات الرجاء إدخال المدخلات بشكل صحيح";
                echo "Something's wrong with the query: " . mysqli_error($link);


            }

        }else {
                echo "Something's wrong with the query: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt);

        }else {
        
        }
        
        
        // Close connection
        mysqli_close($link);
        }






//echo "Something's wrong with the query: " . mysqli_error($link);



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
      <p>إضافة خدمة جديدة</p>

<form id="userForm" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" > 
                <div class="text-right">
                    <!--Tihs for Msseage After The Insert New Sercice -->
                    <?php echo  $done ; ?>

                    <!--Tihs for Msseage if  in the query or user input Error  -->
                    <?php echo  $er ; ?>

                    <h5 class="register-input-title">اسم الخدمة</h5>
                    <input type="text" name="S_Name" class="register-input-area" value="" dir="rtl">
                    <span > <?php echo $S_Name_er; ?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">سعر الخدمة</h5>
                    <input type="text"   name="Price" class="register-input-area" value="" dir="rtl">
                    <span > <?php echo $P_Ser_er; ?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">صورة الخدمة</h5>
                    <input type="file" name="pic" class="register-input-area" value="" dir="rtl">
                    <span > <?php echo $Pic_er; ?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">الخصم</h5>
                    <input type="text" name="Discount" class="register-input-area" value="لايوجد خصم حالياً" dir="rtl">
                    <span > <?php echo $Discount_er; ?></span>

                </div>
                <div class="text-right">
                <button type="submit" name="Save" class="btn"> إضافة </button> 

                </div>
            </form>
     </center>
    </div>
</div>



</body>
</html>