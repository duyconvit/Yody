<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<main>
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <h1 class="" style="margin-bottom: 30px;">Giỏ Hàng</h1>
            <div class="section-bg-color">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="pro-thumbnail">Ảnh sản phẩm</th>
                                        <th class="pro-title">Tên sản phẩm</th>
                                        <th class="pro-price">Giá tiền</th>
                                        <th class="pro-quantity">Số lượng</th>
                                        <th class="pro-subtotal">Tổng tiền</th>
                                        <th class="pro-remove">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php                                             
                                            $tongGioHang = 0;
                                            foreach($chiTietGioHang as $key=>$sanPham): 
                                        ?>
                                    <tr>
                                        <td class="pro-thumbnail"><a href="#"><img class="img-fluid"
                                                    src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="Product" /></a>
                                        </td>
                                        <td class="pro-title"><a href="#"><?= $sanPham['ten_san_pham'] ?></a></td>
                                        <td class="pro-price">
                                            <span>
                                                <?php if ($sanPham['gia_san_pham']) { ?>
                                                <?= formatPrice($sanPham['gia_khuyen_mai']) ?>
                                                <?php } else { ?>
                                                <?= formatPrice($sanPham['gia_san_pham']) ?>
                                                <?php } ?>
                                            </span>
                                        </td>
                                        <td class="pro-quantity">
                                                <div class="">
                                                    <span><?= $sanPham['so_luong'] ?></span>
                                                </div>
                                        </td>
                                        <td class="pro-subtotal">
                                            <span>
                                                <?php
                                                        $tong_tien = 0;
                                                        if ($sanPham['gia_khuyen_mai']) {
                                                            $tong_tien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                        } else {
                                                            $tong_tien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                        }
                                                        $tongGioHang += $tong_tien; 
                                                        echo formatPrice($tong_tien);
                                                    ?>
                                            </span>
                                        </td>
                                        <td class="pro-remove">
                                            <a href="<?= BASE_URL . '?act=xoa-gio-hang&id=' . $sanPham['id'] ?>">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <div class="cart-calculator-wrapper">
                            <div class="cart-calculate-items">
                                <h6>Tổng hóa đơn</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr class="total">
                                            <td>Tổng tiền giỏ hàng</td>
                                            <td class="total-amount"><?= formatPrice($tongGioHang) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr" style="width: 48%;">Thanh toán</a>
                                <a href="<?= BASE_URL ?>" class="btn btn-sqr" style="width: 48%;">Tiếp tục mua sắm</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
    require_once 'layout/footer.php'; 
?>