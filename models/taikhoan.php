<?php
class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkLogin($email, $mat_khau)
    {
        try {
            // Tìm user theo email
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra user tồn tại và mật khẩu đúng
            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                // Kiểm tra trạng thái tài khoản (1 = kích hoạt, 0 = khóa)
                if ($user['trang_thai'] == 1) {
                    // Kiểm tra quyền truy cập (2 = Client, 1 = Admin)
                    if ($user['chuc_vu_id'] == 2) {
                        return $user; // Trả về mảng $user nếu thành công
                    } else {
                        return "Bạn không có quyền truy cập vào trang Client!";
                    }
                } else {
                    return "Tài khoản của bạn đã bị khóa! Vui lòng liên hệ quản trị viên.";
                }
            } else {
                return "Sai email hoặc mật khẩu!";
            }
        } catch (Exception $e) {
            return "Lỗi hệ thống: " . $e->getMessage();
        }
    }

    //   Đăng ký người dùng mới
    public function registerUser($ho_ten, $ngay_sinh, $so_dien_thoai, $gioi_tinh, $dia_chi, $email, $password)
    {
        try {
            // VALIDATION: Kiểm tra số điện thoại đã tồn tại
            $sqlPhone = 'SELECT COUNT(*) FROM tai_khoans WHERE so_dien_thoai = :so_dien_thoai';
            $stmtPhone = $this->conn->prepare($sqlPhone);
            $stmtPhone->execute(['so_dien_thoai' => $so_dien_thoai]);
            if ($stmtPhone->fetchColumn() > 0) {
                return 'Số điện thoại đã được sử dụng. Vui lòng chọn số khác.';
            }

            // VALIDATION: Kiểm tra email đã tồn tại
            $sqlEmail = 'SELECT COUNT(*) FROM tai_khoans WHERE email = :email';
            $stmtEmail = $this->conn->prepare($sqlEmail);
            $stmtEmail->execute(['email' => $email]);
            if ($stmtEmail->fetchColumn() > 0) {
                return 'Email đã được sử dụng. Vui lòng chọn email khác.';
            }

            // Chuyển đổi giới tính từ chuỗi sang số (Nam -> 1, Nữ -> 0)
            $gioi_tinh_numeric = ($gioi_tinh === 'Nam') ? 1 : 0;

            // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Thêm người dùng mới vào cơ sở dữ liệu
            $sql = 'INSERT INTO tai_khoans (ho_ten, ngay_sinh, so_dien_thoai, gioi_tinh, dia_chi, email, mat_khau, chuc_vu_id, trang_thai) 
                VALUES (:ho_ten, :ngay_sinh, :so_dien_thoai, :gioi_tinh, :dia_chi, :email, :mat_khau, :chuc_vu_id, :trang_thai)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                'ho_ten' => $ho_ten,
                'ngay_sinh' => $ngay_sinh,
                'so_dien_thoai' => $so_dien_thoai,
                'gioi_tinh' => $gioi_tinh_numeric,
                'dia_chi' => $dia_chi,
                'email' => $email,
                'mat_khau' => $hashedPassword,
                'chuc_vu_id' => 2, // Mặc định là Client
                'trang_thai' => 1 // Kích hoạt mặc định
            ]);

            return true; // Đăng ký thành công
        } catch (Exception $e) {
            return "Lỗi hệ thống: " . $e->getMessage();
        }
    }

    /**
     * Lấy thông tin tài khoản theo email
     * 
     * @param string $email Email cần tìm
     * @return array|false Trả về mảng thông tin user hoặc false nếu không tìm thấy
     */
    public function getTaiKhoanformEmail($email)
    {
        try {
            // Sử dụng prepared statement với dấu :email để tránh SQL injection
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            // Thực thi câu lệnh và truyền tham số
            $stmt->execute([':email' => $email]);
            // Sử dụng fetch() để lấy một bản ghi duy nhất
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi Truy Vấn: " . $e->getMessage();
        }
    }

    public function updateUserInfo($ho_ten, $ngay_sinh, $so_dien_thoai, $gioi_tinh, $dia_chi, $email)
    {
        try {
            // Cập nhật thông tin người dùng (không thay đổi mật khẩu)
            $sql = "UPDATE tai_khoans 
                SET ho_ten = :ho_ten, ngay_sinh = :ngay_sinh, 
                    so_dien_thoai = :so_dien_thoai, gioi_tinh = :gioi_tinh, 
                    dia_chi = :dia_chi
                WHERE email = :email";

            $stmt = $this->conn->prepare($sql);

            // Truyền tham số
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':ngay_sinh' => $ngay_sinh,
                ':so_dien_thoai' => $so_dien_thoai,
                ':gioi_tinh' => $gioi_tinh,
                ':dia_chi' => $dia_chi,
                ':email' => $email
            ]);

            // Kiểm tra nếu có dòng nào bị ảnh hưởng
            if ($stmt->rowCount() > 0) {
                return true; // Thành công
            } else {
                // Nếu không có dòng nào bị thay đổi (có thể dữ liệu không thay đổi)
                return false;
            }
        } catch (Exception $e) {
            // Nếu có lỗi, in ra thông báo lỗi chi tiết
            error_log("Lỗi Cập Nhật: " . $e->getMessage());  // Ghi vào log để kiểm tra
            return false;
        }
    }

    /**
     * Lấy thông tin tài khoản theo ID
     * 
     * @param int $id ID tài khoản
     * @return array|false Trả về mảng thông tin user hoặc false nếu không tìm thấy
     */
    public function getIdTaiKhoan($id)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "CÓ LỖI: " . $e->getMessage();
        }
    }

    
    //   Cập nhật thông tin khách hàng (bao gồm ảnh đại diện)
   
    public function updatekhachHang($id, $ho_ten, $email, $so_dien_thoai, $gioi_tinh, $ngay_sinh, $anh_dai_dien)
    {
        try {
            $sql = "UPDATE tai_khoans 
                    SET ho_ten = :ho_ten,
                        email = :email, 
                        ngay_sinh = :ngay_sinh, 
                        so_dien_thoai = :so_dien_thoai,
                        gioi_tinh = :gioi_tinh, 
                        anh_dai_dien = :anh_dai_dien
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            // Truyền tham số
            $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':ngay_sinh' => $ngay_sinh,
                ':so_dien_thoai' => $so_dien_thoai,
                ':gioi_tinh' => $gioi_tinh,
                ':anh_dai_dien' => $anh_dai_dien,
                ':id' => $id,
            ]);

            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            echo "CÓ LỖI: " . $e->getMessage();
            return false;
        }
    }
}
?>