<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>FORMULIR IKP</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

<style>
   /* body {
     background-color: #f9f9fa
 }

 .flex {
     -webkit-box-flex: 1;
     -ms-flex: 1 1 auto;
     flex: 1 1 auto
 }

 @media (max-width:991.98px) {
     .padding {
         padding: 1.5rem
     }
 }

 @media (max-width:767.98px) {
     .padding {
         padding: 1rem
     }
 }

 .padding {
     padding: 5rem
 }

 .card {
     box-shadow: none;
     -webkit-box-shadow: none;
     -moz-box-shadow: none;
     -ms-box-shadow: none
 }

 .pl-3,
 .px-3 {
     padding-left: 1rem !important
 }

 .card {
     position: relative;
     display: flex;
     flex-direction: column;
     min-width: 0;
     word-wrap: break-word;
     background-color: #fff;
     background-clip: border-box;
     border: 1px solid #d2d2dc;
     border-radius: 0
 }
 
 .card .card-title {
    color: #000000;
    margin-bottom: 0.625rem;
    text-transform: capitalize;
    font-size: 0.875rem;
    font-weight: 500;
}

.card .card-description {
    margin-bottom: .875rem;
    font-weight: 400;
    color: #76838f;
}

p {
    font-size: 0.875rem;
    margin-bottom: .5rem;
    line-height: 1.5rem;
}

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table, .jsgrid .jsgrid-table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 1rem;
    background-color: transparent;
}

.table thead th, .jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: 500;
    font-size: .875rem;
    text-transform: uppercase;
}

.table td, .jsgrid .jsgrid-table td {
    font-size: 0.875rem;
    padding: .875rem 0.9375rem;
}

.badge {
    border-radius: 0;
    font-size: 12px;
    line-height: 1;
    padding: .375rem .5625rem;
    font-weight: normal;
} */
 
</style>
<div class="page-content page-container" id="page-content">
  <div class="padding">
    <!-- <div class="row container d-flex justify-content-center"> -->

<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
      <div class="card-body shadow">
                <div class="card-header">
              <h3><b>Laporan Insiden Keselamatan Pasien</b></h3> 

              <?php if($this->session->flashdata('msg_berhasil')){ ?>
                <div class="alert alert-success alert-dismissible" style="width:100%">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong><br> <?= $this->session->flashdata('msg_berhasil');?>
               	</div>
              <?php } ?>

            <a type="submit" href="<?=base_url('user/ikp')?>" class="btn btn-warning" name="btn_kembali"><i class="far fa-arrow-alt-circle-left" aria-hidden="true"></i> Kembali</a>
            </div>
                  <div class="table-responsive">
                  <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
									<th width="5%"><center>No</th>
                  <th width="15%"><center>Nama</th>
                  <th width="15%"><center>No. MR</th>
									<th width="15%"><center>Ruangan</th>
                  <th width="15%"><center>Umur</th>
									<th width="15%"><center>Penanggung Biaya Pasien</th>
                  <th width="8%"><center>Jenis Kelamin</th>
									<th width="15%"><center>Tanggal Mendapatkan Pelayanan</th>
                  <th width="8%"><center>Pukul</th>
                  <th width="15%"><center>Tanggal & Waktu Insiden</th>
                  <th width="8%"><center>Pukul</th>
									<th width="15%"><center>Insiden</th>
                  <th width="15%"><center>kronologi</th>
                  <th width="8%"><center>Jenis Insiden*</th>
									<th width="12%"><center>Insiden terjadi pada pasien*</th>
                  <th width="10%"><center>Dampak / Akibat Insiden</th>
									<th width="15%"><center>Probalitas*</th>
                  <th width="15%"><center>Orang Pertama Yang Melaporkan Insiden*</th>
									<th width="15%"><center>Insiden Menyangkut Pasien*</th>
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
                  <th width="15%"><center>Cetak</th>
									<!-- <th width="15%"><center>Update</th> -->
									<!-- <th width="15%"><center>Hapus</th> -->
                </tr>
                </thead>
                <tbody>
                <tr>
								<?php if(is_array($list_data)){ ?>
                  <?php $no = 1;?>
                  <?php foreach($list_data as $dd): ?>
                    <td width="5%"><center><?=$no?></td>
                    <td width="15%"><center><?=$dd->nama?></td>
										<td width="15%"><center><?=$dd->no_mr?></td>
                    <td width="15%"><center><?=$dd->ruangan?></td>
                    <td width="15%"><center><?=$dd->umur?></td>
                    <td width="15%"><center><?=$dd->biaya?></td>
                    <td width="8%"><center><?=$dd->jk?></td>
                    <td width="10%"><center><?=date('d-m-Y', strtotime($dd->tanggal_1))?></td>
                    <td width="8%"><center><?=$dd->waktu_1?></td>
                    <td width="10%"><center><?=date('d-m-Y', strtotime($dd->tanggal_2))?></td>
                    <td width="8%"><center><?=$dd->waktu_2?></td>
                    <td width="15%"><center><?=$dd->insiden?></td>
										<td width="15%"><center><?=$dd->kronologi?></td>
										<td width="8%"><center><?=$dd->jns_insiden?></td>
                    <td width="12%"><center><?=$dd->ins_tjd?></td>
										<td width="10%"><center><?=$dd->dampak?></td>
                    <td width="15%"><center><?=$dd->probalitas?></td>
										<td width="15%"><center><?=$dd->pelapor?></td>
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
                    <td width="15%"><center><a type="button" class="btn btn-warning center-block" href="<?=base_url('admin/ikp_print/'.$dd->id_ikp)?>" target="_BLANK" name="btn_cetak" style="margin:auto;"><i class="fas fa-print" aria-hidden="true"></i></a></td>
										<!-- <td width="15%"><center><a type="button" class="btn btn-success center-block" href="<?=base_url('admin/update_ikp/'.$dd->id_ikp)?>" name="btn_update" style="margin:auto;"><i class="fas fa-edit" aria-hidden="true"></i></a></td> -->
										<!-- <td width="15%"><center><a type="button" class="btn btn-danger btn-delete center-block"  href="<?=base_url('admin/delete_ikp/'.$dd->id_ikp)?>" name="btn_delete" style="margin:auto;"><i class="fa fa-trash" aria-hidden="true"></i></a></td> -->
                </tr>
									<?php $no++; ?>
									<?php endforeach;?>
									<?php }else { ?>
												<td colspan="7" align="center"><strong>Data Kosong</strong></td>
									<?php } ?>
                </tbody>
              </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" rel="stylesheet"></script>
      <script href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" rel="stylesheet"></script>

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
              </script>

              <script>
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