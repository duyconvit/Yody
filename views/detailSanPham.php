<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=list-san-pham' ?>">Sản phẩm</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding pb-0">
        <div class="container">
            <div class="row">
                <!-- product details wrapper start -->
                <div class="col-lg-12 order-1 order-lg-2">
                    <!-- product details inner end -->
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-large-slider">
                                    <!-- Chỉ hiển thị ảnh chính -->
                                    <div class="pro-large-img">
                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product-details" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="product-details">
                                    <div class="product-name">
                                        <h1><?= $sanPham['ten_san_pham'] ?></h1>
                                    </div>
                                    <div class="manufacturer-name">
                                        <div class="product-name">
                                            <h3>Danh Mục: <?= $sanPham['ten_danh_muc'] ?></h3>
                                        </div>

                                        <div class="price-box" style="margin-top: 17px;">
                                            <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                <span class="price-regular" style="font-size: 24px; font-weight: bold; color: red;">
                                                    <?= formatPrice($sanPham['gia_khuyen_mai']) . ''; ?>
                                                </span>
                                                <span class="price-old" style="font-size: 18px; color: gray;">
                                                    <del><?= formatPrice($sanPham['gia_san_pham']) . ''; ?></del>
                                                </span>
                                            <?php } else { ?>
                                                <span class="price-regular" style="font-size: 24px; font-weight: bold; color: red;">
                                                    <?= formatPrice($sanPham['gia_san_pham']) . ''; ?>
                                                </span>
                                            <?php } ?>
                                        </div>

                                        <div class="availability" style="margin-top: 17px; font-size: 20px;">
                                            <span>Trong kho: <?= $sanPham['so_luong'] ?></span>
                                        </div>
                                        <div class="pro-desc" style="margin-top: 17px; font-size: 20px;">Mô tả: <?= $sanPham['mo_ta'] ?></div>
                                        <form action="<?= BASE_URL . '?act=them-gio-hang' ?>" method="post" class="d-flex align-items-center gap-3 flex-wrap">
                                            <div class="d-flex align-items-center gap-2" style="margin-top:20px; font-size: 20px;">
                                                <div>Số lượng:</div>
                                                <input type="hidden" name="san_pham_id" value="<?= $sanPham['id']; ?>">
                                                <div class="d-flex align-items-center border rounded px-2" style="width: 130px;">
                                                    <button type="button" class="btn btn-outline-secondary qty-btn decrease px-2">−</button>
                                                    <input type="text" class="form-control text-center border-0 flex-grow-1" value="1" name="so_luong" min="1" max="<?= $sanPham['so_luong'] ?>" id="quantity">
                                                    <button type="button" class="btn btn-outline-secondary qty-btn increase px-2">+</button>
                                                </div>
                                            </div>
                                            <div class="border rounded p-2" style="margin-top:20px; font-size: 20px;">
                                                <?php if ($sanPham['so_luong'] > 0) { ?>
                                                    <button class="btn btn-warning fw-bold w-100">Thêm vào giỏ hàng</button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger fw-bold w-100">Đã hết hàng</button>
                                                <?php } ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details reviews end -->
                </div>
                <!-- product details wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->

    <!-- related products area start -->
    <div class="related-products section-padding">
        <div class="container">
            <div class="section-title text-center">
                <h4 class="section-title-text">Sản Phẩm Liên Quan</h4>
            </div>
            <div class="swiper swiper-related">
                <div class="swiper-wrapper">
                    <?php foreach ($listSanPhamLienQuan as $sanPham): ?>
                        <div class="swiper-slide">
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                        <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                        <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                    </a>
                                    <div class="product-badge">
                                        <?php
                                        $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                        $ngayHienTai = new DateTime();
                                        $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                        if ($tinhNgay->days <= 7): ?>
                                            <div class="product-label new"><span>Mới</span></div>
                                        <?php endif; ?>
                                        <?php if ($sanPham['gia_khuyen_mai']): ?>
                                            <div class="product-label discount"><span>Giảm giá</span></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="cart-hover">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>" class="btn btn-cart">Xem chi tiết</a>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <h6 class="product-name">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                            <?= $sanPham['ten_san_pham'] ?>
                                        </a>
                                    </h6>
                                    <div class="price-box">
                                        <?php if ($sanPham['gia_khuyen_mai']): ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_khuyen_mai']) ?></span>
                                            <span class="price-old"><del><?= formatPrice($sanPham['gia_san_pham']) ?></del></span>
                                        <?php else: ?>
                                            <span class="price-regular"><?= formatPrice($sanPham['gia_san_pham']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
    <!-- related products area end -->
</main>

<!-- SwiperJS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
    new Swiper('.swiper-related', {
        slidesPerView: 4,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        breakpoints: {
            992: { slidesPerView: 4 },
            768: { slidesPerView: 2 },
            576: { slidesPerView: 1 }
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const decreaseBtn = document.querySelector(".decrease");
        const increaseBtn = document.querySelector(".increase");
        const quantityInput = document.getElementById("quantity");

        let min = parseInt(quantityInput.min);
        let max = parseInt(quantityInput.max);

        decreaseBtn.addEventListener("click", function() {
            let value = parseInt(quantityInput.value);
            if (value > min) {
                quantityInput.value = value - 1;
            }
        });

        increaseBtn.addEventListener("click", function() {
            let value = parseInt(quantityInput.value);
            if (value < max) {
                quantityInput.value = value + 1;
            }
        });

        quantityInput.addEventListener("input", function() {
            let value = parseInt(quantityInput.value);
            if (isNaN(value) || value < min) {
                quantityInput.value = min;
            } else if (value > max) {
                quantityInput.value = max;
            }
        });
    });
</script>

<?php require_once 'layout/footer.php'; ?>