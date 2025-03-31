<?php
include 'connectdb.php';
include 'check_admin.php';
// ตรวจสอบว่ามีการส่งค่า 'id' มาใน URL หรือไม่
if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // เตรียมคำสั่ง SQL สำหรับการลบข้อมูล
    $query = "DELETE FROM student WHERE Std_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    
    // ผูกค่ากับตัวแปร
    mysqli_stmt_bind_param($stmt, "s", $student_id);
    
    // ดำเนินการลบข้อมูล
    if (mysqli_stmt_execute($stmt)) {
        // ถ้าลบสำเร็จ
        echo "<script>alert('ข้อมูลนิสิตถูกลบเรียบร้อยแล้ว'); window.location.href = 'indexstudent.php';</script>";
    } else {
        // ถ้าลบไม่สำเร็จ
        echo "<script>alert('เกิดข้อผิดพลาดในการลบข้อมูล'); window.location.href = 'indexstudent.php';</script>";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_stmt_close($stmt);
} else {
    // ถ้าไม่มีค่า 'id' ใน URL ให้กลับไปที่หน้า indexstudent.php
    echo "<script>window.location.href = 'indexstudent.php';</script>";
}

mysqli_close($conn);
?>
