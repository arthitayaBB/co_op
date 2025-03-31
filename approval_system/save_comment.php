<?php
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $proposal_id = isset($_POST['Proposal_id']) ? trim($_POST['Proposal_id']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    // ตรวจสอบว่ามีการกรอก Proposal_id และ comment หรือไม่
    if (empty($proposal_id) || empty($comment)) {
        echo "กรุณากรอกข้อมูลให้ครบถ้วน";
        exit();
    }

    // ตรวจสอบว่า Proposal_id เป็นตัวเลขที่ถูกต้อง
    if (!is_numeric($proposal_id)) {
        echo "รหัสข้อเสนอไม่ถูกต้อง";
        exit();
    }

    // ตรวจสอบว่า Proposal_id ตรงกับ Std_id ในตาราง proposal หรือไม่
    $check_sql = "SELECT s.Std_id, s.Std_name FROM proposal p JOIN student s ON p.Std_id = s.Std_id WHERE p.Proposal_id = ?";
    if ($stmt_check = $conn->prepare($check_sql)) {
        $stmt_check->bind_param("i", $proposal_id);
        $stmt_check->execute();
        $stmt_check->store_result();

        // ถ้าไม่พบ Proposal_id ที่ตรงกับ Std_id
        if ($stmt_check->num_rows == 0) {
            echo "รหัสข้อเสนอนี้ไม่ถูกต้อง หรือ Std_id ไม่ตรงกับข้อมูลในระบบ";
            exit();
        }

        // ดึงข้อมูล Std_id และ Student_name
        $stmt_check->bind_result($std_id, $student_name);
        $stmt_check->fetch();

        $stmt_check->close();
    } else {
        // เพิ่มข้อความแสดงข้อผิดพลาดเมื่อไม่สามารถเตรียมคำสั่ง SQL ได้
        echo "ไม่สามารถเชื่อมต่อกับฐานข้อมูลในการตรวจสอบข้อมูล โปรดลองใหม่";
        error_log("SQL Error: " . $conn->error);  // บันทึกข้อผิดพลาดที่เกิดขึ้นใน log
        exit();
    }

    // ถ้า Proposal_id ตรงกับ Std_id ในฐานข้อมูล
    $sql = "UPDATE proposal SET Note = ? WHERE Proposal_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $comment, $proposal_id);

        if ($stmt->execute()) {
            // อัปเดตสำเร็จ
            echo "<script>
                    alert('อัปเดตข้อมูลสำเร็จ!');
                    window.location.href = 'Std_details.php?Std_id=" . $std_id . "';
                  </script>";
            exit();
        } else {
            // บันทึกข้อมูลล้มเหลว
            error_log("SQL Error: " . $stmt->error);  // บันทึกข้อผิดพลาดที่เกิดขึ้นใน log
            echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่อีกครั้ง";
        }

        $stmt->close();
    } else {
        // ถ้าไม่สามารถเตรียมคำสั่ง SQL ได้
        error_log("SQL Preparation Error: " . $conn->error);  // บันทึกข้อผิดพลาดที่เกิดขึ้นใน log
        echo "เกิดข้อผิดพลาดในการเตรียมคำสั่ง SQL กรุณาลองใหม่อีกครั้ง";
    }
}

$conn->close();
?>
