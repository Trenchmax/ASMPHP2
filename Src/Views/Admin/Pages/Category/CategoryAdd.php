<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>
<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm phân loại</h4>

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

            <form action="/admin/category/create" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label>Tên phân loại</label>
                    <input type="text" class="form-control form-control-lg <?= !empty($errors['name']) ? 'is-invalid' : '' ?>" 
                           placeholder="Bàn phím.." 
                           aria-label="Category Name" 
                           name="name" 
                           value="<?= htmlspecialchars($oldData['name'] ?? '') ?>">
                    <?php if (!empty($errors['name'])): ?>
                        <div class="invalid-feedback"><?= htmlspecialchars($errors['name']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Ảnh phân loại</label>
                    <input type="file" class="form-control form-control-lg <?= !empty($errors['image']) ? 'is-invalid' : '' ?>" 
                           name="image">
                    <?php if (!empty($errors['image'])): ?>
                        <div class="invalid-feedback"><?= htmlspecialchars($errors['image']) ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success">
                        <select class="form-control form-control-sm col-lg-2" name="status">
                            <option value="1" <?= (isset($oldData['status']) && $oldData['status'] == 1) ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="2" <?= (isset($oldData['status']) && $oldData['status'] == 2) ? 'selected' : '' ?>>Không hoạt động</option>
                        </select>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
    </div>
</div>
<?php
$this->stop();
?>
