<?php

class AdminDashboardController  
{
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function trangchu()
    {
        // $listDonHang = $this->modelDonHang->getAllDetailDonHang();
        $listAllDonHang = $this->modelDonHang->getAllDonHang();
        $tongThuNhap = $this->modelDonHang->tongThuNhap();
        // var_dump($tongThuNhap);die();
        // $listDonHang = $this->modelDonHang->getAllDonHangDetail();

        $listDetailDonHang = $this->modelDonHang->getAllDetailDonHangSanPhamBanChay();
        require_once './views/trangChuAdmin.php';
    }

}
