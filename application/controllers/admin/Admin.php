<?php


class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');

       

        
    }
    /*
     * LẤY RA DANH SÁCH ADMIN
     */
    function index()
    {
        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }

        if(supperAdmin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền truy cập');
            redirect(admin_url());
        }
    
        $input = array();
        // lấy ra danh sách admin
        $list= $this->AdminModel->get_list($input);
        $this->data['list'] = $list; // trả sang view
        // lấy ra số quản trị viên 
        $total = $this->AdminModel->get_total();
        $this->data['total'] = $total; // trả sang view 
        // lấy ra nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message; // nhận thông báo từ set_flashdata('message','Insert  thành công');
        $this->data['temp'] = 'backend/admin/index';
        $this->load->view('backend/main',$this->data);
    }

    /*
     *  Kiểm tra user name đã tồn tại hay chưa
     */
    function check_username()
    {
       $username = $this->input->post('username');
        $where = array('username'=> $username);
        if($this->AdminModel->check_exists($where))
        {
            // trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__,'Tài khoản đã tồn tại');
            return false;

        }
        else{
            return true;
        }

    }
    function add()
    {

        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }

        if(supperAdmin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền truy cập');
            redirect(admin_url());
        }
        // load ra thư viện validate 
        $this->load->library('form_validation');
        // load ra thư viện để hiển thi lỗi 
        $this->load->helper('form');

        // nếu có dữ liêu post lên thì kiểm tra

        if($this->input->post())
        {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('name','Nhập vào họ và tên ','required');
            $this->form_validation->set_rules('username','Nhập vào tên đăng nhập','required|min_length[5]|callback_check_username');
            $this->form_validation->set_rules('email','Nhập vào email ','required|valid_email');
            $this->form_validation->set_rules('password','Nhập vào mật khẩu','required|min_length[6]');
            $this->form_validation->set_rules('re_password','Nhập Lại Mật Khẩu','required|matches[password]');
            $this->form_validation->set_rules('roles','Chọn quyền ','required');
            // nhâp liệu chính xác , chạy validate dữ liệu
            if($this->form_validation->run())
            {
                $username   = $this->input->post('username');
                $name       = $this->input->post('name');
                $email      = $this->input->post('email');
                $password   = $this->input->post('password');
                $roles      = $this->input->post('roles');
                $status      = $this->input->post('rdoStatus');
                $data       = array(

                    'username'  =>$username,
                    'name'      => $name,
                    'email'     =>$email,
                    'password'  =>md5($password),
                    'roles'     =>$roles,
                    'status'     =>$status,

                );


                if($this->AdminModel->create($data))
                {
                    // gửi thông báo qua view 
                    $this->session->set_flashdata('message','Insert  thành công');
                }
                else{
                    $this->session->set_flashdata('message','Lỗi không thể insert dữ liệu');
                }
                // chuyển tới trang danh sách quản trị viên.
               redirect(admin_url('admin'));
                // thêm vào csdl
            }
        }
        $this->data['temp'] = 'backend/admin/add';
        $this->load->view('backend/main',$this->data);
    }

    function edit()
    {
        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }

        if(supperAdmin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền truy cập');
            redirect(admin_url());
        }
        // load ra thư viện validate và thông báo lỗi trên form 
        $this->load->library('form_validation');
        $this->load->helper('form');
        // lấy ra id của quản trị viên cần chỉ sửa
        $id = $this->uri->rsegment(3);
        // lấy ra thông tin quản trị viên
        $info = $this->AdminModel->get_info($id);

        // kiểm tra thông tin của quản trị viên có tồn tại
        if(!$info)
        {
            $this->session->set_flashdata('message','Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        // gửi thông tin qua view
        $this->data['info'] = $info;

        if($this->input->post())
        {
            $pass = $this->input->post('password');
            $username = $this->input->post('username');

            if($username != $info->username)
            {
                $this->form_validation->set_rules('username','Tên đăng nhập','required|min_length[5]|callback_check_username');
            }

            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('name','Họ và tên','required');
            
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('roles','Chọn quyền ','required');

            
            // kiểm tra có tồn tại pass word
            
            if($pass)
            {
                $this->form_validation->set_rules('password','Mật Khẩu','required|min_length[6]');
                $this->form_validation->set_rules('re_password','Nhập Lại Mật Khẩu','required|matches[password]');
            }

            // nhâp liệu chính xác
            if($this->form_validation->run())
            {
                $username   = $this->input->post('username');
                $name       = $this->input->post('name');
                $email      = $this->input->post('email');
                $password   = $this->input->post('password');
                $roles      = $this->input->post('roles');
                $status      = $this->input->post('rdoStatus');

                $data= array(

                    'username'  =>$username,
                    'name'      => $name,
                    'email'     =>$email,
                    'roles'     =>$roles,
                    'status'     =>$status,

                );
                if (!empty($password))
                {
                    $data= array(
                        'password'=>md5($password),

                    );
                }
                if($this->AdminModel->update($id,$data))
                {
                    $this->session->set_flashdata('message','Update  thành công');
                }
                else{
                    $this->session->set_flashdata('message','Lỗi không thể Update  dữ liệu');
                }
                // chuyển tới trang danh sách quản trị viên.
                redirect(admin_url('admin'));
                // thêm vào csdl
            }
        }
        $this->data['temp'] = 'backend/admin/edit';
        $this->load->view('backend/main',$this->data);
    }

    function delete()
    {
        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }

        if(supperAdmin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền xóa ');
            redirect(admin_url());
        }
        
        $id= $this->uri->rsegment(3);
        $id = intval($id);
        // lấy ra thông tin của quản trị viên
        $info = $this->AdminModel->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Không tồn tại quản trị viên');
            redirect(admin_url('admin'));
        }
        
        // thực hiên xóa
        if($this->AdminModel->delete($id))
        {
            $this->session->set_flashdata('message','Delete  thành công');
        }
        else{
            $this->session->set_flashdata('message','Lỗi không thể delete  dữ liệu');
        }

        // chuyển tới trang danh sách quản trị viên.
        redirect(admin_url('admin'));

    }



    /*
     * thực hiện đăng xuất
     */
    function logout()
    {
        if($this->session->userdata('login'))
        {
            $this->session->unset_userdata('login');
        }
        redirect(admin_url('login'));
    }
}