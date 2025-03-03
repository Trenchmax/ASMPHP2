<?php $this->layout('Client/Components/Layout'); ?>

<?php $this->start('main_content'); ?>

<!-- Insert nội dung vào đây -->

<div id="breadcrumb" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Thanh toán</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="/">Trang chủ</a></li>
                    <li class="active">Thanh toán</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <form action="/checkout/process" method="POST">
                <div class="col-md-7">
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Địa chỉ thanh toán</h3>
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="first_name" placeholder="Họ"
                                value="<?= htmlspecialchars($_SESSION['user']['firstname'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <input class="input" type="text" name="last_name" placeholder="Tên"
                                value="<?= htmlspecialchars($_SESSION['user']['lastname'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <input class="input" type="email" name="email" placeholder="Email"
                                value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>">
                        </div>
                        <div class="form-group">
                            <input class="input" type="tel" name="phone" placeholder="Số điện thoại"
                                value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>">
                        </div>
                    </div>

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
                                                <?= $address['address'] . ', ' . $address['ward_name'] . ', ' . $address['district_name'] . ', ' . $address['province_name']; ?>
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
                            <div><strong class="order-total"><?= number_format($totalPrice, ) ?>VNĐ</strong></div>
                        </div>
                    </div>

                    <!-- Phương thức thanh toán -->
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-1" value="cod" checked>
                            <label for="payment-1">
                                <span></span>
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-2" value="bank_transfer">
                            <label for="payment-2">
                                <span></span>
                                Chuyển khoản ngân hàng
                            </label>
                        </div>
                        <div class="input-radio">
                            <input type="radio" name="payment_method" id="payment-3" value="vnpay">
                            <label for="payment-3">
                                <span></span>
                                Thanh toán qua VNPay QR
                            </label>
                        </div>
                    </div>

                    <!-- Nút đặt hàng -->
                    <input type="hidden" name="total_price" value="<?= $totalPrice ?>">
                    <button type="submit" class="primary-btn order-submit">Đặt hàng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->stop() ?>
