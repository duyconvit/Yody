<?php

class AdminDashboardController  
{
    public $modelDonHang;
    public $modelTaiKhoan;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }

    public function trangchu()
    {
        // $listDonHang = $this->modelDonHang->getAllDetailDonHang();
        $listAllDonHang = $this->modelDonHang->getAllDonHang();
        $tongThuNhap = $this->modelDonHang->tongThuNhap();
        $listTaiKhoan = $this -> modelTaiKhoan->getAllTaiKhoan(2);
        // var_dump($tongThuNhap);die();
        // $listDonHang = $this->modelDonHang->getAllDonHangDetail();

        $listDetailDonHang = $this->modelDonHang->getAllDetailDonHangSanPhamBanChay();
        $listTaiKhoan = $this->modelTaiKhoan->getAllTaiKhoan(2); // Get all customer accounts (chuc_vu_id = 2)
        require_once './views/trangChuAdmin.php';
    }

}
