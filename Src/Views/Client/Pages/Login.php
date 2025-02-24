<?= $this->layout('Client/Components/Layout' ) ?>

<?= $this->start('main_content') ?>
<div class="container">
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
            <form action="/login" method="POST" style="width: 23rem;">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
              <div class="form-outline mb-4">
                <input name="email" type="email" class="form-control form-control-lg" required />
                <label class="form-label">Email address</label>
              </div>
              <div class="form-outline mb-4">
                <input name="password" type="password" class="form-control form-control-lg" required />
                <label class="form-label">Password</label>
              </div>
              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
              </div>
              <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
              <p>Don't have an account? <a href="/registerForm" class="link-info">Register here</a></p>

              <?php if (isset($_GET['error'])): ?>
                <p class="text-danger"><?= htmlspecialchars($_GET['error']) ?></p>
              <?php endif; ?>
            </form>


          </div>

        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
            alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>
</div>
<?= $this->stop() ?>