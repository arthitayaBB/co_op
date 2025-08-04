<?php
include_once("connectdb.php");
session_start();

$kw = isset($_GET['kw']) ? mysqli_real_escape_string($conn, $_GET['kw']) : '';
$com = isset($_GET['com']) ? mysqli_real_escape_string($conn, $_GET['com']) : '';


$filter_major = (!empty($com) && $com !== "all") ? "AND c.Major_id = '$com'" : "";

// Pagination
$perPage = 21; // แสดงผลต่อหน้า
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;

$start = ($page - 1) * $perPage;

// Query นับจำนวนทั้งหมด
$sql_count = "SELECT COUNT(*) AS total
              FROM company c
              INNER JOIN major m ON c.Major_id = m.Major_id
              WHERE (c.NamecomTH LIKE '%$kw%' OR c.NamecomEng LIKE '%$kw%' OR c.Province LIKE '%$kw%') 
              $filter_major";
$rs_count = mysqli_query($conn, $sql_count);
$totalRow = mysqli_fetch_assoc($rs_count)['total'];
$totalPage = ceil($totalRow / $perPage);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>สถานประกอบการ</title>
  <link rel="icon" href="images/Logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<style>
  .custom-dropdown {
    background-color: #0056b3;
    /* สีน้ำเงิน */
    color: white;
    border-color: #004080;
  }

  .custom-dropdown:hover,
  .custom-dropdown:focus,
  .custom-dropdown.show {
    background-color: #ffc107 !important;
    /* สีเหลือง */
    color: black !important;
  }

</style>

<body>
  <?php include("navbar.php"); ?>


  <div class="container text-center fade-in">
    <div class="section-title ">
      <h1>MBS</h1>
      <div class="title-underline"></div>
      <div class="subtitle">สถานประกอบการ</div>
    </div>
  </div>
  <div class="container fade-in">
    <!-- แถวของ Dropdown และ Form ค้นหา -->
    <div class="row mb-4">
      <div class="col-md-6 ">
        <div class="dropdown ">
          <button class="btn custom-dropdown dropdown-toggle" type="button" data-bs-toggle="dropdown">
            สาขา
          </button>
          <ul class="dropdown-menu ">
            <li><a class="dropdown-item" href="company.php">ทั้งหมด</a></li>
            <?php
            $sql3 = "SELECT * FROM major";
            $rs3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($rs3) > 0) {
              while ($data3 = mysqli_fetch_array($rs3, MYSQLI_BOTH)) {
                echo "<li><a class='dropdown-item' href='company.php?com={$data3['Major_id']}&kw=" . urlencode($kw) . "'>{$data3['Major_name']}</a></li>";
              }
            } else {
              echo "<li><a class='dropdown-item' href='#'>ไม่มีสาขา</a></li>";
            }
            ?>
          </ul>
        </div>
      </div>
      <!--ค้นหา-->
      <div class="col-md-6">
        <form method="GET" action="company.php">
          <input name="kw" type="text" class="form-control" placeholder="ค้นหา..." aria-label="Search">
        </form>
      </div>
    </div>

    <!-- แถวของการ์ดข้อมูลบริษัท -->
    <?php
    // ค้นหาข้อมูล
   $sql2 = "SELECT c.*, m.Major_name
         FROM company c
         INNER JOIN major m ON c.Major_id = m.Major_id
         WHERE (c.NamecomTH LIKE '%$kw%' OR c.NamecomEng LIKE '%$kw%' OR c.Province LIKE '%$kw%') 
         $filter_major
         ORDER BY c.NamecomTH ASC
         LIMIT $start, $perPage";
    $rs2 = mysqli_query($conn, $sql2);

    // ตรวจสอบว่ามีผลลัพธ์หรือไม่
    if (mysqli_num_rows($rs2) == 0) {
      echo '<br><br><br><br>
      <div class="col-12 d-flex justify-content-center">
        <div class="alert alert-info text-center fs-6 btn-sm" role="alert">
          <i class="bi bi-exclamation-circle"></i> ไม่พบข้อมูลที่ตรงกับการค้นหา
        </div>
      </div>
      <br><br><br><br>';
    }
    ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <?php
      while ($data2 = mysqli_fetch_assoc($rs2)) {
      ?>
        <div class="col">
          <a href="detail_company.php?id=<?= htmlspecialchars($data2['Company_id']) ?>" class="news-link text-dark text-decoration-none">
            <div class="card h-100 shadow-sm d-flex flex-column fade-in text-start move">
              <div class="card-body d-flex flex-column w-100">
                <h5 class="card-title">
                  <i class="bi bi-buildings-fill" style="color: #000066;"></i>
                  <?= htmlspecialchars($data2['NamecomTH']); ?>
                </h5>
                <p class="card-text"><?= htmlspecialchars($data2['NamecomEng']) ?></p>

                <div class="mt-auto">
                  <div class="card-footer bg-transparent border-secondary">
                    <p class="card-text">
                      <i class="bi bi-geo-alt-fill"></i>
                      <?= htmlspecialchars($data2['Province']) ?>
                    </p>
                    <p class="card-text">
                      <i class="bi bi-person-badge-fill" style="color: #4527a0;"></i>
                      <?= htmlspecialchars($data2['Major_name']) ?>
                    </p>
                  </div>
                  <a href="detail_company.php?id=<?= htmlspecialchars($data2['Company_id']) ?>" class="btn btn-outline-info w-100 text-center">รายละเอียด</a>
                </div>
              </div>

            </div>
          </a>
        </div>

      <?php } ?>
    </div>
   <!-- ระบบแบ่งหน้า -->
<div class="pagination d-flex justify-content-center my-4 fade-in">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&kw=<?= urlencode($kw) ?>&com=<?= $com ?>" class="btn text me-2">« ก่อนหน้า</a>
    <?php endif; ?>

    <?php
    $visible_pages = 1; // จำนวนหน้ารอบๆ ปัจจุบันที่จะแสดง
    $ellipsis_added = false;

    for ($p = 1; $p <= $totalPage; $p++):
        if (
            $p == 1 || 
            $p == $totalPage || 
            abs($p - $page) <= $visible_pages
        ) :
    ?>
        <a href="?page=<?= $p ?>&kw=<?= urlencode($kw) ?>&com=<?= $com ?>" class="btn <?= $p == $page ? 'btn-warning' : 'btn-outline-warning' ?> me-2">
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

    <?php if ($page < $totalPage): ?>
        <a href="?page=<?= $page + 1 ?>&kw=<?= urlencode($kw) ?>&com=<?= $com ?>" class="btn text">ถัดไป »</a>
    <?php endif; ?>
</div>


  </div>


  <?php include("footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>

</html>
