<?php
require_once './models/DanhMuc.php';
require_once './config/connect.php';

$danhMuc = new DanhMuc();

// Thêm danh mục mới
$categories = [
    'Quần áo Nam',
    'Quần áo Nữ',
    'Áo Nam',
    'Quần Nam',
    'Áo Nữ',
    'Quần Nữ',
    'Phụ kiện Nam',
    'Phụ kiện Nữ'
];

foreach ($categories as $category) {
    if ($danhMuc->themDanhMuc($category)) {
        echo "Đã thêm danh mục: " . $category . "<br>";
    } else {
        echo "Lỗi khi thêm danh mục: " . $category . "<br>";
    }
}

echo "Hoàn tất việc thêm danh mục!"; 