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
              <h1>INSIDEN KESELAMATAN PASIEN</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Update Data IKP</li>
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
                  <h3 class="card-title"><i class="fa fa-archive" aria-hidden="true"></i> Update Laporan Insiden Keselamatan Pasien</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" action="<?=base_url('admin/ikp_update')?>" role="form"
                  method="post">

                  <?php if(validation_errors()){ ?>
                  <div class="alert alert-warning alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Warning!</strong><br> <?= validation_errors(); ?>
                  </div>
                  <?php } ?>

                  <div class="card-body">
										<div class="form-group row">
                      <?php foreach($ikp as $dikp){ ?>
                        <div class="form-group col-md-6">
                      <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control"
                          id="nama" placeholder="Nama" value="<?=$dikp->nama?>">
                          <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-3">
                      <label for="no_mr">No. MR</label>
                        <input type="number" name="no_mr" class="form-control"
                          id="no_mr" placeholder="Nomor Medical Record" value="<?=$dikp->no_mr?>">
                          <?= form_error('no_mr', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-3">
                      <label for="ruangan">Ruangan</label>
                        <input type="text" name="ruangan" class="form-control"
                          id="ruangan" placeholder="Ruangan" value="<?=$dikp->ruangan?>">
                          <?= form_error('ruangan', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-2">
                      <label for="umur">Umur</label>
                        <input type="text" name="umur" class="form-control"
                          id="umur" placeholder="Umur" value="<?=$dikp->umur?>">
                          <?= form_error('umur', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="biaya">Penanggung Biaya Pasien</label>
                        <select class="custom-select" name="biaya" id="biaya">
                          <option value="<?=$dikp->biaya?>"><?=$dikp->biaya?></option>
                          <option value="BPJS">BPJS</option>
                          <option value="Jamkesda">Jamkesda</option>
                          <option value="Umum/Pribadi">Umum/Pribadi</option>
                          <option value="Asuransi Swasta">Asuransi Swasta</option>
                          <option value="Pemerintah">Pemerintah</option>
                          <option value="Lain-lain">Lain-lain</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="custom-select" name="jk" id="jk">
                          <option value="<?=$dikp->jk?>"><?=$dikp->jk?></option>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan">Perempuan</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="tanggal_1" >Tanggal Mendapatkan Pelayanan</label>
                        <input type="date" name="tanggal_1"  class="form-control"
													id="tanggal_1" placeholder="Tanggal Mendapatkan Pelayanan" value="<?=$dikp->tanggal_1?>">
													<?= form_error('tanggal_1', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
										</div>
                    <span><b>II. RINCIAN KEJADIAN</b></span>   
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="tanggal_2" >Tanggal dan Waktu Insiden</label>
                        <input type="date" name="tanggal_2"  class="form-control"
													id="tanggal_2" placeholder="Tanggal dan Waktu Insiden"  value="<?=$dikp->tanggal_2?>">
													<?= form_error('tanggal_2', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-8">
                        <label for="insiden">Insiden</label>
                        <input type="text" name="insiden" class="form-control"
                          id="insiden" placeholder="Insiden" value="<?=$dikp->insiden?>">
                          <?= form_error('insiden', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-12">
                        <label for="kronologi">Kronologi</label>
                        <textarea class="form-control" name="kronologi" id="kronologi" value="<?=$dikp->kronologi?>" rows="3" placeholder="Sebutkan . . . " ></textarea>
                        <?= form_error('kronologi', '<small class="text-danger pl-3">', '</small>') ?>
                      </div> 
                      <div class="form-group col-md-6">
                        <label for="jns_insiden">Jenis Insiden*</label>
                        <select class="custom-select" name="jns_insiden" id="jns_insiden">
                          <option value="<?=$dikp->jns_insiden?>"><?=$dikp->jns_insiden?></option>
                          <option value="Kejadian Nyaris Cedera/KNC (Near Miss)">Kejadian Nyaris Cedera/KNC (Near Miss)</option>
                          <option value="Kejadian Tidak diharapakan/KTD (Adverse Event)">Kejadian Tidak diharapakan/KTD (Adverse Event)</option>
                          <option value="Kejadian Sentinel (Sentinel Event)">Kejadian Sentinel (Sentinel Event)</option>
                          <option value="Kejadian Tidak Cedera (KTC)">Kejadian Tidak Cedera (KTC)</option>
                          <option value="Kejadian Potensial Cedera Serius/KPC (Significant)">Kejadian Potensial Cedera Serius/KPC (Significant)</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="ins_tjd">Insiden terjadi pada pasien* : (sesuai kasus penyakit/spesialisasi)</label>
                        <select class="custom-select" name="ins_tjd" id="ins_tjd">
                          <option value="<?=$dikp->ins_tjd?>"><?=$dikp->ins_tjd?></option>
                          <option value="Anak dan Subspesialisasinya">Anak dan Subspesialisasinya</option>
                          <option value="Penyakit Dalam dan Subspesialisasinya">Penyakit Dalam dan Subspesialisasinya</option>
                          <option value="Obstetri Ginekologi dan Subspesialisasinya">Obstetri Ginekologi dan Subspesialisasinya</option>
                          <option value="Bedah dan Subspesialisasinya">Bedah dan Subspesialisasinya</option>
                          <option value="Lain-lain">Lain-lain</option>
                        </select>
                      </div>  
                      <div class="form-group col-md-6">
                        <label for="dampak">Dampak / Akibat Insiden Terhadap Pasien* : (lihat Garding Matriks)</label>
                        <select class="custom-select" name="dampak" id="dampak">
                          <option value="<?=$dikp->dampak?>"><?=$dikp->dampak?></option>
                          <option value="Kematian">Kematian</option>
                          <option value="Cedera Irreversibel/Cedera Berat">Cedera Irreversibel/Cedera Berat</option>
                          <option value="Cedera Reversibel/Cedera Ringan">Cedera Reversibel/Cedera Ringan</option>
                          <option value="Cedera Ringan">Cedera Ringan</option>
                          <option value="Tidak Ada Cedera">Tidak Ada Cedera</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="probalitas">Probalitas* : (lihat Garding Matriks)</label>
                        <select class="custom-select" name="probalitas" id="probalitas">
                          <option value="<?=$dikp->probalitas?>"><?=$dikp->probalitas?></option>
                          <option value="Sangat Jarang">Sangat Jarang</option>
                          <option value="Jarang">Jarang</option>
                          <option value="Mungkin">Mungkin</option>
                          <option value="Sering">Sering</option>
                          <option value="Sangat Sering">Sangat Sering</option>
                        </select>
                      </div>  
                      <div class="form-group col-md-6">
                        <label for="pelapor">Orang Pertama Yang Melaporkan Insiden*</label>
                        <select class="custom-select" name="pelapor" id="pelapor">
                          <option value="<?=$dikp->pelapor?>"><?=$dikp->pelapor?></option>
                          <option value="Karyawan : Dokter/Perawat/Petugas Lainnya">Karyawan : Dokter/Perawat/Petugas Lainnya</option>
                          <option value="Pasien">Pasien</option>
                          <option value="Keluarga/Pendamping Pasien">Keluarga/Pendamping Pasien</option>
                          <option value="Pengunjung">Pengunjung</option>
                          <option value="Lain-lain">Lain-lain</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="ins_pas">Insiden Menyangkut Pasien*</label>
                        <select class="custom-select" name="ins_pas" id="ins_pas">
                          <option value="<?=$dikp->ins_pas?>"><?=$dikp->ins_pas?></option>
                          <option value="Pasien Rawat Inap">Pasien Rawat Inap</option>
                          <option value="Pasien Rawat Jalan">Pasien Rawat Jalan</option>
                          <option value="Pasien IGD">Pasien IGD</option>
                          <option value="lain-lain">lain-lain</option>
                        </select>
                      </div>  
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="tempat">Tempat Insiden</label>
                      <input type="text" name="tempat" class="form-control" id="tempat"
												placeholder="Lokasi Kejadian (Tempat Pasien Berada)" value="<?=$dikp->tempat?>">
												<?= form_error('tempat', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="unit_terkait">Unit Terkait Yang Menyebabkan Insiden</label>
                      <input type="text" name="unit_terkait" class="form-control" id="unit_terkait"
												placeholder="Unit Kerja Penyebab" value="<?=$dikp->unit_terkait?>">
												<?= form_error('unit_terkait', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="tindaklanjut">Tindaklanjut yang dilakukan segera setelah kejadian, dan hasilnya</label>
                      <textarea class="form-control" name="tindaklanjut" id="tindaklanjut" value="<?=$dikp->tindaklanjut?>" rows="3" placeholder="Sebutkan . . . " ></textarea>
                      <?= form_error('tindaklanjut', '<small class="text-danger pl-3">', '</small>') ?>
                    </div>  
                    <div class="form-group col-md-4">
                        <label for="stlh_dilaku">Tindaklanjut setelah dilakukan oleh</label>
                        <select class="custom-select" name="stlh_dilaku" id="stlh_dilaku">
                          <option value="<?=$dikp->stlh_dilaku?>"><?=$dikp->stlh_dilaku?></option>
                          <option value="Team">Team</option>
                          <option value="Dokter">Dokter</option>
                          <option value="Perawat">Perawat</option>
                          <option value="Petugas Lainnya">Petugas Lainnya</option>
                        </select>
                      </div>
                      <div class="form-group col-md-8">
                        <label for="prnh_tjd">Apakah kejadian yang sama pernah terjadi di Unit Kerja lain</label>
                        <select class="custom-select" name="prnh_tjd" id="prnh_tjd">
                          <option value="<?=$dikp->prnh_tjd?>"><?=$dikp->prnh_tjd?></option>
                          <option value="Ya">Ya</option>
                          <option value="Tidak">Tidak</option>
                        </select>
                      </div>
                      <div class="form-group col-md-12">
                        <span class="badge text-bg-primary">Apabila Ya, isi bagian dibawah ini.</span>
                        <label for="no_ulang">Kapan ? dan Langkah / Tindakan apa yang telah diambil pada Unit Kerja tersebut untuk mencegah terulangnya kejadian yang sama ?</label>
                        <textarea class="form-control" name="no_ulang" id="no_ulang" value="<?=$dikp->no_ulang?>" rows="3" placeholder="Sebutkan . . . "></textarea>
                        <!-- <?= form_error('no_ulang', '<small class="text-danger pl-3">', '</small>') ?> -->
                      </div>
                      <div class="form-group col-md-3">
                      <label for="petugas">Petugas yang membuat laporan</label>
                        <input type="text" name="petugas" class="form-control"
                          id="petugas" placeholder="Petugas yang membuat laporan" value="<?=$dikp->petugas?>">
                          <?= form_error('petugas', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-3">
                      <label for="karu">Kepala Ruang/Unit/Bidang</label>
                        <input type="text" name="karu" class="form-control"
                          id="karu" placeholder="Kepala Ruang/Unit/Bidang" value="<?=$dikp->karu?>">
                          <?= form_error('karu', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-3">
                      <label for="kmrkp">Ketua KMRKP</label>
                        <input type="text" name="kmrkp" class="form-control"
                          id="kmrkp" placeholder="Ketua KMRKP" value="<?=$dikp->kmrkp?>">
                          <?= form_error('kmrkp', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-3">
                      <label for="direktur">Direktur</label>
                        <input type="text" name="direktur" class="form-control"
                          id="direktur" placeholder="Direktur"  value="<?=$dikp->direktur?>">
                          <?= form_error('direktur', '<small class="text-danger pl-3">', '</small>') ?>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="grad_res"><b>Grading Resiko Kejadian*</b> (Diisi oleh atasan pelapor)</label>
                        <select class="custom-select" name="grad_res" id="grad_res">
                          <option value="<?=$dikp->grad_res?>"><?=$dikp->grad_res?></option>
                          <option value="BIRU">BIRU</option>
                          <option value="HIJAU">HIJAU</option>
                          <option value="KUNING">KUNING</option>
                          <option value="MERAH">MERAH</option>
                        </select>
                        <span class="badge text-bg-danger">NB * : Pilih satu jawaban</span></br>
                        <span class="badge text-bg-primary">Tipe Insiden : diisi setelah dilakukan investigasi.</span>
                      </div>
                    </div>
                    <?php } ?>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <a type="submit" class="btn btn-warning" onclick="history.back(-1)" name="btn_kembali"><i
                          class="far fa-arrow-alt-circle-left"></i> Kembali</a>
                      <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                      <a type="submit" class="btn btn-primary center-block" href="<?=base_url('admin/tabel_ikp')?>"
                        name="btn_listikp"><i class="fa fa-table" aria-hidden="true"></i> List Data IKP</a>
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
