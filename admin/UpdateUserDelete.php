<?php 

require_once 'Config.php';

// Query To Show Departments Table
$Departments_Table = "SELECT * FROM departments";
$Departments_Result = mysqli_query($link,$Departments_Table);

$name = $Email =  $Address = $BirthDate = $Mobile = $Gender = $Specialty = $JobTitle = $Department_Id = $Employee_Number = "";
$Full_name_er = $Email_er = $Address_er = $BirthDate_er = $Mobile_er = $Gender_er = $Specialty_er = $JobTitle_er = $Department_Id_er = $Employee_Number_err = "";

if(isset($_POST['submit']) && !empty($_POST['submit'])){
        
    $id = $_GET['edit'];


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

  $input_Number = trim($_POST['Number']);
    if(empty($input_Number)){
        $Employee_Number_err = "الرجاء إدخال رقم الهوية  ";
    }elseif(strlen($input_Number) < 10 OR strlen($input_Number) > 10){
        $Patine_Number_err = "رقم ليس 10 أرقام !";
    }else {
        $Patine_Number = $input_Number;
    }
  
  if(empty($Full_name_er) && empty($Email_er) && empty($Address_er) && empty($BirthDate_er) && empty($Mobile_er) && empty($Gender_er) && empty($Specialty_er) && empty($JobTitle_er) && empty($Department_Id_er)){
     $sqlUpadte = "UPDATE employees SET Employee_Full_Name = ?, Employee_Email = ?, Employee_Address = ?, Employee_Birth_Date = ?, Employee_Mobile = ?, Employee_Specialty =  ?,
     Employee_Job_Title = ?, department_Id =?  WHERE Employee_Id = ?";

     if($stmt = mysqli_prepare($link,$sqlUpadte)){
         mysqli_stmt_bind_param($stmt,"sssssssss",$param_Full_Name,$Param_Email,$Param_Address,$Param_BirthDate,
         $Param_Mobile,$Param_Specialty,$Param_Job_Title,$Param_Department_Id,$param_id);

          $param_Full_Name     = $Full_name;
          $Param_Email         = $Email;
          $Param_Address       = $Address;
          $Param_BirthDate     = $BirthDate;
          $Param_Mobile        = $Mobile;
          $Param_Specialty     = $Specialty;
          $Param_Job_Title     = $JobTitle;
          $Param_Department_Id = $Department_Id;
          $param_id            = $id;

          if(mysqli_stmt_execute($stmt)){
             header('location: InserEmployee.php');
             echo "Something's wrong with the query1: " . mysqli_error($link);
 
             exit();
          }else{
             echo "Something went wrong. Please try again later.";
             echo "Something's wrong with the query2: " . mysqli_error($link);

         }
     }
      
     // Close statement
     mysqli_stmt_close($stmt);
     echo "Something's wrong with the query3: " . mysqli_error($link);

 }
 
 // Close connection
 mysqli_close($link);
     } else{
        // Check existence of id parameter before processing further
        if(isset($_GET["edit"]) && !empty(trim($_GET["edit"]))){
            // Get URL parameter
            $id =  trim($_GET["edit"]);
            
            // Prepare a select statement
            $sq = "SELECT * FROM employees WHERE Employee_Id = ?";
            if($stmt = mysqli_prepare($link, $sq)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                // Set parameters
                $param_id = $id;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
        
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set
                        contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        // Retrieve individual field value
                        $name = $row["Employee_Full_Name"];
                        $Email = $row["Employee_Email"];
                        $Address = $row["Employee_Address"];
                        $BirthDate = $row["Employee_Birth_Date"];
                        $Mobile = $row["Employee_Mobile"];
                        $Specialty = $row["Employee_Specialty"];
                        $JobTitle = $row["Employee_Job_Title"];
                        $Department_Id = $row["department_Id"];
                    } else{
                        // URL doesn't contain valid id. Redirect to error page
                        echo "Something's wrong with the query2: " . mysqli_error($link);
                        exit();
                    }
                    
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }  else{
            // URL doesn't contain id parameter. Redirect to error page
            header("location: error.php");
            exit();
        }
    }


?>
<html>
    <head>
</head>
<body>
    <center>
<div class="text-right centre">
                <h1 class="register-title">  إضافة أو تعديل بيانات موظف </h1>
            </div>
            <form method="POST" action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>">
                <div class="text-right">
                    <h5 class="register-input-title">الاسم</h5>
                    <input type="text" name="FullName"  value="<?php echo $name; ?> " class="register-input-area" >
                    <span class="Error"><?php echo "*".$Full_name_er;?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">البريد الكتروني</h5>
                    <input type="email" name="Email"  value="<?php echo $Email; ?> " class="register-input-area" >
                    <span class="Error"><?php echo "*".$Email_er;?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">العنوان</h5>
                    <input type="text" name="Address"   value="<?php echo $Address; ?> " class="register-input-area" >
                    <span class="Error"><?php echo "*".$Address_er;?></span>

                </div>

                <div class="text-right">
                    <h5 class="register-input-title">تاريخ الميلاد</h5>
                    <input type="date" name="DateBirth"  value="<?php echo $BirthDate; ?> " class="register-input-area" > 
                    <span class="Error"><?php echo "*".$BirthDate_er;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">رقم الجوال</h5>
                    <input type="text" name="Mobile"  value="<?php echo $Mobile; ?> " class="register-input-area" > 
                    <span class="Error"><?php echo "*".$Mobile_er;?></span>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title">المسمى الوظيفي </h5>
                    <input type="text" name="JobTitle" value="<?php echo $JobTitle; ?> " class="register-input-area" > 
                    <span class="Error"><?php echo "*".$JobTitle_er;?></span>

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
                    <input type="submit"  name="submit" value="إضافة" id="form-register-button" >
                </div>
            </form>
        </div>
</center>

</body>
</html>