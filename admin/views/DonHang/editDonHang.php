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
                                        <tr>
                                            <th>Vận chuyển:</th>
                                            <td>30,000 đ</td>
                                        </tr>
                                        <tr>
                                            <th>Tổng tiền:</th>
                                            <td><strong><?= number_format($tong_tien + 30000) ?> đ</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Cập nhật trạng thái đơn hàng -->
                        <div class="row">
                          <div class="col-12">
                          <h4>Sửa trạng thái đơn hàng</h4>
                            <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="POST">
                              <input type="hidden" name="don_hang_id" value="<?= $donHang['id'] ?>">
                              <div>
                                <div class="form-group">
                                  <select id="inputStatus" name="trang_thai_id" class="form-control custom-select">
                                      <?php foreach ($listTrangThaiDonHang as $trangThai) : ?>
                                          <option
                                              <?php if ($donHang['trang_thai_id'] > $trangThai['id'] || in_array($donHang['trang_thai_id'], [9, 10, 11])) {
                                                  echo 'disabled';
                                              } ?>
                                              <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                              value="<?= $trangThai['id'] ?>">
                                              <?= $trangThai['ten_trang_thai'] ?>
                                          </option>
                                      <?php endforeach; ?>
                                  </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>
