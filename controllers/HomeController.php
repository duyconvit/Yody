<?php
require_once './models/GioHang.php';
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/taikhoan.php';
require_once './models/DonHang.php';
class HomeController
{
    public $modelSanPham;
    public $modelGioHang;
    public $danhMuc;
    public $modelTaiKhoan;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->danhMuc = new DanhMuc();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function dssanpham()
    {
        $danhMucId = isset($_GET['danh_muc_id']) ? intval($_GET['danh_muc_id']) : 0;
        $listDanhMuc = $this->danhMuc->getAllDanhMuc();

        if ($danhMucId > 0) {
            $listSanPham = $this->modelSanPham->getListSanPhamDanhMuc($danhMucId);
        } else {
            $listSanPham = $this->modelSanPham->getAllSanPham();
        }

        require_once './views/dssanpham.php';
    }

    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        unset($_SESSION['errors']); // Xóa thông báo lỗi sau khi hiển thị
    }
    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if (is_array($user)) { // Kiểm tra nếu $user là mảng
                $_SESSION['user_client_id'] = $user['id'];
                $_SESSION['user_client'] = $user['email'];
                header("Location: " . BASE_URL);
                exit();
            } else {
                $_SESSION['errors'] = is_array($user) ? implode('<br>', $user) : $user;
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    // Hiển thị form đăng ký
    public function formRegister()
    {
        require_once './views/auth/formRegister.php'; // Truyền đến view đăng ký
    }
    // Xử lý đăng ký
    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ho_ten = $_POST['ho_ten'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $dia_chi = $_POST['dia_chi'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Kiểm tra giới tính chỉ có "Nam" hoặc "Nữ"
            if (!in_array($gioi_tinh, ['Nam', 'Nữ'])) {
                $_SESSION['errors'] = 'Giới tính không hợp lệ. Vui lòng chọn Nam hoặc Nữ.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // Kiểm tra ngày sinh phải trước năm hiện tại
            $currentYear = date("Y");
            $birthYear = date("Y", strtotime($ngay_sinh));
            if ($birthYear >= $currentYear) {
                $_SESSION['errors'] = 'Ngày sinh không hợp lệ. Vui lòng chọn năm trước năm hiện tại.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp không
            if ($password !== $confirm_password) {
                $_SESSION['errors'] = 'Mật khẩu và xác nhận mật khẩu không khớp.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // Gọi phương thức từ Model để xử lý đăng ký
            $result = $this->modelTaiKhoan->registerUser(
                $ho_ten,
                $ngay_sinh,
                $so_dien_thoai,
                $gioi_tinh,
                $dia_chi,
                $email,
                $password
            );

            if ($result === true) { // Đăng ký thành công
                $_SESSION['register_success'] = 'Đăng ký thành công. Vui lòng đăng nhập!';
                header("Location: " . BASE_URL . '?act=login');
                exit();
            } else { // Thông báo lỗi nếu có
                $_SESSION['errors'] = $result;
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }
        }
    }
    // Xử lý đăng xuất
    public function Logout()
    {
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']);
            unset($_SESSION['user_client_id']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            unset($_SESSION['admin_id']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
        if (isset($_SESSION['ho_ten'])) {
            unset($_SESSION['ho_ten']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
    }
    public function chiTietKhachHang()
    {
        if (!isset($_SESSION['user_client'])) {
            $_SESSION['message'] = 'Bạn chưa đăng nhập.';
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
        
        $email = $_SESSION['user_client'];
        // var_dump($email);die();
        $listTaiKhoan = $this->modelTaiKhoan->getTaiKhoanformEmail($email);
        // var_dump($listTaiKhoan);die();
        require_once './views/chiTietKhachHang.php';
    }

    public function suaKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_SESSION['user_client'])) {
            // Lấy dữ liệu
            $id = $_POST['id'];
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;

            // var_dump($_POST);die();

            // Validate
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Giới tính không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }

            $_SESSION['errors'] = $errors;

            $boSuuTapOld = $this->modelTaiKhoan->getIdTaiKhoan($id);
            $old_file = $boSuuTapOld['anh_dai_dien'];

            if (is_array($anh_dai_dien) && isset($anh_dai_dien['error']) && $anh_dai_dien['error'] == UPLOAD_ERR_OK) {
                $new_file = uploadFile($anh_dai_dien, './uploads/anhkhachhang/');
                // var_dump($new_file);die;
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }

            if (empty($errors)) {
                $this->modelTaiKhoan->updatekhachHang($id, $ho_ten, $email, $so_dien_thoai, $gioi_tinh, $ngay_sinh, $new_file);

                $_SESSION['success'] = 'Cập nhật thông tin thành công.';

                header('Location: ' . BASE_URL . '?act=chi-tiet-khach-hang');
                exit();
            } else {
                $formLoi = [
                    'id' => $id,
                    'ho_ten' => $ho_ten,
                    'email' => $email,
                    'so_dien_thoai' => $so_dien_thoai,
                    'gioi_tinh' => $gioi_tinh,
                    'ngay_sinh' => $ngay_sinh,
                    'anh_dai_dien' => $anh_dai_dien
                ];

                header('Location: ' . BASE_URL . '?act=chi-tiet-khach-hang');
                exit();
            }
        }
    }

    public function doiMatKhauKhachHang()
    {
        $email = $_SESSION['user_client'];
        $listTaiKhoan = $this->modelTaiKhoan->getTaiKhoanformEmail($email);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_client'])) {
            $id = $_POST['id'];
            $mat_khau = $_POST['mat_khau'];
            $mat_khau_moi = $_POST['mat_khau_moi'];
            $nhap_lai_mat_khau_moi = $_POST['nhap_lai_mat_khau_moi'];

            $errors = [];
            if (empty($mat_khau)) {
                $errors['mat_khau'] = 'Mật khẩu cũ không được để trống';
            } elseif (!password_verify($mat_khau, $listTaiKhoan['mat_khau'])) {
                $errors['mat_khau'] = 'Mật khẩu cũ không chính xác';
            }

            if (empty($mat_khau_moi)) {
                $errors['mat_khau_moi'] = 'Mật khẩu mới không được để trống';
            } elseif ($mat_khau_moi != $nhap_lai_mat_khau_moi) {
                $errors['nhap_lai_mat_khau_moi'] = 'Nhập lại mật khẩu mới không khớp';
            }

            $_SESSION['errors'] = $errors;

            if (empty($errors)) {
                $this->modelTaiKhoan->updateMatKhau($id, $mat_khau_moi);

                $_SESSION['success'] = 'Đổi mật khẩu thành công.';

                header('Location: ' . BASE_URL . '?act=doi-mat-khau-khach-hang');
                exit();
            }
        }

        require_once './views/formDoiMatKhauKhachHang.php';
    }


    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);

            if (!$mail) {
                $_SESSION['error'] = 'Không tìm thấy thông tin tài khoản.';
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }

            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if (!$gioHang) {
                // Tạo giỏ hàng mới nếu chưa có
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                if (!$gioHangId) {
                    $_SESSION['error'] = 'Không thể tạo giỏ hàng mới.';
                    header('Location: ' . BASE_URL);
                    exit();
                }
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);
                // Kiểm tra và cập nhật số lượng sản phẩm trong giỏ hàng
                $this->checkAndUpdateCartQuantity($gioHang['id'], $chiTietGioHang);
                // Lấy lại chi tiết giỏ hàng sau khi cập nhật
                $chiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);
            }

            require_once './views/gioHang.php';
        } else {
            $_SESSION['message'] = 'Bạn chưa đăng nhập.';
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }
    }

    private function checkAndUpdateCartQuantity($gioHangId, $chiTietGioHang)
    {
        $hasChanges = false;
        $notices = [];
        foreach ($chiTietGioHang as $item) {
            // Lấy thông tin sản phẩm hiện tại
            $sanPham = $this->modelSanPham->getDetailSanPham($item['san_pham_id']);

            // Nếu số lượng trong kho nhỏ hơn số lượng trong giỏ hàng
            if ($sanPham['so_luong'] < $item['so_luong']) {
                // Cập nhật số lượng trong giỏ hàng bằng số lượng trong kho
                $this->modelGioHang->updateSoLuong($gioHangId, $item['san_pham_id'], $sanPham['so_luong']);
                $hasChanges = true;

                // Thêm thông báo cho người dùng
                $notices[] = "Số lượng sản phẩm {$sanPham['ten_san_pham']} trong giỏ hàng đã được điều chỉnh từ {$item['so_luong']} xuống {$sanPham['so_luong']} do số lượng trong kho đã giảm.";
            }
            // Nếu sản phẩm hết hàng
            else if ($sanPham['so_luong'] == 0) {
                // Xóa sản phẩm khỏi giỏ hàng
                $this->modelGioHang->deleteProductGioHang($item['id']);
                $notices[] = "Sản phẩm {$sanPham['ten_san_pham']} đã hết hàng và đã được xóa khỏi giỏ hàng.";
            }
        }

        if (!empty($notices)) {
            $_SESSION['cart_notice'] = implode("<br>", $notices);
        }

        return $hasChanges;
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listSanPhamLienQuan = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);
        // var_dump($listSanPhamLienQuan);die;

        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }


    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
                // lấy dữ liệu giỏ hàng của người dùng
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    if (!$gioHangId) {
                        $_SESSION['error'] = "Không thể tạo giỏ hàng mới!";
                        header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $_POST['san_pham_id']);
                        exit();
                    }
                    $gioHang = ['id' => $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);
                }
                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];

                // Kiểm tra số lượng sản phẩm trong kho
                $sanPham = $this->modelSanPham->getDetailSanPham($san_pham_id);
                if (!$sanPham) {
                    $_SESSION['error'] = "Không tìm thấy sản phẩm!";
                    header('Location: ' . BASE_URL);
                    exit();
                }

                // Kiểm tra sản phẩm có còn hàng không
                if ($sanPham['so_luong'] <= 0) {
                    $_SESSION['error'] = "Sản phẩm {$sanPham['ten_san_pham']} đã hết hàng!";
                    header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                    exit();
                }

                if ($sanPham['so_luong'] < $so_luong) {
                    $_SESSION['error'] = "Số lượng sản phẩm {$sanPham['ten_san_pham']} trong kho không đủ. Chỉ còn {$sanPham['so_luong']} sản phẩm.";
                    header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                    exit();
                }

                $checkSanPham = false;
                if (!empty($chiTietGioHang)) {
                    foreach ($chiTietGioHang as $detail) {
                        if ($detail['san_pham_id'] == $san_pham_id) {
                            $newSoLuong = $detail['so_luong'] + $so_luong;
                            // Kiểm tra tổng số lượng sau khi thêm
                            if ($newSoLuong > $sanPham['so_luong']) {
                                $_SESSION['error'] = "Số lượng sản phẩm {$sanPham['ten_san_pham']} trong kho không đủ. Chỉ còn {$sanPham['so_luong']} sản phẩm.";
                                header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                                exit();
                            }
                            $result = $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                            if (!$result) {
                                $_SESSION['error'] = "Không thể cập nhật số lượng sản phẩm!";
                                header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                                exit();
                            }
                            $checkSanPham = true;
                            break;
                        }
                    }
                }

                if (!$checkSanPham) {
                    $result = $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                    if (!$result) {
                        $_SESSION['error'] = "Không thể thêm sản phẩm vào giỏ hàng!";
                        header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                        exit();
                    }
                }
                $_SESSION['success'] = 'Thêm sản phẩm vào giỏ hàng thành công!';
                header('Location: ' . BASE_URL . '?act=gio-hang');
                exit();
            } else {
                $_SESSION['error'] = 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!';
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    public function deleteGioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $gioHangId = $_GET['id'];

            $chiTietGH = $this->modelGioHang->getProductGioHang($gioHangId);

            if ($chiTietGH) {
                $this->modelGioHang->deleteProductGioHang($gioHangId);
            }
            // var_dump($gioHangId);die();

            header("Location: " . BASE_URL . '?act=gio-hang');
            die();
        } else {
            $_SESSION['message'] = 'Bạn chưa đăng nhập. ';
            header('Location: ' . BASE_URL . '?act=login');
            die();
        }
    }


    public function thanhToan()
    {

        if (!isset($_SESSION['user_client'])) {
            $_SESSION['message'] = 'Vui lòng đăng nhập để thanh toán.';
            header("Location: " . BASE_URL . '?act=login');

            exit();
        }

        // Lấy thông tin người dùng
        $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);

        // Lấy danh sách sản phẩm đã chọn từ form (nếu có)
        $selectedProductIds = $_POST['selected_products'] ?? [];
        
        $chiTietGioHang = [];
        $tongGioHang = 0;

        // Lấy thông tin giỏ hàng của người dùng
        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

        if (!$gioHang) {
            $_SESSION['cart_notice'] = 'Giỏ hàng của bạn không có sản phẩm nào.';
            header("Location: " . BASE_URL . '?act=gio-hang');
            exit();
        }

        // Lấy tất cả chi tiết giỏ hàng của người dùng
        $allChiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);

        // Lọc các sản phẩm đã chọn nếu có
        if (!empty($selectedProductIds)) {
            foreach ($allChiTietGioHang as $sanPham) {
                if (in_array($sanPham['id'], $selectedProductIds)) {
                    $chiTietGioHang[] = $sanPham;
                    // Tính tổng tiền cho các sản phẩm đã chọn
                    if ($sanPham['gia_khuyen_mai'] && $sanPham['gia_khuyen_mai'] != $sanPham['gia_san_pham']) {
                        $tongGioHang += $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                    } else {
                        $tongGioHang += $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                    }
                }
            }
        } else {
            // Nếu không có sản phẩm nào được chọn nhưng có sản phẩm trong giỏ hàng,
            // chuyển hướng người dùng về giỏ hàng yêu cầu chọn sản phẩm
            if (!empty($allChiTietGioHang)) {
                $_SESSION['cart_notice'] = 'Vui lòng chọn ít nhất một sản phẩm để thanh toán.';
                header("Location: " . BASE_URL . '?act=gio-hang');
                exit();
            } else {
                // Nếu giỏ hàng rỗng hoàn toàn
                $_SESSION['cart_notice'] = 'Giỏ hàng của bạn không có sản phẩm nào.';
                header("Location: " . BASE_URL . '?act=gio-hang');
                exit();
            }
        }

        // Lấy danh sách phương thức thanh toán
        $listPhuongThucThanhToan = $this->modelDonHang->getAllPhuongThucThanhToan();

        require_once './views/thanhToan.php';
    }

    public function postThanhToan()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {  
            // var_dump($_POST);die();
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;

            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            $ma_don_hang = 'DH-' . rand(1000, 9999);

            // Thêm thông tin vào db
            $donHang = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id
            );

            // Lấy thông tin giỏ hàng của người dùng
            $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);

            // Lưu sản phẩm vào chi tiết đơn hàng
            if ($donHang) {
                // Lấy ra toàn bộ sản phẩm trong giỏ hàng
                $chiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);

                // Thêm từng sản phẩm từ giỏ hàng vào bảng chi tiết đơn hàng
                foreach ($chiTietGioHang as $item) {
                    $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham'];

                    $this->modelDonHang->addChiTietDonHang(
                        $donHang,
                        $item['san_pham_id'],
                        $donGia,
                        $item['so_luong'],
                        $donGia * $item['so_luong']
                    );

                    $soLuongHienTai = $this->modelSanPham->getSoLuong($item['san_pham_id']);
                    if ($soLuongHienTai < $item['so_luong']) {
                        var_dump("Không đủ số lượng trong kho sản phẩm: " . $item['ten_san_pham']);
                        die();
                    }

                    // Giảm số lượng trên database
                    $capNhatSoLuong = $this->modelSanPham->giamSoLuong($item['san_pham_id'], $item['so_luong']);
                    if (!$capNhatSoLuong) {
                        $soLuongHienTai = $this->modelSanPham->getSoLuong($item['san_pham_id']);
                        var_dump("Không cập nhật được kho cho sản phẩm: " . $item['ten_san_pham']);
                        die();
                    }
                }

                // Sau khi thêm xog phải tiến hàng xóa sản phẩm trong giỏ hàng
                $this->modelGioHang->deleteDetailGioHang($gioHang['id']);

                // Xóa toàn bộ trong chi tiết giỏ hàng
                $this->modelGioHang->deleteGioHang($tai_khoan_id);

                header("Location: " . BASE_URL . '?act=lich-su-mua-hang');
                exit();
            } else {
                var_dump("Lỗi đặt hàng. Vui lòng thử lại sau");
                die;
            }
        }
    }

    public function lichSuMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // Lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // Lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getAllPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // Lấy ra danh sách tất cả đơn hàng của tài khoản
            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);
            require_once "./views/lichSuMuaHang.php";
        } else {
            $_SESSION['message'] = 'Bạn chưa đăng nhập.';
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }
    }
    public function chiTietMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // Lấy id đơn hàng truyền từ url
            $donHangId = $_GET['id'];

            // Lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // Lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getAllPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // Lấy ra thông tin đơn hàng theo id
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            // Lấy thông tin sản phẩm của đơn hàng trong bảng chi tiết đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);

            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền truy cập đơn hàng này";
                exit;
            }
            require_once "./views/chiTietMuaHang.php";
        } else {
            $_SESSION['message'] = 'Bạn chưa đăng nhập.';
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }
    }
    public function huyDonHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // Lấy id đơn hàng truyền từ url
            $donHangId = $_GET['id'];

            // Kiểm tra đơn hàng
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            // Hủy đơn hàng
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 9);

            header("Location: " . BASE_URL . '?act=lich-su-mua-hang');
            exit();
        } else {
            $_SESSION['message'] = 'Bạn chưa đăng nhập.';
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }
    }
    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $listSanPham = $this->modelSanPham->searchSanPhamByName($keyword);
        $listDanhMuc = $this->danhMuc->getAllDanhMuc();
        require_once './views/dssanpham.php';
    }
}
