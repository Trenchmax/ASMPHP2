<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">

            <!-- tiêu đề phần -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Sản phẩm bán chạy</h3>
                    <div class="section-nav">
                        <ul class="section-tab-nav tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab2">Laptop</a></li>
                            <li><a data-toggle="tab" href="#tab2">Điện thoại</a></li>
                            <li><a data-toggle="tab" href="#tab2">Máy ảnh</a></li>
                            <li><a data-toggle="tab" href="#tab2">Phụ kiện</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /tiêu đề phần -->

            <!-- Tab sản phẩm & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                <?php foreach ($ramProduct as $product) : ?>
                                    <div class="product">
                                        <div class="product-img">
                                            <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                            <div class="product-label">
                                                <?php if ($product['discount'] > 0) : ?>
                                                    <span class="sale">-<?= $product['discount'] ?>%</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">Danh mục</p>
                                            <h3 class="product-name"><a href="#"><?= htmlspecialchars($product['name']) ?></a></h3>
                                            <h4 class="product-price">
                                                $<?= number_format($product['price'], 2) ?>
                                                <?php if ($product['discount'] > 0) : ?>
                                                    <del class="product-old-price">$<?= number_format($product['price'] + $product['discount'], 2) ?></del>
                                                <?php endif; ?>
                                            </h4>
                                            <div class="product-rating">
                                                <!-- Hiện tại chưa có dữ liệu rating, có thể cập nhật thêm nếu có -->
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                            <div class="product-btns">
                                                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i> <span class="tooltipp">Thêm vào danh sách yêu thích</span></button>
                                                <button class="add-to-compare"><i class="fa fa-exchange"></i> <span class="tooltipp">Thêm vào so sánh</span></button>
                                                <button class="quick-view"><i class="fa fa-eye"></i> <span class="tooltipp">Xem nhanh</span></button>
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
                            <div id="slick-nav-2" class="products-slick-nav"></div>

                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Tab sản phẩm & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>