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
              <h1>Data Barang Keluar</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Home</a></li>
                <li class="breadcrumb-item active">Data Barang Keluar</li>
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
                <h3 class="card-title"><i class="fa fa-table" aria-hidden="true"></i> Stock Barang Keluar</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong><br> <?= $this->session->flashdata('msg_berhasil');?>
                </div>
                <?php } ?>

                <?php if($this->session->flashdata('msg_berhasil_keluar')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong><br> <?= $this->session->flashdata('msg_berhasil_keluar');?>
                </div>
                <?php } ?>

                <a href="<?=base_url('admin/tabel_barangmasuk')?>" style="margin-bottom:10px;" type="button"
                  class="btn btn-primary" name="tambah_data"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah
                  Data Keluar</a>
                <a href="<?=base_url('excel/export_barkel')?>" style="margin-bottom:10px;" type="button" class="btn btn-success" name="export_excel"><i
                    class="fa fa-plus-circle" aria-hidden="true"></i> Export Excel</a>
                <a href="<?=base_url('admin/cetak_barkel')?>" style="margin-bottom:10px;" type="button" class="btn btn-danger" name="cetak_pdf"><i
                    class="fa fa-plus-circle" aria-hidden="true"></i> Cetak Pdf</a>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%">
                        <center>No
                      </th>
                      <th width="8%">
                        <center>Tgl Masuk
                      </th>
                      <th width="8%">
                        <center>Tgl Keluar
                      </th>
                      <th width="15%">
                        <center>Divisi
                      </th>
                      <th width="15%">
                        <center>No. Seri / Kode Barang
                      </th>
                      <th width="20%">
                        <center>Nama Barang
                      </th>
                      <th width="5%">
                        <center>Jumlah
											</th>
											<th width="5%">
                        <center>Satuan
                      </th>
                      <th width="20%">
                        <center>Unit Order
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php if(is_array($list_data)){ ?>
                      <?php $no = 1;?>
                      <?php foreach($list_data as $dd): ?>
                      <td width="5%">
                        <center><?=$no?>
                      </td>
                      <!-- <td><?=$dd->id_transaksi?></td> -->
                      <td width="8%">
                        <center><?=date('d-m-Y', strtotime($dd->tanggal_masuk))?>
                      </td>
                      <td width="8%">
                        <center><?=date('d-m-Y', strtotime($dd->tanggal_keluar))?>
                      </td>
                      <td width="15%">
                        <center><?=$dd->divisi?>
                      </td>
                      <td width="15%">
                        <center><?=$dd->kode_barang?>
                      </td>
                      <td width="20%"><?=$dd->nama_barang?></td>
                      <td width="5%">
                        <center><?=$dd->jumlah?>
                      </td>
                      <td width="5%">
												<center><?=$dd->satuan?></td>
                      <td width="20%"><?=$dd->unit_order?></td>
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
