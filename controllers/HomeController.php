<?php
require_once './models/GioHang.php';
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/taikhoan.php';
require_once './models/DonHang.php';

/**
 * HomeController - Controller chính xử lý các chức năng của trang chủ và khách hàng
 * Bao gồm: đăng ký, đăng nhập, quản lý giỏ hàng, thanh toán, v.v.
 */
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

    /**
     * Hiển thị trang chủ với danh sách sản phẩm
     */
    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    /**
     * Hiển thị danh sách sản phẩm với bộ lọc theo danh mục
     */
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

    /**
     * Hiển thị form đăng nhập cho khách hàng
     * Xóa thông báo lỗi cũ sau khi hiển thị
     */
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        unset($_SESSION['errors']); // Xóa thông báo lỗi sau khi hiển thị
    }

    /**
     * Xử lý đăng nhập khách hàng
     * Kiểm tra thông tin đăng nhập và tạo session nếu thành công
     */
    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin đăng nhập từ form
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Kiểm tra thông tin đăng nhập thông qua model
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if (is_array($user)) { 
                // Đăng nhập thành công - tạo session
                $_SESSION['user_client_id'] = $user['id'];
                $_SESSION['user_client'] = $user['email'];
                header("Location: " . BASE_URL);
                exit();
            } else {
                // Đăng nhập thất bại - lưu thông báo lỗi
                $_SESSION['errors'] = is_array($user) ? implode('<br>', $user) : $user;
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    /**
     * Hiển thị form đăng ký cho khách hàng mới
     */
    public function formRegister()
    {
        require_once './views/auth/formRegister.php';
    }

    /**
     * Xử lý đăng ký khách hàng mới
     * Kiểm tra và validate dữ liệu trước khi lưu vào database
     */
    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form đăng ký
            $ho_ten = $_POST['ho_ten'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $dia_chi = $_POST['dia_chi'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // VALIDATION: Kiểm tra giới tính chỉ có "Nam" hoặc "Nữ"
            if (!in_array($gioi_tinh, ['Nam', 'Nữ'])) {
                $_SESSION['errors'] = 'Giới tính không hợp lệ. Vui lòng chọn Nam hoặc Nữ.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // VALIDATION: Kiểm tra ngày sinh phải trước năm hiện tại
            $currentYear = date("Y");
            $birthYear = date("Y", strtotime($ngay_sinh));
            if ($birthYear >= $currentYear) {
                $_SESSION['errors'] = 'Ngày sinh không hợp lệ. Vui lòng chọn năm trước năm hiện tại.';
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }

            // VALIDATION: Kiểm tra mật khẩu và xác nhận mật khẩu có khớp không
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

            if ($result === true) { 
                // Đăng ký thành công - chuyển hướng đến trang đăng nhập
                $_SESSION['register_success'] = 'Đăng ký thành công. Vui lòng đăng nhập!';
                header("Location: " . BASE_URL . '?act=login');
                exit();
            } else { 
                // Đăng ký thất bại - hiển thị thông báo lỗi
                $_SESSION['errors'] = $result;
                header("Location: " . BASE_URL . '?act=register');
                exit();
            }
        }
    }

    /**
     * Xử lý đăng xuất cho cả khách hàng và admin
     * Xóa session và chuyển hướng về trang chủ
     */
    public function Logout()
    {
        // Đăng xuất khách hàng
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']);
            unset($_SESSION['user_client_id']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
        
        // Đăng xuất admin
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            unset($_SESSION['admin_id']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
        
        // Đăng xuất session khác (nếu có)
        if (isset($_SESSION['ho_ten'])) {
            unset($_SESSION['ho_ten']);
            header("Location: " . BASE_URL . '?act=/');
            exit();
        }
    }

    /**
     * Hiển thị thông tin chi tiết khách hàng
     * Yêu cầu đăng nhập trước khi truy cập
     */
    public function chiTietKhachHang()
    {
        // Kiểm tra đăng nhập
        if (!isset($_SESSION['user_client'])) {
            $_SESSION['message'] = 'Bạn chưa đăng nhập.';
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
        
        // Lấy thông tin khách hàng từ email trong session
        $email = $_SESSION['user_client'];
        $listTaiKhoan = $this->modelTaiKhoan->getTaiKhoanformEmail($email);
        require_once './views/chiTietKhachHang.php';
    }

    /**
     * Xử lý cập nhật thông tin khách hàng
     * Cho phép cập nhật thông tin cá nhân và ảnh đại diện
     */
    public function suaKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_SESSION['user_client'])) {
            // Lấy dữ liệu từ form
            $id = $_POST['id'];
            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $gioi_tinh = $_POST['gioi_tinh'];
            $ngay_sinh = $_POST['ngay_sinh'];
            $anh_dai_dien = $_FILES['anh_dai_dien'] ?? null;

            // VALIDATION: Kiểm tra các trường bắt buộc
            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }

            // Xử lý upload ảnh đại diện nếu có
            $anh_dai_dien_path = null;
            if ($anh_dai_dien && $anh_dai_dien['error'] == 0) {
                $anh_dai_dien_path = uploadFile($anh_dai_dien, './uploads/');
            }

            // Nếu không có lỗi, tiến hành cập nhật
            if (empty($errors)) {
                $result = $this->modelTaiKhoan->updatekhachHang(
                    $id, 
                    $ho_ten, 
                    $email, 
                    $so_dien_thoai, 
                    $gioi_tinh, 
                    $ngay_sinh, 
                    $anh_dai_dien_path
                );

                if ($result) {
                    $_SESSION['success'] = 'Cập nhật thông tin thành công!';
                    header('Location: ' . BASE_URL . '?act=chi-tiet-khach-hang');
                    exit();
                } else {
                    $_SESSION['error'] = 'Có lỗi xảy ra khi cập nhật thông tin!';
                    header('Location: ' . BASE_URL . '?act=chi-tiet-khach-hang');
                    exit();
                }
            } else {
                // Lưu lỗi vào session để hiển thị
                $_SESSION['form_errors'] = $errors;
                $_SESSION['form_data'] = [
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

    /**
     * Hiển thị trang giỏ hàng của người dùng
     * Logic: Kiểm tra đăng nhập -> Lấy thông tin giỏ hàng -> Kiểm tra và cập nhật số lượng sản phẩm -> Hiển thị
     */
    public function gioHang()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (isset($_SESSION['user_client'])) {
            // Lấy thông tin tài khoản từ email đăng nhập
            $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);

            if (!$mail) {
                $_SESSION['error'] = 'Không tìm thấy thông tin tài khoản.';
                header('Location: ' . BASE_URL . '?act=login');
                exit();
            }

            // Lấy thông tin giỏ hàng của người dùng
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

    /**
     * Kiểm tra và cập nhật số lượng sản phẩm trong giỏ hàng
     * Logic: So sánh số lượng trong giỏ hàng với số lượng trong kho -> Điều chỉnh hoặc xóa sản phẩm
     */
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

    /**
     * Thêm sản phẩm vào giỏ hàng
     * Logic: Kiểm tra đăng nhập -> Kiểm tra số lượng kho -> Thêm hoặc cập nhật số lượng trong giỏ hàng
     */
    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Kiểm tra người dùng đã đăng nhập chưa
            if (isset($_SESSION['user_client'])) {
                // Lấy thông tin tài khoản từ email đăng nhập
                $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
                // lấy dữ liệu giỏ hàng của người dùng
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if (!$gioHang) {
                    // Tạo giỏ hàng mới nếu chưa có
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

                // Kiểm tra số lượng yêu cầu có vượt quá số lượng trong kho không
                if ($sanPham['so_luong'] < $so_luong) {
                    $_SESSION['error'] = "Số lượng sản phẩm {$sanPham['ten_san_pham']} trong kho không đủ. Chỉ còn {$sanPham['so_luong']} sản phẩm.";
                    header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                    exit();
                }

                $checkSanPham = false;
                if (!empty($chiTietGioHang)) {
                    // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
                    foreach ($chiTietGioHang as $detail) {
                        if ($detail['san_pham_id'] == $san_pham_id) {
                            $newSoLuong = $detail['so_luong'] + $so_luong;
                            // Kiểm tra tổng số lượng sau khi thêm
                            if ($newSoLuong > $sanPham['so_luong']) {
                                $_SESSION['error'] = "Số lượng sản phẩm {$sanPham['ten_san_pham']} trong kho không đủ. Chỉ còn {$sanPham['so_luong']} sản phẩm.";
                                header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                                exit();
                            }
                            // Cập nhật số lượng sản phẩm trong giỏ hàng
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

                // Nếu sản phẩm chưa có trong giỏ hàng thì thêm mới
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

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     * Logic: Kiểm tra đăng nhập -> Xóa sản phẩm theo ID -> Chuyển hướng về giỏ hàng
     */
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

    /**
     * Hiển thị trang thanh toán
     * Logic: Kiểm tra đăng nhập -> Lấy sản phẩm đã chọn -> Tính tổng tiền -> Hiển thị form thanh toán
     */
    public function thanhToan()
    {
        // Kiểm tra người dùng đã đăng nhập chưa
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

    /**
     * Xử lý thanh toán và tạo đơn hàng
     * Logic: Lưu thông tin đơn hàng -> Lưu chi tiết sản phẩm -> Cập nhật số lượng kho -> Xóa giỏ hàng
     */
    public function postThanhToan()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {  
            // var_dump($_POST);die();
            // Lấy thông tin người nhận từ form
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1; // Trạng thái chờ xác nhận

            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // Tạo mã đơn hàng ngẫu nhiên
            $ma_don_hang = 'DH-' . rand(1000, 9999);

            // Thêm thông tin đơn hàng vào database
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
                    // Sử dụng giá khuyến mãi nếu có, không thì dùng giá gốc
                    $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham'];

                    // Thêm chi tiết đơn hàng
                    $this->modelDonHang->addChiTietDonHang(
                        $donHang,
                        $item['san_pham_id'],
                        $donGia,
                        $item['so_luong'],
                        $donGia * $item['so_luong']
                    );

                    // Kiểm tra số lượng trong kho trước khi giảm
                    $soLuongHienTai = $this->modelSanPham->getSoLuong($item['san_pham_id']);
                    if ($soLuongHienTai < $item['so_luong']) {
                        var_dump("Không đủ số lượng trong kho sản phẩm: " . $item['ten_san_pham']);
                        die();
                    }

                    // Giảm số lượng sản phẩm trong kho
                    $capNhatSoLuong = $this->modelSanPham->giamSoLuong($item['san_pham_id'], $item['so_luong']);
                    if (!$capNhatSoLuong) {
                        $soLuongHienTai = $this->modelSanPham->getSoLuong($item['san_pham_id']);
                        var_dump("Không cập nhật được kho cho sản phẩm: " . $item['ten_san_pham']);
                        die();
                    }
                }

                // Sau khi tạo đơn hàng thành công, xóa sản phẩm trong giỏ hàng
                $this->modelGioHang->deleteDetailGioHang($gioHang['id']);

                // Xóa toàn bộ giỏ hàng
                $this->modelGioHang->deleteGioHang($tai_khoan_id);

                header("Location: " . BASE_URL . '?act=lich-su-mua-hang');
                exit();
            } else {
                var_dump("Lỗi đặt hàng. Vui lòng thử lại sau");
                die;
            }
        }
    }

    /**
     * Hiển thị lịch sử mua hàng của người dùng
     * Logic: Kiểm tra đăng nhập -> Lấy danh sách đơn hàng -> Hiển thị với trạng thái và phương thức thanh toán
     */
    public function lichSuMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // Lấy ra danh sách trạng thái đơn hàng để hiển thị tên trạng thái
            $arrTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // Lấy ra danh sách phương thức thanh toán để hiển thị tên phương thức
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

    /**
     * Hiển thị chi tiết đơn hàng
     * Logic: Kiểm tra đăng nhập -> Kiểm tra quyền truy cập -> Lấy thông tin đơn hàng và chi tiết sản phẩm
     */
    public function chiTietMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            // Lấy id đơn hàng truyền từ url
            $donHangId = $_GET['id'];

            // Lấy ra danh sách trạng thái đơn hàng để hiển thị tên trạng thái
            $arrTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // Lấy ra danh sách phương thức thanh toán để hiển thị tên phương thức
            $arrPhuongThucThanhToan = $this->modelDonHang->getAllPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // Lấy ra thông tin đơn hàng theo id
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            // Lấy thông tin sản phẩm của đơn hàng trong bảng chi tiết đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);

            // Kiểm tra quyền truy cập đơn hàng (chỉ chủ đơn hàng mới được xem)
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

    /**
     * Hủy đơn hàng
     * Logic: Kiểm tra đăng nhập -> Cập nhật trạng thái đơn hàng thành "Đã hủy"
     */
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

            // Cập nhật trạng thái đơn hàng thành "Đã hủy" (trạng thái ID = 9)
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
