<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán Tiền Điện</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffd966;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #d35400;
            font-size: 24px;
            font-family: 'Arial Black', sans-serif;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            text-align: left;
        }
        input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #e67e22;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #d35400;
        }
        .result {
            font-weight: bold;
            margin-top: 20px;
            color: #e74c3c;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>THANH TOÁN TIỀN ĐIỆN</h2>
        <form method="POST" action="">
            <label for="tenchuho">Tên chủ hộ:</label>
            <input type="text" id="tenchuho" name="tenchuho" value="<?php echo isset($_POST['tenchuho']) ? $_POST['tenchuho'] : ''; ?>" required>

            <label for="chisocu">Chỉ số cũ (Kw):</label>
            <input type="text" id="chisocu" name="chisocu" value="<?php echo isset($_POST['chisocu']) ? $_POST['chisocu'] : ''; ?>" required>

            <label for="chisomoi">Chỉ số mới (Kw):</label>
            <input type="text" id="chisomoi" name="chisomoi" value="<?php echo isset($_POST['chisomoi']) ? $_POST['chisomoi'] : ''; ?>" required>

            <label for="dongia">Đơn giá (VNĐ):</label>
            <input type="text" id="dongia" name="dongia" value="<?php echo isset($_POST['dongia']) ? $_POST['dongia'] : ''; ?>" required>

            <input type="submit" value="Tính">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $chisocu = $_POST['chisocu'];
            $chisomoi = $_POST['chisomoi'];
            $dongia = $_POST['dongia'];

            if (is_numeric($chisocu) && is_numeric($chisomoi) && is_numeric($dongia)) {
                $sotienthanhtoan = ($chisomoi - $chisocu) * $dongia;
                echo "<div class='result'>Số tiền thanh toán: " . number_format($sotienthanhtoan, 0, ',', '.') . " VNĐ</div>";
            } else {
                echo "<div class='result' style='color:red;'>Vui lòng nhập dữ liệu hợp lệ!</div>";
            }
        }
        ?>
    </div>

</body>
</html>
