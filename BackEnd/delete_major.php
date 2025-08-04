<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['id'])) {
    $Major_id = $_GET['id'];

    // เตรียมคำสั่ง SQL สำหรับลบข้อมูล
    $stmt = $conn->prepare("DELETE FROM major WHERE Major_id = ?");
    $stmt->bind_param("i", $Major_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('ลบข้อมูลเรียบร้อยแล้ว');
                window.location.href = 'indexmajor.php';
              </script>";
    } else {
        if ($conn->errno == 1451) {
            echo "<script>
                    alert('ไม่สามารถลบข้อมูลได้ เนื่องจากมีการเชื่อมโยงกับข้อมูลอื่นในระบบ');
                    window.location.href = 'indexmajor.php';
                  </script>";
        } else {
            echo "<script>
                    alert('เกิดข้อผิดพลาดในการลบข้อมูล: " . addslashes($conn->error) . "');
                    window.history.back();
                  </script>";
        }
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('ไม่มีข้อมูลที่ต้องการลบ');
            window.location.href = 'indexmajor.php';
          </script>";
}
