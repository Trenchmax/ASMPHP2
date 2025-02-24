<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>

<div class="col-md-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Thêm Thương hiệu</h4>
            
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

            <form action="/admin/brand/create" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                
                <div class="form-group">
                    <label>Tên Thương hiệu <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Nhập tên thương hiệu" required>
                    <small id="nameError" class="text-danger d-none">Vui lòng nhập tên thương hiệu!</small>
                </div>

                <div class="form-group">
                    <label>Hình Ảnh Thương Hiệu</label>
                    <input type="file" class="form-control form-control-lg" name="image" id="image" accept="image/*">
                    <small id="imageError" class="text-danger d-none">Vui lòng chọn một file ảnh hợp lệ!</small>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <input type="text" class="form-control form-control-lg" name="description" id="description">
                    <small id="descError" class="text-danger d-none">Mô tả không được vượt quá 500 ký tự!</small>
                </div>

                <div class="form-group">
                    <label>Trạng thái</label>
                    <select class="form-control form-control-sm col-lg-2" name="status">
                        <option value="1">Hoạt động</option>
                        <option value="0">Không hoạt động</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Thêm</button>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        let isValid = true;

        let name = document.getElementById("name").value.trim();
        if (name === "") {
            document.getElementById("nameError").classList.remove("d-none");
            isValid = false;
        } else {
            document.getElementById("nameError").classList.add("d-none");
        }

        let description = document.getElementById("description").value.trim();
        if (description.length > 500) {
            document.getElementById("descError").classList.remove("d-none");
            isValid = false;
        } else {
            document.getElementById("descError").classList.add("d-none");
        }

        let image = document.getElementById("image");
        if (image.files.length > 0) {
            let fileType = image.files[0].type;
            if (!["image/jpeg", "image/png", "image/gif"].includes(fileType)) {
                document.getElementById("imageError").classList.remove("d-none");
                isValid = false;
            } else {
                document.getElementById("imageError").classList.add("d-none");
            }
        }

        return isValid;
    }

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