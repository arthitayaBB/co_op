<?php
include 'connectdb.php';
include 'check_admin.php';


$search = isset($_GET['search']) ? $_GET['search'] : '';
$year_filter = isset($_GET['year_filter']) ? $_GET['year_filter'] : '';

// ดึงปีการศึกษาแบบไม่ซ้ำ
$year_query = "SELECT DISTINCT Work_year FROM student_work ORDER BY Work_year DESC";
$year_result = mysqli_query($conn, $year_query);

$query = "
    SELECT 
        student_work.*, 
        student.Std_prefix, 
        student.Std_name, 
        student.Std_surname,
        company.NamecomTH
    FROM 
        student_work
    JOIN 
        student ON student_work.Std_id = student.Std_id
    LEFT JOIN 
        company ON student_work.Company_id = company.Company_id
    WHERE 
        (
            student_work.Work_id LIKE '%$search%' 
            OR student_work.Work_name LIKE '%$search%' 
            OR student_work.Std_id LIKE '%$search%' 
            OR student_work.Work_file LIKE '%$search%'
        )
";

if ($year_filter !== '') {
    $query .= " AND student_work.Work_year = '" . mysqli_real_escape_string($conn, $year_filter) . "'";
}

$query .= " ORDER BY student_work.date DESC";
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
    <title>จัดการข้อมูลผลงานนิสิต</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
    <script>
        $(document).ready(function() {
            $('#stdTable').DataTable({
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
<style>
    .left {
        max-width: 200px;
        /* ปรับได้ตามต้องการ */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .limited-width {
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>

<body>


    <?php include('sidebar.php'); ?>


    <div class="content">
        <h2>ผลงานนิสิต</h2>
        <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">

            <!-- ปุ่มเพิ่มข้อมูล -->
            <a href="add_studentwork.php" class="btn btn-success">
                <i class="fas fa-plus"></i> เพิ่มข้อมูลผลงานนิสิต
            </a>

            <!-- ฟอร์มกรอง -->
            <form method="GET" class="d-flex gap-2 flex-nowrap align-items-end">
                <div style="min-width: 200px;">
                    <select name="year_filter" class="form-select">
                        <option value="">-- ปีการศึกษาทั้งหมด --</option>
                        <?php while ($y = mysqli_fetch_assoc($year_result)) { ?>
                            <option value="<?php echo $y['Work_year']; ?>" <?php if ($year_filter == $y['Work_year']) echo 'selected'; ?>>
                                <?php echo $y['Work_year']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> กรอง
                    </button>
                </div>

                <div>
                    <a href="indexstudentwork.php" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> รีเซ็ต
                    </a>
                </div>
            </form>
        </div>



        <div class="table-container">
            <table id="stdTable" class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>การจัดการ</th>
                        <th>รหัสผลงาน</th>
                        <th>วันที่</th>
                        <th>ปีการศึกษา</th>
                        <th>รหัสนิสิต</th>
                        <th>นิสิต</th>
                        <th>ชื่อผลงาน</th>
                        <th>รายละเอียด</th>
                        <th>สถานประกอบการ</th>
                        


                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <a href="edit_studentwork.php?id=<?php echo $row['Work_id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="delete_studentwork.php?id=<?php echo $row['Work_id']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('คุณแน่ใจหรือไม่?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a href="std_workdetail.php?id=<?php echo $row['Work_id']; ?>" class="btn btn-primary btn-sm text-white rounded-pill" title="ดูรายละเอียด">
                                    <i class="fas fa-eye"></i> รายละเอียด
                                </a>

                            </td>

                            <td><?php echo $row['Work_id']; ?></td>
                            <td><?php echo $row['Date']; ?></td>
                            <td><?php echo $row['Work_year']; ?></td>
                            <td><?php echo $row['Std_id']; ?></td>
                            <td><?php echo $row['Std_prefix'] . ' ' . $row['Std_name'] . ' ' . $row['Std_surname']; ?></td>
                            <td class="left"><?php echo $row['Work_name']; ?></td>
                            <td class="left"><?php echo $row['Work_detail']; ?></td> <!-- ชิดซ้าย -->
                            <td class="left"><?php echo $row['NamecomTH']; ?></td> <!-- แสดงชื่อบริษัท -->
                            

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