<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Loại sản phẩm</h4>

            <!-- Hiển thị thông báo nếu có lỗi -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="table-responsive pt-3">
                <?php if (!empty($categories)): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Loại sản phẩm</th>
                                <th>Ảnh Loại sản phẩm</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?= htmlspecialchars($category['id']) ?></td>
                                    <td><?= htmlspecialchars($category['name']) ?></td>
                                    <td>
                                        <?php if (!empty($category['image'])): ?>
                                            <img src="/public/Assets/uploads/<?= htmlspecialchars($category['image']); ?>"
                                                alt="Ảnh loại sản phẩm" style="max-width: 100px;">
                                        <?php else: ?>
                                            <span class="text-muted">Không có ảnh</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <span class="badge <?= $category['status'] == '1' ? 'badge-success' : 'badge-danger' ?>">
                                            <?= $category['status'] == '1' ? 'Hoạt động' : 'Không hoạt động' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="/admin/category/edit/<?= $category['id'] ?>"
                                                class="btn btn-success btn-sm btn-icon-text mr-2">
                                                Sửa <i class="typcn typcn-edit btn-icon-append"></i>
                                            </a>
                                            <a href="/admin/category/delete/<?= $category['id'] ?>"
                                                onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                                                class="btn btn-danger btn-sm btn-icon-text">
                                                Xóa <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <h4 class="text-center text-danger">Không có dữ liệu</h4>
                    <div class="text-center">
                        <a href="/admin/category/create" class="btn btn-primary">Thêm phân loại mới</a>
                    </div>
                <?php endif; ?>
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