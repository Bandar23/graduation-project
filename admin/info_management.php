<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

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
    xmlhttp.open("GET","SelectAjax.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>
</head>
<body class="body2">

<?php 
    include("admin_nav.php");
?>

<div id="content-area2">
  <div id="content_2">
<center>
    <form>
      <select  id ="SelectTable" name="Tables" onchange="showTables(this.value)">
          <option value="">اختر الجدول</option>
          <option value="1">جدول الموظفين</option>
          <option value="2">جدول المرضى</option>
          <option value="3">جدول الإدارات</option>
          <option value="4">جدول المستخدمين</option>
    </select>
</form>
<br>
<div id="txtHint"><b> سيتم إدراج معلومات الجدول هنا</b></div>

    
</center>

    </div>
</div>



</body>
</html>