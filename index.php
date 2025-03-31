<?php
include_once("connectdb.php");
session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าหลัก</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css"> <!-- เรียกใช้ไฟล์ CSS ที่แยกออกมา -->

</head>

<body>

    <?php include("navbar.php"); ?> <!-- เรียกใช้ navbar ที่แยกออกมา -->


    <!-- Carousel 1: myCarousel -->
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/Bn1.png" class="d-block w-100" alt="Description of image 1">
            </div>
            <div class="carousel-item">
                <img src="images/Bn2.png" class="d-block w-100" alt="Description of image 2">
            </div>
            <div class="carousel-item">
                <img src="images/Bn3.png" class="d-block w-100" alt="Description of image 2">
            </div>
        </div>
        <!-- ปุ่มเลื่อนซ้ายสำหรับ myCarousel -->
        <button class="carousel-control-prev " type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <!-- ปุ่มเลื่อนขวาสำหรับ myCarousel -->
        <button class="carousel-control-next " type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <br>

    <?php
    $sql1 = "
        SELECT sw.*, s.Std_name, s.Std_surname, m.Major_name
        FROM student_work sw
        INNER JOIN student s ON sw.Std_id = s.Std_id
        INNER JOIN major m ON s.Major_id = m.Major_id
        ORDER BY sw.Date DESC";
    $rs1 = mysqli_query($conn, $sql1);

    if (!$rs1) {
        die("Query failed: " . mysqli_error($conn));
    }

    // เก็บข้อมูลทั้งหมดใน array
    $works = [];
    while ($row = mysqli_fetch_array($rs1, MYSQLI_BOTH)) {
        $works[] = $row;
    }
    ?>

    <!-- Carousel 2: workCarousel -->

    <div id="workCarousel" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner fade-in">
            <a href="detail_stdwork.php?id=<?= $work['Work_id']; ?>" class="text-decoration-none text-dark">
                <?php foreach (array_chunk($works, 2) as $index => $workPair): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="d-flex justify-content-center">
                            <?php foreach ($workPair as $data1): ?>
                                <div class="card mx-2 shadow-sm move" style="max-width: 45rem; width: 100%;">
                                    <div class="row g-0">
                                        <div class="col-md-8 d-flex flex-column p-3">
                                            <a href="detail_stdwork.php?id=<?= $data1['Work_id']; ?>" class="text-decoration-none text-dark">
                                                <!-- หัวข้อ: ตัด 1 บรรทัด -->
                                                <h5 class="card-title text-truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    <?= htmlspecialchars($data1['Work_name']) ?>
                                                </h5>
                                            </a>
                                            <!-- สาขา-->
                                            <p class="card-text text-muted"><?= htmlspecialchars($data1['Major_name']) ?></p>
                                            <!-- รายละเอียด: ตัด 2 บรรทัด -->
                                            <p class="cut-text">
                                                <?= htmlspecialchars($data1['Work_detail']) ?>
                                            </p>

                                            <a href="detail_stdwork.php?id=<?= $data1['Work_id']; ?>" class="stretched-link">อ่านต่อ</a>
                                        </div>
                                        <!-- รูปภาพ -->
                                        <div class="col-md-4 d-flex align-items-center">
                                            <img src="images/<?= htmlspecialchars($data1['Work_picture']) ?>" alt="รูปผลงาน" class="img-fluid rounded-end" style="height: 100%; object-fit: contain;">
                                        </div>

                                    </div>
            </a>
        </div>
    <?php endforeach; ?>
    </div>
    </div>
<?php endforeach; ?>
</div>

<!-- ปุ่มเลื่อนซ้ายสำหรับ workCarousel -->
<button class="carousel-control-prev" type="button" data-bs-target="#workCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
</button>
<!-- ปุ่มเลื่อนขวาสำหรับ workCarousel -->
<button class="carousel-control-next" type="button" data-bs-target="#workCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
</button>
</div>


<div class="col-12 text-end mt-3">
    <a href="student_work.php" class="link-co fade-in">ดูผลงานทั้งหมด</a>
</div>


<div class="row"><!-- คอลัมน์ข่าวประกาศประชาสัมพันธ์ -->
    <div class="col-md-8 fade-in" style="padding-right: 10px; padding-left: 10px;">
        <h5 class="custom-heading">ข่าวประกาศประชาสัมพันธ์</h5>


        <?php
        //ดึงข้อมูลข่าว
        $limit = 4; // จำนวนข่าวที่ต้องการแสดง
        $sql2 = "SELECT * FROM news ORDER BY N_date DESC LIMIT $limit";
        $rs2 = mysqli_query($conn, $sql2);
        $i = 0; // ตัวนับ

        while ($data2 = mysqli_fetch_assoc($rs2)) {
            $bgClass = ($i % 2 == 0) ? 'bg-light' : 'bg-white'; // สลับสีพื้นหลัง
        ?>

            <div class="col-12 news-item shadow-sm fade-in <?= $bgClass ?>">
                <a href="detail_news.php?id=<?= htmlspecialchars($data2['N_id']) ?>"
                    class="fade-in news-link d-flex justify-content-between align-items-center text-dark text-decoration-none">
                    <div>
                        <p class="news-title"><?= htmlspecialchars($data2['N_heading']) ?></p>
                        <p class="news-detail"><?= htmlspecialchars(mb_substr($data2['N_detail'], 0, 200, 'UTF-8')) ?>...</p>
                        <p class="news-date "><i class="bi bi-calendar2-week"></i> <?= htmlspecialchars($data2['N_date']) ?></p>
                    </div>
                </a>
            </div>

        <?php
            $i++; // เพิ่มตัวนับ
        }
        ?>

        <!-- ลิงก์ไปหน้าข่าวทั้งหมด -->
        <div class="col-12 text-end mt-3">
            <a href="news.php" class="link-co fade-in">ข่าวทั้งหมด</a>
        </div>
    </div>

    <!-- คอลัมน์ขั้นตอนการยื่นสหกิจศึกษา -->
    <div class="col-md-4 fade-in" style="padding-right: 10px; padding-left: 10px;">
        <h2 class="text-center" style="color: #000033;">ขั้นตอนการยื่นสหกิจศึกษา</h2>

        <div class="container">
            <!-- Row 1 -->
            <div class="row align-items-center mb-3 fade-in">
                <div class="col-auto">
                    <i class="bi bi-person-check-fill" style="font-size: 35px; color: #5bc1ac;"></i>
                </div>
                <div class="col text-start">
                    <a href="login_student.php" class="link-co">1) เข้าสู่ระบบ / ลงทะเบียนใหม่</a>
                    <p class="mb-0">Login เข้าสู่ระบบ หรือ ลงทะเบียนใหม่</p>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row align-items-center mb-3 fade-in">
                <div class="col-auto">
                    <i class="bi bi-search" style="font-size: 35px; color: #5bc1ac;"></i>
                </div>
                <div class="col text-start">
                    <a href="company.php" class="link-co">2) ค้นหาสถานประกอบการ</a>
                    <p class="mb-0">ค้นหาข้อมูลสถานที่ฝึกสหกิจแยกตามภาคและจังหวัด</p>
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row align-items-center mb-3 fade-in">
                <div class="col-auto">
                    <i class="bi bi-file-text-fill" style="font-size: 35px; color: #5bc1ac;"></i>
                </div>
                <div class="col text-start">
                    <a href="#" class="link-co">3) ขออนุมัติฝึกสกิจศึกษา</a>
                    <p class="mb-0">แจ้งความประสงค์เพื่อยื่นฝึกสกิจศึกษาและยื่นโปรเจค</p>
                </div>
            </div>

            <!-- Row 4 -->
            <div class="row align-items-center mb-3 fade-in">
                <div class="col-auto">
                    <i class="bi bi-check-square-fill" style="font-size: 35px; color: #5bc1ac"></i>
                </div>
                <div class="col text-start">
                    <a href="#" class="link-co">4) ตรวจสอบสถานะ</a>
                    <p class="mb-0">สามารถตรวจสอบสถานะการอนุมัติได้</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center  fade-in ">
        <div class="section-title ">
            <h1>MBS</h1>
            <div class="title-underline"></div>
            <div class="subtitle">highlight</div>
        </div>


        <?php
        $limitPr = 6;
        $sql = "SELECT * FROM public_relations ORDER BY Pr_date DESC LIMIT $limitPr";
        $rs = mysqli_query($conn, $sql);

        if (!$rs) {
            die("Query failed: " . mysqli_error($conn));
        }

        echo '<div class="container mt-4">';
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center fade-in">';

        $i = 0;

        while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
        ?>

            <div class="col">
                <a href="detail_pr.php?id=<?= $data['Pr_id']; ?>" class="text-decoration-none">
                    <div class="card shadow-sm fade-in move">
                        <img src="images/<?= htmlspecialchars($data['Pr_picture1']); ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="รูปภาพข่าว">
                        <div class="card-body">
                            <p class="card-text cut-text" >
                                <?= htmlspecialchars($data['Pr_detail']); ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-body-secondary ms-auto"> <?= htmlspecialchars($data['Pr_date']); ?> </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        <?php
        }
        ?>
    </div>
</div>
<!-- ลิงก์ไปหน้าข่าวทั้งหมด -->
<div class="col-12 text-end mt-3">
    <a href="public_relations.php" class="link-co fade-in">อ่านทั้งหมด</a>
</div>
</div>
</div>









<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script><!-- ควบคุม navbar และ fade-in -->

<footer class="footer mt-5 py-4 fade-in" style="background-color: #f8f9fa;">
    <div class="container text-center">
        <!-- ข้อมูลติดต่อ -->
        <div class="contact-info">
            <p><strong>Contact Us</strong></p>
            <p>Phone: +123 456 7890</p>
            <p>Email: example@example.com</p>
        </div>

        <!-- ลิงก์ไปยังหน้าต่างต่างๆ -->
        <div class="footer-links">
            <p><a href="about.html" class=" text-decoration-none">About Us</a></p>
            <p><a href="services.html" class=" text-decoration-none">Services</a></p>
            <p><a href="privacy.html" class=" text-decoration-none">Privacy Policy</a></p>
        </div>

        <!-- ข้อความลิขสิทธิ์ -->
        <p class="mt-3">© 2025 Your Company. All Rights Reserved.</p>
    </div>
</footer>
</body>

</html>