<?php
include_once("connectdb.php");
session_start();

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;
$Std_id = $_SESSION['Std_id'];

// คิวรีข้อมูลจากฐานข้อมูล
$sql = "
    SELECT std.*, p.Com_status, p.Pro_status, p.Proposal_name, c.NamecomTH, c.Company_add, c.Province, c.Com_phone,c.NamecomEng
    FROM student std
    INNER JOIN proposal p ON std.Std_id = p.Std_id
    INNER JOIN company c ON p.Company_id = c.Company_id
    WHERE std.Std_id  = $Std_id
";



$result = mysqli_query($conn, $sql);
$p = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกสถานประกอบการ</title>
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<style>
    body {
        background-color: #f4f7fa;

    }

    .btn-group a {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
        border-radius: 50px;
        padding: 12px 25px;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .card-header {
        background-color: #FED32B;
        font-weight: bold;
        font-size: 1.5rem;
        text-align: center;
    }

    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: white;
        margin-top: 20px;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table {
        background-color: #fff;
        border-radius: 8px;
    }



    .btn-primary {
        background-color: #0066cc;
        /* สีน้ำเงิน */
        border-color: #005bb5;
    }

    .btn-primary:hover {
        background-color: #005bb5;
        border-color: #004c99;
    }

    .btn-blue {
        background-color: skyblue;
        /* สีเหลือง */
        border-color: skyblue;
        color: white;
    }

    .btn-blue:hover {
        background-color: rgb(0, 130, 230);
        border-color: rgb(0, 130, 230);
        color: white;

    }

    .status-label {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .status-approved {
        background-color: #28a745;
        color: white;
    }

    .status-rejected {
        background-color: #dc3545;
        color: white;
    }

    .status-pending {
        background-color: #ffc107;
        color: white;
    }

    .status-modification {
        background-color: #17a2b8;
        color: white;
    }

    .note-text {
        display: flex;
        gap: 5px;
        /* เพิ่มระยะห่างระหว่างข้อความและไอคอน */
        font-size: 1rem;
        /* ปรับขนาดตัวอักษร */
        color: #333;
        /* สีของข้อความ */
        justify-content: flex-end;
        /* จัดข้อความให้ไปทางขวามือ */
        width: 100%;
        /* ให้ span ใช้ความกว้างเต็ม */
        color: #dc3545;
    }


    @media (max-width: 1200px) {
        .btn-group a {
            padding: 10px 20px;
            font-size: 1rem;
        }

        .card-header {
            font-size: 1.3rem;
        }

        .table th,
        .table td {
            padding: 10px;
            font-size: 1rem;
        }

        .status-label {
            font-size: 0.9rem;
        }

        .note-text {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 768px) {
        .btn-group a {
            padding: 8px 15px;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .card-header {
            font-size: 1.2rem;
        }

        .table th,
        .table td {
            padding: 8px;
            font-size: 0.9rem;
        }

        .status-label {
            font-size: 0.8rem;
        }

        .note-text {
            font-size: 0.8rem;
        }

        .table-responsive {
            margin-top: 20px;
        }
    }

    @media (max-width: 480px) {
        .btn-group a {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .card-header {
            font-size: 1.1rem;
        }

        .table th,
        .table td {
            padding: 6px;
            font-size: 0.85rem;
        }

        .status-label {
            font-size: 0.7rem;
        }

        .note-text {
            font-size: 0.7rem;
        }

    }
</style>

<body>
    <?php include("navbar.php"); ?><br>

    <div class="container">
        <div class="btn-group">
            <a href="std_home.php" class="btn btn-primary">กลับหน้าหลัก</a>
            <a href="proposal.php" class="btn btn-secondary">ยื่นข้อเสนอ</a>
            <a href="chose_com.php" class="btn btn-blue">เลือกสถานประกอบการ</a>
        </div>

        <div class="card">
            <div class="card-header">
                เลือกสถานประกอบการ (<?php echo $p['Std_id'] . ' - ' . $p['Std_prefix'] . $p['Std_name'] . ' ' . $p['Std_surname']; ?>)
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                    <tr>
                        <th style="width: 150px;"> </th> <!-- ใช้ช่องว่างเล็กๆ ถ้าต้องการแค่เป็นช่องว่าง -->
                        <th style="width: 250px;">ชื่อสถานประกอบการ</th>
                        <th style="width: 300px;">ที่อยู่</th>
                        <th style="width: 150px;">จังหวัด</th>
                        <th style="width: 150px;">ติดต่อ</th>
                        <th style="width: 150px;">สถานะ</th>
                    </tr>
                    </tr>
                    <tr>
                        <td><a href="select_com.php?id=<?= $Std_id ?>" class="btn btn-link"><i class=" bi bi-building-add me-2 fs-4"></i>เลือกสถานประกอบการ</a></td>
                        <td><?php echo $p['NamecomTH'] . '<br>' . $p['NamecomEng'] ?></td>
                        <td><?php echo $p['Company_add']; ?></td>
                        <td>
                            <?php echo $p['Province']; ?>
                        </td>
                        <td>
                            <?php echo $p['Com_phone']; ?>
                        </td>

                        <td>
                            <?php echo "สถานะการขอยื่นฝึกฯ <br><br>";
                            $status = $p['Pro_status'];
                            switch ($status) {
                                case 0:
                                    echo "<span class='status-label status-rejected'>ไม่อนุมัติ</span>";
                                    break;
                                case 1:
                                    echo "<span class='status-label status-approved'>อนุมัติ</span>";
                                    break;
                                case 2:
                                    echo "<span class='status-label status-modification'>แก้ไข</span>";
                                    break;
                                case 3:
                                    echo "<span class='status-label status-pending'>รอตรวจสอบ</span>";
                                    break;
                                case 4:
                                    echo "<span class='status-label' style='background-color: gray;'>ไม่มีข้อมูล</span>";
                                    break;
                                default:
                                    echo "<span class='status-label' style='background-color: gray;'>ไม่มีข้อมูล</span>";
                            }
                            ?>
                            <hr>
                            <?php echo "สถานะการตอบรับจากสถานประกอบการ <br><br>";
                            $status = $p['Com_status'];
                            switch ($status) {
                                case 0:
                                    echo "<span class='status-label status-rejected'>ไม่อนุมัติ</span>";
                                    break;
                                case 1:
                                    echo "<span class='status-label status-approved'>อนุมัติ</span>";
                                    break;
                                case 2:
                                    echo "<span class='status-label status-modification'>แก้ไข</span>";
                                    break;
                                case 3:
                                    echo "<span class='status-label status-pending'>รอตรวจสอบ</span>";
                                    break;
                                case 4:
                                    echo "<span class='status-label' style='background-color: gray;'>ไม่มีข้อมูล</span>";
                                    break;
                                default:
                                    echo "<span class='status-label' style='background-color: gray;'>ไม่มีข้อมูล</span>";
                            }

                            ?>

                        </td>

                    </tr>
                </table>
            </div>
        </div> <br><span class="note-text">**หมายเหตุ คลิก <i class="bi bi-building-add"></i> เพื่อเลือกสถานประกอบการ</span>






        <?php include("footer.php"); ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="script.js"></script>
</body>

</html>