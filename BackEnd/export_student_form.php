<?php
include 'connectdb.php';
include 'check_admin.php';

$academic_year = $_GET['year'] ?? null;

if ($academic_year) {
    $stmt = $conn->prepare("SELECT * FROM student WHERE Academic_year = ?");
    $stmt->bind_param("s", $academic_year);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $stmt = $conn->prepare("SELECT * FROM student");
    $stmt->execute();
    $result = $stmt->get_result();
}

$students = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>แบบคำร้องขอเข้าฝึกสหกิจศึกษา</title>
    <link href="https://fonts.googleapis.com/css2?family=Angsana+New:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Angsana New', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #000;
        }

        .container {
            width: 100%;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            page-break-after: always;
            /* แยกหน้าทุกคน */
        }

        .header-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo {
            width: 70px;
        }

        .report-title {
            text-align: left;
            font-weight: bold;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }

        .sub-title {
            text-align: left;
            font-weight: normal;
            font-size: 20px;
            margin: 5px 0 20px;
            padding: 0;
        }

        .photo-box {
            width: 100px;
            height: 130px;
            text-align: center;
            overflow: hidden;
            border-radius: 4px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .info-table td,
        .info-table th {
            padding: 12px 18px;
            font-size: 18px;
            vertical-align: top;
        }

        .info-table td:first-child,
        .info-table th:first-child {
            font-weight: bold;
        }

        .print-btn {
            display: inline-block;
            padding: 12px 24px;
            margin-top: 30px;
            font-size: 18px;
            font-weight: 600;
            background: linear-gradient(145deg, #5a8fdf, #4478b7);
            color: #fff;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            box-shadow: 2px 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .print-btn:hover {
            background: linear-gradient(145deg, #4478b7, #5a8fdf);
            transform: translateY(-5px);
            box-shadow: 3px 6px 20px rgba(0, 0, 0, 0.2);
        }

        .print-btn.cancel {
            background: linear-gradient(145deg, #e04d56, #c43a47);
        }

        .print-btn.cancel:hover {
            background: linear-gradient(145deg, #c43a47, #e04d56);
        }

        @media print {
            @page {
                size: A4;
                margin: 0;
                /* ไม่มีขอบกระดาษ */
            }

            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 210mm;
                /* ความกว้างกระดาษ A4 */
                min-height: 297mm;
                /* ความสูงกระดาษ A4 */
                margin: 0;
                padding: 20mm;
                /* ระยะห่างภายใน */
                box-shadow: none;
                page-break-after: always;
            }

            .print-btn,
            .print-btn.cancel,
            div[style*="text-align:center"] {
                display: none !important;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <?php foreach ($students as $row): ?>
        <?php
        // โหลด Major
        $major_query = "SELECT * FROM major WHERE Major_id = ?";
        $stmt_major = $conn->prepare($major_query);
        $stmt_major->bind_param("s", $row['Major_id']);
        $stmt_major->execute();
        $major_result = $stmt_major->get_result();
        $major_row = $major_result->fetch_assoc();

        // โหลด Advisor
        $sql_advisor = "
        SELECT 
            CONCAT(t1.Tec_name, ' ', t1.Tec_surname) AS advisor1, 
            CONCAT(t2.Tec_name, ' ', t2.Tec_surname) AS advisor2
        FROM advisor a
        LEFT JOIN teacher t1 ON a.Tec_id1 = t1.Tec_id
        LEFT JOIN teacher t2 ON a.Tec_id2 = t2.Tec_id
        WHERE LOWER(a.Std_id) = ?
    ";
        $stmt_advisor = $conn->prepare($sql_advisor);
        $stmt_advisor->bind_param("s", $row['Std_id']);
        $stmt_advisor->execute();
        $result_advisor = $stmt_advisor->get_result();
        $advisor_data = $result_advisor->fetch_assoc();
        $advisor1 = $advisor_data['advisor1'] ?? 'ไม่มีข้อมูล';
        $advisor2 = $advisor_data['advisor2'] ?? 'ไม่มีข้อมูล';
        ?>

        <div class="container">
            <table class="header-table">
                <tr>
                    <td style="width: 15%;">
                        <img src="img/mbs.png" alt="University Logo" class="logo">
                    </td>
                    <td style="width: 70%;">
                        <h1 class="report-title">สหกิจศึกษา คณะการบัญชีและการจัดการ มหาวิทยาลัยมหาสารคาม</h1>
                        <p class="sub-title">แบบคำร้องขอเข้าฝึกสหกิจศึกษา</p>
                    </td>
                    <td style="width: 15%; text-align: right;">
                        <div class="photo-box">
                            <?php if (!empty($row['Std_picture'])) { ?>
                                <img src="../profile_pic/<?php echo $row['Std_picture']; ?>" alt="รูปประจำตัว">
                            <?php } else { ?>
                                <p>ไม่มีรูป</p>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            </table>

            <table class="info-table">
                <tr>
                    <td>รหัสนิสิต</td>
                    <td><?php echo htmlspecialchars($row['Std_id']); ?></td>
                    <td>ชื่อ-นามสกุล</td>
                    <td><?php echo htmlspecialchars($row['Std_prefix'] . ' ' . $row['Std_name'] . ' ' . $row['Std_surname']); ?></td>
                </tr>
                <tr>
                    <td>สาขาวิชา</td>
                    <td><?php echo htmlspecialchars($major_row['Major_name']); ?></td>
                    <td>ระดับการศึกษา</td>
                    <td><?php echo htmlspecialchars($row['Grade_level']); ?></td>
                </tr>
                <tr>
                    <td>อาจารย์ที่ปรึกษา</td>
                    <td>
                        <?php
                        $advisors = [];

                        if (!empty($advisor1) && $advisor1 !== 'ไม่มีข้อมูล') {
                            $advisors[] = htmlspecialchars($advisor1);
                        }

                        if (!empty($advisor2) && $advisor2 !== 'ไม่มีข้อมูล') {
                            $advisors[] = htmlspecialchars($advisor2);
                        }

                        if (count($advisors) === 1) {
                            echo $advisors[0];
                        } elseif (count($advisors) === 2) {
                            echo '1. ' . $advisors[0] . '<br>2. ' . $advisors[1];
                        } else {
                            echo 'ไม่มีข้อมูล';
                        }
                        ?>
                    </td>

                    <td>GPA</td>
                    <td><?php echo htmlspecialchars($row['GPA']); ?></td>
                </tr>
                <tr>
                    <td>GPAX</td>
                    <td><?php echo htmlspecialchars($row['GPAX']); ?></td>
                    <td>CGX</td>
                    <td><?php echo htmlspecialchars($row['CGX']); ?></td>
                </tr>
                <tr>
                    <td>เบอร์โทรศัพท์</td>
                    <td><?php echo htmlspecialchars($row['Std_phone']); ?></td>
                    <td>อีเมล์</td>
                    <td><?php echo htmlspecialchars($row['Std_email']); ?></td>
                </tr>
                <tr>
                    <td>ที่อยู่</td>
                    <td><?php echo htmlspecialchars($row['Std_add']); ?></td>
                    <td>จังหวัด</td>
                    <td><?php echo htmlspecialchars($row['Province']); ?></td>
                </tr>
                <tr>
                    <td>รหัสไปรษณีย์</td>
                    <td><?php echo htmlspecialchars($row['Zip_id']); ?></td>
                </tr>
            </table>
        </div>

    <?php endforeach; ?>

    <div style="text-align:center; margin-top: 20px;">
        <button class="print-btn" onclick="window.print()">
            <i class="fas fa-print"></i> พิมพ์
        </button>

    </div>

</body>

</html>