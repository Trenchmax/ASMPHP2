<?= $this->layout('Client/Components/Layout' ) ?>

<?= $this->start('main_content') ?>
<div class="container">
  <section class="vh-100">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6 text-black">
          <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
            <form action="/register" method="POST" style="width: 23rem;">
              <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign up</h3>
              
              <div class="form-outline mb-4">
                <input type="text" name="name" id="registerName" class="form-control form-control-lg" required />
                <label class="form-label" for="registerName">Full Name</label>
              </div>
              
              <div class="form-outline mb-4">
                <input type="text" name="firstname" id="registerFirstname" class="form-control form-control-lg" required />
                <label class="form-label" for="registerFirstname">First Name</label>
              </div>
              
              <div class="form-outline mb-4">
                <input type="text" name="lastname" id="registerLastname" class="form-control form-control-lg" required />
                <label class="form-label" for="registerLastname">Last Name</label>
              </div>
              
              <div class="form-outline mb-4">
                <input type="email" name="email" id="registerEmail" class="form-control form-control-lg" required />
                <label class="form-label" for="registerEmail">Your Email</label>
              </div>
              
              <div class="form-outline mb-4">
                <input type="text" name="phone" id="registerPhone" class="form-control form-control-lg" required />
                <label class="form-label" for="registerPhone">Phone Number</label>
              </div>
              
              <div class="form-outline mb-4">
                <input type="password" name="password" id="registerPassword" class="form-control form-control-lg" required />
                <label class="form-label" for="registerPassword">Password</label>
              </div>
              
              <div class="form-outline mb-4">
                <input type="password" id="confirmPassword" class="form-control form-control-lg" required />
                <label class="form-label" for="confirmPassword">Repeat your password</label>
              </div>
              
              <div class="pt-1 mb-4">
                <button class="btn btn-info btn-lg btn-block" type="submit">Register</button>
              </div>
              
              <p>Already have an account? <a href="/loginForm" class="link-info">Log in here</a></p>
            </form>
          </div>
        </div>
        <div class="col-sm-6 px-0 d-none d-sm-block">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img3.webp"
            alt="Register image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
      </div>
    </div>
  </section>
</div>
<?= $this->stop() ?>