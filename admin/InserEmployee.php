<?php 


  
require_once 'Config.php';

   // Query To Show Departments Table
   $Departments_Table = "SELECT * FROM departments";
   $Departments_Result = mysqli_query($link,$Departments_Table);

// Insert Data Into Employees Table 

$Full_name = $Email = $Password = $Address = $BirthDate = $Mobile = $Gender = $Specialty = $JobTitle = $Department_Id = $Employee_Number = "";
$Full_name_er = $Email_er = $Password_er = $Address_er = $BirthDate_er = $Mobile_er = $Gender_er = $Specialty_er = $JobTitle_er = $Department_Id_er = $Employee_Number_err = "";

 if(isset($_POST['submit'])){

    $input_Name_E = trim($_POST['FullName']);
     if(empty($input_Name_E)){
         $Full_name_er = "الرجاء إدخال الأسم ";
     } elseif(!filter_var(trim($input_Name_E),FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
         $Full_name_er = "الرجاء إدخال الأسم بشكل صحيح";
     }else {
         $Full_name = $input_Name_E;
     }

     $input_Email_E = trim($_POST['Email']);
     if(empty($input_Email_E)){
         $Email = "الرجاء إدخال الإيميل ";
     } elseif(!filter_var($input_Email_E,FILTER_VALIDATE_EMAIL)){
         $Email_er = "الرجاء إدخال الإيميل بشكل صحيح";
     }else {
        $Email = $input_Email_E;
     }

     $input_Password = trim($_POST['Password']);
     if(empty($input_Password)){
         $Password_er = "الرجاء كتابة كلمة المرور";
     }elseif(strlen($input_Password) < 8 ){
         $Password_er = "الرجاء كتابة كلمة المرور من أو أكبر 8 أحرف و كلمات ";
     }else{
         $Password = password_hash($input_Password,PASSWORD_DEFAULT);
     }
     $input_Address_E = trim($_POST['Address']);
     if(empty($input_Address_E)){
         $Address_er = "الرجاء إدخال العنوان ";
     } else {
         $Address = $input_Address_E;
     }

     $input_BirthDate_E = trim($_POST['DateBirth']);
     if(empty($input_BirthDate_E)){
         $BirthDate_er = "الرجاء إدخال تاريخ الميلاد ";
     }else{
        $BirthDate = $input_BirthDate_E;
     }
    

     $input_Mobile_E = trim($_POST['Mobile']);
     if(empty($input_Mobile_E)){
         $Mobile_er = "الرجاء إدخال رقم الجوال";
     } elseif(strlen($input_Mobile_E) > 10 Or strlen($input_Mobile_E) < 10){
         $Mobile_er = "رقم جوال ليس مكون من 10 أرقام "; 
     }else {
         $Mobile = $input_Mobile_E;
     }

     $input_Gender_E = $_POST['Gender'];
     if(empty($input_Gender_E)){
        $Gender_er = "الرجاء تحديد الجنس";
     }else {
         $Gender = $input_Gender_E;
     }

     $input_Specialty_E  = trim($_POST['Specialty']);
     if(empty($input_Specialty_E)){
         $Specialty_er = "الرجاء إدخال التخصص العلمي ";
     }else {
         $Specialty = $input_Specialty_E;
     }

     $input_JobTitle_E = trim($_POST['JobTitle']);
     if(empty($input_JobTitle_E)){
         $JobTitle_er = "الرجاء إدخال المسمى الوظيفي ";
     }else {
         $JobTitle = $input_JobTitle_E;
     }

     $input_Department_E = trim($_POST['Department_Id']);
     if(empty($input_Department_E)){
         $Department_Id_er = "الرجاء إدخال رقم القسم ";
     }else {
         $Department_Id = $input_Department_E;
     }

     $input_Number = trim($_POST['E-Number']);
    if(empty($input_Number)){
        $Employee_Number_err = "الرجاء إدخال رقم الهوية  ";
    }elseif(strlen($input_Number) < 10 OR strlen($input_Number) > 10){
        $Employee_Number_err = "رقم ليس 10 أرقام !";
    }else {
        $Employee_Number = $input_Number;
    }

     


     if(empty($Full_name_er) && empty($Email_er) && empty($Password_er) && empty($Address_er) && empty($BirthDate_er) && empty($Mobile_er) && empty($Gender_er) && empty($Specialty_er) && empty($JobTitle_er) && empty($Department_Id_er) && empty($Employee_Number_err)){
         $sql = "INSERT INTO employees(Employee_Full_Name, Employee_Email,Employee_Address,Employee_Birth_Date,Employee_Mobile,Employee_Gender,Employee_Specialty,Employee_Job_Title,department_Id,Employee_Number)
         VALUES (?,?,?,?,?,?,?,?,?,?)";

         if($stmt = mysqli_prepare($link,$sql)){
             mysqli_stmt_bind_param($stmt,"ssssisssii",$param_Full_Name,$Param_Email,$Param_Address,$Param_BirthDate,
             $Param_Mobile,$Param_Gender,$Param_Specialty,$Param_Job_Title,$Param_Department_Id,$Param_Employee_N);

             $param_Full_Name     = $Full_name;
             $Param_Email        = $Email;
             $Param_Address       = $Address;
             $Param_BirthDate     = $BirthDate;
             $Param_Mobile        = $Mobile;
             $Param_Gender        = $Gender;
             $Param_Specialty     = $Specialty;
             $Param_Job_Title     = $JobTitle;
             $Param_Department_Id = $Department_Id;
             $Param_Employee_N     =  $Employee_Number;

             if(mysqli_stmt_execute($stmt)){
                $inserIn_Users = "INSERT INTO users(User_Email,User_Password,User_Number,Authorization) VALUES ('$Param_Email','$Password',$Param_Employee_N,2)";
                mysqli_query($link,$inserIn_Users);
                header('location: InserEmployee.php'); 
                exit();
             }else{
                 echo "SomeThing Went Wrong. Please try again later.";
                 echo "Something's wrong with the query1: " . mysqli_error($link);
                
             }

            }else {
                echo "Something's wrong with the query2: " . mysqli_error($link);
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($link);

       
   }

   // Update 



?>

<html>
    <head>
</head>
<body>
    <center>
<div class="text-right centre">
                <h1 class="register-title">  إضافة أو تعديل بيانات موظف </h1>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="text-right">
                    <h5 class="register-input-title">الاسم</h5>
                    <input type="text" name="FullName" class="register-input-area" >
                    <span class="Error"><?php echo "*".$Full_name_er;?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">البريد الكتروني</h5>
                    <input type="email" name="Email" class="register-input-area" >
                    <span class="Error"><?php echo "*".$Email_er;?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">الكلمة السرية</h5>
                    <input type="password" name="Password" class="register-input-area" >
                    <span class="Error"><?php echo "*".$Password_er;?></span>
 
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">العنوان</h5>
                    <input type="text" name="Address" class="register-input-area" >
                    <span class="Error"><?php echo "*".$Address_er;?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">تاريخ الميلاد</h5>
                    <input type="date" name="DateBirth" class="register-input-area" > 
                    <span class="Error"><?php echo "*".$BirthDate_er;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">رقم الجوال</h5>
                    <input type="text" name="Mobile" class="register-input-area" > 
                    <span class="Error"><?php echo "*".$Mobile_er;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">الجنس</h5>
                    <select  name="Gender" class="register-input-area" >
                        <option selected>...اختار</option>
                        <option >ذكر</option>
                        <option >انثى</option>
                    </select>
                    <span class="Error"><?php echo "*".$Gender_er;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title"> التخصص</h5>
                    <input type="text" name="Specialty" class="register-input-area" > 
                    <span class="Error"><?php echo "*".$Specialty_er;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">المسمى الوظيفي </h5>
                    <input type="text" name="JobTitle" class="register-input-area" > 
                </div>
                <div class="text-right">
                    <h5 class="register-input-title">الإدارة</h5>
                    <select  name="Department_Id" class="register-input-area" >
                        <option selected>...اختار</option>
                        <?php while($rows = mysqli_fetch_array($Departments_Result)){ ?>
                        <option value="<?php echo $rows['Departments_Id'];?>"><?php echo $rows['Departments_Name'];?></option>
                        <?php } ?>
                    </select>
                    <span class="Error"><?php echo "*".$Department_Id_er;?></span>
                </div>
                <div class="text-right">
                    <h5 class="register-input-title">رقم الهوية</h5>
                    <input type="text" name="E-Number" class="register-input-area" > 
                    <span class="Error"><?php echo "*".$Employee_Number_err;?></span>
                </div>

                <div class="text-right">
                    <input type="submit"  name="submit" value="إضافة" id="form-register-button" >
                </div>
            </form>
        </div>
</center>

</body>
</html>