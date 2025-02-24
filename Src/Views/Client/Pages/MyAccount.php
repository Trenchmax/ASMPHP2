<?php
if (!isset($_SESSION['user'])) {
    header("Location: /login");
    exit();
}

$this->layout('Client/Components/Layout',['categories' => $categories]);


?>

<?= $this->start('main_content') ?>
<section class="account px-5">
    <div class="container-fluid">
        <div class="row g-0">
            <?php $this->Insert('Client/Components/sidebar'); ?>
            <div class="col-lg-9">
                <div class="account-info">
                    <div class="account-info-title">
                        <p>THÔNG TIN CÁ NHÂN</p>
                    </div>
                    <div class="account-info-form">
                        <form method="POST" action="/update-information">
                            <input type="hidden" name="method" value="POST">

                            <div class="form-group">
                                <label for="fullname" class="form-label">Tên đầy đủ</label>
                                <input type="text" id="fullname" name="fullname" class="form-control form-control-lg"
                                    value="<?= htmlspecialchars($_SESSION['user']['name'] ?? '') ?>"
                                    placeholder="Ex: NguyenVanA, ....">
                                <div id="fullname-error" class="text-danger" style="display: none;">Tên đầy đủ không được để trống.</div>
                            </div>

                            <div class="form-group">
                                <label for="firstname" class="form-label">Tên</label>
                                <input type="text" id="firstname" name="firstname" class="form-control form-control-lg"
                                    value="<?= htmlspecialchars($_SESSION['user']['firstname'] ?? '') ?>">
                                <div id="firstname-error" class="text-danger" style="display: none;">Tên không được để trống *</div>
                            </div>

                            <div class="form-group">
                                <label for="lastname" class="form-label">Họ</label>
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-lg"
                                    value="<?= htmlspecialchars($_SESSION['user']['lastname'] ?? '') ?>">
                                <div id="lastname-error" class="text-danger" style="display: none;">Họ không được để trống *</div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" id="phone" name="phone" class="form-control form-control-lg"
                                    value="<?= htmlspecialchars($_SESSION['user']['phone'] ?? '') ?>">
                                <div id="phone-error" class="text-danger" style="display: none;">Số điện thoại không được để trống *</div>
                            </div>

                            <div class="form-group" id="email-group"
                                style="display: <?= isset($_SESSION['user']['google_id']) && !empty($_SESSION['user']['google_id']) ? 'none' : 'block'; ?>;">
                                <label for="email" class="form-label">Địa chỉ Email</label>
                                <?php if (isset($_SESSION['user']['google_id']) && !empty($_SESSION['user']['google_id'])): ?>
                                    <input type="email" id="email" name="email" class="form-control form-control-lg"
                                        value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" readonly>
                                    <small class="text-muted">Email được liên kết với Google, không thể chỉnh sửa.</small>
                                <?php else: ?>
                                    <input type="text" id="email" name="email" class="form-control form-control-lg"
                                        value="<?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?>">
                                    <div id="email-error" class="text-danger" style="display: none;">Email không được để trống *</div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-success btn-lg">
                                    Lưu thay đổi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

</section>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const fields = ["fullname", "firstname", "lastname", "phone", "email"];

    form.addEventListener("submit", function (event) {
        let isValid = true;

        fields.forEach(field => {
            let input = document.getElementById(field);
            let error = document.getElementById(field + "-error");

            if (input && error) {
                let value = input.value.trim();
                input.value = value;  

                if (value === "") {
                    error.innerText = "Trường này không được để trống!";
                    error.style.display = "block";
                    isValid = false;
                } else {
                    error.style.display = "none";
                }
            }
        });

        let emailInput = document.getElementById("email");
        let emailError = document.getElementById("email-error");
        if (emailInput && emailInput.value.trim() !== "") {
            let emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            if (!emailPattern.test(emailInput.value.trim())) {
                emailError.innerText = "Email phải có dạng hợp lệ (@gmail.com)!";
                emailError.style.display = "block";
                isValid = false;
            } else {
                emailError.style.display = "none";
            }
        }

        if (!isValid) {
            event.preventDefault();  
        }
    });
});
</script>


<?= $this->stop() ?>