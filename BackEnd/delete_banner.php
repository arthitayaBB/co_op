<?php
include 'connectdb.php'; // เชื่อมต่อฐานข้อมูล
include 'check_admin.php';

if (isset($_GET['id'])) {
  $Bn_id = intval($_GET['id']);

  // เตรียมคำสั่ง SQL สำหรับลบข้อมูล
  $stmt = $conn->prepare("DELETE FROM banner WHERE Bn_id = ?");
  $stmt->bind_param("i", $Bn_id);

  if ($stmt->execute()) {
    echo "<script>
                alert('ลบข้อมูลเรียบร้อยแล้ว');
                window.location.href = 'indexbanner.php';
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
            window.location.href = 'indexbanner.php';
          </script>";
}
