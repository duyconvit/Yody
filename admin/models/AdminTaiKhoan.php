<?php

/**
 * Model quản lý tài khoản cho admin
 * Chứa các phương thức thao tác với database liên quan đến quản lý tài khoản từ phía admin
 */
class AdminTaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    /**
     * Lấy danh sách tài khoản theo chức vụ
     * Logic: Truy vấn bảng tai_khoans để lấy tất cả tài khoản có chức vụ cụ thể (1=quản trị, 2=khách hàng)
     */
    public function getAllTaiKhoan($chuc_vu_id){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE chuc_vu_id = :chuc_vu_id';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':chuc_vu_id'=>$chuc_vu_id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    /**
     * Thêm tài khoản mới
     * Logic: Thêm bản ghi mới vào bảng tai_khoans với thông tin tài khoản và mật khẩu đã hash
     */
    public function insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id)
    {
        try {
            $sql = 'INSERT INTO  tai_khoans (ho_ten, email, mat_khau,  chuc_vu_id) 
                    VALUES (:ho_ten, :email, :password, :chuc_vu_id)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':ho_ten' => $ho_ten,
                    ':email' => $email,
                    ':password' => $password,
                    ':chuc_vu_id' => $chuc_vu_id
                ]
            );

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    /**
     * Lấy chi tiết tài khoản theo ID
     * Logic: Truy vấn bảng tai_khoans để lấy thông tin chi tiết của một tài khoản cụ thể
     */
     public function getDetailTaiKhoan($id)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':id' => $id
                ]
            );

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    /**
     * Cập nhật thông tin tài khoản quản trị
     * Logic: Cập nhật thông tin cơ bản của tài khoản quản trị (tên, email, số điện thoại, trạng thái)
     */
    public function updateTaiKhoan($id, $ho_ten, $email, $so_dien_thoai, $trang_thai)
    {
        try {
            $sql = "UPDATE tai_khoans SET
             ho_ten = :ho_ten,
             email = :email,
             so_dien_thoai = :so_dien_thoai,
             trang_thai = :trang_thai

             WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "CÓ LỖI: " . $e->getMessage();
        }
    }

    /**
     * Reset mật khẩu tài khoản
     * Logic: Cập nhật mật khẩu mới đã hash cho tài khoản theo ID
     */
    public function resetPassword($id, $mat_khau)
    {
        try {
            $sql = "UPDATE tai_khoans SET
             mat_khau = :mat_khau
             WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':mat_khau' => $mat_khau,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "CÓ LỖI: " . $e->getMessage();
        }
    }

    /**
     * Cập nhật thông tin tài khoản khách hàng
     * Logic: Cập nhật thông tin đầy đủ của tài khoản khách hàng bao gồm thông tin cá nhân
     */
    public function updateKhachHang($id, $ho_ten, $email,$so_dien_thoai, $ngay_sinh, $gioi_tinh, $dia_chi, $trang_thai)
    {
        try {
            $sql = "UPDATE tai_khoans SET
             ho_ten = :ho_ten,
             email = :email,
             so_dien_thoai = :so_dien_thoai,
             ngay_sinh = :ngay_sinh,
             gioi_tinh = :gioi_tinh,
             dia_chi = :dia_chi,
             trang_thai = :trang_thai

             WHERE id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':so_dien_thoai' => $so_dien_thoai,
                ':ngay_sinh' => $ngay_sinh,
                ':gioi_tinh' => $gioi_tinh,
                ':dia_chi' => $dia_chi,
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "CÓ LỖI: " . $e->getMessage();
        }
    }

    /**
     * Kiểm tra đăng nhập admin
     * Logic: Kiểm tra email -> Kiểm tra trạng thái tài khoản -> Kiểm tra quyền admin -> Kiểm tra mật khẩu
     */
    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if (!$user) {
                return "Sai email hoặc mật khẩu!";
            }
            
            // Kiểm tra trạng thái tài khoản trước
            if ($user['trang_thai'] != 1) {
                return "Tài khoản của bạn đã bị khóa! Vui lòng liên hệ quản trị viên.";
            }
            
            // Kiểm tra quyền Admin
            if ($user['chuc_vu_id'] != 1) {
                return "Bạn không có quyền truy cập vào trang Admin!";
            }
            
            // Kiểm tra mật khẩu sau cùng
            if (!password_verify($mat_khau, $user['mat_khau'])) {
                return "Sai email hoặc mật khẩu!";
            }
            
            return $user; // Trả về thông tin user khi đăng nhập thành công
            
        } catch (\Exception $e) {
            return "Lỗi hệ thống: " . $e->getMessage();

        }
    }
}
