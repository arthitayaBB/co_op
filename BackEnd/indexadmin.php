<?php
include 'connectdb.php';
include 'check_admin.php';
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT * FROM adminn WHERE Admin_id LIKE '%$search%' OR Ad_name LIKE '%$search%' OR Ad_surname LIKE '%$search%'";
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
    <title>จัดการข้อมูลAdmin</title>
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
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "search": "ค้นหา:",
                    "lengthMenu": "แสดง _MENU_ แถว",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "infoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
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
            window.location.href = "indexadmin.php.php?search=" + searchQuery;
        }
    </script>
</head>

<body>

    <?php include('sidebar.php'); ?>


    <div class="content">
        <h2>ข้อมูลAdmin</h2>
        <div class="d-flex justify-content-between mb-3"> <a href="add_admin.php" class="btn btn-success"><i class="fas fa-plus"></i> เพิ่มข้อมูลAdmin</a> </div>

        <div class="table-container">

            <table id="teacherTable" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>การจัดการ</th>
                        <th>ID</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>อีเมล</th>
                       
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <a href="edit_admin.php?id=<?php echo $row['Admin_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i>แก้ไข</a>
                                <a href="delete_admin.php?id=<?php echo $row['Admin_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือไม่?');"><i class="fas fa-trash-alt"></i>ลบ</a>
                            </td>
                            <td><?php echo $row['Admin_id']; ?></td>
                            <td><?php echo $row['Ad_name']; ?></td>
                            <td><?php echo $row['Ad_surname']; ?></td>
                            <td><?php echo $row['Ad_phone']; ?></td>
                            <td><?php echo $row['Ad_email']; ?></td>

                            </td>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchTeacher() {
            var searchQuery = document.getElementById('search').value;
            window.location.href = "indexadmin.php?search=" + searchQuery;
        }
    </script>
</body>

</html>
<?php mysqli_close($conn); ?>