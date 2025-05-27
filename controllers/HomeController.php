<?php 

class HomeController
{
    public $modelSanPham;
    
    public function __construct(){
        $this->modelSanPham = new AdminSanPham();
    }

    public function index() {
        require_once './views/home.php';
    }

    public function danhSachSanPham() {
        $listSanPham = $this-> modelSanPham->getAllSanPham();
        var_dump($listSanPham);die();
    }

    //test
}
