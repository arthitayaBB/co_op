<?php
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
    $id = intval($_POST['id']);
    $status = intval($_POST['status']);

    $sql = "UPDATE news SET N_status = $status WHERE N_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid';
}
