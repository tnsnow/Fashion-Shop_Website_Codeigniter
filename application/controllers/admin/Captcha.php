<?php
class Captcha extends CI_Controller {
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        
        $this->load->helper('captcha');
        $vals = array(
            'img_path'      => './upload/capchar/',
            'img_url'       => base_url().'/upload/capchar/',
            'img_width'     => '120',
            'img_height'    => 34,
            'expiration'    => 0,
            'word_length'   => 8,
            'font_size'     => 25,
            'img_id'        => 'imgCaptcha',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'colors'        => array(
            'background'    => array(235, 235, 235),
            'border'        => array(51, 51, 51),
            'text'          => array(255, 0, 0),
            'grid'          => array(255, 255, 255)
            )
        );  
        $captcha = create_captcha($vals);
        //pre($captcha);
        $text = $captcha['image'];
        echo $text = substr( $text,26,59);
    }

} 
?>  