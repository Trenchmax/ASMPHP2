<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản phẩm mới</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Laptop</a></li>
                            <li><a data-toggle="tab" href="#tab1">Điện thoại</a></li>
                            <li><a data-toggle="tab" href="#tab1">Máy ảnh</a></li>
                            <li><a data-toggle="tab" href="#tab1">Phụ kiện</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <div id="tab1" class="tab-pane active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                <?php foreach ($ramProduct as $product) : ?>
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= $product['image'] ?: 'default.webp' ?>" alt="">
                                            <?php if ($product['discount'] > 0) : ?>
                                                <div class="product-label">
                                                    <span class="sale">-<?= intval($product['discount']) ?>%</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Danh mục</p>
                                            <h3 class="product-name"><a href="/product/detail/<?=$product['id']?>"><?= htmlspecialchars($product['name']) ?></a></h3>
                                            <h4 class="product-price">
                                                <?= number_format($product['price'] * (1 - $product['discount'] / 100), 0, ',', '.') ?> đ
                                                <?php if ($product['discount'] > 0) : ?>
                                                    <del class="product-old-price"><?= number_format($product['price'], 0, ',', '.') ?> đ</del>
                                                <?php endif; ?>
                                            </h4>
                                            <div class="product-rating">
                                                <?php for ($i = 0; $i < 5; $i++) : ?>
                                                    <i class="fa <?= $i < rand(3, 5) ? 'fa-star' : 'fa-star-o' ?>"></i>
                                                <?php endfor; ?>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Yêu thích</span></button>
                                                <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">So sánh</span></button>
                                                <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem nhanh</span></button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <form action="/cart/create" method="POST">
                                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id']) ?>">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="add-to-cart-btn">
                                                    <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>