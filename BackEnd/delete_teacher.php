<?php
include 'connectdb.php';
include 'check_admin.php';
if (isset($_GET['id'])) {
    $teacher_id = $_GET['id'];

    // ดึงชื่อไฟล์รูปจากฐานข้อมูลก่อนลบ
    $check_query = "SELECT Tec_picture FROM teacher WHERE Tec_id = '$teacher_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $image_path = "img_teacher/" . $row['Tec_picture']; // ที่อยู่ของไฟล์ (เปลี่ยนเป็นโฟลเดอร์ที่คุณใช้)

        // ลบไฟล์รูปภาพ ถ้าไฟล์มีอยู่จริง
        if (!empty($row['Tec_picture']) && file_exists($image_path)) {
            unlink($image_path);
        }

        // ลบข้อมูลออกจากฐานข้อมูล
        $delete_query = "DELETE FROM teacher WHERE Tec_id = '$teacher_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            echo "<script>
                alert('ลบข้อมูลอาจารย์เรียบร้อยแล้ว');
                window.location.href = 'indexteacher.php';
            </script>";
        } else {
            echo "<script>
                alert('เกิดข้อผิดพลาดในการลบข้อมูล');
                window.location.href = 'indexteacher.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('ไม่พบข้อมูลอาจารย์ที่ต้องการลบ');
            window.location.href = 'indexteacher.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ไม่มีรหัสอาจารย์ที่ถูกระบุ');
        window.location.href = 'indexteacher.php';
    </script>";
}

mysqli_close($conn);
?>
