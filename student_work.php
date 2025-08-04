<?php
include_once("connectdb.php");
session_start();

// กำหนดค่าการแบ่งหน้า
$limit = 10; // จำนวนข่าวต่อหน้า
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// ตรวจสอบค่าจากฟอร์ม
$w = isset($_GET['w']) ? $_GET['w'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';

// คำสั่ง SQL สำหรับนับจำนวนข้อมูลทั้งหมด
$sql_count = "SELECT COUNT(*) as total FROM student_work sw
              INNER JOIN student s ON sw.Std_id = s.Std_id
              INNER JOIN major m ON s.Major_id = m.Major_id
              WHERE 1=1";

// เพิ่มเงื่อนไขการกรอง
if ($w) {
    $sql_count .= " AND m.Major_id = '$w'";
}
if ($year) {
    $sql_count .= " AND sw.Work_year = '$year'";
}

// ตรวจสอบคำสั่ง SQL ว่าถูกต้องหรือไม่
// echo $sql_count; // ตรวจสอบ SQL

$rs_count = mysqli_query($conn, $sql_count);
if (!$rs_count) {
    die("Query failed: " . mysqli_error($conn));
}

$total_rows = mysqli_fetch_assoc($rs_count)['total'];
$total_pages = ceil($total_rows / $limit);

// คำสั่ง SQL หลัก สำหรับดึงข้อมูล (เพิ่ม LIMIT และ OFFSET)
$sql1 = "SELECT sw.*, s.Std_name, s.Std_surname, m.Major_name
         FROM student_work sw
         INNER JOIN student s ON sw.Std_id = s.Std_id
         INNER JOIN major m ON s.Major_id = m.Major_id
         WHERE 1=1";

// เพิ่มการกรองตามสาขา (w) และปี (year)
if ($w) {
    $sql1 .= " AND m.Major_id = '$w'";
}
if ($year) {
    $sql1 .= " AND sw.Work_year = '$year'";
}

$sql1 .= " ORDER BY sw.Date DESC LIMIT $limit OFFSET $start"; // เพิ่ม LIMIT และ OFFSET สำหรับการแบ่งหน้า

// ตรวจสอบคำสั่ง SQL
// echo $sql1; // ตรวจสอบ SQL

$rs1 = mysqli_query($conn, $sql1);
if (!$rs1) {
    die("Query failed: " . mysqli_error($conn));
}

$works = mysqli_fetch_all($rs1, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลงานนิสิต</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container text-center fade-in">
        <h1 class="fade-in minimal-heading">ผลงานนิสิต</h1>
    </div>

    <div class="container d-flex justify-content-end">
        <div class="col-md-6 d-flex  fade-in move">
            <form method="GET" action="student_work.php" class="d-flex flex-row align-items-center">
                <label for="category" class="me-2">สาขา:</label>
                <select name="w" id="category" class="form-select me-3">
                    <option value="">ทั้งหมด</option>
                    <?php
                    $sql3 = "SELECT * FROM major";
                    $rs3 = mysqli_query($conn, $sql3);
                    if (mysqli_num_rows($rs3) > 0) {
                        while ($data3 = mysqli_fetch_array($rs3, MYSQLI_BOTH)) {
                            $selected = (isset($_GET['w']) && $_GET['w'] == $data3['Major_id']) ? 'selected' : '';
                            echo "<option value='{$data3['Major_id']}' $selected>{$data3['Major_name']}</option>";
                        }
                    } else {
                        echo "<option value='#'>ไม่มีสาขา</option>";
                    }
                    ?>
                </select>

                <label for="year" class="me-2">ปี:</label>
                <select name="year" id="year" class="form-select me-3">
                    <option value="">ทั้งหมด</option>
                    <?php
                    $sql_year = "SELECT DISTINCT Work_year FROM student_work ORDER BY Work_year DESC";
                    $rs_year = mysqli_query($conn, $sql_year);
                    if (mysqli_num_rows($rs_year) > 0) {
                        while ($year_data = mysqli_fetch_array($rs_year, MYSQLI_BOTH)) {
                            $selected_year = (isset($_GET['year']) && $_GET['year'] == $year_data['Work_year']) ? 'selected' : '';
                            echo "<option value='{$year_data['Work_year']}' $selected_year>{$year_data['Work_year']}</option>";
                        }
                    } else {
                        echo "<option value='#'>ไม่มีข้อมูลปี</option>";
                    }
                    ?>
                </select>

                <button type="submit" class="btn btn-outline-info">ค้นหา</button>
            </form>
        </div>
    </div>

    <br>

    <div class="container-fluid">
        <div class="row">
            <?php
            $bgGradients = [
                'linear-gradient(135deg, #D1F8EF, #BFDBFE)',
                'linear-gradient(135deg, #D2E0FB, #BFDBFE)',
                'linear-gradient(135deg, #DAD2FF, #BFDBFE)'
            ];

            foreach ($works as $index => $work) :
                $bgGradient = $bgGradients[$index % count($bgGradients)];
            ?>
                <div class="col-md-6 mb-4 fade-in move">
                    <a href="detail_stdwork.php?id=<?= $work['Work_id']; ?>" class="text-decoration-none text-dark">
                        <div class="d-flex flex-column justify-content-between pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden"
                            style="background: <?= $bgGradient ?>; color: black; border-radius: 15px; cursor: pointer; height: 100%;">
                            <div class="my-3 py-3" style="min-height: 150px;">
                                <h2 class="display-6 fade-in"
                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                    <?= htmlspecialchars($work['Work_name']) ?>
                                </h2>

                                <p class="lead fade-in text-start text-truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    <?= htmlspecialchars($work['Work_detail']) ?>
                                </p>

                                <p class="card-text fade-in text-end" style="color: black;"> <?= htmlspecialchars($work['Major_name']) ?> </p>
                            </div>
                            <div class="bg-white shadow-sm mx-auto fade-in"
                                style="width: 100%; height: 300px; border-radius: 21px 21px 0 0; overflow: hidden;">
                                <?php if (!empty($work['Work_picture'])) : ?>
                                    <img src="images/pic_stdwork/<?= htmlspecialchars($work['Work_picture']) ?>"
                                        alt="Work Image"
                                        class="img-fluid w-100 h-100"
                                        style="object-fit: cover;">
                                <?php else : ?>
                                    <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                        ไม่มีรูปภาพ
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

   <!-- ระบบแบ่งหน้า -->
<div class="pagination d-flex justify-content-center mt-4 fade-in">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&w=<?= urlencode($w) ?>&year=<?= urlencode($year) ?>" class="btn text me-2">« ก่อนหน้า</a>
    <?php endif; ?>

    <?php
    $visible_pages = 1; // จำนวนหน้ารอบๆ ปัจจุบันที่จะแสดง
    $ellipsis_added = false;

    for ($p = 1; $p <= $total_pages; $p++):
        if (
            $p == 1 || 
            $p == $total_pages || 
            abs($p - $page) <= $visible_pages
        ):
    ?>
        <a href="?page=<?= $p ?>&w=<?= urlencode($w) ?>&year=<?= urlencode($year) ?>"
           class="btn <?= ($p == $page) ? 'btn-warning' : 'btn-outline-warning' ?> me-2">
           <?= $p ?>
        </a>
        <?php $ellipsis_added = false; ?>
    <?php elseif (!$ellipsis_added): ?>
        <span class="mx-2">...</span>
        <?php $ellipsis_added = true; ?>
    <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a href="?page=<?= $page + 1 ?>&w=<?= urlencode($w) ?>&year=<?= urlencode($year) ?>" class="btn text">ถัดไป »</a>
    <?php endif; ?>
</div>


    <?php include("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>