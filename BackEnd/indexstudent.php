<?php 
include 'connectdb.php';
include 'check_admin.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT * FROM student WHERE Std_id LIKE '%$search%' OR Std_name LIKE '%$search%' OR Std_surname LIKE '%$search%'";
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
    <title>ข้อมูลนิสิต</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "language": {
                    "search": "ค้นหา:",
                    "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                    "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "infoEmpty": "ไม่มีข้อมูล",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "ถัดไป",
                        "previous": "ก่อนหน้า"
                    }
                }
            });
        });

        function searchStudent() {
            var searchQuery = document.getElementById('search').value;
            window.location.href = "indexstudent.php?search=" + searchQuery;
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

<div class="sidebar">
        <a class="ad-name" style="display: block;">
        <i class="fas fa-user-circle"></i> <!-- ไอคอนโปรไฟล์ -->
        <?=$_SESSION['Ad_name'];?> <?=$_SESSION['Ad_surname'];?> <!-- แสดงชื่อและนามสกุล -->
        </a> 
        <a href="indexteacher.php"><i class="fas fa-chalkboard-teacher"></i><span> ข้อมูลอาจารย์</span></a>
        <a href="indexstudent.php" class="active"><i class="fas fa-user-graduate"></i><span> ข้อมูลนิสิต</span></a>
        <a href="indexstudentwork.php"><i class="fas fa-folder"></i><span> ผลงานนิสิต</span></a>
        <a href="indexcompany.php"><i class="fas fa-building"></i><span> ข้อมูลสถานประกอบการ</span></a>
        <a href="indexmajor.php"><i class="fas fa-sitemap"></i><span> ข้อมูลสาขา</span></a>
        <a href="indexnews.php"><i class="fas fa-newspaper"></i><span> ข้อมูลข่าวสาร</span></a>
        <a href="indexadmin.php"><i class="fas fa-user-cog"></i><span> Admin</span></a>
        <a href="indexbanner.php"><i class="fas fa-bullhorn"></i><span> แจ้งเตือน</span></a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i><span> ออกจากระบบ</span></a>
    </div>
    <div class="content">
  <h2>จัดการข้อมูลนิสิต</h2>
  <div class="d-flex justify-content-between mb-3">  <a href="add_student.php" class="btn btn-success">
            <i class="fas fa-plus"></i> เพิ่มข้อมูลนิสิต
        </a> </div>
       
      <div class="table-container">
        <table id="studentTable" class="table table-striped table-hover table-bordered align-middle">
          <thead>
            <tr>
              <th>การจัดการ</th>
              <th>รหัสนิสิต</th>
              <th>รหัสบัตรประชาชน</th>
              <th>ชื่อ</th>
              <th>นามสกุล</th>
              <th>รหัสสาขา</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
            <td>
    <a href="edit_student.php?id=<?php echo $row['Std_id']; ?>" class="btn btn-warning btn-sm btn-spacing">
        <i class="fas fa-pencil-alt"></i> แก้ไข
    </a> 
    <a href="delete_student.php?id=<?php echo $row['Std_id']; ?>" class="btn btn-danger btn-sm btn-spacing" onClick="return confirm('คุณแน่ใจหรือไม่?');">
        <i class="fas fa-trash-alt"></i> ลบ
    </a>
    <a href="student_details.php?Std_id=<?php echo $row['Std_id']; ?>" class="btn btn-primary btn-sm text-white rounded-pill" title="ดูรายละเอียด">
        <i class="fas fa-eye"></i> รายละเอียด
    </a>
</td>
      		  <td> <?php echo $row['Std_id']; ?></td>
              <td><?php echo $row['Id_number']; ?></td>
              <td><?php echo $row['Std_name']; ?></td>
              <td><?php echo $row['Std_surname']; ?></td>
              <td><?php echo $row['Major_id']; ?></td>
            
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>
