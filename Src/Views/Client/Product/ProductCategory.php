<?php $this->layout('Client/Components/Layout' ); ?>


<?php $this->start('main_content');

?>
<!-- Insert nội dung vào đây -->


<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- ASIDE -->
            <div id="aside" class="col-md-3">
                <div class="aside">
                    <h3 class="aside-title">Categories</h3>
                    <div class="category-filter">
                        <?php
                        // Mảng danh mục từ database


                        foreach ($categories as $category):
                        ?>
                            <a href="/productCategory/<?= $category['id'] ?>" class="category-link">
                                <?= htmlspecialchars($category['name']) ?>
                                <small>(<?= $category['id'] ?>)</small>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- aside Widget -->
                <div class="aside">
                    <h3 class="aside-title">Sản phẩm bán chạy</h3>

                    <?php foreach ($ramProduct as $product): ?>
                        <div class="product-widget">
                            <div class="product-img">
                                <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= $product['thumbnail'] ? explode(',', $product['thumbnail'])[0] : $product['image'] ?>"
                                    alt="<?= htmlspecialchars($product['name']) ?>">
                            </div>
                            <div class="product-body">
                                <p class="product-category">Danh mục</p>
                                <h3 class="product-name">
                                    <a href="/product/detail/<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></a>
                                </h3>
                                <h4 class="product-price">
                                    $<?= number_format($product['price'], 2) ?>
                                    <?php if ($product['discount'] > 0): ?>
                                        <del class="product-old-price">$<?= number_format($product['price'] + $product['discount'], 2) ?></del>
                                    <?php endif; ?>
                                </h4>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- /aside Widget -->
            </div>

            <!-- CSS để làm đẹp -->



            <!-- /ASIDE -->

            <!-- CỬA HÀNG -->
            <div id="store" class="col-md-9">
                <!-- bộ lọc trên cửa hàng -->
                <div class="store-filter clearfix">
                    <div class="store-sort">
                        <label>
                            Sắp xếp theo:
                            <select class="input-select">
                                <option value="0">Phổ biến</option>
                                <option value="1">Vị trí</option>
                            </select>
                        </label>

                        <label>
                            Hiển thị:
                            <select class="input-select">
                                <option value="0">20</option>
                                <option value="1">50</option>
                            </select>
                        </label>
                    </div>
                    <ul class="store-grid">
                        <li class="active"><i class="fa fa-th"></i></li>
                        <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                    </ul>
                </div>
                <!-- /bộ lọc trên cửa hàng -->

                <!-- sản phẩm cửa hàng -->
                <div class="row">
                    <?php if (!empty($products)) : ?>
                        <?php foreach ($products as $product) : ?>
                            <!-- sản phẩm -->
                            <div class="col-md-4 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        <?php
                                        $price = isset($product['price']) ? (float)$product['price'] : 0;


                                        ?>
                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">Danh mục <?= htmlspecialchars($product['category_id'] ?? 'N/A') ?></p>
                                        <h3 class="product-name">
                                            <a href="/product/detail/<?= htmlspecialchars($product['id']) ?>"><?= htmlspecialchars($product['name']) ?></a>
                                        </h3>
                                        <h4 class="product-price">
                                            $<?= number_format($product['price'], 2) ?>
                                            <?php if ($product['discount'] > 0): ?>
                                                <del class="product-old-price">$<?= number_format($product['price'] + $product['discount'], 2) ?></del>
                                            <?php endif; ?>
                                        </h4>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Không có sản phẩm nào.</p>
                    <?php endif; ?>
                </div>
                <!-- /sản phẩm cửa hàng -->

                <!-- bộ lọc cuối cửa hàng -->
                <div class="store-filter clearfix">
                    <span class="store-qty">Hiển thị 20-100 sản phẩm</span>
                    <ul class="store-pagination">
                        <li class="active">1</li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </div>
                <!-- /bộ lọc cuối cửa hàng -->
            </div>
            <!-- /CỬA HÀNG -->
        </div>
        <!-- /dòng -->
    </div>
    <!-- /container -->
</div>


<?php $this->stop() ?>