<br><br>
<div class="container text-center" style="margin: 2em auto;">
  <h2 class="tex-center">Data Komputer</h2>
  <table class="table table-responsive table-bordered table-striped" style="margin: 2em auto;" id="tabel_komputer">
    <thead>
      <tr>
        <th width="5%"><center>No</th>
        <th width="15%"><center>Tgl Input</th>
        <th width="15%"><center>Dept / Divisi</th>
				<th width="15%"><center>Hostname</th>
        <th width="15%"><center>User</th>
				<th width="8%"><center>Jenis</th>
        <th width="12%"><center>Harddisk</th>
				<th width="10%"><center>RAM</th>
        <th width="25%"><center>Processor</th>
				<th width="25%"><center>Operating System</th>
        <th width="15%"><center>IP Address</th>
				<th width="10%"><center>Lokasi</th>
        <th width="8%"><center>Internet</th>
				<th width="8%"><center>Lokal</th>
        <th width="8%"><center>SIM-RS</th>
				<th width="10%"><center>Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php if(is_array($list_data)){ ?>
        <?php $no = 1;?>
        <?php foreach($list_data as $dd): ?>
          <td width="5%"><center><?=$no?></td>
          <td width="15%"><center><?=date('d-m-Y', strtotime($dd->tgl_input))?></td>
          <td width="15%"><?=$dd->divisi?></td>
					<td width="15%"><?=$dd->hostname?></td>
          <td width="15%"><?=$dd->user?></td>
					<td width="8%"><center><?=$dd->jenis?></td>
          <td width="12%"><center><?=$dd->hard_disk?></td>
					<td width="10%"><center><?=$dd->ram?></td>
          <td width="25%"><center><?=$dd->processor?></td>
					<td width="25%"><center><?=$dd->os?></td>
          <td width="15%"><?=$dd->ip_address?></td>
					<td width="10%"><center><?=$dd->lokasi?></td>
          <td width="8%"><center><?=$dd->internet?></td>
					<td width="8%"><center><?=$dd->lokal?></td>
          <td width="8%"><center><?=$dd->simrs?></td>
					<td width="10%"><center><?=$dd->status?></td>
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
  $('#tabel_komputer').DataTable();
});
</script>