<?php
include 'connectdb.php';
include 'check_admin.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$query = "SELECT * FROM student WHERE Std_id LIKE '%$search%' OR Std_name LIKE '%$search%' OR Std_surname LIKE '%$search%'";
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
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="stylBE.CSS">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<style>
    .card-small {
        padding: 0.75rem;
        /* ลด padding เหลือ 4px */
        border-radius: 12px;
        min-height: 20px;
        /* ลดความสูงขั้นต่ำลง */
        font-size: 0.75rem;
        /* ลด font size เล็กลง */
        transition: all 0.2s ease-in-out;
        border: 0;
    }

    .card-small:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .bg-light-purple {
        background-color: #f3e8ff !important;
    }
</style>


<body>

    <?php include('sidebar.php'); ?>

    <div class="content">
        <h2><i class="fas fa-chart-line" style="color: #6699FF;"></i> Dashboard</h2>
        <!-- Summary Cards -->
        <div class="container text-center my-4">
            <div class="row">

                <!-- ฝั่งซ้าย: Summary Cards -->
                <div class="col-sm-8">

                    <div class="row g-2 ">
                        <?php
                        $summary = [];

                        // ดึงข้อมูล Admins
                        $admins_result = $conn->query("SELECT COUNT(*) AS count FROM adminn");
                        $admins_count = $admins_result->fetch_assoc()['count'];
                        $summary[] = [
                            'label' => 'Admins',
                            'count' => $admins_count,
                            'icon' => 'bi-person-gear',
                            'bg' => 'bg-secondary-subtle',
                            'link' => 'indexadmin.php' // เพิ่มลิงก์ไปยังหน้าจัดการแอดมิน
                        ];

                        // ดึงข้อมูล Students
                        $students_result = $conn->query("SELECT COUNT(*) AS count FROM student");
                        $students_count = $students_result->fetch_assoc()['count'];
                        $summary[] = [
                            'label' => 'Students',
                            'count' => $students_count,
                            'icon' => 'bi-mortarboard',
                            'bg' => 'bg-info-subtle',
                            'link' => 'indexstudent.php' // เพิ่มลิงก์ไปยังหน้าจัดการนิสิต
                        ];

                        // ดึงข้อมูล Teachers
                        $teachers_result = $conn->query("SELECT COUNT(*) AS count FROM teacher ");
                        $teachers_count = $teachers_result->fetch_assoc()['count'];
                        $summary[] = [
                            'label' => 'Teachers',
                            'count' => $teachers_count,
                            'icon' => 'bi-person-video2',
                            'bg' => 'bg-success-subtle',
                            'link' => 'indexteacher.php' // เพิ่มลิงก์ไปยังหน้าจัดการอาจารย์
                        ];

                        // ดึงข้อมูล Companies
                        $companies_result = $conn->query("SELECT COUNT(*) AS count FROM company");
                        $companies_count = $companies_result->fetch_assoc()['count'] - 1;
                        $summary[] = [
                            'label' => 'Companies',
                            'count' => $companies_count,
                            'icon' => 'bi-building',
                            'bg' => 'bg-warning-subtle',
                            'link' => 'indexcompany.php' // เพิ่มลิงก์ไปยังหน้าจัดการบริษัท
                        ];

                        // ดึงข้อมูล Proposals
                        $proposals_result = $conn->query("SELECT COUNT(*) AS count FROM proposal");
                        $proposals_count = $proposals_result->fetch_assoc()['count'];
                        $summary[] = [
                            'label' => 'Proposals',
                            'count' => $proposals_count,
                            'icon' => 'bi-file-earmark-text',
                            'bg' => 'bg-light-purple',
                            'link' => 'proposal_management.php' // เพิ่มลิงก์ไปยังหน้าจัดการข้อเสนอ
                        ];

                        // ดึงข้อมูล Student Work
                        $student_work_result = $conn->query("SELECT COUNT(*) AS count FROM student_work");
                        $student_work_count = $student_work_result->fetch_assoc()['count'];
                        $summary[] = [
                            'label' => 'Student Work',
                            'count' => $student_work_count,
                            'icon' => 'bi-briefcase',
                            'bg' => 'bg-primary-subtle',
                            'link' => 'indexstudentwork.php' // เพิ่มลิงก์ไปยังหน้าจัดการงานนักศึกษา
                        ];
                        ?>
                        <div class="row g-3">
                            <?php foreach ($summary as $item): ?>
                                <div class="col-12 col-md-4 mb-3"> <!-- 3 การ์ดต่อแถว -->
                                    <a href="<?= $item['link'] ?>" class="text-decoration-none">
                                        <div class="card card-small <?= $item['bg'] ?> text-center h-100">
                                            <div class="text-dark mb-1">
                                                <i class="<?= $item['icon'] ?> fs-3"></i>
                                            </div>
                                            <div class="fw-semibold"><?= $item['label'] ?></div>
                                            <div class="text-muted"><?= $item['count'] ?> รายการ</div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>





                    </div>



                    <!--กราฟจำนวนนิสิต แยกสาขา-->
                    <div class="card border-0 bg-light p-4 rounded-4">

                        <?php
                        $students_by_major_year = [];

                        $sql = "SELECT m.Major_name, s.Academic_year, COUNT(*) AS count
                        FROM student s
                        JOIN major m ON s.Major_id = m.Major_id
                        GROUP BY s.Major_id, s.Academic_year
                        ORDER BY s.Academic_year";

                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $students_by_major_year[] = $row;
                        }
                        ?>
                        <h5 class="mb-3 text-start">
                            <i class="bi bi-mortarboard-fill fs-3 me-2 " style="color: #9370DB;"></i> จำนวนนิสิตสหกิจศึกษา
                        </h5>

                        <!-- ปุ่มเลือกปี -->
                        <div class="mb-3">
                            <select id="yearSelector" class="form-select w-auto d-inline-block">
                                <option value="all">ทุกปีการศึกษา</option>
                            </select>
                        </div>

                        <!-- Canvas สำหรับแสดงกราฟ -->
                        <div class="d-flex justify-content-center">
                            <div style="width: 100%; max-width: 800px;">
                                <canvas id="studentsByEntryYearChart" height="150"></canvas>
                            </div>
                        </div>
                        <!-- โหลด Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const rawData = <?= json_encode($students_by_major_year); ?>;
                            const majors = [...new Set(rawData.map(item => item.Major_name))];
                            const years = [...new Set(rawData.map(item => item.Academic_year))].sort();

                            const yearSelector = document.getElementById("yearSelector");

                            // เติม options ลง dropdown
                            years.forEach(year => {
                                const option = document.createElement("option");
                                option.value = year;
                                option.text = `ปีกาศึกษา ${year}`;
                                yearSelector.appendChild(option);
                            });

                            function getColor(index) {
                                const colors = [
                                    'rgba(54, 162, 235, 0.6)', // ฟ้า
                                    'rgba(255, 206, 86, 0.6)', // เหลือง
                                    'rgba(75, 192, 192, 0.6)', // เขียวมิ้นต์
                                    'rgba(153, 102, 255, 0.6)', // ม่วง
                                    'rgba(255, 99, 132, 0.6)', // แดงชมพู
                                    'rgba(255, 159, 64, 0.6)', // ส้ม
                                    'rgba(201, 203, 207, 0.6)', // เทาอ่อน
                                    'rgba(0, 128, 128, 0.6)' // teal (เขียวอมฟ้า)
                                ];

                                return colors[index % colors.length];
                            }

                            const ctx = document.getElementById('studentsByEntryYearChart').getContext('2d');
                            let chart; // สำหรับอ้างอิง chart ปัจจุบัน

                            function updateChart(selectedYear) {
                                let filteredYears = selectedYear === "all" ? years : [selectedYear];

                                const datasets = majors.map((major, index) => ({
                                    label: major,
                                    data: filteredYears.map(year => {
                                        const found = rawData.find(item =>
                                            item.Major_name === major &&
                                            item.Academic_year == year

                                        );
                                        return found ? parseInt(found.count) : 0;
                                    }),
                                    backgroundColor: getColor(index),
                                    borderRadius: 3,
                                }));

                                if (chart) chart.destroy();

                                chart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: filteredYears.map(y => `ปีการศึกษา ${y}`),
                                        datasets: datasets

                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            title: {
                                                display: true,
                                                text: `จำนวนนิสิตแยกตามสาขา (${selectedYear === 'all' ? 'ทุกปีการศึกษา' : `ปีการศึกษา ${selectedYear}`})`
                                            },
                                            legend: {
                                                position: 'right', // หรือ 'top', 'bottom', 'left'
                                                labels: {
                                                    usePointStyle: true, // แสดงเป็นจุดแทนสี่เหลี่ยม
                                                    pointStyle: 'circle', // รูปแบบจุด: วงกลม
                                                    boxWidth: 6, // ขนาดจุด (เล็กลงได้อีกถ้าอยากให้เล็กมาก)
                                                    boxHeight: 6, // ใช้ร่วมกับ boxWidth
                                                    padding: 20, // ระยะห่างระหว่างแต่ละรายการ
                                                    textAlign: 'left', // ให้ตัวอักษรชิดซ้าย (optional)
                                                    color: '#333', // สีข้อความ (optional)

                                                }
                                            }

                                        },
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }

                                });
                            }

                            // เริ่มด้วยทั้งหมด
                            updateChart("all");

                            // เมื่อผู้ใช้เปลี่ยนปี
                            yearSelector.addEventListener("change", function(event) {
                                event.preventDefault(); // ป้องกันการ reload หน้าเว็บ
                                updateChart(this.value);
                            });
                        </script>
                    </div>

                </div>

                <!-- ฝั่งขวา: ส่วนเพิ่มเติม -->
                <div class="col-sm-4">
                    <div class="card border-0 bg-light p-4 rounded-4">
                        <h5 class="mb-3 text-start">⚡Quick Actions</h5>
                        <div class="d-flex flex-column align-items-start">
                            <p class="mb-2" style="line-height: 1.2;">
                                <a href="add_teacher.php" class="text-decoration-none text-dark">
                                    <i class="bi bi-plus-square-fill" style="color: #87CEEB; margin-right: 8px;"></i> เพิ่มข้อมูลอาจารย์
                                </a>
                            </p>
                            <hr class="w-100 my-1"> <!-- เส้นขั้น -->

                            <p class="mb-2" style="line-height: 1.2;">
                                <a href="add_student.php" class="text-decoration-none text-dark">
                                    <i class="bi bi-plus-square-fill" style="color: #87CEEB; margin-right: 8px;"></i> เพิ่มข้อมูลนิสิต
                                </a>
                            </p>
                            <hr class="w-100 my-1"> <!-- เส้นขั้น -->

                            <p class="mb-2" style="line-height: 1.2;">
                                <a href="add_company.php" class="text-decoration-none text-dark">
                                    <i class="bi bi-plus-square-fill" style="color: #87CEEB; margin-right: 8px;"></i> เพิ่มข้อมูลสถานประกอบการ
                                </a>
                            </p>
                            <hr class="w-100 my-1"> <!-- เส้นขั้น -->

                            <p class="mb-2" style="line-height: 1.2;">
                                <a href="add_banner.php" class="text-decoration-none text-dark">
                                    <i class="bi bi-plus-square-fill" style="color: #87CEEB; margin-right: 8px;"></i> เพิ่ม Banner
                                </a>
                            </p>
                            <hr class="w-100 my-1"> <!-- เส้นขั้น -->

                            <p class="mb-2" style="line-height: 1.2;">
                                <a href="add_news.php" class="text-decoration-none text-dark">
                                    <i class="bi bi-plus-square-fill" style="color: #87CEEB; margin-right: 8px;"></i> เพิ่มข่าวประชาสัมพันธ์
                                </a>
                            </p>
                            <hr class="w-100 my-1"> <!-- เส้นขั้น -->

                            <p class="mb-2" style="line-height: 1.2;">
                                <a href="add_pr.php" class="text-decoration-none text-dark">
                                    <i class="bi bi-plus-square-fill" style="color: #87CEEB; margin-right: 8px;"></i> เพิ่มข่าวกิจกรรม
                                </a>
                            </p>

                        </div>
                    </div>



                    <!--กราฟได้งาน-->
                    <div class="card border-0 bg-light p-4 rounded-4">
                        <h6 class="mb-3 text-start">
                            <i class="fas fa-briefcase me-2" style="color: #009688;"></i> สถิตินิสิตที่ได้งาน / ไม่ได้งาน / ปฏิเสธข้อเสนอ
                        </h6>

                        <?php
                        $sqloffer = "SELECT 
                            s.academic_year,
                            SUM(CASE WHEN j.Offer_status = 1 THEN 1 ELSE 0 END) AS employed_count,
                            SUM(CASE WHEN j.Offer_status = 2 THEN 1 ELSE 0 END) AS unemployed_count,
                            SUM(CASE WHEN j.Offer_status = 3 THEN 1 ELSE 0 END) AS declined_count
                                FROM 
                            job_offer j
                        JOIN 
                            student s ON j.Std_id = s.Std_id
                        GROUP BY 
                            s.academic_year
                        ORDER BY 
                            s.academic_year ASC";

                        $result = mysqli_query($conn, $sqloffer);

                        $years = [];
                        $employed = [];
                        $unemployed = [];
                        $declined = [];

                        while ($row = mysqli_fetch_assoc($result)) {
                            $years[] = $row['academic_year'];
                            $employed[] = $row['employed_count'];
                            $unemployed[] = $row['unemployed_count'];
                            $declined[] = $row['declined_count'];
                        }

                        $data = [
                            'years' => $years,
                            'employed' => $employed,
                            'unemployed' => $unemployed,
                            'declined' => $declined
                        ];
                        ?>

                        <div style="height: 420px;">
                            <canvas id="employmentChart"></canvas>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            const data = <?php echo json_encode($data); ?>;

                            const ctxoffer = document.getElementById('employmentChart').getContext('2d');
                            new Chart(ctxoffer, {
                                type: 'line',
                                data: {
                                    labels: data.years,
                                    datasets: [{
                                            label: 'ได้งาน',
                                            data: data.employed,
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                            fill: true,
                                            tension: 0.4,
                                            pointStyle: 'circle',
                                            pointRadius: 2,
                                            pointHoverRadius: 3,
                                            cubicInterpolationMode: 'monotone',
                                            borderWidth: 2
                                        },
                                        {
                                            label: 'ไม่ได้งาน',
                                            data: data.unemployed,
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                            fill: true,
                                            tension: 0.4,
                                            pointStyle: 'circle',
                                            pointRadius: 2,
                                            pointHoverRadius: 3,
                                            cubicInterpolationMode: 'monotone',
                                            borderWidth: 2
                                        },
                                        {
                                            label: 'ปฏิเสธข้อเสนอ',
                                            data: data.declined,
                                            borderColor: 'rgba(255, 206, 86, 1)',
                                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                            fill: true,
                                            tension: 0.4,
                                            pointStyle: 'circle',
                                            pointRadius: 2,
                                            pointHoverRadius: 3,
                                            cubicInterpolationMode: 'monotone',
                                            borderWidth: 2
                                        }
                                    ]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        legend: {
                                            position: 'top',
                                            labels: {
                                                usePointStyle: true,
                                                pointStyle: 'circle',
                                                boxWidth: 6,
                                                boxHeight: 6,
                                                padding: 10,
                                                font: {
                                                    size: 12
                                                }
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'สถิตินิสิตตามสถานะการได้งาน'
                                        }
                                    },
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            ticks: {
                                                display: true,
                                                precision: 0
                                            },
                                            title: {
                                                display: true,
                                                text: 'จำนวนนิสิต'
                                            },
                                            grid: {
                                                drawBorder: false,
                                                color: 'rgba(0,0,0,0.1)',
                                                borderDash: [5, 5]
                                            }
                                        },
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'ปีการศึกษา'
                                            },
                                            grid: {
                                                drawBorder: false,
                                                color: 'rgba(0,0,0,0.1)',
                                                borderDash: [5, 5]
                                            }
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>




                </div>





            </div>


            <div class="card border-0 bg-light p-4 rounded-4">
                <h5 class="mb-3 text-start">
                    <i class="bi bi-building-fill fs-3 me-2" style="color: #6699FF;"></i> สถานประกอบการ
                </h5>

                <!--กราฟสาขา-->
                <?php
                $sqlm = "
                        SELECT m.Major_name, COUNT(c.Company_id) AS Company_count
                        FROM company c
                        JOIN major m ON c.Major_id = m.Major_id
                        GROUP BY m.Major_id
                        ";

                $result = $conn->query($sqlm);
                $majors = [];
                $counts = [];

                while ($row = $result->fetch_assoc()) {
                    $majors[] = $row['Major_name'];
                    $counts[] = $row['Company_count'];
                }

                ?>

                <!-- Canvas สำหรับแสดงกราฟ สภารประกอบการ-->
                <div class="d-flex justify-content-center">
                    <div style="width: 100%;">
                        <canvas id="companyByMajorChart" height="100"></canvas>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    window.onload = function() {
                        const ctxm = document.getElementById('companyByMajorChart').getContext('2d');

                        const majors = <?= json_encode($majors); ?>;
                        const counts = <?= json_encode($counts); ?>;
                        const colors = ['#b388eb', '#9d8df1', '#82b1ff', '#80cbc4', '#81d4fa', '#a5d6a7', '#f48fb1', '#ce93d8'];

                        // สร้าง dataset ละ 1 สาขา
                        const datasets = majors.map((major, index) => ({
                            label: major,
                            data: majors.map((_, i) => (i === index ? counts[index] : 0)), // ให้ค่าแค่ตำแหน่งตัวเอง
                            backgroundColor: colors[index % colors.length],
                            borderRadius: 3
                        }));

                        const companyByMajorChart = new Chart(ctxm, {
                            type: 'bar',
                            data: {
                                labels: majors,
                                datasets: datasets
                            },
                            options: {
                                indexAxis: 'y',
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'right' // หรือ 'top', 'bottom', 'left'
                                    }
                                },
                                scales: {
                                    x: {
                                        beginAtZero: true,
                                        stacked: true
                                    },
                                    y: {
                                        stacked: true
                                    }
                                }
                            }
                        });
                    };
                </script>
            </div>


            <div class="row g-4">
                <!-- คอลัมน์ซ้าย: Proposal Status -->
                <div class="col-md-6">
                    <?php


                    // ดึงปีการศึกษาทั้งหมด
                    $years_query = mysqli_query($conn, "SELECT DISTINCT Sug_year FROM proposal ORDER BY Sug_year DESC");
                    $years = [];
                    while ($row = mysqli_fetch_assoc($years_query)) {
                        $years[] = $row['Sug_year'];
                    }

                    // แยกตัวแปรปีสำหรับแต่ละฝั่ง
                    $latest_year = $years[0] ?? date("Y"); // ปีล่าสุดจากฐานข้อมูล
                    $selected_year = $latest_year;
                    $selected_com_year = $latest_year;

                    ?>

                    <div class="card border-0 bg-light p-4 rounded-4">
                        <h5 class="mb-3 text-start">
                            <i class="fas fa-file-alt me-2 fs-3" style="color:rgb(13, 197, 253);"></i>Proposal
                        </h5>
                        <div class="card-body text-start" style="color: #333;">
                            <!-- ฟอร์มเลือกปี Proposal -->
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="year" class="col-form-label">ปีการศึกษา:</label>
                                </div>
                                <div class="col-auto">
                                    <select name="year" id="year" class="form-select" style="min-width: 200px;">
                                        <?php foreach ($years as $year): ?>
                                            <option value="<?= $year ?>" <?= ($year == $selected_year) ? 'selected' : '' ?>>
                                                <?= $year ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div id="proposal-status-list" class="text-start mt-3">
                                <!-- จะถูกเติมข้อมูลด้วย JavaScript -->
                            </div>
                        </div>
                    </div>


                    <script>
                        function loadProposalStatus(year) {
                            fetch('get_proposal_status.php?year=' + year)
                                .then(response => response.json())
                                .then(data => {
                                    const container = document.getElementById('proposal-status-list');
                                    container.innerHTML = '<ul class="list-unstyled">' + data.map(item =>
                                        `<li class="mb-2 d-flex align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi ${item.icon} ${item.color} fs-5"></i>
                                    <span>${item.label}</span>
                                </div>
                                <strong class="ms-auto">${item.count} </strong><span class="ms-2"> รายการ</span>
                            </li>`
                                    ).join('') + '</ul>';
                                })
                                .catch(err => {
                                    console.error('Error fetching data:', err);
                                });
                        }

                        document.getElementById('year').addEventListener('change', function() {
                            loadProposalStatus(this.value);
                        });

                        window.addEventListener('DOMContentLoaded', function() {
                            loadProposalStatus(document.getElementById('year').value);
                        });
                    </script>
                </div>

                <!-- คอลัมน์ขวา: การตอบรับจากสถานประกอบการ -->
                <div class="col-md-6">
                    <div class="card border-0 bg-light p-4 rounded-4">
                        <h5 class="mb-3 text-start">
                            <i class="fas fa-handshake me-2 fs-3" style="color:#ffc107;"></i>การตอบรับจากสถานประกอบการ
                        </h5>
                        <div class="card-body text-start" style="color: #333;">

                            <!-- Dropdown ปีแบบไม่ใช้ form -->
                            <div class="row g-2 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="com_year" class="col-form-label">ปีการศึกษา:</label>
                                </div>
                                <div class="col-auto">
                                    <select id="com_year" class="form-select" style="min-width: 200px;">
                                        <?php foreach ($years as $year): ?>
                                            <option value="<?= $year ?>" <?= ($year == $selected_com_year) ? 'selected' : '' ?>>
                                                <?= $year ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <!-- ตรงนี้จะถูกเติมด้วย JS -->
                            <div id="com-status-list"></div>
                        </div>
                    </div>
                </div>

                <script>
                    function loadComStatus(year) {
                        fetch('get_com_status.php?year=' + year)
                            .then(response => response.json())
                            .then(data => {
                                const container = document.getElementById('com-status-list');
                                container.innerHTML = '<ul class="list-unstyled">' + data.map(item =>
                                    `<li class="mb-2 d-flex align-items-center">
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi ${item.icon} ${item.color} fs-5"></i>
                                                <span>${item.label}</span>
                                            </div>
                                            <strong class="ms-auto">${item.count} </strong><span class="ms-2"> รายการ</span>
                                        </li>`
                                ).join('') + '</ul>';
                            })
                            .catch(err => {
                                console.error('Error fetching com_status data:', err);
                            });
                    }

                    document.getElementById('com_year').addEventListener('change', function() {
                        loadComStatus(this.value);
                    });

                    window.addEventListener('DOMContentLoaded', function() {
                        loadComStatus(document.getElementById('com_year').value);
                    });
                </script>

            </div>


            <div class="row g-4">
                <!-- รายการที่ 1 -->
                <div class="col-md-4">
                    <div class="card border-0 bg-light p-4 rounded-4 h-100">
                        <h5 class="mb-3 text-start">
                            <i class="bi bi-file-earmark-bar-graph-fill fs-3 me-2" style="color: #008000;"></i> รายงานรายชื่อนิสิต
                        </h5>

                        <?php
                        // ดึงปีการศึกษาจาก student
                        $sqlyear = "SELECT DISTINCT Academic_year FROM student ORDER BY Academic_year DESC";
                        $result = $conn->query($sqlyear);
                        ?>

                        <form id="downloadForm1" action="export_student.php" method="GET" target="_blank">
                            <div class="d-flex flex-column gap-2">
                                <select name="year" id="yearSelect" class="form-select" style="width: 100%;">
                                    <option value="">-- ทั้งหมด --</option>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <option value="<?= htmlspecialchars($row['Academic_year']) ?>">
                                            <?= htmlspecialchars($row['Academic_year']) ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="fas fa-file-csv"></i> ดาวน์โหลด CSV
                                </button>
                            </div>
                        </form>
                    </div>

                </div>


                <!-- รายการที่ 2 -->

                <div class="col-md-4">
                    <div class="card border-0 bg-light p-4 rounded-4 h-100">
                        <h5 class="mb-3 text-start">
                            <i class="bi bi-building-fill fs-3 me-2" style="color: #0d6efd;"></i> รายงานรายชื่อสถานประกอบการ
                        </h5>

                        <?php
                        // ดึงสาขาจาก major
                        $sql_major = "SELECT Major_id, Major_name FROM major WHERE Major_id != 0 ORDER BY Major_name ASC";
                        $result_major = $conn->query($sql_major);
                        ?>

                        <form id="downloadForm2" action="export_company.php" method="GET" target="_blank">
                            <div class="d-flex flex-column gap-2">
                                <select name="major_id" id="majorSelect" class="form-select" style="width: 100%;">
                                    <option value="">-- ทั้งหมด --</option>
                                    <?php while ($row_major = $result_major->fetch_assoc()) { ?>
                                        <option value="<?= htmlspecialchars($row_major['Major_id']) ?>">
                                            <?= htmlspecialchars($row_major['Major_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <button type="submit" class="btn btn-primary mt-2">
                                    <i class="fas fa-file-csv"></i> ดาวน์โหลด CSV
                                </button>
                            </div>
                        </form>
                    </div>
                </div>


                <!-- รายการที่ 3 -->
                <div class="col-md-4">
                    <div class="card border-0 bg-light p-4 rounded-4 h-100">
                        <h5 class="mb-3 text-start">
                            <i class="bi bi-bar-chart-line-fill fs-3 me-2" style="color: #FF8C00;"></i> รายงานนิสิต-สถานประกอบการ
                        </h5>

                        <?php
                        // ดึงปีการศึกษาจาก student
                        $sqlyear = "SELECT DISTINCT Academic_year FROM student ORDER BY Academic_year DESC";
                        $result = $conn->query($sqlyear);
                        ?>

                        <form id="downloadForm3" action="export_stdmatchcom.php" method="GET" target="_blank">
                            <div class="d-flex flex-column gap-2">
                                <select name="yearstd" id="yearSelect" class="form-select" style="width: 100%;">
                                    <option value="">-- ทั้งหมด --</option>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <option value="<?= htmlspecialchars($row['Academic_year']) ?>">
                                            <?= htmlspecialchars($row['Academic_year']) ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <button type="submit" class="btn mt-2" style="background-color: #ff9800; color: white; border: none;">
                                    <i class="fas fa-file-csv"></i> ดาวน์โหลด CSV
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
                <!-- รายการที่ 4 -->
                <div class="col-md-4">
                    <div class="card border-0 bg-light p-4 rounded-4 h-100">
                        <h5 class="mb-3 text-start">
                            <i class="fas fa-print fs-3 me-2" style="color: #DC143C;"></i>พิมพ์ใบส่งตัวนิสิต
                        </h5>
                        <?php
                        // ดึงปีการศึกษาจาก student
                        $sqlyear = "SELECT DISTINCT Academic_year FROM student ORDER BY Academic_year DESC";
                        $result = $conn->query($sqlyear);
                        ?>

                        <form id="downloadForm4" action="export_student_form.php" method="GET" target="_blank">
                            <div class="d-flex flex-column gap-2">
                                <select name="year" id="yearSelect" class="form-select" style="width: 100%;">
                                    <option value="">-- ทั้งหมด --</option>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <option value="<?= htmlspecialchars($row['Academic_year']) ?>">
                                            <?= htmlspecialchars($row['Academic_year']) ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <button type="submit" class="btn mt-2" style="background-color: #DC143C; color: white; border: none;">
                                    <i class="fas fa-print"></i> พิมพ์
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- รายการที่ 5 -->
                <div class="col-md-4">
                    <div class="card border-0 bg-light p-4 rounded-4 h-100">
                        <h5 class="mb-3 text-start">
                            <i class="fa fa-hand-holding-usd fs-3 me-2" style="color: #9370DB;"></i> รายงานสวัสดิการสถานฯจากนิสิต
                        </h5>
                        <?php
                        $sql_major5 = "SELECT Major_id, Major_name FROM major WHERE Major_id != 0 ORDER BY Major_name ASC";
                        $result_major5 = $conn->query($sql_major5);
                        ?>

                        <form id="downloadForm" action="export_welfare_com.php" method="GET" target="_blank">
                            <div class="d-flex flex-column gap-2">
                                <select name="major_id" id="majorSelect4" class="form-select" style="width: 100%;">
                                    <option value="">-- ทั้งหมด --</option>
                                    <?php while ($row_major = $result_major5->fetch_assoc()) { ?>
                                        <option value="<?= htmlspecialchars($row_major['Major_id']) ?>">
                                            <?= htmlspecialchars($row_major['Major_name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <button type="submit" class="btn mt-2" style="background-color: #9370DB; color: white; border: none;">
                                    <i class="fas fa-file-csv"></i> ดาวน์โหลด CSV
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- รายการที่ 6 -->
                <div class="col-md-4">
                    <div class="card border-0 bg-light p-4 rounded-4 h-100">
                        <h5 class="mb-3 text-start">
                            <i class="bi bi-journal-text fs-3 me-2" style="color: #00CED1;"></i> รายงาน Proposal
                        </h5>

                        <?php
                        // ดึงปีจาก proposal
                        $sql_proposal_years = "SELECT DISTINCT Sug_year FROM proposal ORDER BY Sug_year DESC";
                        $result_proposal_years = $conn->query($sql_proposal_years);
                        ?>

                        <form id="downloadForm6" action="export_proposal.php" method="GET" target="_blank">
                            <div class="d-flex flex-column gap-2">
                                <select name="year" id="proposalYearSelect" class="form-select" style="width: 100%;">
                                    <option value="">-- ทั้งหมด --</option>
                                    <?php while ($row = $result_proposal_years->fetch_assoc()) { ?>
                                        <option value="<?= htmlspecialchars($row['Sug_year']) ?>">
                                            <?= htmlspecialchars($row['Sug_year']) ?>
                                        </option>
                                    <?php } ?>
                                </select>

                                <button type="submit" class="btn mt-2" style="background-color: #00CED1; color: white; border: none;">
                                    <i class="fas fa-file-csv"></i> ดาวน์โหลด CSV
                                </button>
                            </div>
                        </form>
                    </div>
                </div>





            </div>








        </div>








        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php mysqli_close($conn); ?>