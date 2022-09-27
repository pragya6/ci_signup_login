<?= session()->getFlashdata('error') ?>
<?= service('validation')->listErrors() ?>

<div class="container">
  <div>
    <h3>LogIn Here:</h3>
    <form action="/login" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Username</label>
        <input type="text" class="form-control" name="log_name" id="formGroupExampleInput" placeholder="Enter Your Name">
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Password</label>
        <input type="password" class="form-control" name="log_pass" id="formGroupExampleInput" placeholder="Enter Your Password">
      </div>
      <button class="btn btn-primary mx-auto" type="submit">Login</button>
    </form>
  </div>
  <div>
    <h3>Register Here:</h3>
    <form action="/register" method="post">
      <?= csrf_field() ?>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Username</label>
        <input type="text" class="form-control" name="reg_name" id="formGroupExampleInput" placeholder="Enter Your Name">
      </div>
      <div class="mb-3">
        <label for="formGroupExampleInput" class="form-label">Password</label>
        <input type="password" class="form-control" name="reg_pass" id="formGroupExampleInput" placeholder="Enter Your Password">
      </div>
      <button class="btn btn-primary mx-auto" type="submit">Register</button>
    </form>
  </div>
</div>