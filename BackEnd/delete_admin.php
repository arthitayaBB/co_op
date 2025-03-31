<?php
include 'connectdb.php'; // เชื่อมต่อฐานข้อมูล
include 'check_admin.php';

if (isset($_GET['id'])) {
    $company_id = $_GET['id'];

    // เตรียมคำสั่ง SQL สำหรับลบข้อมูล
    $stmt = $conn->prepare("DELETE FROM adminn WHERE Admin_id = ?");
    $stmt->bind_param("i", $company_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('ลบข้อมูลเรียบร้อยแล้ว');
                window.location.href = 'indexadmin.php';
              </script>";
    } else {
        echo "<script>
                alert('เกิดข้อผิดพลาดในการลบข้อมูล');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('ไม่มีข้อมูลที่ต้องการลบ');
            window.location.href = 'indexadmin.php';
          </script>";
}
?>
