<?php

session_start();

if(isset($_SESSION["Full_Name"])){ ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include("header.php");
    include("logedin_nav.php");
   // include("ads.php"); 
?>

<div id="content-area">
    <div id="content_">
        <div class="text-right centre">
        <h1 id="h1">من نحن</h1>
        <pre id="par">عيادة طبية متكاملة تحاكي رؤيتنا ورؤية حكومتنا بالحفاظ على صحتك ورعايتها .
. تُعتبر من  العيادات  الطبية الرائدة في المملكة التي 
تقدم خدمات الرعاية الصحية عبر عدد من 
التخصصات الطبية المتنوعة بشكل مميز ومتكامل.

الرؤية 

تطمح عيادة أسناني  أن تكون الوجهة الأولى التي تقدم رعاية وبيئة صحية بشكل فريد
 ومتكامل من خلال فريق طبي ذو كفاءة عالية من مختلف دول العالم مستخدمين أحدث التقنيات
 وأخر ماتوصلت إليه العلوم في عالم الطب.
الاهداف 

1-تقديم خدمات رعاية ميسورة التكلفة وموجهة نحو خدمة المريض بكل المقاييس.

2- توفير تجربة متميزة للمرضى مختلفة عن الخدمات الطبية التي يتم توفيرها في أي مجمع طبي خاص.

3-تقديم المستوى الأمثل للخدمات الطبية بحيث تصبح العيادة نموذجًا متميزًا يحتذي به.

</pre>
        </div>
        <br>
        <br>
        <br>
    </div>
</div>
<?php 
    include("footer.php");  
?>
    
</body>
</html>
<?php }else{ ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php 
    include("header.php");
    include("nav.php");
    include("ads.php"); 
?>

<div id="content-area">
    <div id="content_">
        <div class="text-right centre">
        <h1 id="h1">من نحن</h1>
        <pre id="par">عيادة طبية متكاملة تحاكي رؤيتنا ورؤية حكومتنا بالحفاظ على صحتك ورعايتها .
. تُعتبر من  العيادات  الطبية الرائدة في المملكة التي 
تقدم خدمات الرعاية الصحية عبر عدد من 
التخصصات الطبية المتنوعة بشكل مميز ومتكامل.

الرؤية 

تطمح عيادة أسناني  أن تكون الوجهة الأولى التي تقدم رعاية وبيئة صحية بشكل فريد
 ومتكامل من خلال فريق طبي ذو كفاءة عالية من مختلف دول العالم مستخدمين أحدث التقنيات
 وأخر ماتوصلت إليه العلوم في عالم الطب.
الاهداف 

1-تقديم خدمات رعاية ميسورة التكلفة وموجهة نحو خدمة المريض بكل المقاييس.

2- توفير تجربة متميزة للمرضى مختلفة عن الخدمات الطبية التي يتم توفيرها في أي مجمع طبي خاص.

3-تقديم المستوى الأمثل للخدمات الطبية بحيث تصبح العيادة نموذجًا متميزًا يحتذي به.

</pre>
        </div>
        <br>
        <br>
        <br>
    </div>
</div>
<?php 
    include("footer.php");  
?>
    
</body>
</html>

<?php } ?>