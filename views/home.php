<?php require_once './views/layout/header.php';?>

<?php require_once './views/layout/menu.php'; ?>

    <main>
        <!-- hero slider area start -->
        <section class="slider-area" style="height: 600px; overflow: hidden;">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="uploads/baner4.jpg" style="height: 600px; background-size: cover; background-position: center; background-repeat: no-repeat;">
                    </div>
                </div>

                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="uploads/baner5.jpg" style="height: 600px; background-size: cover; background-position: center; background-repeat: no-repeat;">
                    </div>
                </div>

                <div class="hero-single-slide hero-overlay">
                    <div class="hero-slider-item bg-img" data-bg="uploads/baner3.webp" style="height: 600px; background-size: cover; background-position: center; background-repeat: no-repeat;">
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
                        <div class="section-title text-center">
                            <h2 class="title">Sản phẩm mới</h2>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="deals-carousel-active slick-row-10 slick-arrow-style">
                            <!-- hot deals item start -->
                            <div class="hot-deals-item product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/product/product-details-img1.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Perfect Diamond Jewellery for full family members</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$60.00</span>
                                        <span class="price-old"><del>$70.00</del></span>
                                    </div>
                                    <div class="progress-quantity">
                                        <div class="progress-title">
                                            <p class="product-sold">Sold: <span>40</span></p>
                                            <p class="product-available">Availabe: <span>300</span></p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="product-countdown" data-countdown="2022/11/25"></div>
                                </div>
                            </div>
                            <!-- hot deals item end -->

                            <!-- hot deals item start -->
                            <div class="hot-deals-item product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/product/product-details-img2.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Handmade golden earrings for for new generation</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$70.00</span>
                                        <span class="price-old"><del>$80.00</del></span>
                                    </div>
                                    <div class="progress-quantity">
                                        <div class="progress-title">
                                            <p class="product-sold">Sold: <span>350</span></p>
                                            <p class="product-available">Availabe: <span>650</span></p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="product-countdown" data-countdown="2022/10/20"></div>
                                </div>
                            </div>
                            <!-- hot deals item end -->

                            <!-- hot deals item start -->
                            <div class="hot-deals-item product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/product/product-details-img3.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Diamond Exclusive bracelet for new generation</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$80.00</span>
                                        <span class="price-old"><del>$90.00</del></span>
                                    </div>
                                    <div class="progress-quantity">
                                        <div class="progress-title">
                                            <p class="product-sold">Sold: <span>556</span></p>
                                            <p class="product-available">Availabe: <span>440</span></p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="product-countdown" data-countdown="2022/11/15"></div>
                                </div>
                            </div>
                            <!-- hot deals item end -->

                            <!-- hot deals item start -->
                            <div class="hot-deals-item product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/product/product-details-img4.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Perfect Diamond Jewellery for full family members</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$50.00</span>
                                        <span class="price-old"><del>$55.00</del></span>
                                    </div>
                                    <div class="progress-quantity">
                                        <div class="progress-title">
                                            <p class="product-sold">Sold: <span>150</span></p>
                                            <p class="product-available">Availabe: <span>200</span></p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="product-countdown" data-countdown="2022/12/15"></div>
                                </div>
                            </div>
                            <!-- hot deals item end -->

                            <!-- hot deals item start -->
                            <div class="hot-deals-item product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img src="assets/img/product/product-details-img5.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Citygold Exclusive Ring only for women</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$30.00</span>
                                        <span class="price-old"><del>$40.00</del></span>
                                    </div>
                                    <div class="progress-quantity">
                                        <div class="progress-title">
                                            <p class="product-sold">Sold: <span>90</span></p>
                                            <p class="product-available">Availabe: <span>120</span></p>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="product-countdown" data-countdown="2022/12/25"></div>
                                </div>
                            </div>
                            <!-- hot deals item end -->
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
                                <img src="assets/img/banner/img1-top.jpg" alt="product banner">
                            </a>
                            <div class="banner-content text-right">
                                <h5 class="banner-text1">BEAUTIFUL</h5>
                                <h2 class="banner-text2">Wedding<span>Rings</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/banner/img2-top.jpg" alt="product banner">
                            </a>
                            <div class="banner-content text-center">
                                <h5 class="banner-text1">EARRINGS</h5>
                                <h2 class="banner-text2">Tangerine Floral <span>Earring</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/banner/img3-top.jpg" alt="product banner">
                            </a>
                            <div class="banner-content text-center">
                                <h5 class="banner-text1">NEW ARRIVALLS</h5>
                                <h2 class="banner-text2">Pearl<span>Necklaces</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
                        </figure>
                    </div>
                    <div class="col-sm-6">
                        <figure class="banner-statistics mt-20">
                            <a href="#">
                                <img src="assets/img/banner/img4-top.jpg" alt="product banner">
                            </a>
                            <div class="banner-content text-right">
                                <h5 class="banner-text1">NEW DESIGN</h5>
                                <h2 class="banner-text2">Diamond<span>Jewelry</span></h2>
                                <a href="shop.html" class="btn btn-text">Shop Now</a>
                            </div>
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
                        <div class="section-title text-center">
                            <h2 class="title">featured products</h2>
                            <p class="sub-title">Add featured products to weekly lineup</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product-carousel-4_2 slick-row-10 slick-arrow-style">
                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-6.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-13.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>10%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Perfect Diamond Jewelry</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$60.00</span>
                                        <span class="price-old"><del>$70.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-7.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-9.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Handmade Golden Necklace</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$50.00</span>
                                        <span class="price-old"><del>$80.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-8.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-11.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Diamond</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Perfect Diamond Jewelry</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$99.00</span>
                                        <span class="price-old"><del></del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-16.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-10.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>15%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">silver</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Diamond Exclusive Ornament</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$55.00</span>
                                        <span class="price-old"><del>$75.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-10.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-9.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>20%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Citygold Exclusive Ring</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$60.00</span>
                                        <span class="price-old"><del>$70.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-1.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-18.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>10%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Gold</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Perfect Diamond Jewelry</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$60.00</span>
                                        <span class="price-old"><del>$70.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-2.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-17.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Handmade Golden Necklace</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$50.00</span>
                                        <span class="price-old"><del>$80.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-3.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-16.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">Diamond</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Perfect Diamond Jewelry</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$99.00</span>
                                        <span class="price-old"><del></del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-4.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-15.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>sale</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>15%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">silver</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Diamond Exclusive Ornament</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$55.00</span>
                                        <span class="price-old"><del>$75.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->

                            <!-- product item start -->
                            <div class="product-item">
                                <figure class="product-thumb">
                                    <a href="product-details.html">
                                        <img class="pri-img" src="assets/img/product/product-5.jpg" alt="product">
                                        <img class="sec-img" src="assets/img/product/product-14.jpg" alt="product">
                                    </a>
                                    <div class="product-badge">
                                        <div class="product-label new">
                                            <span>new</span>
                                        </div>
                                        <div class="product-label discount">
                                            <span>20%</span>
                                        </div>
                                    </div>
                                    <div class="button-group">
                                        <a href="wishlist.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="compare.html" data-bs-toggle="tooltip" data-bs-placement="left" title="Add to Compare"><i class="pe-7s-refresh-2"></i></a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick_view"><span data-bs-toggle="tooltip" data-bs-placement="left" title="Quick View"><i class="pe-7s-search"></i></span></a>
                                    </div>
                                    <div class="cart-hover">
                                        <button class="btn btn-cart">add to cart</button>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <div class="product-identity">
                                        <p class="manufacturer-name"><a href="product-details.html">mony</a></p>
                                    </div>
                                    <ul class="color-categories">
                                        <li>
                                            <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                        </li>
                                        <li>
                                            <a class="c-darktan" href="#" title="Darktan"></a>
                                        </li>
                                        <li>
                                            <a class="c-grey" href="#" title="Grey"></a>
                                        </li>
                                        <li>
                                            <a class="c-brown" href="#" title="Brown"></a>
                                        </li>
                                    </ul>
                                    <h6 class="product-name">
                                        <a href="product-details.html">Citygold Exclusive Ring</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">$60.00</span>
                                        <span class="price-old"><del>$70.00</del></span>
                                    </div>
                                </div>
                            </div>
                            <!-- product item end -->
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
                        <div class="section-title text-center">
                            <h2 class="title">latest blogs</h2>
                            <p class="sub-title">There are latest blog posts</p>
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
                                        <img src="assets/img/blog/blog-img1.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <p>25/03/2019 | <a href="#">Corano</a></p>
                                    </div>
                                    <h5 class="blog-title">
                                        <a href="blog-details.html">Celebrity Daughter Opens Up About Having Her Eye Color Changed</a>
                                    </h5>
                                </div>
                            </div>
                            <!-- blog post item end -->

                            <!-- blog post item start -->
                            <div class="blog-post-item">
                                <figure class="blog-thumb">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog-img2.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <p>25/03/2019 | <a href="#">Corano</a></p>
                                    </div>
                                    <h5 class="blog-title">
                                        <a href="blog-details.html">Children Left Home Alone For 4 Days In TV series Experiment</a>
                                    </h5>
                                </div>
                            </div>
                            <!-- blog post item end -->

                            <!-- blog post item start -->
                            <div class="blog-post-item">
                                <figure class="blog-thumb">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog-img3.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <p>25/03/2019 | <a href="#">Corano</a></p>
                                    </div>
                                    <h5 class="blog-title">
                                        <a href="blog-details.html">Lotto Winner Offering Up Money To Any Man That Will Date Her</a>
                                    </h5>
                                </div>
                            </div>
                            <!-- blog post item end -->

                            <!-- blog post item start -->
                            <div class="blog-post-item">
                                <figure class="blog-thumb">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog-img4.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <p>25/03/2019 | <a href="#">Corano</a></p>
                                    </div>
                                    <h5 class="blog-title">
                                        <a href="blog-details.html">People are Willing Lie When Comes Money, According to Research</a>
                                    </h5>
                                </div>
                            </div>
                            <!-- blog post item end -->

                            <!-- blog post item start -->
                            <div class="blog-post-item">
                                <figure class="blog-thumb">
                                    <a href="blog-details.html">
                                        <img src="assets/img/blog/blog-img5.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <div class="blog-meta">
                                        <p>25/03/2019 | <a href="#">Corano</a></p>
                                    </div>
                                    <h5 class="blog-title">
                                        <a href="blog-details.html">romantic Love Stories Of Hollywood's Biggest Celebrities</a>
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

        <!-- group product start -->
        <section class="group-product-area section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">New Arrivals</h2>
                            <p class="sub-title">Add new products to weekly lineup</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="group-list-carousel--3 slick-row-10 slick-arrow-style">
                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Diamond Exclusive ring</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$50.00</span>
                                            <span class="price-old"><del>$29.99</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-3.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Handmade Golden ring</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$55.00</span>
                                            <span class="price-old"><del>$30.00</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-5.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                exclusive gold Jewelry</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$45.00</span>
                                            <span class="price-old"><del>$25.00</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-7.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Perfect Diamond earring</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$50.00</span>
                                            <span class="price-old"><del>$29.99</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-9.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Handmade Golden Necklace</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$90.00</span>
                                            <span class="price-old"><del>$100.</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-11.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Handmade Golden Necklace</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$20.00</span>
                                            <span class="price-old"><del>$30.00</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-13.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Handmade Golden ring</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$55.00</span>
                                            <span class="price-old"><del>$30.00</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-15.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                exclusive gold Jewelry</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$45.00</span>
                                            <span class="price-old"><del>$25.00</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-17.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Handmade Golden Necklace</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$50.00</span>
                                            <span class="price-old"><del>$29.99</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-16.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                Handmade Golden Necklaces</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$55.00</span>
                                            <span class="price-old"><del>$30.00</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-12.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                exclusive silver top bracellet</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$45.00</span>
                                            <span class="price-old"><del>$25.00</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->

                            <!-- group list item start -->
                            <div class="group-slide-item">
                                <div class="group-item">
                                    <div class="group-item-thumb">
                                        <a href="product-details.html">
                                            <img src="assets/img/product/product-11.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="group-item-desc">
                                        <h5 class="group-product-name"><a href="product-details.html">
                                                top Perfect Diamond necklace</a></h5>
                                        <div class="price-box">
                                            <span class="price-regular">$50.00</span>
                                            <span class="price-old"><del>$29.99</del></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- group list item end -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- group product end -->

        <!-- instagram feed start -->
        <section class="instagram-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- section title start -->
                        <div class="section-title text-center">
                            <h2 class="title">Instagram</h2>
                            <p class="sub-title">Displays an Instagram feed of your photos from your Instagram account on your website.</p>
                        </div>
                        <!-- section title start -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="instagram-feed-thumb">
                            <div class="instagram-carousel">
                                <!-- single instagram start -->
                                <div class="instagram-item">
                                    <a href="#">
                                        <img src="assets/img/instagram/instagram-1.jpg" alt="instagram">
                                    </a>
                                </div>
                                <!-- single instagram end -->
                                <!-- single instagram start -->
                                <div class="instagram-item">
                                    <a href="#">
                                        <img src="assets/img/instagram/instagram-2.jpg" alt="instagram">
                                    </a>
                                </div>
                                <!-- single instagram end -->
                                <!-- single instagram start -->
                                <div class="instagram-item">
                                    <a href="#">
                                        <img src="assets/img/instagram/instagram-3.jpg" alt="instagram">
                                    </a>
                                </div>
                                <!-- single instagram end -->
                                <!-- single instagram start -->
                                <div class="instagram-item">
                                    <a href="#">
                                        <img src="assets/img/instagram/instagram-4.jpg" alt="instagram">
                                    </a>
                                </div>
                                <!-- single instagram end -->
                                <!-- single instagram start -->
                                <div class="instagram-item">
                                    <a href="#">
                                        <img src="assets/img/instagram/instagram-5.jpg" alt="instagram">
                                    </a>
                                </div>
                                <!-- single instagram end -->
                                <!-- single instagram start -->
                                <div class="instagram-item">
                                    <a href="#">
                                        <img src="assets/img/instagram/instagram-3.jpg" alt="instagram">
                                    </a>
                                </div>
                                <!-- single instagram end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- instagram feed end -->

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
    <div class="offcanvas-minicart-wrapper">
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
    </div>
    <!-- offcanvas mini cart end -->


   <?php require_once './views/layout/footer.php'; ?>