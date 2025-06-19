<?php require_once './views/layout/header.php'; ?>

<style>
    body {
        font-family: 'Roboto', sans-serif !important;
    }
    
    .section-title .title,
    .product-name a,
    .blog-title a,
    .price-box,
    .btn-cart,
    .swipe-nav button,
    .swipe-dot {
        font-family: 'Roboto', sans-serif !important;
        font-weight: 400 !important;
    }
    
    .section-title .title {
        font-weight: 500 !important;
    }

    .section-title .title {
        animation: none !important;
        transition: none !important;
        transform: none !important;
    }

    /* Collection section styling */
    .feature-product .product-item {
        margin-bottom: 30px;
    }

    .feature-product .product-thumb {
        position: relative;
        overflow: hidden;
    }

    .feature-product .product-thumb img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .feature-product .product-thumb:hover img {
        transform: scale(1.05);
    }

    .feature-product .cart-hover {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.7);
        padding: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .feature-product .product-thumb:hover .cart-hover {
        opacity: 1;
    }

    .feature-product .btn-cart {
        width: 100%;
        background: #fff;
        color: #333;
        border: none;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }

    .feature-product .btn-cart:hover {
        background: #333;
        color: #fff;
    }

    .feature-product .product-name {
        margin-top: 15px;
        font-size: 16px;
    }

    .feature-product .product-name a {
        color: #333;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .feature-product .product-name a:hover {
        color: #666;
    }

    /* Section title styling */
    .section-title {
        margin-bottom: 30px;
        text-align: left;
    }

    .section-title .title {
        font-size: 32px;
        font-weight: 700;
        color: black !important;
        position: relative;
        padding-bottom: 15px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-family: 'Roboto', sans-serif;
        line-height: 1.2;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .section-title .title:after {
        display: none;
    }

    /* Điều chỉnh layout cho đồng nhất */
    .product-carousel-4_2 {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .product-carousel-4_2 .product-item {
        padding: 0 15px;
        width: 25%;
    }

    @media (max-width: 1199px) {
        .product-carousel-4_2 .product-item {
            width: 33.33%;
        }
    }

    @media (max-width: 991px) {
        .product-carousel-4_2 .product-item {
            width: 50%;
        }
        
        .feature-product .product-thumb img {
            height: 350px;
        }
    }

    @media (max-width: 767px) {
        .product-carousel-4_2 .product-item {
            width: 100%;
        }
        
        .feature-product .product-thumb img {
            height: 300px;
        }
    }

    /* Swipe slider styling */
    .swipe-slider {
        position: relative;
        overflow: hidden;
        height: 600px;
        padding: 0 50px;
    }

    .swipe-slider-container {
        display: flex;
        transition: transform 0.5s ease;
        height: 100%;
        align-items: center;
    }

    .swipe-slide {
        min-width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transition: all 0.5s ease;
        flex-shrink: 0;
    }

    .swipe-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        display: flex;
        justify-content: space-between;
        padding: 0 20px;
        z-index: 10;
        left: 0;
    }

    .swipe-nav button {
        background: rgba(255, 255, 255, 0.5);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .swipe-nav button:hover {
        background: rgba(255, 255, 255, 0.8);
    }

    .swipe-dots {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
    }

    .swipe-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .swipe-dot.active {
        background: #fff;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.swipe-slider-container');
    const slides = document.querySelectorAll('.swipe-slide');
    const dots = document.querySelectorAll('.swipe-dot');
    let currentSlide = 0;
    let startX = 0;
    let isDragging = false;
    let isTransitioning = false;

    // Touch events
    slider.addEventListener('touchstart', (e) => {
        if (isTransitioning) return;
        startX = e.touches[0].clientX;
        isDragging = true;
    });

    slider.addEventListener('touchmove', (e) => {
        if (!isDragging || isTransitioning) return;
        const currentX = e.touches[0].clientX;
        const diff = startX - currentX;
        slider.style.transform = `translateX(${-currentSlide * 100 - (diff / slider.offsetWidth) * 100}%)`;
    });

    slider.addEventListener('touchend', (e) => {
        if (!isDragging || isTransitioning) return;
        isDragging = false;
        const endX = e.changedTouches[0].clientX;
        const diff = startX - endX;
        
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                currentSlide++;
            } else {
                currentSlide--;
            }
        }
        
        updateSlider();
    });

    // Navigation buttons
    document.querySelector('.swipe-prev').addEventListener('click', () => {
        if (isTransitioning) return;
        currentSlide--;
        updateSlider();
    });

    document.querySelector('.swipe-next').addEventListener('click', () => {
        if (isTransitioning) return;
        currentSlide++;
        updateSlider();
    });

    // Dots navigation
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            if (isTransitioning) return;
            currentSlide = index;
            updateSlider();
        });
    });

    function updateSlider() {
        isTransitioning = true;
        
        // Handle infinite loop
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        } else if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }

        slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Update dots
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });

        // Reset transition flag after animation completes
        setTimeout(() => {
            isTransitioning = false;
        }, 500); // Match this with CSS transition duration
    }

    // Initialize first slide
    currentSlide = 0;
    updateSlider();
});
</script>

<?php require_once './views/layout/menu.php'; ?>

<main>
    <!-- hero slider area start -->
    <section class="slider-area" style="height: 600px; overflow: hidden;">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="uploads/baner12.jpg" style="height: 600px; background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
            </div>

            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="uploads/baner11.jpg" style="height: 600px; background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
            </div>

            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="uploads/baner13.jpg" style="height: 600px; background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
            </div>
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="uploads/baner14.jpg" style="height: 600px; background-size: cover; background-position: center; background-repeat: no-repeat;">
                </div>
            </div>
        </div>
    </section>
    <!-- hero slider area end -->

    <!-- hot deals area start -->
    <section class="hot-deals section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title">
                    <h2 class="title" style="color: black !important;">Sản phẩm mới</h2>
                </div>
                <!-- section title end -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="deals-carousel-active slick-row-10 slick-arrow-style">
                    <!-- product item start -->
                    <?php foreach ($listSanPham as $key => $sanPham): 
                        $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                        $ngayHienTai = new DateTime();
                        $tinhNgay = $ngayHienTai->diff($ngayNhap);
                        $isNew = $tinhNgay->days <= 7;
                        $isDiscount = $sanPham['gia_khuyen_mai'] && $sanPham['gia_khuyen_mai'] != $sanPham['gia_san_pham'];
                        
                        if ($isNew):
                    ?>
                        <div class="product-item">
                            <figure class="product-thumb">
                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                </a>
                                <div class="product-badge">
                                    <div class="product-label new">
                                        <span>Mới</span>
                                    </div>

                                    <?php if ($isDiscount): ?>
                                        <div class="product-label discount">
                                            <span>Giảm giá</span>
                                        </div>
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
                                    <?php if ($isDiscount): ?>
                                        <span class="price-regular"><?= formatCurrency($sanPham['gia_khuyen_mai']) ?></span>
                                        <span class="price-old"><del><?= formatCurrency($sanPham['gia_san_pham']) ?></del></span>
                                    <?php else: ?>
                                        <span class="price-regular"><?= formatCurrency($sanPham['gia_san_pham']) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; endforeach; ?>
                    <!-- product item end -->
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- hot deals area end -->

    <!-- banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="./uploads/bst1.webp" alt="product banner">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="./uploads/bst2.webp" alt="product banner">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="./uploads/bst3.webp" alt="product banner">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="./uploads/bst4.webp" alt="product banner">
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- banner statistics area end -->

    <!-- featured product area start -->
    <section class="feature-product section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title">
                        <h2 class="title" style="color: black !important;">BST POLO COOL 2025</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swipe-slider">
                        <div class="swipe-slider-container">
                            <div class="swipe-slide" style="background-image: url('<?= BASE_URL ?>uploads/3d1.webp')"></div>
                            <div class="swipe-slide" style="background-image: url('<?= BASE_URL ?>uploads/3d2.webp')"></div>
                            <div class="swipe-slide" style="background-image: url('<?= BASE_URL ?>uploads/3d3.webp')"></div>
                            <div class="swipe-slide" style="background-image: url('<?= BASE_URL ?>uploads/3d4.webp')"></div>
                        </div>
                        <div class="swipe-nav">
                            <button class="swipe-prev">❮</button>
                            <button class="swipe-next">❯</button>
                        </div>
                        <div class="swipe-dots">
                            <div class="swipe-dot active"></div>
                            <div class="swipe-dot"></div>
                            <div class="swipe-dot"></div>
                            <div class="swipe-dot"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- featured product area end -->

    <!-- latest blog area start -->
    <section class="latest-blog-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title">
                        <h2 class="title" style="color: black !important;">Bản tin Yody</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="blog-carousel-active slick-row-10 slick-arrow-style">
                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="./uploads/tin1.jpeg" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <h5 class="blog-title">
                                    <a href="blog-details.html">Chung tay phủ xanh đất Việt: YODY góp sức 1 tỷ đồng trồng rừng</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="./uploads/tin4.jpg" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <h5 class="blog-title">
                                    <a href="blog-details.html">YODY ra mắt Polo Cafe Đá - Dấu ấn tiên phong trên thị trường thời trang Việt</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="./uploads/tin8.jpeg" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <h5 class="blog-title">
                                    <a href="blog-details.html">CÙNG YODY CHUNG TAY ĐẨY LÙI MẠO DANH, LỪA ĐẢO QUA MẠNG</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="./uploads/tin6.webp" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <h5 class="blog-title">
                                    <a href="blog-details.html">QUỐC TẾ THIẾU NHI - YODY SALE 20% TOÀN BỘ SẢN PHẨM TRẺ EM!</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->

                        <!-- blog post item start -->
                        <div class="blog-post-item">
                            <figure class="blog-thumb">
                                <a href="blog-details.html">
                                    <img src="./uploads/tin7.png" alt="blog image">
                                </a>
                            </figure>
                            <div class="blog-content">
                                <h5 class="blog-title">
                                    <a href="blog-details.html">SINH NHẬT 11 TUỔI YODY - ƯU ĐÃI TRI ÂN NGẬP TRÀN</a>
                                </h5>
                            </div>
                        </div>
                        <!-- blog post item end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest blog area end -->

    <!-- brand logo area start -->
    <div class="brand-logo section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/1.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/2.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/3.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/4.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/5.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/6.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand logo area end -->
</main>

<!-- offcanvas mini cart start -->
<!-- <div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-1.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$100.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                        </li>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="assets/img/cart/cart-2.jpg" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
                                    <a href="product-details.html">Dozen White Botanical Linen Dinner Napkins</a>
                                </h3>
                                <p>
                                    <span class="cart-quantity">1 <strong>&times;</strong></span>
                                    <span class="cart-price">$80.00</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li>
                            <span>sub-total</span>
                            <span><strong>$300.00</strong></span>
                        </li>
                        <li>
                            <span>Eco Tax (-2.00)</span>
                            <span><strong>$10.00</strong></span>
                        </li>
                        <li>
                            <span>VAT (20%)</span>
                            <span><strong>$60.00</strong></span>
                        </li>
                        <li class="total">
                            <span>total</span>
                            <span><strong>$370.00</strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="cart.html"><i class="fa fa-shopping-cart"></i> View Cart</a>
                    <a href="cart.html"><i class="fa fa-share"></i> Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- offcanvas mini cart end -->


<?php require_once './views/layout/footer.php'; ?>