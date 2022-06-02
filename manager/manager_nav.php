

<div id="nav2">

    <a href="LogOutManger.php"><button class="button2" type="button">تسجيل الخروج</button></a>
    <a href="Complaint_to_admin.php"><button class="button2" type="button">انشاء ملاحظة للأدمن</button></a>
    <a href="complaints_and_suggestions.php"><button class="button2" type="button">عرض الشكاوي و الاقترحات</button></a>
    <a href="doctors_and_patines_info.php"><button class="button2" type="button">معلومات المرضى و الدكاترة</button></a>
    <a href="main_page.php"><button class="button2" type="button">الصفحة الرئيسية</button></a>

    <a href="">
        
        <div id="user-div"> 
            <p class="text-right" id="user-name"><?php echo $_SESSION['Mang_Name']; ?></p>    
            <img id="user-icon" src="../user_icon.png">
              
        </div>
    </a>
</div>