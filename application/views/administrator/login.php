<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= isset($title) ? $title : 'AdminLTE 3 | Log in' ?></title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">

  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition login-page">

<div class="login-box">

  <div class="login-logo">
    <a href="<?= base_url('index.php/admin/login') ?>">
      <b>Admin</b>LTE
    </a>
  </div>

  <div class="card">
    <div class="card-body login-card-body">

      <p class="login-box-msg">Sign in to start your session</p>

      <?php if ($this->session->flashdata('message')): ?>
        <?= $this->session->flashdata('message') ?>
      <?php endif; ?>

      <?= form_open('admin/login') ?>

        <div class="input-group mb-3">
          <input
            type="text"
            name="inputUsername"
            class="form-control"
            placeholder="Username"
            value="<?= set_value('inputUsername') ?>"
          >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input
            type="password"
            name="inputPassword"
            class="form-control"
            placeholder="Password"
          >

          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>

          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">
              Sign In
            </button>
          </div>
        </div>

      <?= form_close() ?>

      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>

        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign in using Facebook
        </a>

        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign in using Google+
        </a>
      </div>

      <p class="mb-1">
        <a href="#">I forgot my password</a>
      </p>

      <p class="mb-0">
        <a href="#" class="text-center">
          Register a new membership
        </a>
      </p>

    </div>
  </div>

</div>

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- AdminLTE App -->
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>

</body>
</html>