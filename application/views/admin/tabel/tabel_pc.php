<!DOCTYPE html>
<html>
<head>
  <title><?= $title; ?></title>
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
            <h1>Data Komputer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Komputer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-table" aria-hidden="true"></i>  Input Data Kompter</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

							<?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?= $this->session->flashdata('msg_berhasil');?>
               	</div>
              <?php } ?>

						<a href="<?=base_url('admin/data_pc')?>" style="margin-bottom:10px;" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Komputer</a>
            <a href="<?=base_url('excel/export_pc')?>" style="margin-bottom:10px;" type="button" class="btn btn-success" name="export_excel"><i class="fa fa-plus-circle" aria-hidden="true"></i> Export Excel</a>
						<a href="<?=base_url('admin/cetak_pc')?>" style="margin-bottom:10px;" target="_BLANK" type="button" class="btn btn-danger" name="cetak_pdf"><i class="fa fa-plus-circle" aria-hidden="true"></i> Cetak Pdf</a>    
							<table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
									<th width="5%"><center>No</th>
                  <th width="15%"><center>Tgl Input</th>
                  <th width="15%"><center>Dept / Divisi</th>
									<th width="15%"><center>Hostname</th>
                  <th width="15%"><center>User</th>
									<th width="8%"><center>Jenis</th>
                  <th width="12%"><center>Harddisk</th>
									<th width="10%"><center>RAM</th>
                  <th width="25%"><center>Processor</th>
									<th width="25%"><center>Operating System</th>
                  <th width="15%"><center>IP Address</th>
									<th width="10%"><center>Lokasi</th>
                  <th width="8%"><center>Internet</th>
									<th width="8%"><center>Lokal</th>
                  <th width="8%"><center>SIM-RS</th>
									<th width="10%"><center>Status</th>
									<th width="15%"><center>Update</th>
									<th width="15%"><center>Hapus</th>
                </tr>
                </thead>
                <tbody>
                <tr>
								<?php if(is_array($list_data)){ ?>
                  <?php $no = 1;?>
                  <?php foreach($list_data as $dd): ?>
                    <td width="5%"><center><?=$no?></td>
                    <td width="15%"><center><?=date('d-m-Y', strtotime($dd->tgl_input))?></td>
                    <td width="15%"><?=$dd->divisi?></td>
										<td width="15%"><?=$dd->hostname?></td>
                    <td width="15%"><?=$dd->user?></td>
										<td width="8%"><center><?=$dd->jenis?></td>
                    <td width="12%"><center><?=$dd->hard_disk?></td>
										<td width="10%"><center><?=$dd->ram?></td>
                    <td width="25%"><center><?=$dd->processor?></td>
										<td width="25%"><center><?=$dd->os?></td>
                    <td width="15%"><?=$dd->ip_address?></td>
										<td width="10%"><center><?=$dd->lokasi?></td>
                    <td width="8%"><center><?=$dd->internet?></td>
										<td width="8%"><center><?=$dd->lokal?></td>
                    <td width="8%"><center><?=$dd->simrs?></td>
										<td width="10%"><center><?=$dd->status?></td>
										<td width="15%"><center><a type="button" class="btn btn-success center-block"  href="<?=base_url('admin/update_pc/'.$dd->id_pc)?>" name="btn_update" style="margin:auto;"><i class="fas fa-edit"  aria-hidden="true"></i></a></td>
										<td width="15%"><center><a type="button" class="btn btn-danger btn-delete center-block"  href="<?=base_url('admin/delete_pc/'.$dd->id_pc)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
									<?php $no++; ?>
									<?php endforeach;?>
									<?php }else { ?>
												<td colspan="7" align="center"><strong>Data Kosong</strong></td>
									<?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php $this->load->view("admin/_layouts/footer.php") ?>
<script>
jQuery(document).ready(function($){
      $('.btn-delete').on('click',function(){
          var getLink = $(this).attr('href');
          swal({
                  title: 'Delete Data',
                  text: 'Yakin Ingin Menghapus Data ?',
                  html: true,
                  confirmButtonColor: '#d9534f',
                  showCancelButton: true,
                  },function(){
                  window.location.href = getLink
              });
          return false;
      });
  });
	
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    })
	$('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
</script>
</body>
</html>
