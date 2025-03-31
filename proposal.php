<?php
include_once("connectdb.php");
session_start();


// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;
$Std_id = $_SESSION['Std_id']; 


// คิวรีข้อมูลจากฐานข้อมูล
$sql = "
    SELECT std.*, m.Major_name, t.Tec_name,t.Tec_surname, p.Pro_status, p.Note, p.Proposal_name
    FROM student std
    INNER JOIN major m ON std.Major_id = m.Major_id
    INNER JOIN teacher t ON m.Major_id = t.Major_id 
    INNER JOIN proposal p ON std.Std_id = p.Std_id   
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

<style>
  body {
    background-color: #f4f7fa;
   
  }

  .btn-group a {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 20px;
    border-radius: 50px;
    padding: 12px 25px;
    font-size: 1.1rem;
    font-weight: bold;
  }

  .card-header {
    background-color: #afbfff;
    color: black;
    font-weight: bold;
    font-size: 1.5rem;
    text-align: center;
  }

  .card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: white;
    margin-top: 20px;
  }

  .table th,
  .table td {
    text-align: center;
    vertical-align: middle;
  }

  .table {
    background-color: #fff;
    border-radius: 8px;
  }



  .btn-primary {
    background-color: #0066cc;
    /* สีน้ำเงิน */
    border-color: #005bb5;
  }

  .btn-primary:hover {
    background-color: #005bb5;
    border-color: #004c99;
  }

  .btn-blue {
    background-color:skyblue;
    /* สีเหลือง */
    border-color: skyblue;
    color: white;
  }

  .btn-blue:hover {
    background-color:rgb(0, 130, 230);
    border-color:rgb(0, 130, 230);
    color: white;
   
  }

  .status-label {
    font-weight: bold;
    padding: 5px 10px;
    border-radius: 5px;
  }

  .status-approved {
    background-color: #28a745;
    color: white;
  }

  .status-rejected {
    background-color: #dc3545;
    color: white;
  }

  .status-pending {
    background-color: #ffc107;
    color: white;
  }

  .status-modification {
    background-color: #17a2b8;
    color: white;
  }

  .note-text {
  display: flex;
  gap: 5px; /* เพิ่มระยะห่างระหว่างข้อความและไอคอน */
  font-size: 1rem; /* ปรับขนาดตัวอักษร */
  color: #333; /* สีของข้อความ */
  justify-content: flex-end; /* จัดข้อความให้ไปทางขวามือ */
  width: 100%; /* ให้ span ใช้ความกว้างเต็ม */
  color: #dc3545;
}



  @media (max-width: 768px) {

    .table th,
    .table td {
      padding: 8px;
      font-size: 0.9rem;
    }

    .status-label {
      font-size: 0.8rem;
    }
  }
</style>

<body>
  <?php include("navbar.php"); ?><br>

  <div class="container">
    <div class="btn-group">
      <a href="std_home.php" class="btn btn-primary">กลับหน้าหลัก</a>
      <a href="proposal.php" class="btn btn-secondary">ยื่นข้อเสนอ</a>
      <a href="chose_com.php" class="btn btn-blue">เลือกสถานประกอบการ</a>
    </div>

    <div class="card">
      <div class="card-header">
        ขออนุมัติฝึกสหกิจศึกษา (<?php echo $std['Std_id'] . ' - ' . $std['Std_prefix'] . $std['Std_name'] . '' . $std['Std_surname']; ?>)
      </div>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width: 250px;">ชื่อ-สกุล</th>
            <th>สาขา</th>
            <th>อาจารย์ที่ปรึกษา</th>
            <th>โปรเจค</th>
            <th>สถานะ</th>
            <th>หมายเหตุ</th>
          </tr>
          <tr>
            <td><?php echo $std['Std_prefix'] . ' ' . $std['Std_name'] . '' . $std['Std_surname']; ?></td>
            <td><?php echo $std['Major_name']; ?></td>
            <td><?php echo $std['Tec_name'] . ' ' . $std['Tec_surname']; ?></td>
            <td>
            <?php echo $std['Proposal_name']; ?>
              <a href="project.php?id=<?= $Std_id?>">
              <i class="bi bi-box-arrow-in-up"></i>
              </a>
            </td>


            <td>



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
                default:
                  echo "<span class='status-label' style='background-color: gray;'>ไม่มีข้อมูล</span>";
              }
              ?>
            </td>

            <td><?php echo $std['Note']; ?></td>
          </tr>
        </table>
      </div>
    </div><br>
  </div><span class="note-text">**หมายเหตุ คลิก <i class="bi bi-box-arrow-in-up"></i> เพื่ออัพโหลดโปรเจคของนิสิต</span>





  <?php include("footer.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="script.js"></script>
</body>

</html>