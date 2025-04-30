<div class="sidebar">
    <a class="ad-name" style="display: block;">
        <i class="fas fa-user-circle"></i> <!-- ไอคอนโปรไฟล์ -->
        <?= $_SESSION['Ad_name']; ?> <?= $_SESSION['Ad_surname']; ?> <!-- แสดงชื่อและนามสกุล -->
    </a>
    <a href="dashboard.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>"><i class="fas fa-chart-line"></i><span> Dashboard</span></a>
    <a href="indexteacher.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexteacher.php') ? 'active' : ''; ?>"><i class="fas fa-chalkboard-teacher"></i><span> ข้อมูลอาจารย์</span></a>
    <a href="indexstudent.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexstudent.php') ? 'active' : ''; ?>"><i class="fas fa-user-graduate"></i><span> ข้อมูลนิสิต</span></a>
    <a href="indexstudentwork.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexstudentwork.php') ? 'active' : ''; ?>"><i class="fas fa-folder"></i><span> ผลงานนิสิต</span></a>
    <a href="indexcompany.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexcompany.php') ? 'active' : ''; ?>"><i class="fas fa-building"></i><span> ข้อมูลสถานประกอบการ</span></a>
    <a href="indexmajor.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexmajor.php') ? 'active' : ''; ?>"><i class="fas fa-sitemap"></i><span> ข้อมูลสาขา</span></a>
    <a href="indexnews.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexnews.php') ? 'active' : ''; ?>"><i class="fas fa-newspaper"></i><span> ข้อมูลข่าวสาร</span></a>
    <a href="indexadmin.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexadmin.php') ? 'active' : ''; ?>"><i class="fas fa-user-cog"></i><span> Admin</span></a>
    <a href="indexactivity.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexactivity.php') ? 'active' : ''; ?>">
        <i class="fas fa-calendar-alt"></i><span> ข่าวกิจกรรมสหกิจศึกษา</span>
    </a>
    <a href="indexbanner.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'indexbanner.php') ? 'active' : ''; ?>"><i class="fas fa-bullhorn"></i><span> Banner</span></a>
    <a href="logout.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'logout.php') ? 'active' : ''; ?>"><i class="fas fa-sign-out-alt"></i><span> ออกจากระบบ</span></a>
</div>