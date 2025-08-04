<?php
include_once("connectdb.php");
include("checklogin.php");

$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;

$sql = "
    SELECT 
        std.*, 
        p.Pro_status, 
        p.Com_status,
        c.NamecomTH, 
        c.NamecomEng, 
        c.Company_add, 
        c.Province, 
        c.Com_phone 
    FROM student std
    INNER JOIN proposal p ON std.Std_id = p.Std_id
    LEFT JOIN company c ON p.Company_id = c.Company_id
    WHERE std.Std_id = $Std_id
";

$result = mysqli_query($conn, $sql);
$std = mysqli_fetch_assoc($result);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกสถานประกอบการ</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<style>
  body {
    background-color: #f4f7fa;
    font-family: 'Segoe UI', sans-serif;
    padding-bottom: 80px;
  }

  .mobile-card {
    background-color: #ffffff;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    padding: 16px;
    margin: 16px 0;
    width: 100%; /* ให้เต็มหน้าจอ */
  }

  .mobile-title {
    font-size: 1.3rem;
    font-weight: bold;
    color: #1a237e;
    text-align: center;
    margin-bottom: 20px;
  }

  .info-row {
    display: flex;
    flex-direction: column;
    margin-bottom: 12px;
  }

  .info-label {
    font-weight: bold;
    color: #333;
    margin-bottom: 4px;
  }

  .info-value {
    color: #555;
    text-align: left !important; /* บังคับชิดซ้ายเสมอ */
    word-wrap: break-word;
  }

  .status-label {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 600;
    display: inline-block;
    margin-top: 8px;
  }

  .status-approved {
    background-color: #28a745;
    color: #fff;
  }

  .status-rejected {
    background-color: #dc3545;
    color: #fff;
  }

  .status-modification {
    background-color: #17a2b8;
    color: #fff;
  }

  .status-pending {
    background-color: #ffc107;
    color: #000;
  }

  .status-none {
    background-color: gray;
    color: #fff;
  }

  .note-text {
    color: #dc3545;
    font-size: 0.95rem;
    text-align: center;
    margin-top: 16px;
  }

  .custom-tab {
    flex-grow: 1;
    background-color: #e6f2ff;
    padding: 12px 10px;
    margin: 4px;
    border-radius: 12px;
    text-align: center;
    font-weight: 600;
    color: #0056b3;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .custom-tab.active {
    background-color: #007bff;
    color: #fff;
  }

  @media (min-width: 768px) {
    .info-row {
      flex-direction: row;
      justify-content: flex-start;
      align-items: flex-start;
    }

    .info-label {
      width: 200px;
      text-align: left;
      margin-bottom: 0;
    }

    .info-value {
      flex: 1;
      text-align: left !important;
    }

    .mobile-card {
      padding: 24px;
    }

    .mobile-title {
      font-size: 1.6rem;
    }
  }
</style>


<body>
  <?php include("navbar.php"); ?><br>

  <div class="container">

    <!-- เมนู -->
    <div class="d-flex justify-content-between">
      <a href="std_home.php" class="custom-tab <?= basename($_SERVER['PHP_SELF']) == 'std_home.php' ? 'active' : ''; ?>">
        <i class="bi bi-calendar-event-fill"></i>
        <span>หน้าหลัก</span>
      </a>
      <a href="proposal.php" class="custom-tab <?= basename($_SERVER['PHP_SELF']) == 'proposal.php' ? 'active' : ''; ?>">
        <i class="bi bi-list-task"></i>
        <span>ยื่นข้อเสนอ</span>
      </a>
      <a href="chose_com.php" class="custom-tab <?= basename($_SERVER['PHP_SELF']) == 'chose_com.php' ? 'active' : ''; ?>">
        <i class="bi bi-bank"></i>
        <span>สถานประกอบการ</span>
      </a>
    </div>

    <?php if ($std['Pro_status'] == 1): ?>

  <!-- การ์ดแสดงข้อมูลสถานประกอบการ -->
  <div class="mobile-card mt-3">
    <div class="mobile-title">
      ข้อมูลสถานประกอบการ<br>
      (<?= $std['Std_id'] . ' - ' . $std['Std_prefix'] . $std['Std_name'] . ' ' . $std['Std_surname']; ?>)
    </div>

    <div class="info-row">
      <div class="info-label">ชื่อสถานประกอบการ:</div>
      <div class="info-value">
        <?= (!empty($std['NamecomTH']) ? $std['NamecomTH'] : '') ?><br>
        <?= (!empty($std['NamecomEng']) ? $std['NamecomEng'] : '') ?>
      </div>
    </div>

    <div class="info-row">
      <div class="info-label">ที่อยู่:</div>
      <div class="info-value"><?= $std['Company_add'] ?? '-'; ?></div>
    </div>

    <div class="info-row">
      <div class="info-label">จังหวัด:</div>
      <div class="info-value"><?= $std['Province'] ?? '-'; ?></div>
    </div>

    <div class="info-row">
      <div class="info-label">เบอร์ติดต่อ:</div>
      <div class="info-value"><?= $std['Com_phone'] ?? '-'; ?></div>
    </div>

    <div class="info-row">
      <div class="info-label">สถานะยื่นฝึกงาน:</div>
      <div class="info-value">
        <span class='status-label status-approved'>อนุมัติ</span>
      </div>
    </div>

    <div class="info-row">
      <div class="info-label">สถานะการตอบรับจากสถานประกอบการ:</div>
      <div class="info-value">
        <?php
        switch ($std['Com_status']) {
          case 0: echo "<span class='status-label status-rejected'>ไม่อนุมัติ</span>"; break;
          case 1: echo "<span class='status-label status-approved'>อนุมัติ</span>"; break;
          case 2: echo "<span class='status-label status-modification'>แก้ไข</span>"; break;
          case 3: echo "<span class='status-label status-pending'>รอตรวจสอบ</span>"; break;
          default: echo "<span class='status-label status-none'>ไม่มีข้อมูล</span>";
        }
        ?>
      </div>
    </div>

    <div class="d-grid mt-3">
      <a href="select_com.php?id=<?= $Std_id ?>" class="btn btn-outline-info rounded-pill fw-bold">
        <i class="bi bi-building-add me-1"></i> เลือกสถานประกอบการ
      </a>
    </div>
  </div>

  <div class="note-text text-end mt-2">
    **หมายเหตุ: คลิก <i class="bi bi-building-add"></i> เพื่อเลือกสถานประกอบการ
  </div>

<?php else: ?>

  <!-- แสดงข้อความแจ้งเตือนแทน -->
  <div class="alert alert-warning text-center mt-4">
    <i class="bi bi-exclamation-triangle-fill"></i> ยังไม่สามารถดูข้อมูลสถานประกอบการได้ <br>
    โปรดรอการอนุมัติข้อเสนอโครงการฝึกงานจากอาจารย์
  </div>

<?php endif; ?>


  </div>

  <?php include("footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>