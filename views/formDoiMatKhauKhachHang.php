<?php require_once 'layout/header.php'; ?>
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
                                <li class="breadcrumb-item active" aria-current="page">Chi tiết khách hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-4">
        <div class="row">
            <!-- Ảnh đại diện -->
            <div class="col-md-4">
                <div class="card shadow-sm p-4">
                    <img src="<?= BASE_URL . $listTaiKhoan['anh_dai_dien'] ?>" class="img-fluid rounded-circle border"
                        alt="Avatar">
                    <h5 class="mt-text-center mt-3"><?= $listTaiKhoan['ho_ten'] ?></h5>
                </div>

                <div class="mt-3">
                    <div class="list-group">
                        <a href="<?= BASE_URL . '?act=chi-tiet-khach-hang' ?>"
                            class="list-group-item list-group-item-action">
                            Thông tin cá nhân
                        </a>
                        <a href="<?= BASE_URL . '?act=doi-mat-khau-khach-hang' ?>"
                            class="list-group-item list-group-item-action">
                            Đổi mật khẩu
                        </a>
                    </div>
                </div>
            </div>


            <!-- Form thông tin cá nhân -->
            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-3">Thông tin cá nhân</h4>
                    <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success text-center"> <?= $_SESSION['success'] ?> </div>
                    <?php unset($_SESSION['success']); endif; ?>
                    <form action="<?= BASE_URL . '?act=doi-mat-khau-khach-hang' ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $listTaiKhoan['id'] ?>">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Mật khẩu cũ:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="mat_khau" name="mat_khau"
                                    value="">
                                <small class="text-danger"><?= $_SESSION['errors']['mat_khau'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Mật khẩu mới:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="mat_khau_moi" name="mat_khau_moi"
                                    value="">
                                <small class="text-danger"><?= $_SESSION['errors']['mat_khau_moi'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Nhập lại mật khẩu mới:</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" id="nhap_lai_mat_khau_moi" name="nhap_lai_mat_khau_moi"
                                    value="">
                                <small class="text-danger"><?= $_SESSION['errors']['nhap_lai_mat_khau_moi'] ?? '' ?></small>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary btn-lg px-4 py-3">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once 'layout/footer.php'; ?>