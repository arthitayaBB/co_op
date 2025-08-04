<?php
include 'connectdb.php';

$search = $_GET['search'] ?? '';

$sql = "SELECT Std_id, Std_prefix, Std_name, Std_surname 
        FROM student 
        WHERE CONCAT(Std_id, ' ', Std_name, ' ', Std_surname) LIKE ? 
        ORDER BY Std_id ASC";

$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'id' => $row['Std_id'],
        'text' => $row['Std_id'] . ' - ' . $row['Std_prefix'] . $row['Std_name'] . ' ' . $row['Std_surname']
    ];
}

echo json_encode($data);
?>
