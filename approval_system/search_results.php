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

// รับคำค้นหาจาก URL
$searchTerm = isset($_GET['search']) ? $_GET['search'] : ''; 

// คำสั่ง SQL ค้นหานิสิต
$students_query = "SELECT * FROM student WHERE Major_id = ? AND (Std_id LIKE ? OR Std_name LIKE ? OR Std_surname LIKE ?)";
$stmt = $conn->prepare($students_query);
$searchTermWithWildcards = "%" . $searchTerm . "%";  // ใช้ % เพื่อค้นหาในคำ
$stmt->bind_param("isss", $teacher['Major_id'], $searchTermWithWildcards, $searchTermWithWildcards, $searchTermWithWildcards);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลลัพธ์การค้นหานิสิต</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="container mt-4">
        <div class="header text-center">
            <h2>ผลลัพธ์การค้นหานิสิต</h2>
            <p><strong>อาจารย์:</strong> <?php echo $teacher['Tec_name']; ?></p>
            <p><strong>สาขาวิชา:</strong> <?php echo $teacher['Major_name']; ?></p>
        </div>

        <table class="table table-hover table-bordered mt-4">
            <thead class="table-primary">
                <tr>
                    <th>ลำดับที่</th>
                    <th>รหัสนิสิต</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>สถานะ</th>
                    <th>ดำเนินการ</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $i = 1; while ($row = $result->fetch_assoc()): ?>
                    <tr id="student-<?php echo $row['Std_id']; ?>">
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['Std_id']; ?></td>
                        <td><?php echo $row['Std_name'] . ' ' . $row['Std_surname']; ?></td>
                        <td id="status-<?php echo $row['Std_id']; ?>" class="<?php echo ($row['status'] == 'อนุมัติแล้ว') ? 'text-success' : (($row['status'] == 'ไม่อนุมัติ') ? 'text-danger' : ''); ?>">
                            <?php echo $row['status'] ?: 'รอการอนุมัติ'; ?>
                        </td>
                        <td>
                            <a href="student_details.php?Std_id=<?php echo $row['Std_id']; ?>" class="btn btn-info">ดูรายละเอียด</a>
                            <button class="btn btn-approve" data-id="<?php echo $row['Std_id']; ?>">อนุมัติ</button>
                            <button class="btn btn-disapprove" data-id="<?php echo $row['Std_id']; ?>">ไม่อนุมัติ</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-danger">ไม่พบผลลัพธ์ที่ตรงกับคำค้นหา</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
