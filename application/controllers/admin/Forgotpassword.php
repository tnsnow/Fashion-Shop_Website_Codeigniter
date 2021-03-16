<?php
	class ForgotPassword extends CI_Controller{

		public function __construct(){
			parent::__construct();
			//kiểm tra dữ liệu
	        $this->load->library('form_validation');
	        $this->load->helper('form');
	        $this->load->model('AdminModel');


		}

		public function  index()
		{

		$this->load->helper('phpmailer_helper');
        $this->load->helper('smtp_helper');


        if($this->input->post())
        {
            $this->form_validation->set_rules('email','Nhập vào email ','required|valid_email');
            $this->form_validation->set_rules('captcha','Nhập vào captcha ','required');
            if($this->form_validation->run())
            {
                $email             = $this->input->post('email');
                $captcha           = $this->input->post('captcha');
                $rcaptcha          = $this->input->post('rcaptcha');

                
                if($captcha != $rcaptcha){
                    $this->session->set_flashdata('message','Mã captcha không đúng vui lòng nhập lại.');
                    redirect(base_url('ForgotPassword'));
                }

                $input['where'] = array('email' =>$email);
                $data_email = $this->AdminModel-> get_list($input);
                //pre($data_email);
                
                if(empty($data_email))
                {
                    $this->session->set_flashdata('message','Email không tồn tại , bạn cần nhập đúng email đăng ký tài khoản.');
                    redirect(admin_url('ForgotPassword'));
                }

                foreach($data_email as $val )
                {
                    $id         = $val ->id;
                    $name       = $val ->name;
                    $email      = $val ->email;

                }

                $password = rand_string(8);
                


                //gửi thông báo tới mail .
                    $title ="Thay đổi mật khẩu !";
                    $content ="Xin Chào " . $name;
                    $content .= "Bạn vừa yêu cầu thay đổi mật khẩu . Mật khẩu mới của bạn là  : ".$password;
                    $nTo = $name;
                    $mTo = $email;
                    if(sendMail($title, $content, $nTo, $mTo,$diachicc='')){

                        $password = md5($password);
                        $data = array(
                                'password' => $password,
                            );

                        if($this->AdminModel->update($id,$data))
                        {
                            $this->session->set_flashdata('message','Mật khẩu mới đã được gửi tới mail của bạn');
                            redirect(admin_url('ForgotPassword'));

                        }
                    }else
                    {
                        $this->session->set_flashdata('message','Lỗi không thể lấy lại mật khẩu .');
                        redirect(admin_url('ForgotPasswordn'));
                    }


            }

        }

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

        $message = $this->session->flashdata('message');
        
        $this->data['message'] = $message;

        $captcha = create_captcha($vals);
        $this->data['captcha'] = $captcha;
        //pre($captcha);
		$this->load->view('backend/updatepassword/index',$this->data);
		}
	}
?>