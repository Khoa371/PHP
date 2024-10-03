<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Đăng Ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        p {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Đăng Ký</h2>
        <form method="post" action="">
            <label for="name">Họ tên:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label>Đăng ký học:</label>
            <input type="checkbox" id="html" name="subjects[]" value="HTML">
            <label for="html">HTML</label>
            <input type="checkbox" id="css" name="subjects[]" value="CSS">
            <label for="css">CSS</label><br><br>

            <label>Giới tính:</label>
            <input type="radio" id="male" name="gender" value="Nam">
            <label for="male">Nam</label>
            <input type="radio" id="female" name="gender" value="Nữ">
            <label for="female">Nữ</label><br><br>

            <label for="city">Thành phố:</label>
            <select id="city" name="city">
                <option value="Hà Nội">Hà Nội</option>
                <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                <option value="Đà Nẵng">Đà Nẵng</option>
            </select><br><br>

            <label for="message">Tin nhắn:</label><br>
            <textarea id="message" name="message" rows="4" cols="50" placeholder="Viết tin nhắn..."></textarea><br><br>

            <button type="submit" name="submit">Gửi</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Handle form data after submission
            $name = htmlspecialchars($_POST['name']);
            $password = htmlspecialchars($_POST['password']);
            $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '';
            $city = htmlspecialchars($_POST['city']);
            $message = htmlspecialchars($_POST['message']);
            $subjects = isset($_POST['subjects']) ? implode(', ', $_POST['subjects']) : '';

            // Display submitted information
            echo '<h3>Thông tin nhận được:</h3>';
            echo '<p><strong>Họ tên:</strong> ' . $name . '</p>';
            echo '<p><strong>Password:</strong> ' . $password . '</p>';
            echo '<p><strong>Đăng ký học:</strong> ' . $subjects . '</p>';
            echo '<p><strong>Giới tính:</strong> ' . $gender . '</p>';
            echo '<p><strong>Thành phố:</strong> ' . $city . '</p>';
            echo '<p><strong>Tin nhắn:</strong> ' . $message . '</p>';
        }
        ?>
    </div>
</body>
</html>