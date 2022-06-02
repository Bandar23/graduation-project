<?php 

session_start(); 

if(!isset($_SESSION["Admin_Name"])){
  header("location:/graduationProject/login.php");
  exit;
}

?>

<div id="nav2">


    <a href="LogOutAdmin.php"><button class="button2" type="button">تسجيل الخروج</button></a> 
    <a href="Adds.php"><button class="button2" type="button"> إضافة إعلان</button></a> 
    <a href="Service_New.php"><button class="button2" type="button"> إضافة خدمة جديدة</button></a> 
    <a href="see_comp_and_sugg.php"><button class="button2" type="button">الشكاوي و الاقترحات</button></a>
    <a href="info_management.php"><button class="button2" type="button">ادارة المعلومات</button></a>
    <a href="main_page.php"><button class="button2" type="button">الصفحة الرئيسية</button></a>

    <a href="">
        
        <div id="user-div"> 
            <p class="text-right" id="user-name"><?php echo $_SESSION["Admin_Name"] ?></p>    
            <img id="user-icon" src="../user_icon.png">
              
        </div>
    </a>
</div>