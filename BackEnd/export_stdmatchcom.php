<?php
include 'connectdb.php';
include 'check_admin.php';

// ตรวจสอบปีการศึกษาที่เลือก
$academicYearCondition = '';
$academicYearLabel = 'all'; // ตั้งค่าเริ่มต้น (กรณีไม่ได้เลือก)

if (isset($_GET['yearstd']) && !empty($_GET['yearstd'])) {  // <<< แก้ตรงนี้ให้รับ yearstd จากฟอร์ม
    $academicYear = intval($_GET['yearstd']);
    $academicYearCondition = "AND student.Academic_year = '$academicYear'";
    $academicYearLabel = $academicYear;
}

// ตั้งค่า header สำหรับดาวน์โหลด CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=student_company_report_' . $academicYearLabel . '.csv');

// ส่ง BOM
echo "\xEF\xBB\xBF";

$output = fopen('php://output', 'w');

// เขียนหัวตาราง
fputcsv($output, [
    'รหัสนิสิต',
    'คำนำหน้า',
    'ชื่อ',
    'นามสกุล',
    'ชื่อบริษัท (TH)',
    'สาขา',
    'ปีการศึกษา',
    'สถานะการได้งาน' // เพิ่มหัวข้อใหม่
]);

// ดึงข้อมูลจาก proposal, student, company, major, job_offer
$sql = "SELECT 
            student.Std_id,
            student.Std_prefix,
            student.Std_name,
            student.Std_surname,
            company.NamecomTH,
            major.Major_name,
            student.Academic_year,
            job_offer.Offer_status
        FROM proposal
        LEFT JOIN student ON proposal.Std_id = student.Std_id
        LEFT JOIN company ON proposal.Company_id = company.Company_id
        LEFT JOIN major ON student.Major_id = major.Major_id
        LEFT JOIN job_offer ON student.Std_id = job_offer.Std_id
        WHERE company.Company_id != 0
        $academicYearCondition
        ORDER BY student.Std_id ASC";

$result = $conn->query($sql);

// เขียนข้อมูลการจับคู่
while ($row = $result->fetch_assoc()) {
    $row['Std_id'] = '="' . $row['Std_id'] . '"'; // ป้องกันเลขหายใน Excel

    // แปลง Offer_status
    $offerStatus = '';
    if ($row['Offer_status'] == 1) {
        $offerStatus = 'ได้งาน';
    } elseif ($row['Offer_status'] == 2) {
        $offerStatus = 'ไม่ได้งาน';
    } elseif ($row['Offer_status'] == 3) {
        $offerStatus = 'เสนอแต่ไม่ได้รับ';
    } else {
        $offerStatus = 'ไม่มีข้อมูล';
    }

    fputcsv($output, [
        $row['Std_id'],
        $row['Std_prefix'],
        $row['Std_name'],
        $row['Std_surname'],
        $row['NamecomTH'],
        $row['Major_name'],
        $row['Academic_year'],
        $offerStatus
    ]);
}

fclose($output);
$conn->close();
exit();
?>
