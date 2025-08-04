<?php
include_once("connectdb.php");
session_start();

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บทบาทของอาจารย์ที่ปรึกษา</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">

</head>


<body>
    <?php include("navbar.php"); ?>
    <div class="container text-center fade-in">
        <h1 class="fade-in minimal-heading">บทบาทหน้าที่ของนิสิต</h1>
    </div>

    <main>

        <div class="container marketing fade-in">

            <div class="row featurette fade-in">
                <div class="col-md-7"><br>
                    <h2 class="featurette-heading fade-in">คุณสมบัติสหกิจศึกษา</h2>
                    <ul class="mb-4 fade-in">
                        <li class="list-group-item ">🎓 เป็นนิสิตชั้นปีที่ 3 หรือชั้นปีที่ 4</li>
                        <li class="list-group-item ">📈 มีผลการเรียนเฉลี่ยตั้งแต่ 2.00 ขึ้นไป</li>
                        <li class="list-group-item ">✅ เป็นผู้มีความประพฤติเรียบร้อย ไม่เคยผิดระเบียบวินัยนิสิต</li>
                        <li class="list-group-item ">🧠 มีวุฒิภาวะและสามารถพัฒนาตนเองได้ดี</li>
                        <li class="list-group-item ">🎯 มีความรู้ ความสามารถ และคุณสมบัติพิเศษอื่น ๆ ตรงตามลักษณะงานที่สถานประกอบการต้องการ</li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <img src="images/design/about_student1.png" alt="รูปภาพ" class="img-fluid mx-auto slide-in-right" width="500" height="500">
                </div>


            </div>


            <hr class="container marketing fade-in">

            <div class="row featurette fade-in">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fade-in ">หน้าที่ของนิสิตสหกิจศึกษา</h2>
                    <ul class="mb-4 fade-in ">
                        <li class="list-group-item">✍️ ลงทะเบียนเรียนวิชาสหกิจศึกษา (รหัสวิชา 0199499)</li>
                        <li class="list-group-item">🤝 ร่วมกิจกรรมสหกิจศึกษาจัดขึ้น</li>
                        <li class="list-group-item">📑 เขียนใบสมัครงาน เพื่อสมัครเข้าปฏิบัติงาน ณ สถานประกอบการ ในฐานะพนักงานชั่วคราว</li>
                        <li class="list-group-item">📤 จัดส่งเอกสาร รายงานการปฏิบัติงานและแผนการทำงานให้มหาวิทยาลัยทราบ</li>
                        <li class="list-group-item">⚙️ ปฏิบัติงานตามโครงการที่สถานประกอบการมอบหมายภายใต้การดูแลของพนักงานที่ปรึกษา</li>
                        <li class="list-group-item">🎓 รับการนิเทศงานจากอาจารย์นิเทศงาน</li>
                        <li class="list-group-item">📝 รับการประเมินผลการปฏิบัติงานจากพนักงานที่ปรึกษา</li>
                        <li class="list-group-item">🔍 รับการประเมินผลรายงานสหกิจศึกษาจากอาจารย์ที่ปรึกษา</li>
                        <li class="list-group-item">💼 ปฏิบัติงานเสมือนหนึ่งเป็นพนักงานชั่วคราวของสถานประกอบการ</li>
                        <li class="list-group-item">📋 มีหน้าที่รับผิดชอบที่แน่นอน โดยงานที่รับมอบหมายเป็นงานที่มีคุณภาพ</li>
                        <li class="list-group-item">👷‍♂️ ปฏิบัติงานในตำแหน่งผู้ช่วยวิศวกร / ผู้ช่วยนักวิชาการ / ผู้ช่วยงานสารสนเทศ ฯลฯ</li>
                        <li class="list-group-item">⏰ ทำงานเต็มเวลา (Full Time) เป็นเวลา 16 สัปดาห์</li>
                        <li class="list-group-item">💵 มีค่าตอบแทนตามสมควรจากสถานประกอบการ</li>
                    </ul>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="images/design/about_student2.png" alt="รูปภาพ" class="img-fluid mx-auto slide-in-left" width="500" height="500">
                </div>
            </div>


            <hr class="featurette-divider fade-in">

            <div class="row featurette">
                <div class="col-md-7"><br>
                    <h2 class="featurette-heading fade-in">ลักษณะงานของนิสิตสหกิจศึกษา </h2>
                    <ul class="mb-4 fade-in">
                        <li class="list-group-item">🏢 ได้รับประสบการณ์วิชาชีพตามสาขาที่เรียนเพิ่มเติม</li>
                        <li class="list-group-item">🌱 เกิดการเรียนรู้และพัฒนาตนเอง การทำงานร่วมกับผู้อื่น และความมั่นใจในตนเอง</li>
                        <li class="list-group-item">📖 ส่งผลให้ผลการเรียนดีขึ้นจากประสบการณ์จริง</li>
                        <li class="list-group-item">🗣️ พัฒนาทักษะในการสื่อสารข้อมูล (Communication Skills)</li>
                        <li class="list-group-item">🛤️ สามารถเลือกสายอาชีพได้ถูกต้องตามความถนัดของตนเอง</li>
                        <li class="list-group-item">🎯 สำเร็จการศึกษาด้วยศักยภาพที่สูงขึ้น และมีโอกาสได้งานก่อนสำเร็จการศึกษา</li>
                    </ul>
                </div>
                <div class="col-md-5">
                    <img src="images/design/about_student3.png" alt="รูปภาพ" class="img-fluid mx-auto slide-in-right" width="500" height="500">
                </div>


            </div>





        </div><!-- /.container -->


    </main>

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>


</body>

</html>