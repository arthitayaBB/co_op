<?php
include 'connectdb.php';
include 'check_admin.php';

$search = '';

if (isset($_GET['search'])) {
    $search = $_GET['search']; 
}

$query = "SELECT * FROM company WHERE NamecomTH LIKE '%$search%' OR NamecomEng LIKE '%$search%' OR Company_add LIKE '%$search%'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ช้อมูลบริษัท</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
    <script>
        $(document).ready(function() {
            $('#companyTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "search": "ค้นหา:",
                    "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "infoEmpty": "แสดง 0 ถึง 0 จาก 0 รายการ",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
                    }
                }
            });
        });

        function searchCompany() {
            var searchQuery = document.getElementById('search').value;
            window.location.href = "indexcompany.php?search=" + searchQuery;
        }
    </script>
</head>
<body>
    <div class="header">
        <img src="../BackEnd/img/mbs.png" alt="โลโก้คณะ">
        <div class="header-content">
            <h1>บริหารจัดการและประชาสัมพันธ์ สหกิจศึกษา</h1>
            <p>คณะการบัญชีและการจัดการ มหาวิทยาลัยมหาสารคาม</p>
        </div>
    </div>

    <?php include('sidebar.php'); ?>

<div class="content">
  <h2>จัดการข้อมูลสถานประกอบการ</h2>
  <div class="d-flex justify-content-between mb-3">  <a href="add_company.php" class="btn btn-success">
            <i class="fas fa-plus"></i> เพิ่มข้อมูลสถานประกอบการ
        </a> </div>  
  <div class="table-container">
    
    <table id="companyTable" class="table table-bordered table-hover table-striped">
      <thead>
        <tr>
          <th>การจัดการ</th>
          <th>ID</th>
          <th>ชื่อบริษัท (TH)</th>
          <th>ชื่อบริษัท (EN)</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td>
            <a href="edit_company.php?id=<?php echo $row['Company_id']; ?>" class="btn btn-warning btn-sm btn-spacing">
                <i class="fas fa-pencil-alt"></i> แก้ไข
            </a>
            <a href="delete_company.php?id=<?php echo $row['Company_id']; ?>" class="btn btn-danger btn-sm btn-spacing" onClick="return confirm('คุณแน่ใจหรือไม่?');">
                <i class="fas fa-trash-alt"></i> ลบ
            </a>
           <a href="view_company.php?Company_id=<?php echo $row['Company_id']; ?>" class="btn btn-primary btn-sm text-white rounded-pill" title="ดูรายละเอียด">
    <i class="fas fa-eye"></i> รายละเอียด
</a>
           <td><?php echo $row['Company_id']; ?></td>
          <td class="left"><?php echo $row['NamecomTH']; ?></td>
          <td class="left"><?php echo $row['NamecomEng']; ?></td>
          
        </tr>
        <?php } ?>
      </tbody>
    </table>
</div>
</div>
</body>
</html>