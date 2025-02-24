<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sửa Thương hiệu</h4>
            
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success" id="alert-success">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
                <div class="alert alert-danger" id="alert-error">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?= $error; ?></li>
                        <?php endforeach; unset($_SESSION['errors']); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/admin/brand/update/<?= $brand['id'] ?>" method="post" enctype="multipart/form-data">
                
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" class="form-control" id="id" placeholder="id" name="id" value="<?= $brand['id'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Tên Thương hiệu</label>
                    <input type="text" class="form-control form-control-lg" name="name"
                        placeholder="Tên thương hiệu" value="<?= htmlspecialchars($brand['name']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Hình Ảnh Thương Hiệu</label>
                    <div class="mb-2">
                        <?php if (!empty($brand['image'])): ?>
                            <img src="/Assets/uploads/brands/<?= htmlspecialchars($brand['image'])  ?>" 
                                 alt="Current Image" style="max-width: 150px;">
                        <?php endif; ?>
                    </div>
                    <input type="file" class="form-control form-control-lg" name="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Mô tả Thương hiệu</label>
                    <textarea class="form-control form-control-lg" name="description"
                        placeholder="Mô tả"> <?= htmlspecialchars($brand['description']) ?></textarea>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control form-control-sm col-lg-2" name="status">
                        <option value="1" <?= $brand['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="0" <?= $brand['status'] == 0 ? 'selected' : '' ?>>Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Sửa</button>
            </form>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        let successAlert = document.getElementById("alert-success");
        let errorAlert = document.getElementById("alert-error");
        if (successAlert) successAlert.style.display = "none";
        if (errorAlert) errorAlert.style.display = "none";
    }, 3000);
</script>

<?php
$this->stop();
?>