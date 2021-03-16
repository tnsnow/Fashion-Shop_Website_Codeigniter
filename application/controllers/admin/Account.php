<?php 
	class Account extends MY_Controller
	{
	    function __construct()
	    {
	        parent::__construct();
	        $this->load->model('AdminModel');
	    }

	    public function index()
	    {

	        $user = $this->session->userdata('userdata');

	        foreach ($user as $key => $value) {
	            # code...
	            $id = $value ->id ;
	        }

	        
	        $user = $this->AdminModel->get_info($id);

	        $this->data['user'] = $user;
	        
	        $this->data['temp'] = 'backend/account/index';
	        $this->load->view('backend/main',$this->data);
	    }

	function reset_password()
    {

        $this->load->library("session");
        $this->load->library('form_validation');
        $this->load->helper('form');
        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $id = $value ->id ;
        }

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
                $user = $this->AdminModel->get_info($id);
                //kiểm tra passwor có trùng khớp
                if($user ->password == $PasswordOld )
                {
                    $password = $this->input->post('RePassword');
                    $password = md5($password);

                    $data = array(

                        'password' => $password,

                    );

                    if ($this->AdminModel->update($id,$data)) {


                        $this->session->set_flashdata('message', 'Thay đổi thành công ');

                        redirect(admin_url('admin/logout'));
                    } else {
                        $this->session->set_flashdata('message', ' Mật khẩu không trùng khớp');
                    }
                    // chuyển tới trang danh sách quản trị viên.
                   

                }
                else{
                    
                    $this->session->set_flashdata('message', ' Mật khẩu không đúng');
                }

                // thêm vào csdl
            }

            
        }
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message; 
        
        $this->data['temp'] = 'backend/account/reset';
        $this->load->view('backend/main',$this->data);
    }

	}
?>