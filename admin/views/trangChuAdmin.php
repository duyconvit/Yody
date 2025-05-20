<?php include './views/layout/header.php'; ?>
<style>
.main-content {
    padding: 15px;
}

.page-content {
    margin: 0 auto;
    margin-top: -20px;
    max-width: 1200px;
}

.container-fluid {
    padding: 0 15px;
}

.col {
    padding: 0 15px;
}
</style>
<?php include './views/layout/navbar.php'; ?>
<?php include './views/layout/sidebar.php'; ?>

<div class="content-wrapper">
    <section class="content-header">
    </section>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3 pb-1">
                                <div class="col-12">
                                    <h1 class="fs-16 mb-1 text-center">Trang thống kê</h1>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <!-- Thống kê tổng thu nhập -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Tổng thu nhập</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24
                                                        %
                                                    </h5>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>
                                                            <?= number_format($tongThuNhap, 0, '.', '.') ?>
                                                        </span>VNĐ </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thống kê tổng khách hàng -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Tổng Khách hàng</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24
                                                        %
                                                    </h5>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <?php
                                                  $tongKhachHang = 0;
                                                  foreach ($listTaiKhoan as $khachHang): 
                                                    if (($khachHang['trang_thai'] == 1) && ($khachHang['chuc_vu_id'] == 2)) {
                                                      $tongKhachHang++;
                                                    }
                                                  endforeach;
                                                ?>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>
                                                            <?= $tongKhachHang ?>
                                                        </span>Khách hàng </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thống kê tổng đơn hàng -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card card-animate">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                                        Tổng Đơn Hàng</p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <h5 class="text-success fs-14 mb-0">
                                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24
                                                        %
                                                    </h5>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-end justify-content-between mt-4">
                                                <div>
                                                    <?php
                                                  $tongDonHang = count($listAllDonHang);
                                                ?>
                                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span>
                                                            <?= $tongDonHang ?>
                                                        </span>Đơn Hàng </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Sản phẩm bán chạy</h4>

                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                        <tbody>
                                            <?php
                                                $maxProducts = 5;
                                                $count = 0;
                                                foreach ($listDetailDonHang as $sanPham) {
                                                    if ($count >= $maxProducts) break;
                                                ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded p-1 me-2">
                                                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="" width="100px"/>
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1"><a
                                                                    href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['san_pham_id'] ?> "
                                                                    class="text-reset"><?= $sanPham['ten_san_pham'] ?></a>
                                                            </h5>
                                                            <span
                                                                class="text-muted"><?= formatDate($sanPham['ngay_dat']) ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal">
                                                        <?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') == 0 ?  number_format($sanPham['gia_san_pham'], 0, ',', '.') :  number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') ?>
                                                        VNĐ</h5>
                                                    <span class="text-muted">Giá</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal"><?= $sanPham['so_don_dat'] ?></h5>
                                                    <span class="text-muted">Đơn đặt</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 my-1 fw-normal"><?= $sanPham['tong_so_luong'] ?>
                                                    </h5>
                                                    <span class="text-muted">Số lượng</span>
                                                </td>
                                            </tr>
                                            <?php
                                                $count++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div
                                    class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                    <div class="col-sm">
                                        <div class="text-muted">
                                            Hiển thị <span class="fw-semibold">5</span> Kết quả bán chạy nhất trong
                                            tháng <?= date('m') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include './views/layout/footer.php'; ?>

</body>

</html>