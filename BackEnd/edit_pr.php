<?php

include 'connectdb.php';
include 'check_admin.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "<script>alert('ไม่พบข้อมูลที่ต้องการแก้ไข'); window.history.back();</script>";
    exit;
}

// ดึงข้อมูลเดิม
$sql_old = "SELECT pr.*, c.NamecomTH 
            FROM public_relations pr 
            LEFT JOIN company c ON pr.Company_id = c.Company_id 
            WHERE pr.Pr_id = ?";
$stmt_old = $conn->prepare($sql_old);
$stmt_old->bind_param("i", $id);
$stmt_old->execute();
$result = $stmt_old->get_result();
$pr = $result->fetch_assoc();

if (!$pr) {
    echo "<script>alert('ไม่พบข้อมูลที่ต้องการแก้ไข'); window.history.back();</script>";
    exit;
}

if (isset($_POST['Submit'])) {
    $Pr_title = mysqli_real_escape_string($conn, $_POST['Pr_title']);
    $Pr_detail = mysqli_real_escape_string($conn, $_POST['Pr_detail']);
    $company_id = mysqli_real_escape_string($conn, $_POST['company_id']);
    $Pr_status = mysqli_real_escape_string($conn, $_POST['Pr_status']);
    $admin_id = $_SESSION['Admin_id'];
    $Pr_date = $pr['Pr_date']; // ใช้วันเดิม
    $Pr_year = $pr['Pr_year'];

    $uploadDir = "../images/public_relations/";
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    // กำหนดค่าเริ่มต้นเป็นรูปเดิม
    $pictures = [
        $pr['Pr_picture1'] ?? '',
        $pr['Pr_picture2'] ?? '',
        $pr['Pr_picture3'] ?? '',
        $pr['Pr_picture4'] ?? ''
    ];

    // ลบรูปตามที่ติ๊ก checkbox (ต้องทำก่อนการอัปโหลดรูปใหม่)
    // ลบรูปตาม checkbox
    if (isset($_POST['remove_picture']) && is_array($_POST['remove_picture'])) {
        foreach ($_POST['remove_picture'] as $index => $value) {
            if ($value == '1' && !empty($pictures[$index])) {
                $fileToDelete = $uploadDir . $pictures[$index];
                if (file_exists($fileToDelete)) {
                    unlink($fileToDelete); // ลบไฟล์จริง
                }
                $pictures[$index] = ''; // ล้างค่า เพื่ออัปเดต SQL
            }
        }
    }


    // จัดการอัปโหลดรูปใหม่ (ทำหลังจากลบรูปที่ไม่ต้องการแล้ว)
    if (isset($_FILES['pictures']) && is_array($_FILES['pictures']['name'])) {
        $uploadedCount = 0; // นับจำนวนรูปที่อัปโหลดสำเร็จ

        for ($i = 0; $i < count($_FILES['pictures']['name']); $i++) {
            if (
                isset($_FILES['pictures']['error'][$i]) &&
                $_FILES['pictures']['error'][$i] === UPLOAD_ERR_OK &&
                $_FILES['pictures']['size'][$i] > 0
            ) {
                $tmp_name = $_FILES['pictures']['tmp_name'][$i];
                $originalName = $_FILES['pictures']['name'][$i];
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                if (in_array($ext, $allowedTypes)) {
                    $timestamp = time();
                    $safeTitle = preg_replace("/[^a-zA-Z0-9ก-๙]/u", "_", $Pr_title);
                    $newName = $safeTitle . "_" . $timestamp . "-pr" . ($uploadedCount + 1) . "." . $ext;

                    $destination = $uploadDir . $newName;

                    // หาช่องว่างในอาร์เรย์ $pictures เพื่อใส่รูปใหม่
                    $emptySlotFound = false;
                    for ($j = 0; $j < 4; $j++) {
                        if (empty($pictures[$j])) {
                            if (move_uploaded_file($tmp_name, $destination)) {
                                $pictures[$j] = $newName;
                                $uploadedCount++;
                                $emptySlotFound = true;
                                break;  // ออกจากลูป เมื่อพบช่องว่างและอัปโหลดสำเร็จ
                            }
                        }
                    }

                    // ถ้าไม่มีช่องว่าง และมีรูปอัปโหลดเกิน 4 รูป จะไม่บันทึกรูปนั้น
                    if (!$emptySlotFound) {
                        // ไม่มีช่องว่างเหลือสำหรับรูปนี้
                        continue;
                    }
                }
            }
        }
    }

    // เตรียม SQL
    $sql_update = "UPDATE public_relations SET 
        Pr_picture1 = ?, Pr_picture2 = ?, Pr_picture3 = ?, Pr_picture4 = ?,
        Pr_title = ?, Pr_detail = ?, Company_id = ?, Pr_status = ?, Admin_id = ?
        WHERE Pr_id = ?";

    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param(
        "ssssssisii",
        $pictures[0],
        $pictures[1],
        $pictures[2],
        $pictures[3],
        $Pr_title,
        $Pr_detail,
        $company_id,
        $Pr_status,
        $admin_id,
        $id
    );

    if ($stmt->execute()) {
        echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว'); window.location='indexactivity.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}

?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลข่าวกิจกรรมสหกิจศึกษา</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
    <link rel="stylesheet" href="stylBEadd.CSS">
</head>

<body>
    <div class="container mt-5">
        <!-- ปุ่มกากบาทสำหรับกลับไปหน้าก่อน -->
        <button class="close-btn" onclick="window.history.back();">×</button>

        <h2 class="heading">แก้ไขข้อมูลข่าวกิจกรรมสหกิจศึกษา</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3 text-center">
            <label class="form-label">อัปโหลดรูปภาพ(สูงสุด 4 รูป)</label>
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                    <?php
                    $hasImages = false;
                    for ($i = 1; $i <= 4; $i++):
                        if (!empty($pr["Pr_picture$i"])):
                            $hasImages = true;
                    ?>
                            <input type="hidden" name="remove_picture[<?= $i - 1 ?>]" id="remove_picture_<?= $i - 1 ?>" value="0">
                            <div class="position-relative d-inline-block" id="image_wrapper_<?= $i - 1 ?>">
                                <img src="../images/public_relations/<?= htmlspecialchars($pr["Pr_picture$i"]) ?>" class="img-thumbnail" style="width: 120px; margin: 5px;">
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                    style="transform: translate(25%, -25%);"
                                    onclick="removeCurrentImage(<?= $i - 1 ?>)">×</button>
                            </div>

                        <?php
                        endif;
                    endfor;

                    if (!$hasImages):
                        ?>
                        <p class="text-muted">ไม่มีรูปภาพ</p>
                    <?php endif; ?>
                </div>

               
                <!-- พื้นที่แสดง preview รูปใหม่ -->
                <div id="previewContainer" class="mt-3 d-flex flex-wrap justify-content-center gap-2">
                    <p id="noImageText" class="text-muted">ไม่มีรูปภาพใหม่</p>
                </div>

                <input type="file" class="form-control mt-2" id="pictureInput" name="pictures[]" accept="image/*" multiple>
            </div>

            <div class="form-group">
                <label for="Pr_title" class="form-label">หัวข้อ</label>
                <input type="text" name="Pr_title" id="Pr_title" class="form-control" value="<?= htmlspecialchars($pr['Pr_title']) ?>" required autofocus>
            </div>

            <div class="form-group">
                <label for="Pr_detail" class="form-label">รายละเอียด</label>
                <textarea name="Pr_detail" id="Pr_detail" class="form-control" rows="4" required autofocus><?= htmlspecialchars($pr['Pr_detail']) ?></textarea>
            </div>

            <?php
            $sql = "SELECT * FROM company ORDER BY Company_id ASC";
            $result = mysqli_query($conn, $sql);

            // สร้าง array สำหรับจับคู่ชื่อกับ ID (JS ต้องใช้)
            $companies = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $companies[] = [
                    'id' => $row['Company_id'],
                    'name' => $row['NamecomTH']
                ];
            }
            ?>

            <div class="col-md- mb-3">
                <label class="form-label">
                    <i class="bi bi-briefcase-fill me-2" style="color: skyblue;"></i>พิมพ์หรือเลือกบริษัท
                </label>

                <!-- ผู้ใช้พิมพ์ชื่อบริษัท -->
                <input type="text" class="form-control" list="companyList" id="company_name_input" oninput="matchCompany()" value="<?= htmlspecialchars($pr['NamecomTH']) ?>" required>

                <!-- ค่า Company_id ที่ซ่อน -->
                <input type="hidden" name="company_id" id="company_id_hidden" value="<?= $pr['Company_id'] ?>">

                <!-- datalist แสดงชื่อบริษัท -->
                <datalist id="companyList">
                    <?php foreach ($companies as $c): ?>
                        <option value="<?= htmlspecialchars($c['name']) ?>"></option>
                    <?php endforeach; ?>
                </datalist>
            </div>

            <div class="form-group">
                <label for="Pr_status" class="form-label">Status</label>
                <select name="Pr_status" id="Pr_status" class="form-control" required>
                    <option value="0" <?= $pr['Pr_status'] == 0 ? 'selected' : '' ?>>ไม่แสดง</option>
                    <option value="1" <?= $pr['Pr_status'] == 1 ? 'selected' : '' ?>>แสดง</option>
                </select>
            </div>

            <div class="form-group text-center">
                <button type="submit" name="Submit" class="btn btn-primary">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>

    <script>
        // สร้าง Map ชื่อ -> ID (จาก PHP -> JS)
        const companyMap = <?= json_encode(array_column($companies, 'id', 'name')) ?>;

        function matchCompany() {
            const nameInput = document.getElementById('company_name_input').value.trim();
            const hiddenIdInput = document.getElementById('company_id_hidden');

            if (companyMap.hasOwnProperty(nameInput)) {
                hiddenIdInput.value = companyMap[nameInput];
            } else {
                hiddenIdInput.value = '';
            }
        }

        // ฟังก์ชันลบรูปภาพปัจจุบัน
        function removeCurrentImage(index) {
            const removeInput = document.getElementById('remove_picture_' + index);
            removeInput.value = '1';

            const wrapper = document.getElementById('image_wrapper_' + index);
            if (wrapper) {
                wrapper.remove();
            }
        }



        // แสดง preview รูปภาพใหม่ และลบได้
        const pictureInput = document.getElementById('pictureInput');
        const previewContainer = document.getElementById('previewContainer');
        const noImageText = document.getElementById('noImageText');

        let selectedFiles = []; // เก็บไฟล์ที่เลือกไว้

        pictureInput.addEventListener('change', function(event) {
            selectedFiles = Array.from(event.target.files); // อัปเดตรายการไฟล์ทั้งหมด
            updatePreview();
        });

        function updatePreview() {
            previewContainer.innerHTML = '';

            if (selectedFiles.length === 0) {
                noImageText.style.display = 'block';
            } else {
                noImageText.style.display = 'none';

                const maxFiles = Math.min(selectedFiles.length, 4);

                for (let i = 0; i < maxFiles; i++) {
                    const file = selectedFiles[i];
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const fileIndex = i; // จำ index ไว้ก่อน
                        const imgWrapper = document.createElement('div');
                        imgWrapper.className = 'position-relative d-inline-block';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-thumbnail';
                        img.style.width = '120px';
                        img.style.margin = '5px';

                        const removeBtn = document.createElement('button');
                        removeBtn.textContent = '×';
                        removeBtn.className = 'btn btn-sm btn-danger position-absolute top-0 end-0';
                        removeBtn.style.transform = 'translate(25%, -25%)';
                        removeBtn.type = 'button'; // ตั้งค่าให้เป็น type="button" เพื่อไม่ให้ submit form
                        removeBtn.onclick = function() {
                            selectedFiles.splice(fileIndex, 1);
                            updateInputFile();
                            updatePreview();
                        };

                        imgWrapper.appendChild(img);
                        imgWrapper.appendChild(removeBtn);
                        previewContainer.appendChild(imgWrapper);
                    };

                    reader.readAsDataURL(file);
                }
            }
        }

        // สร้าง input file ใหม่จาก selectedFiles
        function updateInputFile() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            pictureInput.files = dataTransfer.files;
        }
    </script>

    <script src="scriptBEadd.js"></script>
</body>

</html>