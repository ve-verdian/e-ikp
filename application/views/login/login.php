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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Anton|Baloo+Bhai|Be+Vietnam|Black+Ops+One|Carter+One|Fascinate+Inline|Fredoka+One|Modak|Oleo+Script|Paytone+One|Righteous|Russo+One|Ubuntu|Ultra&display=swap"
    rel="stylesheet">
</head>

<style>
  .divider:after,
  .divider:before {
  content: "";
  flex: 1;
  height: 1px;
  background: #eee;
  }
  .h-custom {
  height: calc(100% - 50px);
  }
  @media (max-width: 500px) {
  .h-custom {
  height: 100%;
  }
  }
</style>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-12 col-lg-6 col-xl-3">
        <img src="<?=base_url('assets/img/family.jpg')?>"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="<?= base_url('login/proses_login')?>" class="login" method="post">
            
          <div class="col-8">
            <div class="h4 text-danger border-danger" font color="#DC143C" style="font-family: Bahnschrift SemiBold;">
              Login
            </div>
          </div> 

            <?php if($this->session->flashdata('msg')){ ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning!</strong><br> <?= $this->session->flashdata('msg');?>
            </div>
            <?php } ?>

            <?php if($this->session->flashdata('msg_terdaftar')){ ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong><br> <?= $this->session->flashdata('msg_terdaftar');?>
            </div>
            <?php } ?>
            
          <!-- Email input -->
          <div class="col-8">
          <label class="form-label" for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control form-control-lg"
              placeholder="Masukan username" autofocus required=""  />
              <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <!-- Password input -->
          <div class="col-8">
          <label class="form-label" for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control form-control-lg"
              placeholder="Masukan password" autofocus required="" />
              <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <!-- <div class="col-8 mt-4">
            <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div> 
          </div> -->

            <div class="col-8 mt-4">
              <p class="mb-1">
                <?php if(isset($token_generate)){ ?>
                <input type="hidden" name="token" value="<?= $token_generate ?>">
                <?php }else {
							    redirect(base_url());
						    }?>
                 <button type="submit" class="btn btn-danger btn-block btn-flat" aria-hidden="true"
                style="font-family: 'Carter One', cursive;">Login</button>
              </p>
            </div>
            <!-- /.col -->
            <div class="col-8">
              <label class="fw-semibold">Belum punya akun ? </label><a href="<?= base_url('login/register'); ?>"
                class="link-danger"> Register</a>
        </form>
      </div>
    </div>
  </div>
</section>

  <script src='https://www.google.com/recaptcha/api.js'></script>
  <!-- jQuery -->
  <script src="<?= base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
</body>