<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<style>
/* Main chính */
main {
    display: flex;
    gap: 20px;
    padding: 20px;
    align-items: flex-start;
    margin: 0 100px;
    /* Cách lề 100px */
}

/* Bộ lọc bên trái */
.sidebar {
    width: 18%;
    background: #f8f8f8;
    padding: 12px;
    border-radius: 5px;
    height: fit-content;
}

.sidebar h2 {
    font-size: 16px;
    margin-bottom: 10px;
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    padding: 5px 0;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333;
    display: block;
    padding: 6px 10px;
    background: white;
    border-radius: 4px;
    border: 1px solid #ddd;
    text-align: center;
}

.sidebar ul li a:hover {
    background: #ddd;
}

/* Form search */
.search-container {
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f8f8;
    border-radius: 5px;
}

.search-form {
    display: flex;
    gap: 10px;
    align-items: center;
}

.search-input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.search-btn {
    padding: 10px 20px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
}

.search-btn:hover {
    background: #0056b3;
}

/* Kết quả search */
.search-results {
    margin-bottom: 20px;
    padding: 15px;
    background: #e7f3ff;
    border-radius: 5px;
    border-left: 4px solid #007bff;
}

.search-results h3 {
    margin: 0 0 10px 0;
    color: #007bff;
    font-size: 18px;
}

.search-results p {
    margin: 0;
    color: #666;
}

/* Thông báo không tìm thấy */
.no-results {
    text-align: center;
    padding: 40px 20px;
    background: #f8f8f8;
    border-radius: 5px;
    margin: 20px 0;
}

.no-results h3 {
    color: #666;
    margin-bottom: 10px;
}

.no-results p {
    color: #999;
}

/* Danh sách sản phẩm */
.product-list {
    flex: 1;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

/* Sản phẩm */
.product-item {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
    background: #fff;
    border-radius: 5px;
    position: relative;
    overflow: hidden;
}

.product-item img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
}

.product-item h3 {
    font-size: 14px;
    margin: 8px 0;
    min-height: 40px;
}

.price-box {
    margin: 10px 0;
}

.price-regular {
    color: #ff0000;
    font-weight: bold;
    font-size: 16px;
}

.price-old {
    color: #999;
    text-decoration: line-through;
    font-size: 14px;
    margin-left: 5px;
}

/* Style cho mác giảm giá */
.product-label {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1;
}

.product-label.discount {
    background: #ff0000;
    color: white;
    padding: 5px 10px;
    border-radius: 3px;
    font-size: 12px;
    font-weight: bold;
}

/* Responsive */
@media (max-width: 1024px) {
    main {
        flex-direction: column;
        align-items: center;
        margin: 0 50px;
        /* Cách lề 50px khi màn hình nhỏ hơn */
    }

    .sidebar {
        width: 100%;
        text-align: center;
    }

    .product-list {
        width: 100%;
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    main {
        margin: 0 20px;
        /* Cách lề 20px khi màn hình nhỏ hơn */
    }

    .product-list {
        grid-template-columns: repeat(2, 1fr);
    }

    .search-form {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    main {
        margin: 0 10px;
        /* Cách lề 10px trên mobile */
    }

    .product-list {
        grid-template-columns: repeat(1, 1fr);
    }
}
</style>

<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-wrap">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=list-san-pham' ?>">Sản phẩm</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<main>
    <!-- Bộ lọc danh mục bên trái -->
    <aside class="sidebar">
        <h3>Bộ Lọc</h3>
        <ul>
            <?php foreach ($listDanhMuc as $danhMuc): ?>
                <li>
                    <a href="<?= BASE_URL . '?act=list-san-pham&danh_muc_id=' . $danhMuc['id'] ?>">
                        <?= $danhMuc['ten_danh_muc'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <!-- Phần nội dung chính -->
    <div class="main-content">
        <!-- Form search -->
        <div class="search-container">
            <form class="search-form" action="<?= BASE_URL ?>" method="GET">
                <input type="hidden" name="act" value="search">
                <input type="text" name="keyword" class="search-input" 
                       placeholder="Tìm kiếm sản phẩm..." 
                       value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                <button type="submit" class="search-btn">
                    <i class="fa fa-search"></i> Tìm kiếm
                </button>
            </form>
        </div>

        <!-- Hiển thị kết quả search -->
        <?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])): ?>
            <div class="search-results">
                <h3>Kết quả tìm kiếm cho: "<?= htmlspecialchars($_GET['keyword']) ?>"</h3>
                <p>Tìm thấy <?= count($listSanPham) ?> sản phẩm</p>
            </div>
        <?php endif; ?>

        <!-- Danh sách sản phẩm -->
        <div class="product-list">
            <?php if (empty($listSanPham)): ?>
                <?php if (isset($_GET['keyword']) && !empty($_GET['keyword'])): ?>
                    <div class="no-results">
                        <h3>Không tìm thấy sản phẩm nào</h3>
                        <p>Không có sản phẩm nào phù hợp với từ khóa "<?= htmlspecialchars($_GET['keyword']) ?>"</p>
                        <p>Vui lòng thử lại với từ khóa khác hoặc <a href="<?= BASE_URL . '?act=list-san-pham' ?>">xem tất cả sản phẩm</a></p>
                    </div>
                <?php else: ?>
                    <div class="no-results">
                        <h3>Không có sản phẩm nào!</h3>
                        <p>Hiện tại không có sản phẩm nào trong danh mục này.</p>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <?php foreach ($listSanPham as $sanPham): ?>
                    <div class="product-item">
                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                            <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                            <h3><?= $sanPham['ten_san_pham'] ?></h3>
                        </a>
                        <div class="price-box">
                            <?php if ($sanPham['gia_khuyen_mai'] && $sanPham['gia_khuyen_mai'] != $sanPham['gia_san_pham']): ?>
                                <span class="price-regular"><?= formatCurrency($sanPham['gia_khuyen_mai']) ?></span>
                                <span class="price-old"><del><?= formatCurrency($sanPham['gia_san_pham']) ?></del></span>
                            <?php else: ?>
                                <span class="price-regular"><?= formatCurrency($sanPham['gia_san_pham']) ?></span>
                            <?php endif; ?>
                        </div>

                        <?php if ($sanPham['gia_khuyen_mai'] && $sanPham['gia_khuyen_mai'] != $sanPham['gia_san_pham']): ?>
                            <div class="product-label discount">
                                <span>Giảm giá</span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once 'layout/footer.php'; ?>

