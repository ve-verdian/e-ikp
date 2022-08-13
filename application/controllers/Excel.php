<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    $this->load->model('M_admin');
  }

  public function export_barmas(){
    // Load plugin PHPExcel nya
    include APPPATH.'/third_party/PHPExcel/Classes/PHPExcel.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();

    // Settingan awal file excel
    $excel->getProperties()->setCreator('Creator By Verdi')
                 ->setLastModifiedBy('Creator By Verdi')
                 ->setTitle("Data Barang Masuk")
                 ->setSubject("Barang")
                 ->setDescription("Laporan Semua Data Barang Masuk")
                 ->setKeywords("Data Barang Masuk");

    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Barang Masuk"); // Set kolom A1 dengan tulisan "DATA BARANG"
    $excel->getActiveSheet()->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 12 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$sql_data_barmas = "SELECT * FROM tb_barang_Masuk ORDER BY tanggal ASC";
												
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "Tanggal"); // Set kolom A3 dengan tulisan "TANGGAL"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "Divisi"); // Set kolom B3 dengan tulisan "DIVISI"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Kode Barang"); // Set kolom C3 dengan tulisan "KODE BARANG"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Nama Barang"); // Set kolom D3 dengan tulisan "NAMA BARANG"
		$excel->setActiveSheetIndex(0)->setCellValue('E3', "Jumlah"); // Set kolom E3 dengan tulisan "JUMLAH"
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "Satuan"); // Set kolom E3 dengan tulisan "SATUAN"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		
		$tampil = $this->db->query($sql_data_barmas)->result();

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($tampil as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow,date('d-m-Y', strtotime($data->tanggal)));
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->divisi);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->kode_barang);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->nama_barang);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->jumlah);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->satuan);
			
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(12); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom F
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Barang Masuk");
    $excel->setActiveSheetIndex(0);

    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Barang Masuk.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
	}
	
	public function export_barkel(){
    // Load plugin PHPExcel nya
    include APPPATH.'/third_party/PHPExcel/Classes/PHPExcel.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();

    // Settingan awal file excel
    $excel->getProperties()->setCreator('Creator By Verdi')
                 ->setLastModifiedBy('Creator By Verdi')
                 ->setTitle("Data Barang Keluar")
                 ->setSubject("Barang")
                 ->setDescription("Laporan Semua Data Barang Keluar")
                 ->setKeywords("Data Barang Keluar");

    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Barang Keluar"); // Set kolom A1 dengan tulisan "DATA BARANG"
    $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 12 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$sql_data_barkel = "SELECT * FROM tb_barang_keluar ORDER BY tanggal_masuk ASC";
												
    // Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Tgl Masuk"); // Set kolom A3 dengan tulisan "TANGGAL"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Tgl Keluar"); // Set kolom A3 dengan tulisan "TANGGAL"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Divisi"); // Set kolom B3 dengan tulisan "DIVISI"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Kode Barang"); // Set kolom C3 dengan tulisan "KODE BARANG"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Nama Barang"); // Set kolom D3 dengan tulisan "NAMA BARANG"
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "Jumlah"); // Set kolom E3 dengan tulisan "JUMLAH"
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "Satuan"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "Unit Order"); // Set kolom E3 dengan tulisan "SATUAN"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		
		$tampil = $this->db->query($sql_data_barkel)->result();

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($tampil as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow,date('d-m-Y', strtotime($data->tanggal_masuk)));
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, date('d-m-Y', strtotime($data->tanggal_keluar)));
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->divisi);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->kode_barang);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nama_barang);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->jumlah);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->satuan);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->unit_order);
			
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(12); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(12); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(15); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(20); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20); // Set width kolom F
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Barang Keluar");
    $excel->setActiveSheetIndex(0);

    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Barang Keluar.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
	}

	public function export_pc(){
    // Load plugin PHPExcel nya
    include APPPATH.'/third_party/PHPExcel/Classes/PHPExcel.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();

    // Settingan awal file excel
    $excel->getProperties()->setCreator('Creator By Verdi')
                 ->setLastModifiedBy('Creator By Verdi')
                 ->setTitle("Data Komputer")
                 ->setSubject("Barang")
                 ->setDescription("Laporan Semua Data Komputer")
                 ->setKeywords("Data Barang Komputer");

    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Komputer"); // Set kolom A1 dengan tulisan "DATA BARANG"
    $excel->getActiveSheet()->mergeCells('A1:O1'); // Set Merge Cell pada kolom A1 sampai F1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 12 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$sql_data_pc = "SELECT * FROM tb_pc ORDER BY tgl_input ASC";
												
    // Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Tgl Input"); // Set kolom A3 dengan tulisan "TANGGAL"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Divisi"); // Set kolom A3 dengan tulisan "TANGGAL"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Hostname"); // Set kolom B3 dengan tulisan "DIVISI"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "User"); // Set kolom C3 dengan tulisan "KODE BARANG"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Jenis"); // Set kolom D3 dengan tulisan "NAMA BARANG"
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "Hard Disk"); // Set kolom E3 dengan tulisan "JUMLAH"
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "RAM"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "Processor"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "Operating System"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('J3', "IP Address"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('K3', "Internet"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "Lokal"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "SIM-RS"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "Lokasi"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('O3', "Status"); // Set kolom E3 dengan tulisan "SATUAN"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
		
		$tampil = $this->db->query($sql_data_pc)->result();

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($tampil as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow,date('d-m-Y', strtotime($data->tgl_input)));
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->divisi);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->hostname);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->user);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->jenis);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->hard_disk);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->ram);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->processor);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->os);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->ip_address);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->internet);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->lokal);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->simrs);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->lokasi);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->status);
			
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(12); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(18); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(10); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(12); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom G
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30); // Set width kolom H
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(25); // Set width kolom I
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15); // Set width kolom J
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10); // Set width kolom K
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(8); // Set width kolom L
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(8); // Set width kolom M
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(8); // Set width kolom N
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(8); // Set width kolom O
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Komputer");
    $excel->setActiveSheetIndex(0);

    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Komputer.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }
	
	public function export_printer(){
    // Load plugin PHPExcel nya
    include APPPATH.'/third_party/PHPExcel/Classes/PHPExcel.php';
    
    // Panggil class PHPExcel nya
    $excel = new PHPExcel();

    // Settingan awal file excel
    $excel->getProperties()->setCreator('Creator By Verdi')
                 ->setLastModifiedBy('Creator By Verdi')
                 ->setTitle("Data Barang Printer")
                 ->setSubject("Barang")
                 ->setDescription("Laporan Semua Data Printer")
                 ->setKeywords("Data Barang Printer");

    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
      ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
      )
    );

    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Printer"); // Set kolom A1 dengan tulisan "DATA BARANG"
    $excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai F1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12); // Set font size 12 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1

		$sql_data_printer = "SELECT * FROM tb_printer ORDER BY tgl_input ASC";
												
    // Buat header tabel nya pada baris ke 3
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Tgl Input"); // Set kolom A3 dengan tulisan "TANGGAL"
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Kategori"); // Set kolom A3 dengan tulisan "TANGGAL"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "Merk"); // Set kolom B3 dengan tulisan "DIVISI"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "Type"); // Set kolom C3 dengan tulisan "KODE BARANG"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "Serial Number"); // Set kolom D3 dengan tulisan "NAMA BARANG"
		$excel->setActiveSheetIndex(0)->setCellValue('F3', "Qty Out"); // Set kolom E3 dengan tulisan "JUMLAH"
		$excel->setActiveSheetIndex(0)->setCellValue('G3', "Capacity"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('H3', "Kondisi"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('I3', "Status"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('J3', "Keterangan"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('K3', "Warna"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('L3', "Pengguna"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('M3', "Lokasi"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('N3', "Qty"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('O3', "Backup"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('P3', "Kepemilikan"); // Set kolom E3 dengan tulisan "SATUAN"
		$excel->setActiveSheetIndex(0)->setCellValue('Q3', "Terakhir di Simpan"); // Set kolom E3 dengan tulisan "SATUAN"

    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
		
		$tampil = $this->db->query($sql_data_printer)->result();

    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($tampil as $data){ // Lakukan looping pada variabel
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow,date('d-m-Y', strtotime($data->tgl_input)));
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->kategori);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->merk);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->type);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->serial_number);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->qty_out);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->capacity);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->kondisi);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->status);
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->keterangan);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->warna);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->pengguna);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data->lokasi);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->qty);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->backup);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data->kepemilikan);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->posisi_skg);
			
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
			$excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }

    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(12); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(18); // Set width kolom D
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(10); // Set width kolom F
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10); // Set width kolom G
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(8); // Set width kolom H
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(8); // Set width kolom I
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(20); // Set width kolom J
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(10); // Set width kolom K
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(12); // Set width kolom L
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(8); // Set width kolom M
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(8); // Set width kolom N
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(8); // Set width kolom O
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(12); // Set width kolom P
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(18); // Set width kolom Q
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);

    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Printer");
    $excel->setActiveSheetIndex(0);

    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Printer.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }
}
