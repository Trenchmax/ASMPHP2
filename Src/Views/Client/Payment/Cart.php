<?php $this->layout('Client/Components/Layout' ); ?>

<?php $this->start('main_content'); ?>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="/">Home</a></span> / <span>Shopping Cart</span></p>
            </div>
        </div>
    </div>
</div>

<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="product-name d-flex">
                    <div class="one-forth text-left px-4">
                        <span>Product Details</span>
                    </div>

                    <div class="one-eight text-center">
                        <span>Price</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Quantity</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Total</span>
                    </div>
                    <div class="one-eight text-center px-4">
                        <span>Remove</span>
                    </div>
                </div>

                <?php if (!empty($data)) : ?>
                    <?php foreach ($data as $item) : ?>
                        <div class="product-cart d-flex">
                            <div class="one-forth">
                                <div class="product-img">
                                    <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= htmlspecialchars($item['product_images']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" width="80" height="80" style="object-fit: cover;">
                                </div>

                                <div class="display-tc">
                                    <h3><?= htmlspecialchars($item['product_name']) ?></h3>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price">$<?= number_format($item['discounted_price'], 2) ?></span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <input type="number" class="form-control input-number text-center update-cart"
                                        data-id="<?= $item['cart_id'] ?>" value="<?= $item['quantity'] ?>" min="1" max="100">
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <span class="price">$<?= number_format($item['total_price'], 2) ?></span>
                                </div>
                            </div>
                            <div class="one-eight text-center">
                                <div class="display-tc">
                                    <form action="/cart/delete" method="POST">
                                        <input type="hidden" name="id" value="<?= $item['cart_id'] ?>">
                                        <button type="submit" class="btn btn-danger">X</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="text-center">Giỏ hàng trống. <a href="/shop">Tiếp tục mua sắm</a></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="total-wrap">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="#">
                                <div class="row form-group">
                                    <div class="col-sm-9">
                                        <input type="text" name="coupon" class="form-control input-number" placeholder="Your Coupon Number...">
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="/checkout" class="btn btn-success">Thanh toán</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div class="total">
                                <div class="sub">
                                    <p><span>Subtotal:</span> <span>$<?= number_format(array_sum(array_column($data, 'total_price')), 2) ?></span></p>
                                    <p><span>Delivery:</span> <span>$0.00</span></p>
                                    <p><span>Discount:</span> <span>$0.00</span></p>
                                </div>
                                <div class="grand-total">
                                    <p><span><strong>Total:</strong></span> <span>$<?= number_format(array_sum(array_column($data, 'total_price')), 2) ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="/cart/delete-all" class="text-right" method="POST">
                        <button type="submit" class="btn btn-danger">Xóa tất cả</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Cập nhật số lượng sản phẩm
        document.querySelectorAll('.update-cart').forEach(function(input) {
            input.addEventListener('change', function() {
                let id = this.dataset.id;
                let quantity = this.value;
                fetch('/cart/update/' + id, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'quantity=' + quantity
                    }).then(response => response.json())
                    .then(data => location.reload());
            });
        });

        // Xóa sản phẩm khỏi giỏ hàng
        document.querySelectorAll('.remove-cart').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                let id = this.dataset.id;
                fetch('/cart/delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + id
                }).then(() => location.reload());
            });
        });

        // Xóa toàn bộ giỏ hàng
        document.querySelector('.delete-all-cart').addEventListener('click', function(e) {
            e.preventDefault();
            fetch('/cart/delete-all', {
                method: 'POST'
            }).then(() => location.reload());
        });
    });
</script>

<?php $this->stop(); ?>