<?php require_once 'layout/header.php'; ?>

<style>
    .checkout-page-wrapper {
        background-color: #f8f9fa;
        padding: 40px 0;
    }
    
    .checkout-title {
        color: #333;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }

    .checkout-billing-details-wrap,
    .order-summary-details {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }

    .single-input-item {
        margin-bottom: 20px;
    }

    .single-input-item label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #555;
    }

    .single-input-item input,
    .single-input-item textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: all 0.3s ease;
    }

    .single-input-item input:focus,
    .single-input-item textarea:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 0 2px rgba(76,175,80,0.1);
    }

    .order-summary-table {
        margin-bottom: 30px;
    }

    .order-summary-table table {
        border: 1px solid #e9ecef;
    }

    .order-summary-table th {
        background-color: #f8f9fa;
        padding: 15px;
        font-weight: 600;
    }

    .order-summary-table td {
        padding: 15px;
        vertical-align: middle;
    }

    .order-summary-table tfoot tr {
        background-color: #f8f9fa;
    }

    .order-summary-table tfoot tr:last-child {
        background-color: #4CAF50;
        color: white;
        font-size: 18px;
    }

    .order-summary-table tfoot tr:last-child td {
        padding: 20px 15px;
    }

    .payment-method-name {
        padding: 15px;
        border: 1px solid #e9ecef;
        border-radius: 4px;
        margin-bottom: 10px;
    }

    .custom-control-label {
        font-weight: 500;
        color: #555;
    }

    .btn-sqr {
        padding: 12px 30px;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-sqr:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .price-amount {
        font-weight: 600;
        color: #4CAF50;
    }

    .product-name {
        color: #333;
        text-decoration: none;
        font-weight: 500;
    }

    .product-name:hover {
        color: #4CAF50;
    }

    .product-quantity {
        color: #666;
        font-size: 0.9em;
    }

    .total-payment {
        background-color: #4CAF50 !important;
        color: white !important;
        font-size: 18px;
        font-weight: 600;
    }
    
    .total-payment .price-amount {
        color: white !important;
        font-size: 20px;
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
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=gio-hang' ?>">Giỏ hàng</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            

            <form action="<?= BASE_URL . '?act=xu-ly-thanh-toan' ?>" method="POST">
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Thông tin người nhận</h5>
                            <div class="billing-form-wrap">
                                    <div class="single-input-item">
                                        <label for="ten_nguoi_nhan" class="required">Tên người nhận</label>
                                        <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan"
                                            value="<?= $user['ho_ten'] ?>" placeholder="Tên người nhận" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="email_nguoi_nhan" class="required">Địa chỉ email</label>
                                        <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan"
                                            value="<?= $user['email'] ?>" placeholder="Địa chỉ email" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="sdt_nguoi_nhan" class="required">Số điện thoại</label>
                                        <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan"
                                            value="<?= $user['so_dien_thoai'] ?>" placeholder="Số điện thoại" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="dia_chi_nguoi_nhan" class="required">Địa chỉ</label>
                                        <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan"
                                            value="<?= $user['dia_chi'] ?>" placeholder="Địa chỉ" required />
                                    </div>

                                    <div class="single-input-item">
                                        <label for="ghi_chu">Ghi chú</label>
                                        <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3"
                                            placeholder="Vui lòng ghi chú..."></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Thông tin sản phẩm</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản phẩm</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                             
                                                $tongGioHang = 0;
                                                foreach($chiTietGioHang as $key=>$sanPham): 
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="" class="product-name"><?= $sanPham['ten_san_pham'] ?>
                                                        <span class="product-quantity">
                                                            x <?= $sanPham['so_luong'] ?>
                                                        </span>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                        $tong_tien = 0;
                                                        $giaSanPham = $sanPham['gia_khuyen_mai'] ? $sanPham['gia_khuyen_mai'] : $sanPham['gia_san_pham'];
                                                        $soLuong = $sanPham['so_luong'];
                                                        // Ensure values are numeric before multiplication
                                                        $tong_tien = (float)$giaSanPham * (int)$soLuong;
                                                        
                                                        $tongGioHang += $tong_tien; 
                                                    ?>
                                                    <span class="price-amount"><?= formatCurrency($tong_tien) ?></span>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Tạm tính</td>
                                                <td><span class="price-amount"><?= formatCurrency($tongGioHang) ?></span></td>
                                            </tr>
                                            <tr class="total-payment">
                                                <td>Tổng tiền thanh toán</td>
                                                <td>
                                                    <input type="hidden" name="tong_tien" value="<?= $tongGioHang ?>">
                                                    <span class="price-amount"><?= formatCurrency($tongGioHang) ?></span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show" style="margin-bottom: 10px;">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="cashon" value="1" name="phuong_thuc_thanh_toan_id" class="custom-control-input" checked />
                                                    <label class="custom-control-label" for="cashon">Thanh toán khi nhận hàng</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="single-payment-method" style="margin-bottom: 10px;">
                                            <div class="payment-method-name">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="directbank" value="2" name="phuong_thuc_thanh_toan_id" class="custom-control-input" />
                                                    <label class="custom-control-label" for="directbank">Thanh toán online</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="summary-footer-area d-flex justify-content-between align-items-center">
                                            <a href="<?= BASE_URL . '?act=gio-hang' ?>" class="btn btn-sqr">
                                                Quay về giỏ hàng
                                            </a>
                                            <button type="submit" class="btn btn-sqr">Đặt hàng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- checkout main wrapper end -->
</main>


<?php 
    require_once 'layout/footer.php'; 
?>