<?php 

session_start(); 

if(!isset($_SESSION["Mang_Name"])){
    header("location:/graduationProject2/login.php");
    exit;
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدير الموظفين</title>
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
    xmlhttp.open("GET","AjaxInfo.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
</head>
<body class="body2">

<?php 
    include("manager_nav.php");
?>

<div id="content-area2">
    <div id="content_2">

    <center>
    <form>
      <select  id ="SelectTable" name="Tables" onchange="showTables(this.value)">
          <option value="">اختر البيانات</option>
          <option value="1">بيانات الموظفين</option>
          <option value="2">بيانات المرضى</option>
         
    </select>
</form>
<br>
<div id="txtHint"><b> سيتم إدراج معلومات الموظفين أو المرضى هنا</b></div>

    
</center>
        

    </div>
</div>
</body>
</html>