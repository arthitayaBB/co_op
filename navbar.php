<img src="images/header.png" style="width: 100%;">

<header class="site-header sticky-top py-1" style="background-color: #f8f9fa;">
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <!-- Hamburger Button for Small Screens -->
            <button class="navbar-toggler d-md-none fixed-top" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation" style="z-index: 1050; top: 10px; left: 10px; position: absolute;" id="hamburgerBtn">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar for Large Screens -->
            <div class="d-none d-md-flex w-100 justify-content-between">
                <a class="btn position-relative" href="index.php" aria-label="home">
                    <i class="bi bi-house" style="font-size: 25px;"></i>
                </a>
                <a class="btn position-relative" href="register.php">สมัครสหกิจศึกษา</a>

                <div class="dropdown">
                    <a class="btn position-relative" href="#" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        เกี่ยวกับสหกิจศึกษา
                        <i class="bi bi-chevron-down ms-1"></i>
                    </a>
                    <ul class="dropdown-menu text-small shadow" style="min-width: 100%; width: max-content;">
                    <li><a class="dropdown-item" href="about_cooperative.php">บทบาทและขั้นตอน</a></li>
                        <li><a class="dropdown-item" href="about_story.php">ความเป็นมาสหกิจศึกษา</a></li>
                        <li><a class="dropdown-item" href="about_company.php">สถานประกอบการ</a></li>
                        <li><a class="dropdown-item" href="about_teacher.php">อาจารย์ที่ปรึกษา</a></li>
                        <li><a class="dropdown-item" href="about_student.php">บทบาทของนิสิต</a></li>


                    </ul>
                </div>



                <div class="dropdown">
                    <a class="btn position-relative" href="#" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        ข่าวประกาศประชาสัมพันธ์
                        <i class="bi bi-chevron-down ms-1"></i>
                    </a>
                    <ul class="dropdown-menu text-small shadow">
                        <li><a class="dropdown-item" href="public_relations.php">กิจกรรมสหกิจศึกษา</a></li>
                        <li><a class="dropdown-item" href="news.php">ข่าวประชาสัมพันธ์</a></li>
                    </ul>
                </div>
                <a class="btn position-relative" href="company.php">สถานประกอบการ</a>
                <a class="btn position-relative" href="student_work.php">ผลงานนิสิต</a>
                <a class="btn position-relative" href="contact.php">ติดต่อสอบถาม</a>
                <div class="dropdown">
                    <a class="btn position-relative" href="#" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle" style="font-size: 25px;"></i>
                        <i class="bi bi-chevron-down ms-1"></i>
                    </a>
                    <ul class="dropdown-menu text-small shadow dropdown-menu-end" style="width: max-content; max-width: 100vw; overflow-x: auto;">
                        <?php if (isset($_SESSION['Std_id'])): ?>
                            <li><a class="dropdown-item" href="std_home.php"><span>หน้าหลัก</span></a></li>
                            <li><a class="dropdown-item" href="std_profile.php?id=<?php echo $_SESSION['Std_id']; ?>"><span>ตั้งค่าบัญชี</span></a></li>
                            <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout_std.php"><span>ออกจากระบบ</span></a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item text-wrap" href="login_student.php">สำหรับนิสิต</a></li>
                            <li><a class="dropdown-item text-wrap" href="approval_system/login.php">สำหรับอาจารย์</a></li>
                            <li><a class="dropdown-item text-wrap" href="BackEnd/login.php">สำหรับแอดมิน</a></li>
                        <?php endif; ?>
                    </ul>
                </div>



            </div>

            <!-- Sidebar for Small Screens -->
            <div class="collapse d-md-none" id="sidebarMenu">
                <div class="d-flex flex-column bg-light p-3" style="min-width: 250px; height: 100vh;">
                    <!-- Close Button (X) -->
                    <button class="btn btn-close align-self-end" id="closeMenu" aria-label="Close menu"></button> <!-- ปุ่มกากบาท -->
                    <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none" href="#">
                        <i class="bi bi-house me-2" style="font-size: 20px;"></i>
                        <span class="fs-4">เมนู</span>
                    </a>

                    <hr>

                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link link-dark" aria-current="page">
                                <i class="bi bi-house-door me-2"></i>
                                หน้าแรก
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="register.php" class="nav-link link-dark">
                                <i class="bi bi-journal-check me-2"></i>
                                สมัครสหกิจศึกษา
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-dark d-flex justify-content-between align-items-center" href="#" onclick="toggleMenu('coopMenu')">
                                <span><i class="bi bi-info-circle me-2"></i> เกี่ยวกับสหกิจศึกษา</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="nav flex-column ms-5 " id="coopMenu" style="display: none;">
                            <li><a class="dropdown-item" href="about_cooperative.php"><i class="bi-journal-check me-2"></i>บทบาทและขั้นตอน</a></li>
                                <li><a class="dropdown-item" href="about_story.php"><i class="bi bi-book me-2"></i>ความเป็นมาสหกิจศึกษา</a></li>
                                <li><a class="dropdown-item" href="about_company.php"><i class="bi bi-building me-2"></i>บทบาทสถานประกอบการ</a></li>
                                <li><a class="dropdown-item" href="about_teacher.php"><i class="bi bi-person-badge me-2"></i>อาจารย์ที่ปรึกษา</a></li>
                                <li><a class="dropdown-item" href="about_student.php"><i class="bi bi-people me-2"></i>บทบาทนิสิต</a></li>
                           
                               
                            </ul>

                        </li>


                        <li class="nav-item">
                            <a class="nav-link link-dark d-flex justify-content-between align-items-center" href="#" onclick="toggleMenu('activityMenu')">
                                <i class="bi bi-megaphone me-2"></i> ข่าวกิจกรรมสหกิจศึกษา <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="nav flex-column ms-5" id="activityMenu" style="display: none;">
                                <li><a class="dropdown-item" href="public_relations.php"><i class="bi-person-check me-2"></i>กิจกรรมสหกิจศึกษา
                                    </a></li>
                                <li><a class="dropdown-item" href="news.php"><i class="bi bi-newspaper me-2"></i>ข่าวประชาสัมพันธ์
                                    </a></li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="company.php" class="nav-link link-dark">
                                <i class="bi bi-building me-2"></i>
                                สถานประกอบการ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="student_work.php" class="nav-link link-dark">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                ผลงานนิสิต
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="contact.php" class="nav-link link-dark">
                                <i class="bi bi-envelope me-2"></i>
                                ติดต่อสอบถาม
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link-dark d-flex align-items-center gap-2" href="#" onclick="toggleMenu('login', event)">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <span>เข้าสู่ระบบ</span>
                                <i class="bi bi-chevron-down ms-auto"></i>
                            </a>
                        </li>

                        <ul class="nav flex-column ms-5" id="login" style="display: none;">
                            <?php if (isset($_SESSION['Std_id'])): ?>
                                <li><a class="dropdown-item" href="std_home.php"><i class="bi bi-person-circle me-2"></i>หน้าหลัก</a></li>
                                <li><a class="dropdown-item" href="c-update.php?cid=<?php echo $_SESSION['Std_id']; ?>"><i class="bi bi-gear me-2"></i> ตั้งค่าบัญชี</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="logout_std.php"><i class="bi bi-box-arrow-right me-2"></i> ออกจากระบบ</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="login_student.php"><i class="bi bi-mortarboard me-2"></i> สำหรับนิสิต</a></li>
                                <li><a class="dropdown-item" href="approval_system/login.php"><i class="bi bi-person-badge me-2"></i> สำหรับอาจารย์</a></li>
                                <li><a class="dropdown-item" href="BackEnd/login.php"><i class="bi bi-shield-lock me-2"></i> สำหรับแอดมิน</a></li>
                            <?php endif; ?>
                        </ul>



                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // การเปิดเมนู
    const navbarToggler = document.querySelector('#hamburgerBtn');
    const sidebarMenu = document.querySelector('#sidebarMenu');
    const closeMenuBtn = document.querySelector('#closeMenu');

    // เมื่อคลิกที่ปุ่มแฮมเบอร์เกอร์จะทำการเปิดเมนู
    navbarToggler.addEventListener('click', function() {
        sidebarMenu.classList.add('show'); // เปิดเมนู
        navbarToggler.style.display = 'none'; // ซ่อนปุ่มแฮมเบอร์เกอร์
    });

    // เมื่อคลิกที่ปุ่มกากบาทจะทำการปิดเมนู
    closeMenuBtn.addEventListener('click', function() {
        sidebarMenu.classList.remove('show'); // ปิดเมนู
        navbarToggler.style.display = 'block'; // แสดงปุ่มแฮมเบอร์เกอร์อีกครั้ง
    });

    function toggleMenu(menuId) {
        var menu = document.getElementById(menuId);
        // Toggle the display property to show or hide
        if (menu.style.display === "none" || menu.style.display === "") {
            menu.style.display = "block";
        } else {
            menu.style.display = "none";
        }
    }
</script>
