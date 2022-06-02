<?php  



require_once 'Config.php';

    $q = $_GET['q'];

// Query To Show Patines Table
$Patine_Table = "SELECT * FROM patines";
$Patine_Result = mysqli_query($link,$Patine_Table);

// Query To Show Departments Table
$Departments_Table = "SELECT * FROM departments";
$Departments_Result = mysqli_query($link,$Departments_Table);

$Users_Table = "SELECT * FROM users";
$Users_Result = mysqli_query($link,$Users_Table);

// Query To Show Employees Table
$Employees_Table = "SELECT * FROM employees";
$Employees_Result = mysqli_query($link,$Employees_Table);


?>

<!DOCTYPE html>
<html>
<head>
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: white;
    color: black;
    text-align: center;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px white;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: white;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid white
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: black;

}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
}

.button3 {
  background-color: white; 
  color: black; 
  border: 2px solid #f44336;
}

.button3:hover {
  background-color: #f44336;
  color: white;
}

.butto2 {
  background-color: white; 
  color: black; 
  border: 2px solid #008CBA;
}

.butto2:hover {
  background-color: #008CBA;
  color: white;
}

.button5 {
  background-color: white;
  color: black;
  border: 2px solid #555555;
}

.button5:hover {
  background-color: #555555;
  color: white;
}

</style>
</head>
<body>

<?php 



if($q == 1){ ?>
 
<center>

<table class="styled-table">
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
    <th>  تعديل </th>
    <th> حذف </th>
        </tr>
    </thead>
   
    



    <?php  while($row = mysqli_fetch_array($Employees_Result)) { ?>

      <tbody>
        <tr class="active-row"><?php 
       echo "<td>" . $row['Employee_Id'] . "</td>";
      echo "<td>" . $row['Employee_Full_Name'] . "</td>";
      echo "<td>" . $row['Employee_Email'] . "</td>";
      echo "<td>" . $row['Employee_Address'] . "</td>";
      echo "<td>" . $row['Employee_Birth_Date'] . "</td>";
      echo "<td>" . $row['Employee_Mobile'] . "</td>";
      echo "<td>" . $row['Employee_Gender'] . "</td>";
      echo "<td>" . $row['Employee_Specialty'] . "</td>";
      echo "<td>" . $row['Employee_Job_Title'] . "</td>";
      echo "<td>" . $row['department_Id'] . "</td>";?>
      <td><a href="UpdateUserDelete.php?edit= <?php echo $row['Employee_Id']; ?>"><button class='butto2'>تعديل</button></a></td> 
      <td><a href="DeleteEmployee.php?del=<?php echo $row['Employee_Id']; ?> " ><button class='button3'>حذف</button></a></td> <?php
    }
    mysqli_close($link); ?>

</tr>
    </tbody>
</table>
<br>
      <a href="InserEmployee.php"><button class="button5">إضافة موظف جديد </button></a>


 <?php  }elseif($q == 2){ ?>
  
<table class="styled-table">
    <thead>
        <tr>
        <th>رقم المراجع</th>
        <th>الإسم الكامل</th>
    <th>الإيميل</th>
    <th> العنوان</th>
    <th>تاريخ الميلاد</th>
    <th>رقم الجوال</th>
    <th>النوع</th>
    <th>تعديل و حذف</th>

        </tr>
    </thead 
    <?php 
    while($row = mysqli_fetch_array($Patine_Result)){ ?> 

   <tbody>
        <tr class="active-row"> <?php 
          echo "<td>" . $row['Patine_Id'] . "</td>";
          echo "<td>" . $row['Patine_Full_Name'] . "</td>";
          echo "<td>" . $row['Patine_Email'] . "</td>";
          echo "<td>" . $row['Patine_Brith_Date'] . "</td>";
          echo "<td>" . $row['Patine_Mobile'] . "</td>";
          echo "<td>" . $row['Patine_Address'] . "</td>";
          echo "<td>" . $row['Gender'] . "</td>";?>
          <td><a href="UpdatePatine.php?edit=<?php echo $row['Patine_Id']; ?>"><button class='butto2'>تعديل</button></a></td>
   <?php  }
    mysqli_close($link); ?>

</tr>
    </tbody>
</table> <?php
   
}elseif($q == 3){ ?>
<table class="styled-table">
    <thead>
        <tr> 
    <th>رقم الإدارة</th>
    <th>اسم الإدارة</th>
    <th> رقم الإدارة</th>
    <th> رقم العيادة</th>
    <th>   حذف و تعديل </th>
    </tr>
    </thead 
    <?php 
    while($rows = mysqli_fetch_array($Departments_Result)) { ?>
      <tbody>
        <tr class="active-row"><?php 
      echo "<td>" . $rows['Departments_Id'] . "</td>";
      echo "<td>" . $rows['Departments_Name'] . "</td>";
      echo "<td>" . $rows['Departments_Phone'] . "</td>";
      echo "<td>" . $rows['Clinic_Id']."</td>";?>
    <td><a href="UpdateDepartment.php?edit=<?php echo $rows['Departments_Id']; ?>"><button class='butto2'>تعديل</button></a></td><?php
    }
      mysqli_close($link); ?>
  
  </tr>
      </tbody>
  </table> <?php
   }elseif($q == 4){ ?>

<table class="styled-table">
    <thead>
      <tr>
    <th>رقم المستخدم</th>
    <th>إيميل المستخدم</th>
    <th> كلمة المرور الخاصة بالمستخدم</th>
    <th> نوع المستخدم</th>
    <th>  تعديل </th>
    <th> حذف </th>
    </tr>
<?php 
    while($rows = mysqli_fetch_array($Users_Result)) { ?>
  <tbody>
        <tr class="active-row"><?php 
      echo "<td>" . $rows['User_Id'] . "</td>";
      echo "<td>" . $rows['User_Email'] . "</td>";
      echo "<td>" . $rows['User_Password'] . "</td>";
      echo "<td>" . $rows['Authorization']."</td>";
      echo "<td>"."<a href='#'>"."<button class='butto2'>".'تعديل'."</button>"."</a>"."</td>";
      echo "<td>"."<a href='#'>"."<button class='button3'>".'حذف'."</button>"."</a>"."</td>";
    }
      mysqli_close($link);
      
  }
      ?>
  
  </tr>
  </tbody>
  </table> 
  
</body>
</html>




