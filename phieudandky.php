<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHIẾU ĐĂNG KÝ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e9eff1;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: linear-gradient(135deg, #f5f8fa, #ffffff);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            position: relative;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h2 {
            text-align: center;
            color: #34495e;
            font-size: 32px;
            letter-spacing: 2px;
            margin-bottom: 20px;
            text-transform: uppercase;
        }

        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
            color: #4a4a4a;
            font-size: 16px;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 15px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            font-size: 16px;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus,
        textarea:focus,
        select:focus {
            border-color: #3498db;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
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
            padding: 15px 40px;
            border: none;
            border-radius: 30px;
            background-color: #3498db;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-right: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .footer-buttons input[type="reset"] {
            background-color: #e74c3c;
        }

        .footer-buttons input[type="submit"]:hover,
        .footer-buttons input[type="reset"]:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
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
            <select id="field" name="field" required>
                <option value="">-- Chọn chuyên ngành --</option>
                <option value="Khoa học máy tính">Khoa học máy tính</option>
                <option value="Kỹ thuật phần mềm">Kỹ thuật phần mềm</option>
                <option value="Quản trị kinh doanh">Quản trị kinh doanh</option>
                <option value="Tài chính">Tài chính</option>
            </select>

            <label for="requirement">Yêu cầu:</label>
            <textarea id="requirement" name="requirement" rows="4" placeholder="Nhập yêu cầu của bạn..."></textarea>

            <label for="image">Tải lên hình ảnh:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <div class="footer-buttons">
                <input type="submit" value="Gửi">
                <input type="reset" value="Đặt lại">
            </div>
        </form>
        <?php } ?>
    </div>
</body>

</html>
