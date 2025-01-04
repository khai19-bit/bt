<?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pantio";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID sản phẩm từ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Truy vấn để lấy thông tin sản phẩm
$sql = "SELECT name, price, quantity, image FROM product WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo '<div class="product text-center">';
    echo '<h1 class="text-primary">' . htmlspecialchars($row['name']) . '</h1>';
    echo '<img src="' . htmlspecialchars($row['image']) . '" alt="ảnh sản phẩm" class="img-fluid rounded" style="max-height: 300px;">';
    echo '<p class="text-success fw-bold mt-3">Giá: ' . number_format($row['price'], 0, ',', '.') . 'đ</p>';
    echo '<p>Số lượng: ' . htmlspecialchars($row['quantity']) . '</p>';
    echo '</div>';
} else {
    echo "<p>Không tìm thấy sản phẩm!</p>";
}

$conn->close();
?>
 