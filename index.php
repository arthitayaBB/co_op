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
<style>
    #intro {
        position: fixed;
        inset: 0;
        /* แทน top/left/right/bottom */
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        z-index: 9999;
        padding: 20px;
        text-align: center;
    }

    #intro img {
        width: 100%;
        max-width: 600px;
        /* จำกัดไม่ให้ใหญ่เกินบนหน้าจอใหญ่ */
        height: auto;
        max-height: 60vh;
        /* สูงสุด 60% ของความสูงจอ */
        object-fit: contain;
        animation: fadeIn 1.5s ease-in-out;
    }


    #intro p {
        color: #fff;
        font-size: 1.3em;
        margin: 20px 0;
    }

    #enter-btn {
        padding: 10px 20px;
        font-size: 1em;
        border: none;
        border-radius: 8px;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        transition: background 0.3s ease;
        margin-top: 20px;
        /* <-- เพิ่มตรงนี้เพื่อเว้นห่างจากภาพ */
    }


    #enter-btn:hover {
        background-color: #0056b3;
        /* สีฟ้าเข้มเมื่อ hover */
    }


    @keyframes fadeOut {
        to {
            opacity: 0;
            visibility: hidden;
        }
    }

    @media (max-width: 576px) {
        #intro img {
            max-height: 50vh;
        }

        #enter-btn {
            
            font-size: 1.1em;
            margin-top: 30px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carouselElement = document.querySelector('#workCarousel');


        const carouselInstance = new bootstrap.Carousel(carouselElement, {
            interval: false,
            ride: false,
        });

        let startX = 0;

        carouselElement.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
        });

        carouselElement.addEventListener('touchend', function(e) {
            let endX = e.changedTouches[0].clientX;
            let diffX = startX - endX;

            if (Math.abs(diffX) > 50) {
                if (diffX > 0) {
                    carouselInstance.next();
                } else {
                    carouselInstance.prev();
                }
            }
        });
    });
</script>



<body>

    <?php include("navbar.php"); ?> <!-- เรียกใช้ navbar ที่แยกออกมา -->
    <?php

    $sqlintro = "SELECT * FROM intro WHERE I_status = 1";
    $result = mysqli_query($conn, $sqlintro);
    $intros = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $intros[] = $row;
    }
    ?>
    <!--หน้าตอนรับ -->
    <div id="intro">
        <div id="introCarousel" class="carousel slide" style="width:100%; max-width:600px;" data-bs-ride="carousel">

            <div class="carousel-inner ">
                <?php foreach ($intros as $index => $intro): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <img src="images/intro/<?= htmlspecialchars($intro['I_picture']) ?>" class="d-block mx-auto" style="max-width:90vw; max-height:80vh;" alt="Intro Image">
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- ลูกศรควบคุม -->
            <button class="carousel-control-prev" type="button" data-bs-target="#introCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#introCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <!-- ปุ่มเข้าสู่เว็บไซต์ -->
        <button id="enter-btn" onclick="document.getElementById('intro').style.display='none'">เข้าสู่เว็บไซต์</button>
    </div>


    <!-- Carousel 1: myCarousel -->
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            // ดึงข้อมูลจากตาราง banner ที่ Bn_status = 1 เท่านั้น
            $sql = "SELECT * FROM banner WHERE Bn_status = 1";
            $result = $conn->query($sql);

            // สร้าง carousel item
            if ($result->num_rows > 0) {
                $activeSet = false;
                while ($row = $result->fetch_assoc()) {
                    $activeClass = !$activeSet ? ' active' : '';
                    $activeSet = true;

                    echo '<div class="carousel-item' . $activeClass . '">';
                    echo '<img src="images/banner/' . htmlspecialchars($row["Bn_image"]) . '" class="d-block w-100" alt="Description of image">';
                    echo '</div>';
                }
            } else {
                echo '<div class="carousel-item active">';
                echo '<div class="text-center p-5 bg-secondary text-white">ไม่มีข้อมูลแบนเนอร์ที่ใช้งานอยู่</div>';
                echo '</div>';
            }
            ?>
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
                                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                                        <img src="images/pic_stdwork/<?= htmlspecialchars($data1['Work_picture']) ?>"
                                            alt="รูปผลงาน"
                                            class="img-fluid rounded-end"
                                            style="width: 150px; height: 200px; object-fit: contain;">
                                    </div>
                                </div>
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
            $sql2 = "SELECT * FROM news WHERE N_status = 1 ORDER BY N_date DESC LIMIT $limit";

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
                        <?php if (isset($_SESSION['Std_id'])): ?>
                            <a href="proposal.php" class="link-co">3) ขออนุมัติฝึกสกิจศึกษา</a>
                        <?php else: ?>
                            <a href="login_student.php" class="link-co ">3) ขออนุมัติฝึกสกิจศึกษา (กรุณาเข้าสู่ระบบ)</a>
                        <?php endif; ?>
                        <p class="mb-0">แจ้งความประสงค์เพื่อยื่นฝึกสกิจศึกษาและยื่นโปรเจค</p>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row align-items-center mb-3 fade-in">
                    <div class="col-auto">
                        <i class="bi bi-check-square-fill" style="font-size: 35px; color: #5bc1ac"></i>
                    </div>
                    <div class="col text-start">
                        <?php if (isset($_SESSION['Std_id'])): ?>
                            <a href="project.php" class="link-co">4) ตรวจสอบสถานะ</a>
                        <?php else: ?>
                            <a href="login_student.php" class="link-co ">4) ตรวจสอบสถานะ (กรุณาเข้าสู่ระบบ)</a>
                        <?php endif; ?>
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
            $sql = "SELECT * FROM public_relations WHERE Pr_status = 1 ORDER BY Pr_date DESC LIMIT $limitPr";
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
                            <img src="images/public_relations/<?= htmlspecialchars($data['Pr_picture1']); ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="รูปภาพข่าว">
                            <div class="card-body">
                                <p class="card-text cut-text">
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
    <script>
        const intro = document.getElementById('intro');
        const main = document.getElementById('main');
        const enterBtn = document.getElementById('enter-btn');

        const lastVisit = localStorage.getItem('lastVisit');
        const now = Date.now();
        const oneHour = 60 * 60 * 1000; // 1 ชั่วโมงในหน่วยมิลลิวินาที

        if (lastVisit && now - parseInt(lastVisit) < oneHour) {
            // ถ้ามีเวลาเข้าครั้งก่อนและยังไม่เกิน 1 ชั่วโมง
            intro.style.display = 'none';
            main.style.display = 'block';
        } else {
            // แสดง Intro และรอให้ผู้ใช้กดปุ่ม
            enterBtn.addEventListener('click', () => {
                localStorage.setItem('lastVisit', Date.now().toString());
                intro.style.animation = 'fadeOut 1s forwards';
                setTimeout(() => {
                    intro.style.display = 'none';
                    main.style.display = 'block';
                }, 1000);
            });
        }
    </script>

    <?php include_once("footer.php"); ?>
</body>

</html>