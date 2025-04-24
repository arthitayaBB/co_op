<?php
include_once("connectdb.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดผลงานนิสิต</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css"> <!-- เรียกใช้ไฟล์ CSS ที่แยกออกมา -->
</head>

<body>


    <?php include("navbar.php"); ?> <!-- เรียกใช้ navbar ที่แยกออกมา -->

    <?php
    // ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
    $work_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    $sql = "
    SELECT sw.*, s.Std_name, s.Std_surname, m.Major_name, c.NamecomTH
    FROM student_work sw
    INNER JOIN student s ON sw.Std_id = s.Std_id
    INNER JOIN major m ON s.Major_id = m.Major_id
    INNER JOIN company c ON sw.Company_id = c.Company_id 
    WHERE sw.Work_id = $work_id
";

    $result = mysqli_query($conn, $sql);
    $work = mysqli_fetch_assoc($result);
    ?>

    <div class="container mt-5 fade-in">
        <div class="card shadow-lg border-0 position-relative">
            <div class="row g-0 d-flex align-items-center">
                <!-- รูปภาพด้านซ้าย -->
                <div class="col-md-6 d-flex ">
                    <?php if (!empty($work['Work_picture'])): ?>
                        <img src="images/pic_stdwork/<?= htmlspecialchars($work['Work_picture']) ?>"
                            alt="รูปผลงาน"
                            class="img-fluid w-100"
                            style="aspect-ratio: 16/9; border-radius: 21px; margin-left: 20px;">
                    <?php endif; ?>
                </div>


                <!-- ข้อมูลด้านขวา -->
                <div class="col-md-6">
                    <div class="card-body p-4 ">
                        <!-- ขยับตัวหนังสือไปทางขวา -->
                        <h1 class="card-title" style="color: #003366;"><?= htmlspecialchars($work['Work_name']) ?></h1>
                        <p style="margin-left: 20px;"><strong>รายละเอียด:</strong> <?= nl2br(htmlspecialchars($work['Work_detail'])) ?></p>
                        <p style="margin-left: 20px;"><strong>บริษัท:</strong> <?= nl2br(htmlspecialchars($work['NamecomTH'])) ?></p>
                        <p style="margin-left: 20px;"><strong>นิสิต:</strong> <?= htmlspecialchars($work['Std_name'] . ' ' . $work['Std_surname']) ?></p>
                        <p style="margin-left: 20px;"><strong>สาขา:</strong> <?= htmlspecialchars($work['Major_name']) ?></p>

                        <p style="margin-left: 20px;"><strong>วันที่:</strong> <?= htmlspecialchars($work['Date']) ?></p>
                        <p style="margin-left: 20px;"><strong>ปี:</strong> <?= htmlspecialchars($work['Work_year']) ?></p>

                        <?php if (!empty($work['Work_File'])): ?>
                            <p class="text-end">
                                <a href="uploads/std_workfile/<?= htmlspecialchars($work['Work_File']) ?>" target="_blank" class="btn btn-outline-secondary mt-3">
                                    คลิกเพื่อเปิดไฟล์
                                </a>
                            </p>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="mt-3 d-flex justify-content-end">
            <a href="index.php" class="btn btn-outline-secondary me-2">
                <i class="bi bi-house me-2" style="vertical-align: middle;"></i> หน้าหลัก
            </a>
            <a href="student_work.php" class="btn btn-outline-secondary">
                <i class="bi bi-collection me-2" style="vertical-align: middle;"></i> ผลงานทั้งหมด
            </a>
        </div>
    </div>

    <?php include_once("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script> <!-- ควบคุม navbar และ fade-in -->
</body>

</html>