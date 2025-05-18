<?php
include_once("connectdb.php");
include ("checklogin.php");

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
$Std_id = isset($_SESSION['Std_id']) ? intval($_SESSION['Std_id']) : 0;
$Std_id = $_SESSION['Std_id'];

$sql = "
    SELECT 
        std.*, 
        p.Pro_status, 
        p.Com_status,
        c.NamecomTH, 
        c.NamecomEng, 
        c.Company_add, 
        c.Province, 
        c.Com_phone 
    FROM student std
    INNER JOIN proposal p ON std.Std_id = p.Std_id
    LEFT JOIN company c ON p.Company_id = c.Company_id

    WHERE std.Std_id = $Std_id
";



$result = mysqli_query($conn, $sql);
$std = mysqli_fetch_assoc($result);
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

    .custom-tab {
        background-color: #e6f2ff;
    
        padding: 10px 18px;
        border: none;
        border-radius: 12px 12px 0 0;
        margin-right: 6px;
        color: #0056b3;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        transition: all 0.2s ease-in-out;
    }

    .custom-tab:hover {
        background-color: #d0e7ff;
        color: #004080;
    }

    .custom-tab.active {
        background-color: #007bff;
        /* สีน้ำเงิน */
        color: #fff;
        box-shadow: 0 -2px 8px rgba(0, 123, 255, 0.3);
    }

    .tab-container {
        background-color: #f0f8ff;
        /* สีพื้นหลังกรอบ */
        padding: 10px;
        border-radius: 12px;
    }

    .tab-content {
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        margin-top: -10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

   .card-header {
    background-color: #AFEEEE; 
    color: #1a237e;
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

        <div class="d-flex">
            <a href="std_home.php" class="custom-tab <?php echo basename($_SERVER['PHP_SELF']) == 'std_home.php' ? 'active' : ''; ?>">
                <i class="bi bi-calendar-event-fill"></i> หน้าหลัก
            </a>
            <a href="proposal.php" class="custom-tab <?php echo basename($_SERVER['PHP_SELF']) == 'proposal.php' ? 'active' : ''; ?>">
                <i class="bi bi-list-task"></i> ยื่นข้อเสนอ
            </a>
            <a href="chose_com.php" class="custom-tab <?php echo basename($_SERVER['PHP_SELF']) == 'chose_com.php' ? 'active' : ''; ?>">
                <i class="bi bi-bank"></i> สถานประกอบการ
            </a>
        </div>

        <div class="card ">
            <div class="card-header">
                เลือกสถานประกอบการ (<?php echo $std['Std_id'] . ' - ' . $std['Std_prefix'] . $std['Std_name'] . ' ' . $std['Std_surname']; ?>)
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                    <tr>
                        <th style="width: 150px;"> </th>
                        <th style="width: 250px;">ชื่อสถานประกอบการ</th>
                        <th style="width: 300px;">ที่อยู่</th>
                        <th style="width: 150px;">จังหวัด</th>
                        <th style="width: 150px;">ติดต่อ</th>
                        <th style="width: 150px;">สถานะ</th>
                    </tr>
                    </tr>
                    <tr>
                        <td><a href="select_com.php?id=<?= $Std_id ?>" class="btn btn-link"><i class=" bi bi-building-add me-2 fs-4"></i>เลือกสถานประกอบการ</a></td>
                        <td>
                            <?php
                            echo (!empty($std['NamecomTH']) ? $std['NamecomTH'] : '') .
                                '<br>' .
                                (!empty($std['NamecomEng']) ? $std['NamecomEng'] : '');
                            ?>
                        </td>
                        <td><?php echo !empty($std['Company_add']) ? $std['Company_add'] : ''; ?></td>
                        <td><?php echo !empty($std['Province']) ? $std['Province'] : ''; ?></td>
                        <td><?php echo !empty($std['Com_phone']) ? $std['Com_phone'] : ''; ?></td>

                        <td>
                            <?php echo "สถานะการขอยื่นฝึกฯ <br><br>";
                            $status = $std['Pro_status'];
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
                            $status = $std['Com_status'];
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