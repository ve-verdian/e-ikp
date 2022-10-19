<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct(){
		parent::__construct();
		$this->load->model('M_admin');
    $this->load->library('upload');
	}

  public function index(){
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1){
			$data['title'] = 'Form IKP | Dashboard';
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
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
        $this->load->view('admin/profile',$config);
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
              // IKP
  ####################################

  public function ikp()
  {
		$data['title'] = 'Form IKP | Tambah Data IKP';
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/ikp/ikp_insert',$data);
  }

  public function tabel_ikp()
  {
		$data['title'] = 'Form IKP | Data IKP';
		$data['list_data'] = $this->M_admin->select('tb_ikp');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/tabel/tabel_ikp',$data);
  }

  public function update_ikp()
  {
		$data['title'] = 'Form IKP | Update Data IKP';
    $uri = $this->uri->segment(3);
    $where = array('id_ikp' => $uri);
		$data['ikp'] = $this->M_admin->get_data('tb_ikp', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('admin/ikp/ikp_update',$data);
  }

  public function delete_ikp()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_ikp' => $uri);
    $this->M_admin->delete('tb_ikp',$where);
    $this->session->set_flashdata('msg_hapus','Data IKP Berhasil di Hapus');
    redirect(base_url('admin/tabel_ikp'));
  }

  public function proses_ikp_insert()
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
			$tanggal_1 = date_format(date_create($this->input->post('tanggal_1')), 'Y-m-d');
      $waktu_1 = $this->input->post('waktu_1' ,TRUE);
			$tanggal_2 = date_format(date_create($this->input->post('tanggal_2')), 'Y-m-d');
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
            'tanggal_1' => $waktu_1,
						'tanggal_2' => $tanggal_2,
            'tanggal_1' => $waktu_2,
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
      redirect(base_url('admin/tabel_ikp'));
    }else {
      $this->load->view('admin/ikp/ikp_insert');
    }
  }

  public function proses_update_ikp()
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
			$id_ikp  = $this->input->post('id_ikp' ,TRUE);
      $nama = $this->input->post('nama' ,TRUE);
			$no_mr = $this->input->post('no_mr' ,TRUE);
			$ruangan = $this->input->post('ruangan' ,TRUE);
			$umur = $this->input->post('umur' ,TRUE);
      $biaya = $this->input->post('biaya' ,TRUE);
			$jk = $this->input->post('jk' ,TRUE);
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

    public function ikp_print() {
      $data['title'] = 'Cetak Data IKP';
      $uri = $this->uri->segment(3);
      $data['list_data']	= $this->db->query("SELECT * FROM tb_ikp WHERE id_ikp = '$uri'")->row();		
      $this->load->view('admin/ikp/print_ikp', $data);
    }
	 ####################################
            // END IKP
	####################################

}
?>
