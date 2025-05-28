 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= BASE_URL ?>" class="nav-link">Website yody</a>
      </li>
    </ul>
    <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
        <!-- User Dropdown -->
        <li class="nav-item dropdown">
            <!-- <?php if (isset($_SESSION['user_admin'])) {
                                        echo $_SESSION['user_admin'];
                                    }?> -->
            <a class="nav-link" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                <i class="far fa-user" style="font-size: 24px;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <span class="dropdown-header">Chào mừng đến trang Admin</span>
                <div class="dropdown-divider"></div>
                <!-- <a href="<?= BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri' ?>" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Thông tin cá nhân
                </a> -->
                <div class="dropdown-divider"></div>
                <a href="<?= BASE_URL_ADMIN . '?act=logout-admin' ?>" class="dropdown-item"
                    onclick="return confirm('Bạn Đồng Ý Đăng Xuất?')">
                    <i class="fas fa-sign-out-alt mr-2"></i> Đăng xuất
                </a>
            </div>
        </li>
    </ul>
</nav>