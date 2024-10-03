<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHIẾU ĐĂNG KÝ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: linear-gradient(135deg, #e2ebf0, #f6f9fc);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-10px);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            font-size: 28px;
            letter-spacing: 2px;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
            color: #34495e;
            font-size: 16px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            margin-top: 8px;
            border: 2px solid #ddd;
            border-radius: 8px;
            background-color: #f8f8f8;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            border-color: #3498db;
            background-color: #fff;
            outline: none;
        }

        input[type="file"] {
            margin-top: 10px;
            font-size: 14px;
        }

        .hobbies input {
            margin-right: 10px;
        }

        .hobbies {
            margin-top: 10px;
        }

        .footer-buttons {
            margin-top: 25px;
            text-align: center;
        }

        .footer-buttons input[type="submit"],
        .footer-buttons input[type="reset"] {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .footer-buttons input[type="reset"] {
            background-color: #e74c3c;
        }

        .footer-buttons input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .footer-buttons input[type="reset"]:hover {
            background-color: #c0392b;
        }

        .gender-options {
            margin-top: 10px;
        }

        .gender-options input[type="radio"] {
            margin-right: 5px;
        }

        img {
            display: block;
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .container {
                padding: 50px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>PHIẾU ĐĂNG KÝ</h2>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $address = $_POST['address'] ?? '';
            $email = $_POST['email'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $age = $_POST['age'] ?? '';
            $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "Không có";
            $field = $_POST['field'] ?? '';
            $requirement = $_POST['requirement'] ?? '';

            // Xử lý tải ảnh
            $image_message = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
                $filename = $_FILES["image"]["name"];
                $filetype = $_FILES["image"]["type"];
                $filesize = $_FILES["image"]["size"];

                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!array_key_exists($ext, $allowed)) {
                    die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");
                }

                $maxsize = 5 * 1024 * 1024;
                if ($filesize > $maxsize) {
                    die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
                }

                if (in_array($filetype, $allowed)) {
                    if (file_exists("upload/" . $filename)) {
                        $image_message = $filename . " đã tồn tại.";
                    } else {
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $filename)) {
                            $image_message = "Tệp của bạn đã được tải lên thành công.";
                        } else {
                            $image_message = "Lỗi: không thể di chuyển tệp đến thư mục 'upload/'.";
                        }
                    }
                } else {
                    $image_message = "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại.";
                }
            } else {
                $image_message = "Lỗi tải tệp: " . $_FILES["image"]["error"];
            }

            echo "
            <h3>Thông tin đăng ký của bạn:</h3>
            <p><strong>Họ và tên:</strong> $name</p>
            <p><strong>Địa chỉ:</strong> $address</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Giới tính:</strong> $gender</p>
            <p><strong>Tuổi:</strong> $age</p>
            <p><strong>Sở thích:</strong> $hobbies</p>
            <p><strong>Chuyên ngành:</strong> $field</p>
            <p><strong>Yêu cầu:</strong> $requirement</p>
            <p><strong>Hình ảnh:</strong> $image_message</p>";
            echo "<img src='upload/$filename' alt='Image Preview'>";
        } else {
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label>Giới tính:</label>
            <div class="gender-options">
                <input type="radio" id="male" name="gender" value="Nam" required> Nam
                <input type="radio" id="female" name="gender" value="Nữ" required> Nữ
            </div>

            <label for="age">Tuổi:</label>
            <input type="number" id="age" name="age" required>

            <label>Sở thích:</label>
            <div class="hobbies">
                <input type="checkbox" name="hobbies[]" value="Thể thao"> Thể thao
                <input type="checkbox" name="hobbies[]" value="Văn học"> Văn học
                <input type="checkbox" name="hobbies[]" value="Công nghệ thông tin"> Công nghệ thông tin
                <input type="checkbox" name="hobbies[]" value="Lịch sử"> Lịch sử
                <input type="checkbox" name="hobbies[]" value="Game"> Game
            </div>

            <label for="field">Chuyên ngành:</label>
            <select id="field" name="field">
                <option value="Công nghệ Web">Công nghệ Web</option>
                <option value="Khoa học máy tính">Khoa học máy tính</option>
                <option value="Trí tuệ nhân tạo">Trí tuệ nhân tạo</option>
                <option value="Bảo mật thông tin">Bảo mật thông tin</option>
            </select>

            <label for="requirement">Yêu cầu khác:</label>
            <textarea id="requirement" name="requirement" rows="4"></textarea>

            <label for="image">Chọn ảnh:</label>
            <input type="file" id="image" name="image" accept="image/*">

            <div class="footer-buttons">
                <input type="submit" value="Gửi">
                <input type="reset" value="Xóa">
            </div>
        </form>

        <?php
        }
        ?>
    </div>
</body>

</html>
