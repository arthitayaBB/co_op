<?php
include_once("connectdb.php");
include("checklogin.php");

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;
$Std_id = $_SESSION['Std_id'];


$sql = "
    SELECT std.*, 
           m.Major_name, 
           t.Tec_name, 
           t.Tec_surname, 
           p.Pro_status, 
           p.Note, 
           p.Proposal_name,
           t1.Tec_name AS Advisor1_name, 
           t1.Tec_surname AS Advisor1_surname, 
           t2.Tec_name AS Advisor2_name, 
           t2.Tec_surname AS Advisor2_surname
    FROM student std
    INNER JOIN major m ON std.Major_id = m.Major_id
    INNER JOIN teacher t ON m.Major_id = t.Major_id 
    INNER JOIN proposal p ON std.Std_id = p.Std_id
    LEFT JOIN advisor a ON std.Std_id = a.Std_id
    LEFT JOIN teacher t1 ON a.Tec_id1 = t1.Tec_id  -- เชื่อมอาจารย์ที่ปรึกษาคนแรก
    LEFT JOIN teacher t2 ON a.Tec_id2 = t2.Tec_id  -- เชื่อมอาจารย์ที่ปรึกษาคนที่สอง
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
  <title>รายละเอียดข่าวกิจกรรมสหกิจศึกษา</title>
  <link rel="icon" href="images/Logo.png" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<!-- ส่วนของ CSS -->
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


<!-- ส่วน body -->

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

    
   <!-- การ์ดแสดงข้อมูล -->
<div class="mobile-card">
  <div class="mobile-title">
    ขออนุมัติฝึกสหกิจศึกษา<br>
    (<?= $std['Std_id'] . ' - ' . $std['Std_prefix'] . $std['Std_name'] . ' ' . $std['Std_surname']; ?>)
  </div>

  <div class="info-row">
    <div class="info-label">ชื่อ-สกุล:</div>
    <div class="info-value"><?= $std['Std_prefix'] . $std['Std_name'] . ' ' . $std['Std_surname']; ?></div>
  </div>

  <div class="info-row">
    <div class="info-label">สาขา:</div>
    <div class="info-value"><?= $std['Major_name']; ?></div>
  </div>

  <div class="info-row">
    <div class="info-label">อาจารย์ที่ปรึกษา:</div>
    <div class="info-value">
      <?= $std['Advisor1_name'] . ' ' . $std['Advisor1_surname']; ?><br>
      <?= $std['Advisor2_name'] . ' ' . $std['Advisor2_surname']; ?>
    </div>
  </div>

  <div class="info-row">
    <div class="info-label">โปรเจค:</div>
    <div class="info-value">
      <?= $std['Proposal_name']; ?>
      <a href="project.php?id=<?= $Std_id ?>" class="ms-2 text-decoration-none">
        <i class="bi bi-box-arrow-in-up"></i>
      </a>
    </div>
  </div>

  <div class="info-row">
    <div class="info-label">สถานะ:</div>
    <div class="info-value">
      <?php
      $status = $std['Pro_status'];
      switch ($status) {
        case 0:
          echo "<span class='status-label status-rejected'>ไม่อนุมัติ</span>";
          break;
        case 1:
          echo "<span class='status-label status-approved'>อนุมัติ</span>";
          break;
        case 2:
          echo "<span class='status-label status-modification'>แก้ไข</span>";
          break;
        case 3:
          echo "<span class='status-label status-pending'>รอตรวจสอบ</span>";
          break;
        case 4:
          echo "<span class='status-label status-none'>กรุณาเพิ่มโปรเจค</span>";
          break;
        default:
          echo "<span class='status-label status-none'>ไม่มีข้อมูล</span>";
      }
      ?>
    </div>
  </div>

  <div class="info-row">
    <div class="info-label">หมายเหตุ:</div>
    <div class="info-value text-danger"><?= $std['Note']; ?></div>
  </div>
</div>

    <div class="note-text text-end">
      **หมายเหตุ คลิก <i class="bi bi-box-arrow-in-up"></i> เพื่ออัพโหลดโปรเจคของนิสิต
    </div>
  </div>

  <?php include("footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>