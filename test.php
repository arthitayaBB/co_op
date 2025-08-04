<?php
//include_once("checklogin.php");
session_start();
$Std_id = $_SESSION['Std_id']; // ดึงค่า id จากเซสชัน
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สำหรับนิสิตฝึกสหกิจศึกษา</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<style>
    /* ทำให้ Card มีขนาดเท่ากัน */
    .card {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 300px; /* กำหนดความสูงขั้นต่ำของการ์ด */
        transition: transform 0.3s ease; /* ทำให้การซูมราบรื่น */
    }

    .card-body {
        flex-grow: 1; /* ขยายให้ card-body เท่ากัน */
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* กระจายเนื้อหาภายใน */
    }

    .card img {
        object-fit: cover; /* ทำให้ภาพไม่บิดเบี้ยว */
    }

    /* เมื่อเมาส์ชี้การ์ดจะขยายขนาด */
    .card:hover {
        transform: scale(1.1); /* ขยายการ์ดเมื่อเมาส์ชี้ */
    }
</style>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <div class="row gx-4 align-items-stretch">
            <div class="col d-flex justify-content-center ">
                <a href="proposal.php?id=<?= $Std_id ?>" class="text-decoration-none">
                    <div class="card text-center" style="width: 18rem;">
                        <img id="imgBefore"
                            src="images/design/std_home101.png"
                            class="card-img-top"
                            alt="ก่อนฝึก"
                            onmouseover="changeImage('imgBefore', 'images/design/std_home102.png')"
                            onmouseout="changeImage('imgBefore', 'images/design/std_home101.png')">
                        <div class="card-body">
                            <h5 class="card-title">ก่อนฝึกสหกิจศึกษา</h5>
                            <ul class="card-text">
                                <li>ขออนุมัติฝึกสหกิจศึกษา</li>
                                <li>ตรวจสอบสถานะการอนุมัติ</li>
                                <li>เลือกสถานประกอบการ</li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col d-flex justify-content-center">
                <a href="after.php?id=<?= $Std_id ?>" class="text-decoration-none">
                    <div class="card text-center" style="width: 18rem;">
                        <img id="imgAfter"
                            src="images/design/std_home201.png"
                            class="card-img-top"
                            alt="หลังฝึก"
                            onmouseover="changeImage('imgAfter', 'images/design/std_home202.png')"
                            onmouseout="changeImage('imgAfter', 'images/design/std_home201.png')">
                        <div class="card-body">
                            <h5 class="card-title">หลังฝึกสหิจศึกษา</h5>
                            <ul class="card-text">
                                <li>ยื่นโปรเจ็คสหกิจ</li>
                                <li>คำแนะนำสู่รุ่นน้อง</li>
                            </ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <script>
        function changeImage(imgId, newSrc) {
            document.getElementById(imgId).src = newSrc;
        }
    </script>
</body>

</html>
