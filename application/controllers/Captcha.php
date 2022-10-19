<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Captcha extends CI_Controller
{
    public function index()
{
    $vals = [
    	// 'word' -> nantinya akan digunakan sebagai random teks yang akan keluar di captchanya
        'word'          => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5),
        'img_path'      => './assets/images/captcha/',
        'img_url'       => base_url('assets/images/captcha/'),
        'img_width'     => 150,
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 5,
        'font_size'     => 18,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        'colors'        => [
                'background'=> [255, 255, 255],
                'border'    => [255, 255, 255],
                'text'      => [0, 0, 0],
                'grid'      => [255, 40, 40]
        ]
    ];
    
    $captcha = create_captcha($vals);
    $image = $captcha['image'];

    $this->session->set_userdata('captcha', $captcha['word']);
    return $image;
    // $this->load->view('user/captcha', ['captcha' => $captcha['image']]);
}

public function check_captcha() 
{
    $post_code  = $this->input->post('captcha');
    $captcha    = $this->session->userdata('captcha');
    
    if ($post_code && ($post_code == $captcha)) 
        $this->session->set_flashdata('pesan_form', '<font style="color: green"><b>Berhasil memverifikasi captcha.</b></font><br/><br/>');
    else
        $this->session->set_flashdata('pesan_form', '<font style="color: red"><b>Captcha yang Anda ketik salah!</b></font><br/><br/>');

    redirect('captcha');
}

}

