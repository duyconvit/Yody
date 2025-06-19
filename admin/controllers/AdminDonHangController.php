<?php

/**
 * Controller quản lý đơn hàng cho admin
 * Chứa các phương thức xử lý logic quản lý đơn hàng từ phía admin
 */
class AdminDonHangController
{
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    /**
     * Hiển thị danh sách tất cả đơn hàng
     * Logic: Lấy danh sách đơn hàng từ model -> Hiển thị view danh sách
     */
    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();

        require_once './views/DonHang/listDonHang.php';
    }

    /**
     * Hiển thị chi tiết đơn hàng
     * Logic: Lấy thông tin đơn hàng -> Lấy danh sách sản phẩm -> Lấy trạng thái -> Hiển thị view chi tiết
     */
    public function detailDonHang() 
    {
        $don_hang_id = $_GET['id_don_hang'];
        
        // Lấy thông tin đơn hàng ở bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        // Lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);

        // Trạng thái đơn hàng
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        require_once './views/DonHang/detailDonHang.php';
    }

    /**
     * Hiển thị form chỉnh sửa đơn hàng
     * Logic: Lấy thông tin đơn hàng -> Lấy danh sách trạng thái -> Lấy sản phẩm -> Hiển thị form edit
     */
    public function formEditDonHang()
    {
        $id = $_GET['id_don_hang'] ?? null;

        $donHang = $this->modelDonHang->getDetailDonHang($id);

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($id);

        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header('Location: ' . BASE_URL_ADMIN . '?act=quan-ly-don-hang');
            exit();
        }
    }

    /**
     * Xử lý cập nhật trạng thái đơn hàng
     * Logic: Validate dữ liệu -> Kiểm tra quy tắc cập nhật trạng thái -> Cập nhật database -> Chuyển hướng
     */
    public function postEditDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $don_hang_id = $_POST['don_hang_id'];
            $trang_thai_id = $_POST['trang_thai_id'];

            $errors = [];
            
            // Lấy thông tin đơn hàng hiện tại
            $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);
            if (!$donHang) {
                $errors['don_hang'] = 'Không tìm thấy đơn hàng';
            } else {
                $current_status = $donHang['trang_thai_id'];
                
                // Kiểm tra nếu đơn hàng đã hoàn thành hoặc đã hủy
                if (in_array($current_status, [9, 10])) {
                    $errors['trang_thai'] = 'Không thể thay đổi trạng thái của đơn hàng đã hoàn thành hoặc đã hủy';
                }
                // Cho phép hủy đơn chỉ khi chưa đến trạng thái chuẩn bị hàng
                else if ($trang_thai_id == 9 && $current_status >= 3) {
                    $errors['trang_thai'] = 'Không thể hủy đơn hàng khi đã bắt đầu chuẩn bị hàng';
                }
                // Kiểm tra xem có đang cập nhật đúng trạng thái tiếp theo không
                else if ($trang_thai_id != $current_status + 1 && $trang_thai_id != 9) {
                    $errors['trang_thai'] = 'Chỉ có thể cập nhật sang trạng thái tiếp theo trong quy trình';
                }
            }

            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái đơn hàng không được để trống';
            }

            $_SESSION['errors'] = $errors;

            if (empty($errors)) {
                $this->modelDonHang->updateDonHang($don_hang_id, $trang_thai_id);
                $_SESSION['success'] = 'Cập nhật trạng thái đơn hàng thành công';
                header('Location: ' . BASE_URL_ADMIN . '?act=quan-ly-don-hang');
                exit();
            } else {
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }
}

?>