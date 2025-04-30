<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['id'])) {
    $work_id = $_GET['id'];

    // ดึงชื่อไฟล์รูปภาพและ PDF จากฐานข้อมูล
    $check_query = "SELECT Work_picture, Work_File FROM student_work WHERE Work_id = '$work_id'";
    $check_result = mysqli_query($conn, $check_query);

    if ($check_result && mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $image_path = "../images/pic_stdwork/" . $row['Work_picture'];
        $file_path = "../uploads/std_workfile/" . $row['Work_File'];

        // ลบไฟล์รูปภาพ
        if (!empty($row['Work_picture']) && file_exists($image_path)) {
            unlink($image_path);
        }

        // ลบไฟล์ PDF
        if (!empty($row['Work_File']) && file_exists($file_path)) {
            unlink($file_path);
        }

        // ลบข้อมูลจากฐานข้อมูล
        $delete_query = "DELETE FROM student_work WHERE Work_id = '$work_id'";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            echo "<script>
                alert('ลบข้อมูลผลงานนิสิตเรียบร้อยแล้ว');
                window.location.href = 'indexstudentwork.php';
            </script>";
        } else {
            echo "<script>
                alert('เกิดข้อผิดพลาดในการลบข้อมูล');
                window.location.href = 'indexstudentwork.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('ไม่พบข้อมูลผลงานนิสิตที่ต้องการลบ');
            window.location.href = 'indexstudentwork.php';
        </script>";
    }
} else {
    echo "<script>
        alert('ไม่มีรหัสผลงานที่ถูกระบุ');
        window.location.href = 'indexstudentwork.php';
    </script>";
}

mysqli_close($conn);
?>
