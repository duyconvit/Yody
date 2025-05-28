<?php 

class HomeController
{
    public $modelSanPham;
    // public $danhMuc;
    
    public function __construct(){
        $this->modelSanPham = new AdminSanPham();
        // $this->danhMuc = new AdminDanhMuc();
    }

    public function home() {
        $listSanPham = $this-> modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

   
}
