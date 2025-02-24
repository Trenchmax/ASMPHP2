<?php $this->layout('Admin/Layouts/Layout') ?>

<?php 
$this->start('main_content');
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Bình luận</h4>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nội dung</th>
                            <th>Đánh giá</th>
                            <th>Trạng thái</th>
                            <th>Ngày và giờ</th>
                            <th>ID sản phẩm</th>
                            <th>ID người dùng</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment): ?>
                            <tr>
                                <td><?= htmlspecialchars($comment['id']) ?></td>
                                <td><?= htmlspecialchars($comment['content']) ?></td>
                                <td><?= htmlspecialchars($comment['rating']) ?></td>
                                <td><?= $comment['status'] == 1 ? 'Hoạt động' : 'Không hoạt động' ?></td>
                                <td><?= htmlspecialchars($comment['created_at']) ?></td>
                                <td><?= htmlspecialchars($comment['product_id']) ?></td>
                                <td><?= htmlspecialchars($comment['user_id']) ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="/admin/commentEdit/<?= htmlspecialchars($comment['id']) ?>" class="btn btn-success btn-sm btn-icon-text mr-3">
                                            Sửa
                                            <i class="typcn typcn-edit btn-icon-append"></i>
                                        </a>
                                        <a href="/admin/delete-comment/<?= htmlspecialchars($comment['id']) ?>" onclick="return confirm('Bạn chắc chứ?')" class="btn btn-danger btn-sm btn-icon-text">
                                            Xóa
                                            <i class="typcn typcn-delete-outline btn-icon-append"></i>
                                        </a>
                                        <?php if ($comment['status'] == 0): ?>
                                            <a href="/admin/approve-comment/<?= htmlspecialchars($comment['id']) ?>" class="btn btn-primary btn-sm btn-icon-text ml-3">
                                                Duyệt
                                                <i class="typcn typcn-tick-outline btn-icon-append"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($comments)): ?>
                    <h4 class="text-center text-danger">Không có dữ liệu</h4>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$this->stop();
?>
