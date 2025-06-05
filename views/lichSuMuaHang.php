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

    .table-responsive {
        margin-top: 20px;
    }

    .table.table-bordered {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        overflow: hidden; /* Ensures rounded corners apply to content */
    }

    .table thead th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        padding: 15px;
        text-align: center;
        vertical-align: middle;
        border-bottom: 2px solid #e9ecef;
    }

    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        border-top: 1px solid #e9ecef;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .badge {
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.9em;
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

    .btn-sm {
        padding: 8px 15px;
        font-size: 0.9em;
        border-radius: 5px;
        margin-right: 5px; /* Space between buttons */
        transition: all 0.3s ease;
    }

    .btn-sm:last-child {
        margin-right: 0;
    }

    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #138496;
        border-color: #117a8b;
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
    
    .alert-info {
        color: #055160;
        background-color: #cff4fc;
        border-color: #b6effb;
        padding: 15px;
        border-radius: 5px;
    }

</style>

<?php require_once 'layout/menu.php'; ?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-4">Lịch Sử Mua Hàng</h2>
            
            <?php if (empty($donHangs)): ?>
                <div class="alert alert-info text-center">
                    Bạn chưa có đơn hàng nào.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Phương thức thanh toán</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($donHangs as $donHang): ?>
                                <tr>
                                    <td><?php echo $donHang['ma_don_hang']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($donHang['ngay_dat'])); ?></td>
                                    <td><?php echo formatCurrency($donHang['tong_tien']); ?></td>
                                    <td>
                                        <span class="badge <?php echo $donHang['trang_thai_id'] == 1 ? 'bg-warning' : ($donHang['trang_thai_id'] == 2 ? 'bg-info' : ($donHang['trang_thai_id'] == 3 ? 'bg-success' : 'bg-danger')); ?>">
                                            <?php echo $trangThaiDonHang[$donHang['trang_thai_id']] ?? 'Không xác định'; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $phuongThucThanhToan[$donHang['phuong_thuc_thanh_toan_id']] ?? 'Không xác định'; ?></td>
                                    <td>
                                        <a href="<?php echo BASE_URL; ?>?act=chi-tiet-mua-hang&id=<?php echo $donHang['id']; ?>" class="btn btn-info btn-sm">
                                            Chi tiết
                                        </a>
                                        <?php if ($donHang['trang_thai_id'] == 1): ?>
                                            <a href="<?php echo BASE_URL; ?>?act=huy-don-hang&id=<?php echo $donHang['id']; ?>" 
                                               class="btn btn-danger btn-sm"
                                               onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                                Hủy đơn
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php include './views/layout/footer.php'; ?>


