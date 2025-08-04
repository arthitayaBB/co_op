<!-- Font Awesome (ไอคอน) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<footer class="footer mt-5 py-5 bg-light border-top shadow-sm">
    <div class="container">
        <div class="row text-center text-md-start align-items-start">

            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold mb-3 text-uppercase">ติดต่อเรา</h6>
                <p class="mb-2"><i class="fas fa-phone-alt me-2 text-blue"></i> +123 456 7890</p>
                <p class="mb-0"><i class="fas fa-envelope me-2 text-blue"></i> example@example.com</p>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold mb-3 text-uppercase ">เมนูด่วน</h6>
                <ul class="list-unstyled">
                    <li><a href="index.php" class="footer-link d-block py-1">หน้าแรก</a></li>
                    <li><a href="register.php" class="footer-link d-block py-1">สมัครสหกิจศึกษา</a></li>
                    <li><a href="about_cooperative.php" class="footer-link d-block py-1">บทบาทและขั้นตอน</a></li>
                    <li><a href="about_story.php" class="footer-link d-block py-1">ความเป็นมา</a></li>
                    <li><a href="about_company.php" class="footer-link d-block py-1">บทบาทสถานประกอบการ</a></li>
                    <li><a href="about_teacher.php" class="footer-link d-block py-1">อาจารย์ที่ปรึกษา</a></li>
                    <li><a href="about_student.php" class="footer-link d-block py-1">บทบาทนิสิต</a></li>
                    <li><a href="public_relations.php" class="footer-link d-block py-1">กิจกรรมสหกิจศึกษา</a></li>
                    <li><a href="news.php" class="footer-link d-block py-1">ข่าวประชาสัมพันธ์</a></li>
                    <li><a href="company.php" class="footer-link d-block py-1">สถานประกอบการ</a></li>
                    <li><a href="student_work.php" class="footer-link d-block py-1">ผลงานนิสิต</a></li>
                    <li><a href="#" class="footer-link d-block py-1">ติดต่อสอบถาม</a></li>
                </ul>
            </div>

            <!-- Login Section -->
            <div class="col-md-4 mb-4">
                <h6 class="fw-bold mb-3 text-uppercase">เข้าสู่ระบบ</h6>
                <ul class="list-unstyled">
                    <li><a href="login_student.php" class="footer-link d-block py-1"><i class="fas fa-user-graduate me-2 text-blue"></i> สำหรับนิสิต</a></li>
                    <li><a href="approval_system/login.php" class="footer-link d-block py-1"><i class="fas fa-chalkboard-teacher me-2 text-blue"></i> สำหรับอาจารย์</a></li>
                    <li><a href="BackEnd/login.php" class="footer-link d-block py-1"><i class="fas fa-user-cog me-2 text-blue"></i> สำหรับแอดมิน</a></li>
                </ul>
            </div>

        </div>

        <div class="text-center pt-3 border-top mt-3 text-muted small">
            © 2025 Your Website Name. All rights reserved.
        </div>
    </div>
</footer>

<!-- Custom Styles -->
<style>
    .text-blue {
        color: #000033;
    }

    .footer-link {
        color: #000033;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }

    .footer-link:hover {
        text-decoration: underline;
        color: #084298;
    }

    .footer h6 {
        color: #000033;
    }

    @media (min-width: 768px) {
        .footer .col-md-4 {
            min-height: 220px; /* ทำให้ความสูงใกล้เคียงกัน */
        }
    }
</style>
