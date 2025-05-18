<?php
include 'connectdb.php';
include 'check_admin.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT student.*, major.Major_name 
          FROM student
          LEFT JOIN major ON student.Major_id = major.Major_id
          WHERE student.Std_id LIKE '%$search%' 
          OR student.Std_name LIKE '%$search%' 
          OR student.Std_surname LIKE '%$search%'";

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

    <?php include('sidebar.php'); ?>

    <div class="content">
        <h2>จัดการข้อมูลนิสิต</h2>
        <div class="d-flex justify-content-between mb-3"> <a href="add_student.php" class="btn btn-success">
                <i class="fas fa-plus"></i> เพิ่มข้อมูลนิสิต
            </a>
            <button class="btn btn-info" onclick="printSelected()">
    <i class="fas fa-print"></i> พิมพ์ข้อมูลที่เลือก
</button>

        </div>

        <div class="table-container">
            <table id="studentTable" class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>เลือก</th>
                        <th>การจัดการ</th>
                        <th>รหัสนิสิต</th>
                        <th>รหัสบัตรประชาชน</th>
                        <th>คำนำหน้า</th>
                        <th>ชื่อ</th>
                        <th>นามสกุล</th>
                        <th>สาขา</th>
                        <th>ปีการศึกษา</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                        
                            <td>
                                <input type="checkbox" class="print-checkbox" value="<?php echo $row['Std_id']; ?>">
                            </td>
                        
                            <td>

                                <a href="edit_student.php?id=<?php echo $row['Std_id']; ?>" class="btn btn-warning btn-sm btn-spacing">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="delete_student.php?id=<?php echo $row['Std_id']; ?>" class="btn btn-danger btn-sm btn-spacing" onClick="return confirm('คุณแน่ใจหรือไม่?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a href="student_details.php?Std_id=<?php echo $row['Std_id']; ?>" class="btn btn-primary btn-sm text-white rounded-pill" title="ดูรายละเอียด">
                                    <i class="fas fa-eye"></i> รายละเอียด
                                </a>
                
                            </td>
                            <td> <?php echo $row['Std_id']; ?></td>
                            <td><?php echo $row['Id_number']; ?></td>
                            <td><?php echo $row['Std_prefix']; ?></td>
                            <td><?php echo $row['Std_name']; ?></td>
                            <td><?php echo $row['Std_surname']; ?></td>
                            <td><?php echo $row['Major_name']; ?></td>
                            <td><?php echo $row['Academic_year']; ?></td>

                        <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>


    function printSelected() {
        var selectedIds = [];
        // หาค่าของ Std_id ที่เลือก
        document.querySelectorAll('.print-checkbox:checked').forEach(function(checkbox) {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length > 0) {
            var url = "view_student.php?Std_ids=" + encodeURIComponent(selectedIds.join(","));
            var printWindow = window.open(url, "_blank", "width=1000,height=800");
            printWindow.focus();
        } else {
            alert("กรุณาเลือกข้อมูลที่ต้องการพิมพ์");
        }
    }
</script>


</html>
<?php mysqli_close($conn); ?>