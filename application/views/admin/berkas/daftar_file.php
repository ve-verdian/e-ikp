<!DOCTYPE html>
<html lang="en">

<head>
  <title>Form IKP | Daftar File</title>
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
              <h1>Lampirkan File</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Berkas</li>
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
                  <h3 class="card-title"><i class="fa fa-archive" aria-hidden="true"></i> Berkas</h3>
                </div>
                <!-- /.card-header -->
                <?php
				if($this->session->userdata('status_upload')!=null){
				echo $this->session->userdata('status_upload');  // menampilkan pesan error upload
				}

				if($this->session->userdata('status_hapus')!=null){
				echo $this->session->userdata('status_hapus');  // menampilkan pesan error upload
				}

				if($this->session->userdata('status_upload')!=null){ // menghapus pesan error upload
				$this->session->unset_userdata('status_upload');
				}
			
				if($this->session->userdata('status_hapus')!=null){ // menghapus pesan error upload
				$this->session->unset_userdata('status_hapus');
				}
				?>

                <div class="card-body">
                  <a href="<?=base_url('upload/form')?>" style="margin-bottom:10px;" class="btn btn-primary"><i
                      class="fas fa-upload"></i> Upload File</a>
                  <table id="example1" class="table table-responsive table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="5%">
                          <center>No
                        </th>
                        <th width="20%">
                          <center>Nama File
                        </th>
                        <th width="12%">
                          <center>Ukuran File
                        </th>
                        <th width="12%">
                          <center>Tanggal Upload
                        </th>
                        <th width="10%">
                          <center>Aksi
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
											$no=null;
											$dir = "uploaded_file/";

											if(isset($daftar_file)){
												for($a=0;$a<count($daftar_file);$a++) { 
													if($daftar_file[$a]!='.' && $daftar_file[$a]!='..'){
													$no++;
													$file=$daftar_file[$a];
										?>
                      <tr>
                        <td align="center"><?= $no;?></td>
                        <td><?= $file;?></td>
                        <td align="center"><?= number_format(filesize($dir.$daftar_file[$a])/1024,2,',','.');?> Kb</td>
                        <td align="center"><?= date ("d F Y", filemtime($dir.$daftar_file[$a]));?></td>
                        <td align="center">
                          <a href="<?= $dir.$daftar_file[$a];?>" class="btn btn-primary"><span
                              class="fas fa-download"></span></a>
                          <a href="<?= base_url().'upload/hapus/'.$daftar_file[$a];?>" class="btn btn-danger"><span
                              class="fas fa-trash-alt"></span></a>
                        </td>
                      </tr>
                    </tbody>
                    <?php
										}
										}	
									}
									?>
                  </table>
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
    <!-- /.content-wrapper -->
    <script>
    jQuery(document).ready(function($) {
      $('.btn-delete').on('click', function() {
        var getLink = $(this).attr('href');
        swal({
          title: 'Delete Data',
          text: 'Yakin Ingin Menghapus Data ?',
          html: true,
          confirmButtonColor: '#d9534f',
          showCancelButton: true,
        }, function() {
          window.location.href = getLink
        });
        return false;
      });
    });

    $(function() {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
    </script>
    </body>
</html>
