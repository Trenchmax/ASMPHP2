<?php $this->layout('Client/Components/Layout' ); ?>

<?php $this->start('main_content');


?>
<!-- Insert nội dung vào đây -->

<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Thanh toán</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Thanh toán</li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->

<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <form action="/checkout/process" method="POST">
                <div class="col-md-7">
                    <!-- Chi tiết thanh toán -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Địa chỉ thanh toán</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="first_name" placeholder="Họ"
                                value="<?= isset($_SESSION['user']['firstname']) ? htmlspecialchars($_SESSION['user']['firstname']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="last_name" placeholder="Tên"
                                value="<?= isset($_SESSION['user']['lastname']) ? htmlspecialchars($_SESSION['user']['lastname']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="email" placeholder="Email"
                                value="<?= isset($_SESSION['user']['email']) ? htmlspecialchars($_SESSION['user']['email']) : '' ?>">
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" name="phone" placeholder="Số điện thoại"
                                value="<?= isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : '' ?>">
                        </div>
                    </div>

                    <!-- Địa chỉ giao hàng -->
                    <div class="shiping-details">
                        <div class="section-title">
                            <h3 class="title">Địa chỉ giao hàng</h3>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="shiping-address" name="use_different_address" value="1">
                            <label for="shiping-address">
                                <span></span>
                                Gửi đến địa chỉ khác?
                            </label>
                            <div class="caption">
                                <?php if (!empty($results)) : ?>
                                    <?php foreach ($results as $index => $address) : ?>
                                        <div class="input-checkbox">
                                            <input type="radio" id="address-<?php echo $index; ?>" name="shipping_address" value="<?php echo $address['id']; ?>">
                                            <label for="address-<?php echo $index; ?>">
                                                <span></span>
                                                <?php echo $address['address'] . ', ' . $address['ward_name'] . ', ' . $address['district_name'] . ', ' . $address['province_name']; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <p>Không có địa chỉ nào.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chi tiết đơn hàng -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Đơn hàng của bạn</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>SẢN PHẨM</strong></div>
                            <div><strong>TỔNG CỘNG</strong></div>
                        </div>
                        <div class="order-products">
                            <?php
                            $totalPrice = 0;
                            if (!empty($data)) :
                                foreach ($data as $item) :
                                    $subtotal = $item['product_price'] * $item['quantity'];
                                    $totalPrice += $subtotal;
                            ?>
                                    <div class="order-col">
                                        <div><?= $item['quantity'] ?>x <?= htmlspecialchars($item['product_name']) ?></div>
                                        <div>$<?= number_format($subtotal, 2) ?></div>
                                    </div>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <p>Giỏ hàng trống!</p>
                            <?php endif; ?>
                        </div>
                        <div class="order-col">
                            <div>Vận chuyển</div>
                            <div><strong>MIỄN PHÍ</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TỔNG CỘNG</strong></div>
                            <div><strong class="order-total">$<?= number_format($totalPrice, 2) ?></strong></div>
                        </div>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-1" value="bank_transfer" checked>
                            <label for="payment-1">
                                <span></span>
                                Chuyển khoản ngân hàng trực tiếp
                            </label>
                        </div>
                    </div>

                    <!-- Nút đặt hàng -->
                    <input type="hidden" name="total_price" value="<?= $totalPrice ?>">
                    <button type="submit" class="primary-btn order-submit">Đặt hàng</button>
                </div>
            </form>

            <!-- /Chi tiết đơn hàng -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>

<?php $this->stop() ?>