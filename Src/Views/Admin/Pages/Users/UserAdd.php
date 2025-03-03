<?php $this->layout('Admin/Layouts/Layout') ?>

<?php $this->start('main_content'); ?>

<div class="row mt-4">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm người dùng</h4>

               
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

                <form class="form-sample" action="/admin/user/add" method="POST">
                    <input type="hidden" name="method" value="POST">

                    <p class="card-description">Thông tin cá nhân</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Họ</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="lastname" placeholder="Nhập họ"
                                        value="<?= $_SESSION['old_data']['lastname'] ?? '' ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="firstname" placeholder="Nhập tên"
                                        value="<?= $_SESSION['old_data']['firstname'] ?? '' ?>" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="email" placeholder="Nhập email"
                                        value="<?= $_SESSION['old_data']['email'] ?? '' ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại"
                                        value="<?= $_SESSION['old_data']['phone'] ?? '' ?>" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên của bạn</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="name" placeholder="Nhập username"
                                        value="<?= $_SESSION['old_data']['name'] ?? '' ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Mật khẩu</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="card-description">Địa chỉ</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Địa chỉ chi tiết</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="address" placeholder="Nhập địa chỉ chi tiết"
                                        value="<?= $_SESSION['old_data']['address'] ?? '' ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role</label>
                                <div class="col-sm-12">
                                    <select class="form-control" name="role" id="role">
                                        <option value="1" <?= (isset($_SESSION['old_data']['role']) && $_SESSION['old_data']['role'] == 1) ? 'selected' : '' ?>>Client</option>
                                        <option value="2" <?= (isset($_SESSION['old_data']['role']) && $_SESSION['old_data']['role'] == 2) ? 'selected' : '' ?>>Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-primary" name="submit">Thêm</button>
                    </div>
                </form>

                <?php unset($_SESSION['old_data']);  
                ?>


            </div>
        </div>
    </div>
</div>

<?php $this->stop(); ?>