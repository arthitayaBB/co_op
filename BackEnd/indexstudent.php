<?php
include 'connectdb.php';
include 'check_admin.php';

// รับค่ากรอง
$search = isset($_GET['search']) ? $_GET['search'] : '';
$major_filter = isset($_GET['major_filter']) ? $_GET['major_filter'] : '';
$year_filter = isset($_GET['year_filter']) ? $_GET['year_filter'] : '';

// ดึงสาขาเพื่อแสดงใน select
$majors_result = mysqli_query($conn, "SELECT Major_id, Major_name FROM major ORDER BY Major_name ASC");

// ดึงปีการศึกษาเพื่อแสดงใน select (distinct)
$years_result = mysqli_query($conn, "SELECT DISTINCT Academic_year FROM student ORDER BY Academic_year DESC");

// สร้างเงื่อนไข WHERE
$where = [];

if ($search !== '') {
    $search_escaped = mysqli_real_escape_string($conn, $search);
    $where[] = "(student.Std_id LIKE '%$search_escaped%' OR student.Std_name LIKE '%$search_escaped%' OR student.Std_surname LIKE '%$search_escaped%')";
}

if ($major_filter !== '') {
    $major_filter_escaped = mysqli_real_escape_string($conn, $major_filter);
    $where[] = "student.Major_id = '$major_filter_escaped'";
}

if ($year_filter !== '') {
    $year_filter_escaped = mysqli_real_escape_string($conn, $year_filter);
    $where[] = "student.Academic_year = '$year_filter_escaped'";
}

$where_sql = '';
if (count($where) > 0) {
    $where_sql = 'WHERE ' . implode(' AND ', $where);
}

$query = "SELECT student.*, major.Major_name 
          FROM student
          LEFT JOIN major ON student.Major_id = major.Major_id
          $where_sql";

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
    <title>จัดการข้อมูลนิสิต</title>
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

    <style>
        #studentTable {
            table-layout: fixed;
            width: 100%;
        }

        #studentTable th.select-col,
        #studentTable td.select-col {
            width: 40px;
            text-align: center;
        }

        .print-checkbox {
            transform: scale(0.9);
            /* ปรับขนาด checkbox ให้เล็กลง */
            cursor: pointer;
        }
    </style>


</head>

<body>

    <?php include('sidebar.php'); ?>

    <div class="content">
        <h2>จัดการข้อมูลนิสิต</h2>




        <div class="d-flex flex-wrap align-items-end gap-2 mb-3">

            <!-- ปุ่มเพิ่มนิสิต -->
            <div>
                <a href="add_student.php" class="btn btn-success">
                    <i class="fas fa-plus"></i> เพิ่มข้อมูลนิสิต
                </a>
            </div>

            <!-- ฟอร์มกรอง -->
            <form method="GET" class="d-flex justify-content-center  align-items-end gap-2">
                <div>
                    <select name="major_filter" class="form-select">
                        <option value="">-- เลือกสาขา --</option>
                        <?php while ($major = mysqli_fetch_assoc($majors_result)) { ?>
                            <option value="<?php echo $major['Major_id']; ?>" <?php if ($major_filter == $major['Major_id']) echo 'selected'; ?>>
                                <?php echo $major['Major_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <select name="year_filter" class="form-select">
                        <option value="">-- เลือกปีการศึกษา --</option>
                        <?php while ($year = mysqli_fetch_assoc($years_result)) { ?>
                            <option value="<?php echo $year['Academic_year']; ?>" <?php if ($year_filter == $year['Academic_year']) echo 'selected'; ?>>
                                <?php echo $year['Academic_year']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter"></i> กรองข้อมูล
                    </button>
                </div>
                <div>
                    <a href="indexstudent.php" class="btn btn-secondary"><i class="fas fa-undo"></i> รีเซ็ต</a>
                </div>
            </form>

            <!-- ปุ่มพิมพ์ -->
            <div class="ms-auto">
                <button class="btn btn-info" onclick="printSelected()">
                    <i class="fas fa-print"></i> พิมพ์ข้อมูลที่เลือก
                </button>
            </div>

        </div>




        <div class="table-container">
            <table id="studentTable" class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th class="select-col">เลือก</th>
                        <th style="width: 195px;" class="text-center">การจัดการ</th>
                        <th class="text-center">รหัสนิสิต</th>
                        <th style="width: 100px">รหัสบัตรประชาชน</th>
                        <th style="width : 50px">คำนำหน้า</th>
                        <th class="text-center">ชื่อ</th>
                        <th class="text-center">นามสกุล</th>
                        <th class="text-center">สาขา</th>
                        <th style="width: 55px;" class="text-center">ปีการศึกษา</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td class="select-col">
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
                            <td style="text-align: left; white-space: normal; word-break: break-word; max-width: 150px;">
                                <?php echo $row['Std_name']; ?>
                            </td>
                            <td style="text-align: left; white-space: normal; word-break: break-word; max-width: 150px;">
                                <?php echo $row['Std_surname']; ?>
                            </td>
                            <td style="text-align: left; white-space: normal; word-break: break-word; max-width: 150px;">
                                <?php echo $row['Major_name']; ?>
                            </td>
                            <td><?php echo $row['Academic_year']; ?></td>
                        </tr>
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