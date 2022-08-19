<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>FORMULIR IKP</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/checkout/">
    <link href="<?= base_url(); ?>/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .body {
            background-image: url("/assets/img/fam.jpg");
            background-repeat: no-repeat;
            background-size:cover
          }
          
    </style>

    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
<div class="container">
  <main>
    <div class="py-3 text-center">
      <img class="d-block mx-auto mb-4" src="<?= base_url(); ?>/assets/img/rsia_family.jpeg" alt="" width="72" height="72">
      <h2><b>SILAHKAN ISI FORMULIR DIBAWAH INI</b></h2> 
    </div>
    <div class="card card-danger">
    <div class="card-body">
      <div class="col-md-11 col-lg-12">
      <form class="form-horizontal" action="<?=base_url('user/proses_ikp_insert')?>" role="form" method="post">
          <?php if($this->session->flashdata('msg_berhasil')){ ?>
            <div class="alert alert-success alert-dismissible" style="width:91%">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong><br> <?= $this->session->flashdata('msg_berhasil');?>
            </div>
          <?php } ?>
        <h4 class="mb-3"><b>I. DATA KARAKTERISTIK PASIEN</h4>
        
          <div class="row g-3">
            <div class="form-group col-md-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" name="nama" class="form-control"
                id="nama" placeholder="Nama" tabindex="1">
                <?= form_error('nama', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-2">
              <label for="no_mr" class="form-label">No. MR</label>
              <input type="number" name="no_mr" class="form-control"
              id="no_mr" placeholder="No. MR" tabindex="2">
              <?= form_error('no_mr', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-2">
              <label for="ruangan" class="form-label">Ruangan</label>
              <input type="text" name="ruangan" class="form-control"
              id="ruangan" placeholder="Ruangan" tabindex="3">
              <?= form_error('ruangan', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-2">
              <label for="umur" class="form-label">Umur</label>
              <input type="text" name="umur" class="form-control"
              id="umur" placeholder="Umur" tabindex="4">
              <?= form_error('umur', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-3">
              <label for="biaya" class="form-label">Penanggung Biaya Pasien</label>
                <select class="form-select" id="biaya" required>
                  <option value="" selected="">-- Pilih --</option>
                  <option value="BPJS">BPJS</option>
                  <option value="Jamkesda">Jamkesda</option>
                  <option value="Umum/Pribadi">Umum/Pribadi</option>
                  <option value="Asuransi Swasta">Asuransi Swasta</option>
                  <option value="Pemerintah">Pemerintah</option>
                  <option value="Lain-lain">Lain-lain</option>
              </select>
            </div>

            <div class="form-group col-md-3">
              <label for="jk" class="form-label">Jenis Kelamin</label>
              <select class="form-select" id="jk" required>
                <option value="" selected="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="tanggal_1" class="form-label">Tanggal Mendapatkan Pelayanan</label>
              <input type="date" name="tanggal_1"  class="form-control"
							id="tanggal_1" placeholder="Tanggal Mendapatkan Pelayanan" tabindex="7">
							<?= form_error('tanggal_1', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-2">
              <label for="waktu_1" class="form-label">Pukul</label>
              <input type="time" name="waktu_1"  class="form-control"
							id="waktu_1" placeholder="Pukul" tabindex="8">
							<?= form_error('waktu_1', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
          </div>
          <hr class="my-4">

          <h4 class="mb-3"><b>II. RINCIAN KEJADIAN</h4>
          <div class="row g-3">
            <div class="form-group col-md-3">
              <label for="tanggal_2" class="form-label">Tanggal dan Waktu Insiden</label>
              <input type="date" name="tanggal_2"  class="form-control"
							id="tanggal_2" placeholder="Tanggal" tabindex="7">
							<?= form_error('tanggal_2', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-2">
              <label for="waktu_2" class="form-label">Pukul</label>
              <input type="time" name="waktu_2"  class="form-control"
							id="waktu_2" placeholder="Pukul" tabindex="8">
							<?= form_error('waktu_2', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-3">
              <label for="cc-insiden" class="form-label">Insiden</label>
              <input type="text" name="insiden" class="form-control"
              id="insiden" placeholder="Insiden" tabindex="11">
              <?= form_error('insiden', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-4">
              <label for="kronologi" class="form-label">Kronologi</label>
              <input type="text" class="form-control" name="kronologi" id="kronologi" rows="3" placeholder="Sebutkan . . . " tabindex="12">
                        <?= form_error('kronologi', '<small class="text-danger pl-3">', '</small>') ?> 
            </div>

            <div class="form-group col-md-4">
              <label for="cc-expiration" class="form-label">Jenis Insiden*</label>
                <select class="form-select" name="jns_insiden" id="jns_insiden" tabindex="13">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Kejadian Nyaris Cedera/KNC (Near Miss)">Kejadian Nyaris Cedera/KNC (Near Miss)</option>
                  <option value="Kejadian Tidak diharapakan/KTD (Adverse Event)">Kejadian Tidak diharapakan/KTD (Adverse Event)</option>
                  <option value="Kejadian Sentinel (Sentinel Event)">Kejadian Sentinel (Sentinel Event)</option>
                  <option value="Kejadian Tidak Cedera (KTC)">Kejadian Tidak Cedera (KTC)</option>
                  <option value="Kejadian Potensial Cedera Serius/KPC (Significant)">Kejadian Potensial Cedera Serius/KPC (Significant)</option>
                </select>
            </div>

            <div class="form-group col-md-8">
              <label for="cc-cvv" class="form-label">Insiden terjadi pada pasien* : (sesuai kasus penyakit/spesialisasi)</label>
                <select class="form-select" name="ins_tjd" id="ins_tjd" tabindex="14">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Anak dan Subspesialisasinya">Anak dan Subspesialisasinya</option>
                  <option value="Penyakit Dalam dan Subspesialisasinya">Penyakit Dalam dan Subspesialisasinya</option>
                  <option value="Obstetri Ginekologi dan Subspesialisasinya">Obstetri Ginekologi dan Subspesialisasinya</option>
                  <option value="Bedah dan Subspesialisasinya">Bedah dan Subspesialisasinya</option>
                  <option value="Lain-lain">Lain-lain</option>
                </select>
            </div>

            <div class="form-group col-md-8">
              <label for="dampak" class="form-label">Dampak / Akibat Insiden Terhadap Pasien* : (lihat Garding Matriks)</label>
                <select class="form-select" name="dampak" id="dampak" tabindex="15">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Kematian">Kematian</option>
                  <option value="Cedera Irreversibel/Cedera Berat">Cedera Irreversibel/Cedera Berat</option>
                  <option value="Cedera Reversibel/Cedera Ringan">Cedera Reversibel/Cedera Ringan</option>
                  <option value="Cedera Ringan">Cedera Ringan</option>
                  <option value="Tidak Ada Cedera">Tidak Ada Cedera</option>
                </select>
            </div>

            <div class="form-group col-md-4">
              <label for="probalitas" class="form-label">Probalitas* : (lihat Garding Matriks)</label>
                <select class="form-select" name="probalitas" id="probalitas" tabindex="16">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Sangat Jarang">Sangat Jarang</option>
                  <option value="Jarang">Jarang</option>
                  <option value="Mungkin">Mungkin</option>
                  <option value="Sering">Sering</option>
                  <option value="Sangat Sering">Sangat Sering</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label for="pelapor" class="form-label">Orang Pertama Yang Melaporkan Insiden*</label>
                <select class="form-select" name="pelapor" id="pelapor" tabindex="17">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Karyawan : Dokter/Perawat/Petugas Lainnya">Karyawan : Dokter/Perawat/Petugas Lainnya</option>
                  <option value="Pasien">Pasien</option>
                  <option value="Keluarga/Pendamping Pasien">Keluarga/Pendamping Pasien</option>
                  <option value="Pengunjung">Pengunjung</option>
                  <option value="Lain-lain">Lain-lain</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label for="ins_pas" class="form-label">Insiden Menyangkut Pasien*</label>
                <select class="form-select" name="ins_pas" id="ins_pas" tabindex="18">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Pasien Rawat Inap">Pasien Rawat Inap</option>
                  <option value="Pasien Rawat Jalan">Pasien Rawat Jalan</option>
                  <option value="Pasien IGD">Pasien IGD</option>
                  <option value="lain-lain">lain-lain</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label for="tempat" class="form-label">Lokasi Kejadian (Tempat Pasien Berada)</label>
              <input type="text" name="tempat" class="form-control" id="tempat"
							placeholder="Lokasi Kejadian (Tempat Pasien Berada)" tabindex="19">
							<?= form_error('tempat', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-6">
              <label for="unit_terkait" class="form-label">Unit Kerja Penyebab</label>
              <input type="text" name="unit_terkait" class="form-control" id="unit_terkait"
							placeholder="Unit Kerja Penyebab" tabindex="20">
							<?= form_error('unit_terkait', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
       

          <div class="form-group col-md-6">
              <label for="tindaklanjut" class="form-label">Tindaklanjut yang dilakukan segera setelah kejadian, dan hasilnya</label>
              <input type="text" class="form-control" name="tindaklanjut" id="tindaklanjut" rows="3" placeholder="Sebutkan . . . " tabindex="21">
              <?= form_error('tindaklanjut', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
        

          <div class="form-group col-md-6">
              <label for="stlh_dilaku" class="form-label">Tindaklanjut setelah dilakukan oleh</label>
                <select class="form-select" name="stlh_dilaku" id="stlh_dilaku" tabindex="22">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Team">Team</option>
                  <option value="Dokter">Dokter</option>
                  <option value="Perawat">Perawat</option>
                  <option value="Petugas Lainnya">Petugas Lainnya</option>
                </select>
            </div>

            <div class="form-group col-md-6">
              <label for="prnh_tjd" class="form-label">Apakah kejadian yang sama pernah terjadi di Unit Kerja lain ?</label>
                <select class="form-select" name="prnh_tjd" id="prnh_tjd" tabindex="23">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="Ya">Ya</option>
                  <option value="Tidak">Tidak</option>
                </select>
                <span class="badge text-bg-primary">Apabila Ya, isi bagian dibawah ini.</span>
            </div>

            <div class="form-group col-md-12">
              <label for="no_ulang" class="form-label">Kapan ? dan Langkah / Tindakan apa yang telah diambil pada Unit Kerja tersebut untuk mencegah terulangnya kejadian yang sama ?</label>
              <input type="text" class="form-control" name="no_ulang" id="no_ulang" rows="3" placeholder="Sebutkan . . . " tabindex="24">
              <?= form_error('no_ulang', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-3">
              <label for="petugas" class="form-label">Petugas yang membuat laporan</label>
              <input type="text" name="petugas" class="form-control"
              id="petugas" placeholder="Petugas yang membuat laporan" tabindex="25">
              <?= form_error('petugas', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-3">
              <label for="karu" class="form-label">Kepala Ruang/Unit/Bidang</label>
              <input type="text" name="karu" class="form-control"
              id="karu" placeholder="Kepala Ruang/Unit/Bidang" tabindex="26">
              <?= form_error('karu', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-3">
              <label for="kmrkp" class="form-label">Ketua KMRKP</label>
              <input type="text" name="kmrkp" class="form-control"
              id="kmrkp" placeholder="Ketua KMRKP" tabindex="27">
              <?= form_error('kmrkp', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-3">
              <label for="direktur" class="form-label">Direktur</label>
              <input type="text" name="direktur" class="form-control"
              id="direktur" placeholder="Direktur" tabindex="28">
              <?= form_error('direktur', '<small class="text-danger pl-3">', '</small>') ?>
            </div>

            <div class="form-group col-md-6">
              <label for="grad_res" class="form-label"><b>Grading Resiko Kejadian*</b> (Diisi oleh atasan pelapor)</label>
                <select class="form-select" name="grad_res" id="grad_res" tabindex="29">
                  <option value="" selected="">-- Pilih --</option>
                  <option value="BIRU">BIRU</option>
                  <option value="HIJAU">HIJAU</option>
                  <option value="KUNING">KUNING</option>
                  <option value="MERAH">MERAH</option>
                </select>
                <span class="badge text-bg-danger">NB * : Pilih salah satu jawaban.</span></br>
                <span class="badge text-bg-primary">Tipe Insiden : Diisi setelah dilakukan investigasi.</span>
            </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-success" tabindex="30"><i class="far fa-save" aria-hidden="true"></i>Simpan</button>
            <a type="submit" href="<?=base_url('user/')?>" class="btn btn-warning" onclick="history.back(-1)" name="btn_kembali"><i class="far fa-arrow-alt-circle-left" aria-hidden="true"></i> Kembali</a>
            <a type="submit" href="<?=base_url('user/tabel_ikp')?>" class="btn btn-danger" onclick="history.back(-1)" name="btn_kembali"><i class="far fa-arrow-alt-circle-left" aria-hidden="true"></i> List IKP</a>
          </div>
        </form>
      </div>
    </div>
    </div>
  </main>
</div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="form-validation.js"></script>
  </body>
</html>
