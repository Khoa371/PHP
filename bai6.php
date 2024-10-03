<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Results & Electricity Bill Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff4e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .container {
            background-color: #f4b183;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-bottom: 20px;
        }
        .container h2 {
            text-align: center;
            color: white;
            font-size: 20px;
            margin-bottom: 20px;
        }
        label {
            color: white;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }
        .result {
            background-color: #fff3e6;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        button {
            width: 100%;
            background-color: #ff944d;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff8533;
        }
        .switch-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        .switch-buttons button {
            width: 150px;
        }
    </style>
</head>
<body>

<div class="switch-buttons">
    <button onclick="showForm('student')">Kết Quả Học Tập</button>
    <button onclick="showForm('electricity')">Tiền Điện</button>
</div>

<!-- Student Results Form -->
<div id="student" class="container" style="display: none;">
    <h2>KẾT QUẢ HỌC TẬP</h2>
    <form method="post" action="">
        <label for="diem_hk1">Điểm HK1:</label>
        <input type="text" id="diem_hk1" name="diem_hk1" required>

        <label for="diem_hk2">Điểm HK2:</label>
        <input type="text" id="diem_hk2" name="diem_hk2" required>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['diem_hk1']) && isset($_POST['diem_hk2'])) {
            $diem_hk1 = floatval($_POST['diem_hk1']);
            $diem_hk2 = floatval($_POST['diem_hk2']);

            // Tính điểm trung bình
            $dtb = ($diem_hk1 + 2 * $diem_hk2) / 3;
            $ket_qua = $dtb >= 5 ? "Được lên lớp" : "Ở lại lớp";
            if ($dtb >= 8) {
                $xep_loai = "Giỏi";
            } elseif ($dtb >= 6.5) {
                $xep_loai = "Khá";
            } elseif ($dtb >= 5) {
                $xep_loai = "Trung bình";
            } else {
                $xep_loai = "Yếu";
            }

            echo "<div class='result'>
                    <p>Điểm trung bình: " . round($dtb, 2) . "</p>
                    <p>Kết quả: $ket_qua</p>
                    <p>Xếp loại: $xep_loai</p>
                  </div>";
        }
        ?>

        <button type="submit">Xem kết quả</button>
    </form>
</div>

<!-- Electricity Bill Form -->
<div id="electricity" class="container" style="display: none;">
    <h2>THANH TOÁN TIỀN ĐIỆN</h2>
    <form method="post" action="">
        <label for="chi_so_cu">Chỉ số cũ (Kw):</label>
        <input type="text" id="chi_so_cu" name="chi_so_cu" required>

        <label for="chi_so_moi">Chỉ số mới (Kw):</label>
        <input type="text" id="chi_so_moi" name="chi_so_moi" required>

        <label for="don_gia">Đơn giá (VNĐ):</label>
        <input type="text" id="don_gia" name="don_gia" required>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chi_so_cu']) && isset($_POST['chi_so_moi']) && isset($_POST['don_gia'])) {
            $chi_so_cu = floatval($_POST['chi_so_cu']);
            $chi_so_moi = floatval($_POST['chi_so_moi']);
            $don_gia = floatval($_POST['don_gia']);

            // Tính số tiền thanh toán
            $so_tien = ($chi_so_moi - $chi_so_cu) * $don_gia;

            echo "<div class='result'>
                    <p>Số tiền thanh toán: " . number_format($so_tien, 0, ',', '.') . " VNĐ</p>
                  </div>";
        }
        ?>

        <button type="submit">Tính</button>
    </form>
</div>

<script>
    function showForm(form) {
        document.getElementById('student').style.display = form === 'student' ? 'block' : 'none';
        document.getElementById('electricity').style.display = form === 'electricity' ? 'block' : 'none';
    }
</script>

</body>
</html>
