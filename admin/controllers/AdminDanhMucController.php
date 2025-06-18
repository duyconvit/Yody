<?php

class AdminDanhMucController
{

    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
        // Đảm bảo session được start
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function danhSachDanhMuc()
    {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/DanhMuc/listDanhMuc.php';
    }

    public function formAddDanhMuc()
    {
        require_once './views/DanhMuc/addDanhMuc.php';
    }

    public function themDanhMuc()
    {if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];


            $errors = [];

            if (empty($ten_danh_muc)){
                $errors['ten_danh_muc'] ='Tên danh mục không được để trống';
            }
            if (empty($errors)) {

                $this->modelDanhMuc->addDanhMuc($ten_danh_muc, $mo_ta);
                header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                require_once './views/DanhMuc/addDanhMuc.php';
            }
        }
    }

    public function formEditDanhMuc()
    {
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getByIdDanhMuc($id);
        if ($danhMuc){

        require_once './views/DanhMuc/editDanhMuc.php';
        } else {
            header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
        }
    }

    public function suaDanhMuc()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            $errors = [];

            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }

            if (empty($errors)) {
            

                $this->modelDanhMuc->editDanhMuc($id, $ten_danh_muc, $mo_ta);
                header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            } else {
                
                $danhMuc = ['id' => $id,
                    'ten_danh_muc' => $ten_danh_muc,
                    'mo_ta' => $mo_ta

                ];
                require_once './views/DanhMuc/editDanhMuc.php';
            }
        }
    }
    
    public function xoaDanhMuc()
    {
        // Debug: In ra để kiểm tra
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        try {
            $id = $_GET['id_danh_muc'];
            
            // Kiểm tra ID có tồn tại không
            if (!$id) {
                $_SESSION['error'] = 'ID danh mục không hợp lệ!';
                header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
                exit();
            }
            
            $danhMuc = $this->modelDanhMuc->getByIdDanhMuc($id);

            if ($danhMuc) {
                // Kiểm tra xem danh mục có sản phẩm không
                $countSanPham = $this->modelDanhMuc->countSanPhamByDanhMuc($id);
                
                if ($countSanPham > 0) {
                    // Nếu có sản phẩm thì không cho xóa
                    $_SESSION['error'] = 'Không thể xóa danh mục này vì đang có ' . $countSanPham . ' sản phẩm thuộc danh mục này!';
                } else {
                    // Nếu không có sản phẩm thì cho phép xóa
                    $result = $this->modelDanhMuc->deleteDanhMuc($id);
                    if ($result) {
                        $_SESSION['success'] = 'Xóa danh mục thành công!';
                    } else {
                        $_SESSION['error'] = 'Có lỗi xảy ra khi xóa danh mục!';
                    }
                }
            } else {
                $_SESSION['error'] = 'Không tìm thấy danh mục cần xóa!';
            }
            
        } catch (Exception $e) {
            $_SESSION['error'] = 'Lỗi hệ thống: ' . $e->getMessage();
        }
        
        header("Location: " . BASE_URL_ADMIN . '?act=danh-muc');
        exit();
    }
}