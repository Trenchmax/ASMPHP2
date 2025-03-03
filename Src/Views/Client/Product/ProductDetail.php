<?php $this->layout('Client/Components/Layout'); ?>


<?php $this->start('main_content');

?>
<!-- Insert nội dung vào đây -->



<!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Product main img -->
            <div class="col-md-5 col-md-push-2">
                <div id="product-main-img">
                    <?php
                    $images = $product['thumbnail'] ? explode(',', $product['thumbnail']) : [$product['image']];
                    foreach ($images as $img): ?>
                        <div class="product-preview">
                            <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-2 col-md-pull-5">
                <div id="product-imgs">
                    <?php foreach ($images as $img): ?>
                        <div class="product-preview">
                            <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-md-5">
                <div class="product-details">
                    <h2 class="product-name"><?= htmlspecialchars($product['name']) ?></h2>
                    <div>
                        <div class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a class="review-link" href="#">10 Đánh giá | Thêm đánh giá của bạn</a>
                    </div>
                    <div>
                        <h3 class="product-price">
                            $<?= number_format($product['price'], 2) ?>
                            <?php if ($product['discount'] > 0): ?>
                                <del class="product-old-price"><?= number_format($product['price'] + $product['discount'], 2) ?> VNĐ</del>
                            <?php endif; ?>
                        </h3>
                        <span class="product-available"><?= $product['total_quantity'] > 0 ? "Còn hàng" : "Hết hàng" ?></span>
                    </div>
                    <!-- <p><?= htmlspecialchars($product['description']) ?></p> -->

                    <div class="product-options">
                        <label>
                            Kích cỡ
                            <select class="input-select">
                                <option value="0">X</option>
                            </select>
                        </label>
                        <label>
                            Màu sắc
                            <select class="input-select">
                                <option value="0">Đỏ</option>
                            </select>
                        </label>
                    </div>

                    <div class="add-to-cart">
                        <div class="qty-label">
                            Số lượng
                            <div class="input-number">
                                <input type="number" min="1" max="<?= $product['total_quantity'] ?>" value="1">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
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

                    <ul class="product-btns">
                        <li><a href="#"><i class="fa fa-heart-o"></i> Thêm vào danh sách yêu thích</a></li>
                        <li><a href="#"><i class="fa fa-exchange"></i> Thêm vào so sánh</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Danh mục:</li>
                        <li><a href="#">Tai nghe</a></li>
                        <li><a href="#">Phụ kiện</a></li>
                    </ul>

                    <ul class="product-links">
                        <li>Chia sẻ:</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                    </ul>

                </div>
            </div>

            <!-- /Chi tiết sản phẩm -->

            <!-- Tab sản phẩm -->
            <div class="col-md-12">
                <div id="product-tab">
                    <!-- thanh điều hướng tab sản phẩm -->
                    <ul class="tab-nav">
                        <li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
                        <li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
                        <li><a data-toggle="tab" href="#tab3">Đánh giá (3)</a></li>
                    </ul>
                    <!-- /thanh điều hướng tab sản phẩm -->

                    <!-- nội dung tab sản phẩm -->
                    <div class="tab-content">
                        <!-- tab1 -->
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><?php echo html_entity_decode($product['description'] ?? ''); ?></p>

                                </div>
                            </div>
                        </div>

                        <!-- /tab1 -->

                        <!-- tab2 -->
                        <div id="tab2" class="tab-pane fade in">
                            <div class="row">
                                <div class="col-md-12">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- /tab2 -->


                        <!-- tab3  -->
                        <div id="tab3" class="tab-pane fade in">
                            <div class="row">
                                <!-- Rating -->
                                <div class="col-md-3">
                                    <div id="rating">
                                        <div class="rating-avg">
                                            <span>4.5</span>
                                            <div class="rating-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>
                                        </div>
                                        <ul class="rating">
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 80%;"></div>
                                                </div>
                                                <span class="sum">3</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div style="width: 60%;"></div>
                                                </div>
                                                <span class="sum">2</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                            <li>
                                                <div class="rating-stars">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                    <i class="fa fa-star-o"></i>
                                                </div>
                                                <div class="rating-progress">
                                                    <div></div>
                                                </div>
                                                <span class="sum">0</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Rating -->

                                <!-- Reviews -->
                                <div class="col-md-6">
                                    <div id="reviews">
                                        <ul class="reviews">
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 THÁNG 12 2018, 8:00 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 THÁNG 12 2018, 8:00 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review-heading">
                                                    <h5 class="name">John</h5>
                                                    <p class="date">27 THÁNG 12 2018, 8:00 PM</p>
                                                    <div class="review-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o empty"></i>
                                                    </div>
                                                </div>
                                                <div class="review-body">
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <ul class="reviews-pagination">
                                            <li class="active">1</li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Đánh giá -->

                                <!-- Form Đánh giá -->
                                <div class="col-md-3">
                                    <div id="review-form">
                                        <form class="review-form">
                                            <input class="input" type="text" placeholder="Tên của bạn">
                                            <input class="input" type="email" placeholder="Email của bạn">
                                            <textarea class="input" placeholder="Đánh giá của bạn"></textarea>
                                            <div class="input-rating">
                                                <span>Đánh giá của bạn: </span>
                                                <div class="stars">
                                                    <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
                                                    <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
                                                    <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
                                                    <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
                                                    <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
                                                </div>
                                            </div>
                                            <button class="primary-btn">Gửi</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- /Form Đánh giá -->

                                <!-- Sản phẩm liên quan -->
                                <div class="section">
                                    <!-- container -->
                                    <div class="container">
                                        <!-- row -->
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="section-title text-center">
                                                    <h3 class="title">Sản phẩm liên quan</h3>
                                                </div>
                                            </div>

                                            <!-- sản phẩm -->
                                            <div class="col-md-3 col-xs-6">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product01.png" alt="">
                                                        <div class="product-label">
                                                            <span class="sale">-30%</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Danh mục</p>
                                                        <h3 class="product-name"><a href="#">Tên sản phẩm ở đây</a></h3>
                                                        <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                                                        <div class="product-rating">
                                                        </div>
                                                        <div class="product-btns">
                                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Thêm vào danh sách yêu thích</span></button>
                                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">Thêm vào so sánh</span></button>
                                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem nhanh</span></button>
                                                        </div>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /sản phẩm -->


                                            <!-- product -->
                                            <div class="col-md-3 col-xs-6">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product02.png" alt="">
                                                        <div class="product-label">
                                                            <span class="new">NEW</span>
                                                        </div>
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                        <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                                                        <div class="product-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                        <div class="product-btns">
                                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                        </div>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /product -->

                                            <div class="clearfix visible-sm visible-xs"></div>

                                            <!-- product -->
                                            <div class="col-md-3 col-xs-6">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product03.png" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                        <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                                                        <div class="product-rating">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                        <div class="product-btns">
                                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                        </div>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /product -->

                                            <!-- product -->
                                            <div class="col-md-3 col-xs-6">
                                                <div class="product">
                                                    <div class="product-img">
                                                        <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product04.png" alt="">
                                                    </div>
                                                    <div class="product-body">
                                                        <p class="product-category">Category</p>
                                                        <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                        <h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
                                                        <div class="product-rating">
                                                        </div>
                                                        <div class="product-btns">
                                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                                            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                                        </div>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /product -->

                                        </div>
                                        <!-- /row -->
                                    </div>
                                    <!-- /container -->
                                </div>

                                <?php $this->stop() ?>