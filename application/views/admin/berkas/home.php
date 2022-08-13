<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin/_layouts/header.php") ?>
	<div class="wrapper">

		
	<?php
	if(!isset($page)){
		$this->load->view('admin/berkas/daftar_file');
	} else{
		$this->load->view($page);
	}
	?>

	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.js"></script>

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
    });
  });
</script>
</body>
</html>
