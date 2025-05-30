<?php 

// Thêm require_once cho các model cần thiết
require_once './models/DanhMuc.php';
require_once './models/SanPham.php';
require_once './models/taikhoan.php';

class HomeController
{
    public $modelSanPham;

    public $danhMuc;
    public $modelTaiKhoan;

    // public $danhMuc;
    
    public function __construct(){
        $this->modelSanPham = new AdminSanPham();
        $this->danhMuc = new DanhMuc();
        $this->modelTaiKhoan = new AdminTaiKhoan();

    }

    public function home() {
        $listSanPham = $this-> modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }
      public function dssanpham()
{
    $danhMucId = isset($_GET['danh_muc_id']) ? intval($_GET['danh_muc_id']) : 0;
    $listDanhMuc = $this->danhMuc->getAllDanhMuc();

    if ($danhMucId>0){
      $listSanPham = $this->modelSanPham->getListSanPhamDanhMuc($danhMucId);
    }else{
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

    public function chiTietSanPham()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sanPham = $this->modelSanPham->getSanPhamById($id);
            if ($sanPham) {
                require_once './views/chiTietSanPham.php';
            } else {
                // Nếu không tìm thấy sản phẩm, chuyển về trang danh sách
                header("Location: " . BASE_URL . "?act=list-san-pham");
                exit();
            }
        } else {
            // Nếu không có ID, chuyển về trang danh sách
            header("Location: " . BASE_URL . "?act=list-san-pham");
            exit();
        }
    }
}
