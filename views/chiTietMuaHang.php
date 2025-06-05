<?php require_once 'layout/header.php'; ?>

<style>
    .container.py-5 {
        padding-top: 40px !important;
        padding-bottom: 40px !important;
    }

    .text-center.mb-4 {
        margin-bottom: 30px !important;
        color: #333;
        font-weight: 600;
    }

    .card {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    .card-header {
        background-color: #f8f9fa;
        padding: 15px 20px;
        font-size: 18px;
        font-weight: 600;
        color: #333;
        border-bottom: 1px solid #e9ecef;
    }

    .card-body {
        padding: 20px;
    }

    .card-body p {
        margin-bottom: 10px;
        font-size: 16px;
        color: #555;
    }

    .card-body p strong {
        color: #333;
        font-weight: 600;
        display: inline-block;
        min-width: 150px; /* Adjust as needed for alignment */
    }

    .table-responsive {
        margin-top: 15px; /* Adjust if needed */
    }

    .table {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #e9ecef;
        color: #495057;
        font-weight: 600;
        padding: 12px 15px;
        text-align: left;
        vertical-align: middle;
        border-bottom: 2px solid #dee2e6;
    }

     .table thead th:first-child {
        text-align: center; /* Center product image/name header */
    }

    .table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-top: 1px solid #e9ecef;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .table tfoot td {
        padding: 15px;
        font-weight: 600;
        border-top: 2px solid #e9ecef;
    }

     .table tfoot td strong {
        color: #333;
    }

    .d-flex.align-items-center img {
        border-radius: 4px;
        margin-right: 15px;
        border: 1px solid #ddd;
    }

    .d-flex.align-items-center h6 {
        margin-bottom: 0;
        font-size: 16px;
        color: #333;
    }

    .badge {
        padding: 6px 10px;
        border-radius: 15px;
        font-size: 0.85em;
        font-weight: 600;
    }

    .badge.bg-warning {
        background-color: #ffc107 !important;
        color: #212529;
    }

    .badge.bg-info {
        background-color: #17a2b8 !important;
        color: #fff;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
        color: #fff;
    }

    .badge.bg-danger {
        background-color: #dc3545 !important;
        color: #fff;
    }

    .btn {
        padding: 10px 20px;
        font-size: 1em;
        border-radius: 5px;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .btn-secondary:hover {
         background-color: #5a6268;
        border-color: #545b62;
        color: #fff;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
        border-color: #bd2130;
        color: #fff;
    }
    
    .text-end {
        text-align: right !important;
    }

</style>

<?php require_once 'layout/menu.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">Chi Tiết Đơn Hàng</h2>
            
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin đơn hàng #<?php echo $donHang['ma_don_hang']; ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Người nhận:</strong> <?php echo $donHang['ten_nguoi_nhan']; ?></p>
                            <p><strong>Email:</strong> <?php echo $donHang['email_nguoi_nhan']; ?></p>
                            <p><strong>Số điện thoại:</strong> <?php echo $donHang['sdt_nguoi_nhan']; ?></p>
                            <p><strong>Địa chỉ:</strong> <?php echo $donHang['dia_chi_nguoi_nhan']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Ngày đặt:</strong> <?php echo date('d/m/Y', strtotime($donHang['ngay_dat'])); ?></p>
                            <p><strong>Trạng thái:</strong> 
                                <span class="badge <?php echo $donHang['trang_thai_id'] == 1 ? 'bg-warning' : ($donHang['trang_thai_id'] == 2 ? 'bg-info' : ($donHang['trang_thai_id'] == 3 ? 'bg-success' : 'bg-danger')); ?>">
                                    <?php echo $trangThaiDonHang[$donHang['trang_thai_id']] ?? 'Không xác định'; ?>
                                </span>
                            </p>
                            <p><strong>Phương thức thanh toán:</strong> <?php echo $phuongThucThanhToan[$donHang['phuong_thuc_thanh_toan_id']] ?? 'Không xác định'; ?></p>
                            <p><strong>Ghi chú:</strong> <?php echo $donHang['ghi_chu'] ? $donHang['ghi_chu'] : 'Không có'; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Chi tiết sản phẩm</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($chiTietDonHang as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if (!empty($item['anh_san_pham'])): ?>
                                                    <img src="<?php echo $item['anh_san_pham']; ?>" alt="<?php echo $item['ten_san_pham']; ?>" class="img-thumbnail me-3" style="width: 50px;">
                                                <?php endif; ?>
                                                <div>
                                                    <h6 class="mb-0"><?php echo $item['ten_san_pham']; ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td><?= formatCurrency($item['don_gia']) ?></td>
                                        <td><?php echo $item['so_luong']; ?></td>
                                        <td><?= formatCurrency($item['thanh_tien']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Tổng tiền:</strong></td>
                                    <td><strong><?= formatCurrency($donHang['tong_tien']) ?></strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="<?php echo BASE_URL; ?>?act=lich-su-mua-hang" class="btn btn-secondary">Quay lại</a>
                <?php if ($donHang['trang_thai_id'] == 1): ?>
                    <a href="<?php echo BASE_URL; ?>?act=huy-don-hang&id=<?php echo $donHang['id']; ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                        Hủy đơn hàng
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once './views/layout/footer.php'; ?> 