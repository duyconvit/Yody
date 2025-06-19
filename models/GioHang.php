<?php
/**
 * Model quản lý giỏ hàng
 * Chứa các phương thức thao tác với bảng gio_hangs và chi_tiet_gio_hangs
 */
class GioHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    /**
     * Lấy thông tin giỏ hàng của người dùng theo ID tài khoản
     * Logic: Truy vấn bảng gio_hangs để tìm giỏ hàng thuộc về tài khoản
     */
    public function getGioHangFromUser($id) 
    {
        try {
            $sql = 'SELECT * FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':tai_khoan_id' => $id]);
            
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Lấy chi tiết sản phẩm trong giỏ hàng theo ID giỏ hàng
     * Logic: JOIN bảng chi_tiet_gio_hangs với san_phams để lấy thông tin đầy đủ sản phẩm
     */
    public function getDeltailGioHang($id) 
    {
        try {
            $sql = 'SELECT chi_tiet_gio_hangs.*, san_phams.ten_san_pham, san_phams.hinh_anh, san_phams.gia_san_pham, san_phams.gia_khuyen_mai
                    FROM chi_tiet_gio_hangs
                    INNER JOIN san_phams ON chi_tiet_gio_hangs.san_pham_id = san_phams.id
                    WHERE chi_tiet_gio_hangs.gio_hang_id = :gio_hang_id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':gio_hang_id' => $id
            ]);
            
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Tạo giỏ hàng mới cho người dùng
     * Logic: Thêm bản ghi mới vào bảng gio_hangs và trả về ID của giỏ hàng vừa tạo
     */
    public function addGioHang($id)
    {
        try {
            $sql = 'INSERT INTO gio_hangs (tai_khoan_id) VALUES (:id)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);
            
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng
     * Logic: Cập nhật số lượng sản phẩm theo gio_hang_id và san_pham_id
     */
    public function updateSoLuong($gio_hang_id, $san_pham_id, $so_luong) 
    {
        try {
            $sql = 'UPDATE chi_tiet_gio_hangs 
                    SET so_luong = :so_luong
                    WHERE gio_hang_id = :gio_hang_id 
                    AND san_pham_id = :san_pham_id';

            $stmt = $this->conn->prepare($sql);

            $result = $stmt->execute([
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':so_luong' => $so_luong
            ]);
            
            if (!$result) {
                throw new Exception("Không thể cập nhật số lượng sản phẩm");
            }
            
            return true;
        } catch (Exception $e) {
            error_log("Lỗi cập nhật số lượng sản phẩm: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Thêm sản phẩm vào giỏ hàng
     * Logic: Thêm bản ghi mới vào bảng chi_tiet_gio_hangs với thông tin sản phẩm và số lượng
     */
    public function addDetailGioHang($gio_hang_id, $san_pham_id, $so_luong)
    {
        try {
            $sql = 'INSERT INTO chi_tiet_gio_hangs (gio_hang_id, san_pham_id, so_luong) 
                    VALUES (:gio_hang_id, :san_pham_id, :so_luong)';

            $stmt = $this->conn->prepare($sql);

            $result = $stmt->execute([
                ':gio_hang_id' => $gio_hang_id,
                ':san_pham_id' => $san_pham_id,
                ':so_luong' => $so_luong
            ]);
            
            if (!$result) {
                throw new Exception("Không thể thêm sản phẩm vào giỏ hàng");
            }
            
            return true;
        } catch (Exception $e) {
            error_log("Lỗi thêm sản phẩm vào giỏ hàng: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Xóa tất cả sản phẩm trong giỏ hàng
     * Logic: Xóa tất cả bản ghi trong chi_tiet_gio_hangs theo gio_hang_id
     */
    public function deleteDetailGioHang($gio_hang_id)
    {
        try {
            $sql = 'DELETE FROM chi_tiet_gio_hangs WHERE gio_hang_id = :gio_hang_id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':gio_hang_id' => $gio_hang_id
            ]);
            
            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    /**
     * Xóa giỏ hàng của người dùng
     * Logic: Xóa bản ghi trong bảng gio_hangs theo tai_khoan_id
     */
    public function deleteGioHang($tai_khoan_id)
    {
        try {
            $sql = "DELETE FROM gio_hangs WHERE tai_khoan_id = :tai_khoan_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id
            ]);
            return true;
        } catch (Exception $e) {
            echo "CÓ LỖI:" . $e->getMessage();
        }
    }

    /**
     * Lấy thông tin sản phẩm trong giỏ hàng theo ID chi tiết
     * Logic: Truy vấn bảng chi_tiet_gio_hangs để lấy thông tin sản phẩm cụ thể
     */
    public function getProductGioHang($id)
    {
        try {
            $sql = "SELECT * FROM chi_tiet_gio_hangs WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);
            
            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "CÓ LỖI:" . $e->getMessage();
        }
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng theo ID chi tiết
     * Logic: Xóa bản ghi trong chi_tiet_gio_hangs theo ID
     */
    public function deleteProductGioHang($id)
    {
        try {
            $sql = "DELETE FROM chi_tiet_gio_hangs WHERE id = :id";
            
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "CÓ LỖI:" . $e->getMessage();
        }
    }

    /**
     * Lấy chi tiết sản phẩm trong giỏ hàng theo tài khoản và sản phẩm
     * Logic: JOIN 3 bảng để lấy thông tin đầy đủ sản phẩm trong giỏ hàng của người dùng cụ thể
     */
    public function getChiTietGioHangByProductId($tai_khoan_id, $san_pham_id)
    {
        try {
            $sql = 'SELECT ctg.id, ctg.gio_hang_id, ctg.san_pham_id, ctg.so_luong, sp.ten_san_pham, sp.hinh_anh, sp.gia_san_pham, sp.gia_khuyen_mai
                    FROM chi_tiet_gio_hangs ctg
                    INNER JOIN gio_hangs gh ON ctg.gio_hang_id = gh.id
                    INNER JOIN san_phams sp ON ctg.san_pham_id = sp.id
                    WHERE gh.tai_khoan_id = :tai_khoan_id AND ctg.san_pham_id = :san_pham_id';
            
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':tai_khoan_id' => $tai_khoan_id,
                ':san_pham_id' => $san_pham_id
            ]);
            
            $result = $stmt->fetch();

            return $result;
        } catch (Exception $e) {
            echo "Lỗi khi lấy chi tiết giỏ hàng theo sản phẩm ID: " . $e->getMessage();
            return false;
        }
    }
}
?>
