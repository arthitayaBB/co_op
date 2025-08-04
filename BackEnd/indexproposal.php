<?php
include 'connectdb.php';
include 'check_admin.php';
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$year_filter = $_GET['year_filter'] ?? '';
$status_filter = $_GET['status_filter'] ?? '';
$com_status_filter = $_GET['com_status_filter'] ?? '';


$query = "
    SELECT 
        proposal.*,
        student.Std_prefix,
        student.Std_name,
        student.Std_surname,
        company.NamecomTH
    FROM 
        proposal
    LEFT JOIN student ON proposal.Std_id = student.Std_id
    LEFT JOIN company ON proposal.Company_id = company.Company_id
    WHERE 
        (proposal.Proposal_id LIKE '%$search%' OR proposal.Proposal_name LIKE '%$search%')
";

if (!empty($year_filter)) {
    $query .= " AND proposal.Sug_year = '$year_filter'";
}

if ($status_filter !== '') {
    $query .= " AND proposal.Pro_status = '$status_filter'";
}

if ($com_status_filter !== '') {
    $query .= " AND proposal.Com_status = '$com_status_filter'";
}

$query .= " ORDER BY proposal.Proposal_id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการข้อมูลข้อเสนอสหกิจศึกษา</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "language": {
                    "search": "ค้นหา:",
                    "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
                    "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
                    "infoEmpty": "ไม่มีข้อมูล",
                    "paginate": {
                        "first": "หน้าแรก",
                        "last": "หน้าสุดท้าย",
                        "next": "ถัดไป",
                        "previous": "ก่อนหน้า"
                    }
                }
            });
        });
    </script>
</head>
<style>
    td.left {
        white-space: normal;
        /* ให้ข้อความใน td สามารถขึ้นบรรทัดใหม่ได้ */
        word-wrap: break-word;
        /* หักคำที่ยาวเกินให้ขึ้นบรรทัดใหม่ */
    }
</style>

<body>



    <?php include('sidebar.php'); ?>


    <div class="content">
        <h2>จัดการข้อมูลข้อเสนอสหกิจศึกษา</h2>
        <div class="d-flex justify-content-between mb-3"> <a href="add_proposal.php" class="btn btn-success">
                <i class="fas fa-plus"></i> เพิ่มข้อมูลข้อเสนอสหกิจศึกษา
            </a> </div>
        <form method="GET" class="row g-2 mb-3">

            <div class="col-12 col-md-3">
                <select name="year_filter" class="form-select">
                    <option value="">-- เลือกปีการศึกษา --</option>
                    <?php
                    // ดึงปีการศึกษาทั้งหมดจากฐานข้อมูล
                    $years_query = mysqli_query($conn, "SELECT DISTINCT Sug_year FROM proposal ORDER BY Sug_year DESC");
                    while ($year = mysqli_fetch_assoc($years_query)) {
                        $selected = ($year_filter == $year['Sug_year']) ? 'selected' : '';
                        echo "<option value='{$year['Sug_year']}' $selected>{$year['Sug_year']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <select name="status_filter" class="form-select">
                    <option value="">-- เลือกสถานะการขอยื่นฝึกฯ --</option>
                    <option value="0" <?php if ($status_filter === '0') echo 'selected'; ?>>ไม่อนุมัติ</option>
                    <option value="1" <?php if ($status_filter === '1') echo 'selected'; ?>>อนุมัติ</option>
                    <option value="2" <?php if ($status_filter === '2') echo 'selected'; ?>>แก้ไข</option>
                    <option value="3" <?php if ($status_filter === '3') echo 'selected'; ?>>รอตรวจสอบ</option>
                    <option value="4" <?php if ($status_filter === '4') echo 'selected'; ?>>ยังไม่เพิ่มโปรเจค</option>
                </select>
            </div>
            <div class="col-12 col-md-3">
                <select name="com_status_filter" class="form-select">
                    <option value="">-- เลือกสถานะตอบรับ --</option>
                    <option value="0" <?php if ($com_status_filter === '0') echo 'selected'; ?>>ไม่อนุมัติ</option>
                    <option value="1" <?php if ($com_status_filter === '1') echo 'selected'; ?>>อนุมัติ</option>
                    <option value="2" <?php if ($com_status_filter === '2') echo 'selected'; ?>>แก้ไข</option>
                    <option value="3" <?php if ($com_status_filter === '3') echo 'selected'; ?>>รอตรวจสอบ</option>
                    <option value="4" <?php if ($com_status_filter === '4') echo 'selected'; ?>>ไม่มีข้อมูล</option>
                </select>
            </div>

            <div class="col-12 col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-filter"></i> กรองข้อมูล
        </button>
        <a href="indexproposal.php" class="btn btn-secondary w-100">
            <i class="fas fa-undo"></i> รีเซ็ต
        </a>
    </div>
        </form>

        <div class="table-container">


            <table id="studentTable" class="table table-striped table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>การจัดการ</th>
                        <th>ปีการศึกษา</th>
                        <th>สถานะการขอยื่นฝึกฯ</th>
                        <th>สถานะตอบรับ</th>
                        <th>รหัสนิสิต</th>
                        <th>ชื่อนิสิต</th>
                        <th>ชื่อผลงาน</th>
                        <th>ชื่อสถานประกอบการ</th>
                        <th>ไฟล์</th>
                        <th>คำแนะนำจากอาจารย์</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <a href="edit_proposal.php?id=<?php echo $row['Proposal_id']; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="delete_proposal.php?id=<?php echo $row['Proposal_id']; ?>" class="btn btn-danger btn-sm" onClick="return confirm('คุณแน่ใจหรือไม่?');">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                            <td><?php echo $row['Sug_year']; ?></td>
                            <td>
                                <?php
                                $status = $row['Pro_status'];
                                switch ($status) {
                                    case 0:
                                        echo "<span style='color: #e74c3c;'>ไม่อนุมัติ</span>";
                                        break;
                                    case 1:
                                        echo "<span style='color: #2ecc71;'>อนุมัติ</span>";
                                        break;
                                    case 2:
                                        echo "<span style='color: #f39c12;'>แก้ไข</span>";
                                        break;
                                    case 3:
                                        echo "<span style='color: #3498db;'>รอตรวจสอบ</span>";
                                        break;
                                    case 4:
                                    default:
                                        echo "<span style='color: gray;'>ยังไม่เพิ่มโปรเจค</span>";
                                }
                                ?>
                            </td>

                            <td>
                                <?php
                                $status = $row['Com_status'];
                                switch ($status) {
                                    case 0:
                                        echo "<span style='color: #e74c3c;'>ไม่อนุมัติ</span>";
                                        break;
                                    case 1:
                                        echo "<span style='color: #2ecc71;'>อนุมัติ</span>";
                                        break;
                                    case 2:
                                        echo "<span style='color: #f39c12;'>แก้ไข</span>";
                                        break;
                                    case 3:
                                        echo "<span style='color: #3498db;'>รอตรวจสอบ</span>";
                                        break;
                                    case 4:
                                    default:
                                        echo "<span style='color: gray;'>ไม่มีข้อมูล</span>";
                                }
                                ?>
                            </td>

                            <td><?php echo $row['Std_id']; ?></td>
                            <td><?php echo $row['Std_prefix'] . $row['Std_name'] . ' ' . $row['Std_surname']; ?></td>
                            <td class="left">
                                <?php echo !empty($row['Proposal_name']) ? $row['Proposal_name'] : 'ไม่มีข้อมูล'; ?>
                            </td>
                            <td class="left">
                                <?php echo !empty($row['NamecomTH']) ? $row['NamecomTH'] : 'ไม่มีข้อมูล'; ?>
                            </td>

                            <td>
                                <?php if (!empty($row['File_name'])): ?>
                                    <a href="../uploads/project/<?php echo $row['File_name']; ?>" target="_blank" style="text-decoration: none; color: blue;">
                                        คลิกดูไฟล์
                                    </a>
                                <?php else: ?>
                                    <span>ไม่มีไฟล์</span>
                                <?php endif; ?>
                            </td>


                            <td class="left"><?php echo $row['Note']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php mysqli_close($conn); ?>