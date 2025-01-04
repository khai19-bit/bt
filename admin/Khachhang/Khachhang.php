<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visual Admin Dashboard - Manage Users</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/templatemo-style.css" rel="stylesheet">

</head>
<body>
<div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
            <div class="square"></div>
            <h1>Visual Admin</h1>
        </header>
        <div class="profile-photo-container">
            <img src="../images/profile-photo.jpg" alt="Profile Photo" class="img-responsive">
        </div>
        <form class="templatemo-search-form" role="search">
            <div class="input-group">
                <button type="submit" class="fa fa-search"></button>
                <input type="text" class="form-control" placeholder="Search" name="srch-term">
            </div>
        </form>
        <nav class="templatemo-left-nav">
            <ul>
                <li><a href="../trangchu/Trangchu.php"><i class="fa fa-home fa-fw"></i>TRANG CHỦ</a></li>
                <li><a href="../thongtin/Thongtin.php"><i class="fa fa-bar-chart fa-fw"></i>THÔNG TIN SẢN PHẨM</a></li>
                <li><a href="#" class="active"><i class="fa fa-users fa-fw"></i>THÔNG TIN KHÁCH HÀNG</a></li>
                <li><a href="../dondathang/dondathang.php"><i class="fa fa-sliders fa-fw"></i>ĐƠN ĐẶT HÀNG</a></li>
                <li><a href="../../Dangky.html"><i class="fa fa-eject fa-fw"></i>ĐĂNG XUẤT</a></li>
            </ul>
        </nav>
    </div>
    <div class="templatemo-content col-1 light-gray-bg">
        <div class="templatemo-top-nav-container">
            <nav class="templatemo-top-nav text-right">
                <ul class="text-uppercase">
                    <li><a href="login.html">Sign out</a></li>
                    <img src="../../img/357444673_1702327550214019_4545460425657428332_n.jpg" alt="" class="img-thumbnail" style="width: 50px; height: 50px; border-radius: 25px;">
                </ul>
            </nav>
        </div>
        <div class="container">
            <div class="panel panel-primary">
                <div class="panel-heading text-center" style="background: #1f9cca">
                    <h2><strong><i class="fas fa-table"></i> BẢNG KHÁCH HÀNG</strong></h2>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-inline text-center" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Nhập thông tin tìm kiếm" style="width: 300px;">
                        </div>
                        <button type="submit" name="find" class="btn btn-info">Tìm kiếm
                        </button>
                        <a href="" class="btn btn-secondary">
                            <i class="fas fa-list"></i> Hiển thị tất cả
                        </a>
                        <a href="index.php" class="btn btn-success" style="margin-left: 10px">
                            <i class=" fas fa-user-plus"></i> Thêm khách hàng
                        </a>

                    </form>

                    <?php
                    require_once("../../connt/connect.php");
                    global $conn;

                    $sql = "SELECT * FROM users";

                    if (isset($_POST['find'])) {
                        $search = $_POST['search'];

                        if (!empty($search)) {
                            $sql = "SELECT * FROM users WHERE fullname LIKE '%$search%' ";
                        }
                    }

                    $result = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($result);

                    if (isset($_POST['find']) && empty($search)) {
                        echo '<div class="alert alert-warning text-center">Vui lòng nhập để tìm kiếm.</div>';
                    } elseif (isset($_POST['find']) && $count <= 0) {
                        echo '<div class="alert alert-danger text-center">Không tìm thấy kết quả nào với từ khóa: <strong>' . $search . '</strong></div>';
                    } elseif (isset($_POST['find']) && $count > 0) {
                        echo '<div class="alert alert-success text-center">Tìm thấy <strong>' . $count . '</strong> kết quả với từ khóa: <strong>' . $search . '</strong></div>';
                    }
                    ?>

                    <table class="table table-bordered table-hover text-center">
                        <thead class="bg-info">
                        <tr>
                            <th style="text-align: center">ID</th>
                            <th style="text-align: center">Họ và tên</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Số điện thoại</th>
                            <th style="text-align: center">Mật khẩu</th>
                            <th style="text-align: center">Tùy chọn</th>

                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        while ($r = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $r['id'] ?></td>
                                <td><?php echo $r['fullname'] ?></td>
                                <td><?php echo $r['email'] ?></td>
                                <td><?php echo $r['phone'] ?></td>
                                <td><?php echo $r['password'] ?></td>
                                <td>
                                    <a href="edit.php?hid=<?php echo $r['id'] ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <a onclick="return confirm('Bạn có muốn xóa thành viên này không?');"
                                       class="btn btn-danger btn-sm" href="delete.php?hid=<?php echo $r['id'] ?>">
                                        <i class="fas fa-trash-alt"></i> Xóa
                                    </a>

                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="text-right">
    <p>Designed by <a href="#" target="_parent">LD:1203</a></p>
</footer>
<script src="../js/jquery-1.11.2.min.js"></script>
<script src="../js/templatemo-script.js"></script>
<script>
    $(document).ready(function() {
        var imageUrl = $('img.content-bg-img').attr('src');
        $('.templatemo-content-img-bg').css('background-image', 'url(' + imageUrl + ')');
        $('img.content-bg-img').hide();
    });
</script>
</body>
</html>
