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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Data Barang Masuk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Update Data Barang Masuk</li>
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
                  <h3 class="card-title"><i class="fa fa-archive" aria-hidden="true"></i> Input Data Barang Masuk</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?=base_url('admin/proses_databarang_masuk_update')?>" role="form"
                  method="post">

                  <?php if(validation_errors()){ ?>
                  <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Warning!</strong><br> <?= validation_errors(); ?>
                  </div>
                  <?php } ?>

                  <div class="card-body">
                    <div class="form-row">
                      <?php foreach($data_barang_update as $d){ ?>
                      <div class="form-group col-md-3">
                        <label for="id_transaksi" >ID Transaksi</label>
                        <input type="text" name="id_transaksi"  class="form-control"
                          id="id_transaksi" readonly="readonly" value="<?=$d->id_transaksi?>">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="tanggal" >Tanggal</label>
                        <input type="date" name="tanggal"  class="form-control" id="tanggal"
                          readonly="readonly" value="<?=$d->tanggal?>">
                      </div>
                    <div class="form-group col-md-6">
                      <label for="divisi" >Divisi</label>
                      <input type="text" name="divisi"  class="form-control" id="divisi"
                        readonly="readonly" value="<?=$d->divisi?>">
										</div>
										</div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="kode_barang">No. Seri / Kode Barang</label>
                      <input type="text" name="kode_barang" readonly="readonly"
                        class="form-control" id="kode_barang" value="<?=$d->kode_barang?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="nama_barang">Nama Barang</label>
                      <input type="text" name="nama_barang" class="form-control"
                        id="nama_barang" value="<?=$d->nama_barang?>">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="jumlah">Jumlah</label>
                      <input type="number" name="jumlah" class="form-control" id="jumlah"
                        value="<?=$d->jumlah?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="satuan">Satuan</label>
                      <select name="satuan" class="form-control">
                        <?php foreach($list_satuan as $s){?>
                        <?php if($d->satuan == $s->nama_satuan){?>
                        <option value="<?=$d->satuan?>" selected=""><?=$d->satuan?></option>
                        <?php }else{?>
                        <option value="<?=$s->nama_satuan?>"><?=$s->nama_satuan?></option>
                        <?php } ?>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?php } ?>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <a type="submit" class="btn btn-warning" onclick="history.back(-1)" name="btn_kembali"><i
                        class="far fa-arrow-alt-circle-left" aria-hidden="true"></i> Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="far fa-save" aria-hidden="true"></i>
                      Simpan</button>
                    <a type="submit" class="btn btn-primary center-block"
                      href="<?=base_url('admin/tabel_barangmasuk')?>" name="btn_listbarang"><i class="fa fa-table"
                        aria-hidden="true"></i> List Barang</a>
                  </div>
              </div>
              <!-- /.card-footer -->
              </form>
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
  <?php $this->load->view("admin/_layouts/footer.php") ?>
  </body>
</html>
