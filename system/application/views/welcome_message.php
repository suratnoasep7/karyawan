<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistem Domitory</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>node_modules/@fortawesome/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>node_modules/icheck-bootstrap/icheck-bootstrap.min.css">

  <link rel="stylesheet" href="<?php echo base_url() ?>node_modules/toastr/build/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>"><b>SISTEM</b>DOMITORY</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post" name="login" id="login">
        <div class="input-group mb-3">
          <input type="text" name="nomor" class="form-control" placeholder="NIM / NIP" autocomplete="off" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-8"></div>
          <div class="col-4">
            <button type="button" class="btn btn-primary btn-block" id="btn-login">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>node_modules/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<script src="<?php echo base_url() ?>node_modules/toastr/build/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/js/adminlte.min.js"></script>

<script type="text/javascript">
	var base_url = '<?php echo base_url()  ?>';
</script>

<script src="<?php echo base_url() ?>assets/js/login.js"></script>

</body>
</html>
