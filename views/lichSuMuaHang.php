<?php require_once 'layout/header.php'; ?>

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
                                    <td><?php echo number_format($donHang['tong_tien'], 0, ',', '.'); ?>đ</td>
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

