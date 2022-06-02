<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

require_once 'Config.php';


$CS_Query = "SELECT * FROM complaints_suggestion WHERE Cs_To = 'Admin' ORDER BY CS_Date DESC, CS_Id DESC";
$Result_CS = mysqli_query($link,$CS_Query);
$Num = mysqli_num_rows($Result_CS);

?>

<!DOCTYPE html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../style.css">
    <script>
function showTables(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","CS_FIter.php?d="+str,true);
    xmlhttp.send();
  }
}
</script>
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
<body class="body2">

<?php 
    include("admin_nav.php");
?>

<div id="content-area2">
  <div id="content_2">

  <label> تصفية </lable><br>
                    <select  id="SelectDate" name="Cs" class="register-input-area"  onchange="showTables(this.value)">
                        <option selected value="0">الكل</option>
                        <option value="1">الطلبات  الجديدة</option>
                        <option value="2"> الطلبات  السابقة </option>
                    </select><br/>

 <div id="txtHint">

  <?php if($Num > 0 ){

    while($row = mysqli_fetch_array($Result_CS)){ ?>
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

?>
  
  </div>


    </div>
</div>



</body>
</html>