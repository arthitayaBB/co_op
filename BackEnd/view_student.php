<?php 
include 'connectdb.php';
include 'check_admin.php';

if (isset($_GET['Std_id'])) {
    $std_id = trim($_GET['Std_id']);
    $query = "SELECT * FROM student WHERE Std_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $std_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("❌ ไม่พบข้อมูลนิสิตที่รหัสนี้");
    }
    $major_query = "SELECT * FROM major WHERE Major_id = ?";
    $stmt = mysqli_prepare($conn, $major_query);
    mysqli_stmt_bind_param($stmt, "s", $row['Major_id']);
    mysqli_stmt_execute($stmt);
    $major_result = mysqli_stmt_get_result($stmt);
    $major_row = mysqli_fetch_assoc($major_result);
    $teacher_query = "SELECT * FROM teacher WHERE Tec_id = ?";
    $stmt = mysqli_prepare($conn, $teacher_query);
    mysqli_stmt_bind_param($stmt, "s", $row['Tec_id']);
    mysqli_stmt_execute($stmt);
    $teacher_result = mysqli_stmt_get_result($stmt);
    $teacher_row = mysqli_fetch_assoc($teacher_result);
} else {
    die("❌ ไม่ได้รับค่ารหัสนิสิต");
}
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

        .info-table td, .info-table th {
            padding: 12px 18px;
            font-size: 18px;
            vertical-align: top;
        }

        .info-table td:first-child, .info-table th:first-child {
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
            .print-btn {
                display: none;
            }

            .container {
                box-shadow: none;
                padding: 0;
            }

            .header-table td, .info-table td {
                font-size: 16px;
            }

            .photo-box {
                width: 100px;
                height: 130px;
            }

            .logo {
                width: 80px;
            }

            .report-title {
                font-size: 24px;
            }

            .sub-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

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
                        <img src="img_student/<?php echo $row['Std_picture']; ?>" alt="รูปประจำตัว">
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
            <td><?php echo $row['Std_id']; ?></td>
            <td>ชื่อ-นามสกุล</td>
            <td><?php echo $row['Std_prefix'].' '.$row['Std_name'].' '.$row['Std_surname']; ?></td>
        </tr>
        <tr>
            <td>สาขาวิชา</td>
            <td><?php echo $major_row['Major_name']; ?></td>
            <td>ระดับการศึกษา</td>
            <td><?php echo $row['Grade_level']; ?></td>
        </tr>
        <tr>
            <td>อาจารย์ที่ปรึกษา</td>
            <td><?php echo $teacher_row['Tec_name']; ?></td>
            <td>GPA</td>
            <td><?php echo $row['GPA']; ?></td>
        </tr>
        <tr>
            <td>GPAX</td>
            <td><?php echo $row['GPAX']; ?></td>
            <td>CGX</td>
            <td><?php echo $row['CGX']; ?></td>
        </tr>
        <tr>
            <td>เบอร์โทรศัพท์</td>
            <td><?php echo $row['Std_phone']; ?></td>
            <td>อีเมล์</td>
            <td><?php echo $row['Std_email']; ?></td>
        </tr>
        <tr>
            <td>ที่อยู่</td>
            <td><?php echo $row['Std_add']; ?></td>
            <td>จังหวัด</td>
            <td><?php echo $row['Province']; ?></td>
        </tr>
        <tr>
            <td>รหัสไปรษณีย์</td>
            <td><?php echo $row['Zip_id']; ?></td>
        </tr>
    </table>

    <button class="print-btn" onclick="window.print()"><i class="fas fa-print"></i> พิมพ์</button>
    <button class="print-btn cancel" onclick="window.location.href='student_details.php?Std_id=<?php echo $std_id; ?>'">
    <i class="fas fa-times-circle"></i> ยกเลิก
</button>

</div>

</body>
</html>
