<?php

class AdminTaiKhoanController 
{
    public $modelTaiKhoan;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonHang = new AdminDonHang();
    }

   
    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }

    
    public function formLogin()
    {
        require_once './views/auth/formLogin.php';
        unset($_SESSION['errors']); // Xóa thông báo lỗi sau khi hiển thị
        deleteSessionError();
    }

    
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if (is_array($user)) { // Đăng nhập thành công
                $_SESSION['user_admin'] = $user['email'];
                $_SESSION['admin_id'] = $user['id'];
                header("Location: " . BASE_URL_ADMIN);
                exit();
            } else { // Đăng nhập thất bại, lưu lỗi
                $_SESSION['errors'] = $user;
                header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
                exit();
            }
        }
    }

    
    public function logout()
    {
        if (isset($_SESSION['user_admin'])) {
            unset($_SESSION['user_admin']);
            header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
            exit();
        }
    }
    
    
    public function formAddQuanTri(){
        
        require_once './views/taikhoan/quantri/addQuanTri.php';
        // deleteSessionError();
       
    }

   
    public function postAddQuanTri(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            var_dump($ho_ten);
            var_dump($email);

            $errors = [];

            if (empty($ho_ten)){
                $errors['ho_ten'] ='Tên không được để trống';
            }
            if (empty($email)){
                $errors['email'] ='Email được để trống';
            }

            $_SESSION['error'] = $errors;

            //Nếu ko có lỗi thì tiến hành thêm tài khoảnkhoản
            if (empty($errors)) {
               
                //đặt password mặc định - 123@123ab
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                // var_dump($password);die;

                //Khai báo chứcvuj
                $chuc_vu_id = 1;

                $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);

                header("Location: " . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                $_SESSION['flash'] = true;

                 header("Location: " . BASE_URL_ADMIN . '?act=form-them-quan-tri');
                exit();
            }
        }
    }

    
    public function formEditQuanTri(){
        $id_quan_tri= $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/quantri/editQuanTri.php';

        deleteSessionError();
    }

    
     public function postEditQuanTri()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $quan_tri_id = $_POST['quan_tri_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được để trống';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng tháithái';
            }

            $_SESSION['errors'] = $errors;

            if (empty($errors)) {
                $this->modelTaiKhoan->updateTaiKhoan($quan_tri_id, $ho_ten, $email, $so_dien_thoai, $trang_thai);
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit();
            }
        }
    }

    
    public function resetPassword(){
        $tai_khoan_id = $_GET['id_quan_tri'] ?? $_GET['id_khach_hang'] ?? null;
        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);

        //đặt password mặc định - 123abc
        $password = password_hash('123abc', PASSWORD_BCRYPT);

        $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);
        // var_dump($status);die;
        if($status && $tai_khoan['chuc_vu_id'] == 1){
             header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
        }else if($status && $tai_khoan['chuc_vu_id'] == 2){
            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
        } else {
            var_dump('Lỗi khi reset tài khoản');die;
        }
    }

    
    public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);
        
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }

    
    public function formEditKhachHang(){
        $id_khach_hang= $_GET['id_khach_hang'];
        $khachhang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        // var_dump($quanTri);die;
        require_once './views/taikhoan/khachhang/editKhachHang.php';

        deleteSessionError();
    }

    
    public function postEditKhachHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $khach_hang_id = $_POST['khach_hang_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';

            $errors = [];
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Tên người dùng không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email người dùng không được để trống';
            }

            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh người dùng không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Giới tính người dùng không được để trống';
            }

            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Vui lòng chọn trạng tháithái';
            }

            $_SESSION['errors'] = $errors;

            if (empty($errors)) {
                 $this->modelTaiKhoan->updateKhachHang(
                    $khach_hang_id,
                    $ho_ten,
                    $email,
                    $so_dien_thoai,
                    $ngay_sinh,
                    $gioi_tinh,
                    $dia_chi,
                    $trang_thai
                );
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit();
            } else {
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit();
            }
        }
    }

    
    public function detailKhachHang(){
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachhang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);
        require_once './views/taikhoan/khachhang/detailKhachHang.php';
    }
}   