<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu Đăng Ký</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="number"], select, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="radio"], input[type="checkbox"] {
            margin-right: 10px;
        }
        .hobbies {
            margin-bottom: 10px;
        }
        input[type="submit"], input[type="reset"] {
            width: 48%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
        }
        input[type="reset"] {
            background-color: #f44336;
            color: #fff;
        }
        .gender, .hobbies {
            margin-bottom: 15px;
        }
        .gender input, .hobbies input {
            margin-right: 5px;
        }
        .footer-buttons {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>PHIẾU ĐĂNG KÝ</h2>
        <form method="post" enctype="multipart/form-data" >
            <label for="name">Họ và tên (*) :</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Địa chỉ :</label>
            <input type="text" id="address" name="address">

            <label for="email">Email (*) :</label>
            <input type="email" id="email" name="email" required>

            <label>Giới tính (*) :</label>
            <div class="gender">
                <input type="radio" id="male" name="gender" value="Nam" required>
                <label for="male">Nam</label>
                <input type="radio" id="female" name="gender" value="Nữ">
                <label for="female">Nữ</label>
            </div>

            <label for="age">Tuổi (*) :</label>
            <input type="number" id="age" name="age" required>

            <label>Sở thích :</label>
            <div class="hobbies">
                <input type="checkbox" name="hobbies[]" value="Thể thao"> Thể thao
                <input type="checkbox" name="hobbies[]" value="Văn học"> Văn học
                <input type="checkbox" name="hobbies[]" value="Công nghệ thông tin"> Công nghệ thông tin
                <input type="checkbox" name="hobbies[]" value="Lịch sử"> Lịch sử
                <input type="checkbox" name="hobbies[]" value="Game"> Game
            </div>

            <label for="field">Chuyên ngành :</label>
            <select id="field" name="field">
                <option value="Công nghệ Web">Công nghệ Web</option>
                <option value="Khoa học máy tính">Khoa học máy tính</option>
                <option value="Mạng máy tính">Mạng máy tính</option>
            </select>

            <label for="image">Gửi hình :</label>
            <input type="file" id="image" name="photo">

            <label for="requirement">Yêu cầu :</label>
            <textarea id="requirement" name="requirement"></textarea>

            <div class="footer-buttons">
                <input type="submit" name="submit" value="Gửi thông tin">
                <input type="reset" value="Nhập lại">
            </div>
        </form>

        <?php

        if (isset($_POST['submit']))

        
         {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $hobbies = isset($_POST['hobbies']) ? implode(", ", $_POST['hobbies']) : "Không có";
            $field = $_POST['field'];
            $requirement = $_POST['requirement'];

            // Xử lý hình ảnh
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                // Kiểm tra xem tệp đã được tải lên mà không có lỗi hay không
               if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
                   $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
                   $filename = $_FILES["photo"]["name"];
                   $filetype = $_FILES["photo"]["type"];
                   $filesize = $_FILES["photo"]["size"];
               
                   // Xác minh phần mở rộng tệp
                   $ext = pathinfo($filename, PATHINFO_EXTENSION);
                   if(!array_key_exists($ext, $allowed)) die("Lỗi: Vui lòng chọn định dạng tệp hợp lệ.");
               
                   // Xác minh kích thước tệp - tối đa 5MB
                   $maxsize = 5 * 1024 * 1024;
                   if($filesize > $maxsize) die("Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.");
               
                   // Xác minh loại MIME của tệp
                   if(in_array($filetype, $allowed)){
                       // Kiểm tra xem tệp có tồn tại hay không trước khi tải lên
                       if(file_exists("upload/" . $filename)){
                           echo $filename . " đã tồn tại.";
                       } else{
                           //echo $_FILES["photo"]["tmp_name"];
                           if(move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $filename)){ // có thể có lỗi
                               echo "Tệp của bạn đã được tải lên thành công.";
                            //    $imge_dir="upload/";
                            //    $img_file= $imge_dir.$filename;
                           }else{
                               echo "Lỗi: không thể di chuyển tệp đến upload/";
                           }
                       } 
                   } else{
                       echo "Lỗi: Đã xảy ra sự cố khi tải tệp của bạn lên. Vui lòng thử lại."; 
                   }
               } else{
                   echo "Error: " . $_FILES["photo"]["error"];
               }
           }
        
            // Hiển thị thông tin
            echo "<h3>Thông tin đăng ký</h3>";
            echo "<p>Họ và tên: $name</p>";
            echo "<p>Địa chỉ: $address</p>";
            echo "<p>Email: $email</p>";
            echo "<p>Giới tính: $gender</p>";
            echo "<p>Tuổi: $age</p>";
            echo "<p>Sở thích: $hobbies</p>";
            echo "<p>Chuyên ngành: $field</p>";
            echo "<p>Yêu cầu: $requirement</p>";
            echo "<img src='" ."upload/" . $filename ."' width='300px' height='300px' >";          
            }
        ?>
    </div>
</body>
</html>