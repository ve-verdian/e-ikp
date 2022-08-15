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
            <h1>Tabel Data Insiden Keselamatan Pasien</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data IKP</li>
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
              <h3 class="card-title"><i class="fa fa-table" aria-hidden="true"></i>  Laporan Insiden Keselamatan Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

							<?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?= $this->session->flashdata('msg_berhasil');?>
               	</div>
              <?php } ?>

						<a href="<?=base_url('admin/ikp')?>" style="margin-bottom:10px;" type="button" class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Data IKP</a>
            <a href="<?=base_url('excel/export_ikp')?>" style="margin-bottom:10px;" type="button" class="btn btn-success" name="export_excel"><i class="fa fa-plus-circle" aria-hidden="true"></i> Export Excel</a>
						<a href="<?=base_url('admin/cetak_ikp')?>" style="margin-bottom:10px;" target="_BLANK" type="button" class="btn btn-danger" name="cetak_pdf"><i class="fa fa-plus-circle" aria-hidden="true"></i> Cetak Pdf</a>    
							<table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
									<th width="5%"><center>No</th>
                  <th width="15%"><center>Nama</th>
                  <th width="15%"><center>No. MR</th>
									<th width="15%"><center>Ruangan</th>
                  <th width="15%"><center>Umur</th>
									<th width="8%"><center>Penanggung Biaya Pasien</th>
                  <th width="12%"><center>Jenis Kelamin</th>
									<th width="10%"><center>Tanggal Mendapatkan Pelayanan</th>
                  <th width="8%"><center>Pukul</th>
                  <th width="25%"><center>Tanggal & Waktu Insiden</th>
                  <th width="8%"><center>Pukul</th>
									<th width="25%"><center>Insiden</th>
                  <th width="25%"><center>kronologi</th>
                  <th width="15%"><center>Jenis Insiden*</th>
									<th width="10%"><center>Insiden terjadi pada pasien*</th>
                  <th width="8%"><center>Dampak / Akibat Insiden</th>
									<th width="8%"><center>Probalitas*</th>
                  <th width="8%"><center>Orang Pertama Yang Melaporkan Insiden*</th>
									<th width="10%"><center>Insiden Menyangkut Pasien*</th>
                  <th width="10%"><center>Tempat</th>
                  <th width="15%"><center>Unit Terkait</th>
                  <th width="15%"><center>Tindaklanjut yang dilakukan</th>
									<th width="15%"><center>Tindaklanjut setelah dilakukan</th>
                  <th width="15%"><center>Pernah Terjadi ?</th>
									<th width="8%"><center>Kapan ?</th>
                  <th width="12%"><center>Petugas</th>
									<th width="10%"><center>Karu</th>
                  <th width="25%"><center>Ketua KMRKP</th>
									<th width="25%"><center>Direktur</th>
                  <th width="15%"><center>Grading</th>
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
                    <td width="15%"><?=$dd->nama?></td>
										<td width="15%"><?=$dd->no_mr?></td>
                    <td width="15%"><?=$dd->ruangan?></td>
                    <td width="15%"><?=$dd->umur?></td>
                    <td width="15%"><?=$dd->biaya?></td>
                    <td width="15%"><?=$dd->jk?></td>
                    <td width="15%"><center><?=date('d-m-Y', strtotime($dd->tanggal_1))?></td>
                    <td width="8%"><center><?=$dd->waktu_1?></td>
                    <td width="15%"><center><?=date('d-m-Y', strtotime($dd->tanggal_2))?></td>
                    <td width="8%"><center><?=$dd->waktu_2?></td>
                    <td width="15%"><center><?=$dd->insiden?></td>
										<td width="15%"><center><?=$dd->kronologi?></td>
										<td width="8%"><center><?=$dd->jns_insiden?></td>
                    <td width="12%"><center><?=$dd->ins_tjd?></td>
										<td width="10%"><center><?=$dd->dampak?></td>
                    <td width="25%"><center><?=$dd->probalitas?></td>
										<td width="25%"><center><?=$dd->pelapor?></td>
                    <td width="15%"><center><?=$dd->ins_pas?></td>
										<td width="10%"><center><?=$dd->tempat?></td>
                    <td width="8%"><center><?=$dd->unit_terkait?></td>
										<td width="8%"><center><?=$dd->tindaklanjut?></td>
                    <td width="8%"><center><?=$dd->stlh_dilaku?></td>
                    <td width="15%"><center><?=$dd->prnh_tjd?></td>
										<td width="10%"><center><?=$dd->no_ulang?></td>
                    <td width="8%"><center><?=$dd->petugas?></td>
										<td width="8%"><center><?=$dd->karu?></td>
                    <td width="8%"><center><?=$dd->kmrkp?></td>
                    <td width="8%"><center><?=$dd->direktur?></td>
                    <td width="8%"><center><?=$dd->grad_res?></td>
										<td width="15%"><center><a type="button" class="btn btn-success center-block"  href="<?=base_url('admin/update_ikp/'.$dd->id_ikp)?>" name="btn_update" style="margin:auto;"><i class="fas fa-edit"  aria-hidden="true"></i></a></td>
										<td width="15%"><center><a type="button" class="btn btn-danger btn-delete center-block"  href="<?=base_url('admin/delete_ikp/'.$dd->id_ikp)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
