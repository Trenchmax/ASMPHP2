<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');


?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row mt-4">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Chi Tiết Đơn Hàng</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên người mua</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="name" value="<?= htmlspecialchars($orderData['user_name']) ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="phone" value="<?= htmlspecialchars($orderData['phone']) ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="email" value="<?= htmlspecialchars($orderData['email']) ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="address" value="<?= htmlspecialchars($orderData['address']) ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tổng giá đơn hàng</label>
                                    <div class="col-sm-9">
                                        <input disabled type="text" class="form-control" name="price" value="<?= number_format($orderData['total_price'], 0, ',', '.') ?> VND" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Trạng thái</label>
                                    <div class="col-sm-9">
                                        <select id="orderStatus" class="form-control" onchange="updateOrderStatus(<?= $orderData['order_id'] ?>, this.value)">
                                            <option value="0" <?= $orderData['order_status'] == 0 ? 'selected' : '' ?>>Chưa xử lý</option>
                                            <option value="1" <?= $orderData['order_status'] == 1 ? 'selected' : '' ?>>Đã xử lý</option>
                                            <option value="2" <?= $orderData['order_status'] == 2 ? 'selected' : '' ?>>Đang giao</option>
                                            <option value="3" <?= $orderData['order_status'] == 3 ? 'selected' : '' ?>>Đã hoàn thành</option>
                                            <option value="4" <?= $orderData['order_status'] == 4 ? 'selected' : '' ?>>Đã hủy</option>
                                        </select>
                                    </div>
                                </div>
                            </div>  

                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($products)): ?>
                                        <?php foreach ($products as $index => $product): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= htmlspecialchars($product['product_name']) ?></td>
                                                <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                                                <td><?= $product['quantity'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">Không có sản phẩm nào trong đơn hàng này.</td>
                                        </tr>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-end">
                            <a href="/admin/orders" class="btn btn-primary">Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateOrderStatus(orderId, newStatus) {
        if (!confirm("Bạn có chắc muốn cập nhật trạng thái đơn hàng?")) return;

        fetch("/admin/orders/updateStatus", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    order_id: orderId,
                    status: newStatus
                })
            })
            .then(response => response.json())  
            .then(data => {
                alert(data.message);
                if (data.status === "success") location.reload();
            })
            .catch(error => console.error("Lỗi:", error));
    }
</script>

<?php $this->stop(); ?>