<?php

class AdminDanhMuc
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllDanhMuc()
    {
        try {

            $sql = "SELECT * FROM danh_mucs";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function addDanhMuc($ten_danh_muc, $mo_ta)
    {
        try {
            $sql = "INSERT INTO  danh_mucs (ten_danh_muc, mo_ta) 
                    VALUES (:ten_danh_muc, :mo_ta)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':ten_danh_muc' => $ten_danh_muc,
                    ':mo_ta' => $mo_ta
                ]
            );

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getByIdDanhMuc($id)
    {
        try {
            $sql = "SELECT * FROM danh_mucs WHERE id = :id";

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

    public function editDanhMuc($id, $ten_danh_muc, $mo_ta)
    {
        try {
            $sql = "UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta WHERE id = :id ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute(
                [
                    ':ten_danh_muc' => $ten_danh_muc,
                    ':mo_ta' => $mo_ta,
                    ':id' => $id
                ]
            );

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function deleteDanhMuc($id)
    {
        try {
            $sql = "DELETE FROM danh_mucs WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':id' => $id
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Method đếm số lượng sản phẩm thuộc danh mục - FIXED
    public function countSanPhamByDanhMuc($danh_muc_id) 
    {
        try {
            // Sửa lại query cho chắc chắn
            $sql = "SELECT COUNT(*) as total FROM san_phams WHERE danh_muc_id = :danh_muc_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':danh_muc_id' => $danh_muc_id
            ]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$result['total'];
            
        } catch (Exception $e) {
            // Debug: In lỗi ra để kiểm tra
            echo "Lỗi đếm sản phẩm: " . $e->getMessage();
            return 0;
        }
    }
}