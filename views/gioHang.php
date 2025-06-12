<?php require_once 'layout/header.php'; ?>

<style>
    .cart-main-wrapper {
        padding: 40px 0;
    }
    
    .cart-main-wrapper h1 {
        color: #333;
        font-weight: 600;
        text-align: center;
        margin-bottom: 40px;
    }

    .section-bg-color {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.05);
        padding: 30px;
    }

    .cart-table {
        margin-bottom: 30px;
    }

    .cart-table thead th {
        background: #D4AF37;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 14px;
        padding: 15px;
        border: none;
        text-align: center;
        letter-spacing: 0.5px;
    }

    .cart-table tbody td {
        padding: 20px 15px;
        vertical-align: middle;
        border-color: #eee;
    }

    .pro-thumbnail img {
        max-width: 100px;
        border-radius: 5px;
    }

    .pro-title a {
        color: #333;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.3s;
    }

    .pro-title a:hover {
        color: #D4AF37;
    }

    .pro-price span {
        color: #D4AF37;
        font-weight: 600;
        font-size: 16px;
    }

    .pro-quantity span {
        font-weight: 500;
        color: #666;
    }

    .pro-subtotal span {
        color: #D4AF37;
        font-weight: 600;
        font-size: 16px;
    }

    .pro-remove a {
        color: #dc3545;
        font-size: 18px;
        transition: color 0.3s;
    }

    .pro-remove a:hover {
        color: #c82333;
    }

    .cart-calculator-wrapper {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 10px;
    }

    .cart-calculator-wrapper h6 {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .cart-calculator-wrapper .table {
        margin-bottom: 25px;
    }

    .cart-calculator-wrapper .total {
        font-size: 16px;
        font-weight: 600;
    }

    .cart-calculator-wrapper .total-amount {
        color: #D4AF37;
        font-size: 18px;
    }

    .btn-sqr {
        padding: 12px 25px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        border: 2px solid #D4AF37;
        border-radius: 5px;
        background: transparent;
        color: #D4AF37;
    }

    .btn-sqr:hover {
        transform: translateY(-2px);
        background: #D4AF37;
        color: white;
        box-shadow: 0 5px 15px rgba(212,175,55,0.2);
    }

    .btn-sqr[href="<?= BASE_URL . '?act=thanh-toan' ?>"] {
        background: #28a745;
        color: white;
        border: 2px solid #28a745;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .btn-sqr[href="<?= BASE_URL . '?act=thanh-toan' ?>"]:hover {
        background: #218838;
        border-color: #218838;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40,167,69,0.3);
    }

    .btn-sqr[href="<?= BASE_URL . '?act=thanh-toan' ?>"]::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to right,
            rgba(255,255,255,0) 0%,
            rgba(255,255,255,0.3) 50%,
            rgba(255,255,255,0) 100%
        );
        transform: rotate(45deg);
        transition: all 0.3s;
    }

    .btn-sqr[href="<?= BASE_URL . '?act=thanh-toan' ?>"]:hover::after {
        left: 100%;
    }
</style>

<?php require_once 'layout/menu.php'; ?>

<main>
        <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-main-wrapper section-padding">
        <div class="container">
            <h1 class="" style="margin-bottom: 30px;">Giỏ Hàng</h1>
            <?php if (isset($_SESSION['cart_notice'])): ?>
                <div class="alert alert-warning">
                    <?= $_SESSION['cart_notice'] ?>
                    <?php unset($_SESSION['cart_notice']); ?>
                </div>
            <?php endif; ?>
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
                                                <?php if ($sanPham['gia_khuyen_mai'] && $sanPham['gia_khuyen_mai'] != $sanPham['gia_san_pham']) { ?>
                                                <?= formatCurrency($sanPham['gia_khuyen_mai']) ?>
                                                <?php } else { ?>
                                                <?= formatCurrency($sanPham['gia_san_pham']) ?>
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
                                                        if ($sanPham['gia_khuyen_mai'] && $sanPham['gia_khuyen_mai'] != $sanPham['gia_san_pham']) {
                                                            $tong_tien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                        } else {
                                                            $tong_tien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                        }
                                                        $tongGioHang += $tong_tien; 
                                                        echo formatCurrency($tong_tien);
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
                                            <td class="total-amount"><?= formatCurrency($tongGioHang) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="<?= BASE_URL . '?act=thanh-toan' ?>" class="btn btn-sqr" style="width: 48%;">Thanh toán</a>
                                <a href="<?= BASE_URL ?>" class="btn btn-sqr" style="width: 48%;">Tiếp tục mua sắm</a>
                            </div>
                            <div class="mt-3">
                                <a href="javascript:history.back()" class="btn btn-sqr w-100" style="background: #6c757d; color: white;">
                                    <i class="fa fa-arrow-left"></i> Quay lại
                                </a>
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