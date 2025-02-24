<?php $this->layout('Admin/Layouts/Layout') ?>

<?php $this->start('main_content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="table-responsive pt-3">
                <table class="table table-striped project-orders-table">
                    <thead>
                        <tr>
                            <th class="ml-5">ID</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Họ Tên</th>
                            <th>Trạng thái</th>
                            <th>Vai trò</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['phone']) ?></td>
                                <td><?= htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']) ?></td>
                                <td><?= $user['status'] == '1' ? 'Đang hoạt động' : 'Vô hiệu hóa' ?></td>
                                <td><?= $user['role'] == '1' ? 'Admin' : 'Client' ?></td>
                                <td><?= htmlspecialchars($user['created_at']) ?></td>
                                <td><?= htmlspecialchars($user['updated_at']) ?></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="/admin/users/edit/<?= $user['id'] ?>">
                                            <button type="button" class="btn btn-success btn-sm btn-icon-text mr-3">
                                                Sửa
                                                <i class="typcn typcn-edit btn-icon-append"></i>
                                            </button>
                                        </a>
                                        <a href="/admin/users/delete/<?= $user['id'] ?>"
                                            class="btn btn-danger btn-sm btn-icon-text"
                                            onclick="return confirm('Bạn chắc là xóa chứ?')">
                                            Xóa
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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

<?php $this->stop(); ?>