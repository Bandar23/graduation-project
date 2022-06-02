<?php 

session_start();

require_once 'Config.php';

if(isset($_SESSION["Full_Name"])){

    $Patine_Name = $_SESSION["Full_Name"];
    
    
    $Sql_Bills_Patine = "SELECT * FROM bills WHERE Patine_Name = '".$Patine_Name."' ";
    $Result_Bills     = mysqli_query($link,$Sql_Bills_Patine);

    $Price_Appointment = 10;
    $Detection         = 50;
    $Totol  =0; 
    $num = mysqli_num_rows($Result_Bills);
    $not_found ="";

    
    
    
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="./style.css">
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

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6;
}

/* Let's make sure all tables have defaults */
table td {
    vertical-align: top;
}

/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
body {
    background-color: #f6f6f6;
}

.body-wrap {
    background-color: #f6f6f6;
    width: 100%;
}

.container {
    display: block !important;
    max-width: 900px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
}

.content {
    max-width: 800px;
    margin: 0 auto;
    display: block;
    padding: 20px;
}

/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
.main {
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;
}

.content-wrap {
    padding: 20px;
}

.content-block {
    padding: 0 0 20px;
}

.header {
    width: 100%;
    margin-bottom: 20px;
}

.footer {
    width: 100%;
    clear: both;
    color: #999;
    padding: 20px;
}
.footer a {
    color: #999;
}
.footer p, .footer a, .footer unsubscribe, .footer td {
    font-size: 12px;
}

/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
    font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    color: #000;
    margin: 40px 0 0;
    line-height: 1.2;
    font-weight: 400;
}

h1 {
    font-size: 32px;
    font-weight: 500;
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 18px;
}

h4 {
    font-size: 14px;
    font-weight: 600;
}

p, ul, ol {
    margin-bottom: 10px;
    font-weight: normal;
}
p li, ul li, ol li {
    margin-left: 5px;
    list-style-position: inside;
}

/* -------------------------------------
    LINKS & BUTTONS
------------------------------------- */
a {
    color: #1ab394;
    text-decoration: underline;
}

.btn-primary {
    text-decoration: none;
    color: #FFF;
    background-color: #1ab394;
    border: solid #1ab394;
    border-width: 5px 10px;
    line-height: 2;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    border-radius: 5px;
    text-transform: capitalize;
}

/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
.last {
    margin-bottom: 0;
}

.first {
    margin-top: 0;
}

.aligncenter {
    text-align: center;
}

.alignright {
    text-align: right;
}

.alignleft {
    text-align: left;
}

.clear {
    clear: both;
}

/* -------------------------------------
    ALERTS
    Change the class depending on warning email, good email or bad email
------------------------------------- */
.alert {
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    padding: 20px;
    text-align: center;
    border-radius: 3px 3px 0 0;
}
.alert a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}
.alert.alert-warning {
    background: #f8ac59;
}
.alert.alert-bad {
    background: #ed5565;
}
.alert.alert-good {
    background: #1ab394;
}

/* -------------------------------------
    INVOICE
    Styles for the billing table
------------------------------------- */
.invoice {
    margin: 40px auto;
    text-align: left;
    width: 80%;
}
.invoice td {
    padding: 5px 0;
}
.invoice .invoice-items {
    width: 100%;
}
.invoice .invoice-items td {
    border-top: #eee 1px solid;
}
.invoice .invoice-items .total td {
    border-top: 2px solid #333;
    border-bottom: 2px solid #333;
    font-weight: 700;
}

/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
@media only screen and (max-width: 640px) {
    h1, h2, h3, h4 {
        font-weight: 600 !important;
        margin: 20px 0 5px !important;
    }

    h1 {
        font-size: 22px !important;
    }

    h2 {
        font-size: 18px !important;
    }

    h3 {
        font-size: 16px !important;
    }

    .container {
        width: 100% !important;
    }

    .content, .content-wrap {
        padding: 10px !important;
    }

    .invoice {
        width: 100% !important;
    }
}
    </style>
</head>
<body>

<?php 
    include("./header.php");
    include("./logedin_nav.php");
?>

<div id="content-area">
    <div id="content_">
    
        <div id="contenr-p">
            <div id="profile-menu">
                <div id="p-img-name">
                    <img id="profile-img" src="./user_icon.png">
                    <p id="user-name"><?php echo $_SESSION["Full_Name"];?></p>

                </div>
                <a href="profile.php" class="p-menu">الملف الشخصي</a>
                <a href="User_Appointment.php" class="p-menu">المواعيد</a>
                <a href="UserBills.php" class="p-menu">الفواتير</a>
                <a href="User_Reports.php" class="p-menu">التقارير الطبيية</a>
                <a href="CS.php" class="p-menu">تقديم شكاوي و اقترحات</a>
            </div>

            <div id="profile-content">
            <?php  
            if($num > 0){
            while($row = mysqli_fetch_array($Result_Bills)){ ?>
                <table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block">
                                        <h2 style="color:blue;">عيادة الأمل لطب الأسنان </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody><tr>
                                                <td><b><?php echo $row['Patine_Name'];?></b> <br>Invoice #<?php echo $row['Bill_Id'];?><br><?php echo $row['Release_Date_Time'];?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody><tr>
                                                            <td>رسوم الحجز</td>
                                                            <td class="alignright"><?php echo $Price_Appointment?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>رسوم الكشف العام </td>
                                                            <td class="alignright"><?php echo $Detection; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $row['Service_Name'];?></td>
                                                            <td class="alignright"><?php echo $row['Bill_Price'];?> </td>
                                                        </tr>
                                                        <tr class="total">
                                                            <td class="alignright" width="80%">المبلغ الأجمالي</td>
                                                            <td class="alignright"><?php echo $Totol = $Price_Appointment + $Detection + $row['Bill_Price']; ?></td>
                                                        </tr>
                                                        
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                
                              
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                </div>
        </td>
        <td></td>
    </tr>
</tbody>
</table>
<?php } 

            }else{
                $not_found =  "لا يوجد لديك فواتير حالياً";

            } ?>
            <center><br/><br/>
            <?php echo $not_found; ?>
        </center>
            </div>
        </div>
        </div>
        
    </div>
</div>
<?php 
    include("./footer.php");  
?>
    
</body>
</html>

<?php } else {
      header("location:login.php");
      exit;
}
