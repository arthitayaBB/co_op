<?php
header('Content-Type: application/json');
include 'connectdb.php';
include 'check_admin.php';

$status_definitions = [
    1 => ['label' => 'ตอบรับ', 'icon' => 'bi-check-circle-fill', 'color' => 'text-success'],
    0 => ['label' => 'ไม่อนุมัติ', 'icon' => 'bi-x-circle-fill', 'color' => 'text-danger'],
    2 => ['label' => 'แก้ไข', 'icon' => 'bi-pencil-square', 'color' => 'text-warning'],
    3 => ['label' => 'รอตรวจสอบ', 'icon' => 'bi-hourglass-split', 'color' => 'text-secondary'],
    4 => ['label' => 'ยังไม่เลือกสถานประกอบการ', 'icon' => 'bi-building-exclamation', 'color' => 'text-danger'],
];

$year = isset($_GET['year']) ? $_GET['year'] : date("Y");
$results = [];

foreach ($status_definitions as $code => $info) {
    $query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM proposal WHERE Com_status = $code AND Sug_year = '$year'");
    $count = 0;
    if ($query && $row = mysqli_fetch_assoc($query)) {
        $count = $row['total'];
    }

    $results[] = [
        'label' => $info['label'],
        'icon' => $info['icon'],
        'color' => $info['color'],
        'count' => $count
    ];
}

echo json_encode($results);
