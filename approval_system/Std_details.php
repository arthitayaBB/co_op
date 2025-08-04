<?php
include 'connectdb.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$std_id = isset($_GET['Std_id']) ? trim($_GET['Std_id']) : '';
$std_id = strtolower($std_id);

if (!preg_match('/^[a-z0-9]+$/', $std_id)) {
    die("Invalid student ID.");
}

// ดึงข้อมูล proposal
$sql = "SELECT * FROM proposal WHERE LOWER(Std_id) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $std_id);
$stmt->execute();
$result = $stmt->get_result();

// เตรียม query ดึงชื่อบริษัท
$sql_company = "SELECT NamecomTH FROM company WHERE company_id = ?";
$stmt_company = $conn->prepare($sql_company);

// เตรียม query ดึงชื่อ + นามสกุลอาจารย์ที่ปรึกษา 2 คน
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
$stmt_advisor->bind_param("s", $std_id);
$stmt_advisor->execute();
$result_advisor = $stmt_advisor->get_result();
$advisor_data = $result_advisor->fetch_assoc();
$advisor1 = $advisor_data['advisor1'] ?? 'ไม่มีข้อมูล';
$advisor2 = $advisor_data['advisor2'] ?? 'ไม่มีข้อมูล';

?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ดูผลงานนิสิต</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #e6f7ff);
            font-family: 'Kanit', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            background-color: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 1.5rem;
            border-radius: 15px 15px 0 0;
        }

        .card-body {
            padding: 30px;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: left;
            font-size: 1rem;
        }

        .btn-back {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: inline-block;
            transition: transform 0.3s ease;
            text-align: center;
            border: none;
        }

        .btn-back:hover {
            transform: translateY(-3px);
        }

        .btn-download {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
            padding: 12px 18px;
            width: 200px;
            text-align: center;
            border: none;
        }

        .btn-show {
            background: linear-gradient(135deg, #17a2b8, #138496);
            color: white;
            padding: 12px 18px;
            width: 200px;
            text-align: center;
            border: none;
        }

        .btn-download:hover,
        .btn-show:hover {
            transform: translateY(-3px);
        }

        .alert-warning {
            background-color: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 8px;
            font-size: 1.1rem;
        }

        h2 {
            color: #0056b3;
            font-weight: 600;
            margin-bottom: 30px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <a href="approval_system.php" class="btn btn-back">กลับ</a>
        <h2 class="text-center mb-4">โปรเจกต์ของนิสิตรหัส <?php echo htmlspecialchars($std_id); ?></h2>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $stmt_company->bind_param("s", $row["Company_id"]);
                $stmt_company->execute();
                $result_company = $stmt_company->get_result();
                $company_name = $result_company->num_rows > 0 ? $result_company->fetch_assoc()["NamecomTH"] : 'ไม่มีข้อมูล';

                $stmt_advisor->bind_param("s", $row["Tec_id"]);
                $stmt_advisor->execute();
                $result_advisor = $stmt_advisor->get_result();
                $advisor_name = $result_advisor->num_rows > 0 ? $result_advisor->fetch_assoc()["Tec_name"] : 'ไม่มีข้อมูล';

                $note = isset($row["Note"]) ? htmlspecialchars($row["Note"]) : 'ไม่มีข้อมูล';

                echo "
                <div class='card'>
                    <div class='card-header'>
                        <h5>ชื่อโปรเจกต์: " . htmlspecialchars($row["Proposal_name"]) . "</h5>
                    </div>
                    <div class='card-body'>
                        <table class='table table-bordered'>
                            <tr>
                                <th>Proposal ID</th>
                                <td>" . htmlspecialchars($row["Proposal_id"]) . "</td>
                            </tr>
                            <tr>
                                <th>ชื่อโปรเจกต์</th>
                                <td>" . htmlspecialchars($row["Proposal_name"]) . "</td>
                            </tr>
                            <tr>
                                <th>รหัสนิสิต</th>
                                <td>" . htmlspecialchars($row["Std_id"]) . "</td>
                            </tr>
                            <tr>
                                <th>ปีการศึกษา</th>
                                <td>" . htmlspecialchars($row["Sug_year"]) . "</td>
                            </tr>
                            <tr>
                                <th>ชื่อบริษัท</th>
                                <td>" . htmlspecialchars($company_name) . "</td>
                            </tr>
                            <tr>
                                <th>อาจารย์ที่ปรึกษา</th>
                                 <td>" . htmlspecialchars($advisor1) . " และ <br>" . htmlspecialchars($advisor2) . "</td>
                            </tr>
                            <tr>
                                <th>ไฟล์โปรเจกต์</th>
                                <td>

                                    <a href='../uploads/project/" . htmlspecialchars($row["File_name"]) . "' class='btn btn-show' target='_blank'>เปิดดู</a>
                                </td>
                            </tr>
                            <tr>
                                <th>หมายเหตุ</th>
                                <td>
                                    <form action='save_comment.php' method='POST'>
                                        <input type='hidden' name='Proposal_id' value='" . htmlspecialchars($row["Proposal_id"]) . "'>
                                        <textarea name='comment' rows='3' class='form-control' placeholder='ข้อเสนอแนะของอาจารย์'>" . htmlspecialchars($note) . "</textarea>
                                        <button type='submit' class='btn btn-primary mt-2'>บันทึกหมายเหตุ</button>
                                    </form>
                                </td>

                            </tr>
                        </table>
                    </div>
                </div>";
            }
        } else {
            echo "<div class='alert-warning'>ไม่พบข้อมูลโครงร่างสำหรับนิสิตรหัสนี้</div>";
        }
        $stmt->close();
        $stmt_company->close();
        $stmt_advisor->close();
        $conn->close();
        ?>
    </div>
</body>

</html>