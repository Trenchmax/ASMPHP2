<?php $this->layout('Client/Components/Layout'); ?>


<?php $this->start('main_content') ?>
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


				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Sản phẩm bán chạy</h3>
					<div class="product-widget">
						<div class="product-img">
							<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product01.png" alt="">
						</div>
						<div class="product-body">
							<p class="product-category">Danh mục</p>
							<h3 class="product-name"><a href="/productDetail">Tên sản phẩm ở đây</a></h3>
							<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
						</div>
					</div>

					<div class="product-widget">
						<div class="product-img">
							<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product02.png" alt="">
						</div>
						<div class="product-body">
							<p class="product-category">Danh mục</p>
							<h3 class="product-name"><a href="/productDetail">Tên sản phẩm ở đây</a></h3>
							<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
						</div>
					</div>

					<div class="product-widget">
						<div class="product-img">
							<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product03.png" alt="">
						</div>
						<div class="product-body">
							<p class="product-category">Danh mục</p>
							<h3 class="product-name"><a href="#">Tên sản phẩm ở đây</a></h3>
							<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
						</div>
					</div>
				</div>
				<!-- /aside Widget -->
			</div>
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
					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product01.png" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
									<span class="new">MỚI</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Danh mục</p>
								<h3 class="product-name"><a href="/productDetail">Tên sản phẩm ở đây</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
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

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product02.png" alt="">
								<div class="product-label">
									<span class="new">MỚI</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Danh mục</p>
								<h3 class="product-name"><a href="#">Tên sản phẩm ở đây</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
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

					<div class="clearfix visible-sm visible-xs"></div>

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product03.png" alt="">
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

					<div class="clearfix visible-lg visible-md"></div>

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product04.png" alt="">
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

					<div class="clearfix visible-sm visible-xs"></div>

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product05.png" alt="">
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

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product06.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Danh mục</p>
								<h3 class="product-name"><a href="#">Tên sản phẩm ở đây</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
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

					<div class="clearfix visible-lg visible-md visible-sm visible-xs"></div>

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product07.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Danh mục</p>
								<h3 class="product-name"><a href="#">Tên sản phẩm ở đây</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
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

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product08.png" alt="">
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


					<div class="clearfix visible-sm visible-xs"></div>

					<!-- sản phẩm -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/img/product09.png" alt="">
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