<?php
include 'connectdb.php';
include 'check_admin.php';
$year_filter = $_GET['year_filter'] ?? '';

$query = "SELECT public_relations.*, adminn.Ad_name, company.NamecomTH 
          FROM public_relations
          INNER JOIN adminn ON public_relations.Admin_id = adminn.Admin_id 
          LEFT JOIN company ON public_relations.Company_id = company.Company_id";

if (!empty($year_filter)) {
    $query .= " WHERE public_relations.Pr_year = '" . mysqli_real_escape_string($conn, $year_filter) . "'";
}

$query .= " ORDER BY Pr_id DESC";


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
    <title>จัดการข่าวกิจกรรมสหกิจศึกษา</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
</head>

<script>
    $(document).ready(function() {
        $('#Table').DataTable({
            autoWidth: false,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            language: {
                search: "ค้นหา:",
                lengthMenu: "แสดง _MENU_ แถว",
                info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                infoEmpty: "แสดง 0 ถึง 0 จาก 0 แถว",
                zeroRecords: "ไม่พบข้อมูล",
                paginate: {
                    previous: "ก่อนหน้า",
                    next: "ถัดไป"
                }
            }
        });
    });
</script>
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
        <h2>ข่าวกิจกรรมสหกิจศึกษา</h2>
       <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-3">
    
    <!-- ปุ่มเพิ่มข่าวกิจกรรม -->
    <a href="add_pr.php" class="btn btn-success">
        <i class="fas fa-plus"></i> ข่าวกิจกรรมสหกิจศึกษา
    </a>

    <!-- ฟอร์มกรองปี -->
    <form method="GET" class="d-flex gap-2 align-items-end">
        <div>
            <select name="year_filter" class="form-select">
                <option value="">-- ปีการศึกษาทั้งหมด --</option>
                <?php
                $year_query = mysqli_query($conn, "SELECT DISTINCT Pr_year FROM public_relations ORDER BY Pr_year DESC");
                while ($y = mysqli_fetch_assoc($year_query)) {
                    $selected = (isset($_GET['year_filter']) && $_GET['year_filter'] == $y['Pr_year']) ? 'selected' : '';
                    echo "<option value='{$y['Pr_year']}' $selected>{$y['Pr_year']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-filter"></i> กรอง
        </button>
        <a href="indexpr.php" class="btn btn-secondary">
            <i class="fas fa-undo"></i> รีเซ็ต
        </a>
    </form>
</div>

        <div class="table-container">

            <table id="Table" class="table table-bordered table-hover table-striped" style="table-layout: fixed; width: 100%;">


                <thead>

                    <tr>
                        <th style="width: 80px;" class="text-center">จัดการ</th>
                        <th style="width: 60px;">รหัส</th>
                        <th style="width: 40px;">สถานะ</th>
                        <th style="width: 60px;">วันที่</th>
                        <th style="width: 20px;">ปี</th>
                        <th style="width: 170px;">รูปภาพ</th>
                        <th style="width: 250px;">รายละเอียด</th>
                        <th style="width: 150px;">บริษัท</th>
                        <th style="width: 80px;">ผู้ดูแล</th>
                    </tr>

                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <a href="edit_pr.php?id=<?php echo $row['Pr_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="delete_public_relations.php?id=<?php echo $row['Pr_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือไม่?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td><?= $row['Pr_id'] ?></td>
                            <td>
                                <i class="bi <?= $row['Pr_status'] == 1 ? 'bi-toggle-on fs-3' : 'bi-toggle-off fs-' ?> status-toggle"
                                    data-id="<?= $row['Pr_id'] ?>"
                                    data-status="<?= $row['Pr_status'] ?>"
                                    style="font-size: 1.5rem; cursor: pointer; color: <?= $row['Pr_status'] == 1 ? 'green' : 'red' ?>;">
                                </i>
                            </td>


                            <td><?= $row['Pr_date'] ?></td>
                            <td><?= $row['Pr_year'] ?></td>
                            <td>
                                <div style="display: flex; flex-wrap: wrap; gap: 10px; width: 180px;">
                                    <?php if (!empty($row['Pr_picture1'])): ?>
                                        <img src="../images/public_relations/<?= htmlspecialchars($row['Pr_picture1']) ?>" width="80" style="flex: 0 0 calc(50% - 5px);">
                                    <?php endif; ?>
                                    <?php if (!empty($row['Pr_picture2'])): ?>
                                        <img src="../images/public_relations/<?= htmlspecialchars($row['Pr_picture2']) ?>" width="80" style="flex: 0 0 calc(50% - 5px);">
                                    <?php endif; ?>
                                    <?php if (!empty($row['Pr_picture3'])): ?>
                                        <img src="../images/public_relations/<?= htmlspecialchars($row['Pr_picture3']) ?>" width="80" style="flex: 0 0 calc(50% - 5px);">
                                    <?php endif; ?>
                                    <?php if (!empty($row['Pr_picture4'])): ?>
                                        <img src="../images/public_relations/<?= htmlspecialchars($row['Pr_picture4']) ?>" width="80" style="flex: 0 0 calc(50% - 5px);">
                                    <?php endif; ?>
                                </div>
                            </td>




                            <td class="left" title="<?= htmlspecialchars($row['Pr_detail']) ?>">
                                <?= htmlspecialchars(mb_strimwidth($row['Pr_detail'], 0, 300, '...')) ?>
                            </td>

                            <?php ?>
                            <td style="white-space: normal; word-break: break-word;">
                                <?= htmlspecialchars($row['NamecomTH'] ?? '-') ?>
                            </td>



                            <td><?= htmlspecialchars($row['Ad_name']) ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchTeacher() {
            var searchQuery = document.getElementById('search').value;
            window.location.href = "indexbanner.php?search=" + searchQuery;
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggles = document.querySelectorAll('.status-toggle');

            toggles.forEach(function(el) {
                el.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const currentStatus = parseInt(this.dataset.status);
                    const newStatus = currentStatus === 1 ? 0 : 1;
                    const icon = this;

                    fetch('toggle_statuspr.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `id=${id}&status=${newStatus}`
                        })
                        .then(response => response.text())
                        .then(result => {
                            if (result === 'success') {
                                icon.classList.remove(currentStatus === 1 ? 'bi-toggle-on' : 'bi-toggle-off');
                                icon.classList.add(newStatus === 1 ? 'bi-toggle-on' : 'bi-toggle-off');
                                icon.style.color = newStatus === 1 ? 'green' : 'red';
                                icon.dataset.status = newStatus;
                            } else {
                                alert('เกิดข้อผิดพลาด: ' + result);
                            }
                        })
                        .catch(error => {
                            alert('ข้อผิดพลาดในการเชื่อมต่อ: ' + error);
                        });
                });
            });
        });
    </script>
</body>

</html>
<?php mysqli_close($conn); ?>