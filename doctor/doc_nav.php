<?php 
  
  start
?>
<div id="nav2">



<a href="LogOutDoctor.php"><button class="button2" type="button">  تسجيل الخروج </button></a>
    <a href="complaints_and_suggestions.php"><button class="button2" type="button">انشاء الشكاوي و الاقترحات</button></a>
    <a href="reports.php"><button class="button2" type="button">عرض تقرير</button></a>
    <a href="appointements.php"><button class="button2" type="button">المواعيد</button></a>
    <a href="main_page.php"><button class="button2" type="button">الصفحة الرئيسية</button></a>
    <a href="Atte_Abese.php"><button class="button2" type="button">تسجيل الحضور و الغياب و الإنصراف </button></a>


    <a href="">
        
        <div id="user-div">
        <p class="text-right" id="user-name"> <?php echo htmlspecialchars($_SESSION["Emp_Name"]); ?></p>
            <span style="display:inline-block;color:white;font-size:1vw;outline:none;">أهلاً بك دكتور </span>
            <img id="user-icon" src="../user_icon.png">
              
        </div>
    </a>
</div>