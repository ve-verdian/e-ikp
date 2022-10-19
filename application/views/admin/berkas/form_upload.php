<!DOCTYPE html>
<html lang="en">

<head>
  <title>Form IKP | Upload File</title>
  	<?php $this->load->view("admin/_layouts/header.php") ?>
  <div class="wrapper">
    <?php $this->load->view("admin/_layouts/navbar.php") ?>
    <?php $this->load->view("admin/_layouts/sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Pilih Berkas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Upload File</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="card card-danger">
                <div class="card-header">
                  <h3 class="card-title"><i class="fa fa-archive" aria-hidden="true"></i> Upload File</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                  <h2>Silahkan Upload File Disini</h2>
                  <p>Gunakan form dibawah ini untuk mengupload file.</p>

                  <form method="post" action="<?= base_url();?>upload/do_upload" enctype="multipart/form-data">
                  <div class="input-group mb-3">
                    <label class="input-group-text" for="file_nya">Upload</label>
                    <input type="file" class="form-control" id="file_nya" name="file_nya">
                  </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary"><span class="fas fa-upload"></span> Upload!</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!--/.col (left) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
