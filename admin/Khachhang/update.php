<?php
require_once('../../connt/connect.php');
global $conn;
$hmid=$_POST["hid"];
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$phone =$_POST["phone"];
$password =$_POST["password"];

if(isset($fullname, $email, $phone, $password) && $fullname !== '' && $email !== '' && $phone !== '' && $password !== '') {
    $update_sql = "UPDATE users SET `fullname`='$fullname', `email`='$email', `phone`='$phone', `password`='$password' WHERE id='$hmid' ";
    if (mysqli_query($conn, $update_sql)) {
        echo "Cập nhật thành công!";
        header("Location: Khachhang.php");

    } else {
        echo "Lỗi: " . mysqli_error($conn);
        exit;
    }
}
else{
    echo ("Vui lòng điền đầy đủ thông tin.");
    exit;
}
?>
