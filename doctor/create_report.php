<?php 

session_start(); 

if(!isset($_SESSION["Emp_Name"])){
  header("location: login.php");
  exit;
}

require_once 'Config.php';

$Doctor_Name = $patine_Name = $param_id = "";
if(isset($_GET["create"]) && !empty(trim($_GET["create"]))){

$Sql_Appointment = "SELECT a.Apoointment_Id,d.Employee_Full_Name,a.Patine_Name
FROM apoointments a INNER JOIN employees d ON a.Doctor_Id =  d.Employee_Id WHERE a.Apoointment_Id = ? ";
 if($stmt = mysqli_prepare($link,$Sql_Appointment)){
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    $param_id = trim($_GET["create"]);

    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


             $Doctor_Name   = $row['Employee_Full_Name'];
             $patine_Name   = $row['Patine_Name'];

             $Sql_Report_Done = "SELECT count(*) FROM reports WHERE Apoointment_Id = $param_id";
             $Check = mysqli_query($link,$Sql_Report_Done);
             $Result_Done = mysqli_fetch_array($Check);
             $Result = $Result_Done['0'];
             if($Result > 0 ){?>
                 
                <script type='text/javascript'>
                alert('تم إصدار تقرير لهذا المراجع سابقاً');
                window.location.href = "appointements.php";
                </script> <?php 
             }
             
            }else {
                echo "There Is SomeThing Wrong ! ";
                echo "Something's wrong with the query: " . mysqli_error($link);
    
            }
    
        }else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }else{
        echo "Oops! Something went wrong. Please try again later.";
    }
        mysqli_stmt_close($stmt);
    
    
}


$report_Title = $report_Detiles = $reporter = $reciver = $id = "";
$report_Title_er = $report_Detiles_er = $reporter_er = $reciver_er = "";




if(isset($_POST['submit']) && !empty($_POST['submit'])){

    //check if was issuance the report by the Apoointment_Id or no 
            
    
                    $input_report_Title = trim($_POST['title']);
                    if(empty($input_report_Title)){
                        $report_Title_er = "الرجاء إدخال عنوان التقرير ";
                    }else{
                        $report_Title = $input_report_Title;
                    }
                    $input_report_Detailse = trim($_POST['detailes']);
                    if(empty($input_report_Detailse)){
                        $report_Detiles_er = "الرجاء إدخال محتوى التقرير ";
                    }else{
                        $report_Detiles =$input_report_Detailse;
                    }
    
                    $input_reciver = trim($_POST['reciver']);
                    if(empty($input_reciver)){
                        $reciver_er = "يبدو أن هناك مشكلة في تحديد أسم النستقبل ";
                    }else{
                        $reciver = $input_reciver;
                    }
    
                    $input_reporter = trim($_POST['reporter']);
                    if(empty($input_reporter)){
                        $reporter_er = "يبدو أن هناك مشكلة في تحديد أسم النستقبل ";
                    }else{
                        $reporter = $input_reporter;
                    }

                    $id = $_POST['appointment_id'];
    
    
                    if(empty($report_Title_er) && empty($report_Detiles_er) && empty($reciver_er) && empty($reporter_er)){
                     $Insert = "INSERT INTO reports(Report_Title,Report_Detailse,Reporter,Reciver,Apoointment_Id)
                     VALUES ('$report_Title','$report_Detiles','$reporter','$reciver',$id)";
                     $Result_Report = mysqli_query($link,$Insert);
                     header("location: appointements.php");

    
    
                    }else{
                        echo " هناك مشكلة الرجاء المحاولة مرة أخرى ";
                        //echo "Something's wrong with the query: " . mysqli_error($link);
    
                    }
        }
    
    


      


?>

<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.tiny.cloud/1/sm78zfcsxu9o3edisjj0dd3e67qtnli0lo1ak9tk05hffl7x/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script> 
           tinymce.init({
           selector: 'textarea'
           
         });
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> إنشاء التقارير</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body class="body2">

<?php 
    include("doc_nav.php");
?>

<div id="content-area2">
    <div id="content_2">

    <form id="userForm" method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="text-right">
                <center>
                <span class="Error"><?php echo "*".$report_Detiles_er;?></span>
                    <h5 class="register-input-title">عنوان التقرير</h5>
                    <input type="text" id="title" name="title" class="register-input-area" value="">
                    <span class="Error"><?php echo "*".$report_Title_er;?></span>
                    </center>

                </div>


                <div class="text-right">
                    <h5 class="register-input-title">محتوى التقرير</h5>
                    <textarea type="text" id="detailes" rows="3" cols="10" name="detailes" class="register-input-area" value="">
                    </textarea>
                   
                </div>

                <div class="text-right">
                    <input type="hidden" id="reporter" name="reporter" class="register-input-area" value="<?php echo $Doctor_Name; ?>">
                </div>

                <div class="text-right">
                    <input type="hidden" id="reciver" name="reciver" class="register-input-area" value="<?php echo $patine_Name; ?>">
                </div>
                <div class="text-right">
                    <input type="hidden" id="reciver" name="appointment_id" class="register-input-area" value="<?php echo $param_id; ?>">
                </div>
                <div class="text-right">
                <input type="submit"  name="submit" value="إنشاء التقرير" class="button2" ><br>
                </div>

                </form>

    </div>
</div>
</body>
</html>


<!-- 
    -->
    
