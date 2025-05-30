<?php

class AdminTaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

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