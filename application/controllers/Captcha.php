<?php
class Captcha extends CI_Controller {
function __construct()
    {
        parent::__construct();
    }
function index(){                 
     $ndata = array(
        'title'          => "",
        'keywords'       => "",
        'description'    => ""
        );            
    $this->load->view('tem-captcha',$ndata);            
    }  
function created(){
    $vals = array(
        'word' => '',
        'word_length' => 5,
        'img_path' => './pub/captcha/',
        'img_url' => base_url('pub/').'/captcha/',
        'font_path' => base_url('pub/font').'/wetpet.ttf',
        'img_width' => '100',
        'img_height' => 30,
        'expiration' => 7200
        );
    $cap = create_captcha($vals);
    $this->session->set_userdata($cap);
    //$_SESSION['captchaWord'] = $cap['word'];
    echo $cap['image'];  
}           
} 
?>  