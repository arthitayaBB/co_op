<?php
include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
    $id = intval($_POST['id']);
    $status = intval($_POST['status']);

    $sql = "UPDATE intro SET I_status = $status WHERE Intro_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'invalid';
}
