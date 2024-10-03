<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Tiền Điện</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff4e6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #f4b183;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
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
    </style>
</head>
<body>

<div class="container">
    <h2>THANH TOÁN TIỀN ĐIỆN</h2>
    <form method="post">
        <label for="ten_chu_ho">Tên chủ hộ:</label>
        <input type="text" id="ten_chu_ho" name="ten_chu_ho" required>

        <label for="chi_so_cu">Chỉ số cũ (Kw):</label>
        <input type="text" id="chi_so_cu" name="chi_so_cu" required>

        <label for="chi_so_moi">Chỉ số mới (Kw):</label>
        <input type="text" id="chi_so_moi" name="chi_so_moi" required>

        <label for="don_gia">Đơn giá (VNĐ):</label>
        <input type="text" id="don_gia" name="don_gia" required>

        <?php
        $result = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $chi_so_cu = floatval($_POST['chi_so_cu']);
            $chi_so_moi = floatval($_POST['chi_so_moi']);
            $don_gia = floatval($_POST['don_gia']);

            // Tính số tiền thanh toán
            $so_tien = ($chi_so_moi - $chi_so_cu) * $don_gia;

            $result = "<div class='result'>
                        <p>Số tiền thanh toán: " . number_format($so_tien, 0, ',', '.') . " VNĐ</p>
                       </div>";
        }
        ?>

        <?php echo $result; ?>

        <button type="submit">Tính</button>
    </form>
</div>

</body>
</html>
