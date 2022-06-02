<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

require_once 'Config.php';


$Service = "SELECT * FROM services";
$result = mysqli_query($link,$Service);

$num = mysqli_num_rows($result);
//echo "Something's wrong with the query: " . mysqli_error($link);



?>

<!DOCTYPE html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>services</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    </style>
</head>
<body class="body2">

<?php 
    include("admin_nav.php");
?>

<div id="content-area2">
  <div id="content_2">
  <a  href="Add_Adds.php"><img src="https://img.icons8.com/ios/50/000000/plus--v1.png"/></a>
      <center>
      <p>بإمكانك التعديل و الحذف على الخدمات و كذلك إضافة الخدمات الجديدة</p>
</center>


 <?php  if($num > 0){
      while($rows = mysqli_fetch_array($result)){ ?>

<a class="hr" href="Serv_crud.php?crud=<?php echo $rows['Service_Id'];  ?>">
            <div class="card">  
            <img class="card_img" src="images/<?php echo $rows['Service_Pic']; ?>" alt="تبيض اسنان">
              <div class="card-content">
                    <h3 style="color:white;">
                   <?php echo $rows['Service_Name'];?>
                    </h3>
                </div>
            </div>
        </a>
        
    <?php }
    }else {
      echo "ليس هناك خدمات  ! ";
    }

    ?>

    </div>
</div>



</body>
</html>