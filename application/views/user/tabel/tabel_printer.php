<br><br>
<div class="container text-center" style="margin: 2em auto;">
  <h2 class="tex-center">Data Printer</h2>
  <table class="table table-responsive table-bordered table-striped" style="margin: 2em auto;" id="tabel_printer">
    <thead>
      <tr>
        <th width="5%"><center>No</th>
        <th width="15%"><center>Tgl Input</th>
        <th width="15%"><center>Kategori</th>
				<th width="25%"><center>Merk</th>
        <th width="25%"><center>Type</th>
				<th width="15%"><center>Serial Number</th>
        <th width="15%"><center>Qty Out</th>
				<!-- <th width="15%"><center>Capacity (VA)</th> -->
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
					<!-- <td width="15%"><center><?=$dd->capacity?></td> -->
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
  $('#tabel_printer').DataTable();
});
</script>