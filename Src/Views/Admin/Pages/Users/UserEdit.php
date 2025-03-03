<?php $this->layout('Admin/Layouts/Layout') ?>

<?php $this->start('main_content'); ?>

<div class="content-wrapper">
    <div class="row mt-4">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Chỉnh sửa người dùng</h4>

                    <?php if (!empty($_SESSION['errors'])) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($_SESSION['errors'] as $error) : ?>
                                    <li><?= htmlspecialchars($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php unset($_SESSION['errors']); ?>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['success'])) : ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['success']); ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <form class="form-sample" action="/admin/user/update/<?= $users['id'] ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $users['id'] ?>">
                        <input type="hidden" name="method" value="POST">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">

                        <p class="card-description">Thông tin cá nhân</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Họ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="lastname"
                                            value="<?= $_SESSION['old_data']['lastname'] ?? $users['lastname'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="firstname"
                                            value="<?= $_SESSION['old_data']['firstname'] ?? $users['firstname'] ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email"
                                            value="<?= $_SESSION['old_data']['email'] ?? $users['email'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="phone"
                                            value="<?= $_SESSION['old_data']['phone'] ?? $users['phone'] ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name"
                                            value="<?= $_SESSION['old_data']['name'] ?? $users['name'] ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mật khẩu (để trống nếu không đổi)</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu mới (nếu cần)" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="card-description">Quyền hạn</p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Role</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="role">
                                            <option value="1" <?= (isset($_SESSION['old_data']['role']) && $_SESSION['old_data']['role'] == 1) || $users['role'] == 1 ? 'selected' : '' ?>>Client</option>
                                            <option value="2" <?= (isset($_SESSION['old_data']['role']) && $_SESSION['old_data']['role'] == 2) || $users['role'] == 2 ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary" name="submit">Cập nhật</button>
                        </div>
                    </form>

                    <?php unset($_SESSION['old_data']);   ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->stop(); ?>