<?php
include 'connectdb.php';
include 'check_admin.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ไม่พบรหัสสาขาที่ต้องการแก้ไข";
    exit;
}

$major_id = $_GET['id'];

// ดึงข้อมูลสาขาที่ต้องการแก้ไข
$query = "SELECT * FROM major WHERE Major_id = '$major_id'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูลสาขานี้";
    exit;
}

$row = mysqli_fetch_assoc($result);

// อัปเดตข้อมูลเมื่อกดปุ่มบันทึก
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $major_name = mysqli_real_escape_string($conn, $_POST['Major_name']);

    $update_query = "UPDATE major SET Major_name = '$major_name' WHERE Major_id = '$major_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อย'); window.location='indexmajor.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . mysqli_error($conn) . "');</script>";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสาขา</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>
<body>

    <!-- พื้นหลัง Particles -->
    <div id="particles-js"></div>

    <button class="toggle-btn" onclick="toggleDarkMode()">Dark/Light Mode</button>

    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>
    
        <h2 class="heading">แก้ไขข้อมูลสาขา</h2>
        <form action="edit_major.php?id=<?php echo $row['Major_id']; ?>" method="POST">
            <div class="form-group">
                <label class="form-label">รหัสสาขา</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['Major_id']); ?>" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">ชื่อสาขา</label>
                <input type="text" name="Major_name" class="form-control" value="<?php echo htmlspecialchars($row['Major_name']); ?>" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary btn-lg">บันทึกการแก้ไข</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ตรวจสอบสถานะของโหมด Dark เมื่อโหลดหน้า
        if (localStorage.getItem("dark-mode") === "enabled") {
            document.body.classList.add("dark-mode");
        }

        // ฟังก์ชันสลับโหมด Dark/Light
        function toggleDarkMode() {
            const body = document.body;
            const currentMode = body.classList.contains("dark-mode");

            if (currentMode) {
                body.classList.remove("dark-mode");
                localStorage.setItem("dark-mode", "disabled");
            } else {
                body.classList.add("dark-mode");
                localStorage.setItem("dark-mode", "enabled");
            }
        }

        // Particles.js configuration
        particlesJS('particles-js', {
            "particles": {
                "number": {
                    "value": 100,
                    "density": {
                        "enable": true,
                        "value_area": 1000
                    }
                },
                "color": {
                    "value": "#7dc9f5"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000000"
                    }
                },
                "opacity": {
                    "value": 0.6,
                    "random": false,
                    "anim": {
                        "enable": true,
                        "speed": 1.5,
                        "opacity_min": 0.1,
                        "sync": false
                    }
                },
                "size": {
                    "value": 5,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 5,
                        "size_min": 0.5,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": true,
                    "distance": 150,
                    "color": "#7dc9f5",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 4,
                    "direction": "none",
                    "random": false,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "repulse"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    }
                }
            },
            "retina_detect": true
        });
    </script>
</body>
</html>
