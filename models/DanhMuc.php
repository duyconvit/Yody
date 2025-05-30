<?php
class DanhMuc {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllDanhMuc() {
        try {
            $sql = "SELECT * FROM danh_mucs";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return [];
        }
    }

    public function themDanhMuc($tenDanhMuc) {
        try {
            $sql = "INSERT INTO danh_mucs (ten_danh_muc) VALUES (:ten_danh_muc)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':ten_danh_muc' => $tenDanhMuc]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }
}
