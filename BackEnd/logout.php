<?php
session_start();
session_destroy(); // ทำการทำลายเซสชัน
header("Location: ../index.php"); // เปลี่ยนเส้นทางไปยังหน้าล็อกอิน
exit();
?>