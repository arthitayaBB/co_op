<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    // ตรวจสอบว่า status มีค่าถูกต้องหรือไม่ (ควรเป็น 0 หรือ 1 เท่านั้น)
    if ($status == 0 || $status == 1) {
        $query = "UPDATE news SET N_status = '$status' WHERE N_id = '$id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>alert('อัปเดตสถานะเรียบร้อย'); window.location.href='indexnews.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "'); window.location.href='indexnews.php';</script>";
        }
    } else {
        echo "<script>alert('ค่า status ไม่ถูกต้อง'); window.location.href='indexnews.php';</script>";
    }
} else {
    echo "<script>alert('ข้อมูลไม่ครบถ้วน'); window.location.href='indexnews.php';</script>";
}

mysqli_close($conn);
?>