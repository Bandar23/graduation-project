<?php 

session_start();

require_once 'Config.php';

if(isset($_SESSION["Full_Name"])){

$Patine_Name = $_SESSION["Full_Name"];


$Sql_Reports_Patine = "SELECT * FROM reports WHERE Reciver = '".$Patine_Name."' ";
$Result_Reports     = mysqli_query($link,$Sql_Reports_Patine);
$num = mysqli_num_rows($Result_Reports);
$not_found = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>لوحة التحكم</title>
<link rel="stylesheet" href="./style.css">
<style>
* {
margin: 0;
padding: 0;
font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
box-sizing: border-box;
font-size: 14px;
}

img {
max-width: 100%;
}

.Content-Report{
    display: block !important;
    max-width: 900px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
    
    background-color: #f6f6f6;
    width: 100%;
    padding: 20px;
    border: none;
    border-radius: 2vw;
    box-shadow: 0 -0.2vw 0.7vw 0.1vw   rgba(0,0,0,0.12);
}
.doc{
text-align:left;
}
.usr{
    text-align:right;
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
            <a href="CS.php" class="p-menu">تقديم شكاوي و اقترحات</a>
        </div>

        <div id="profile-content">
        <?php  if($num > 0){
        while($row = mysqli_fetch_array($Result_Reports)){ ?>
        <div class="Content-Report">
            <h4> رقم التقرير : <?php echo $row['Report_id']; ?> #</h4>
            <h4> رقم الموعد : <?php echo $row['Apoointment_Id']; ?> #</h4><br>

            <h4> عنوان التقرير</h4><br>
            <span> (  <?php echo $row['Report_Title']; ?> )</span><br/><br/>
            <p><?php echo $row['Report_Detailse']; ?> </p><br>


            <h5 class="doc"><?php echo $row['Reporter']; ?> : الدكتور </h5>
            

            <h5 class="usr"><?php echo $row['Reciver']; ?> : أسم المراجع</h5><br>
     
          </div><br/>
            <?php }
            }else{
                $not_found = "لا توجد لديك تقارير طبية حالياً";
            } ?>

        <br/><br/>
            <?php echo $not_found; ?>


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
