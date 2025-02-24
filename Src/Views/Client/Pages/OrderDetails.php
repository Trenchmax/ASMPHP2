<?php $this->layout('Client/Components/Layout' ); ?>

<?php $this->start('main_content') ?>

<section class="account">
    <div class="container-fluid">
        <div class="row g-0">
            <?php $this->Insert('Client/Components/sidebar'); ?>

            <div class="col-lg-9">
                <div class="order-info">
                    <div class="order-info-add">
                        <div class="order-info-add-title">
                            <p>Thông tin Đơn Hàng</p>
                        </div>

                        <?php if (empty($orders)): ?>
                            <p>Bạn chưa có đơn hàng nào.</p>
                        <?php else: ?>
                            <?php foreach ($orders as $order): ?>
                                <ul class="order-details">
                                    <li><strong>Đơn hàng #<?= $order['id'] ?></strong></li>
                                    <li>Email: <?= htmlspecialchars($_SESSION['user']['email']) ?></li>
                                    <li>Thành phố: <?= htmlspecialchars($order['city'] ?? 'Không có') ?></li>
                                    <li>Quận/Huyện: <?= htmlspecialchars($order['district'] ?? 'Không có') ?></li>
                                    <li>Phường/Xã: <?= htmlspecialchars($order['ward'] ?? 'Không có') ?></li>
                                    <li>Địa chỉ: <?= htmlspecialchars($order['address']) ?></li>
                                    <li>Số điện thoại: <?= htmlspecialchars($order['phone']) ?></li>
                                    <li>Phương thức giao hàng: <?= htmlspecialchars($order['delivery_method'] ?? 'Không có') ?></li>
                                    <li>Phương thức thanh toán: <?= htmlspecialchars($order['payment_method'] ?? 'Không có') ?></li>
                                    <li>Tổng giá: <?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</li>
                                    <li>Trạng thái: <?= htmlspecialchars($order['order_status']) ?></li>
                                    <li>Ngày đặt hàng: <?= date('d-m-Y', strtotime($order['created_at'])) ?></li>
                                    <li>
                                        <strong>Sản phẩm:</strong>
                                        <ul>
                                            <?php 
                                            $productNames = explode(',', $order['product_name']);
                                            $quantities = explode(',', $order['quantity']);
                                            foreach ($productNames as $index => $productName) {
                                                echo "<li>" . htmlspecialchars($productName) . " (x" . $quantities[$index] . ")</li>";
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                </ul>
                                <hr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->stop() ?>

<?php $this->push('scripts'); ?>
<script src="<?= $_ENV['APP_URL'] ?>/public/Assets/Client/js/AuthValidation.js"></script>
<?php $this->end(); ?>
