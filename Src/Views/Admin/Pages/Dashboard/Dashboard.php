<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>

<div class="row">
    <div class="col-xl-6 grid-margin stretch-card flex-column">
        <h5 class="mb-2 text-titlecase mb-4">Thống kê trạng thái</h5>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-0 text-muted">Người dùng</p>
                            <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#666666">
                                <path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/>
                            </svg>
                        </div>
                        <div class="text-center">
                            <h2 class="mb-"><?= $data['total_users'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-2 text-muted">Phân loại sản phẩm</p>
                        </div>
                        <div class="text-center">
                            <h2 class="mb-"><?= count($data['total_product_category']) ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-2 text-muted">Đơn hàng</p>
                        </div>
                        <div class="text-center">
                            <h2 class="mb-"><?= $data['total_orders'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="mb-2 text-muted">Số bình luận</p>
                        </div>
                        <div class="text-center">
                            <h2 class="mb-"><?= $data['total_comments'] ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-2 text-md-center text-lg-left">Top 5 sản phẩm có đánh giá nhiều nhất</h5>
                <canvas id="comment_by_product"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    function userChart() {
        let php_data = <?= json_encode($data['total_product_category']) ?>;
        let labels = [];
        let data = [];

        for (let i of php_data) {
            labels.push(i.name);
            data.push(i.products_count);
        }

        const ctx = document.getElementById('products');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Loại sản phẩm',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function commentByProduct() {
        const ctx = document.getElementById('comment_by_product');
        var php_data = <?= json_encode($data['comment_by_product']) ?>;
        var labels = [];
        var data = [];
        for (let i of php_data) {
            labels.push(i.name);
            data.push(i.count);
        }
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Số lượng bình luận',
                    data: data,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
    commentByProduct();
    userChart();
</script>

<?php
$this->stop();
?>
