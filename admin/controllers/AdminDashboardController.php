<?php


require_once __DIR__ . '/../models/AdminDonHang.php';
require_once __DIR__ . '/../models/AdminTaiKhoan.php';



class AdminDashboardController  
{

    public $modelTaiKhoan;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonHang = new AdminDonHang();
    }

    public function trangchu()
    {
        // $listDonHang = $this->modelDonHang->getAllDetailDonHang();
        $listAllDonHang = $this->modelDonHang->getAllDonHang();
        $listTaiKhoan = $this->modelTaiKhoan->getAllTaiKhoanThongKe();
        $tongThuNhap = $this->modelDonHang->tongThuNhap();
        // var_dump($tongThuNhap);die();
        // $listDonHang = $this->modelDonHang->getAllDonHangDetail();

        $listDetailDonHang = $this->modelDonHang->getAllDetailDonHangSanPhamBanChay();
        require_once './views/trangChuAdmin.php';
    }

}
