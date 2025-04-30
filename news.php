<?php
include_once("connectdb.php");

// กำหนดค่าการแบ่งหน้า
$limit = 5; // จำนวนข่าวต่อหน้า
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// ดึงข้อมูลข่าวตามหน้าปัจจุบัน
$sql2 = "SELECT * FROM news WHERE N_status = 1  ORDER BY N_date DESC LIMIT $start, $limit";

$rs2 = mysqli_query($conn, $sql2);

// นับจำนวนข่าวทั้งหมด
$total_sql = "SELECT COUNT(*) FROM news";
$total_rs = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_array($total_rs)[0];
$total_pages = ceil($total_row / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวประกาศสหกิจศึกษา</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .animate-arrow {
        display: inline-block;
        font-size: 0.95rem;
        animation: moveRight 1s infinite alternate ease-in-out;
    }
    @keyframes moveRight {
        0% { transform: translateX(0); }
        100% { transform: translateX(10px); }
    }
    .news-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }
    .text {
    background-color: #0056b3; /* สีน้ำเงิน */
    color: white;
  
}
.text:hover{
    background-color: #ffc107 !important; /* สีเหลือง */
    color: black !important;
}
</style>
<body>
<?php include("navbar.php"); ?>

<div class="container text-center fade-in">
    <h1 class="fade-in minimal-heading">ข่าวประกาศประชาสัมพันธ์</h1>
</div>

<div class="container">
    <?php
    $i = 0;
    while ($data2 = mysqli_fetch_assoc($rs2)) {
        $bgClass = ($i % 2 == 0) ? 'bg-white' : 'bg-light';
    ?>
    <div class="col-12 news-item shadow-sm fade-in   <?= $bgClass ?>">
        <a href="detail_news.php?id=<?= htmlspecialchars($data2['N_id']) ?>" 
             class="fade-in news-link d-flex justify-content-between align-items-center text-dark text-decoration-none">
            <div class="d-flex ">
                <img src="images/news/<?= htmlspecialchars($data2['N_picture']) ?>" alt="news-image" class="news-image me-3">
                <div>
                    <p class="news-title"><?= htmlspecialchars($data2['N_heading']) ?> </p>
                    <p class="news-detail"><?= htmlspecialchars(mb_substr($data2['N_detail'], 0, 200, 'UTF-8')) ?>...</p> 
                    <p class="news-date "><i class="bi bi-calendar2-week"></i> <?= htmlspecialchars($data2['N_date']) ?></p>
                </div>
            </div><i class="bi bi-chevron-double-right animate-arrow"></i>

        </a>
    </div>

    <?php $i++; }
    ?>

<!-- ระบบแบ่งหน้า -->
<div class="pagination d-flex justify-content-center my-4 fade-in">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>" class="btn text me-2">« ก่อนหน้า</a>
    <?php endif; ?>

    <?php
    $visible_pages = 3; // จำนวนหน้าที่จะแสดงรอบ ๆ หน้า current
    $ellipsis_added = false;

    for ($p = 1; $p <= $total_pages; $p++):
        if (
            $p == 1 || // หน้าแรก
            $p == $total_pages || // หน้าสุดท้าย
            abs($p - $page) < $visible_pages // รอบ ๆ หน้าปัจจุบัน
        ) :
    ?>
            <a href="?page=<?= $p ?>" class="btn <?= $p == $page ? 'btn btn-warning' : 'btn btn-outline-warning' ?> me-2">
                <?= $p ?>
            </a>
    <?php
            $ellipsis_added = false;
        elseif (!$ellipsis_added):
            echo '<span class="mx-2">...</span>';
            $ellipsis_added = true;
        endif;
    endfor;
    ?>

    <?php if ($page < $total_pages): ?>
        <a href="?page=<?= $page + 1 ?>" class="btn text">ถัดไป »</a>
    <?php endif; ?>
</div>


    
</div>

<?php include("footer.php"); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="script.js"></script>
</body>
</html>
