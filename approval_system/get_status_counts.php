<?php
session_start();
include 'connectdb.php';

// ดึงจำนวนสถานะจากฐานข้อมูล
$status_counts_query = "SELECT Pro_status, COUNT(*) as count 
                        FROM proposal 
                        WHERE Std_id IN (SELECT Std_id FROM advisor WHERE Tec_id1 = ? OR Tec_id2 = ?) 
                        GROUP BY Pro_status";
$stmt = $conn->prepare($status_counts_query);
$stmt->bind_param("ii", $_SESSION['teacher_id'], $_SESSION['teacher_id']);
$stmt->execute();
$status_counts_result = $stmt->get_result();
$status_counts = [0 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0];

while ($row = $status_counts_result->fetch_assoc()) {
    $status_counts[$row['Pro_status']] = $row['count'];
}

echo json_encode($status_counts);
?>
