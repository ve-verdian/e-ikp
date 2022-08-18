<?php 
$ikp = $this->db->query("SELECT * FROM tb_ikp WHERE id_ikp LIMIT 1")->row();
?>

<html>
<head>
<title><?= $title; ?></title>
<link rel="shortcut icon" href="<?=base_url('assets/img/rsia_family.jpeg')?>">
<style type="text/css" media="print">
	/* table {border: solid 1px #000; border-collapse: collapse; width: 100%} */
	tr { border: solid 1px #000}
	td { padding: 7px 5px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<style type="text/css" media="screen">
	table {border: solid 1px #000; border-collapse: collapse; width: 60%}
	tr { border: solid 1px #000}
	td { padding: 7px 5px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
</head>

<body onload="window.print()">
<table>
	<section>
	<tr><td colspan="3" align="center"><b style="font-size: 18px;">FORMULIR LAPORAN INSIDEN KESELAMATAN PASIEN (IKP)<br/>
		INTERNAL KE KMRKP (SUB KOM KESELAMATAN PASIEN)</b></td></tr>
	</section>
	
	<tr><td colspan="3" align="center"><img src="<?=base_url('assets/img/family.jpg')?>" class="img-fluid" alt="...">
	</b></td></tr>

	<section>
	<tr><td colspan="3" align="center"><span style="font-size: 14px;">RAHASIA, TIDAK BOLEH DI FOTOCOPY, DILAPORKAN MAXIMAL, 2X24 JAM</span></td></tr>
	</section>
	
	<section>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">I. DATA KARAKTERISTIK PASIEN</b></td></tr>	
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?php echo $ikp->nama; ?></td></tr>
	<!-- <tr><td><b>N I P <td width="10%">:</b> <?php echo $data->no_surat; ?></td></tr> -->
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. MR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $ikp->no_mr; ?></td><td><b>Ruangan : </b><?php echo $ikp->ruangan; ?></td></tr>
	<!-- <tr><td><b>Jabatan <td width="10%">:</b> <?php echo $data->isi_ringkas; ?></td></tr> -->
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Umur &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $ikp->umur; ?>&nbsp;Tahun</td></tr>
	<!-- <tr><td><b>No. HP <td width="10%">:</b> </td></tr> -->
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penanggung &nbsp;&nbsp;&nbsp;:</b> <?php echo $ikp->biaya; ?></td></tr>
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis Kelamin :</b> <?php echo $ikp->jk; ?></td></tr>
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?php echo $ikp->tanggal_1; ?></td><td><b>Pukul : </b><?php echo $ikp->waktu_1; ?> <b>WIB</b></td></tr>
	</section>

	<section>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">II. RINCIAN KEJADIAN</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">1. Tanggal dan Waktu Insiden</b></td></tr>		
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $ikp->tanggal_2; ?></td><td><b>Pukul : </b><?php echo $ikp->waktu_2; ?> <b>WIB</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">2. Insiden : </b> <?php echo $ikp->insiden; ?></td></tr>	
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">3. Kronologi Insiden : </b><?php echo $ikp->kronologi; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">4. Jenis Insiden* </b>: <?php echo $ikp->jns_insiden; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">5. Insiden terjadi pada pasien*</b>(sesuai kasus penyakit/spesialisasi) : <?php echo $ikp->ins_tjd; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">6. Dampak / Akibat Insiden Terhadap Pasien* </b></b>(lihat Grading Matriks) : <?php echo $ikp->dampak; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">7. Probalitas* </b>(lihat Grading Matriks) : <?php echo $ikp->probalitas; ?></td> </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">8. Orang Pertama Yang Melaporkan Insiden* :</b> <?php echo $ikp->pelapor; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">9. Insiden Menyangkut Pasien* :</b> <?php echo $ikp->ins_pas; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">10. Tempat Insiden</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi kejadian :</b> <?php echo $ikp->tempat; ?></td> </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">11. Unit terkait yang menyebabkan insiden</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit kerja penyebab :</b> <?php echo $ikp->unit_terkait; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">12. Tindak lanjut yang dilakukan segera setelah kejadian, dan hasilnya :</b> <?php echo $ikp->tindaklanjut; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">13. Tindak lanjut setelah insiden dilakukan oleh* :</b> <?php echo $ikp->stlh_dilaku; ?></td> </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">14. Apakah kejadian yang sama pernah terjadi di Unit Kerja Lain?* :</b> <?php echo $ikp->prnh_tjd; ?></td></tr>
    <tr><td colspan="3" align="left"><span style="font-size: 14px;">Apabila Ya, isi pada bagian dibawah ini</span></td></tr>
    <tr><td colspan="3" align="left"><b style="font-size: 14px;">Kapan ? dan Langkah / Tindakan apa yang telah diambil pada unit kerja tersebut untuk mencegah terulangnya kejadian yang sama ?</b> <?php echo $ikp->no_ulang; ?></td></tr>
	</section>

	<tr><td valign="top" style="text-align: left;">&nbsp;&nbsp;&nbsp;
		Jakarta, <?=date('d-m-Y', strtotime($ikp->tanggal_1))?> Pukul : <?php echo $ikp->waktu_1; ?> WIB
	</td>
	<td valign="top">
		Jakarta, <?=date('d-m-Y', strtotime($ikp->tanggal_2))?> Pukul : <?php echo $ikp->waktu_1; ?> WIB
	</td></tr>
	<tr><td valign="top">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Petugas,<br><br><br><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i>Nama & Tanda Tangan</b><br><br><br>
	</b></td>
    <td valign="top" width="50%">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Ruangan/Unit/Bidang,<br><br><br><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<i>Nama & Tanda Tangan
	</td></tr>
	<tr><td valign="top" style="text-align: left;">&nbsp;&nbsp;&nbsp;
		Jakarta, <?=date('d-m-Y', strtotime($ikp->tanggal_1))?> Pukul : <?php echo $ikp->waktu_1; ?> WIB
	</td>
	<td valign="top">
		Jakarta, <?=date('d-m-Y', strtotime($ikp->tanggal_1))?> Pukul : <?php echo $ikp->waktu_1; ?> WIB
	</td></tr>
    <tr><td valign="top" width="50%">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketua KMRKP,<br><br><br><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Nama & Tanda Tangan
	</td>
    <td valign="top" width="50%">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direktur,<br><br><br><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Nama & Tanda Tangan
	</td>
    </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">Grading Resiko Kejadian* </b>(Diisi oleh atasan pelapor) : <?php echo $ikp->grad_res; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">* : Pilih salah satu jawaban</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">Tipe Insiden : Diisi setelah dilakukan Investigasi</b></td></tr>
</table>
</body>
</html>