<?php 
session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/taikhoan.php';  // Model AdminTaiKhoan


// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/'                 => (new HomeController())->home(),
    // 'list-san-pham' => (new HomeController())->dssanpham(),

    // 'danh-sach-san-pham' => (new HomeController())->danhSachSanPham(),
      //đăng kí đăng nhập client
    'login' => (new HomeController())->formlogin(),
    'check-login' => (new HomeController())->postLogin(),
    'register' => (new HomeController())->formRegister(),
    'check-register' => (new HomeController())->postRegister(),
    'logout-clinet' => (new HomeController())->Logout(),

        // thông tin chi tiết khách hàng
    'chi-tiet-khach-hang' => (new HomeController())->chiTietKhachHang(),
    'sua-khach-hang' => (new HomeController())->suaKhachHang(),
    'doi-mat-khau-khach-hang' => (new HomeController())->doiMatKhauKhachHang(),
};