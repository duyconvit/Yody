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
                    <h5 class="text-center mt-3"><?= $listTaiKhoan['ho_ten'] ?></h5>
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
                    <form action="<?= BASE_URL . '?act=sua-khach-hang' ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $listTaiKhoan['id'] ?>">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Tên đăng nhập:</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext"> <?= $listTaiKhoan['email'] ?> </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Họ và tên:</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="ho_ten"
                                    value="<?= $listTaiKhoan['ho_ten'] ?>">
                                <small class="text-danger"><?= $_SESSION['errors']['ho_ten'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Email:</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email"
                                    value="<?= $listTaiKhoan['email'] ?>">
                                <small class="text-danger"><?= $_SESSION['errors']['email'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Số điện thoại:</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="so_dien_thoai"
                                    value="<?= $listTaiKhoan['so_dien_thoai'] ?>">
                                <small class="text-danger"><?= $_SESSION['errors']['so_dien_thoai'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Giới tính:</label>
                            <div class="col-md-9">
                                <select name="gioi_tinh" class="form-control">
                                    <option value="1" <?= $listTaiKhoan['gioi_tinh'] == 1 ? 'selected' : '' ?>>Nam
                                    </option>
                                    <option value="2" <?= $listTaiKhoan['gioi_tinh'] == 2 ? 'selected' : '' ?>>Nữ
                                    </option>
                                </select>
                            </div>
                            <small class="text-danger"><?= $_SESSION['errors']['gioi_tinh'] ?? '' ?></small>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Ngày sinh:</label>
                            <div class="col-md-9">
                                <input type="date" class="form-control" name="ngay_sinh"
                                    value="<?= $listTaiKhoan['ngay_sinh'] ?>">
                                <small class="text-danger"><?= $_SESSION['errors']['ngay_sinh'] ?? '' ?></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label">Ảnh đại diện:</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="anh_dai_dien"
                                    value="<?= $listTaiKhoan['anh_dai_dien'] ?>">
                                <small class="text-muted">Dùng lượng file tối đa 1 MB. Định dạng: .JPEG, .PNG</small>
                            </div>
                            <small class="text-danger"><?= $_SESSION['errors']['anh_dai_dien'] ?? '' ?></small>
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