<?php
require_once('../../connt/connect.php');
global $conn;
$hid=$_GET["hid"];
$edit_sql="SELECT * FROM users WHERE id='$hid'";
$result=mysqli_query($conn,$edit_sql);
$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sửa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .container {
            margin-top: 50px;
        }
        .panel {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(10px);
            border-radius: 10px;
        }
        .panel-heading {
            background-color: #1f9cca ;
            color: #ffffff ;
            padding: 20px;
        }
        .btn {
            border-radius: 25px;
        }
        select.form-control {
            display: inline-block;
            width: auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <h2><strong>BẢNG SỬA CHỮA</strong></h2>
        </div>
        <div class="panel-body">
            <form action="update.php" method="post" id="form">
                <input type="hidden" name="hid" value="<?php echo $hid?>">
                <div class="form-group">
                    <label for="full_Name"><strong>Họ và tên</strong></label>
                    <input type="text" id="fullname" name="fullname" placeholder="Điền họ và tên" class="form-control" value="<?php echo $row["fullname"]?>">
                </div>
                <div class="form-group">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $row["email"]?>">
                </div>
                <div class="form-group">
                    <label for="phone"><strong>Số điện thoại</strong></label>
                    <input type="text" id="phone" name="phone" placeholder="Điền số điện thoại" class="form-control" value="<?php echo $row["phone"]?>">
                </div>
                <div class="form-group">
                    <label for="password"><strong>Mật khẩu</strong></label>
                    <input type="password" id="password" name="password" placeholder="Điền mật khẩu" class="form-control" value="<?php echo $row["password"]?>">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Xác nhận</button>
                    <button type="reset" class="btn btn-danger btn-lg">Hủy</button>
                    <a href="home.php" class="btn btn-info btn-lg">Quay lại trang chủ</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

