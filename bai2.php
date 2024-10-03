<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Học Tập</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: linear-gradient(to right, #ff5e99, #ff9bb2);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
        h2 {
            text-align: center;
            font-size: 24px;
            color: darkred;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="number"], input[type="text"] {
            width: calc(100% - 20px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>KẾT QUẢ HỌC TẬP</h2>
    <form method="POST">
        <label for="diemhk1">Điểm HK1:</label>
        <input type="number" id="diemhk1" name="diemhk1" step="0.1" required>

        <label for="diemhk2">Điểm HK2:</label>
        <input type="number" id="diemhk2" name="diemhk2" step="0.1" required>

        <label for="diemtrungbinh">Điểm trung bình:</label>
        <input type="text" id="diemtrungbinh" name="diemtrungbinh" readonly>

        <label for="ketqua">Kết quả:</label>
        <input type="text" id="ketqua" name="ketqua" readonly>

        <label for="xeploaihocluc">Xếp loại học lực:</label>
        <input type="text" id="xeploaihocluc" name="xeploaihocluc" readonly>

        <input type="submit" name="submit" value="Xem kết quả">
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $diemhk1 = $_POST['diemhk1'];
    $diemhk2 = $_POST['diemhk2'];

    // Tính điểm trung bình
    $diemtrungbinh = ($diemhk1 + $diemhk2 * 2) / 3;
    
    // Xác định kết quả và xếp loại học lực
    $ketqua = ($diemtrungbinh >= 5) ? "Được lên lớp" : "Ở lại lớp";
    if ($diemtrungbinh >= 8) {
        $xeploaihocluc = "Giỏi";
    } elseif ($diemtrungbinh >= 6.5) {
        $xeploaihocluc = "Khá";
    } elseif ($diemtrungbinh >= 5) {
        $xeploaihocluc = "Trung bình";
    } else {
        $xeploaihocluc = "Yếu";
    }
    // In kết quả ra form
    echo "<script>
        document.getElementById('diemtrungbinh').value = '".number_format($diemtrungbinh, 1)."';
        document.getElementById('ketqua').value = '".$ketqua."';
        document.getElementById('xeploaihocluc').value = '".$xeploaihocluc."';
    </script>";
}
?>

</body>
</html>