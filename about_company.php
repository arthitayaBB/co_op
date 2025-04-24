<?php
include_once("connectdb.php");
session_start();

?>

<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>บทบาทของสถานประกอบการในสหกิจศึกษา</title>
  <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
  <link rel="icon" href="images/Logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="style.css">

</head>


<body>
  <?php include("navbar.php"); ?>
  <div class="container text-center fade-in">
    <h1 class="fade-in minimal-heading">บทบาทของสถานประกอบการในสหกิจศึกษา</h1>
    <p class="text-dark fade-in">
      คณะการบัญชีและการจัดการให้ความสำคัญกับการพัฒนานิสิตผ่านสหกิจศึกษา โดยเน้นความร่วมมือกับสถานประกอบการเพื่อสร้างประสบการณ์จริง ซึ่งบทบาทสำคัญของสถานประกอบการมีดังนี้
    </p>
  </div>

  <main>

    <div class="container marketing fade-in">

      <div class="row featurette fade-in">
        <div class="col-md-7"><br>
          <h2 class="featurette-heading fade-in">1. ฝ่ายบุคคลหรือฝ่ายบริหารทรัพยากรมนุษย์</h2>
          <ul class="mb-4 fade-in">

            <li class="list-group-item">🔹 ประสานงานการรับนิสิตเข้าปฏิบัติงาน</li>
            <li class="list-group-item">🔹 ให้คำแนะนำเกี่ยวกับแนวทางสหกิจศึกษาแก่ผู้บริหารและนิสิต</li>
            <li class="list-group-item">🔹 ให้คำปรึกษาเรื่องระเบียบวินัย เช่น เวลาทำงาน การลางาน การแต่งกาย</li>
            <li class="list-group-item">🔹 จัดการปฐมนิเทศเพื่อช่วยนิสิตปรับตัว เช่น แนะนำที่พักที่ปลอดภัยและเส้นทางการเดินทาง</li>
          </ul>
        </div>
        <div class="col-md-5">
          <img src="images/design/about_company1.svg" alt="รูปภาพ" class="img-fluid mx-auto slide-in-right" width="500" height="500">
        </div>


      </div>


      <hr class="container marketing fade-in">

      <div class="row featurette fade-in">
        <div class="col-md-7 order-md-2">
          <h2 class="featurette-heading fade-in ">2. พนักงานที่ปรึกษา (Job Supervisor)</h2>
          <ul class="mb-4 fade-in ">
            <li class="list-group-item">🔹 ดูแลและให้คำปรึกษาแก่นิสิตตลอดระยะเวลา 16 สัปดาห์</li>
            <li class="list-group-item">🔹 ทำหน้าที่เสมือนอาจารย์ผู้ควบคุมนิสิตในสถานประกอบการ</li>
            <li class="list-group-item">🔹 กำหนดลักษณะงาน (Job Description) และแผนงานการปฏิบัติงาน</li>
            <li class="list-group-item">🔹 สนับสนุนให้นิสิตได้รับประสบการณ์การทำงานจริง และพัฒนาทักษะที่จำเป็น</li>
          </ul>
        </div>
        <div class="col-md-5 order-md-1">
          <img src="images/design/about_company2.svg" alt="รูปภาพ" class="img-fluid mx-auto slide-in-left" width="500" height="500">
        </div>
      </div>







    </div><!-- /.container -->


  </main>

  <?php include("footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>


</body>

</html>