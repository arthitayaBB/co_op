<?php
include_once("connectdb.php");
session_start();

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ความเป็นมาสหกิจศึกษา</title>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;700&display=swap" rel="stylesheet">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body >
    <?php include("navbar.php"); ?>
    <section class="faq-section ">
        <div class="container">
            <div class="row">


                <div class="container text-center fade-in">
                    <h1 class="fade-in minimal-heading">ความเป็นมาสหกิจศึกษา</h1>
                </div>

                <div class="clearfix"></div>

                <div class="col-lg-5 col-12">
                    <img src="images/design/background.svg" class="img-fluid slide-in-left" alt="FAQs">
                </div>

                <div class="col-lg-6 col-12 m-auto fade-in">
                    <div class="accordion shadow-sm rounded-3" id="accordionExample">

                        <!-- หลักการและเหตุผล -->
                        <div class="accordion-item border-0 rounded-3 fade-in">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed fw-bold rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    🎯 หลักการและเหตุผล
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body rounded-3">
                                    🏫 มหาวิทยาลัยมหาสารคาม ได้ให้ความสำคัญกับการมีประสบการณ์นอกสถานศึกษา...
                                    โดยได้บรรจุรายวิชาสหกิจศึกษาไว้ในหลักสูตร จำนวน <strong>9 หน่วยกิต</strong>
                                    เพื่อให้นิสิตปฏิบัติงานเต็มเวลา ณ สถานประกอบการ
                                </div>
                            </div>
                        </div>

                        <!-- วัตถุประสงค์ -->
                        <div class="accordion-item border-0 rounded-3 fade-in">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed fw-bold rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    💡 วัตถุประสงค์
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body rounded-3">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item border-0"><i class="bi bi-check-circle text-success me-2"></i> เพิ่มประสบการณ์ทางด้านอาชีพให้แก่นิสิต</li>
                                        <li class="list-group-item border-0"><i class="bi bi-check-circle text-success me-2"></i> พัฒนานิสิตให้มีคุณสมบัติตรงตามความต้องการของสถานประกอบการ</li>
                                        <li class="list-group-item border-0"><i class="bi bi-check-circle text-success me-2"></i> เปิดโอกาสให้หน่วยงานทั้งภาครัฐและเอกชนมีส่วนร่วมในการพัฒนาคุณภาพของนิสิต</li>
                                        <li class="list-group-item border-0"><i class="bi bi-check-circle text-success me-2"></i> ส่งเสริมความสัมพันธ์ระหว่างมหาวิทยาลัยและสถานประกอบการ</li>
                                        <li class="list-group-item border-0"><i class="bi bi-check-circle text-success me-2"></i> พัฒนาหลักสูตรการเรียนการสอนให้ทันสมัยอยู่เสมอ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- หน่วยงานและบุคลากรที่รับผิดชอบ -->
                        <div class="accordion-item border-0 rounded-3 fade-in">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed fw-bold rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    🏢 หน่วยงานและบุคลากรที่รับผิดชอบ
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body rounded-3">
                                    📌 มหาวิทยาลัยมหาสารคามได้จัดตั้งหน่วยงานสหกิจศึกษาเพื่อพัฒนาระบบการศึกษาสหกิจให้เหมาะสมและประสานงานระหว่างนิสิตคณาจารย์และสถานประกอบการ
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <?php include("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script><!-- ควบคุม navbar และ fade-in -->
</body>

</html>