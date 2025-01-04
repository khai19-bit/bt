<?php
require "connect.php"; // Kết nối đến cơ sở dữ liệu
global $conn;

$phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
$pass = isset($_POST["password"]) ? $_POST["password"] : null;
$check = isset($_POST["checkpass"]) ? $_POST["checkpass"] : null;

if ($phone && $pass && $check) {
    if ($pass === $check) {
        // Kiểm tra xem số điện thoại đã tồn tại trong cơ sở dữ liệu hay chưa
        $checkPhoneQuery = "SELECT * FROM user WHERE phone = '$phone'";
        $result = mysqli_query($conn, $checkPhoneQuery);

        if (mysqli_num_rows($result) > 0) {
            // Nếu số điện thoại đã tồn tại, yêu cầu người dùng quay lại trang đăng ký
            echo "<script>
                alert('Số điện thoại đã tồn tại. Vui lòng đăng ký với số khác.');
                window.location.href = '../Thuchiendangky.html';
            </script>";
            exit;
        } else {
            // Thêm dữ liệu vào cơ sở dữ liệu nếu số điện thoại chưa tồn tại
            $addsql = "INSERT INTO user (phone, password) VALUES ('$phone', '$pass')";
            if (mysqli_query($conn, $addsql)) {
                echo "<script>
                    alert('Đăng ký thành công!');
                    window.location.href = '../Dangky.html'; // Chuyển hướng tới trang chủ
                </script>";
            } else {
                echo "<script>
                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    window.location.href = '../Thuchiendangky.html';
                </script>";
            }
        }
    } else {
        // Nếu mật khẩu không khớp
        echo "<script>
            alert('Mật khẩu không khớp. Vui lòng thử lại.');
            window.location.href = '../Thuchiendangky.html';
        </script>";
    }
} else {
    echo "<script>
        alert('Vui lòng điền đầy đủ thông tin.');
        window.location.href = '../Thuchiendangky.html';
    </script>";
}
?>
