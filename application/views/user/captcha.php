<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Membuat Captcha di CodeIgniter 3</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>

    <body>
        
        <?php 

        if ($this->session->flashdata('pesan_form')):
            echo $this->session->flashdata('pesan_form');
        endif
        
        ?>
        
        <form action="<?=base_url('captcha/check_captcha');?>" method="post">
        
            <?=$captcha?><br/>

            Masukan kode captcha yang sesuai gambar di atas<br/>
            <input type="text" name="captcha">
            <button>Submit</button>

        </form>
    </body>
</html>