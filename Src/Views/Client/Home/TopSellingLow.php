<di class="section">
  <!-- container -->
  <div class="container">
    <!-- row -->
    <div class="row">
      <div class="col-md-4 col-xs-6">
        <div class="section-title">
          <h4 class="title">Sản phẩm bán chạy</h4>
          <div class="section-nav">
            <div id="slick-nav-3" class="products-slick-nav"></div>
          </div>
        </div>

        <div class="products-widget-slick" data-nav="#slick-nav-3">
          <div>
            <?php foreach ($ramProduct as $product): ?>
              <div class="product-widget">
                <div class="product-img">
                  <img src="<?= $_ENV['APP_URL'] . '/public/Assets/uploads/' . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="product-body">
                  <p class="product-category">Danh mục</p> <!-- Nếu có category_id, có thể lấy từ DB -->
                  <h3 class="product-name">
                    <a href="product_detail.php?id=<?= $product['id'] ?>">
                      <?= htmlspecialchars($product['name']) ?>
                    </a>
                  </h3>
                  <h4 class="product-price">
                    $<?= number_format($product['price'], 2) ?>
                    <del class="product-old-price">$<?= number_format($product['price'] + $product['discount'], 2) ?></del>
                  </h4>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="col-md-4 col-xs-6">
        <div class="section-title">
          <h4 class="title">Sản phẩm bán chạy</h4>
          <div class="section-nav">
            <div id="slick-nav-3" class="products-slick-nav"></div>
          </div>
        </div>

        <div class="products-widget-slick" data-nav="#slick-nav-3">
          <div>
            <?php foreach ($ramProduct as $product): ?>
              <div class="product-widget">
                <div class="product-img">
                  <img src="<?= $_ENV['APP_URL'] . '/public/Assets/uploads/' . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="product-body">
                  <p class="product-category">Danh mục</p> <!-- Nếu có category_id, có thể lấy từ DB -->
                  <h3 class="product-name">
                    <a href="product_detail.php?id=<?= $product['id'] ?>">
                      <?= htmlspecialchars($product['name']) ?>
                    </a>
                  </h3>
                  <h4 class="product-price">
                    $<?= number_format($product['price'], 2) ?>
                    <del class="product-old-price">$<?= number_format($product['price'] + $product['discount'], 2) ?></del>
                  </h4>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="clearfix visible-sm visible-xs"></div>

      <div class="col-md-4 col-xs-6">
        <div class="section-title">
          <h4 class="title">Sản phẩm bán chạy</h4>
          <div class="section-nav">
            <div id="slick-nav-3" class="products-slick-nav"></div>
          </div>
        </div>

        <div class="products-widget-slick" data-nav="#slick-nav-3">
          <div>
            <?php foreach ($ramProduct as $product): ?>
              <div class="product-widget">
                <div class="product-img">
                  <img src="<?= $_ENV['APP_URL'] . '/public/Assets/uploads/' . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <div class="product-body">
                  <p class="product-category">Danh mục</p>  
                  <h3 class="product-name">
                    <a href="product_detail.php?id=<?= $product['id'] ?>">
                      <?= htmlspecialchars($product['name']) ?>
                    </a>
                  </h3>
                  <h4 class="product-price">
                    $<?= number_format($product['price'], 2) ?>
                    <del class="product-old-price">$<?= number_format($product['price'] + $product['discount'], 2) ?></del>
                  </h4>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
    <!-- /row -->
  </div>
  <!-- /container -->
</di>