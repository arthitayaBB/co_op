<?php
session_start();
include 'connectdb.php';

if (!isset($_SESSION['teacher_id'])) {
    exit();
}

$search = isset($_POST['search']) ? $_POST['search'] : '';
$view_status = isset($_POST['view_status']) ? $_POST['view_status'] : '';

$students_query = "SELECT s.Std_id, s.Std_name, s.Std_surname, p.Pro_status
FROM student s
LEFT JOIN proposal p ON s.Std_id = p.Std_id
LEFT JOIN advisor a ON s.Std_id = a.Std_id
WHERE (a.Tec_id1 = ? OR a.Tec_id2 = ?)
AND (s.Std_id LIKE ? OR s.Std_name LIKE ? OR s.Std_surname LIKE ?)";

if ($view_status !== '') {
    $students_query .= " AND p.Pro_status = ?";
}

$stmt = $conn->prepare($students_query);
$search_param = "%$search%";
if ($view_status !== '') {
    $stmt->bind_param("iisssi", $_SESSION['teacher_id'], $_SESSION['teacher_id'], $search_param, $search_param, $search_param, $view_status);
} else {
    $stmt->bind_param("iisss", $_SESSION['teacher_id'], $_SESSION['teacher_id'], $search_param, $search_param, $search_param);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $i++ . '</td>';
        echo '<td>' . htmlspecialchars($row['Std_id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['Std_name'] . ' ' . $row['Std_surname']) . '</td>';
        echo '<td>';
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
        echo '</td>';
        echo '<td>';
        echo '<a href="Std_details.php?Std_id=' . $row['Std_id'] . '" class="btn btn-sm btn-info">ดูรายละเอียด</a> ';
        echo '<button class="btn btn-sm btn-warning edit-btn" data-student-id="' . $row['Std_id'] . '" data-status="2">แก้ไข</button> ';
        echo '<button class="btn btn-sm btn-success btn-approve" data-student-id="' . $row['Std_id'] . '" data-status="1">อนุมัติ</button> ';
        echo '<button class="btn btn-sm btn-danger btn-disapprove" data-student-id="' . $row['Std_id'] . '" data-status="0">ไม่อนุมัติ</button>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="5" class="text-center text-danger">ไม่พบข้อมูลนิสิต</td></tr>';
}
?>
