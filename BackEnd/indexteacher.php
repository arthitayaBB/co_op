<?php
include 'connectdb.php';
include 'check_admin.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT teacher.*, major.Major_name 
        FROM teacher 
        LEFT JOIN major ON teacher.Major_id = major.Major_id
        WHERE (
            teacher.Tec_id LIKE '%$search%' 
            OR teacher.Tec_name LIKE '%$search%' 
            OR teacher.Tec_surname LIKE '%$search%'
        )";


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
    <title>จัดการข้อมูลอาจารย์</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
    <script>
        $(document).ready(function() {
            $('#teacherTable').DataTable({
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

        function searchTeacher() {
            var searchQuery = document.getElementById('search').value;
            window.location.href = "indexteacher.php?search=" + searchQuery;
        }
    </script>
</head>

<body>


    <?php include('sidebar.php'); ?>


    <div class="content">
        <h2>จัดการข้อมูลอาจารย์</h2>
        <div class="d-flex justify-content-between mb-3">
            <a href="add_teacher.php" class="btn btn-success">
                <i class="fas fa-plus"></i> เพิ่มข้อมูลอาจารย์
            </a>
        </div>

        <div class="table-container">
            <table id="teacherTable" class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>การจัดการ</th>
                        <th>รูปภาพ</th>
                        <th>รหัสอาจารย์</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>สาขา</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>อีเมล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <a href="edit_teacher.php?id=<?php echo $row['Tec_id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="delete_teacher.php?id=<?php echo $row['Tec_id']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('คุณแน่ใจหรือไม่?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>

                            </td>
                            <td><img src="img_teacher/<?php echo (!empty($row['Tec_picture']) && file_exists('img_teacher/' . $row['Tec_picture'])) ? $row['Tec_picture'] : 'default.jpg'; ?>"
                                    alt="ภาพอาจารย์" class="teacher-img1"></td>
                            <td><?php echo $row['Tec_id']; ?></td>
                            <td><?php echo $row['Tec_name']; ?></td>
                            <td><?php echo $row['Tec_surname']; ?></td>
                            <td><?php echo $row['Major_name']; ?></td>
                            <td><?php echo $row['Tec_phone']; ?></td>
                            <td><?php echo $row['Tec_email']; ?></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php mysqli_close($conn); ?>