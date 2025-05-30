<?php 
require_once './models/GioHang.php';

class HomeController
{
    public $modelSanPham;

    public $modelGioHang;

    public $modelTaiKhoan;


    // public $danhMuc;
    
    public function __construct(){
        $this->modelSanPham = new AdminSanPham();
        // $this->danhMuc = new AdminDanhMuc();
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelGioHang = new AdminGioHang();
    }

    public function home() {
        $listSanPham = $this-> modelSanPham->getAllSanPham();
        require_once './views/home.php';
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


    public function gioHang() 
    {
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            
            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
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
            $_SESSION['message'] = 'Bạn chưa đăng nhâp.';
            header('Location: ' . BASE_URL . '?act=login');
            exit();
        }
    }

    private function checkAndUpdateCartQuantity($gioHangId, $chiTietGioHang) {
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

    public function chiTietSanPham(){
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
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_client']);
                // lấy dữ liệu giỏ hàng của người dùng
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if(!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    if (!$gioHangId) {
                        $_SESSION['error'] = "Không thể tạo giỏ hàng mới!";
                        header('Location: ' . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $_POST['san_pham_id']);
                        exit();
                    }
                    $gioHang = ['id' =>$gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDeltailGioHang($gioHang['id']);
                }else {
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
                    foreach($chiTietGioHang as $detail)  {
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
                
                if(!$checkSanPham) {
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
        if(isset($_SESSION['user_client']))  {
            $gioHangId = $_GET['id'];

            $chiTietGH = $this->modelGioHang->getProductGioHang($gioHangId);
            
            if($chiTietGH) {
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

}
