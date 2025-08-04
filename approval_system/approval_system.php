<?php
session_start();
session_regenerate_id(true);
include 'connectdb.php'; // เชื่อมต่อแล้วได้ตัวแปร $conn

if (!isset($_SESSION['teacher_id'])) {
    header('Location: login.php');
    exit();
}

// ดึงข้อมูลอาจารย์
$teacher_query = "SELECT t.Tec_name, m.Major_name, t.Major_id FROM teacher t JOIN major m ON t.Major_id = m.Major_id WHERE t.Tec_id = ?";
$stmt = $conn->prepare($teacher_query);
$stmt->bind_param("i", $_SESSION['teacher_id']);
$stmt->execute();
$teacher_result = $stmt->get_result();
$teacher = $teacher_result->fetch_assoc();

// ดึงข้อมูลนักศึกษา
$search = isset($_POST['search']) ? $_POST['search'] : '';
$view_status = isset($_POST['view_status']) ? $_POST['view_status'] : '';  // รับค่าจากฟอร์ม

$students_query = "SELECT s.Std_id, s.Std_name, s.Std_surname, p.Pro_status 
FROM student s 
LEFT JOIN proposal p ON s.Std_id = p.Std_id 
LEFT JOIN advisor a ON s.Std_id = a.Std_id
WHERE (a.Tec_id1 = ? OR a.Tec_id2 = ?) 
AND (s.Std_id LIKE ? OR s.Std_name LIKE ? OR s.Std_surname LIKE ?)";
if ($view_status !== '') {
    $students_query .= " AND p.Pro_status = ?";
}
$students_query .= " ORDER BY p.Proposal_id DESC";

// ดึงจำนวนสถานะจากฐานข้อมูล
$status_counts_query = "SELECT Pro_status, COUNT(*) as count 
                        FROM proposal 
                        WHERE Std_id IN (SELECT Std_id FROM advisor WHERE Tec_id1 = ? OR Tec_id2 = ?) 
                        GROUP BY Pro_status";
$stmt = $conn->prepare($status_counts_query);
$stmt->bind_param("ii", $_SESSION['teacher_id'], $_SESSION['teacher_id']);
$stmt->execute();
$status_counts_result = $stmt->get_result();
$status_counts = [];

while ($row = $status_counts_result->fetch_assoc()) {
    $status_counts[$row['Pro_status']] = $row['count'];
}

// ค่าเริ่มต้นถ้าจำนวนสถานะบางตัวไม่มีค่า
$status_counts += [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0];


$stmt = $conn->prepare($students_query);
$search_param = "%$search%";
if ($view_status !== '') {
    $stmt->bind_param("iisssi", $_SESSION['teacher_id'], $_SESSION['teacher_id'], $search_param, $search_param, $search_param, $view_status);
} else {
    $stmt->bind_param("iisss", $_SESSION['teacher_id'], $_SESSION['teacher_id'], $search_param, $search_param, $search_param);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบอนุมัติการออกฝึกสหกิจ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .btn-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-disapprove {
            background-color: #dc3545;
            color: white;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .logout-custom-btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        /* เอาขอบออกจาก alert */
        .alert {
            border: none;
            /* ยกเลิกขอบ */
            box-shadow: none;
            /* เอารูปเงาออก */
        }

        /* ปรับขนาดไอคอน */
        .fas {
            font-size: 24px;
            /* ขนาดไอคอน */
            margin-right: 8px;
            /* ระยะห่างจากข้อความ */
        }

        /* ปรับตำแหน่งไอคอน */
        .alert i {
            vertical-align: middle;
            /* ทำให้ไอคอนอยู่ในแนวเดียวกับข้อความ */
        }
    </style>

</head>

<body>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "search": "ค้นหา:",
                    "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                    "info": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "ถัดไป",
                        "previous": "ก่อนหน้า"
                    },
                    "zeroRecords": "ไม่พบข้อมูลที่ค้นหา",
                    "infoEmpty": "ไม่มีข้อมูล",
                    "infoFiltered": "(กรองจากทั้งหมด _MAX_ รายการ)"
                },
                "ordering": true,
                "lengthChange": true,
                "pageLength": 10,
            });
        });
    </script>


    <div class="container mt-4">
        <div class="header text-center">
            <h2>ระบบอนุมัติการออกฝึกสหกิจ</h2>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>อาจารย์:</strong> <?php echo $teacher['Tec_name']; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>สาขาวิชา:</strong> <?php echo $teacher['Major_name']; ?></p>
                </div>
            </div>
            <div class="text-end">
                <a href="logout_tec.php" class="btn btn-danger logout-custom-btn">ออกจากระบบ</a>
            </div>
        </div>

        <!-- ฟอร์มเลือกดูข้อมูล -->
        <form method="POST" class="mb-4">


            <div class="col">
                <label for="view_status">สถานะ:</label>
                <select name="view_status" id="view_status" class="form-control">
                    <option value="">ทั้งหมด</option>
                    <option value="0">ไม่อนุมัติ</option>
                    <option value="1">อนุมัติ</option>
                    <option value="2">แก้ไข</option>
                    <option value="3">รอตรวจสอบ</option>
                    <option value="4">ยังไม่เพิ่มโปรเจค</option>
                </select>
            </div>



        </form>
        <div class="row mb-4 justify-content-center">
            <div class="col-md-2">
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-times-circle"></i> <strong>ไม่อนุมัติ:</strong> <?php echo $status_counts[0]; ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle"></i> <strong>อนุมัติ:</strong> <?php echo $status_counts[1]; ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="alert alert-warning" role="alert">
                    <i class="fas fa-pencil-alt"></i> <strong>แก้ไข:</strong> <?php echo $status_counts[2]; ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-clock"></i> <strong>รอตรวจสอบ:</strong> <?php echo $status_counts[3]; ?>
                </div>
            </div>
            <div class="col-md-3">
                <div class="alert alert-secondary" role="alert">
                    <i class="fas fa-hourglass-half"></i> <strong>ยังไม่เพิ่มโปรเจค:</strong> <?php echo $status_counts[4]; ?>
                </div>
            </div>
        </div>




        <table id="studentsTable" class="table table-hover table-bordered mt-4">

            <thead class="table-primary">

                <tr>
                    <th scope="col" class="text-center" style="width: 8%;">ลำดับที่</th>
                    <th scope="col" class="text-center" style="width: 12%;">รหัสนิสิต</th>
                    <th scope="col" class="text-center" style="width: 20%;">ชื่อ-นามสกุล</th>
                    <th scope="col" class="text-center" style="width: 10%;">สถานะ</th>
                    <th scope="col" class="text-center" style="width: 50%;">ดำเนินการ</th>
                </tr>
            </thead>


            <tbody>
                <?php if (isset($result) && $result->num_rows > 0): ?>
                    <?php $i = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo htmlspecialchars($row['Std_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['Std_name'] . ' ' . $row['Std_surname']); ?></td>
                            <td>
                                <?php
                                switch ($row['Pro_status']) {
                                    case 0:
                                        echo '<span class="text-danger">ไม่อนุมัติ</span>';
                                        break;
                                    case 1:
                                        echo '<span class="text-success">อนุมัติ</span>';
                                        break;
                                    case 2:
                                        echo '<span class="text-warning">แก้ไข</span>';
                                        break;
                                    case 3:
                                        echo '<span class="text-info">รอตรวจสอบ</span>';
                                        break;
                                    case 4:
                                    default:
                                        echo '<span class="text-secondary">ยังไม่เพิ่มโปรเจค</span>';
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <a href="Std_details.php?Std_id=<?php echo $row['Std_id']; ?>" class="btn btn-sm btn-info">ดูรายละเอียด</a>
                                <button class="btn btn-sm btn-warning edit-btn"
                                    data-student-id="<?php echo $row['Std_id']; ?>"
                                    data-status="2">แก้ไข</button>
                                <button class="btn btn-approve"
                                    data-student-id="<?php echo $row['Std_id']; ?>"
                                    data-status="1">อนุมัติ</button>
                                <button class="btn btn-disapprove"
                                    data-student-id="<?php echo $row['Std_id']; ?>"
                                    data-status="0">ไม่อนุมัติ</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-danger">ไม่พบข้อมูลนิสิต</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>

        <script>
            $(document).ready(function() {
                // กำหนดสถานะปัจจุบัน
                var currentStatus = "<?php echo isset($view_status) ? $view_status : ''; ?>";
                $("#view_status").val(currentStatus);

                // เมื่อเปลี่ยนสถานะ
                $("#view_status").change(function() {
                    var selectedStatus = $(this).val();

                    $("tbody tr").each(function() {
                        var rowStatus = $(this).find("td:eq(3) span").attr("class"); // อ่าน class ของ <span> สถานะ
                        var statusValue = "";

                        if (rowStatus.includes("text-danger")) statusValue = "0";
                        else if (rowStatus.includes("text-success")) statusValue = "1";
                        else if (rowStatus.includes("text-warning")) statusValue = "2";
                        else if (rowStatus.includes("text-info")) statusValue = "3";
                        else statusValue = "4"; // ยังไม่เพิ่มโปรเจค

                        // เช็คว่า status ตรงกับที่เลือกมั้ย
                        if (selectedStatus === "" || selectedStatus === statusValue) {
                            $(this).show(); // แสดงแถวนี้
                        } else {
                            $(this).hide(); // ซ่อนแถวนี้
                        }
                    });
                });

                $('#search').on('keyup', function() {
                    table.search(this.value).draw();
                });

                // กดปุ่มอนุมัติ/แก้ไข/ไม่อนุมัติ แล้วอัปเดตสถานะในหน้าทันที
                $(".edit-btn, .btn-approve, .btn-disapprove").click(function(e) {
                    e.preventDefault();

                    var button = $(this);
                    var student_id = button.data("student-id");
                    var status = button.data("status");
                    var row = button.closest("tr");

                    $.ajax({
                        url: 'update_status.php',
                        method: 'POST',
                        data: {
                            student_id: student_id,
                            status: status
                        },
                        success: function(response) {
                            var statusCell = row.find("td:eq(3)");

                            switch (status) {
                                case 0:
                                    statusCell.html('<span class="text-danger">ไม่อนุมัติ</span>');
                                    break;
                                case 1:
                                    statusCell.html('<span class="text-success">อนุมัติ</span>');
                                    break;
                                case 2:
                                    statusCell.html('<span class="text-warning">แก้ไข</span>');
                                    break;
                                default:
                                    statusCell.html('<span class="text-secondary">ยังไม่เพิ่มโปรเจค</span>');
                                    break;
                            }

                            // หลังจากแก้ไขสถานะแล้ว ทำการกรองใหม่อีกครั้ง
                            $("#view_status").change();
                            // อัปเดตจำนวนสถานะ
                            updateStatusCounts();
                        },
                        error: function() {
                            alert('เกิดข้อผิดพลาด');
                        }
                    });
                });
            });

            function updateStatusCounts() {
                $.ajax({
                    url: 'get_status_counts.php', // สร้างไฟล์นี้เพื่อดึงจำนวนสถานะจากฐานข้อมูล
                    method: 'GET',
                    success: function(response) {
                        var counts = JSON.parse(response);

                        // อัปเดตข้อมูลสถานะใน UI แบบเคลียร์ไอคอนแล้วเติมใหม่ทั้งหมด
                        $(".alert-danger").html('<i class="fas fa-times-circle"></i> <strong>ไม่อนุมัติ:</strong> ' + counts[0]);
                        $(".alert-success").html('<i class="fas fa-check-circle"></i> <strong>อนุมัติ:</strong> ' + counts[1]);
                        $(".alert-warning").html('<i class="fas fa-pencil-alt"></i> <strong>แก้ไข:</strong> ' + counts[2]);
                        $(".alert-info").html('<i class="fas fa-clock"></i> <strong>รอตรวจสอบ:</strong> ' + counts[3]);
                        $(".alert-secondary").html('<i class="fas fa-hourglass-half"></i> <strong>ยังไม่เพิ่มโปรเจค:</strong> ' + counts[4]);
                    },
                    error: function() {
                        alert('เกิดข้อผิดพลาดในการดึงข้อมูลสถานะ');
                    }
                });
            }
        </script>

    </div>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>