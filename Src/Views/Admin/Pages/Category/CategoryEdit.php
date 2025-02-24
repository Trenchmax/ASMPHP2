<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa Loại sản phẩm</h4>

                    <!-- Hiển thị lỗi chung -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="/admin/category/update/<?= htmlspecialchars($category['id']) ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="POST">
                        
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" placeholder="id" name="id" 
                                   value="<?= htmlspecialchars($category['id']) ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Tên Loại sản phẩm</label>
                            <input type="text" class="form-control form-control-lg <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" 
                                   name="name" placeholder="Tên loại sản phẩm" 
                                   value="<?= htmlspecialchars($oldData['name'] ?? $category['name']) ?>" 
                                   aria-label="Category Name">
                            <?php if (!empty($errors['name'])): ?>
                                <div class="invalid-feedback"><?= htmlspecialchars($errors['name']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Hình ảnh Loại sản phẩm</label>
                            <div class="mb-2">
                                <img src="/public/Assets/uploads/<?= htmlspecialchars($category['image']) ?>" 
                                     alt="Current Image" style="max-width: 150px;">
                            </div>
                            <input type="file" class="form-control form-control-lg <?= !empty($errors['image']) ? 'is-invalid' : '' ?>" 
                                   name="image" aria-label="Category Image">
                            <?php if (!empty($errors['image'])): ?>
                                <div class="invalid-feedback"><?= htmlspecialchars($errors['image']) ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="form-check form-check-success">
                                <select class="form-control form-control-sm col-lg-2" name="status">
                                    <option value="1" <?= (isset($oldData['status']) ? $oldData['status'] : $category['status']) == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                    <option value="2" <?= (isset($oldData['status']) ? $oldData['status'] : $category['status']) == 2 ? 'selected' : '' ?>>Không hoạt động</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->stop();
?>
