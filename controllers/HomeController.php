<?php 

class HomeController
{
    public $modelSanPham;
    
    public function __construct(){
        $this->modelSanPham = new AdminSanPham();
    }

    public function index() {
        echo "Xin chao ban";
    }
        public function danhSachSanPham() {
        $listSanPham = $this-> modelSanPham->getAllSanPham();
        var_dump($listSanPham);die();
    }

    //test
}
