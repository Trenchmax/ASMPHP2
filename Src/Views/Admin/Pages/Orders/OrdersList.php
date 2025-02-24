<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive pt-3">
                <table class="table table-striped project-orders-table">
                    <thead>
                        <tr>
                            <th class="ml-5">ID</th>
                            <th>Tên người mua</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tổng giá sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><?= htmlspecialchars($order['id']) ?></td>
                                <td><?= htmlspecialchars($order['user_name']) ?></td>
                                <td><?= htmlspecialchars($order['user_phone']) ?></td>
                                <td><?= htmlspecialchars($order['address']) ?></td>
                                <td><?= number_format($order['total_price'], 0, ',', '.') ?> VND</td>
                                <td>
                                    <?= $order['status'] == 1 ? 'Đã xử lý' : 'Chưa xử lý' ?>
                                </td>
                                <td>
                                    <a href="/admin/orderDetails/<?= htmlspecialchars($order['id']) ?>" class="btn btn-info btn-sm">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <strong>Sản phẩm:</strong>
                                    <ul>
                                        <?php foreach ($order['products'] as $product): ?>
                                            <li style="list-style-type: none;">
                                                <img src="<?= $_ENV['APP_URL'] ?>/public/Assets/uploads/<?= $product['image_name'] ?>" alt="<?= $product['image_name'] ?>" width="50">
                                                <?= htmlspecialchars($product['product_name']) ?> (x<?= $product['quantity'] ?>)
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<?php
$this->stop();
?>