<?php
session_start();
session_regenerate_id(true);
include 'connectdb.php';

if (!isset($_SESSION['teacher_id'])) {
    header('Location: login.php');
    exit();
}

$teacher_query = "SELECT t.Tec_name, m.Major_name, t.Major_id FROM teacher t JOIN major m ON t.Major_id = m.Major_id WHERE t.Tec_id = ?";
$stmt = $conn->prepare($teacher_query);
$stmt->bind_param("i", $_SESSION['teacher_id']);
$stmt->execute();
$teacher_result = $stmt->get_result();
$teacher = $teacher_result->fetch_assoc();

// ดึงข้อมูลคำค้นหาจากฟอร์ม
$search = isset($_POST['search']) ? $_POST['search'] : '';
$view_option = isset($_POST['view_option']) ? $_POST['view_option'] : 'all';

// ปรับคำสั่ง SQL สำหรับการค้นหานิสิต
if ($view_option == 'advisor') {
    // ค้นหานิสิตที่เป็นที่ปรึกษาของอาจารย์
    $students_query = "SELECT * FROM student WHERE Major_id = ? AND Tec_id = ? AND (Std_id LIKE ? OR Std_name LIKE ? OR Std_surname LIKE ?)";
    $like_search = "%" . $search . "%";
    $stmt = $conn->prepare($students_query);
    $stmt->bind_param("iisss", $teacher['Major_id'], $_SESSION['teacher_id'], $like_search, $like_search, $like_search);
} else {
    // ค้นหานิสิตทั้งหมดในสาขาวิชา
    $students_query = "SELECT * FROM student WHERE Major_id = ? AND (Std_id LIKE ? OR Std_name LIKE ? OR Std_surname LIKE ?)";
    $like_search = "%" . $search . "%";
    $stmt = $conn->prepare($students_query);
    $stmt->bind_param("isss", $teacher['Major_id'], $like_search, $like_search, $like_search);
}

$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['approve']) || isset($_POST['disapprove'])) {
        if (!isset($_POST['student_id']) || !is_numeric($_POST['student_id'])) {
            die("ข้อมูลไม่ถูกต้อง");
        }

        $student_id = intval($_POST['student_id']);
        $status = isset($_POST['approve']) ? 1 : 2;  // เปลี่ยนเป็นค่า 1 หรือ 2

        // ตรวจสอบสิทธิ์ในการอัปเดตสถานะนิสิต
        $check_query = "SELECT * FROM student WHERE Std_id = ? AND Major_id = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("ii", $student_id, $teacher['Major_id']);
        $stmt->execute();
        $check_result = $stmt->get_result();
        if ($check_result->num_rows === 0) {
            die("ไม่มีสิทธิ์เปลี่ยนสถานะนิสิตนี้");
        }

        // อัปเดตสถานะนิสิต
        $update_query = "UPDATE student SET Pro_status = ? WHERE Std_id = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ii", $status, $student_id);
        if ($stmt->execute()) {
            echo "อัปเดตสำเร็จ";
        } else {
            echo "เกิดข้อผิดพลาด";
        }
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบอนุมัติการออกฝึกสหกิจ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700&display=swap" rel="stylesheet">
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
            /* ลดขนาดฟอนต์ */
            padding: 0.25rem 0.5rem;
            /* ลดขนาดของ padding */
        }
    </style>
</head>

<body>

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
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="view_option">เลือกดูข้อมูล:</label>
                    <select name="view_option" id="view_option" class="form-control" onchange="this.form.submit()">
                        <option value="all" <?php echo $view_option == 'all' ? 'selected' : ''; ?>>ดูข้อมูลนิสิตทั้งหมดในสาขา</option>
                        <option value="advisor" <?php echo $view_option == 'advisor' ? 'selected' : ''; ?>>ดูเฉพาะนิสิตที่อาจารย์เป็นที่ปรึกษา</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="search">ค้นหานิสิต:</label>
                    <input type="text" class="form-control" name="search" id="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="ค้นหานิสิต (รหัสนิสิต, ชื่อ, นามสกุล)">
                </div>
            </div>
        </form>

        <table class="table table-hover table-bordered mt-4">
            <thead class="table-primary">
                <tr>
                    <th>ลำดับที่</th>
                    <th>รหัสนิสิต</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>สถานะ</th>
                    <?php if ($view_option == 'advisor'): ?>
                        <th>ดำเนินการ</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $i = 1;
                    while ($row = $result->fetch_assoc()): ?>
                        <tr id="student-<?php echo $row['Std_id']; ?>">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['Std_id']; ?></td>
                            <td><?php echo $row['Std_name'] . ' ' . $row['Std_surname']; ?></td>
                            <td id="status-<?php echo $row['Std_id']; ?>" class="<?php echo ($row['Pro_status'] == 1) ? 'text-success' : (($row['Pro_status'] == 2) ? 'text-danger' : ''); ?>">
                                <?php
                                if ($row['Pro_status'] == 1) {
                                    echo 'อนุมัติแล้ว';
                                } elseif ($row['Pro_status'] == 2) {
                                    echo 'ไม่อนุมัติ';
                                } else {
                                    echo 'รอการอนุมัติ';
                                }
                                ?>
                            </td>
                            <?php if ($view_option == 'advisor'): ?>
                                <td>
                                    <a href="Std_details.php?Std_id=<?php echo $row['Std_id']; ?>" class="btn btn-info">ดูรายละเอียด</a>
                                    <button class="btn btn-approve" data-id="<?php echo $row['Std_id']; ?>">อนุมัติ</button>
                                    <button class="btn btn-disapprove" data-id="<?php echo $row['Std_id']; ?>">ไม่อนุมัติ</button>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-danger">ไม่พบผลลัพธ์ที่ตรงกับคำค้น</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).on("click", ".btn-approve, .btn-disapprove", function() {
            var studentId = $(this).data("id");
            var action = $(this).hasClass("btn-approve") ? "approve" : "disapprove";

            $.ajax({
                url: 'approval_system.php',
                method: 'POST',
                data: {
                    student_id: studentId,
                    [action]: true
                },
                success: function(response) {
                    $("#status-" + studentId).text(action === "approve" ? "อนุมัติแล้ว" : "ไม่อนุมัติ")
                        .removeClass("text-danger text-success")
                        .addClass(action === "approve" ? "text-success" : "text-danger");
                    alert("อัปเดตสถานะสำเร็จ");
                }
            });
        });
    </script>
</body>

</html>