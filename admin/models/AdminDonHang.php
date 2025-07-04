<?php 

/**
 * Model quản lý đơn hàng cho admin
 * Chứa các phương thức thao tác với database liên quan đến quản lý đơn hàng từ phía admin
 */
class AdminDonHang {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    /**
     * Lấy tất cả đơn hàng với thông tin trạng thái
     * Logic: JOIN bảng don_hangs với trang_thai_don_hangs để lấy tên trạng thái, sắp xếp theo thứ tự mới nhất
     */
    public function getAllDonHang(){
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            ORDER BY don_hangs.id DESC';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy tất cả trạng thái đơn hàng
     * Logic: Truy vấn bảng trang_thai_don_hangs để lấy danh sách các trạng thái có thể có
     */
    public function getAllTrangThaiDonHang(){
        try {
            $sql = 'SELECT * FROM trang_thai_don_hangs';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy chi tiết đơn hàng với thông tin đầy đủ
     * Logic: JOIN 4 bảng để lấy thông tin đơn hàng, trạng thái, khách hàng và phương thức thanh toán
     */
    public function getDetailDonHang($id){
        try {
            $sql = 'SELECT don_hangs.*, 
                trang_thai_don_hangs.ten_trang_thai, 
                tai_khoans.ho_ten, 
                tai_khoans.email, 
                tai_khoans.so_dien_thoai,
                phuong_thuc_thanh_toans.ten_phuong_thuc
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
            INNER JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
            WHERE don_hangs.id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy danh sách sản phẩm trong đơn hàng
     * Logic: JOIN bảng chi_tiet_don_hangs với san_phams để lấy thông tin sản phẩm trong đơn hàng
     */
    public function getListSpDonHang($id){
        try {
            $sql = 'SELECT chi_tiet_don_hangs.*, san_phams.ten_san_pham
            FROM chi_tiet_don_hangs
            INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
            WHERE chi_tiet_don_hangs.don_hang_id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    /**
     * Cập nhật trạng thái đơn hàng
     * Logic: Cập nhật trạng thái của đơn hàng theo ID và trạng thái mới
     */
    public function updateDonHang($id, $trang_thai_id)
    {
        try {
            $sql = "UPDATE don_hangs SET trang_thai_id = :trang_thai_id WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai_id' => $trang_thai_id,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "CÓ LỖI: " . $e->getMessage();
        }
    }

    /**
     * Lấy danh sách đơn hàng của một khách hàng cụ thể
     * Logic: JOIN bảng don_hangs với trang_thai_don_hangs để lấy đơn hàng và trạng thái của khách hàng
     */
    public function getDonHangFromKhachHang($id){
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            WHERE don_hangs.tai_khoan_id = :id 
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute(['id'=>$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    /**
     * Tính tổng thu nhập từ các đơn hàng đã hoàn thành
     * Logic: Tính tổng tong_tien từ các đơn hàng có trạng thái đã hoàn thành (trang_thai_id = 9)
     */
    public function tongThuNhap(){
        try {
            $sql = 'SELECT SUM(tong_tien) as tong_thu_nhap
            FROM don_hangs
            WHERE trang_thai_id = 9 
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC)['tong_thu_nhap'] ?? 0;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy thống kê sản phẩm bán chạy
     * Logic: GROUP BY theo san_pham_id để tính tổng số lượng bán và số đơn hàng, sắp xếp theo số lượng giảm dần
     */
    public function getAllDetailDonHangSanPhamBanChay()
    {
        try {
            $sql = "SELECT 
                        chi_tiet_don_hangs.san_pham_id,
                        san_phams.ten_san_pham,
                        san_phams.hinh_anh,
                        san_phams.gia_san_pham,
                        san_phams.gia_khuyen_mai,
                        MAX(don_hangs.ngay_dat) AS ngay_dat, 
                        COUNT(chi_tiet_don_hangs.don_hang_id) AS so_don_dat,
                        SUM(chi_tiet_don_hangs.so_luong) AS tong_so_luong
                    FROM chi_tiet_don_hangs
                    INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id 
                    INNER JOIN don_hangs ON chi_tiet_don_hangs.don_hang_id = don_hangs.id
                    GROUP BY 
                        chi_tiet_don_hangs.san_pham_id
                    ORDER BY 
                        tong_so_luong DESC";


            $stmt = $this->conn->prepare($sql);

            $stmt->execute();
            
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "CÓ LỖI:" . $e->getMessage();
        }
    }
}