<?php 

session_start();

if(isset($_SESSION["Full_Name"]) && $_SESSION["Authorization"]  == 3){
    header("location: index_logedin.php");
    exit;
}elseif(isset($_SESSION["Emp_Name"]) && $_SESSION["Authorization"]  == 2) {
    header("location: doctor/main_page.php");
    exit;
}elseif(isset($_SESSION["Admin_Name"]) && $_SESSION["Authorization"]  == 1) {
    header("location: doctor/main_page.php");
    exit;
}elseif(isset($_SESSION["Mang_Name"]) && $_SESSION["Authorization"]  == 4) {
  header("location: manager/main_page.php");
  exit;
}


 require_once 'Config.php';


$email = $password = "";
$email_er = $password_er = "";

$Pass_er = $Ema_er = "";



if($_SERVER["REQUEST_METHOD"] == "POST"){

   $input_Email = trim($_POST['email']);
   if(empty($input_Email)){
    $Ema_er = "الرجاء إدخال البريد الإلكتروني";
   }else{
     $email = $input_Email;
   }

   $input_password = trim($_POST['password']);
   if(empty($input_password)){
    $Pass_er = "الرجاء إدخال كلمة المرور";
   }else{
     $password = $input_password;
   }

   if(empty($Ema_er) && empty( $Pass_er)){
                
     $Req = " SELECT * FROM users WHERE User_Email = '".$email."' ";
     $query = mysqli_query($link,$Req);

     $row = mysqli_fetch_array($query);
     $pass = $row['User_Password'];
     $Atuhz    = $row['Authorization'];
     $num      = mysqli_num_rows($query);

    // verify Of Name It's Found In DB 
     if($num == 1 ){
        // verify Of Password It's Found In DB 
         if(password_verify($password,$pass)){
            if($Atuhz == 3){
               
                $Patine_Sql = "SELECT Patine_Id,Patine_Full_Name FROM patines WHERE Patine_Email = '".$email."' "; 
                $Patine_query = mysqli_query($link,$Patine_Sql);
                $Patine_Row = mysqli_fetch_array($Patine_query);
                $Patine_Id = $Patine_Row['Patine_Id'];
                $Patine_Name = $Patine_Row['Patine_Full_Name'];

                $_SESSION["Patine_Id"] = $Patine_Id; 
                $_SESSION["Full_Name"] = $Patine_Name; 
                $_SESSION['Authorization']   = $Atuhz; 
                
                header("location: index_logedin.php");

            }elseif($Atuhz == 2){

                $Employee_Sql   = "SELECT Employee_Id,Employee_Full_Name FROM employees WHERE Employee_Email = '".$email."' "; 
                $Employee_query = mysqli_query($link,$Employee_Sql);
                $Employee_Row   = mysqli_fetch_array($Employee_query);
                $Employee_Id    = $Employee_Row['Employee_Id'];
                $Employee_Name  = $Employee_Row['Employee_Full_Name'];

                $_SESSION["Emp_Id"]   = $Employee_Id; 
                $_SESSION["Emp_Name"] = $Employee_Name; 
                $_SESSION['Authorization']   = $Atuhz;                             
                
               header("location: doctor/main_page.php");

             }elseif($Atuhz == 1){

                $Admin_Sql    = "SELECT Employee_Id,Employee_Full_Name FROM employees WHERE Employee_Email = '".$email."' "; 
                $Admine_query = mysqli_query($link,$Admin_Sql);
                $Admin_Row    = mysqli_fetch_array($Admine_query);
                $Admin_Id     = $Admin_Row['Employee_Id'];
                $Admin_Name   = $Admin_Row['Employee_Full_Name'];

                $_SESSION["Admin_Id"]        = $Admin_Row; 
                $_SESSION["Admin_Name"]      = $Admin_Name; 
                $_SESSION['Authorization']   = $Atuhz;                          
                
                 // Redirect user to welcome page
                 header("location: /graduationProject/admin/main_page.php");
             }elseif($Atuhz == 4){
              $Mang_Sql    = "SELECT Employee_Id,Employee_Full_Name FROM employees WHERE Employee_Email = '".$email."' "; 
              $Mang_query = mysqli_query($link,$Mang_Sql);
              $Mang_Row    = mysqli_fetch_array($Mang_query);
              $Mang_Id     = $Mang_Row['Employee_Id'];
              $Mang_Name   = $Mang_Row['Employee_Full_Name'];

              $_SESSION["Mang_Id"]        = $Mang_Row; 
              $_SESSION["Mang_Name"]      = $Mang_Name; 
              $_SESSION['Authorization']   = $Atuhz;  
                   // Redirect user to welcome page
                 header("location: /graduationProject/manager/main_page.php");
             }else{
              $password_er = "كلمة المرور أو البريد الإلكتروني غير صحيحان";
             }

         }else{
            $password_er = "كلمة المرور أو البريد الإلكتروني غير صحيحان";
        }
     }else{
        $password_er = "كلمة المرور أو البريد الإلكتروني غير صحيحان";
    }

   }

}


   
  

     
     ?> 

<!DOCTYPE html>
<html lang="en">
<head>
<style>
* {
  margin: 0px;
  padding: 0px;
}
body {
  font-size: 120%;
  background: #F8F8FF;
}

.header {
  width: 30%;
  margin: 50px auto 0px;
  color: white;
  background: #5F9EA0;
  text-align: center;
  border: 1px solid #B0C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
}
form, .content {
  width: 30%;
  margin: 0px auto;
  padding: 20px;
  border: 1px solid #B0C4DE;
  background: white;
  border-radius: 0px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 5px 10px;
  font-size: 16px;
  border-radius: 5px;
  border: 1px solid gray;
}
.btn {
  padding: 10px;
  font-size: 15px;
  color: white;
  background: #5F9EA0;
  border: none;
  border-radius: 5px;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  color: #a94442; 
  border-radius: 5px; 
  text-align: left;
}
.success {
  color: #3c763d; 
  background: #dff0d8; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
</style>
</head>
<body>
<div class="header">
  	<h2>تسجيل الدخول</h2>
  </div>
	 
                    <div class="form-log">
                      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                      <div class="input-group">
                      <span class="error"><?php echo $password_er; ?></span><br><br>

                        <label>الإيميل</label><br>
                         <input  class="inpu" type="email" name="email" placeholder="أدخل إيميلك"><br><br>
                         <span class="error"><?php echo $Ema_er; ?></span><br><br>

                          </div>           

                         <div class="input-group">
                         <label>كلمة المرور</label><br>
                         <input class="inpu" type="password" name="password" placeholder="أدخل كلمة المرور "><br><br>
                         <span class="error"><?php echo $Pass_er; ?></span><br><br>

                         </div>                         


      
                         <input class="btn" type="submit" name="login" value="تسجيل الدخول"><br><br>
                         <p>لستً مسجلاً ؟  <a href="register.php">إنشاء حساب</a></p>
      
                      </form>
                    </div>
                  </div>
</div>