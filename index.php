<?php

session_start();


if(isset($_SESSION["Full_Name"])){ 
   header("location: index_logedin.php");
   exit(); 


 }elseif(isset($_SESSION["Admin_Name"])){ 
  header("location: /graduationProject2/admin/main_page.php");
  exit(); 
 }else { ?>
  
  <!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الرئيسية</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

<?php 
    include("header.php");
    include("nav.php");
    //include("ads.php"); 
?>

<div id="content-area">
 
    <div id="content_">
<!--    conternt   -->   
    <section id="content">
             <div id="First-Content">
               <centre>
                <h1 id="h1">مرحباً بك في عيادتنا</h1>
                <p id="par">نرحب بكم و نحن نتشرف بخدمتكم , و نطمح لي ان نلبي توقعاتكم. و نشكرك لختيار عيادتنا.<img src="https://img.icons8.com/ios/80/000000/dental-crown.png"/></p>
                  
 
              </centre>
            

             </div>

             <div id="Seconde-Content">
              <centre>
                <h3  id="h1">متوفرين في</h3>
              </centre>
                <div class="Main-Pic">
                 <div class="Pic">
                  <img src="jeddah.jpg" width="344px" height="344px"><br />
                  <div class="Pic-Name">
                    <span>جدة</span>



                 </div>
                </div>
                </div>
                <div class="Main-Pic">
                 <div class="Pic">
                  <img src="riyadh.jpg" width="344px" height="344px"><br>
                  <div class="Pic-Name">
                    <span>الرياض</span>

                 </div>
                </div>
                </div>

              <div class="Main-Pic">
                   <div class="Pic">
                      <img src="12Dammam.jpg" width="344px" height="344px"><br>
                      <div class="Pic-Name">
                         <span>الدمام</span>
                     </div>
                  </div>
               </div>


               <div id="Therd-content"><br>
                   <h2 class="p"style="color: black;"><img src="https://img.icons8.com/material/50/000000/ask-question--v1.png"/></h2>
                      <div class="why"><br><br>
                          <img src="https://img.icons8.com/dotty/50/000000/box-tissue.png"/>
                           <p>إن شاغلنا الأول هو التعقيم</p>
                          <p> التعقيم الكامل واليومي للعيادة</p>
                          <p> التعقيم الكامل للأجهزة الطبية بشكل يومي</p>

                      </div>

                        <div class="why"><br><br>
                            <img src="https://img.icons8.com/ios/50/000000/treatment-plan.png"/><br><br>
                              <p>جميع الخدمات متوفرة</p>
                              <p>الخدمات الجراحية</p>
                              <p>خدمات الفحص الطبي</p>
                              <p>خدمات دقيقة</p>
    
                        </div>

                            <div class="why"><br><br>
                                <img src="https://img.icons8.com/carbon-copy/100/000000/stethoscope.png"/>
                                <p>أطباء بشهادات دولية</p>
                                    <p>أطباء محترفون حاصلون على الاعتماد الدولي</p>
                                    <p>أطباء من كلا الجنسين</p>
                            </div>

                                <div class="why"><br><br>
                                    <img src="https://img.icons8.com/ios/50/000000/scissors.png"/>
                                        <p>الأدوات هي العنصر الأساسي بالنسبة لنا ، حيث أن عيادتنا بها معدات طبية حديثة</p>
                                        <p>أدوات طبية حديثة تفيد المراجعين من حيث طلباتهم</p>
                                        <p>أدوات طب الأسنان الحديثة المختصة</p>
                                        <p>أدوات طبية من شركات طبية دولية معتمدة</p>

            
                                </div>


                        
                        
                    </div>
                      
                  </div>
                    </div>
             </div>
              

               </div>
            </div>
          </section>
          
          <br />
          <br />

    </div>
</div>
<?php 
    include("footer.php");  
?>
<!-- Js File [User Login] -->
</body>
</html>
 <?php } ?> 