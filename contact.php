<?php
include_once("connectdb.php");
session_start();

// รับค่าจาก GET (หากไม่มีให้กำหนดเป็นค่าว่าง)
$kw = isset($_GET['kw']) ? mysqli_real_escape_string($conn, $_GET['kw']) : '';
$com = isset($_GET['com']) ? mysqli_real_escape_string($conn, $_GET['com']) : '';

// เงื่อนไขกรองสาขา (Major) ถ้า com ว่าง แสดงทั้งหมด
$filter_major = (!empty($com) && $com !== "all") ? "AND c.Major_id = '$com'" : "";

// ตรวจสอบว่ามีค่า com หรือไม่
$s = !empty($com) ? "AND c.Major_id = '$com'" : "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดต่อสอบถาม</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="style_ss.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>



<body>
    <?php include("navbar.php"); ?>

        <div class="container ">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">

                <div class="contact-info-wrap text-center">
                    <h2 class="mb-4">ติดต่อสอบถาม</h2>

                    <div class="contact-image-wrap d-flex justify-content-center align-items-center fade-in mb-3">
                        <img src="images/design/admin.png" class="img-fluid avatar-image me-3" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="text-start">
                            <p class="mb-0">Clara Barton</p>
                            <p class="mb-0"><strong>administrator</strong></p>
                        </div>
                    </div>

                    <div class="contact-info text-start fade-in">
                        <h5 class="mb-3">Contact Infomation</h5>

                        <p class="d-flex align-items-center mb-2 fade-in"><!--อย่าลืมแก้-->
                            <i class="bi bi-geo-alt me-2"></i>
                            Akershusstranda 20, 0150 Oslo, Norway
                        </p>

                        <p class="d-flex align-items-center mb-2 fade-in">
                            <i class="bi bi-telephone me-2"></i>
                            <a href="tel:1202409600" class="text-decoration-none text-dark">120-240-9600</a><!--อย่าลืมแก้-->
                        </p>

                        <p class="d-flex align-items-center fade-in">
                            <i class="bi bi-envelope me-2"></i>
                            <a href="mailto:donate@charity.org" class="text-decoration-none text-dark">donate@charity.org</a><!--อย่าลืมแก้-->
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
 

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>