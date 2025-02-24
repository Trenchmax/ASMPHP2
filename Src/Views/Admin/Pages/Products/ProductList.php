<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Sản phẩm</h4>

            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $product): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['id']); ?></td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td>
                                    <?php if ($product['image']): ?>
                                        <img src="/public/Assets/uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="Hình ảnh sản phẩm" width="100%">
                                    <?php else: ?>
                                        <img src="/public/uploads/default.jpg" alt="Hình ảnh sản phẩm" width="100%">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $product['status'] == '1' ? 'Hoạt động' : 'Không hoạt động'; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/admin/product/edit/<?= $product['id'] ?>">
                                                <p>Sửa</p>
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </a>
                                            <a class="dropdown-item" href="/admin/product/delete/<?= $product['id'] ?>" onclick="return confirm('Bạn chắc chứ?')">
                                                <p>Xóa</p>
                                                <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <p>Chi tiết</p>
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <p>Thêm thông số kỹ thuật</p>
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </a>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($data)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-danger">Không có dữ liệu</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
$this->stop();
?>