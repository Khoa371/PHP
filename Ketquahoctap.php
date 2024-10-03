<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả Học Tập</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f39c12, #e74c3c);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 15px;
            padding: 30px;
            width: 350px;
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1.2px;
        }

        label {
            color: #2c3e50;
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #ecf0f1;
            border-radius: 10px;
            font-size: 16px;
            color: #34495e;
            outline: none;
            transition: border 0.3s ease;
        }

        input[type="text"]:focus {
            border: 2px solid #e67e22;
        }

        .result {
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            font-size: 16px;
            color: #2c3e50;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        button {
            width: 100%;
            background-color: #e67e22;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        button:hover {
            background-color: #d35400;
            transform: scale(1.05);
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>KẾT QUẢ HỌC TẬP</h2>
        <form method="post">
            <label for="hk1">Điểm HK1:</label>
            <input type="text" id="hk1" name="hk1" required>

            <label for="hk2">Điểm HK2:</label>
            <input type="text" id="hk2" name="hk2" required>

            <?php
            $result = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $hk1 = floatval($_POST['hk1']);
                $hk2 = floatval($_POST['hk2']);
                $dtb = ($hk1 + $hk2 * 2) / 3;

                // Xét kết quả lên lớp
                $ketqua = ($dtb >= 5) ? "Được lên lớp" : "Ở lại lớp";

                // Xếp loại học lực
                if ($dtb >= 8) {
                    $xeploai = "Giỏi";
                } elseif ($dtb >= 6.5) {
                    $xeploai = "Khá";
                } elseif ($dtb >= 5) {
                    $xeploai = "Trung bình";
                } else {
                    $xeploai = "Yếu";
                }

                $result = "<div class='result'>
                            <p>Điểm trung bình: " . round($dtb, 2) . "</p>
                            <p>Kết quả: $ketqua</p>
                            <p>Xếp loại học lực: $xeploai</p>
                           </div>";
            }
            ?>

            <?php echo $result; ?>

            <button type="submit">Xem kết quả</button>
        </form>
    </div>

</body>

</html>
