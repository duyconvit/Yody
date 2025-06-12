<!-- Start Header Area -->
<style>
    .header-area {
        font-family: 'Roboto', sans-serif !important;
    }
    
    .header-area .header-social-link a,
    .header-area .logo,
    .header-area .header-search-field,
    .header-area .dropdown-list a,
    .header-area .main-menu a {
        font-family: 'Roboto', sans-serif !important;
        font-weight: 400 !important;
    }
</style>
    <header class="header-area">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header middle area start -->
            <div class="header-main-area">
                <div class="container">
                    <div class="row align-items-center ptb-15">
                        <!-- header social area start -->
                        <div class="col-lg-4">
                            <div class="header-social-link">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-youtube-play"></i></a>
                            </div>
                        </div>
                        <!-- header social area end -->

                        <!-- start logo area -->
                        <div class="col-lg-4">
                            <div class="logo text-center">
                                <a href="<?= BASE_URL . '?act=/' ?>">
                                    <img src="uploads/logo.svg" alt="Brand Logo" style="max-width: 120px; height: auto;">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-end">
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <li class="header-search-container mr-0">
                                            <button class="search-trigger d-block"><i class="pe-7s-search"></i></button>
                                                <form class="header-search-box d-none" action="<?= BASE_URL ?>" method="GET">
                                                <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." class="header-search-field">
                                                <button type="submit" class="header-search-btn"><i class="pe-7s-search"></i></button>
                                            </form>
                                        </li>
                                        <li class="user-hover">
                                            <label for="">
                                                <?php 
                                                    if (isset($_SESSION['user_client'])) {
                                                        echo $_SESSION['user_client'];
                                                    } elseif (isset($_SESSION['user_admin'])) {
                                                        echo $_SESSION['user_admin'];
                                                    }
                                                ?>
                                            </label>
                                            <a href="#">
                                                    <i class="pe-7s-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                <?php if (!isset($_SESSION['user_client']) && !isset($_SESSION['user_admin'])) { ?>
                                                    <li><a href="<?= BASE_URL . '/?act=login' ?>">Đăng Nhập</a></li>
                                                    <li><a href="<?= BASE_URL . '/?act=register' ?>">Đăng Ký</a></li>
                                                <?php } else { ?>
                                                    <li><a href="<?= BASE_URL . '/?act=chi-tiet-khach-hang' ?>">Tài Khoản</a>
                                                    </li>
                                                    <li><a href="<?= BASE_URL . '/?act=lich-su-mua-hang' ?>">Đơn Hàng</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" onclick="confirmLogout()">Đăng xuất</a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>

                                        <li>
                                            <?php if (!isset($_SESSION['user_client'])) { ?>
                                                    <a href="<?= BASE_URL . '?act=gio-hang' ?>">
                                                        <i class="pe-7s-shopbag"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="<?= BASE_URL ?>?act=gio-hang" class="minicart-btn" style="position: relative; display: inline-block; padding-right: 20px;">
                                                        <i class="pe-7s-shopbag"></i>
                                                    </a>
                                                <?php } ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- mini cart area end -->
                    </div>
                    <div class="row" style="margin-top: -10px;">
                        <!-- main menu area start -->
                        <div class="col-12">
                            <div class="main-menu-area sticky">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul class="justify-content-center header-style-4">
                                            <li><a href="<?= BASE_URL . '?act=/' ?>">Trang chủ</i></a></li>
                                            <li><a href="<?= BASE_URL . '?act=/' ?>">Giới thiệu</i></a></li>
                                            <li><a href="<?= BASE_URL . '?act=list-san-pham' ?>">Sản phẩm</i></a></li>
                                            <li><a href="<?= BASE_URL . '?act=/' ?>">Tin tức</i></a></li>
                                            <li><a href="<?= BASE_URL . '?act=/' ?>">Liên hệ</i></a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->
                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->

    </header>
    <!-- end Header Area -->
      <script>
        function confirmLogout() {
            let confirmAction = confirm(
                "Bạn có chắc chắn muốn đăng xuất không?");
            if (confirmAction) {
                window.location.href =
                    "<?= BASE_URL . '/?act=logout-clinet' ?>";
            }
        }
    </script>