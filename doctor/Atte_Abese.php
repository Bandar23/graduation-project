
<?php 

session_start(); 

if(!isset($_SESSION["Emp_Name"])){
  header("location: login.php");
  exit;
} 

date_default_timezone_set('Asia/Riyadh');

$SESSION_Name = $_SESSION['Emp_Name'];
$SESSION_ID = $_SESSION['Emp_Id'];
$rel_Name  = $real_Id = "";
$rel_Name_er = $real_Id_er = $Done = $err = "";

if(isset($_POST['Go'])){

  require_once 'Config.php';

   $input_name = trim($_POST['Name']);
   if(empty($input_name)){
     $rel_Name_er = "الرجاء كتابة الأسم ";
   }elseif($input_name != $SESSION_Name){
       $rel_Name_er = "لا يتطابق اسمك مع الأسم الذي أدخلته،الرجاء إدخال اسمك الحقيقي";
      }elseif(!filter_var(trim($input_name), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $rel_Name_er = "الرجاء إدخال الأسم بشكل صحيح";
      }else{
        $rel_Name = $input_name;
      }

      $input_ID = trim($_POST['number_Id']);
      if(empty($input_ID)){
        $real_Id_er = "الرجاء إدخال رقمك الوظيفي ";
      }elseif($input_ID != $SESSION_ID){
        $real_Id_er = "رقمك الوظيفي لا يتطابق مع الرقم المدخل، الرجاء إدخاله صحيحاً";
      }else{
        $real_Id = $input_ID;
      }

      if(empty($rel_Name_er) && empty($real_Id_er)){
        $sql = "INSERT INTO attendees VALUES(?,?,?,?,?)";
        if($stmt = mysqli_prepare($link,$sql)){
          mysqli_stmt_bind_param($stmt,"sssss",$param_ID,$param_Name,$param_Date,$param_Time,$param_Status);
          $param_Name = $rel_Name;
          $param_ID   = $real_Id;
          $param_Date = date("Y-m-d");
          $param_Time = date("h:i");
          $param_Status = "تم الحضور";

          if(mysqli_stmt_execute($stmt)){
            $Done = "تم تسجيل حضورك ";
          }else{
            $err = "الرجاء إدخال البيانات بشكل صحيح";
          }

        }else{
          $err = "هناك مشكلة تقنية الرجاء المحوالة لاحقاً و الإتصال بمشرفك ";
        }

      }else{
        $err = "هناك مشكلة الرجاء المحاولة لاحقاً";
      }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> تسجيل الحضور و الغياب و الإنصراف</title>
    <link rel="stylesheet" href="../style.css">
	<style> 
  .err{
    color:red;
  }
input[type=text] {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=text]:focus {
  border: 3px solid #555;
}
input[type=number] {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  -webkit-transition: 0.5s;
  transition: 0.5s;
  outline: none;
}

input[type=number]:focus {
  border: 3px solid #555;
}
</style>
</head>
<body class="body2">
<?php 
    include("doc_nav.php");
?>

<div id="content-area2">
    <div id="content_2">
	<center>
    <h1><?php echo $Done; ?> </h1>
    <h1><?php echo $err; ?> </h1>

	<h1>تسجيل حضورك في النظام</h1><br/><br/>
	<p>الرجاء كتابة أسمك و رقمك الوظيفي و الضغط على زر  تسجيل الحضور </p><br/><br/>
	
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  <label for="fname">الأسم</label><br/>
  <input type="text" id="Name" name="Name" value="<?php echo $rel_Name; ?>"><br/><br/>
  <span class="err"><?php echo $rel_Name_er; ?> </span><br/><br/>
  <label for="lname">الرقم الوظيفي</label><br/>
  <input type="number" id="number_Id" name="number_Id"  value="<?php echo $real_Id; ?>"><br/>
  <span class="err"><?php echo $real_Id_er; ?> <span><br/><br/>

  <input type="submit" name="Go" value="تسجيل الحضور"><br/>

</form>
</center>

    </div>
</div>
</body>
</html>