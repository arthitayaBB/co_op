<?php
include 'connectdb.php';

if (isset($_POST['student_id']) && isset($_POST['status'])) {
    $student_id = $_POST['student_id'];
    $status = $_POST['status'];

    $update_query = "UPDATE proposal SET Pro_status = ? WHERE Std_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("ii", $status, $student_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid_request';
}
?>
