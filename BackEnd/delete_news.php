<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // ดึงชื่อไฟล์รูปจากฐานข้อมูลก่อนลบ
    $check_query = "SELECT N_picture FROM news WHERE N_id = '$news_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $image_path = "imgnews/" . $row['N_picture']; // ที่อยู่ของไฟล์ (เปลี่ยนเป็นโฟลเดอร์ที่คุณใช้)

        // ลบไฟล์รูปภาพ ถ้าไฟล์มีอยู่จริง
        if (!empty($row['N_picture']) && file_exists($image_path)) {
            unlink($image_path);
        }

        // ลบข้อมูลออกจากฐานข้อมูล
        $delete_query = "DELETE FROM news WHERE N_id = '$news_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            echo "<script>
                alert('ลบข้อมูลและรูปภาพเรียบร้อยแล้ว');
                window.location.href = 'indexnews.php';
            </script>";
        } else {
            echo "<script>
                alert('เกิดข้อผิดพลาดในการลบข้อมูล');
                window.location.href = 'indexnews.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('ไม่พบข้อมูลที่ต้องการลบ');
            window.location.href = 'indexnews.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ไม่มีรหัสข่าวที่ถูกระบุ');
        window.location.href = 'indexnews.php';
    </script>";
}

mysqli_close($conn);
?>
