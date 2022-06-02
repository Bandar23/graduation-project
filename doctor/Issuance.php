<?php 

session_start(); 

if(!isset($_SESSION["Emp_Name"])){
  header("location: login.php");
  exit;
}

$Done="";
$Bill_Id = $S_Name = $S_Price = $P_Name = $Bill_Date = "";


if(isset($_GET["Issu"]) && !empty(trim($_GET["Issu"]))){

    
    require_once 'Config.php';

    $Sql_Appointment = "SELECT a.Apoointment_Id,d.Employee_Full_Name,s.Service_id,s.Service_Name,s.Service_Price,a.Patine_Name
    FROM apoointments a 
    INNER JOIN employees d ON a.Doctor_Id =  d.Employee_Id
    INNER JOIN services s  ON a.Service_id = s.Service_id 
    WHERE a.Apoointment_Id = ? ";

    if($stmt = mysqli_prepare($link,$Sql_Appointment)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = trim($_GET["Issu"]);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            
            $Doctor_Name   = $row['Employee_Full_Name'];
            $Service_id    = $row['Service_id'];
            $Service_Name  = $row['Service_Name'];
            $Service_Price = $row['Service_Price'];
            $patine_Name   = $row['Patine_Name'];
            $Releas_Time   = date("Y-m-d H:i:s");


            $Sql_Bill_Done = "SELECT count(*) FROM bills WHERE Apoointment_Id = $param_id";
            $Check = mysqli_query($link,$Sql_Bill_Done);
            $Result_Done = mysqli_fetch_array($Check);
            $Result = $Result_Done['0'];
            if($Result > 0 ){
                
                $Done = "تم إصدار الفاتورة سابقاً";

                $Query_Bill  = "SELECT * FROM bills WHERE Apoointment_Id = $param_id ";
                $Bill_Result = mysqli_query($link,$Query_Bill);
                $Bill_Row  = mysqli_fetch_array($Bill_Result);
                
                $Bill_Id     = $Bill_Row['Bill_Id'];
                $S_Name      = $Bill_Row['Service_Name'];
                $S_Price     = $Bill_Row['Bill_Price'];
                $P_Name      = $Bill_Row['Patine_Name'];
                $Bill_Date   = $Bill_Row['Release_Date_Time'];
            }else {
          
            $Insert_Bills = "INSERT INTO bills(Service_Id,Service_Name,Doctor_Name,Bill_Price,Release_Date_Time,Patine_Name,Apoointment_Id)
             VALUES ($Service_id,'$Service_Name','$Doctor_Name',$Service_Price,'$Releas_Time','$patine_Name',$param_id)";
             $Result_Bills = mysqli_query($link,$Insert_Bills);

             $Query_Bill  = "SELECT * FROM bills WHERE Apoointment_Id = $param_id ";
             $Bill_Result = mysqli_query($link,$Query_Bill);
             $Bill_Row  = mysqli_fetch_array($Bill_Result);
             
             $Bill_Id     = $Bill_Row['Bill_Id'];
             $S_Name      = $Bill_Row['Service_Name'];
             $S_Price     = $Bill_Row['Bill_Price'];
             $P_Name      = $Bill_Row['Patine_Name'];
             $Bill_Date   = $Bill_Row['Release_Date_Time'];

            }
        }else {
            echo "There Is SomeThing Wrong ! ";
            echo "Something's wrong with the query: " . mysqli_error($link);

        }

    }else{
        echo "Oops! Something went wrong. Please try again later.";
    }
    mysqli_stmt_close($stmt);

}
/*
   <?php 
       echo "<h1>".$Done."</h1>"."<br>";
 echo $param_id."<br>";
 echo $Doctor_Name."<br>";
 echo $Service_id."<br>";
 echo $Service_Name."<br>";
 echo $Service_Price."<br>";
 echo $patine_Name."<br>";

 $date = date('Y-m-d H:i:s');
 echo $date;








?>*/

$Detection = 50;
$Price_Appointment = 10 ;
$Totol = $Service_Price + $Detection + $Price_Appointment;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  إصدار الفاتورة</title>
    <link rel="stylesheet" href="../style.css">
    <style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
    </style>
</head>
<body class="body2">

<?php 
    include("doc_nav.php");
?>

<div id="content-area2">
    <div id="content_2">
    <div class="container">
    <center>
    <?php  echo "<h3 style='color:red;'>".$Done."</h3>"; ?>
    </center>
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>فاتورة</h2>                
                <h3 class="pull-right">رقم الفاتورة <?php echo $Bill_Id;?> </h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong> :الفاتورة إلى </strong><br>
    				 <?php  echo $P_Name ?><br>
    				</address>
    			</div>
                <div class="col-xs-6 text-right">
    				<address>
    					<strong>تاريخ إصدار الفاتورة </strong><br>
    					<?php echo $Bill_Date?> <br><br>
    				</address>
    			</div>
    		</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong> ملخص الفاتورة</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td><strong>الخدمة</strong></td>
        							<td class="text-center"><strong>السعر</strong></td>
        							<td class="text-right"><strong>المجموع</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <tr>
    								<td> رسوم حجز الموعد </td>
    								<td class="text-center"><?php echo $Price_Appointment.' ريال';?></td>
    								<td class="text-right"></td>
    							</tr>
                                <tr>
    								<td>  الكشف العام  </td>
    								<td class="text-center"><?php echo $Detection.' ريال';?></td>
    								<td class="text-right"></td>
    							</tr>
    							<tr>
    								<td><?php echo $S_Name?></td>
    								<td class="text-center"><?php echo $S_Price.' ريال';?></td>
                                    <td class="text-right"><?php echo $Totol.' ريال';?></td>

    							</tr>
                                
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>


    </div>
</div>
</body>
</html>