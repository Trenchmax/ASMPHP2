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
                    <form action="/admin/category-update/ID" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method" value="POST">
                        <div class="form-group">
                            <label for="name">ID</label>
                            <input type="text" class="form-control" id="id" placeholder="id" name="id" value="ID" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tên Loại sản phẩm</label>
                            <input type="text" class="form-control form-control-lg" name="name" placeholder="Bàn phím.." value="Tên loại sản phẩm" aria-label="Category Name">
                        </div>
                        <div class="form-group">
                            <label>Mô tả Loại sản phẩm</label>
                            <textarea class="form-control form-control-lg" name="description" placeholder="Bàn phím.." aria-label="Category Name">Mô tả loại sản phẩm</textarea>
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <div class="form-check form-check-success">
                                <select class="form-control form-control-sm col-lg-2" name="status">
                                    <option value="1">Hoạt động</option>
                                    <option value="2">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit" style="justify-self: flex-end;">Sửa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

$this->stop();
?>


