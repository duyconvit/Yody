<!-- Header -->
<?php include './views/layout/header.php'; ?>
<!-- End Header -->
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lý tài khoản khách hàng</h1>
                </div>
            </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <td>
                        <img src="<?= BASE_URL . $sanPham['anh_dai_dien'] ?>" style="width:70%" alt=""
                          onerror="this.onerror=null; this.src='https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?ga=GA1.1.1531874448.1727145719&semt=ais_items_boosted&w=740'">
                      </td>
                </div>
                <div class="col-6">
                    <div class="container">
                        <table class="table table-borderless">
                        <tbody style="font-size: large">
                            <tr>
                                <th>Họ tên:</th>
                                <td><?=$khachhang['ho_ten'] ?? '' ?></td>
                            </tr>
                            <tr>
                                <th>Ngày sinh:</th>
                                <td><?=$khachhang['ngay_sinh'] ?? '' ?></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td><?=$khachhang['email'] ?? ''?></td>
                            </tr>
                            <tr>
                                <th>Số điện thoại:</th>
                                <td><?=$khachhang['so_dien_thoai'] ?? ''?></td>
                            </tr>
                            <tr>
                                <th>Giới tính:</th>
                                <td><?=$khachhang['gioi_tinh'] == 1 ? 'Nam': 'Nữ'; ?></td>
                            </tr>
                            <tr>
                                <th>Địa chỉ:</th>
                                <td><?=$khachhang['dia_chi'] ?? ''?></td>
                            </tr>
                            <tr>
                                <th>Trạng thái:</th>
                                <td><?=$khachhang['trang_thai'] == 1 ? 'Active': 'Inactive';?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer -->
<?php include './views/layout/footer.php'; ?>
<!-- End Footer -->

<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
</body>

</html>