<br><br>
<div class="container text-center" style="margin: 2em auto;">
  <h2 class="tex-center">Data Barang Masuk</h2>
  <table class="table table-bordered table-striped" style="margin: 2em auto;" id="tabel_barangmasuk">
    <thead>
      <tr>
        <th width="5%">
          <center>No
        </th>
        <!-- <th>ID_Transaksi</th> -->
        <th width="5%">
          <center>Tanggal
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
          <center>Satuan
        </th>
        <th width="5%">
          <center>Jumlah
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php if(is_array($list_data)){ ?>
        <?php $no = 1;?>
        <?php foreach($list_data as $dd): ?>
        <td><?=$no?></td>
        <!-- <td><?=$dd->id_transaksi?></td> -->
        <td><?=$dd->tanggal?></td>
        <td><?=$dd->divisi?></td>
        <td><?=$dd->kode_barang?></td>
        <td><?=$dd->nama_barang?></td>
        <td><?=$dd->satuan?></td>
        <td><?=$dd->jumlah?></td>
      </tr>
      <?php $no++; ?>
      <?php endforeach;?>
      <?php }else { ?>
      <td colspan="7" align="center"><strong>Data Kosong</strong></td>
      <?php } ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
$(document).ready(function() {
  $('#tabel_barangmasuk').DataTable();
});
</script>
