<?php
    session_start();
    
    unset($_SESSION['teacher_id']);
    
    echo "<script>";
    echo "window.location='../index.php'; "; // ใช้ ../ เพื่อนำทางออกจากโฟลเดอร์
    echo "</script>";
?>
