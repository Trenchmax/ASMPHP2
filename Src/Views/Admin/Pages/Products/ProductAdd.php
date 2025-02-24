<?php $this->layout('Admin/Layouts/Layout') ?>

<?php
$this->start('main_content');
?>
<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm sản phẩm</h4>

            <?php if (!empty($_SESSION['errors'])): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($_SESSION['errors'] as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($_SESSION['success']); ?>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form class="forms-sample" action="/admin/product/create" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method" value="POST">

                <div class="form-group">
                    <label for="name">Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="description" rows="4" name="description"><?php echo htmlspecialchars($_POST['description'] ?? ''); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="brand_id">Thương hiệu</label>
                    <select class="form-control" id="brand_id" name="brand_id">
                        <option value="">Chọn thương hiệu</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?php echo htmlspecialchars($brand['id']); ?>" <?php echo (isset($_POST['brand_id']) && $_POST['brand_id'] == $brand['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($brand['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_id">Phân loại sản phẩm</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Chọn loại sản phẩm</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['id']); ?>" <?php echo (isset($_POST['category_id']) && $_POST['category_id'] == $category['id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Giá tiền</label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo htmlspecialchars($_POST['price'] ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="quantity">Số lượng</label>
                    <input type="number" class="form-control" name="total_quantity" id="quantity" placeholder="Quantity" value="<?php echo htmlspecialchars($_POST['total_quantity'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="image">Hình ảnh</label>
                    <input type="file" name="image" class="form-control file-upload-info" placeholder="Upload Image">
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail[]" multiple class="form-control file-upload-info" placeholder="Upload Thumbnail">
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <div class="form-check form-check-success">
                        <select class="form-control form-control-sm col-lg-2" name="status">
                            <option value="1" <?php echo (isset($_POST['status']) && $_POST['status'] == 1) ? 'selected' : ''; ?>>Hoạt động</option>
                            <option value="2" <?php echo (isset($_POST['status']) && $_POST['status'] == 2) ? 'selected' : ''; ?>>Không hoạt động</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2" name="submit">Thêm mới</button>
                <a href="/admin?url=products" class="btn btn-light">Hủy bỏ</a>
            </form>
        </div>
    </div>
</div>

<?php
$this->stop();
?>