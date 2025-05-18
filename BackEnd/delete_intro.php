<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['id'])) {
    $Intro_id = intval($_GET['id']);

    // ค้นหารูปภาพก่อนลบ
    $query = "SELECT I_picture FROM intro WHERE Intro_id = $Intro_id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // ลบไฟล์ภาพถ้ามี
        if (!empty($row['I_picture'])) {
            $filePath = '../images/intro/' . $row['I_picture'];
            if (file_exists($filePath)) {
                unlink($filePath); // ลบไฟล์ภาพ
            }
        }

        // ลบข้อมูลในฐานข้อมูล
        $deleteSql = "DELETE FROM intro WHERE Intro_id = $Intro_id";
        if (mysqli_query($conn, $deleteSql)) {
            mysqli_close($conn);
            header("Location: indexintro.php?msg=deleted");
            exit();
        } else {
            die("ไม่สามารถลบข้อมูลได้: " . mysqli_error($conn));
        }
    } else {
        die("ไม่พบข้อมูลที่ต้องการลบ");
    }
} else {
    die("ไม่พบรหัส Intro_id ที่ต้องการลบ");
}
?>
