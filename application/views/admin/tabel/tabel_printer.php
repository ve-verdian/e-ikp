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
            <h1>Data Printer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Printer</li>
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
              <h3 class="card-title"><i class="fa fa-table" aria-hidden="true"></i>  Input Data Printer</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

							<?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?= $this->session->flashdata('msg_berhasil');?>
               	</div>
              <?php } ?>

						<a href="<?=base_url('admin/data_printer')?>" style="margin-bottom:10px;" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data Printer</a>
            <a href="<?=base_url('excel/export_printer')?>" style="margin-bottom:10px;" type="button" class="btn btn-success" name="export_excel"><i class="fa fa-plus-circle" aria-hidden="true"></i> Export Excel</a>
						<a href="<?=base_url('admin/cetak_printer')?>" style="margin-bottom:10px;" target="_BLANK" type="button" class="btn btn-danger" name="cetak_pdf"><i class="fa fa-plus-circle" aria-hidden="true"></i> Cetak Pdf</a>    
							<table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
									<th width="5%"><center>No</th>
                  <th width="15%"><center>Tgl Input</th>
                  <th width="15%"><center>Kategori</th>
									<th width="25%"><center>Merk</th>
                  <th width="25%"><center>Type</th>
									<th width="15%"><center>Serial Number</th>
                  <th width="15%"><center>Qty Out</th>
									<th width="15%"><center>Capacity (VA)</th>
                  <th width="15%"><center>Kondisi</th>
									<th width="12%"><center>Status</th>
                  <th width="20%"><center>Keterangan</th>
									<th width="15%"><center>Warna</th>
                  <th width="20%"><center>Pengguna</th>
									<th width="15%"><center>Lokasi</th>
                  <th width="12%"><center>Qty</th>
									<th width="12%"><center>Back Up</th>
                  <th width="15%"><center>Kepemilikan</th>
									<th width="20%"><center>Terakhir di Simpan</th>
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
                    <td width="15%"><?=$dd->kategori?></td>
										<td width="25%"><?=$dd->merk?></td>
                    <td width="25%"><?=$dd->type?></td>
										<td width="15%"><center><?=$dd->serial_number?></td>
                    <td width="15%"><center><?=$dd->qty_out?></td>
										<td width="15%"><center><?=$dd->capacity?></td>
                    <td width="15%"><center><?=$dd->kondisi?></td>
										<td width="12%"><center><?=$dd->status?></td>
                    <td width="20%"><?=$dd->keterangan?></td>
										<td width="15%"><center><?=$dd->warna?></td>
                    <td width="20%"><center><?=$dd->pengguna?></td>
										<td width="15%"><center><?=$dd->lokasi?></td>
                    <td width="12%"><center><?=$dd->qty?></td>
										<td width="12%"><center><?=$dd->backup?></td>
										<td width="15%"><center><?=$dd->kepemilikan?></td>
										<td width="20%"><center><?=$dd->posisi_skg?></td>
										<td width="15%"><center><a type="button" class="btn btn-success center-block"  href="<?=base_url('admin/update_printer/'.$dd->id_printer)?>" name="btn_update" style="margin:auto;"><i class="fas fa-edit"  aria-hidden="true"></i></a></td>
										<td width="15%"><center><a type="button" class="btn btn-danger btn-delete center-block"  href="<?=base_url('admin/delete_printer/'.$dd->id_printer)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
