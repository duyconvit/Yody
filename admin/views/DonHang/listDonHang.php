<?php 
// Include các phần giao diện
include './views/layout/header.php'; 
include './views/layout/navbar.php'; 
include './views/layout/sidebar.php'; 

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>
    <!-- Bootstrap 4.6 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- DataTables Bootstrap4 -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

    <style>
        body {
            background-color: #f4f6f9;
        }

        .content-header h1 {
            font-weight: bold;
        }

        .card {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        table th, table td {
            vertical-align: middle !important;
        }

        .btn-primary {
            border-radius: 20px;
            padding: 5px 15px;
        }

        .badge {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
<div class="content-wrapper p-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h1>Quản lý đơn hàng</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên người nhận</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listDonHang as $key => $donHang): ?>
                                        <?php
                                            $badgeClass = 'badge-secondary';
                                            switch ($donHang['ten_trang_thai']) {
                                                case 'Chờ xác nhận':
                                                    $badgeClass = 'badge-warning';
                                                    break;
                                                case 'Đã xác nhận':
                                                    $badgeClass = 'badge-info';
                                                    break;
                                                case 'Đang giao':
                                                    $badgeClass = 'badge-primary';
                                                    break;
                                                case 'Hoàn thành':
                                                    $badgeClass = 'badge-success';
                                                    break;
                                                case 'Đã hủy':
                                                    $badgeClass = 'badge-danger';
                                                    break;
                                            }
                                        ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $donHang['ma_don_hang'] ?></td>
                                            <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                                            <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                                            <td><?= date('d/m/Y', strtotime($donHang['ngay_dat'])) ?></td>
                                            <td><?= number_format($donHang['tong_tien'], 0, ',', '.') ?> đ</td>
                                            <td><span class="badge <?= $badgeClass ?>"><?= $donHang['ten_trang_thai'] ?></span></td>
                                            <td>
                                                <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id'] ?>" 
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Chi tiết / Cập nhật
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div> <!-- card-body -->
                    </div> <!-- card -->
                </div>
            </div>
        </div>
    </section>
</div>

<?php include './views/layout/footer.php'; ?>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/vi.json"
        }
    });
});
</script>
</body>
</html>
