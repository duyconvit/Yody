<aside class="main-sidebar sidebar-dark-primary elevation-4">
<div class="navbar-brand-box" style="display: flex; justify-content: center; align-items: center; width: 100%; margin-top:7px;">
    <a href="#"class="logo logo-light">
        <span class="logo-lg mt-4">
            <h1 class="display-7 mt-4" style="color: #ffff; display: inline; font-size: 33px;">Yody</h1>
            <h1 class="display-7 mt-4" style="color: #ffff; display: inline; font-size: 33px;">shop</h1>
        </span>
    </a>
</div>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image me-3">
          <img src="./assets/dist/img/phone.png" class="rounded-circle border border-white" width="60" height="60" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= BASE_URL_ADMIN ?>" class="d-block fs-4 fw-bold text-white">ADMIN</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=/' ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Thống kê
              </p>
            </a>
          </li>
              
          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=danh-muc' ?>" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Quản lý danh mục</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="nav-link">
            <i class="nav-icon fas fa-cube"></i>
              <p>Quản lý sản phẩm</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=quan-ly-don-hang' ?>" class="nav-link">
            <i class="nav-icon fas fa-file-invoice-dollar"></i>
              <p>Quản lý đơn hàng</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=quan-ly-binh-luan' ?>" class="nav-link">
            <i class="nav-icon fas fa-comments"></i>
              <p>Quản lý bình luận</p>
            </a>
          </li>
        

          <li class="nav-item">
            <a href="<?= BASE_URL_ADMIN . '?act=lien-he' ?>" class="nav-link">
            <i class="nav-icon fas fa-id-badge"></i>
              <p>Quản lý liên hệ</p>
            </a>
          </li>

          <li class="nav-item menu-open">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p style="color: white;">Quản Lý Người Dùng</p>
            <i class="fas fa-angle-left"></i>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= BASE_URL_ADMIN . '/?act=list-tai-khoan-quan-tri' ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p style="color: white;">Tài khoản quản trị viên</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASE_URL_ADMIN . '/?act=list-tai-khoan-khach-hang' ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p style="color: white;">Tài khoản khách hàng</p>
              </a>
            </li>
              <!-- <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN . '/?act=form-sua-thong-tin-ca-nhan-quan-tri' ?>" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p style="color: white;">Tài khoản cá nhân</p>
                </a>
              </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>