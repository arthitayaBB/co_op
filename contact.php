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

    <section class="contact-section section-padding fade-in">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-12 ms-auto mb-5 mb-lg-0">
                    <div class="contact-info-wrap">
                        <h2>ติดต่อสอบถาม</h2>

                        <div class="contact-image-wrap d-flex flex-wrap fade-in">
                            <img src="images/design/admin.png" class="img-fluid avatar-image" alt="">

                            <div class="d-flex flex-column justify-content-center ms-3">
                                <p class="mb-0">Clara Barton</p>
                                <p class="mb-0"><strong>administrator</strong></p>
                            </div>
                        </div>

                        <div class="contact-info fade-in">
                            <h5 class="mb-3">Contact Infomation</h5>

                            <p class="d-flex mb-2 fade-in">
                                <i class="bi-geo-alt me-2"></i>
                                Akershusstranda 20, 0150 Oslo, Norway
                            </p>

                            <p class="d-flex mb-2 fade-in">
                                <i class="bi-telephone me-2"></i>

                                <a href="tel: 120-240-9600">
                                    120-240-9600
                                </a>
                            </p>

                            <p class="d-flex fade-in">
                                <i class="bi-envelope me-2"></i>

                                <a href="mailto:info@yourgmail.com">
                                    donate@charity.org
                                </a>
                            </p>

                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-12 mx-auto fade-in">
                    <form class="custom-form contact-form" action="#" method="post" role="form">
                        <h2>Contact form</h2>

                        <p class="mb-4">หรือคุณสามารถส่งอีเมล:
                            <a href="#">info@charity.org</a>
                        </p>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 fade-in">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputname" placeholder="ชื่อ" name="name" required>
                                    <label for="floatingInput3">ชื่อ</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12 fade-in">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingInputsurname" placeholder="นามสกุล" name="surname" required>
                                    <label for="floatingInputsurname">นามสกุล</label>
                                </div>
                        
                            </div>
                            <small class="text-muted fade-in">กรุณากรอกอีเมลให้ถูกต้อง เช่น example@email.com</small>
                            <div class="col-12 fade-in">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="floatingEmail" name="email" pattern="[^ @]*@[^ @]*" placeholder="Jackdoe@gmail.com" required>
                                    <label for="floatingEmail">อีเมล</label>
                                </div>
                               
                            </div>

                            <div class="col-12 fade-in">
                                <div class="form-floating">
                                    <textarea class="form-control" id="floatingMessage" name="message" placeholder="What can we help you?" style="height: 150px;"></textarea>
                                    <label for="floatingMessage">ข้อความ</label>
                                </div>
                            </div>



                            <button type="submit" class="form-control fade-in">Send Message</button>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>