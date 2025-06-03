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

    <!-- Danh sách sản phẩm -->
    <div class="product-list">
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
    </div>
</main>

<?php require_once 'layout/footer.php'; ?>

