<?php 

session_start(); 

require_once 'Config.php';


if(!isset($_SESSION["Emp_Name"])){
  header("location: login.php");
  exit;
}

$Doctro_id = $_SESSION["Emp_Id"];
$Doctro_Name = $_SESSION["Emp_Name"];



$Query_Appointment = "SELECT a.Apoointment_Id,d.Employee_Full_Name,a.Patine_Id,Patine_Name,a.Reserve_Date,a.Reserve_Time
 FROM apoointments a INNER JOIN employees d on 
 a.Doctor_Id = d.Employee_Id WHERE Doctor_Id = $Doctro_id ORDER BY a.Reserve_Date DESC, a.Apoointment_Id DESC ";
 
 $Result_Query = mysqli_query($link,$Query_Appointment);
 $num = mysqli_num_rows($Result_Query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  المواعيد  </title>
    <link rel="stylesheet" href="../style.css">
    <style>
*{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
}
body{
    font-family: Helvetica;
    -webkit-font-smoothing: antialiased;
    background: rgba( 71, 147, 227, 1);
}
h2{
    text-align: center;
    font-size: 18px;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: white;
    padding: 30px 0;
}

/* Table Styles */

.table-wrapper{
    margin: 10px 70px 70px;
    box-shadow: 0px 35px 50px rgba( 0, 0, 0, 0.2 );
}

.fl-table {
    border-radius: 5px;
    font-size: 12px;
    font-weight: normal;
    border: none;
    border-collapse: collapse;
    width: 100%;
    max-width: 100%;
    white-space: nowrap;
    background-color: white;
}

.fl-table td, .fl-table th {
    text-align: center;
    padding: 8px;
}

.fl-table td {
    border-right: 1px solid #f8f8f8;
    font-size: 12px;
}

.fl-table thead th {
    color: black;
    background:#c6d2c3
;
}


.fl-table thead th:nth-child(odd) {
    color: black;
    background:#c6d2c3

;
}

.fl-table tr:nth-child(even) {
    background: #F8F8F8;
}

/* Responsive */

@media (max-width: 767px) {
    .fl-table {
        display: block;
        width: 100%;
    }
    .table-wrapper:before{
        content: "Scroll horizontally >";
        display: block;
        text-align: right;
        font-size: 11px;
        color: white;
        padding: 0 0 10px;
    }
    .fl-table thead, .fl-table tbody, .fl-table thead th {
        display: block;
    }
    .fl-table thead th:last-child{
        border-bottom: none;
    }
    .fl-table thead {
        float: left;
    }
    .fl-table tbody {
        width: auto;
        position: relative;
        overflow-x: auto;
    }
    .fl-table td, .fl-table th {
        padding: 20px .625em .625em .625em;
        height: 60px;
        vertical-align: middle;
        box-sizing: border-box;
        overflow-x: hidden;
        overflow-y: auto;
        width: 120px;
        font-size: 13px;
        text-overflow: ellipsis;
    }
    .fl-table thead th {
        text-align: left;
        border-bottom: 1px solid #f7f7f9;
    }
    .fl-table tbody tr {
        display: table-cell;
    }
    .fl-table tbody tr:nth-child(odd) {
        background: none;
    }
    .fl-table tr:nth-child(even) {
        background: transparent;
    }
    .fl-table tr td:nth-child(odd) {
        background: #F8F8F8;
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tr td:nth-child(even) {
        border-right: 1px solid #E6E4E4;
    }
    .fl-table tbody td {
        display: block;
        text-align: center;
    }
}

.a:link, a:visited {
  background-color: #faffe8
;
  color: blue;
  padding: 5px 10px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

.a:hover, a:active {
  background-color: #c6d2c3;
}
    </style>
      <script>
function showTables(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 3 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","Filter_Appointments.php?Appoi="+str,true);
    xmlhttp.send();
  }
}
</script>
</head>
<body class="body2">

<?php 
    include("doc_nav.php");
?>

<div id="content-area2">
    <div id="content_2">

    <center>
    <h3>المواعيد التي تم حجزها لديك </h3>

    </center>

    <label> تصفية </lable><br>
                    <select  id="SelectAppin" name="Appi" class="register-input-area"  onchange="showTables(this.value)">
                        <option selected value="0">الكل</option>
                        <option value="1">المواعيد الجديدة</option>
                        <option value="2">المواعيد السابقة </option>
                    </select><br/> <br/>

                    
<div id="txtHint">
<?php 
if($num > 0 ){ 
 while($row = mysqli_fetch_array($Result_Query)) { ?>
  <div class="table-wrapper">
    <table class="fl-table">
<thead>
  <tr>
  <th>رقم الموعد</th>
  <th> اسم الدكتور</th>
  <th>رقم المراجع</th>
  <th> اسم المراجع</th>
  <th>الناريخ  </th>
  <th>الوقت</th>
  <th>إصددار فاتورة</th>
  <th> إنشاء تقرير </th>
  </tr>
      </thead>
 <tbody>
        <tr> <?php
      echo "<td>" . $row['Apoointment_Id'] . "</td>";
      echo "<td>" . $row['Employee_Full_Name'] . "</td>";
      echo "<td>" . $row['Patine_Id'] . "</td>";
      echo "<td>" . $row['Patine_Name'] . "</td>";
      echo "<td>" . $row['Reserve_Date'] . "</td>";
      echo "<td>" . $row['Reserve_Time'] . "</td>";?>
      <td><a class="a" href="Issuance.php?Issu=<?php echo $row['Apoointment_Id']; ?>">إصدار </a></td> 
      <td><a class="a" href="create_report.php?create=<?php echo $row['Apoointment_Id']; ?> " >إنشاء</a></td> <?php
      echo "</tr>";
    } ?>
  </tr>
 
 <tbody>
</table>
</div>
  </div>

<?php 

mysqli_close($link);
   }else{
     echo "لا توجد لديك أي مواعيد حالياً";
   } ?>

    
    </div>
  </div>
</body>
</html>