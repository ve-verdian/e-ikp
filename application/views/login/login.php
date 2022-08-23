<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Form IKP | Sign In</title>
  <link rel="shortcut icon" href="<?=base_url('assets/img/rsia_family.jpeg')?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Anton|Baloo+Bhai|Be+Vietnam|Black+Ops+One|Carter+One|Fascinate+Inline|Fredoka+One|Modak|Oleo+Script|Paytone+One|Righteous|Russo+One|Ubuntu|Ultra&display=swap"
    rel="stylesheet">

</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#" style="font-family: 'Black Ops One', cursive;">FORM IKP</a>
    </div>
    <!-- /.login-logo -->
    <div class="card shadow">
      <div class="card-body login-card-body">
        <h4 class="login-box-msg" font color="#DC143C" style="font-family: 'Modak', cursive;">Masuk</h4>

        <form action="<?= base_url('login/proses_login')?>" class="login" method="post">
          <?php if($this->session->flashdata('msg')){ ?>
          <div class="alert alert-warning alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong><br> <?= $this->session->flashdata('msg');?>
          </div>
          <?php } ?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" style="font-family: 'Be Vietnam', sans-serif;" name="username" id="username"
							placeholder="Username" autofocus required="" />
							<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" style="font-family: 'Be Vietnam', sans-serif;" name="password" id="password"
							placeholder="Password" autofocus required="" />
							<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-8">
              <p class="mb-1">
                <?php if(isset($token_generate)){ ?>
                <input type="hidden" name="token" value="<?= $token_generate ?>">
                <?php }else {
							redirect(base_url());
						}?>
                <!-- <a href="<?= base_url('login/register'); ?>" class="text-center"
                  style="font-family: 'Carter One', cursive;">Sign Up</a> -->
              </p>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat" aria-hidden="true"
                style="font-family: 'Carter One', cursive;">Sign In</button>
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
  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
