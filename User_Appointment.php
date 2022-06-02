<?php 

session_start();


if(isset($_SESSION["Full_Name"])){

    require_once 'Config.php';

$Patine_Id = $_SESSION["Patine_Id"];
$Patine_Name = $_SESSION["Full_Name"];

$Tody   =  date('Y-m-d');


// This Query For New Appointment .
$New_Appointment = "SELECT a.Apoointment_Id,d.Employee_Full_Name,a.Patine_Id,a.Patine_Name,a.Reserve_Date,a.Reserve_Time
 FROM apoointments a INNER JOIN employees d on 
 a.Doctor_Id = d.Employee_Id WHERE a.Patine_Id = $Patine_Id And a.Reserve_Date = '$Tody' OR a.Patine_Id = $Patine_Id And a.Reserve_Date > '$Tody' ORDER BY a.Reserve_Date desc";
$Result_New      = mysqli_query($link,$New_Appointment);
$N_num = mysqli_num_rows($Result_New);


// This Query For Old Appointment .
$Old_Appointment = "SELECT a.Apoointment_Id,d.Employee_Full_Name,a.Patine_Id,a.Patine_Name,a.Reserve_Date,a.Reserve_Time
 FROM apoointments a INNER JOIN employees d on 
 a.Doctor_Id = d.Employee_Id WHERE  Patine_Id = $Patine_Id And Reserve_Date != '$Tody' And Reserve_Date < '$Tody' ORDER BY Reserve_Date desc";
$Result_Old     = mysqli_query($link,$Old_Appointment);
$O_num = mysqli_num_rows($Result_Old);

// This Varible For If Not Found Any Appointment Show Meesage.
$not_found ="";


 


?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>المواعيد</title>
<link rel="stylesheet" href="./style.css">
<script>

$(document).ready(function(){
 $(".delete_data").click(function(){
   var del_id = $(this).attr('Apoointment_Id');
   $.ajax({
      type:'POST',
      url:'Cansel.php',
      data:'delete_id='+del_id,
      success:function(data) {
        if(data) { // Sucess
        } else { // Error }
      }
   });
 });
});
})
</script>
<style>
   table {
  width: 90%;
  border-collapse: collapse;
  
}

table, td, th {
    color:rgb(0,0,0);
    background-color:rgb(120,120,120);
    border: 1px solid rgb(120,120,120);
    
    padding: 10px;
    margin:10px;
    margin-left:77px;
}

th {
    color:rgb(255,255,255);
    text-align: center;
}
td{
    background-color:rgb(220,220,220);
}
.msg{

background:#dff0d8;
width: 50%;
color:#3c763d;
padding:10px;
font-size:15px;
border-radius:5px;
border:1px solid #3c763d;
text-align: center;
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
        <center>
    <h1 style="color:blue;">مواعيدك </h1><br/>
    </center>

    <center>
    <?php if(isset($_SESSION['msg'])): ?> 
      <div class="msg">
         <?php
           echo $_SESSION['msg'];
           unset($_SESSION['msg']);
         ?>
        </div>
    <?php  endif  ?> 
  </center>

<?php  if($N_num > 0 ){
while($row = mysqli_fetch_array($Result_New)) { ?> 
<div class="table-light">
<table>
    <tr>
        <h4 style="color:blue;">موعد جديد</h4>
    <th>إلغاء الموعد</th>
    <th>الوقت</th>
    <th>الناريخ  </th>
    <th> اسم الدكتور</th>
    <th> اسم المراجع</th>
    <th>رقم المراجع</th>
    <th>رقم الموعد</th>


</tr> <?php
        echo "<tr>";?>
      <td><a class="a" href="Cansel.php?Cans=<?php echo $row['Apoointment_Id']; ?>"><img src="https://img.icons8.com/windows/32/000000/--cancel-delete.png"/></a></td> <?php
        echo "<td>" . $row['Reserve_Time'] . "</td>";
        echo "<td>" . $row['Reserve_Date'] . "</td>";
        echo "<td>" . $row['Employee_Full_Name'] . "</td>";
        echo "<td>" . $row['Patine_Name'] . "</td>";
        echo "<td>" . $row['Patine_Id'] . "</td>";
        echo "<td>" . $row['Apoointment_Id'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
    </div>
    <?php
}else{
    $not_found = "لا توجد لديك مواعيد ";
}

if($O_num > 0 ){
    while($row = mysqli_fetch_array($Result_Old)) { ?> 
    <div class="table-light">
    <table>
        <tr>
            <h4 style="color:red;">موعد سابق</h4>
        <th>الوقت</th>
        <th>الناريخ  </th>
        <th> اسم الدكتور</th>
        <th> اسم المراجع</th>
        <th>رقم المراجع</th>
        <th>رقم الموعد</th>
    
    
    </tr> <?php
            echo "<tr>";
            echo "<td>" . $row['Reserve_Time'] . "</td>";
            echo "<td>" . $row['Reserve_Date'] . "</td>";
            echo "<td>" . $row['Employee_Full_Name'] . "</td>";
            echo "<td>" . $row['Patine_Name'] . "</td>";
            echo "<td>" . $row['Patine_Id'] . "</td>";
            echo "<td>" . $row['Apoointment_Id'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
        </div>
        <?php
    }else{
      // $not_found = "لايوجد مواعيد سابقة ";
    }

?>

    
<center>

<?php echo $not_found ; ?>
</center>

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
