<?php 

session_start(); 

if(!isset($_SESSION["Emp_Name"])){
  header("location: login.php");
  exit;
}

require_once 'Config.php';


$Doctro_Name = $_SESSION["Emp_Name"];

$No_Report ="";

$Query_Appoi = "SELECT * FROM reports WHERE Reporter = '".$Doctro_Name."' ";
 
 $Result_Query = mysqli_query($link,$Query_Appoi);
 $num = mysqli_num_rows($Result_Query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<script>
     $(document).ready(function(){
       $('#search').keyup(function(){
        var input_val =  $('#search').val();
         $.ajax({
             
            url:'search.php?search=' +  input_val,
            beforeSend: function(){
              $('.loding').show();

            },
            success: function(data){
              $('.loding').fadeOut();
              $('#rseult').html(data);
            }
         })
       })
       })
</script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  عرض التقارير  </title>
    <link rel="stylesheet" href="../style.css">
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
input[type=text] {
  width: 130px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
  background-image: url('searchicon.png');
  background-position: 10px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}

input[type=text]:focus {
  width: 30%;
}
        </style>
</head>
<body class="body2">

<?php 
    include("doc_nav.php");
?>

<div id="content-area2">
    <div id="content_2">
   <br/>

    <?php  if($num > 0 ){
     while($row = mysqli_fetch_array($Result_Query)){ ?>
        <div class="Content-Report">
            <h4> رقم التقرير : <?php echo $row['Report_id']; ?> #</h4>
            <h4> رقم الموعد : <?php echo $row['Apoointment_Id']; ?> #</h4><br>
            <center>
            <h4> عنوان التقرير</h4><br>
            <span> (  <?php echo $row['Report_Title']; ?> )</span><br/><br/>
            <p><?php echo $row['Report_Detailse']; ?> </p><br>
            </center>

            <h5 class="doc"><?php echo $row['Reporter']; ?> : الدكتور </h5>
            

            <h5 class="usr"><?php echo $row['Reciver']; ?> : أسم المراجع</h5><br>
     
          </div><br/>
            <?php }
            }else{
                $No_Report =  "لا توجد حالياً تقارير رفعتها";
            } ?>
<center>
            <?php echo "<h3>". $No_Report."</h3>"; ?>
            </center>
       

    </div>
</div>
</body>
</html>