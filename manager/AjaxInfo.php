
<?php 

require_once 'Config.php';


$q = $_GET['q'];

// Query To Show Patines Table
$Patine_Table = "SELECT * FROM patines";
$Patine_Result = mysqli_query($link,$Patine_Table);

// Query To Show Employees Table
$Employees_Table = "SELECT e.*,d.* FROM employees e INNER JOIN departments d ON e.department_Id = d.Departments_Id";
$Employees_Result = mysqli_query($link,$Employees_Table);



?>

<!DOCTYPE html>
<html>
<head>
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
</head>
<body>

<?php 



if($q == 1){ ?>
 
<center>
<div class="table-wrapper">
    <table class="fl-table">
<thead>
  <tr>
    <th>رقم الموظف</th>
    <th>الإسم الكامل</th>
    <th>الإيميل</th>
    <th> العنوان</th>
    <th>تاريخ الميلاد</th>
    <th>رقم الجوال</th>
    <th>النوع</th>
    <th>التخصص</th>
    <th> المسمى الوظيفي</th>
    <th> الإدارة</th>
    <th>  -- </th>
    <th>  عرض </th>
    </thead>
 <tbody>
    </tr> 
    <?php  while($row = mysqli_fetch_array($Employees_Result)) { 
        echo "<tr>";
      echo "<td>" . $row['Employee_Id'] . "</td>";
      echo "<td>" . $row['Employee_Full_Name'] . "</td>";
      echo "<td>" . $row['Employee_Email'] . "</td>";
      echo "<td>" . $row['Employee_Address'] . "</td>";
      echo "<td>" . $row['Employee_Birth_Date'] . "</td>";
      echo "<td>" . $row['Employee_Mobile'] . "</td>";
      echo "<td>" . $row['Employee_Gender'] . "</td>";
      echo "<td>" . $row['Employee_Specialty'] . "</td>";
      echo "<td>" . $row['Employee_Job_Title'] . "</td>";
      echo "<td>" . $row['Departments_Name'] . "</td>"; ?>
      <td><a href="#">عرض </a></td> <?php
      echo "<td>" .'موظف'. "</td>";

    } ?>
 </tr>
 
 <tbody>
</table>
</div>
  </div>
  <?php     mysqli_close($link); ?>
<br>

 <?php  }elseif($q == 2){
    echo "<div class='table-wrapper'>
    <table class='fl-table'>
    <thead>
    <tr>
    <th>Id</th>
    <th>الإسم الكامل</th>
    <th>الإيميل</th>
    <th>تاريخ الميلاد</th>
    <th>رقم الجوال</th>
    <th>العنوان</th>
    <th>النوع</th>
    <th>#</th>

    </thead>
 <tbody>
    </tr>";
    while($row = mysqli_fetch_array($Patine_Result)) {
      echo "<tr>";
      echo "<td>" . $row['Patine_Id'] . "</td>";
      echo "<td>" . $row['Patine_Full_Name'] . "</td>";
      echo "<td>" . $row['Patine_Email'] . "</td>";
      echo "<td>" . $row['Patine_Brith_Date'] . "</td>";
      echo "<td>" . $row['Patine_Mobile'] . "</td>";
      echo "<td>" . $row['Patine_Address'] . "</td>";
      echo "<td>" . $row['Gender'] . "</td>";
      echo "<td>" .'مراجع'. "</td>";
      echo "</tr>";
    } ?>
   
 <tbody>
</table>
</div>
  </div>
  <?php  
     mysqli_close($link);   
}else{
    echo " لا يوجد بيانات ";
}


