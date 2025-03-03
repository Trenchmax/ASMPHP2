<?php $this->layout('Client/Components/Layout', ['categories' => $categories]); ?>

<?php $this->start('main_content') ?>

<div class="d-flex flex-column justify-content-center align-items-center text-center" style="height: 100vh;">
    <h1 class="display-4 text-danger">404 - Trang không tồn tại</h1>
    <p class="lead">Trang bạn đang tìm kiếm không khả dụng hoặc đã bị xóa.</p>
    <a href="/" class="btn btn-primary mt-3"> Quay về trang chủ</a>
</div>

<?php $this->stop() ?>
