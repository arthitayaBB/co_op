<?php
include 'connectdb.php'; // เชื่อมต่อฐานข้อมูล
include 'check_admin.php';

if (isset($_GET['id'])) {
    $company_id = $_GET['id'];

    // ลบแถวใน advice ที่มี Company_id นี้
    $stmt_delete_advice = $conn->prepare("DELETE FROM advice WHERE Company_id = ?");
    $stmt_delete_advice->bind_param("i", $company_id);
    $stmt_delete_advice->execute();
    $stmt_delete_advice->close();

    // ลบแถวใน public_relations ที่มี Company_id นี้
    $stmt_delete_pr = $conn->prepare("DELETE FROM public_relations WHERE Company_id = ?");
    $stmt_delete_pr->bind_param("i", $company_id);
    $stmt_delete_pr->execute();
    $stmt_delete_pr->close();

    // เปลี่ยน Company_id ใน proposal เป็น NULL
    $stmt_update_proposal = $conn->prepare("UPDATE proposal SET Company_id = NULL WHERE Company_id = ?");
    $stmt_update_proposal->bind_param("i", $company_id);
    $stmt_update_proposal->execute();
    $stmt_update_proposal->close();

    // เปลี่ยน Company_id ใน student_work เป็น NULL
    $stmt_update_work = $conn->prepare("UPDATE student_work SET Company_id = NULL WHERE Company_id = ?");
    $stmt_update_work->bind_param("i", $company_id);
    $stmt_update_work->execute();
    $stmt_update_work->close();

    // ลบข้อมูลจาก company
    $stmt = $conn->prepare("DELETE FROM company WHERE Company_id = ?");
    $stmt->bind_param("i", $company_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('ลบข้อมูลเรียบร้อยแล้ว');
                window.location.href = 'indexcompany.php';
              </script>";
    } else {
        echo "<script>
                alert('เกิดข้อผิดพลาดในการลบข้อมูล');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>
            alert('ไม่มีข้อมูลที่ต้องการลบ');
            window.location.href = 'indexcompany.php';
          </script>";
}
?>
