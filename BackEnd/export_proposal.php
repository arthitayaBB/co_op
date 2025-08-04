<?php
include 'connectdb.php';
include 'check_admin.php';

// รับค่า year จาก URL
$year = isset($_GET['year']) ? $_GET['year'] : '';

// สร้าง SQL query
$sql = "SELECT p.Proposal_id, p.Proposal_name, p.File_name, p.Sug_year, p.Std_id, p.Company_id, p.Pro_status, 
               p.Note, p.Com_status, s.Std_name, s.Std_surname, c.NamecomTH
        FROM proposal p
        LEFT JOIN student s ON p.Std_id = s.Std_id
        LEFT JOIN company c ON p.Company_id = c.Company_id";

// ถ้าเลือกปีการศึกษาให้กรองตามปี
if ($year != '') {
    $sql .= " WHERE p.Sug_year = " . intval($year);
}

$sql .= " ORDER BY p.Sug_year DESC, p.Proposal_id";

// ดึงข้อมูลจากฐานข้อมูล
$result = $conn->query($sql);

// ตรวจสอบว่ามีข้อมูลหรือไม่
if ($result->num_rows > 0) {
    // ตั้งชื่อไฟล์ CSV
    $filename = "proposal_report_" . ($year != '' ? $year : 'all_years') . ".csv";

    // Header สำหรับ CSV
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    // ใส่ BOM เพื่อให้ Excel อ่านภาษาไทยถูกต้อง
    fwrite($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    // หัวรายงาน
    fputcsv($output, ['รายงาน Proposal']);
    fputcsv($output, []); // บรรทัดว่าง

    // หัวตาราง
    $headers = ['ลำดับ','ปีการศึกษา', 'รหัสนิสิต', 'ชื่อ-นามสกุล','ชื่อโปรเจค', 'ไฟล์แนบ','สถานะการอนุมัติ', 'รหัสสถานประกอบการ', 'ชื่อสถานประกอบการ',  'สถานะสถานประกอบการ', 'หมายเหตุ'];
    
    // แปรข้อมูลแยกตามปีการศึกษา (ถ้าไม่เลือกปี ให้แยกข้อมูลตามปี)
    $currentYear = ''; // เก็บปีการศึกษาปัจจุบัน
    $counter = 1;  // ลำดับ (เริ่มจาก 1)

    $hasPrintedHeader = false;  // ตรวจสอบว่าได้พิมพ์หัวตารางแล้วหรือยัง

    while ($row = $result->fetch_assoc()) {
        // ถ้าเปลี่ยนปีการศึกษาให้แยกข้อมูลด้วยปีการศึกษา
        if ($currentYear != $row['Sug_year']) {
            // ถ้ามีข้อมูลแล้วและเป็นการเปลี่ยนปีการศึกษาใหม่
            if ($currentYear != '' && $hasPrintedHeader) {
                fputcsv($output, []); // เว้นบรรทัดก่อนปีการศึกษาใหม่
            }

            fputcsv($output, ['=== ปีการศึกษา: ' . $row['Sug_year'] . ' ===']);
            fputcsv($output, $headers); // หัวตาราง
            $currentYear = $row['Sug_year'];
            $counter = 1;  // รีเซ็ตลำดับเป็น 1 สำหรับปีการศึกษานั้น ๆ
            $hasPrintedHeader = true;  // พิมพ์หัวตารางแล้ว
        }

        // เปลี่ยนสถานะการอนุมัติ (Pro_status)
        switch ($row['Pro_status']) {
            case '0': $status = 'ไม่อนุมัติ'; break;
            case '1': $status = 'อนุมัติ'; break;
            case '2': $status = 'แก้ไข'; break;
            case '3': $status = 'รอตรวจสอบ'; break;
            case '4': $status = 'ยังไม่เพิ่มโปรเจค'; break;
            default: $status = 'ไม่มีข้อมูล';
        }

        // เปลี่ยนสถานะสถานประกอบการ (Com_status)
        switch ($row['Com_status']) {
            case '0': $com_status = 'ไม่อนุมัติ'; break;
            case '1': $com_status = 'อนุมัติ'; break;
            case '2': $com_status = 'แก้ไข'; break;
            case '3': $com_status = 'รอตรวจสอบ'; break;
            case '4': $com_status = 'ไม่มีข้อมูล'; break;
            default: $com_status = 'ไม่มีข้อมูล';
        }

        // แปลงรหัสนิสิต (Std_id) ให้เป็น string 
        $row['Std_id'] = '="' . $row['Std_id'] . '"';

        // เขียนข้อมูลลงใน CSV
        fputcsv($output, [
            $counter, // ลำดับ
            $row['Sug_year'],
            $row['Std_id'],
            $row['Std_name'] . ' ' . $row['Std_surname'], 
            $row['Proposal_name'],
            $row['File_name'],
            $status,
            $row['Company_id'],
            $row['NamecomTH'],
            $com_status,
            $row['Note']
        ]);

        $counter++; // เพิ่มลำดับ
    }

    fclose($output);
} else {
    echo "ไม่มีข้อมูล";
}

$conn->close();
?>
