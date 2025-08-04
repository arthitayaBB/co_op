<?php
include 'check_admin.php';
include 'connectdb.php';

if (isset($_GET['id'])) {
    $proposal_id = (int)$_GET['id'];

    // ค้นหาชื่อไฟล์ก่อนเพื่อลบออกจากโฟลเดอร์
    $sqlSelect = "SELECT File_name FROM proposal WHERE Proposal_id = $proposal_id";
    $result = mysqli_query($conn, $sqlSelect);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_name = $row['File_name'];
        $file_path = "../uploads/project/" . $file_name;

        // ลบไฟล์จากโฟลเดอร์ (ถ้ามีอยู่)
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลจากฐานข้อมูล
        $sqlDelete = "DELETE FROM proposal WHERE Proposal_id = $proposal_id";
        if (mysqli_query($conn, $sqlDelete)) {
            echo "<script>alert('ลบข้อมูล Proposal สำเร็จ'); window.location.href = 'indexproposal.php';</script>";
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูล');</script>";
        }
    } else {
        echo "<script>alert('ไม่พบข้อมูล Proposal ที่ต้องการลบ');</script>";
    }
} else {
    echo "<script>alert('ไม่พบรหัส Proposal ที่ต้องการลบ'); window.location.href = 'indexproposal.php';</script>";
}
?>
