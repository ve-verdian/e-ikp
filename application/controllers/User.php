<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('M_user');
    $this->load->model('M_admin');
  }

  public function index()
  {
    if($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 0)
    {
      $this->load->view('user/templates/header');
      $this->load->view('user/cover/cover');
      $this->load->view('user/templates/footer');
    }else {
      $this->load->view('login/login');
    }
  }

  public function token_generate()
  {
    return $tokens = md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password,PASSWORD_DEFAULT);
  }

  public function setting()
  {
      $data['token_generate'] = $this->token_generate();
      $this->session->set_userdata($data);

      $this->load->view('user/templates/header');
      $this->load->view('user/setting',$data);
      $this->load->view('user/templates/footer');
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('new_password','New Password','required|trim');
    $this->form_validation->set_rules('confirm_new_password','Confirm New Password','required|trim|matches[new_password]');

    if($this->form_validation->run() == TRUE)
    {
      if($this->session->userdata('token_generate') === $this->input->post('token'))
      {
        $username = $this->input->post('username');
        $new_password = $this->input->post('new_password');

        $data = array(
            'password' => $this->hash_password($new_password)
        );

        $where = array(
            'id' =>$this->session->userdata('id')
        );

        $this->M_user->update_password('user',$where,$data);

        $this->session->set_flashdata('msg_berhasil','Password Telah Diganti');
        redirect(base_url('user/setting'));
      }
    }else {
      $this->load->view('user/setting');
    }
  }

  public function signout()
  {
      session_destroy();
      redirect(base_url());
  }
  
    ####################################
        // DATA IKP
  ####################################

  public function ikp()
  {
		$data['title'] = 'Form IKP | Tambah Data IKP';
    $data['avatar'] = $this->M_user->get_data_gambar('tb_upload_gambar_user',$this->session->userdata('name'));
    $this->load->view('user/checkout/checkout',$data);
  }

  public function tabel_ikp()
  {
    $data['list_data'] = $this->M_user->select('tb_ikp');
    $this->load->view('user/tabel/ikp_tabel',$data);
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
      $this->M_user->insert('tb_ikp',$data);
 
      $this->session->set_flashdata('msg_berhasil','Data IKP Berhasil di Tambahkan');
      redirect(base_url('user/tabel_ikp'));
    }else {
      $this->load->view('user/checkout/checkout');
    }
  }
}

?>
