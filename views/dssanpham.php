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
}

.product-item img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
}

.product-item h3 {
    font-size: 14px;
    margin: 8px 0;
}

.price {
    font-size: 14px;
    color: red;
}

.old-price {
    text-decoration: line-through;
    color: gray;
    margin-right: 6px;
    font-size: 12px;
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
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="<?= BASE_URL . '?act=list-san-pham' ?>">Sản
                                    phẩm</a></li>
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
        <h2>Danh mục</h2>
        <ul>
            <li><a href="?act=list-san-pham">Tất cả</a></li>
            <?php foreach ($listDanhMuc as $danhMuc): ?>
            <li>
                <a href="?act=list-san-pham&danh_muc_id=<?= $danhMuc['id'] ?>">
                    <?= $danhMuc['ten_danh_muc'] ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </aside>

    <!-- Danh sách sản phẩm bên phải -->
    <section class="product-list">
        <?php if (empty($listSanPham)): ?>
        <p>Không có sản phẩm nào!</p>
        <?php else: ?>
        <?php foreach ($listSanPham as $sanPham): ?>
        <div class="product-item">
            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                <img src="<?= $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
            </a>
            <h3><?= $sanPham['ten_san_pham'] ?></h3>
            <p class="price">
                <span class="old-price">
                    <?= number_format($sanPham['gia_san_pham'], 0, ',', '.') ?>đ
                </span>
                <span class="new-price">
                    <?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.') ?>đ
                </span>
            </p>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </section>
</main>

<?php require_once 'layout/footer.php'; ?>