<br><br>
<div class="container text-center" style="margin: 2em auto;">
  <h2 class="tex-center">Data Barang Keluar</h2>
  <!-- <a href="<?=base_url('report/barangKeluarManual')?>" style="margin-bottom:10px;float:left;" type="button" class="btn btn-danger" name="laporan_data"><i class="fa fa-file-text" aria-hidden="true"></i> Invoice Manual</a> -->
  <!-- <div class="tabel" style="margin-top:80px"> -->
    <table class="table table-bordered table-striped" style="margin: 2em auto;" id="tabel_barangkeluar">
      <thead>
        <tr>
          <th width="5%">
            <center>No
          </th>
          <!-- <th>ID Transaksi</th> -->
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
          <!-- <th>Satuan</th> -->
          <th width="5%">
            <center>Jumlah
          </th>
          <th width="20%">
            <center>Unit Order
          </th>
          <!-- <th>Invoice</th> -->
          <!-- <th></th> -->
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php if(is_array($list_data)){ ?>
          <?php $no = 1;?>
          <?php foreach($list_data as $dd): ?>
          <td><?=$no?></td>
          <!-- <td><?=$dd->id_transaksi?></td> -->
          <td><?=$dd->tanggal_masuk?></td>
          <td><?=$dd->tanggal_keluar?></td>
          <td><?=$dd->divisi?></td>
          <td><?=$dd->kode_barang?></td>
          <td><?=$dd->nama_barang?></td>
          <!-- <td><?=$dd->satuan?></td> -->
          <td><?=$dd->jumlah?></td>
          <td><?=$dd->unit_order?></td>
          <!-- <td><a type="button" class="btn btn-danger btn-report"  href="<?=base_url('report/barangKeluar/'.$dd->id_transaksi.'/'.$dd->tanggal_keluar)?>" name="btn_report" style="margin:auto;"><i class="fa fa-file-text" aria-hidden="true"></i></a></td> -->
        </tr>
        <?php $no++; ?>
        <?php endforeach;?>
        <?php }else { ?>
        <td colspan="7" align="center"><strong>Data Kosong</strong></td>
        <?php } ?>
      </tbody>
    </table>
  <!-- </div> -->
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#tabel_barangkeluar').DataTable();
});
</script>
