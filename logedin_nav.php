<?php 

if(!isset($_SESSION["Full_Name"])){
    header("location: login.php");
    exit;
}


$Patine_Name  = $_SESSION["Full_Name"];


?>

<div id="nav">
<a href="UserLogOut.php"><button class="button" type="button">تسجيل الخروج</button></a> 
    <a href="join_us.php"><button class="button" type="button">انظم الينا</button></a>
    <a href="about_us.php"><button class="button" type="button">من نحن</button></a>
    <a href="contact_us.php"><button class="button" type="button">راسلنا</button></a>
    <a href="services.php"><button class="button" type="button">الخدمات</button></a>

    <span id="gap"></span>
    <a href="appointment.php"><button class="button" type="button">حجز موعد</button></a>
    <a href="">
        
        <div id="main-user-div">               
            <a href="profile.php">
            <p class="text-right" id="main-user-name"><?php echo $Patine_Name;?> أهلاً </p>    
            <img id="user-icon" src="user_icon.png">
            </a>
              
        </div>
    </a>
</div>