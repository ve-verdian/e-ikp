<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $title; ?></title>
  	<?php $this->load->view("admin/_layouts/header.php") ?>
  <div class="wrapper">
    <?php $this->load->view("admin/_layouts/navbar.php") ?>
    <?php $this->load->view("admin/_layouts/sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
            <div class="card text-center">
              <div class="card-header">
                <b>  
                  FORMULIR 
                </b>  
              </div>
              <div class="card-body">
                <!-- <h5 class="card-title">Special title treatment</h5> -->
                <p class="card-text"><b>LAPORAN INSIDEN KESELAMATAN PASIEN (IKP)</b></p>
                <p class="card-text"><b>INTERNAL KE KMRKP (SUB KOM KESELAMATAN PASIEN)</b></p>
                <a href="<?=base_url('admin/ikp')?>" class="btn btn-primary">Isi Form Disini</a>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><b>Teramedik</b></h5>
                    <p class="card-text">Hospital Information System, Rumah Sakit Ibu & Anak Family</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="http://175.106.8.138:9099" target="_blank" class="btn btn-outline-danger btn-sm">Klik!</a>
                    </div> 
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><b>RS Cloud</b></h5>
                    <p class="card-text">Rumah yang aman untuk semua data Anda, alangkah baiknya di simpan di Cloud</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="http://175.106.8.138:9393/" target="_blank" class="btn btn-outline-danger btn-sm">Klik!</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><b>Sismadak</b></h5>
                    <p class="card-text">Mengumpulkan, menyimpan, dan mencari dokumen Akreditasi</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="http://175.106.8.138:9292/" target="_blank" class="btn btn-outline-danger btn-sm">Klik!</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title"><b>Formulir IT</b></h5>
                    <p class="card-text">Pengajuan akses user baik itu Teramedik, RS Cloud, Sismadak, ataupun Email</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="http://lims.rsiafamily.com:9494/flims/index.php?p=show_detail&id=25/" target="_blank" class="btn btn-outline-danger btn-sm">Klik!</a>
                    </div>                  
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view("admin/_layouts/footer.php") ?>
    </body>
</html>
