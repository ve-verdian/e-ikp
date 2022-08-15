<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

  public function __construct(){
		parent::__construct();
		$this->load->model('M_admin');
    $this->load->library('upload');
	}

  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1){
			$data['title'] = 'Form IKP | Dashboard';
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
      $data['stokBarangMasuk'] = $this->M_admin->sum('tb_barang_masuk','jumlah');
      $data['stokBarangKeluar'] = $this->M_admin->sum('tb_barang_keluar','jumlah');      
			// $data['dataUser'] = $this->M_admin->numrows('user');
			// $data['dataDivisi'] = $this->M_admin->numrows('tb_divisi');
			$data['dataPC'] = $this->M_admin->numrows('tb_pc');
			$data['dataPrinter'] = $this->M_admin->numrows('tb_printer');
      $data['dataIkp'] = $this->M_admin->numrows('tb_ikp');
      $this->load->view('admin/index',$data);
    }else {
      $this->load->view('login/login');
    }
  }

  public function signout(){
    session_destroy();
    redirect('login');
  }

  ####################################
              // Profile
  ####################################

  public function profile()
  {
		$data['title'] = 'Form IKP | User Profile';
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/profile',$data);
  }

  public function token_generate()
  {
    return $tokens = md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('email','Email','required|trim');
    $this->form_validation->set_rules('new_password','New Password','required|trim');
		$this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|trim|matches[new_password]');
		$this->form_validation->set_message('required', '{field} wajib diisi');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $data = array(
            'email'    => $email,
            'password' => $this->hash_password($new_password)
        );

        $where = array(
            'id' =>$this->session->userdata('id')
        );

        $this->M_admin->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah di Ganti');
        redirect(base_url('admin/profile'));
      }
    }else {
      $this->load->view('admin/profile');
    }
  }

  public function proses_gambar_upload()
  {
    $config =  array(
                   'upload_path'     => "./assets/upload/user/img/",
                   'allowed_types'   => "gif|jpg|png|jpeg",
                   'encrypt_name'    => False, //
                   'max_size'        => "50000",  // ukuran file gambar
                   'max_height'      => "9680",
                   'max_width'       => "9024"
                 );
      $this->load->library('upload',$config);
      $this->upload->initialize($config);

      if( ! $this->upload->do_upload('userpicture'))
      {
        $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
        $this->load->view('admin/profile',$data);
      }else{
        $upload_data = $this->upload->data();
        $nama_file = $upload_data['file_name'];
        $ukuran_file = $upload_data['file_size'];

        //resize img + thumb Img -- Optional
        $config['image_library']     = 'gd2';
				$config['source_image']      = $upload_data['full_path'];
				$config['create_thumb']      = FALSE;
				$config['maintain_ratio']    = TRUE;
				$config['width']             = 150;
				$config['height']            = 150;

        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
				if (!$this->image_lib->resize())
        {
          $data['pesan_error'] = $this->image_lib->display_errors();
          $this->load->view('admin/profile',$data);
        }

        $where = array(
                'username_user' => $this->session->userdata('name')
        );

        $data = array(
                'nama_file' => $nama_file,
                'ukuran_file' => $ukuran_file
        );

        $this->M_admin->update('tb_upload_gambar_user',$data,$where);
        $this->session->set_flashdata('msg_berhasil_gambar','Gambar Berhasil Di Upload');
        redirect(base_url('admin/profile'));
      }
  }

  ####################################
           // End Profile
  ####################################

  ####################################
              // Users
  ####################################
  public function users()
  {
		$data['title'] = 'Form IKP | Data Users';
    $data['list_users'] = $this->M_admin->kecuali('user',$this->session->userdata('name'));
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/users',$data);
  }

  public function form_user()
  {
		$data['title'] = 'Form IKP | Tambah Data Users';
    $data['list_users'] = $this->M_admin->select('user');
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_insert',$data);
  }

  public function update_user()
  {
		$data['title'] = 'Form IKP | Update Data User';
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $data['token_generate'] = $this->token_generate();
    $data['list_data'] = $this->M_admin->get_data('user',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_update',$data);
  }

  public function proses_delete_user()
  {
    $id = $this->uri->segment(3);
    $where = array('id' => $id);
    $this->M_admin->delete('user',$where);
    $this->session->set_flashdata('msg_berhasil','User Berhasil di Hapus');
    redirect(base_url('admin/users'));
  }

  public function proses_tambah_user()
  {
    $this->form_validation->set_rules('username','Username','trim|required');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');
    $this->form_validation->set_rules('password','Password','trim|required');
		$this->form_validation->set_rules('confirm_password','Confirm password','trim|required|matches[password]');
		$this->form_validation->set_message('required', '{field} wajib diisi');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {

        $username     = $this->input->post('username',TRUE);
        $email        = $this->input->post('email',TRUE);
        $password     = $this->input->post('password',TRUE);
        $role         = $this->input->post('role',TRUE);

        $data = array(
              'username'     => $username,
              'email'        => $email,
              'password'     => $this->hash_password($password),
              'role'         => $role,
        );
        $this->M_admin->insert('user',$data);

        $this->session->set_flashdata('msg_berhasil','User Berhasil di Tambahkan');
        redirect(base_url('admin/users'));
        }
      }else {
        $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
        $this->load->view('admin/form_users/form_insert',$data);
    }
  }

  public function proses_update_user()
  {
    $this->form_validation->set_rules('username','Username','trim|required');
    $this->form_validation->set_rules('email','Email','trim|required|valid_email');

    
    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $id           = $this->input->post('id',TRUE);        
        $username     = $this->input->post('username',TRUE);
        $email        = $this->input->post('email',TRUE);
        $role         = $this->input->post('role',TRUE);

        $where = array('id' => $id);
        $data = array(
              'username'     => $username,
              'email'        => $email,
              'role'         => $role,
        );
        $this->M_admin->update('user',$data,$where);
        $this->session->set_flashdata('msg_berhasil','Data User Berhasil di Update');
        redirect(base_url('admin/users'));
       }
    }else{
        $this->load->view('admin/form_users/form_update');
    }
  }


  ####################################
           // End Users
  ####################################

  ####################################
        // DATA BARANG MASUK
  ####################################

  public function form_barangmasuk()
  {
		$data['title'] = 'Form IKP | Form Barang Masuk';
		$data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_insert',$data);
  }

  public function tabel_barangmasuk()
  {
		
    $data = array(
              'list_data' => $this->M_admin->select('tb_barang_masuk'),
              'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'))
						);
		$data['title'] = 'Form IKP | Data Barang Masuk'; 				
    $this->load->view('admin/tabel/tabel_barangmasuk',$data);
  }

  public function update_barang($id_transaksi)
  {
		$data['title'] = 'Inventory EDP | Update Barang Masuk'; 
		$where = array('id_transaksi' => $id_transaksi);
		$data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['data_barang_update'] = $this->M_admin->get_data('tb_barang_masuk',$where);
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_barangmasuk/form_update',$data);
  }

  public function delete_barang($id_transaksi)
  {
    $where = array('id_transaksi' => $id_transaksi);
    $this->M_admin->delete('tb_barang_masuk',$where);
    redirect(base_url('admin/tabel_barangmasuk'));
  }

  public function proses_databarang_masuk_insert()
  {
    $this->form_validation->set_rules('divisi','Divisi','trim|required');
    $this->form_validation->set_rules('kode_barang','Kode Barang','trim|required');
    $this->form_validation->set_rules('nama_barang','Nama Barang','trim|required');
		$this->form_validation->set_rules('jumlah','Jumlah','trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');

    if($this->form_validation->run() == TRUE)
    {
      $id_transaksi = $this->input->post('id_transaksi',TRUE);
      $tanggal      = date_format(date_create($this->input->post('tanggal')), 'Y-m-d');
      $divisi       = $this->input->post('divisi',TRUE);
      $kode_barang  = $this->input->post('kode_barang',TRUE);
      $nama_barang  = $this->input->post('nama_barang',TRUE);
      $satuan       = $this->input->post('satuan',TRUE);
      $jumlah       = $this->input->post('jumlah',TRUE);

      $data = array(
            'id_transaksi' => $id_transaksi,
            'tanggal'      => $tanggal,
            'divisi'       => $divisi,
            'kode_barang'  => $kode_barang,
            'nama_barang'  => $nama_barang,
            'satuan'       => $satuan,
            'jumlah'       => $jumlah
      );
      $this->M_admin->insert('tb_barang_masuk',$data);

      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil di Tambahkan');
      redirect(base_url('admin/form_barangmasuk'));
    }else {
      $data['list_satuan'] = $this->M_admin->select('tb_satuan');
      $this->load->view('admin/form_barangmasuk/form_insert',$data);
    }
  }

  public function proses_databarang_masuk_update()
  {
    $this->form_validation->set_rules('divisi','Divisi','trim|required');
    $this->form_validation->set_rules('kode_barang','Kode Barang','trim|required');
    $this->form_validation->set_rules('nama_barang','Nama Barang','trim|required');
    $this->form_validation->set_rules('jumlah','Jumlah','trim|required');

    if($this->form_validation->run() == TRUE)
    {
      $id_transaksi = $this->input->post('id_transaksi',TRUE);
      $tanggal      = date_format(date_create($this->input->post('tanggal')), 'Y-m-d');
      $divisi       = $this->input->post('divisi',TRUE);
      $kode_barang  = $this->input->post('kode_barang',TRUE);
      $nama_barang  = $this->input->post('nama_barang',TRUE);
      $satuan       = $this->input->post('satuan',TRUE);
      $jumlah       = $this->input->post('jumlah',TRUE);

      $where = array('id_transaksi' => $id_transaksi);
      $data = array(
            'id_transaksi' => $id_transaksi,
            'tanggal'      => $tanggal,
            'divisi'       => $divisi,
            'kode_barang'  => $kode_barang,
            'nama_barang'  => $nama_barang,
            'satuan'       => $satuan,
            'jumlah'       => $jumlah
      );
      $this->M_admin->update('tb_barang_masuk',$data,$where);
      $this->session->set_flashdata('msg_berhasil','Data Barang Berhasil di Update');
      redirect(base_url('admin/tabel_barangmasuk'));
    }else{
      $this->load->view('admin/form_barangmasuk/form_update');
		}
	}
	
	public function cetak_barmas(){

		$id_transaksi = substr($this->uri->uri_string(3), 27);
		 
		$sql_data_barmas = "SELECT * FROM tb_barang_masuk ORDER BY tanggal ASC";

		$sql_barmas    = "SELECT * id_transaksi 
												FROM tb_barang_masuk
												WHERE id_transaksi='$id_transaksi'";

				$this->load->library('pdf');
				$pdf = new FPDF('l', 'mm', array(410,380));
				// membuat halaman baru
				$pdf->AddPage();
				// setting jenis font yang akan digunakan
				$pdf->SetFont('Arial', 'B', 16);

				$pdf->Image('http://localhost/ikp/assets/img/rsia_family.jpeg', 75, 5, 30);
				// $pdf->Image('', )
				// mencetak string 
				$pdf->Cell(65, 7, '', 0, 0, 'C');
				$pdf->Cell(260, 7, 'RSIA Family', 0, 1, 'C');
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(45, 7, '', 0, 0, 'C');
				$pdf->Cell(300, 7, 'Jl. Pluit Mas Raya 1 Blok A No.2A-5A, RT.1/RW.18, Pejagalan, Kec. Penjaringan,', 0, 1, 'C');
				$pdf->Cell(43, 7, '', 0, 0, 'C');
				$pdf->Cell(300, 7, 'Kota Jakarta Utara, Daerah Khusus Ibukota Jakarta 14450', 0, 1, 'C');
				$pdf->Cell(83, 7, '', 0, 0, 'C');
				$pdf->Cell(220, 7, 'Telepon : (021) 669 5066. E-mail: info@rsiafamily.com ', 0, 1, 'C');
				$pdf->Line(10,40, 430-30, 40);
				$pdf->Line(10,40.8, 430-30, 40.8);
				
				$pdf->Cell(30, 7, '', 0, 1);

				$pdf->Cell(70, 7, '', 0, 0, 'C');
				$pdf->Cell(250, 7, 'Laporan Data Barang Masuk', 0, 1, 'C');

				//tabel hasil input barang masuk
				$pdf->Cell(115,7, '',0,0,'C');
				// $pdf->Cell(40, 7, '  ID Transaksi  ', 1, 0, 'C');
				$pdf->Cell(25, 7, ' Tanggal  ', 1, 0, 'C');
				$pdf->Cell(20, 7, '  Divisi  ', 1, 0, 'C');
				$pdf->Cell(28, 7, '  Kode Barang  ', 1, 0, 'C');
				$pdf->Cell(45, 7, ' Nama Barang  ', 1, 0, 'C');
				$pdf->Cell(18, 7, ' Jumlah  ', 1, 0, 'C');
				$pdf->Cell(25, 7, ' Satuan  ', 1, 1, 'C');


				$tampil = $this->db->query($sql_data_barmas)->result();
				foreach ($tampil as $t) {
				$pdf->Cell(115,7, '',0,0,'C');
				// $pdf->Cell(40, 7, $t->id_transaksi, 1, 0, 'C');
				$pdf->Cell(25, 7, date('d-m-Y', strtotime($t->tanggal)), 1, 0, 'C');
				$pdf->Cell(20, 7, $t->divisi, 1, 0, 'C');
				$pdf->Cell(28, 7, $t->kode_barang, 1, 0, 'C');
				$pdf->Cell(45, 7, $t->nama_barang, 1, 0, 'C');
				$pdf->Cell(18, 7, $t->jumlah, 1, 0, 'C');
				$pdf->Cell(25, 7, $t->satuan, 1, 1, 'C');

				}

				$pdf->Cell(130, 10, '', 0, 1);
				$pdf->Cell(130, 10, '', 0, 1);
				$pdf->Cell(110, 10, '', 0, 0);
				$pdf->Cell(200, 10, 'Tanggal Cetak', 0, 0, 'R');
				$pdf->Cell(50, 10, ': '.date('d-m-Y '), 0, 0, 'R');


				$pdf->Output();
		}
		
  ####################################
      // END DATA BARANG MASUK
	####################################
	
  ####################################
              // SATUAN
  ####################################

  public function form_satuan()
  {
		$data['title'] = 'Form IKP | Tambah Satuan Barang';
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_satuan/form_insert',$data);
  }

  public function tabel_satuan()
  {
		$data['title'] = 'Form IKP | Data Satuan Barang';
    $data['list_data'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_satuan',$data);
  }

  public function update_satuan()
  {
		$data['title'] = 'Form IKP | Update Satuan Barang';
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $data['data_satuan'] = $this->M_admin->get_data('tb_satuan',$where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/form_satuan/form_update',$data);
  }

  public function delete_satuan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $this->M_admin->delete('tb_satuan',$where);
    redirect(base_url('admin/tabel_satuan'));
  }

  public function proses_satuan_insert()
  {
    $this->form_validation->set_rules('kode_satuan','Kode Satuan','trim|required|max_length[100]');
    $this->form_validation->set_rules('nama_satuan','Nama Satuan','trim|required|max_length[100]');
		$this->form_validation->set_message('required', '{field} wajib diisi');

    if($this->form_validation->run() ==  TRUE)
    {
      $kode_satuan = $this->input->post('kode_satuan' ,TRUE);
      $nama_satuan = $this->input->post('nama_satuan' ,TRUE);

      $data = array(
            'kode_satuan' => $kode_satuan,
            'nama_satuan' => $nama_satuan
      );
      $this->M_admin->insert('tb_satuan',$data);

      $this->session->set_flashdata('msg_berhasil','Data Satuan Berhasil di Tambahkan');
      redirect(base_url('admin/form_satuan'));
    }else {
      $this->load->view('admin/form_satuan/form_insert');
    }
  }

  public function proses_satuan_update()
  {
    $this->form_validation->set_rules('kode_satuan','Kode Satuan','trim|required|max_length[100]');
    $this->form_validation->set_rules('nama_satuan','Nama Satuan','trim|required|max_length[100]');

    if($this->form_validation->run() ==  TRUE)
    {
      $id_satuan   = $this->input->post('id_satuan' ,TRUE);
      $kode_satuan = $this->input->post('kode_satuan' ,TRUE);
      $nama_satuan = $this->input->post('nama_satuan' ,TRUE);

      $where = array(
            'id_satuan' => $id_satuan
      );

      $data = array(
            'kode_satuan' => $kode_satuan,
            'nama_satuan' => $nama_satuan
      );
      $this->M_admin->update('tb_satuan',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data Satuan Berhasil di Update');
      redirect(base_url('admin/tabel_satuan'));
    }else {
      $this->load->view('admin/form_satuan/form_update');
    }
  }

  ####################################
            // END SATUAN
	####################################
	
  ####################################
     // DATA MASUK KE DATA KELUAR
  ####################################

  public function barang_keluar()
  {
		$data['title'] = 'Form IKP | Data Barang Keluar';
    $uri = $this->uri->segment(3);
		$where = array( 'id_transaksi' => $uri);
		$data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['list_data'] = $this->M_admin->get_data('tb_barang_masuk',$where);
    $data['list_satuan'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/perpindahan_barang/form_update',$data);
  }

  public function proses_data_keluar()
  {
    $this->form_validation->set_rules('tanggal_keluar','Tanggal Keluar','required');
    if($this->form_validation->run() === TRUE)
    {
      $id_transaksi   = $this->input->post('id_transaksi',TRUE);
      $tanggal_masuk  = date_format(date_create($this->input->post('tanggal_masuk')), 'Y-m-d');
      $tanggal_keluar = date_format(date_create($this->input->post('tanggal_keluar')), 'Y-m-d');
      $divisi         = $this->input->post('divisi',TRUE);
      $kode_barang    = $this->input->post('kode_barang',TRUE);
      $nama_barang    = $this->input->post('nama_barang',TRUE);
      $satuan         = $this->input->post('satuan',TRUE);
			$jumlah         = $this->input->post('jumlah',TRUE);
			$unit_order     = $this->input->post('unit_order',TRUE);

      $where = array( 'id_transaksi' => $id_transaksi);
      $data = array(
              'id_transaksi' => $id_transaksi,
              'tanggal_masuk' => $tanggal_masuk,
              'tanggal_keluar' => $tanggal_keluar,
              'divisi' => $divisi,
              'kode_barang' => $kode_barang,
              'nama_barang' => $nama_barang,
              'satuan' => $satuan,
							'jumlah' => $jumlah,
							'unit_order' => $unit_order
      );
        $this->M_admin->insert('tb_barang_keluar',$data);
        $this->session->set_flashdata('msg_berhasil_keluar','Data Berhasil Keluar');
        redirect(base_url('admin/tabel_barangmasuk'));
    }else {
      $this->load->view('perpindahan_barang/form_update/'.$id_transaksi);
    }

	}
	
	public function cetak_barkel(){

		$id_transaksi = substr($this->uri->uri_string(3), 27);
		 
		$sql_data_barkel = "SELECT * FROM tb_barang_keluar ORDER BY tanggal_masuk ASC";

		$sql_barkel    = "SELECT * id_transaksi 
												FROM tb_barang_keluar
												WHERE id_transaksi='$id_transaksi'";

				$this->load->library('pdf');
				$pdf = new FPDF('l', 'mm', array(410,380));
				// membuat halaman baru
				$pdf->AddPage();
				// setting jenis font yang akan digunakan
				$pdf->SetFont('Arial', 'B', 16);

				$pdf->Image('http://localhost/ikp/assets/img/rsia_family.jpeg', 75, 5, 30);
				// $pdf->Image('', )
				// mencetak string 
				$pdf->Cell(65, 7, '', 0, 0, 'C');
				$pdf->Cell(260, 7, 'RSIA Family', 0, 1, 'C');
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(45, 7, '', 0, 0, 'C');
				$pdf->Cell(300, 7, 'Jl. Pluit Mas Raya 1 Blok A No.2A-5A, RT.1/RW.18, Pejagalan, Kec. Penjaringan,', 0, 1, 'C');
				$pdf->Cell(43, 7, '', 0, 0, 'C');
				$pdf->Cell(300, 7, 'Kota Jakarta Utara, Daerah Khusus Ibukota Jakarta 14450', 0, 1, 'C');
				$pdf->Cell(83, 7, '', 0, 0, 'C');
				$pdf->Cell(220, 7, 'Telepon : (021) 669 5066. E-mail: info@rsiafamily.com ', 0, 1, 'C');
				$pdf->Line(10,40, 430-30, 40);
				$pdf->Line(10,40.8, 430-30, 40.8);
				
				$pdf->Cell(30, 7, '', 0, 1);

				$pdf->Cell(70, 7, '', 0, 0, 'C');
				$pdf->Cell(250, 7, 'Laporan Data Barang Keluar', 0, 1, 'C');

				//tabel hasil input barang keluar
				$pdf->Cell(80,7, '',0,0,'C');
				// $pdf->Cell(40, 7, '  ID Transaki  ', 1, 0, 'C');
				$pdf->Cell(25, 7, ' Tgl Masuk ', 1, 0, 'C');
				$pdf->Cell(25, 7, ' Tgl Keluar ', 1, 0, 'C');
				$pdf->Cell(20, 7, '  Divisi  ', 1, 0, 'C');
				$pdf->Cell(38, 7, ' Kode Barang  ', 1, 0, 'C');
				$pdf->Cell(45, 7, ' Nama Barang  ', 1, 0, 'C');
				$pdf->Cell(25, 7, ' Jumlah  ', 1, 0, 'C');
				$pdf->Cell(23, 7, ' Satuan  ', 1, 0, 'C');
				$pdf->Cell(30, 7, ' Unit Order  ', 1, 1, 'C');


				$tampil = $this->db->query($sql_data_barkel)->result();
				foreach ($tampil as $t) {
				$pdf->Cell(80,7, '',0,0,'C');
				// $pdf->Cell(40, 7, $t->id_transaksi, 1, 0, 'C');
				$pdf->Cell(25, 7, date('d-m-Y', strtotime($t->tanggal_masuk)), 1, 0, 'C');
				$pdf->Cell(25, 7, date('d-m-Y', strtotime($t->tanggal_keluar)), 1, 0, 'C');
				$pdf->Cell(20, 7, $t->divisi, 1, 0, 'C');
				$pdf->Cell(38, 7, $t->kode_barang, 1, 0, 'C');
				$pdf->Cell(45, 7, $t->nama_barang, 1, 0, 'C');
				$pdf->Cell(25, 7, $t->jumlah, 1, 0, 'C');
				$pdf->Cell(23, 7, $t->satuan, 1, 0, 'C');
				$pdf->Cell(30, 7, $t->unit_order, 1, 1, 'C');

				}

				$pdf->Cell(130, 10, '', 0, 1);
				$pdf->Cell(130, 10, '', 0, 1);
				$pdf->Cell(110, 10, '', 0, 0);
				$pdf->Cell(200, 10, 'Tanggal Cetak', 0, 0, 'R');
				$pdf->Cell(50, 10, ': '.date('d-m-Y '), 0, 0, 'R');


				$pdf->Output();
		}
  ####################################
    // END DATA MASUK KE DATA KELUAR
  ####################################

  ####################################
        // DATA BARANG KELUAR
  ####################################

  public function tabel_barangkeluar()
  {
		$data['title'] = 'Form IKP | Data Barang Keluar';
    $data['list_data'] = $this->M_admin->select('tb_barang_keluar');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_barangkeluar',$data);
  }

	####################################
              // DIVISI
  ####################################

  public function divisi()
  {
		$data['title'] = 'Form IKP | Tambah Data Divisi';
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/divisi/tambah_divisi',$data);
  }

  public function tabel_divisi()
  {
		$data['title'] = 'Form IKP | Data Divisi';
    $data['list_data'] = $this->M_admin->select('tb_divisi');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_divisi',$data);
  }

  public function update_divisi()
  {
		$data['title'] = 'Form IKP | Update Data Divisi';
    $uri = $this->uri->segment(3);
    $where = array('id_divisi' => $uri);
    $data['data_divisi'] = $this->M_admin->get_data('tb_divisi', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/divisi/update_divisi',$data);
  }

  public function delete_divisi()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_divisi' => $uri);
    $this->M_admin->delete('tb_divisi',$where);
    redirect(base_url('admin/tabel_divisi'));
  }

  public function proses_divisi_insert()
  {
    $this->form_validation->set_rules('kode_divisi','Kode Divisi','trim|required|max_length[150]');
		$this->form_validation->set_rules('nama_divisi','Nama Divisi','trim|required|max_length[150]');
		$this->form_validation->set_message('required', '{field} wajib diisi');

    if($this->form_validation->run() ==  TRUE)
    {
      $kode_divisi = $this->input->post('kode_divisi' ,TRUE);
      $nama_divisi = $this->input->post('nama_divisi' ,TRUE);

      $data = array(
            'kode_divisi' => $kode_divisi,
            'nama_divisi' => $nama_divisi
      );
      $this->M_admin->insert('tb_divisi',$data);

      $this->session->set_flashdata('msg_berhasil','Data Divisi Berhasil di Tambahkan');
      redirect(base_url('admin/divisi'));
    }else {
      $this->load->view('admin/divisi/tambah_divisi');
    }
  }

  public function proses_divisi_update()
  {
    $this->form_validation->set_rules('kode_divisi','Kode Divisi','trim|required|max_length[150]');
    $this->form_validation->set_rules('nama_divisi','Nama Divisi','trim|required|max_length[150]');

    if($this->form_validation->run() ==  TRUE)
    {
      $id_divisi   = $this->input->post('id_divisi' ,TRUE);
      $kode_divisi = $this->input->post('kode_divisi' ,TRUE);
      $nama_divisi = $this->input->post('nama_divisi' ,TRUE);

      $where = array(
            'id_divisi' => $id_divisi
      );

      $data = array(
            'kode_divisi' => $kode_divisi,
            'nama_divisi' => $nama_divisi
      );
      $this->M_admin->update('tb_divisi',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data Divisi Berhasil di Update');
      redirect(base_url('admin/tabel_divisi'));
    }else {
      $this->load->view('admin/divisi/update_divisi');
    }
	}
	 ####################################
            // END DIVISI
	####################################

	####################################
              // KOMPUTER
  ####################################

  public function data_pc()
  {
		$data['title'] = 'Form IKP | Tambah Data Komputer';
		$data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/data_pc/tambah_pc',$data);
  }

  public function tabel_pc()
  {
		$data['title'] = 'Form IKP | Data Komputer';
		$data['list_data'] = $this->M_admin->select('tb_pc');
		$data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_pc',$data);
  }

  public function update_pc()
  {
		$data['title'] = 'Form IKP | Update Data Komputer';
    $uri = $this->uri->segment(3);
    $where = array('id_pc' => $uri);
		$data['data_pc'] = $this->M_admin->get_data('tb_pc', $where);
		$data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/data_pc/update_pc',$data);
  }

  public function delete_pc()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_pc' => $uri);
    $this->M_admin->delete('tb_pc',$where);
    redirect(base_url('admin/tabel_pc'));
  }

  public function proses_pc_insert()
  {
		$this->form_validation->set_rules('tgl_input','Tanggal Input','trim|required');
    $this->form_validation->set_rules('divisi','Divisi','trim|required');
		$this->form_validation->set_rules('hostname','Hostname','trim|required');
		$this->form_validation->set_rules('user','User','trim|required');
		$this->form_validation->set_rules('jenis','Jenis','trim|required');
		$this->form_validation->set_rules('hard_disk','Harddisk','trim');
		$this->form_validation->set_rules('ram','RAM','trim');
		$this->form_validation->set_rules('processor','Processor','trim');
		$this->form_validation->set_rules('os','Operating System','trim|required');
		$this->form_validation->set_rules('ip_address','IP Address','trim');
		$this->form_validation->set_rules('lokasi','Lokasi','trim|required');
		$this->form_validation->set_rules('internet','Internet','trim|required');
		$this->form_validation->set_rules('lokal','Lokal','trim|required');
		$this->form_validation->set_rules('simrs','SIM-RS','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');
		
    if($this->form_validation->run() ==  TRUE)
    {
      $tgl_input = $this->input->post('tgl_input' ,TRUE);
			$divisi = $this->input->post('divisi' ,TRUE);
			$hostname = $this->input->post('hostname' ,TRUE);
			$user = $this->input->post('user' ,TRUE);
      $jenis = $this->input->post('jenis' ,TRUE);
			$hard_disk = $this->input->post('hard_disk' ,TRUE);
			$ram = $this->input->post('ram' ,TRUE);
			$processor = $this->input->post('processor' ,TRUE);
			$os = $this->input->post('os' ,TRUE);
			$ip_address = $this->input->post('ip_address' ,TRUE);
			$lokasi = $this->input->post('lokasi' ,TRUE);
			$internet = $this->input->post('internet' ,TRUE);
			$lokal = $this->input->post('lokal' ,TRUE);
			$simrs = $this->input->post('simrs' ,TRUE);
			$status = $this->input->post('status' ,TRUE);

      $data = array(
            'tgl_input' => $tgl_input,
						'divisi' => $divisi,
						'hostname' => $hostname,
						'user' => $user,
						'jenis' => $jenis,
						'hard_disk' => $hard_disk,
						'ram' => $ram,
						'processor' => $processor,
						'os' => $os,
						'ip_address' => $ip_address,
						'lokasi' => $lokasi,
						'internet' => $internet,
						'lokal' => $lokal,
						'simrs' => $simrs,
            'status' => $status
      );
      $this->M_admin->insert('tb_pc',$data);
 
      $this->session->set_flashdata('msg_berhasil','Data pc Berhasil di Tambahkan');
      redirect(base_url('admin/data_pc'));
    }else {
      $this->load->view('admin/data_pc/tambah_pc');
    }
  }

  public function proses_pc_update()
  {
    $this->form_validation->set_rules('tgl_input','Tanggal Input','trim|required');
    $this->form_validation->set_rules('divisi','Divisi','trim|required');
		$this->form_validation->set_rules('hostname','Hostname','trim|required');
		$this->form_validation->set_rules('user','User','trim|required');
		$this->form_validation->set_rules('jenis','Jenis','trim|required');
		$this->form_validation->set_rules('hard_disk','Harddisk','trim');
		$this->form_validation->set_rules('ram','RAM','trim');
		$this->form_validation->set_rules('processor','Processor','trim');
		$this->form_validation->set_rules('os','Operating System','trim|required');
		$this->form_validation->set_rules('ip_address','IP Address','trim');
		$this->form_validation->set_rules('lokasi','Lokasi','trim|required');
		$this->form_validation->set_rules('internet','Internet','trim|required');
		$this->form_validation->set_rules('lokal','Lokal','trim|required');
		$this->form_validation->set_rules('simrs','SIM-RS','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');

    if($this->form_validation->run() ==  TRUE)
    {
			$id_pc   = $this->input->post('id_pc' ,TRUE);
      $tgl_input = $this->input->post('tgl_input' ,TRUE);
			$divisi = $this->input->post('divisi' ,TRUE);
			$hostname = $this->input->post('hostname' ,TRUE);
			$user = $this->input->post('user' ,TRUE);
      $jenis = $this->input->post('jenis' ,TRUE);
			$hard_disk = $this->input->post('hard_disk' ,TRUE);
			$ram = $this->input->post('ram' ,TRUE);
			$processor = $this->input->post('processor' ,TRUE);
			$os = $this->input->post('os' ,TRUE);
			$ip_address = $this->input->post('ip_address' ,TRUE);
			$lokasi = $this->input->post('lokasi' ,TRUE);
			$internet = $this->input->post('internet' ,TRUE);
			$lokal = $this->input->post('lokal' ,TRUE);
			$simrs = $this->input->post('simrs' ,TRUE);
			$status = $this->input->post('status' ,TRUE);


      $where = array(
        'id_pc' => $id_pc
      );

      $data = array(
				'tgl_input' => $tgl_input,
				'divisi' => $divisi,
				'hostname' => $hostname,
				'user' => $user,
				'jenis' => $jenis,
				'hard_disk' => $hard_disk,
				'ram' => $ram,
				'processor' => $processor,
				'os' => $os,
				'ip_address' => $ip_address,
				'lokasi' => $lokasi,
				'internet' => $internet,
				'lokal' => $lokal,
				'simrs' => $simrs,
				'status' => $status
      );
      $this->M_admin->update('tb_pc',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data Komputer Berhasil di Update');
      redirect(base_url('admin/tabel_pc'));
    }else {
      $this->load->view('admin/data_pc/update_pc');
    }
	}

	public function cetak_pc(){

    $id_pc = substr($this->uri->uri_string(3), 27);
     
    $sql_data_pc = "SELECT * FROM tb_pc ORDER BY tgl_input ASC";

    $sql_pc    = "SELECT * id_pc 
                        FROM tb_pc
                        WHERE id_pc='$id_pc'";

        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', array(410,380));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Image('http://localhost/ikp/assets/img/rsia_family.jpeg', 75, 5, 30);
        // $pdf->Image('', )
        // mencetak string 
        $pdf->Cell(65, 7, '', 0, 0, 'C');
        $pdf->Cell(260, 7, 'RSIA Family', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(45, 7, '', 0, 0, 'C');
        $pdf->Cell(300, 7, 'Jl. Pluit Mas Raya 1 Blok A No.2A-5A, RT.1/RW.18, Pejagalan, Kec. Penjaringan,', 0, 1, 'C');
				$pdf->Cell(43, 7, '', 0, 0, 'C');
        $pdf->Cell(300, 7, 'Kota Jakarta Utara, Daerah Khusus Ibukota Jakarta 14450', 0, 1, 'C');
				$pdf->Cell(83, 7, '', 0, 0, 'C');
        $pdf->Cell(220, 7, 'Telepon : (021) 669 5066. E-mail: info@rsiafamily.com ', 0, 1, 'C');
        $pdf->Line(10,40, 430-30, 40);
        $pdf->Line(10,40.8, 430-30, 40.8);
        
        $pdf->Cell(30, 7, '', 0, 1);

        $pdf->Cell(70, 7, '', 0, 0, 'C');
        $pdf->Cell(250, 7, 'Laporan Data Komputer', 0, 1, 'C');

        //tabel hasil input data komputer
        $pdf->Cell(15,7, '',0,0,'C');
        // $pdf->Cell(10, 7, '  No  ', 1, 0, 'C');
        $pdf->Cell(25, 7, ' Tanggal  ', 1, 0, 'C');
        $pdf->Cell(32, 7, '  Dept / Divisi  ', 1, 0, 'C');
        $pdf->Cell(30, 7, ' Hostname  ', 1, 0, 'C');
        $pdf->Cell(40, 7, ' User  ', 1, 0, 'C');
				$pdf->Cell(15, 7, '   Jenis  ', 1, 0, 'C');
				$pdf->Cell(25, 7, '  Harddisk  ', 1, 0, 'C');
        $pdf->Cell(20, 7, '  RAM  ', 1, 0, 'C');
				$pdf->Cell(35, 7, '  OS  ', 1, 0, 'C');
				$pdf->Cell(35, 7, '  IP Address  ', 1, 0, 'C');
				$pdf->Cell(23, 7, ' Lokasi  ', 1, 0, 'C');
				$pdf->Cell(20, 7, '  Internet  ', 1, 0, 'C');
				$pdf->Cell(20, 7, '  Lokal  ', 1, 0, 'C');
				$pdf->Cell(20, 7, '  SIM-RS  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Status  ', 1, 1, 'C');


        $tampil = $this->db->query($sql_data_pc)->result();
        foreach ($tampil as $t) {
        $pdf->Cell(15,7, '',0,0,'C');
        // $pdf->Cell(10, 7, $t->id_pc, 1, 0, 'C');
        $pdf->Cell(25, 7, date('d-m-Y', strtotime($t->tgl_input)), 1, 0, 'C');
        $pdf->Cell(32, 7, $t->divisi, 1, 0, 'C');
        $pdf->Cell(30, 7, $t->hostname, 1, 0, 'C');
        $pdf->Cell(40, 7, $t->user, 1, 0, 'C');
				$pdf->Cell(15, 7, $t->jenis, 1, 0, 'C');
				$pdf->Cell(25, 7, $t->hard_disk, 1, 0, 'C');
        $pdf->Cell(20, 7, $t->ram, 1, 0, 'C');
				$pdf->Cell(35, 7, $t->os, 1, 0, 'C');
				$pdf->Cell(35, 7, $t->ip_address, 1, 0, 'C');
				$pdf->Cell(23, 7, $t->lokasi, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->internet, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->lokal, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->simrs, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->status, 1, 1, 'C');

        }

        $pdf->Cell(130, 10, '', 0, 1);
        $pdf->Cell(130, 10, '', 0, 1);
        $pdf->Cell(110, 10, '', 0, 0);
        $pdf->Cell(200, 10, 'Tanggal Cetak', 0, 0, 'R');
        $pdf->Cell(50, 10, ': '.date('d-m-Y '), 0, 0, 'R');


        $pdf->Output();
    }
	 ####################################
            // END KOMPUTER
	####################################

	####################################
              // PRINTER
  ####################################

  public function data_printer()
  {
		$data['title'] = 'Form IKP | Tambah Data Printer';
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/data_printer/tambah_printer',$data);
  }

  public function tabel_printer()
  {
		$data['title'] = 'Form IKP | Data Printer';
    $data['list_data'] = $this->M_admin->select('tb_printer');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_printer',$data);
  }

  public function update_printer()
  {
		$data['title'] = 'Form IKP | Update Data Printer';
    $uri = $this->uri->segment(3);
    $where = array('id_printer' => $uri);
    $data['data_printer'] = $this->M_admin->get_data('tb_printer', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/data_printer/update_printer',$data);
  }

  public function delete_printer()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_printer' => $uri);
    $this->M_admin->delete('tb_printer',$where);
    redirect(base_url('admin/tabel_printer'));
  }

  public function proses_printer_insert()
  {
		$this->form_validation->set_rules('tgl_input','Tanggal Input','trim|required');
    $this->form_validation->set_rules('kategori','Kategori','trim|required');
		$this->form_validation->set_rules('merk','Merk','trim|required');
		$this->form_validation->set_rules('type','Type','trim|required');
		$this->form_validation->set_rules('serial_number','Serial Number','trim|required');
		$this->form_validation->set_rules('qty_out','Qty Out','trim|required');
		$this->form_validation->set_rules('capacity','Capacity','trim');
		$this->form_validation->set_rules('kondisi','Kondisi','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_rules('keterangan','Keterangan','trim');
		$this->form_validation->set_rules('warna','Warna','trim|required');
		$this->form_validation->set_rules('pengguna','Pengguna','trim|required');
		$this->form_validation->set_rules('lokasi','Lokasi','trim|required');
		$this->form_validation->set_rules('qty','Qty','trim|required');
		$this->form_validation->set_rules('backup','Back Up','trim|required');
		$this->form_validation->set_rules('kepemilikan','Kepemilikan','trim|required');
		$this->form_validation->set_rules('posisi_skg','Terakhir di Simpan','trim');
		$this->form_validation->set_message('required', '{field} wajib diisi');
		
    if($this->form_validation->run() ==  TRUE)
    {
      $tgl_input = $this->input->post('tgl_input' ,TRUE);
			$kategori = $this->input->post('kategori' ,TRUE);
			$merk = $this->input->post('merk' ,TRUE);
			$type = $this->input->post('type' ,TRUE);
      $serial_number = $this->input->post('serial_number' ,TRUE);
			$qty_out = $this->input->post('qty_out' ,TRUE);
			$capacity = $this->input->post('capacity' ,TRUE);
			$kondisi = $this->input->post('kondisi' ,TRUE);
			$status = $this->input->post('status' ,TRUE);
			$keterangan = $this->input->post('keterangan' ,TRUE);
			$warna = $this->input->post('warna' ,TRUE);
			$pengguna = $this->input->post('pengguna' ,TRUE);
			$lokasi = $this->input->post('lokasi' ,TRUE);
			$qty = $this->input->post('qty' ,TRUE);
			$backup = $this->input->post('backup' ,TRUE);
			$kepemilikan = $this->input->post('kepemilikan' ,TRUE);
			$posisi_skg = $this->input->post('posisi_skg' ,TRUE);

      $data = array(
            'tgl_input' => $tgl_input,
						'kategori' => $kategori,
						'merk' => $merk,
						'type' => $type,
						'serial_number' => $serial_number,
						'qty_out' => $qty_out,
						'capacity' => $capacity,
						'kondisi' => $kondisi,
						'status' => $status,
						'keterangan' => $keterangan,
						'warna' => $warna,
						'pengguna' => $pengguna,
						'lokasi' => $lokasi,
						'qty' => $qty,
						'backup' => $backup,
						'kepemilikan' => $kepemilikan,
            'posisi_skg' => $posisi_skg
      );
      $this->M_admin->insert('tb_printer',$data);
 
      $this->session->set_flashdata('msg_berhasil','Data printer Berhasil di Tambahkan');
      redirect(base_url('admin/data_printer'));
    }else {
      $this->load->view('admin/data_printer/tambah_printer');
    }
  }

  public function proses_printer_update()
  {
    $this->form_validation->set_rules('tgl_input','Tanggal Input','trim|required');
    $this->form_validation->set_rules('kategori','Kategori','trim|required');
		$this->form_validation->set_rules('merk','Merk','trim|required');
		$this->form_validation->set_rules('type','Type','trim|required');
		$this->form_validation->set_rules('serial_number','Serial Number','trim');
		$this->form_validation->set_rules('qty_out','QtyOut','trim|required');
		$this->form_validation->set_rules('capacity','Capacity','trim');
		$this->form_validation->set_rules('kondisi','Kondisi','trim|required');
		$this->form_validation->set_rules('status','Status','trim|required');
		$this->form_validation->set_rules('keterangan','Keterangan','trim');
		$this->form_validation->set_rules('warna','Warna','trim|required');
		$this->form_validation->set_rules('pengguna','Pengguna','trim|required');
		$this->form_validation->set_rules('lokasi','Lokasi','trim|required');
		$this->form_validation->set_rules('qty','Qty','trim|required');
		$this->form_validation->set_rules('backup','Back Up','trim|required');
		$this->form_validation->set_rules('kepemilikan','Kepemilikan','trim|required');
		$this->form_validation->set_rules('posisi_skg','Terakhir di Simpan','trim');

    if($this->form_validation->run() ==  TRUE)
    {
			$id_printer   = $this->input->post('id_printer' ,TRUE);
      $tgl_input = $this->input->post('tgl_input' ,TRUE);
			$kategori = $this->input->post('kategori' ,TRUE);
			$merk = $this->input->post('merk' ,TRUE);
			$type = $this->input->post('type' ,TRUE);
      $serial_number = $this->input->post('serial_number' ,TRUE);
			$qty_out = $this->input->post('qty_out' ,TRUE);
			$capacity = $this->input->post('capacity' ,TRUE);
			$kondisi = $this->input->post('kondisi' ,TRUE);
			$status = $this->input->post('status' ,TRUE);
			$keterangan = $this->input->post('keterangan' ,TRUE);
			$warna = $this->input->post('warna' ,TRUE);
			$pengguna = $this->input->post('pengguna' ,TRUE);
			$lokasi = $this->input->post('lokasi' ,TRUE);
			$qty = $this->input->post('qty' ,TRUE);
			$backup = $this->input->post('backup' ,TRUE);
			$kepemilikan = $this->input->post('kepemilikan' ,TRUE);
			$posisi_skg = $this->input->post('posisi_skg' ,TRUE);


      $where = array(
        'id_printer' => $id_printer
      );

      $data = array(
				'tgl_input' => $tgl_input,
				'kategori' => $kategori,
				'merk' => $merk,
				'type' => $type,
				'serial_number' => $serial_number,
				'qty_out' => $qty_out,
				'capacity' => $capacity,
				'kondisi' => $kondisi,
				'status' => $status,
				'keterangan' => $keterangan,
				'warna' => $warna,
				'pengguna' => $pengguna,
				'lokasi' => $lokasi,
				'qty' => $qty,
				'backup' => $backup,
				'kepemilikan' => $kepemilikan,
				'posisi_skg' => $posisi_skg
      );
      $this->M_admin->update('tb_printer',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data Printer Berhasil di Update');
      redirect(base_url('admin/tabel_printer'));
    }else {
      $this->load->view('admin/data_printer/update_printer');
    }
	}

	public function cetak_printer(){

    $id_printer = substr($this->uri->uri_string(3), 27);
     
    $sql_data_printer = "SELECT * FROM tb_printer ORDER BY tgl_input ASC";

    $sql_printer    = "SELECT * id_printer 
                        FROM tb_printer
                        WHERE id_printer='$id_printer'";

        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', array(410,380));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Image('http://localhost/ikp/assets/img/rsia_family.jpeg', 75, 5, 30);
        // $pdf->Image('', )
        // mencetak string 
        $pdf->Cell(65, 7, '', 0, 0, 'C');
        $pdf->Cell(260, 7, 'RSIA Family', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(45, 7, '', 0, 0, 'C');
        $pdf->Cell(300, 7, 'Jl. Pluit Mas Raya 1 Blok A No.2A-5A, RT.1/RW.18, Pejagalan, Kec. Penjaringan,', 0, 1, 'C');
				$pdf->Cell(43, 7, '', 0, 0, 'C');
        $pdf->Cell(300, 7, 'Kota Jakarta Utara, Daerah Khusus Ibukota Jakarta 14450', 0, 1, 'C');
				$pdf->Cell(83, 7, '', 0, 0, 'C');
        $pdf->Cell(220, 7, 'Telepon : (021) 669 5066. E-mail: info@rsiafamily.com ', 0, 1, 'C');
        $pdf->Line(10,40, 430-30, 40);
        $pdf->Line(10,40.8, 430-30, 40.8);
        
        $pdf->Cell(30, 7, '', 0, 1);

        $pdf->Cell(70, 7, '', 0, 0, 'C');
        $pdf->Cell(250, 7, 'Laporan Data Printer', 0, 1, 'C');

        //tabel hasil input printer
        $pdf->Cell(25,7, '',0,0,'C');
        // $pdf->Cell(10, 7, '  No  ', 1, 0, 'C');
        $pdf->Cell(25, 7, ' Tgl Input  ', 1, 0, 'C');
        $pdf->Cell(20, 7, '  Kategori  ', 1, 0, 'C');
        $pdf->Cell(45, 7, ' Merk  ', 1, 0, 'C');
        $pdf->Cell(42, 7, ' Type  ', 1, 0, 'C');
				$pdf->Cell(35, 7, '   Serial Number  ', 1, 0, 'C');
				$pdf->Cell(25, 7, '  Warna  ', 1, 0, 'C');
        $pdf->Cell(20, 7, '  Qty Out  ', 1, 0, 'C');
        $pdf->Cell(23, 7, ' Kondisi  ', 1, 0, 'C');
				$pdf->Cell(25, 7, '  Pengguna  ', 1, 0, 'C');
				$pdf->Cell(23, 7, ' Lokasi  ', 1, 0, 'C');
				$pdf->Cell(27, 7, '  Kepemilikan  ', 1, 0, 'C');
				$pdf->Cell(23, 7, ' Status  ', 1, 1, 'C');


        $tampil = $this->db->query($sql_data_printer)->result();
        foreach ($tampil as $t) {
        $pdf->Cell(25,7, '',0,0,'C');
        // $pdf->Cell(10, 7, $t->id_printer, 1, 0, 'C');
        $pdf->Cell(25, 7, date('d-m-Y', strtotime($t->tgl_input)), 1, 0, 'C');
        $pdf->Cell(20, 7, $t->kategori, 1, 0, 'C');
        $pdf->Cell(45, 7, $t->merk, 1, 0, 'C');
        $pdf->Cell(42, 7, $t->type, 1, 0, 'C');
				$pdf->Cell(35, 7, $t->serial_number, 1, 0, 'C');
				$pdf->Cell(25, 7, $t->warna, 1, 0, 'C');
        $pdf->Cell(20, 7, $t->qty_out, 1, 0, 'C');
				$pdf->Cell(23, 7, $t->kondisi, 1, 0, 'C');
				$pdf->Cell(25, 7, $t->pengguna, 1, 0, 'C');
				$pdf->Cell(23, 7, $t->lokasi, 1, 0, 'C');
				$pdf->Cell(27, 7, $t->kepemilikan, 1, 0, 'C');
				$pdf->Cell(23, 7, $t->status, 1, 1, 'C');

        }

        $pdf->Cell(130, 10, '', 0, 1);
        $pdf->Cell(130, 10, '', 0, 1);
        $pdf->Cell(110, 10, '', 0, 0);
        $pdf->Cell(200, 10, 'Tanggal Cetak', 0, 0, 'R');
        $pdf->Cell(50, 10, ': '.date('d-m-Y '), 0, 0, 'R');


        $pdf->Output();
    }
    	 ####################################
            // END PRINTER
	####################################
	

    ####################################
              // IKP
  ####################################

  public function ikp()
  {
		$data['title'] = 'Form IKP | Tambah Data IKP';
		// $data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/ikp/ikp_insert',$data);
  }

  public function tabel_ikp()
  {
		$data['title'] = 'Form IKP | Data IKP';
		$data['list_data'] = $this->M_admin->select('tb_ikp');
		// $data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_ikp',$data);
  }

  public function update_ikp()
  {
		$data['title'] = 'Form IKP | Update Data IKP';
    $uri = $this->uri->segment(3);
    $where = array('id_ikp' => $uri);
		$data['ikp'] = $this->M_admin->get_data('tb_ikp', $where);
		// $data['list_divisi'] = $this->M_admin->select('tb_divisi');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/ikp/ikp_update',$data);
  }

  public function delete_ikp()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_ikp' => $uri);
    $this->M_admin->delete('tb_ikp',$where);
    redirect(base_url('admin/tabel_ikp'));
  }

  public function ikp_insert()
  {
		$this->form_validation->set_rules('nama','Nama','trim|required');
    $this->form_validation->set_rules('no_mr','No. MR','trim|required');
		$this->form_validation->set_rules('ruangan','Ruangan','trim|required');
		$this->form_validation->set_rules('umur','Umur','trim|required');
		$this->form_validation->set_rules('biaya','Biaya','trim|required');
		$this->form_validation->set_rules('jk','Jenis Kelamin','trim|required');
		$this->form_validation->set_rules('tanggal_1','Tanggal Satu','trim|required');
    $this->form_validation->set_rules('waktu_1','Waktu Satu','trim|required');
		$this->form_validation->set_rules('tanggal_2','Tanggal Dua','trim|required');
    $this->form_validation->set_rules('waktu_2','Waktu Dua','trim|required');
		$this->form_validation->set_rules('insiden','Insiden','trim|required');
		$this->form_validation->set_rules('kronologi','Kronologi','trim|required');
		$this->form_validation->set_rules('jns_insiden','Jenis Insiden','trim|required');
		$this->form_validation->set_rules('ins_tjd','Insiden Terjadi','trim|required');
		$this->form_validation->set_rules('dampak','Dampak','trim|required');
		$this->form_validation->set_rules('probalitas','Probalitas','trim|required');
		$this->form_validation->set_rules('pelapor','Pelapor','trim|required');
    $this->form_validation->set_rules('ins_pas','Insiden Pasien','trim|required');
		$this->form_validation->set_rules('tempat','Tempat','trim');
		$this->form_validation->set_rules('unit_terkait','Unit Terkait','trim');
		$this->form_validation->set_rules('tindaklanjut','Tindak Lanjut','trim');
		$this->form_validation->set_rules('stlh_dilaku','Setelah Dilakukan','trim|required');
		$this->form_validation->set_rules('prnh_tjd','Pernah Terjadi','trim');
		$this->form_validation->set_rules('no_ulang','Kapan');
		$this->form_validation->set_rules('petugas','Petugas','trim|required');
		$this->form_validation->set_rules('karu','Kepala Unit/Bidang/Ruang','trim|required');
		$this->form_validation->set_rules('kmrkp','Ketua KMRKP','trim|required');
		$this->form_validation->set_rules('direktur','Direktur','trim|required');
    $this->form_validation->set_rules('grad_res','Grading Resiko','trim|required');
		$this->form_validation->set_message('required', '{field} wajib diisi');
		
    if($this->form_validation->run() ==  TRUE)
    {
      $nama = $this->input->post('nama' ,TRUE);
			$no_mr = $this->input->post('no_mr' ,TRUE);
			$ruangan = $this->input->post('ruangan' ,TRUE);
			$umur = $this->input->post('umur' ,TRUE);
      $biaya = $this->input->post('biaya' ,TRUE);
			$jk = $this->input->post('jk' ,TRUE);
			$ram = $this->input->post('ram' ,TRUE);
			$tanggal_1 = $this->input->post('tanggal_1' ,TRUE);
      $waktu_1 = $this->input->post('waktu_1' ,TRUE);
			$tanggal_2 = $this->input->post('tanggal_2' ,TRUE);
      $waktu_2 = $this->input->post('waktu_2' ,TRUE);
			$insiden = $this->input->post('insiden' ,TRUE);
			$kronologi = $this->input->post('kronologi' ,TRUE);
			$jns_insiden = $this->input->post('jns_insiden' ,TRUE);
			$ins_tjd = $this->input->post('ins_tjd' ,TRUE);
			$dampak = $this->input->post('dampak' ,TRUE);
			$probalitas = $this->input->post('probalitas' ,TRUE);
      $pelapor = $this->input->post('pelapor' ,TRUE);
			$ins_pas = $this->input->post('ins_pas' ,TRUE);
			$tempat = $this->input->post('tempat' ,TRUE);
      $unit_terkait = $this->input->post('unit_terkait' ,TRUE);
			$tindaklanjut = $this->input->post('tindaklanjut' ,TRUE);
			$stlh_dilaku = $this->input->post('stlh_dilaku' ,TRUE);
			$prnh_tjd = $this->input->post('prnh_tjd' ,TRUE);
			$no_ulang = $this->input->post('no_ulang' ,TRUE);
			$petugas = $this->input->post('petugas' ,TRUE);
			$karu = $this->input->post('karu' ,TRUE);
			$kmrkp = $this->input->post('kmrkp' ,TRUE);
			$direktur = $this->input->post('direktur' ,TRUE);
			$grad_res = $this->input->post('grad_res' ,TRUE);

      $data = array(
            'nama' => $nama,
						'no_mr' => $no_mr,
						'ruangan' => $ruangan,
						'umur' => $umur,
						'biaya' => $biaya,
						'jk' => $jk,
						'tanggal_1' => $tanggal_1,
            'waktu_1' => $waktu_1,
						'tanggal_2' => $tanggal_2,
            'waktu_2' => $waktu_2,
						'insiden' => $insiden,
						'kronologi' => $kronologi,
						'jns_insiden' => $jns_insiden,
						'ins_tjd' => $ins_tjd,
						'dampak' => $dampak,
						'probalitas' => $probalitas,
            'pelapor' => $pelapor,
            'ins_pas' => $ins_pas,
						'tempat' => $tempat,
						'unit_terkait' => $unit_terkait,
						'tindaklanjut' => $tindaklanjut,
						'stlh_dilaku' => $stlh_dilaku,
						'prnh_tjd' => $prnh_tjd,
						'no_ulang' => $no_ulang,
						'petugas' => $petugas,
						'karu' => $karu,
						'kmrkp' => $kmrkp,
						'direktur' => $direktur,
						'grad_res' => $grad_res
      );
      $this->M_admin->insert('tb_ikp',$data);
 
      $this->session->set_flashdata('msg_berhasil','Data IKP Berhasil di Tambahkan');
      redirect(base_url('admin/ikp'));
    }else {
      $this->load->view('admin/ikp/ikp_insert');
    }
  }

  public function ikp_update()
  {
    $this->form_validation->set_rules('nama','Nama','trim|required');
    $this->form_validation->set_rules('no_mr','No. MR','trim|required');
		$this->form_validation->set_rules('ruangan','Ruangan','trim|required');
		$this->form_validation->set_rules('umur','Umur','trim|required');
		$this->form_validation->set_rules('biaya','Biaya','trim|required');
		$this->form_validation->set_rules('jk','Jenis Kelamin','trim|required');
		$this->form_validation->set_rules('tanggal_1','Tanggal Satu','trim|required');
    $this->form_validation->set_rules('waktu_1','Waktu Satu','trim|required');
		$this->form_validation->set_rules('tanggal_2','Tanggal Dua','trim|required');
    $this->form_validation->set_rules('waktu_2','Waktu Dua','trim|required');
		$this->form_validation->set_rules('insiden','Insiden','trim|required');
		$this->form_validation->set_rules('kronologi','Kronologi','trim');
		$this->form_validation->set_rules('jns_insiden','Jenis Insiden','trim|required');
		$this->form_validation->set_rules('ins_tjd','Insiden Terjadi','trim|required');
		$this->form_validation->set_rules('dampak','Dampak','trim|required');
		$this->form_validation->set_rules('probalitas','Probalitas','trim|required');
		$this->form_validation->set_rules('pelapor','Pelapor','trim|required');
    $this->form_validation->set_rules('ins_pas','Insiden Pasien','trim|required');
		$this->form_validation->set_rules('tempat','Tempat','trim');
		$this->form_validation->set_rules('unit_terkait','Unit Terkait','trim');
		$this->form_validation->set_rules('tindaklanjut','Tindak Lanjut','trim');
		$this->form_validation->set_rules('stlh_dilaku','Setelah Dilakukan','trim|required');
		$this->form_validation->set_rules('prnh_tjd','Pernah Terjadi','trim');
		$this->form_validation->set_rules('no_ulang','Kapan');
		$this->form_validation->set_rules('petugas','Petugas','trim|required');
		$this->form_validation->set_rules('karu','Kepala Unit/Bidang/Ruang','trim|required');
		$this->form_validation->set_rules('kmrkp','Ketua KMRKP','trim|required');
		$this->form_validation->set_rules('direktur','Direktur','trim|required');
    $this->form_validation->set_rules('grad_res','Grading Resiko','trim|required');

    if($this->form_validation->run() ==  TRUE)
    {
			$id_ikp   = $this->input->post('id_ikp' ,TRUE);
      $nama = $this->input->post('nama' ,TRUE);
			$no_mr = $this->input->post('no_mr' ,TRUE);
			$ruangan = $this->input->post('ruangan' ,TRUE);
			$umur = $this->input->post('umur' ,TRUE);
      $biaya = $this->input->post('biaya' ,TRUE);
			$jk = $this->input->post('jk' ,TRUE);
			$ram = $this->input->post('ram' ,TRUE);
			$tanggal_1 = $this->input->post('tanggal_1' ,TRUE);
      $waktu_1 = $this->input->post('waktu_1' ,TRUE);
			$tanggal_2 = $this->input->post('tanggal_2' ,TRUE);
      $waktu_2 = $this->input->post('waktu_2' ,TRUE);
			$insiden = $this->input->post('insiden' ,TRUE);
			$kronologi = $this->input->post('kronologi' ,TRUE);
			$jns_insiden = $this->input->post('jns_insiden' ,TRUE);
			$ins_tjd = $this->input->post('ins_tjd' ,TRUE);
			$dampak = $this->input->post('dampak' ,TRUE);
			$probalitas = $this->input->post('probalitas' ,TRUE);
      $pelapor = $this->input->post('pelapor' ,TRUE);
			$ins_pas = $this->input->post('ins_pas' ,TRUE);
			$tempat = $this->input->post('tempat' ,TRUE);
      $unit_terkait = $this->input->post('unit_terkait' ,TRUE);
			$tindaklanjut = $this->input->post('tindaklanjut' ,TRUE);
			$stlh_dilaku = $this->input->post('stlh_dilaku' ,TRUE);
			$prnh_tjd = $this->input->post('prnh_tjd' ,TRUE);
			$no_ulang = $this->input->post('no_ulang' ,TRUE);
			$petugas = $this->input->post('petugas' ,TRUE);
			$karu = $this->input->post('karu' ,TRUE);
			$kmrkp = $this->input->post('kmrkp' ,TRUE);
			$direktur = $this->input->post('direktur' ,TRUE);
			$grad_res = $this->input->post('grad_res' ,TRUE);


      $where = array(
        'id_ikp' => $id_ikp
      );

      $data = array(
				    'nama' => $nama,
						'no_mr' => $no_mr,
						'ruangan' => $ruangan,
						'umur' => $umur,
						'biaya' => $biaya,
						'jk' => $jk,
						'tanggal_1' => $tanggal_1,
            'waktu_1' => $waktu_1,
						'tanggal_2' => $tanggal_2,
            'waktu_2' => $waktu_2,
						'insiden' => $insiden,
						'kronologi' => $kronologi,
						'jns_insiden' => $jns_insiden,
						'ins_tjd' => $ins_tjd,
						'dampak' => $dampak,
						'probalitas' => $probalitas,
            'pelapor' => $pelapor,
            'ins_pas' => $ins_pas,
						'tempat' => $tempat,
						'unit_terkait' => $unit_terkait,
						'tindaklanjut' => $tindaklanjut,
						'stlh_dilaku' => $stlh_dilaku,
						'prnh_tjd' => $prnh_tjd,
						'no_ulang' => $no_ulang,
						'petugas' => $petugas,
						'karu' => $karu,
						'kmrkp' => $kmrkp,
						'direktur' => $direktur,
						'grad_res' => $grad_res
      );
      $this->M_admin->update('tb_ikp',$data,$where);

      $this->session->set_flashdata('msg_berhasil','Data IKP Berhasil di Update');
      redirect(base_url('admin/tabel_ikp'));
    }else {
      $this->load->view('admin/ikp/ikp_update');
    }
	}

  public function cetak_ikp(){

    $id_ikp = substr($this->uri->uri_string(3), 27);
     
    $sql_data_ikp = "SELECT * FROM tb_ikp ORDER BY tanggal_1 ASC";

    $sql_ikp    = "SELECT * id_ikp
                        FROM tb_ikp
                        WHERE id_ikp='$id_ikp'";

        $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', array(410,380));
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Image('http://localhost/ikp/assets/img/rsia_family.jpeg', 75, 5, 30);
        // $pdf->Image('', )
        // mencetak string 
        $pdf->Cell(65, 7, '', 0, 0, 'C');
        $pdf->Cell(260, 7, 'RSIA Family', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(45, 7, '', 0, 0, 'C');
        $pdf->Cell(300, 7, 'Jl. Pluit Mas Raya 1 Blok A No.2A-5A, RT.1/RW.18, Pejagalan, Kec. Penjaringan,', 0, 1, 'C');
				$pdf->Cell(43, 7, '', 0, 0, 'C');
        $pdf->Cell(300, 7, 'Kota Jakarta Utara, Daerah Khusus Ibukota Jakarta 14450', 0, 1, 'C');
				$pdf->Cell(83, 7, '', 0, 0, 'C');
        $pdf->Cell(220, 7, 'Telepon : (021) 669 5066. E-mail: info@rsiafamily.com ', 0, 1, 'C');
        $pdf->Line(10,40, 430-30, 40);
        $pdf->Line(10,40.8, 430-30, 40.8);
        
        $pdf->Cell(30, 7, '', 0, 1);

        $pdf->Cell(70, 7, '', 0, 0, 'C');
        $pdf->Cell(250, 7, 'Laporan Insiden Keselamatan Pasien', 0, 1, 'C');

        //tabel hasil input data ikp
        $pdf->Cell(15,7, '',0,0,'C');
        // $pdf->Cell(10, 7, '  No  ', 1, 0, 'C');
        $pdf->Cell(25, 7, ' No  ', 1, 0, 'C');
        $pdf->Cell(32, 7, ' Nama  ', 1, 0, 'C');
        $pdf->Cell(30, 7, ' No. MR  ', 1, 0, 'C');
        $pdf->Cell(40, 7, ' Ruangan  ', 1, 0, 'C');
				$pdf->Cell(15, 7, ' Umur  ', 1, 0, 'C');
				$pdf->Cell(25, 7, ' Penanggung Biaya Pasien  ', 1, 0, 'C');
        $pdf->Cell(20, 7, ' Jenis Kelamin  ', 1, 0, 'C');
				$pdf->Cell(35, 7, ' Tanggal Mendapatkan Pelayanan  ', 1, 0, 'C');
        $pdf->Cell(35, 7, ' Pukul  ', 1, 0, 'C');
				$pdf->Cell(35, 7, ' Tanggal & Waktu Insiden  ', 1, 0, 'C');
        $pdf->Cell(35, 7, ' Pukul  ', 1, 0, 'C');
				$pdf->Cell(23, 7, ' Insiden  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Kronologi  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Jenis Insiden*  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Insiden terjadi pada pasien*  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Dampak / Akibat Insiden  ', 1, 1, 'C');
        $pdf->Cell(30, 7, ' Probalitas*  ', 1, 0, 'C');
        $pdf->Cell(40, 7, ' Orang Pertama Yang Melaporkan Insiden*  ', 1, 0, 'C');
				$pdf->Cell(15, 7, ' Insiden Menyangkut Pasien*  ', 1, 0, 'C');
				$pdf->Cell(25, 7, ' Tempat  ', 1, 0, 'C');
        $pdf->Cell(20, 7, ' Unit Terkait  ', 1, 0, 'C');
				$pdf->Cell(35, 7, ' Tindaklanjut yang dilakukan  ', 1, 0, 'C');
				$pdf->Cell(35, 7, ' Tindaklanjut setelah dilakukan ', 1, 0, 'C');
				$pdf->Cell(23, 7, ' Pernah Terjadi ?  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Kapan ?  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Petugas  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Karu  ', 1, 0, 'C');
        $pdf->Cell(20, 7, ' Ketua KMRKP ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Direktur  ', 1, 0, 'C');
				$pdf->Cell(20, 7, ' Grading  ', 1, 0, 'C');


        $tampil = $this->db->query($sql_data_ikp)->result();
        foreach ($tampil as $t) {
        $pdf->Cell(15,7, '',0,0,'C');
        $pdf->Cell(10, 7, $t->id_ikp, 1, 0, 'C');
        $pdf->Cell(32, 7, $t->nama, 1, 0, 'C');
        $pdf->Cell(30, 7, $t->no_mr, 1, 0, 'C');
        $pdf->Cell(40, 7, $t->ruangan, 1, 0, 'C');
				$pdf->Cell(15, 7, $t->umur, 1, 0, 'C');
				$pdf->Cell(25, 7, $t->biaya, 1, 0, 'C');
        $pdf->Cell(20, 7, $t->jk, 1, 0, 'C');
        $pdf->Cell(25, 7, date('d-m-Y', strtotime($t->tanggal_1)), 1, 0, 'C');
        $pdf->Cell(20, 7, $t->waktu_1, 1, 0, 'C');
        $pdf->Cell(25, 7, date('d-m-Y', strtotime($t->tanggal_2)), 1, 0, 'C');
        $pdf->Cell(20, 7, $t->waktu_2, 1, 0, 'C');
				$pdf->Cell(35, 7, $t->insiden, 1, 0, 'C');
				$pdf->Cell(35, 7, $t->kronologi, 1, 0, 'C');
				$pdf->Cell(23, 7, $t->jns_insiden, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->ins_tjd, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->dampak, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->probalitas, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->pelapor, 1, 1, 'C');
        $pdf->Cell(32, 7, $t->ins_pas, 1, 0, 'C');
        $pdf->Cell(30, 7, $t->tempat, 1, 0, 'C');
        $pdf->Cell(40, 7, $t->unit_terkait, 1, 0, 'C');
				$pdf->Cell(15, 7, $t->tindaklanjut, 1, 0, 'C');
				$pdf->Cell(25, 7, $t->stlh_dilaku, 1, 0, 'C');
        $pdf->Cell(20, 7, $t->prnh_tjd, 1, 0, 'C');
				$pdf->Cell(35, 7, $t->no_ulang, 1, 0, 'C');
				$pdf->Cell(35, 7, $t->petugas, 1, 0, 'C');
				$pdf->Cell(23, 7, $t->karu, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->kmrkp, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->direktur, 1, 0, 'C');
				$pdf->Cell(20, 7, $t->grad_res, 1, 0, 'C');

        }

        $pdf->Cell(130, 10, '', 0, 1);
        $pdf->Cell(130, 10, '', 0, 1);
        $pdf->Cell(110, 10, '', 0, 0);
        $pdf->Cell(200, 10, 'Tanggal Cetak', 0, 0, 'R');
        $pdf->Cell(50, 10, ': '.date('d-m-Y '), 0, 0, 'R');


        $pdf->Output();
    }
	 ####################################
            // END IKP
	####################################

}
?>
