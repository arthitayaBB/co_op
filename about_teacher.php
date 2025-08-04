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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    /* Glassmorphism Card */
    .glass-card {
      width: 20rem;
      border-radius: 25px;
      overflow: hidden;
      position: relative;
    }


    /* ปรับสไตล์ของไอคอน */
    .list-group-item {
      font-size: 14px;
      font-weight: 500;
    }

    .card-img-top {
      height: 400px;
      object-fit: cover;
    }
  </style>
</head>

<body>
  <?php include("navbar.php"); ?>

  <div class="container fade-in">
    <main>

      <div class="container marketing fade-in">

        <div class="row featurette fade-in">
          <div class="col-md-8"><br>
            <h2 class="featurette-heading fade-in" style="color: #4B0082;">บทบาทของอาจารย์ที่ปรึกษา</h2>
            <ul>
              <li>พิจารณาคัดเลือกนิสิตเข้าโครงการสหกิจศึกษา และอนุมัติให้นิสิตออกจากสหกิจศึกษา พร้อมรับรองความประพฤติของนิสิตในสังกัด</li>
              <li>ให้คำแนะนำ ปรึกษาการลงทะเบียนรายวิชาสหกิจศึกษา และกิจกรรมสหกิจศึกษาทุกๆ ด้าน</li>
              <li>ประสานงานร่วมกับเจ้าหน้าที่สหกิจศึกษาในการจัดหางานสำหรับนิสิต</li>
              <li>พิจารณางานที่ได้รับการเสนอจากสถานประกอบการ ร่วมกับเจ้าหน้าที่สหกิจศึกษา</li>
              <li>นิเทศงานระหว่างนิสิตปฏิบัติงาน</li>
              <li>ให้คำปรึกษา และแนะนำงาน เกี่ยวกับการทำรายงานสหกิจศึกษา ร่วมประชุมกับนิสิต และพนักงานที่ปรึกษาของสถานประกอบการ</li>
              <li>ประเมินผลนิสิต และรายงานผลสหกิจศึกษา</li>
              <li>ประสานงานให้ความร่วมมือในการจัดกิจกรรมสหกิจศึกษาทุกๆ ด้านกับเจ้าหน้าที่สหกิจศึกษาและหน่วยงานที่เกี่ยวข้อง</li>
            </ul>
          </div>
          <div class="col-md-4">
            <img src="images/design/about_teacher1.png" alt="รูปภาพ" class="img-fluid mx-auto slide-in-right" width="400" height="400">
          </div>


        </div>
    </main>
  </div>
  <hr>
  <div class="container">
    <div class="container text-center fade-in">
      <h1 class="fade-in minimal-heading">รายชื่ออาจารย์ที่ปรึกษา</h1>
    </div>

    <?php
    $sql2 = "SELECT t.*, m.Major_name
   FROM teacher t
   INNER JOIN major m ON t.Major_id = m.Major_id";
    $rs2 = mysqli_query($conn, $sql2);

    ?>


    <div class="container fade-in">
      <div class="row d-flex justify-content-center align-items-center fade-in">
        <?php while ($data2 = mysqli_fetch_assoc($rs2)) { ?>
          <div class="col-12 col-sm-6 col-md-4 mb-4 d-flex justify-content-center">
            <div class="card glass-card shadow-lg border-0 position-relative fade-in">
              <!-- Glow Effect -->
              <div class="glow"></div>

              <!-- รูปอาจารย์ -->
              <img src="BackEnd/img_teacher/<?php echo htmlspecialchars($data2['Tec_picture']); ?>"
                class="card-img-top rounded-top-4 object-fit-cover"
                alt="รูปภาพอาจารย์">

              <div class="card-body text-center">
                <!-- ชื่ออาจารย์ -->
                <h5 class="card-title ">
                  <?php echo $data2['Tec_name'] . ' ' . $data2['Tec_surname']; ?>
                </h5>
                <!-- สาขาวิชา -->
                <p class="card-text text-muted">
                  <i class="fas fa-graduation-cap me-2 text-primary"></i>
                  <?php echo $data2['Major_name']; ?>
                </p>
                <!-- Email -->
                <p class="card-text text-muted">
                  <i class="fas fa-envelope me-2 text-danger"></i>
                  <?php echo $data2['Tec_email']; ?>
                </p>
                <!-- Phone -->
                <p class="card-text text-muted">
                  <i class="fas fa-phone me-2 text-success"></i>
                  <?php echo $data2['Tec_phone']; ?>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <?php include("footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>

</html>