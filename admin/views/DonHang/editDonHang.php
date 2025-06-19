<?php 
// Include các phần giao diện
include './views/layout/header.php'; 
include './views/layout/navbar.php'; 
include './views/layout/sidebar.php'; 
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-10">
                    <h4>Thông tin đơn hàng</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <?php
              $statusColor = '';
              if ($donHang['trang_thai_id'] == 1) {
                  $statusColor = 'primary';
              } elseif ($donHang['trang_thai_id'] >= 2 && $donHang['trang_thai_id'] <= 9) {
                  $statusColor = 'warning';
              } elseif ($donHang['trang_thai_id'] == 10) {
                  $statusColor = 'success';
              } else {
                  $statusColor = 'danger';
              }
            ?>

                <div class="col-12">
                    <div class="alert alert-<?= $statusColor; ?> d-flex justify-content-between" role="alert">
                        <p class="mb-0">Đơn hàng: <?= $donHang['ten_trang_thai'] ?></p>
                        <p class="mb-0">Ngày đặt: <?= formatDate($donHang['ngay_dat']) ?></p>
                    </div>

                    <!-- Chi tiết đơn hàng -->
                    <div class="invoice p-3 mb-3">
                        <div class="row invoice-info">
                            <!-- Thông tin người đặt -->
                            <div class="col-sm-4 invoice-col">
                                <strong>Thông tin người đặt</strong>
                                <address>
                                    <?= $donHang['ho_ten'] ?><br>
                                    Email: <?= $donHang['email'] ?><br>
                                    SĐT: <?= $donHang['so_dien_thoai'] ?><br>
                                </address>
                            </div>

                            <!-- Thông tin người nhận -->
                            <div class="col-sm-4 invoice-col">
                                <strong>Người nhận</strong>
                                <address>
                                    <?= $donHang['ten_nguoi_nhan'] ?><br>
                                    Email: <?= $donHang['email_nguoi_nhan'] ?> <br>
                                    SĐT: <?= $donHang['sdt_nguoi_nhan'] ?><br>
                                    Địa chỉ: <?= $donHang['dia_chi_nguoi_nhan'] ?><br>
                                </address>
                            </div>

                            <!-- Thông tin đơn hàng -->
                            <div class="col-sm-4 invoice-col">
                                <strong>Thông tin đơn hàng</strong>
                                <address>
                                    Mã đơn hàng: <?= $donHang['ma_don_hang'] ?><br>
                                    Tổng tiền: <?= $donHang['tong_tien'] ?> <br>
                                    Ghi chú: <?= $donHang['ghi_chu'] ?><br>
                                    Thanh toán: <?= $donHang['ten_phuong_thuc'] ?><br>
                                </address>
                            </div>
                        </div>

                        <!-- Bảng danh sách sản phẩm -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <h4>Bảng danh sách sản phẩm</h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tong_tien = 0; ?>
                                        <?php foreach ($sanPhamDonHang as $index => $sanPham): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $sanPham['ten_san_pham'] ?></td>
                                                <td><?= number_format($sanPham['don_gia']) ?> đ</td>
                                                <td><?= $sanPham['so_luong'] ?></td>
                                                <td><?= number_format($sanPham['thanh_tien']) ?> đ</td>
                                            </tr>
                                            <?php $tong_tien += $sanPham['thanh_tien']; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tổng tiền -->
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                  <h4>Tổng các phí cần thanh toán</h4><br>
                                    <table class="table">
                                        <tr>
                                            <th>Thành tiền:</th>
                                            <td><?= number_format($tong_tien) ?> đ</td>
                                        </tr>
                                        <?php /*
                                        <tr>
                                            <th>Vận chuyển:</th>
                                            <td>30,000 đ</td>
                                        </tr>
                                        */ ?>
                                        <tr>
                                            <th>Tổng tiền:</th>
                                            <td><strong><?= number_format($tong_tien) ?> đ</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Cập nhật trạng thái đơn hàng -->
                        <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-header">
                                <h4 class="mb-0">Sửa trạng thái đơn hàng</h4>
                              </div>
                              <div class="card-body">
                                <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="POST">
                                  <input type="hidden" name="don_hang_id" value="<?= $donHang['id'] ?>">
                                  <div class="status-flow">
                                    <?php 
                                    // Lọc trạng thái hủy đơn (id = 9) ra khỏi danh sách chính
                                    $normalStatuses = array_filter($listTrangThaiDonHang, function($status) {
                                        return $status['id'] != 9;
                                    });
                                    $cancelStatus = array_filter($listTrangThaiDonHang, function($status) {
                                        return $status['id'] == 9;
                                    });
                                    $cancelStatus = reset($cancelStatus); // Lấy phần tử đầu tiên
                                    
                                    $current = $donHang['trang_thai_id'];
                                    $nextStatus = null;
                                    $currentStatus = null;

                                    // Tìm trạng thái hiện tại và trạng thái tiếp theo
                                    foreach ($normalStatuses as $trangThai) {
                                        if ($trangThai['id'] == $current) {
                                            $currentStatus = $trangThai;
                                        } elseif ($trangThai['id'] == $current + 1) {
                                            $nextStatus = $trangThai;
                                        }
                                    }

                                    // Hiển thị trạng thái hiện tại
                                    if ($currentStatus) :
                                    ?>
                                        <div class="status-step current">
                                            <input type="radio" 
                                                   name="trang_thai_id" 
                                                   value="<?= $currentStatus['id'] ?>" 
                                                   id="status_<?= $currentStatus['id'] ?>"
                                                   checked
                                                   style="display: none;">
                                            <label for="status_<?= $currentStatus['id'] ?>" class="status-button">
                                                <div class="status-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="status-info">
                                                    <span class="status-text"><?= $currentStatus['ten_trang_thai'] ?></span>
                                                    <span class="status-hint">(Trạng thái hiện tại)</span>
                                                </div>
                                            </label>
                                        </div>
                                    <?php endif; ?>

                                    <?php 
                                    // Hiển thị trạng thái tiếp theo nếu có và chưa phải trạng thái cuối
                                    if ($nextStatus && $current < 10) :
                                    ?>
                                        <div class="status-step next">
                                            <input type="radio" 
                                                   name="trang_thai_id" 
                                                   value="<?= $nextStatus['id'] ?>" 
                                                   id="status_<?= $nextStatus['id'] ?>"
                                                   style="display: none;">
                                            <label for="status_<?= $nextStatus['id'] ?>" class="status-button">
                                                <div class="status-icon">
                                                    <i class="fas fa-arrow-right"></i>
                                                </div>
                                                <div class="status-info">
                                                    <span class="status-text"><?= $nextStatus['ten_trang_thai'] ?></span>
                                                    <span class="status-hint">(Trạng thái tiếp theo)</span>
                                                </div>
                                            </label>
                                        </div>
                                    <?php endif; ?>

                                    <?php 
                                    // Chỉ hiển thị trạng thái hủy đơn khi đơn hàng chưa đến trạng thái chuẩn bị hàng
                                    if ($donHang['trang_thai_id'] < 3 && $donHang['trang_thai_id'] != 9): 
                                    ?>
                                        <div class="status-step cancel-status">
                                            <input type="radio" 
                                                   name="trang_thai_id" 
                                                   value="<?= $cancelStatus['id'] ?>" 
                                                   id="status_<?= $cancelStatus['id'] ?>"
                                                   style="display: none;">
                                            <label for="status_<?= $cancelStatus['id'] ?>" class="status-button">
                                                <div class="status-icon">
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                                <div class="status-info">
                                                    <span class="status-text"><?= $cancelStatus['ten_trang_thai'] ?></span>
                                                    <span class="status-hint">(Hủy đơn hàng)</span>
                                                </div>
                                            </label>
                                        </div>
                                    <?php endif; ?>
                                  </div>
                                  <div class="form-group mt-3 text-center">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fas fa-save mr-1"></i>Lưu Thay Đổi
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <style>
                            .status-flow {
                                display: flex;
                                flex-direction: column;
                                gap: 8px;
                                max-width: 350px;
                                margin: 0 auto;
                            }
                            .status-step {
                                position: relative;
                            }
                            .status-button {
                                display: flex;
                                align-items: center;
                                padding: 8px 12px;
                                border-radius: 6px;
                                cursor: pointer;
                                transition: all 0.2s ease;
                                border: 1px solid #dee2e6;
                                background: #fff;
                            }
                            .status-icon {
                                width: 28px;
                                height: 28px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 50%;
                                margin-right: 10px;
                                font-size: 14px;
                            }
                            .status-info {
                                flex: 1;
                            }
                            .status-text {
                                display: block;
                                font-weight: 500;
                                font-size: 13px;
                            }
                            .status-hint {
                                display: block;
                                font-size: 11px;
                                color: #6c757d;
                                margin-top: 1px;
                            }
                            /* Trạng thái hiện tại */
                            .status-step.current .status-button {
                                background: #e3f2fd;
                                border-color: #2196f3;
                            }
                            .status-step.current .status-icon {
                                background: #2196f3;
                                color: white;
                            }
                            .status-step.current .status-text {
                                color: #1976d2;
                            }
                            /* Trạng thái đã hoàn thành */
                            .status-step.completed .status-button {
                                background: #e8f5e9;
                                border-color: #4caf50;
                            }
                            .status-step.completed .status-icon {
                                background: #4caf50;
                                color: white;
                            }
                            .status-step.completed .status-text {
                                color: #388e3c;
                            }
                            /* Trạng thái tiếp theo */
                            .status-step.next .status-button {
                                background: #fff;
                                border-color: #2196f3;
                            }
                            .status-step.next .status-icon {
                                background: #2196f3;
                                color: white;
                            }
                            .status-step.next .status-text {
                                color: #2196f3;
                            }
                            .status-step.next .status-button:hover {
                                background: #e3f2fd;
                                transform: translateX(3px);
                            }
                            /* Trạng thái bị khóa */
                            .status-step.disabled .status-button {
                                background: #f5f5f5;
                                border-color: #bdbdbd;
                                cursor: not-allowed;
                                opacity: 0.8;
                            }
                            .status-step.disabled .status-icon {
                                background: #bdbdbd;
                                color: #757575;
                            }
                            .status-step.disabled .status-text {
                                color: #757575;
                            }
                            /* Trạng thái hủy đơn */
                            .status-step.cancel-status .status-button {
                                background: #fff;
                                border-color: #f44336;
                            }
                            .status-step.cancel-status .status-icon {
                                background: #f44336;
                                color: white;
                            }
                            .status-step.cancel-status .status-text {
                                color: #f44336;
                            }
                            .status-step.cancel-status .status-button:hover {
                                background: #ffebee;
                                transform: translateX(3px);
                            }
                            /* Trạng thái đã chọn */
                            .status-step input[type="radio"]:checked + .status-button {
                                background: #e3f2fd;
                                border-color: #2196f3;
                                box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.25);
                            }
                            .status-step input[type="radio"]:checked + .status-button .status-icon {
                                background: #2196f3;
                                color: white;
                            }
                            .status-step.cancel-status input[type="radio"]:checked + .status-button {
                                background: #ffebee;
                                border-color: #f44336;
                                box-shadow: 0 0 0 2px rgba(244, 67, 54, 0.25);
                            }
                            .status-step.cancel-status input[type="radio"]:checked + .status-button .status-icon {
                                background: #f44336;
                                color: white;
                            }
                            .card {
                                box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
                                margin-bottom: 1rem;
                            }
                            .card-header {
                                background-color: #f8f9fa;
                                border-bottom: 1px solid #dee2e6;
                                padding: 0.75rem 1.25rem;
                            }
                            .card-body {
                                padding: 1rem;
                            }
                        </style>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const radioButtons = document.querySelectorAll('input[type="radio"]');
                                radioButtons.forEach(radio => {
                                    radio.addEventListener('change', function() {
                                        // Xóa class selected từ tất cả các nút
                                        document.querySelectorAll('.status-button').forEach(btn => {
                                            btn.classList.remove('selected');
                                        });
                                        // Thêm class selected cho nút được chọn
                                        if (this.checked) {
                                            this.nextElementSibling.classList.add('selected');
                                        }
                                    });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
