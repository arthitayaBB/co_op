<?php
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['id'])) {
    $Std_id = mysqli_real_escape_string($conn, $_GET['id']);

    // ดึงชื่อไฟล์รูปภาพจากฐานข้อมูล
    $pic_query = "SELECT Std_picture FROM student WHERE Std_id = '$Std_id'";
    $pic_result = mysqli_query($conn, $pic_query);
    $pic_data = mysqli_fetch_assoc($pic_result);

    if ($pic_data && !empty($pic_data['Std_picture'])) {
        $picture_path = '../profile_pic/' . $pic_data['Std_picture'];
        if (file_exists($picture_path)) {
            unlink($picture_path); // ลบไฟล์รูปภาพ
        }
    }

    // ลบข้อมูลจากตารางที่เกี่ยวข้อง
    mysqli_query($conn, "DELETE FROM job_offer WHERE Std_id = '$Std_id'");
    mysqli_query($conn, "DELETE FROM advisor WHERE Std_id = '$Std_id'");
    mysqli_query($conn, "DELETE FROM proposal WHERE Std_id = '$Std_id'");
    mysqli_query($conn, "DELETE FROM student_work WHERE Std_id = '$Std_id'"); 

    // ลบข้อมูลจากตาราง student
    $delete_student = "DELETE FROM student WHERE Std_id = '$Std_id'";
    if (mysqli_query($conn, $delete_student)) {
        echo "<script>
                alert('ลบนิสิตและข้อมูลที่เกี่ยวข้องเรียบร้อยแล้ว');
                window.location.href = 'indexstudent.php';
              </script>";
    } else {
        echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn);
    }
} else {
    echo "ไม่พบรหัสนิสิตที่ต้องการลบ";
}
?>
