<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('M_login');
	}
	public function index()
	{
		$data['title'] = 'Form IKP | Sign In';
		$data['token_generate'] = $this->token_generate();
		$this->session->set_userdata($data);
		$this->load->view('login/login',$data);
	}

	// public function captcha()
    // {
    //     $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));
 
    //     $userIp=$this->input->ip_address();
     
    //     $secret = $this->config->item('google_secret');
   
    //     $url="https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$recaptchaResponse."&remoteip=".$userIp;
 
    //     $ch = curl_init(); 
    //     curl_setopt($ch, CURLOPT_URL, $url); 
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    //     $output = curl_exec($ch); 
    //     curl_close($ch);      
         
    //     $status= json_decode($output, true);
 
    //     if ($status['success']) {
    //         print_r('Google Recaptcha Successful');
    //         exit;
    //     }else{
    //         $this->session->set_flashdata('flashError', 'Sorry Google Recaptcha Unsuccessful!!');
    //     }
 
    // }   

	public function token_generate(){
		return $tokens = md5(uniqid(rand(), true));
	}

	public function register(){
		$data['title'] = 'Form IKP | Sign Up';
		$this->load->view('login/register');
	}

	public function proses_login(){
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');
		// $this->input->post('g-recaptcha-response');

		if($this->form_validation->run() == TRUE){
			$username = $this->input->post('username',TRUE);
			$password = $this->input->post('password',TRUE);
			// $recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

		if($this->session->userdata('token_generate') === $this->input->post('token'))
		{
			$cek =  $this->M_login->cek_user('user',$username);
			if( $cek->num_rows() != 1){
				$this->session->set_flashdata('msg','Username Belum Terdaftar Silahkan Register Dahulu');
				redirect(base_url());
			}else {

				$isi = $cek->row();
				if(password_verify($password,$isi->password) === TRUE){
					$data_session = array(
									'id' => $isi->id,
									'name' => $username,
									'email' => $isi->email,
									'status' => 'login',
									'role' => $isi->role,
									'last_login' => $isi->last_login
					);

					$this->session->set_userdata($data_session);

					$this->M_login->edit_user(['username' => $username],['last_login' => date('d-m-Y G:i')]);

						if($isi->role == 1){
							redirect(base_url('admin'));
						}else {
							redirect(base_url('user'));
						}

				}else {
					$this->session->set_flashdata('msg','Username dan Password Salah');
					redirect(base_url());
				}
			}
		}else {
			redirect(base_url());
		}
	}
}
}
