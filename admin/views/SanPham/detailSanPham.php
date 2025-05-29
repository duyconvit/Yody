<!-- header  -->
<?php require './views/layout/header.php'; ?>
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
                    <h1>Xem chi tiết sản phẩm</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-12">
                            <img style="width:400px; height: 400px" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                class="product-image" alt="Product Image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">Tên sản phẩm: <?= $sanPham['ten_san_pham'] ?></h3>
                        <hr>
                        <h4 class="mt-3">Giá tiền: <?= $sanPham['gia_san_pham'] ?></h4>
                        <h4 class="mt-3">Giá khuyến mãi: <?= $sanPham['gia_khuyen_mai'] ?></h4>
                        <h4 class="mt-3">Số lượng: <?= $sanPham['so_luong'] ?></h4>
                        <!-- <h4 class="mt-3">Lượt xem: <?= $sanPham['luot_xem'] ?></h4> -->
                        <h4 class="mt-3">Ngày nhập: <?= $sanPham['ngay_nhap'] ?></h4>
                        <h4 class="mt-3">Danh mục: <?= $sanPham['ten_danh_muc'] ?></h4>
                        <h4 class="mt-3">Trạng thái: <?= $sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></h4>
                        <h4 class="mt-3">Mô tả: <?= $sanPham['mo_ta'] ?></h4>


                    </div>
                   

                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Footer  -->
<?php include './views/layout/footer.php'; ?>
<!-- End footer  -->

<!-- Page specific script -->
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
<!-- Code injected by live-server -->

</body>
<script>
$(document).ready(function() {
    $('.product-image-thumb').on('click', function() {
        var $image_element = $(this).find('img')
        $('.product-image').prop('src', $image_element.attr('src'))
        $('.product-image-thumb.active').removeClass('active')
        $(this).addClass('active')
    })
})
</script>

</html>