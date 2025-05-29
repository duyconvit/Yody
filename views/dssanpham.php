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
