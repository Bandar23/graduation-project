<?php 
session_start();

if(!isset($_SESSION["Full_Name"])){
    header("location: login.php");
    exit;
}

require_once 'Config.php';

// Get Patine Information From Patines Table .

$SqlPatine = "SELECT * FROM patines WHERE Patine_Id = ? ";
 if($stmt = mysqli_prepare($link,$SqlPatine)){

    mysqli_stmt_bind_param($stmt,"i",$param_Id);
    $param_Id = $_SESSION["Patine_Id"];

     if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            
            $Full_Name = $row['Patine_Full_Name'];
        }else{
            echo "ليس هناك معلومات ";

            
        }
     }else{
         echo "هناك مشكلةَ ما";
     }

 }

 mysqli_stmt_close($stmt);

 //GET Servec Name And Id .

 $ServiceSql = "SELECT * FROM services";
 $Service_Result = mysqli_query($link,$ServiceSql);

 // GET Doctors Names

 $Doctors_Sql = "SELECT * FROM employees WHERE Employee_Specialty = 'طب أسنان' ";
 $Doctors_Result = mysqli_query($link,$Doctors_Sql);


 // Insert Appointment For The Patine.

 
$Service = $Doctor = $Date = $Time = $Done = "";
$Service_er = $Doctor_er = $Date_er = $Time_er = $Bokced_er = $All_Err = "";

$Tody =  date("d-m-Y");

 if(isset($_POST['create'])){

    $input_Doctor = $_POST['Doctor'];
      if($input_Doctor == 0){
          $Doctor_er = "الرجاء إختيار دكتور ";
      }else {
          
        $Doctor = $input_Doctor;
      }

      $Patine_Id   = $_POST['P_Id'];

      $Patine_Name = $_POST['P_Name'];

      $input_Service = $_POST['Service'];
      if(empty($input_Service)){
          $Service_er = "الرجاء إختيار خدمة ";
      }else {
          $Service = $input_Service;
      }

      

      $input_Date = $_POST['Appo_d'];
      if(empty($input_Date)){
          $Date_er = "الرجاء تحديد تاريخ الموعد ";
      }else{
          $Date = $input_Date;
      }

      $input_Time = $_POST['Appo_t'];
      if(empty($input_Time)){
          $Time_er = "الرجاء تحديد وقت الموعد ";
      }else{
          $Time = $input_Time;
      }
       

      if(empty($Service_er) && empty($Doctor_er) && empty($Date_er) && empty($Time_er)){

        $Bokced = "SELECT count(*) FROM apoointments WHERE Doctor_Id = '".$Doctor."' AND  Reserve_Date =  '".$Date."' AND Reserve_Time = '".$Time."' ";
        $Check = mysqli_query($link,$Bokced);
        $Bokced_Result = mysqli_fetch_array($Check);
        $result = $Bokced_Result['0'];
 
        if($result > 0){
            $_SESSION['err'] = "هذا الوقت محجوز حالياً أختر وقتاً أخر  "; 
        }else{
         
            $Appointment_Sql = "INSERT INTO apoointments(Doctor_Id,Patine_Id,Patine_Name,Service_id,Reserve_Date,Reserve_Time) VALUES (?,?,?,?,?,?) ";

            if($stmt = mysqli_prepare($link,$Appointment_Sql)){
              mysqli_stmt_bind_param($stmt,"iisiss",$ParamDoctorId,$Param_Patine_Id,$Param_Name_Patine,$Param_Service_id,$Param_Date,$Param_Time);
                
                 $ParamDoctorId  = $Doctor;
                 $Param_Patine_Id   = $Patine_Id;
                 $Param_Name_Patine = $Patine_Name;
                 $Param_Service_id  = $Service;
                 $Param_Date        = $Date;
                 $Param_Time        = $Time;
  
                 if(mysqli_stmt_execute($stmt)){ 
                    $_SESSION['msg'] = "تم حجز الموعد بنجاح ، يمكنك مشاهدة تفاصيل موعدك في صفحة المواعيد";
                
          }else{
            $_SESSION['err'] = "هناك مشكلة حاول مرة أخرى ";
              //echo "Something's wrong with the query: " . mysqli_error($link);
          }
        } else {
           // echo "Something's wrong with the query: " . mysqli_error($link);
        }
        mysqli_stmt_close($stmt);

    }

}else{
    $_SESSION['err'] = "الرجاء إدخال جميع المدخلات";
}

// Close connection
mysqli_close($link);
}












?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .error{
        color:red;
    }
    .msg{

background:#dff0d8;
width: 200%;
color:#3c763d;
padding:10px;
font-size:15px;
border-radius:5px;
border:1px solid #3c763d;
text-align: center;
}
.err{
width: 200%;
color: #D8000C;
	background-color: #FFBABA;
    font-family: FontAwesome;
   content: '\f057';
   font-size: 24px;
}
    </style>
</head>
<body>

<?php 
    include("header.php");
    include("logedin_nav.php");
?>

<div id="content-area">
 
    <div id="content_">

    <div class="centre-content">
            <div class="text-right centre">
            <h1 class="register-title">   </h1>
                <h1 class="register-title">حجز موعد</h1>
                <center>
                <?php if(isset($_SESSION['msg'])){ ?> 
                <div class="msg">
                   <?php
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                   ?> 
                  </div>
                   <?php  }elseif(isset($_SESSION['err'])){ ?>
                    <div class="err">
                   <?php

                                      echo $_SESSION['err'];
                                      unset($_SESSION['err']);
                                      ?>
                                      </div>
               <?php    } ?>
  </center>
             


            </div>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
 
                <div class="text-right">

                <div class="text-right"> 
                    <h5 class="register-input-title">الدكتور</h5>
                    <select  name="Doctor" class="register-input-area" >
                        <option selected value="0" >...اختار</option>
                        <?php while($rows = mysqli_fetch_array($Doctors_Result)){ ?>
                        <option value="<?php echo $rows['Employee_Id'];?>"><?php echo $rows['Employee_Full_Name'];?></option>
                        <?php } ?>
                    </select>
                    <span class="error"> <?php echo $Doctor_er; ?> * </sapn>
                </div>
                <input type="hidden" name="P_Id" value = "<?php echo $param_Id; ?>" class="register-input-area" >
                <input type="hidden" name="P_Name" value = "<?php echo $Full_Name; ?>" class="register-input-area">

                    <h5 class="register-input-title">الخدمة</h5>
                    <select  name="Service" class="register-input-area" >
                        <option selected value="0" >...اختار</option>
                        <?php while($row = mysqli_fetch_array($Service_Result)){ ?>
                        <option value="<?php echo $row['Service_Id'];?>"><?php echo $row['Service_Name'];?></option>
                        <?php } ?>
                    </select>
                    <span class="error"> <?php echo $Service_er; ?> * </sapn>
                </div>

                <div class="text-right">
                    <h5 class="register-input-title"> التاريخ</h5>
                    <input type="date" name="Appo_d"   min="<?= date('Y-m-d'); ?>" class="register-input-area">
                <span class="error"><?php echo $Date_er;?> * </sapn>
                    
                </div>
                <div class="text-right">
                    <h5 class="register-input-title">الوقت</h5>
                    <select name="Appo_t" class="register-input-area" >
                        <option selected value="0">...اختار</option>
                        <option value="3:00">3:00</option>
                        <option value="4:00">4:00</option>
                        <option value="5:00">5:00</option>
                        <option value="6:00">6:00</option>
                        <option value="7:00">7:00</option>
                        <option value="8:00">8:00</option>
                        <option value="9:00">9:00</option>

                    </select>
                    <span class="error"><?php echo $Time_er;?> * </span><br>
                </div>

               

                <div class="text-right">
                    <button type="submit" name="create" id="form-register-button" >حجز موعد</button>
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