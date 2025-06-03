<?php require_once 'layout/header.php'; ?>

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
                                        <td><?php echo number_format($item['don_gia'], 0, ',', '.'); ?>đ</td>
                                        <td><?php echo $item['so_luong']; ?></td>
                                        <td><?php echo number_format($item['thanh_tien'], 0, ',', '.'); ?>đ</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Tổng tiền:</strong></td>
                                    <td><strong><?php echo number_format($donHang['tong_tien'], 0, ',', '.'); ?>đ</strong></td>
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

<?php require_once './views/layouts/footer.php'; ?> 