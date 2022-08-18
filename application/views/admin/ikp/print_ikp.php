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
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b><?php echo $list_data->nama; ?></td></tr>
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. MR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $list_data->no_mr; ?></td><td><b>Ruangan : </b><?php echo $list_data->ruangan; ?></td></tr>
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Umur &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $list_data->umur; ?>&nbsp;Tahun</td></tr>
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Penanggung Biaya Pasien &nbsp;:</b> <?php echo $list_data->biaya; ?></td></tr>
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?php echo $list_data->jk; ?></td></tr>
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal Mendapatkan Pelayanan : </b><?=date('d-m-Y', strtotime($list_data->tanggal_1))?></td><td><b>Pukul : </b><?php echo $list_data->waktu_1; ?> <b>WIB</b></td></tr>
	</section>

	<section>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">II. RINCIAN KEJADIAN</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">1. Tanggal dan Waktu Insiden</b></td></tr>		
	<tr><td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> <?=date('d-m-Y', strtotime($list_data->tanggal_2))?></td><td><b>Pukul : </b><?php echo $list_data->waktu_2; ?> <b>WIB</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">2. Insiden : </b> <?php echo $list_data->insiden; ?></td></tr>	
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">3. Kronologi Insiden : </b><?php echo $list_data->kronologi; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">4. Jenis Insiden* </b>: <?php echo $list_data->jns_insiden; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">5. Insiden terjadi pada pasien*</b>(sesuai kasus penyakit/spesialisasi) : <?php echo $list_data->ins_tjd; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">6. Dampak / Akibat Insiden Terhadap Pasien* </b></b>(lihat Grading Matriks) : <?php echo $list_data->dampak; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">7. Probalitas* </b>(lihat Grading Matriks) : <?php echo $list_data->probalitas; ?></td> </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">8. Orang Pertama Yang Melaporkan Insiden* :</b> <?php echo $list_data->pelapor; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">9. Insiden Menyangkut Pasien* :</b> <?php echo $list_data->ins_pas; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">10. Tempat Insiden</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi kejadian :</b> <?php echo $list_data->tempat; ?></td> </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">11. Unit terkait yang menyebabkan insiden</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit kerja penyebab :</b> <?php echo $list_data->unit_terkait; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">12. Tindak lanjut yang dilakukan segera setelah kejadian, dan hasilnya :</b> <?php echo $list_data->tindaklanjut; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">13. Tindak lanjut setelah insiden dilakukan oleh* :</b> <?php echo $list_data->stlh_dilaku; ?></td> </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">14. Apakah kejadian yang sama pernah terjadi di Unit Kerja Lain?* :</b> <?php echo $list_data->prnh_tjd; ?></td></tr>
    <tr><td colspan="3" align="left"><span style="font-size: 14px;">Apabila Ya, isi pada bagian dibawah ini</span></td></tr>
    <tr><td colspan="3" align="left"><b style="font-size: 14px;">Kapan ? dan Langkah / Tindakan apa yang telah diambil pada unit kerja tersebut untuk mencegah terulangnya kejadian yang sama ?</b> <?php echo $list_data->no_ulang; ?></td></tr>
	</section>

	<section>
	<tr><td valign="top" style="text-align: left;">&nbsp;&nbsp;&nbsp;
		Jakarta, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pukul : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WIB
	</td>
	<td valign="top">
		Jakarta, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pukul : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WIB
	</td></tr>
	<tr><td valign="top">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Petugas,<br><br><br><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i>Nama & Tanda Tangan</i>
	</b></td>
    <td valign="top">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Ruangan/Unit/Bidang,<br><br><br><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i>Nama & Tanda Tangan</i>
	</td>			
	<tr><td valign="top" style="text-align: left;">&nbsp;&nbsp;&nbsp;
		Jakarta, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pukul : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WIB
	</td>
	<td valign="top">
		Jakarta, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pukul : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; WIB
	</td></tr>
    <tr><td valign="top">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ketua KMRKP,<br><br><br><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Nama & Tanda Tangan</i>
	</td>
    <td valign="top">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Direktur,<br><br><br><br><br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(___________________)<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Nama & Tanda Tangan</i>
	</td>
    </tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">Grading Resiko Kejadian* </b>(Diisi oleh atasan pelapor) : <?php echo $list_data->grad_res; ?></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">* : Pilih salah satu jawaban</b></td></tr>
	<tr><td colspan="3" align="left"><b style="font-size: 14px;">Tipe Insiden : Diisi setelah dilakukan Investigasi</b></td></tr>
	</section>

</table>
</body>
</html>