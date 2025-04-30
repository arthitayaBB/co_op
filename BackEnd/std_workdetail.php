<?php
include 'connectdb.php';
include 'check_admin.php';

$work_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "
SELECT sw.*, s.Std_name, s.Std_surname, s.Std_prefix, m.Major_name, c.NamecomTH
FROM student_work sw
INNER JOIN student s ON sw.Std_id = s.Std_id
INNER JOIN major m ON s.Major_id = m.Major_id
INNER JOIN company c ON sw.Company_id = c.Company_id 
WHERE sw.Work_id = $work_id
";

$result = mysqli_query($conn, $sql);
$work = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>รายละเอียดผลงานนิสิต</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background-color: #e9f5fb;
            /* ฟ้าอ่อนมาก */
            color: #333;
        }

        .card {
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.1);
        }

        .header {
            background: linear-gradient(90deg, #2C3E50, #3498DB);
            padding: 20px;
            color: white;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 0 0 10px 10px;
        }

        .label-title {
            color: #0077b6;
            /* ฟ้าน้ำทะเลเข้ม */
            font-weight: bold;
        }

        a.btn-primary {
            background-color: #00b4d8;
            border-color: #00b4d8;
        }

        a.btn-primary:hover {
            background-color: #0077b6;
            border-color: #0077b6;
        }

        a.btn-secondary {
            background-color: #adb5bd;
            border-color: #adb5bd;
        }

        a.btn-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .text-muted {
            color: #6c757d !important;
        }

        hr {
            border-top: 2px solid #90e0ef;
        }
    </style>

</head>

<body>

    <div class="header">
        <h2><i class="fas fa-file-alt"></i> รายละเอียดผลงานนิสิต</h2>
    </div>

    <div class="container">
        <div class="card shadow p-4">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <?php if (!empty($work['Work_picture'])): ?>
                        <img src="../images/pic_stdwork/<?= htmlspecialchars($work['Work_picture']) ?>"
                            alt="รูปผลงาน"
                            class="img-fluid rounded"
                            style="aspect-ratio: 16/9; object-fit: cover; max-width: 100%; height: auto;">
                    <?php else: ?>
                        <p class="text-muted">ไม่มีรูปผลงาน</p>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <h4 class="label-title"><?= htmlspecialchars($work['Work_name']) ?></h4>
                    <hr>
                    <p><span class="label-title">รายละเอียด:</span> <?= nl2br(htmlspecialchars($work['Work_detail'])) ?></p>
                    <p><span class="label-title">บริษัท:</span> <?= htmlspecialchars($work['NamecomTH']) ?></p>
                    <p><span class="label-title">นิสิต:</span> <?= htmlspecialchars($work['Std_prefix'] . ' ' . $work['Std_name'] . ' ' . $work['Std_surname']) ?></p>
                    <p><span class="label-title">สาขา:</span> <?= htmlspecialchars($work['Major_name']) ?></p>
                    <p><span class="label-title">วันที่:</span> <?= htmlspecialchars($work['Date']) ?></p>
                    <p><span class="label-title">ปีการศึกษา:</span> <?= htmlspecialchars($work['Work_year']) ?></p>

                    <?php if (!empty($work['Work_File'])): ?>
                        <a href="../uploads/std_workfile/<?= htmlspecialchars($work['Work_File']) ?>" target="_blank" class="btn btn-primary mt-3">
                            <i class="fas fa-file-pdf"></i> เปิดไฟล์ PDF
                        </a>
                    <?php else: ?>
                        <p class="text-muted mt-3">ไม่มีไฟล์แนบ</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="indexstudentwork.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> กลับ
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>