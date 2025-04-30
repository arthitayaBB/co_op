<?php
include_once("connectdb.php");
session_start();

// กำหนดค่าการแบ่งหน้า
$limit = 9; // จำนวนข่าวต่อหน้า
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// รับค่าจาก GET (หากไม่มีให้กำหนดเป็นค่าว่าง)
$kw = isset($_GET['kw']) ? mysqli_real_escape_string($conn, $_GET['kw']) : '';
$pr = isset($_GET['pr']) ? mysqli_real_escape_string($conn, $_GET['pr']) : '';
$year = isset($_GET['year']) ? mysqli_real_escape_string($conn, $_GET['year']) : '';

// เงื่อนไขกรองสาขา (Major)
$filter_major = (!empty($pr) && $pr !== "all") ? "AND m.Major_id = '$pr'" : "";

// เงื่อนไขกรองปีการศึกษา (Academic Year)
$filter_year = (!empty($year) && $year !== "all") ? "AND pr.Pr_year = '$year'" : "";


// ดึงข้อมูลข่าวตามหน้าปัจจุบัน (เฉพาะ Pr_status = 1)
$sql = "
    SELECT pr.*, m.M_sub
    FROM public_relations pr
    INNER JOIN company c ON pr.Company_id = c.Company_id
    INNER JOIN major m ON c.Major_id = m.Major_id
    WHERE pr.Pr_detail LIKE '%$kw%' 
        $filter_major 
        $filter_year 
        AND pr.Pr_status = 1
    ORDER BY pr.Pr_date DESC
    LIMIT $start, $limit
";

$rs = mysqli_query($conn, $sql);

// นับจำนวนข่าวทั้งหมด (เฉพาะ Pr_status = 1)
$total_sql = "
    SELECT COUNT(*)
    FROM public_relations pr
    INNER JOIN company c ON pr.Company_id = c.Company_id
    INNER JOIN major m ON c.Major_id = m.Major_id
    WHERE pr.Pr_detail LIKE '%$kw%' 
        $filter_major 
        $filter_year 
        AND pr.Pr_status = 1
";

$total_rs = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_array($total_rs)[0];
$total_pages = ceil($total_row / $limit);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข่าวกิจกรรมสหกิจศึกษา</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    .text {
        background-color: #0056b3;
        color: white;
    }

    .text:hover {
        background-color: #ffc107 !important;
        color: black !important;
    }

    .custom-dropdown {
        background-color: #0056b3;
        color: white;
        border-color: #004080;
    }

    .custom-dropdown:hover,
    .custom-dropdown:focus,
    .custom-dropdown.show {
        background-color: #ffc107 !important;
        color: black !important;
    }
</style>

<body>

    <?php include("navbar.php"); ?>

    <div class="container text-center fade-in">
        <h1 class="fade-in minimal-heading">ข่าวกิจกรรมสหกิจศึกษา</h1>
        <div class="container d-flex justify-content-between">
            <!-- แถวของ Dropdown และ Form ค้นหา -->
            <div class="col-md-6 d-flex">
                <form method="GET" action="public_relations.php" class="d-flex flex-row align-items-center">
                    <!-- ตัวเลือกการกรอง -->
                    <label for="category" class="me-2">สาขา:</label>
                    <select name="pr" id="category" class="form-select me-3">
                        <option value="">ทั้งหมด</option>
                        <?php
                        // เชื่อมต่อฐานข้อมูล
                        $sql3 = "SELECT * FROM major";
                        $rs3 = mysqli_query($conn, $sql3);

                        // ตรวจสอบผลลัพธ์
                        if (mysqli_num_rows($rs3) > 0) {
                            // แสดงตัวเลือกสาขาจากฐานข้อมูล
                            while ($data3 = mysqli_fetch_array($rs3, MYSQLI_BOTH)) {
                                $selected = ($data3['Major_id'] == $pr) ? 'selected' : '';
                                echo "<option value='{$data3['Major_id']}' $selected>{$data3['Major_name']}</option>";
                            }
                        } else {
                            // กรณีไม่มีข้อมูลในฐานข้อมูล
                            echo "<option value='#'>ไม่มีสาขา</option>";
                        }
                        ?>
                    </select>

                    <!-- ตัวเลือกปี -->
                    <label for="year" class="me-2">ปี:</label>
                    <select name="year" id="year" class="form-select me-3">
                        <option value="">ทั้งหมด</option>
                        <?php
                        $sql_year = "SELECT DISTINCT Pr_year FROM public_relations ORDER BY Pr_year DESC";
                        $rs_year = mysqli_query($conn, $sql_year);
                        if (mysqli_num_rows($rs_year) > 0) {
                            while ($year_data = mysqli_fetch_array($rs_year, MYSQLI_BOTH)) {
                                $selected_year = ($year_data['Pr_year'] == $year) ? 'selected' : '';
                                echo "<option value='{$year_data['Pr_year']}' $selected_year>{$year_data['Pr_year']}</option>";
                            }
                        } else {
                            echo "<option value='#'>ไม่มีข้อมูลปี</option>";
                        }
                        ?>
                    </select>

                    <button type="submit" class="btn btn-outline-info">ค้นหา</button>
                </form>
            </div>

            <!-- ฟอร์มค้นหา -->
            <div class="col-md-5">
                <form method="GET" action="public_relations.php" class="d-flex">
                    <input name="kw" type="text" class="form-control" placeholder="ค้นหา..." aria-label="Search">
                </form>
            </div>
        </div>



        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 justify-content-center fade-in">
                <?php if (mysqli_num_rows($rs) > 0): ?>
                    <?php while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) { ?>
                        <div class="col">
                            <a href="detail_pr.php?id=<?= $data['Pr_id']; ?>" class="text-decoration-none">
                                <div class="card shadow-sm fade-in move">
                                    <!-- รูปภาพข่าว -->
                                    <img src="images/public_relations/<?= htmlspecialchars($data['Pr_picture1']); ?>" class="bd-placeholder-img card-img-top" width="100%" height="225" alt="รูปภาพข่าว">

                                    <div class="card-body">
                                        <!-- รายละเอียดข่าว (ตัด 2 บรรทัด) -->
                                        <p class="card-text" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">
                                            <?= htmlspecialchars($data['Pr_detail']); ?>
                                        </p>
                                        <div class="d-flex">
                                            <small class="text-body-secondary">#<?= htmlspecialchars($data['M_sub']); ?></small>
                                            <!-- วันที่ของข่าว -->
                                            <small class="text-body-secondary ms-auto"> <?= htmlspecialchars($data['Pr_date']); ?> </small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php } ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info" role="alert"><i class="bi bi-exclamation-circle"></i>
                            ไม่พบข้อมูลที่ตรงกับคำค้นหาของคุณ
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

       <!-- ระบบแบ่งหน้า -->
<div class="pagination d-flex justify-content-center my-4 fade-in">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&kw=<?= urlencode($kw) ?>&pr=<?= $pr ?>" class="btn text me-2">« ก่อนหน้า</a>
    <?php endif; ?>

    <?php
    $visible_pages = 1; // จำนวนหน้ารอบๆ ปัจจุบันที่จะแสดง
    $ellipsis_added = false;

    for ($p = 1; $p <= $total_pages; $p++):
        if (
            $p == 1 || 
            $p == $total_pages || 
            abs($p - $page) <= $visible_pages
        ) :
    ?>
        <a href="?page=<?= $p ?>&kw=<?= urlencode($kw) ?>&pr=<?= $pr ?>" class="btn <?= $p == $page ? 'btn btn-warning' : 'btn btn-outline-warning' ?> me-2">
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
        <a href="?page=<?= $page + 1 ?>&kw=<?= urlencode($kw) ?>&pr=<?= $pr ?>" class="btn text">ถัดไป »</a>
    <?php endif; ?>
</div>



    </div>

    <?php include("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>

</html>