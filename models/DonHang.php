<?php
/**
 * Model quản lý đơn hàng
 * Chứa các phương thức thao tác với bảng don_hangs, chi_tiet_don_hangs và các bảng liên quan
 */
class DonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    /**
     * Tạo đơn hàng mới
     * Logic: Thêm bản ghi mới vào bảng don_hangs với đầy đủ thông tin người nhận, thanh toán và trả về ID đơn hàng
     */
    public function addDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang, $trang_thai_id)
    {
        try {
            $sql = 'INSERT INTO don_hangs (tai_khoan_id, ten_nguoi_nhan, email_nguoi_nhan, sdt_nguoi_nhan, dia_chi_nguoi_nhan, ghi_chu, tong_tien, phuong_thuc_thanh_toan_id, ngay_dat, ma_don_hang, trang_thai_id) 
                    VALUES (:tai_khoan_id, :ten_nguoi_nhan, :email_nguoi_nhan, :sdt_nguoi_nhan, :dia_chi_nguoi_nhan, :ghi_chu, :tong_tien, :phuong_thuc_thanh_toan_id, :ngay_dat, :ma_don_hang, :trang_thai_id)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':tong_tien' => $tong_tien,
                ':phuong_thuc_thanh_toan_id' => $phuong_thuc_thanh_toan_id,
                ':ngay_dat' => $ngay_dat,
                ':ma_don_hang' => $ma_don_hang,
                ':trang_thai_id' => $trang_thai_id
            ]);
            
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Thêm chi tiết sản phẩm vào đơn hàng
     * Logic: Thêm bản ghi mới vào bảng chi_tiet_don_hangs với thông tin sản phẩm, đơn giá và thành tiền
     */
    public function addChiTietDonHang($don_hang_id, $san_pham_id, $don_gia, $so_luong, $thanh_tien)
    {
        try {
            $sql = "INSERT INTO chi_tiet_don_hangs (don_hang_id, san_pham_id, don_gia, so_luong, thanh_tien)
            VALUES (:don_hang_id, :san_pham_id, :don_gia, :so_luong, :thanh_tien)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':don_hang_id' => $don_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':don_gia' => $don_gia,
                ':so_luong' => $so_luong,
                ':thanh_tien' => $thanh_tien
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy danh sách đơn hàng của người dùng
     * Logic: Truy vấn bảng don_hangs để lấy tất cả đơn hàng thuộc về tài khoản, sắp xếp theo thứ tự mới nhất
     */
    public function getDonHangFromUser($tai_khoan_id)
    {
        try {
            $sql = "SELECT * FROM don_hangs 
                    WHERE tai_khoan_id = :tai_khoan_id
                    ORDER BY don_hangs.id DESC";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id
            ]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy tất cả trạng thái đơn hàng
     * Logic: Truy vấn bảng trang_thai_don_hangs để lấy danh sách các trạng thái có thể có
     */
    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = "SELECT * FROM trang_thai_don_hangs";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy tất cả phương thức thanh toán
     * Logic: Truy vấn bảng phuong_thuc_thanh_toans để lấy danh sách các phương thức thanh toán có sẵn
     */
    public function getAllPhuongThucThanhToan()
    {
        try {
            $sql = "SELECT * FROM phuong_thuc_thanh_toans";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy thông tin đơn hàng theo ID
     * Logic: Truy vấn bảng don_hangs để lấy thông tin chi tiết của một đơn hàng cụ thể
     */
    public function getDonHangById($don_hang_id)
    {
        try {
            $sql = "SELECT * FROM don_hangs WHERE id =:id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id'=> $don_hang_id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Cập nhật trạng thái đơn hàng
     * Logic: Cập nhật trạng thái của đơn hàng theo ID và trạng thái mới
     */
    public function updateTrangThaiDonHang($don_hang_id, $trang_thai_id)
    {
        try {
            $sql = "UPDATE don_hangs SET trang_thai_id = :trang_thai_id WHERE id =:id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $don_hang_id,
                ':trang_thai_id' => $trang_thai_id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy chi tiết sản phẩm trong đơn hàng
     * Logic: JOIN bảng chi_tiet_don_hangs với san_phams để lấy thông tin đầy đủ sản phẩm trong đơn hàng
     */
    public function getChiTietDonHangByDonHangId($don_hang_id)
    {
        try {
            $sql = "SELECT 
                        chi_tiet_don_hangs.*,
                        san_phams.ten_san_pham,
                        san_phams.hinh_anh
                    FROM 
                        chi_tiet_don_hangs 
                    JOIN
                        san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
                    WHERE chi_tiet_don_hangs.don_hang_id =:don_hang_id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':don_hang_id'=> $don_hang_id
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
}
?>