<?php


class User extends  MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library("session");
        $this->load->model('UserModel');
        $this->load->library('form_validation');
        $this->load->helper('form');


    }

    /*
     *  Kiểm tra email đã tồn tại hay chưa
     */
    function check_email()
    {
        $email = $this->input->post('email');
        $where = array('email'=> $email);
        if($this->UserModel->check_exists($where))
        {
            // trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__,'Email khoản đã tồn tại');
            return false;

        }
        else{
            return true;
        }

    }

    /*
     * hàm đăng ký thành viên
     */

    function register()
    {

        // nếu có dữ liêu post lên thì kiểm tra

        if($this->input->post()) {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('name', 'Tên tài khoản', 'required');
            $this->form_validation->set_rules('email', 'Email đăng nhập', 'required|callback_check_email');
            $this->form_validation->set_rules('password', 'Nhập vào mật khẩu', 'required|min_length[8]');
            $this->form_validation->set_rules('repassword', 'Mật khẩu không trùng khớp.', 'required|matches[password]');
            $this->form_validation->set_rules('user_name', 'Nhập vào họ và tên', 'required');
            $this->form_validation->set_rules('phone', 'Số điện thoai phải ở định dạng số', 'required|min_length[10]');
            // nhâp liệu chính xác
            if ($this->form_validation->run()) {
                $name = $this->input->post('name');
                $username = $this->input->post('user_name');
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $password = md5($password);
                $sex = $this->input->post('sex');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $data = array(
                    'user_name' => $username,
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                    'sex' => $sex,
                    'phone' =>$phone,
                    'address' =>$address,
                    'created' =>NOW(),

                );
                if ($this->UserModel->create($data)) {
                    $user = $this->get_user_info();
                    $this->session->set_userdata('user_login',$user->id);
                    $this->session->set_flashdata('message', 'Đăng ký thành công ');
                } else {
                    $this->session->set_flashdata('error', ' Lồi không thể đăng ký tài khoản');
                }
                // chuyển tới trang danh sách quản trị viên.
                redirect(base_url());
                // thêm vào csdl
            }
        }


        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'fontend/user/register';
        $this ->load ->view('fontend/details',$this->data);
    }

    /*
     * check login
     */

    function login()
    {


        if($this->input->post())
        {
            $this->form_validation->set_rules('email', 'Nhập vào email đăng nhập', 'required');
            $this->form_validation->set_rules('password', 'Nhập vào mật khẩu', 'required|min_length[8]');

            $this->form_validation->set_rules('login','login','callback_check_login');
            if($this->form_validation->run())
            {
                // lấy thông tin thành viên
                $user = $this->get_user_info();
                // gán session id thành viên đăng nhập
                $this->session->set_userdata('user_login',$user->id);
                $this->session->set_flashdata('success', 'Đăng nhâp thành công ');
                redirect(base_url());
            }
            else{
                $this->session->set_flashdata('error', 'Thông tin tài khoản không chính xác.');
            }


        }

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        $this->data['temp'] = 'fontend/user/login';
        $this ->load ->view('fontend/details',$this->data);
    }

    function check_login()
    {
        //$user = $this->get_user_info();
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = md5($password);
        $where = array('email'=>$email , 'password'=>$password);
        if($this ->UserModel->get_info_rule($where))
        {
            return true;
        }
        $this->session->set_flashdata('error', 'Thông tin tài khoản mật khẩu không đúng');
        $this->form_validation->set_message(__FUNCTION__,'Thông tin tài khoản không chính xác');
        return false;


    }
    /*
     * lấy ra thông tin thành viên
     */
    function  get_user_info()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $password = md5($password);
        $where = array('email'=>$email , 'password'=>$password);
        $user = $this ->UserModel->get_info_rule($where);
        return $user;

    }
    /*
     * chỉnh sứa thông tin thành viên
     */

    function  member()
    {
        if(!$this->session->userdata('user_login'))
        {
            redirect(base_url('dang-nhap.html'));
        }
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id = intval($this->uri->rsegment('3'));

        // nếu có dữ liêu post lên thì kiểm tra

        if($this->input->post()) {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('user_name', 'Nhập vào họ và tên', 'required');
            $this->form_validation->set_rules('phone', 'Số điện thoai ở định dạng số', 'required|numeric');
            // nhâp liệu chính xác
            if ($this->form_validation->run()) {
                $username = $this->input->post('user_name');
                $sex = $this->input->post('sex');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $data = array(
                    'user_name' => $username,
                    'sex' => $sex,
                    'phone' =>$phone,
                    'address' =>$address,

                );
                if ($this->UserModel->update($id,$data)) {
                    $this->session->set_flashdata('success','Update thành công');
                } else {
                    $this->session->set_flashdata('error', ' Lồi không thể update tài khoản');
                }
                // chuyển tới trang danh sách quản trị viên.
                //redirect(base_url());
                // thêm vào csdl
            }
        }

        $this->data['temp'] = 'fontend/user/member';
        $this ->load ->view('fontend/details',$this->data);

    }

    function reset_password()
    {

        $this->load->library("session");
        $this->load->library('form_validation');
        $this->load->helper('form');
        $id = intval($this->uri->rsegment('3'));

        // nếu có dữ liêu post lên thì kiểm tra

        if($this->input->post()) {
            // vào system /language/english để sửa lỗi chũw

            $this->form_validation->set_rules('PasswordOld', 'Nhập vào mật khẩu cũ.', 'required|min_length[8]');
            $this->form_validation->set_rules('Password', 'Nhập mật khẩu mới .', 'required|min_length[8]');
            $this->form_validation->set_rules('RePassword', 'Nhập lại mật khẩu không trùng khớp .', 'required|matches[Password]');
            // nhâp liệu chính xác
            if ($this->form_validation->run()) {
                $PasswordOld = $this->input->post('PasswordOld');
                $PasswordOld = md5($PasswordOld);
                $user = $this->UserModel->get_info($id);
                //kiểm tra passwor có trùng khớp
                if($user ->password == $PasswordOld )
                {
                    $password = $this->input->post('Password');
                    $password = md5($password);

                    $data = array(

                        'password' => $password,

                    );
                    //pre($data);
                    if ($this->UserModel->update($id,$data)) {

                        $this->session->set_flashdata('success', 'Thay đổi thành công ');
                    } else {
                        $this->session->set_flashdata('error', ' Mật khẩu không trùng khớp');
                    }
                    // chuyển tới trang danh sách quản trị viên.
                   

                }
                else{
                    
                    $this->session->set_flashdata('error', ' Mật khẩu không đúng');
                }

                // thêm vào csdl
            }
        }
        $this->data['temp'] = 'fontend/user/reset_password';
        $this ->load ->view('fontend/details',$this->data);

    }

    public function forgotPassword()
    {
        
        $this->load->helper('phpmailer_helper');
        $this->load->helper('smtp_helper');

        $this->load->library('form_validation');
        $this->load->helper('form');

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
                    redirect(base_url('lay-lai-mat-khau.html'));
                }

                $input['where'] = array('email' =>$email);
                $data_email = $this->UserModel -> get_list($input);
                //pre($data_email);
                
                if(empty($data_email))
                {
                    $this->session->set_flashdata('message','Email không tồn tại , bạn cần nhập đúng email đăng ký tài khoản.');
                    redirect(base_url('lay-lai-mat-khau.html'));
                }

                foreach($data_email as $val )
                {
                    $id         = $val ->id;
                    $name       = $val ->user_name;
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

                        if($this->UserModel->update($id,$data))
                        {
                            $this->session->set_flashdata('message','Mật khẩu mới đã được gửi tới mail của bạn');
                            redirect(base_url('lay-lai-mat-khau.html'));

                        }
                    }else
                    {
                        $this->session->set_flashdata('message','Lỗi không thể lấy lại mật khẩu .');
                        redirect(base_url('lay-lai-mat-khau.html'));
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
        $captcha = create_captcha($vals);
        $this->data['captcha'] = $captcha;



        $this->data['temp'] = 'fontend/user/forgotpassword';
        $this ->load ->view('fontend/details',$this->data);

    }


    public function captcha()
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
        $filename   = $captcha['filename'];
        $time       = $captcha['time'];
        $word       = $captcha['word'];
        $text       = $captcha['image'];
        $text       = substr( $text,26,66);
        $captcha = array(
                'word'     =>$word,
                'image'    =>$text,
                'time'     =>$time,
                'filename' =>$filename,
            );
        

        die (json_encode($captcha));
    }

    function logout()
    {
        if($this->session->userdata('user_login'))
        {
            $this->session->unset_userdata('user_login');
        }
        redirect(base_url('dang-nhap.html'));
    }

}