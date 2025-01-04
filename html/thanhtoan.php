<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/thanhtoan.css">
    <link rel="stylesheet" href="../font/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Orbitron:wght@400..900&family=Protest+Guerrilla&family=Shizuru&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="logo display">
            <img src="../image/logo.webp" alt="logo" style = "margin-top: 100px; margin-left:325%;"  >
        </div>
    </header>
    <div class="section">
        <a href="index.html" style="text-decoration: none;
                        color: #000;">Trang chủ</a>
        <span>/</span>
        <span>Thông tin thanh toán</span>
    </div>
    <div class = "flex-container">
        <div id="content" class="form-group" style="margin-left: 80px;">
            <h2>THÔNG TIN THANH TOÁN</h2>
            <div class="userbox">
                <form action="connt/.php" method="post">
                    <div class="flex-container">
                        <div class="form-group">
                            <input type="text" id="fullname" name="fullname" placeholder="Họ và tên" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="phone" name="phone" placeholder="Số điện thoại" required pattern="[0-9]{10}">
                        </div>
                    </div>
                    <input type="type" id="email" name="email" placeholder="Email" required>
                    <input type="text" id="location" name="location" placeholder="Địa chỉ" required>
                    
                    <div class = "flex-container diadiem">
                        <div class="form-group">
                            <select id="tinh_tp" style="cursor: pointer;" required>
                                <option value="">Chọn tỉnh/thành phố</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="quan_huyen" required disabled style="cursor: pointer;">
                                <option value="">Chọn quận huyện</option>
                            </select>
                        </div>
                        <div class="form-group" >
                            <select id="phuong_xa" required disabled style="cursor: pointer;">
                                <option value="">Chọn phường/xã</option>
                            </select>
                        </div>
                        




                        <script>
                            // Gọi API lấy danh sách tỉnh/thành phố
                            fetch('https://provinces.open-api.vn/api/p/')
                                .then(response => response.json())
                                .then(data => {
                                    const tinhTpDropdown = document.getElementById('tinh_tp');
                                    data.forEach(province => {
                                        const option = document.createElement('option');
                                        option.value = province.code;
                                        option.textContent = province.name;
                                        tinhTpDropdown.appendChild(option);
                                    });
                                })
                                .catch(error => console.error('Lỗi khi tải danh sách tỉnh/thành phố:', error));
                        
                            // Sự kiện khi chọn tỉnh/thành phố
                            document.getElementById('tinh_tp').addEventListener('change', function () {
                                const tinhTpCode = this.value;
                                const quanHuyenDropdown = document.getElementById('quan_huyen');
                                const phuongXaDropdown = document.getElementById('phuong_xa');
                                quanHuyenDropdown.innerHTML = '<option value="">Chọn quận huyện</option>'; // Xóa quận/huyện cũ
                                phuongXaDropdown.innerHTML = '<option value="">Chọn phường/xã</option>'; // Xóa phường/xã cũ
                                quanHuyenDropdown.disabled = true; // Vô hiệu hóa dropdown quận/huyện
                                phuongXaDropdown.disabled = true; // Vô hiệu hóa dropdown phường/xã
                        
                                if (tinhTpCode) {
                                    // Gọi API lấy danh sách quận/huyện dựa trên mã tỉnh
                                    fetch(`https://provinces.open-api.vn/api/p/${tinhTpCode}?depth=2`)
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.districts && data.districts.length > 0) {
                                                data.districts.forEach(district => {
                                                    const option = document.createElement('option');
                                                    option.value = district.code;
                                                    option.textContent = district.name;
                                                    quanHuyenDropdown.appendChild(option);
                                                });
                                                quanHuyenDropdown.disabled = false; // Bật dropdown quận/huyện
                                            }
                                        })
                                        .catch(error => console.error('Lỗi khi tải danh sách quận/huyện:', error));
                                }
                            });
                        
                            // Sự kiện khi chọn quận/huyện
                            document.getElementById('quan_huyen').addEventListener('change', function () {
                                const quanHuyenCode = this.value;
                                const phuongXaDropdown = document.getElementById('phuong_xa');
                                phuongXaDropdown.innerHTML = '<option value="">Chọn phường/xã</option>'; // Xóa phường/xã cũ
                                phuongXaDropdown.disabled = true; // Vô hiệu hóa dropdown phường/xã
                        
                                if (quanHuyenCode) {
                                    // Gọi API lấy danh sách phường/xã dựa trên mã quận/huyện
                                    fetch(`https://provinces.open-api.vn/api/d/${quanHuyenCode}?depth=2`)
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.wards && data.wards.length > 0) {
                                                data.wards.forEach(ward => {
                                                    const option = document.createElement('option');
                                                    option.value = ward.code;
                                                    option.textContent = ward.name;
                                                    phuongXaDropdown.appendChild(option);
                                                });
                                                phuongXaDropdown.disabled = false; // Bật dropdown phường/xã
                                            }
                                        })
                                        .catch(error => console.error('Lỗi khi tải danh sách phường/xã:', error));
                                }
                            });
                        </script>
                        
                    </div>
                    <br>
                        <g>Chọn phương thức thanh toán:</g>
                        <div class="form-check"><i class="fa-solid fa-wallet" style="font-size: 24px; color: #000;"></i>
                            <label class="form-check-label" for="cash">Thanh toán khi nhận hàng</label>
                            <input class="form-check-input" type="radio" name="payment" id="cash" value="cash">
                        </div>
                        <div class="form-check"><i class="fa-solid fa-credit-card" style="font-size: 24px; color: #000;"></i>
                            <label class="form-check-label" for="online">Thanh toán trên website</label>
                            <input class="form-check-input" type="radio" name="payment" id="online" value="online">
                        </div>



                    <div id="card-info" style="display: none; margin-top: 20px;">
                        <script>
                            document.addEventListener("DOMContentLoaded", function () {
                                const paymentRadios = document.querySelectorAll('input[name="payment"]');
                                const cardInfoDiv = document.getElementById('card-info');
                        
                                paymentRadios.forEach(radio => {
                                    radio.addEventListener('change', function () {
                                        if (this.value === 'online') {
                                            cardInfoDiv.style.display = 'block'; // Hiển thị bảng nhập mã thẻ
                                        } else {
                                            cardInfoDiv.style.display = 'none'; // Ẩn bảng nhập mã thẻ
                                        }
                                    });
                                });
                            });
                        </script>
                        <h4>Nhập thông tin thẻ:</h4>
                        <div class="form-group">
                            <input type="text" id="card-number" name="card-number" placeholder="Số thẻ" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="card-holder" name="card-holder" placeholder="Tên chủ thẻ" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="expiry-date" name="expiry-date" placeholder="Ngày hết hạn (MM/YY)" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="cvv" name="cvv" placeholder="CVV" required>
                        </div>
                    </div>


                    <button type="submit" class="btn">Thanh toán</button>
                </form>
            </div>  
        </div>
        <div id="content" class="form-group">
            <fieldset class="border p-4 rounded w-50 mx-auto">
                <?php include '../connt/thanhtoan.php'; ?>
            </fieldset>
        </div>
        
        
        
    </div>
    








    <footer>
        <div class="ft-1" style="transform: translateY(-100px);">
            <h3>THỜI TRANG PANTIO</h3>
            <p style="text-align: justify;">Luôn đón đầu các xu hướng thời trang trên thế giới, Pantio hướng tới phong cách thời trang tối giản, trẻ trung và hiện đại. Cùng Pantio tự tin định hình phong cách thời trang của chính mình, để đón nhận thành công trong cuộc sống. “Pantio - Thấu hiểu từng phong cách”.</p>
        </div>
        <div class="ft-1">
            <h3>Hỗ trợ mua hàng</h3>
            <ul class="link">
                <div class="collum">
                    <li><a href="index.html"><i class="fa-solid fa-right-long"></i>Tìm kiếm</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Chính sách mua hàng</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Chính sách đổi trả</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Chính sách bảo hành</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Chính sách thẻ thành viên - thẻ VIP</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Điều khoản dịch vụ</a></li>
                </div>
                <div class="collum">
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Áo nữ</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Áo dài nữ</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Áo 2 dây</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Áo khoác nữ</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Đồ ngủ nữ</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Đầm thời trang</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Đầm dự tiệc</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Quần dài nữ</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Quần short nữ</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Quần jean nữ</a></li>
                    <li><a href=""><i class="fa-solid fa-right-long"></i>Đầm hoa</a></li>
                </div>
                <div class="social-network" style="transform: translateY(50px);">
                    <i class="fa-brands fa-facebook-f" style="padding: 10px 13px;"></i>
                    <i class="fa-brands fa-youtube"></i>
                    <i class="fa-brands fa-instagram"></i>
                </div>
            </ul>
        </div>
        <div class="ft-1" style="transform: translateY(-40px);">
            <h3>Thông tin liên hệ</h3>
            <img src="../image/Screenshot 2024-12-02 234340.png" alt="">
        </div>
        <div class="ft-1">
            <h3>Fanpage</h3>
            <img src="https://img-cdn.pixlr.com/image-generator/history/65bb506dcb310754719cf81f/ede935de-1138-4f66-8ed7-44bd16efc709/medium.webp" alt="">
        </div>
    </footer>
    <div class="footer-bottom"></div>
</body>
</html>