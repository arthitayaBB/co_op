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
        $image_path = "img_teacher/" . $row['Tec_picture'];

        // ลบไฟล์รูปภาพ ถ้ามีอยู่จริง
        if (!empty($row['Tec_picture']) && file_exists($image_path)) {
            unlink($image_path);
        }

        $update_advisor_query = "
            UPDATE advisor 
            SET 
                Tec_id1 = CASE WHEN Tec_id1 = '$teacher_id' THEN NULL ELSE Tec_id1 END,
                Tec_id2 = CASE WHEN Tec_id2 = '$teacher_id' THEN NULL ELSE Tec_id2 END
            WHERE Tec_id1 = '$teacher_id' OR Tec_id2 = '$teacher_id';
        ";
        mysqli_query($conn, $update_advisor_query);

        // ลบข้อมูลอาจารย์
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
