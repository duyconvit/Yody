<?php 

class HomeController
{
    public $modelSanPham;
    public $danhMuc;
    
    public function __construct(){
        $this->modelSanPham = new AdminSanPham();
        $this->danhMuc = new AdminDanhMuc();
    }

    public function home() {
        $listSanPham = $this-> modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }
      public function dssanpham()
{
    $danhMucId = isset($_GET['danh_muc_id']) ? intval($_GET['danh_muc_id']) : 0;
    $listDanhMuc = $this->danhMuc->getAllDanhMuc();
    $tongDonHang = $this->tongDonHang();

    if ($danhMucId>0){
      $listSanPham = $this->modelSanPham->getListSanPhamDanhMuc($danhMucId);
    }else{
        $listSanPham = $this->modelSanPham->getAllSanPham();
    }

    require_once './views/dssanpham.php';
}
    

   
}
