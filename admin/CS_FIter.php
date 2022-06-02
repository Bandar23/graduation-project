<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

require_once 'Config.php';

$New = $_GET['d'];

$Date_Tody = date('Y-m-d'); 

// Result All
$Sql_All = "SELECT * FROM complaints_suggestion WHERE Cs_To = 'Admin' ORDER BY CS_Date DESC, CS_Id DESC";
$Result_All = mysqli_query($link,$Sql_All);
$num_All = mysqli_num_rows($Result_All);

// Result Today
$Sql_Today = "SELECT * FROM complaints_suggestion WHERE Cs_To = 'Admin' And CS_Date = '$Date_Tody'   ORDER BY CS_Date DESC, CS_Id DESC";
$Result_Today = mysqli_query($link,$Sql_Today);
$num_Tody = mysqli_num_rows($Result_Today);


// Result Old
$Sql_Old = "SELECT * FROM complaints_suggestion WHERE Cs_To = 'Admin' And CS_Date < '$Date_Tody'   ORDER BY CS_Date DESC, CS_Id DESC";
$Result_Old = mysqli_query($link,$Sql_Old);
$num_Old = mysqli_num_rows($Result_Old);



?>

<!DOCTYPE html>
<html>
<head>
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



if($New == 0){
    if($num_All > 0 ){

        while($row = mysqli_fetch_array($Result_All)){ ?>
              <div class="Content-Report">
                <h4> رقم الطلب : <?php echo $row['CS_Id']; ?> #</h4>
                <center>
                <h4> العنوان </h4><br>
                <span> (  <?php echo $row['Cs_Subject']; ?> )</span><br/><br/>
                <p><?php  echo $row['Cs_Content']; ?> </p><br>
                </center>
    
                <h5 class="doc"><?php echo $row['Cs_Sender']; ?> : مدير الموظفين </h5>
                <h5 class="usr"><?php echo $row['CS_Date']; ?> : التاريخ </h5><br>
    
                   
              </div><br/> <?php
    
     } 
    }else{
        echo "لا توجد أي طلبات حالياً   ";
    }

}elseif($New == 1 ){

 if($num_Tody > 0 ){

        while($row = mysqli_fetch_array($Result_Today)){ ?>
              <div class="Content-Report">
                <h4> رقم الطلب : <?php echo $row['CS_Id']; ?> #</h4>
                <center>
                <h4> العنوان </h4><br>
                <span> (  <?php echo $row['Cs_Subject']; ?> )</span><br/><br/>
                <p><?php  echo $row['Cs_Content']; ?> </p><br>
                </center>
    
                <h5 class="doc"><?php echo $row['Cs_Sender']; ?> : مدير الموظفين </h5>
                <h5 class="usr"><?php echo $row['CS_Date']; ?> : التاريخ </h5><br>
    
                   
              </div><br/> <?php
    
     } 
    }else{
        echo "لا توجد أي طلبات حالياً   ";
    }

}elseif($New == 2){

    if($num_Old > 0 ){

        while($row = mysqli_fetch_array($Result_Old)){ ?>
              <div class="Content-Report">
                <h4> رقم الطلب : <?php echo $row['CS_Id']; ?> #</h4>
                <center>
                <h4> العنوان </h4><br>
                <span> (  <?php echo $row['Cs_Subject']; ?> )</span><br/><br/>
                <p><?php  echo $row['Cs_Content']; ?> </p><br>
                </center>
    
                <h5 class="doc"><?php echo $row['Cs_Sender']; ?> : مدير الموظفين </h5>
                <h5 class="usr"><?php echo $row['CS_Date']; ?> : التاريخ </h5><br>
    
                   
              </div><br/> <?php
    
     } 
    }else{ ?>
    <center> <?php
        echo "لا توجد أي طلبات سابقة    "; ?>
    </center> <?php
    }
}
     
?>
