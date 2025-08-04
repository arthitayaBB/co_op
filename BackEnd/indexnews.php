<?php
include 'connectdb.php';
include 'check_admin.php';
$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT news.*, adminn.Ad_name 
          FROM news 
          INNER JOIN adminn ON news.Admin_id = adminn.Admin_id 
          WHERE news.N_id LIKE '%$search%' 
             OR news.N_heading LIKE '%$search%' 
             OR news.N_detail LIKE '%$search%'
          ORDER BY news.N_id DESC";  // เรียงจากมากไปน้อย

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
    <title>จัดการข้อมูข่าวสาร</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
    <script>
        $(document).ready(function() {
            $('#newsTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "language": {
                    "search": "ค้นหา:",
                    "lengthMenu": "แสดง _MENU_ แถว",
                    "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                    "infoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                    "zeroRecords": "ไม่พบข้อมูล",
                    "paginate": {
                        "previous": "ก่อนหน้า",
                        "next": "ถัดไป"
                    }
                }
            });
        });

        function searchCompany() {
            var searchQuery = document.getElementById('search').value;
            window.location.href = "indexnews.php.php?search=" + searchQuery;
        }
    </script>

    <style>
        td.left {
            white-space: normal;
            /* ให้ข้อความใน td สามารถขึ้นบรรทัดใหม่ได้ */
            word-wrap: break-word;
            /* หักคำที่ยาวเกินให้ขึ้นบรรทัดใหม่ */
        }
    </style>
</head>

<body>

    <?php include('sidebar.php'); ?>

    <div class="content">
        <h2>ข้อมูลข่าวสาร</h2>
        <div class="d-flex justify-content-between mb-3"> <a href="add_news.php" class="btn btn-success"><i class="fas fa-plus"></i> เพิ่มข้อมูลข่าวสาร</a> </div>

        <div class="table-container">

            <table id="newsTable" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>การจัดการ</th>
                        <th>status</th>
                        <th>รูป</th>
                        <th>รหัส</th>
                        <th>วันที่</th>
                        <th>หัวข้อ</th>
                        <th>ข้อมูล</th>

                        <th>reference</th>
                        <th>Admin</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <a href="edit_news.php?id=<?php echo $row['N_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="delete_news.php?id=<?php echo $row['N_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือไม่?');"><i class="fas fa-trash-alt"></i></a>
                            <td>
                                <i class="bi <?= $row['N_status'] == 1 ? 'bi-toggle-on fs-3' : 'bi-toggle-off fs-3' ?> status-toggle"
                                    data-id="<?= $row['N_id'] ?>"
                                    data-status="<?= $row['N_status'] ?>"
                                    style="cursor: pointer; font-size: 1.5rem; color: <?= $row['N_status'] == 1 ? 'green' : 'red' ?>;"></i>
                            </td>


                            <td>
                                <img src="../images/news/<?php echo $row['N_picture']; ?>" alt="รูป" width="80" height="auto">
                            </td>
                            <td><?php echo $row['N_id']; ?></td>
                            <td><?php echo $row['N_date']; ?></td>
                            <td class="left"><?php echo $row['N_heading']; ?></td>

                            <td class="left text-wrap" style="max-width: 300px;">
                                <?php echo nl2br(htmlspecialchars($row['N_detail'])); ?>
                            </td>


                            <td><?php echo $row['N_refer']; ?></td>
                            <td><?php echo $row['Ad_name']; ?></td> <!-- ชื่อผู้ดูแล -->

                            </td>
                            </td>
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
            window.location.href = "indexnews.php?search=" + searchQuery;
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

                    fetch('toggle_statusnews.php', {
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