<?php
include 'connectdb.php';
include 'check_admin.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT i.*, a.Ad_name 
          FROM intro i
          JOIN adminn a ON i.Admin_id = a.Admin_id
          WHERE i.Intro_id LIKE '%$search%' 
             OR i.I_detail LIKE '%$search%'";
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
    <title>จัดการข้อมูลLanding Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="stylBE.CSS">
    <script>
        $(document).ready(function() {
            $('#introTable').DataTable({
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
            window.location.href = "indexbanner.php?search=" + searchQuery;
        }
    </script>


</head>

<body>


    <?php include('sidebar.php'); ?>

    <div class="content">
        <h2>Landing Page</h2>
        <div class="d-flex justify-content-between mb-3"> <a href="add_intro.php" class="btn btn-success"><i class="fas fa-plus"></i> เพิ่มLanding Page</a> </div>

        <div class="table-container">

            <table id="introTable" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>การจัดการ</th>
                        <th>status</th>
                        <th>รูป (1024*768)</th>

                        <th>คำอธิบาย</th>
                        <th>Admin</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>
                                <a href="edit_intro.php?id=<?php echo $row['Intro_id']; ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                <a href="delete_intro.php?id=<?php echo $row['Intro_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือไม่?');"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td>
                                <i class="bi <?= $row['I_status'] == 1 ? 'bi-toggle-on fs-3' : 'bi-toggle-off fs-3' ?> status-toggle"
                                    data-id="<?= $row['Intro_id'] ?>"
                                    data-status="<?= $row['I_status'] ?>"
                                    style="cursor: pointer; font-size: 1.5rem; color: <?= $row['I_status'] == 1 ? 'green' : 'red' ?>;"></i>
                            </td>
                            <td>
                                <img src="../images/intro/<?php echo $row['I_picture']; ?>" alt="รูป" width="80" height="auto">
                            </td>

                            <td style="word-wrap: break-word; word-break: break-word; white-space: normal; max-width: 200px;">
                                <?php echo $row['I_detail']; ?>
                            </td>


                            <td><?php echo $row['Ad_name']; ?></td>
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

                    fetch('toggle_statusIntro.php', {
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