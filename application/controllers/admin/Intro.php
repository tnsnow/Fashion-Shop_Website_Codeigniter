<?php


class Intro extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('IntroModel');
        $user = $this->session->userdata('userdata');

            foreach ($user as $key => $value) {
                # code...
                $roles = $value ->roles ;
            }

            if(supperAdmin($roles,admin_url())){

                $this->session->set_flashdata('message','Bạn không có quyền vào đây');
                redirect(admin_url());
            }
    }

    /*
     * Hiển thị danh sách bài viết
     */
    public  function index()
    {

        //lấy ra thông tin bảng giới thiệu
        $list = $this->IntroModel->get_list();
        $this->data['list'] = $list;

        // lấy ra nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        // load view
        $this->data['temp'] = 'backend/intro/index';
        $this->load->view('backend/main',$this->data);
    }

    /*
     * Thêm mới bài viết
     *
     */
    public function add()
    {

        //kiểm tra dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');

        if($this->input->post())
        {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('title','Nhập vào tiêu đề giới thiệu ','required');
            $this->form_validation->set_rules('name','Nhập vào tên công ty .','required');
            $this->form_validation->set_rules('phone','Nhập vào số điện thoại .','required|numeric');
            $this->form_validation->set_rules('email','Nhập vào email .','required|valid_email');
            $this->form_validation->set_rules('address','Nhập vào địa chỉ .','required');
            $this->form_validation->set_rules('content','Nhập vào nội dung giới thiệu . ','required');

            // nhâp liệu chính xác
            if($this->form_validation->run())
            {

                $title = $this->input->post('title');
                $name = $this->input->post('name');
                $phone = $this->input->post('phone');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                // lấy tên file ảnh được upload lên

                $this->load->library('upload_library');


                $data= array(
                    'title'         => $title,
                    'name'          => $name,
                    'phone'         => $phone,
                    'email'         => $email,
                    'address'       => $address,
                    'content'       => $this->input->post('content'),
                    

                );
                if($this->IntroModel->create($data))
                {
                    $this->session->set_flashdata('message','Insert  thành công');
                }
                else{
                    $this->session->set_flashdata('message','Lỗi không thể insert dữ liệu');
                }
                // chuyển tới trang danh sách quản trị viên.
                redirect(admin_url('intro'));
                // thêm vào csdl
            }
        }

        // load view
        $this->data['temp'] = 'backend/intro/add';
        $this->load->view('backend/main',$this->data);
    }
    /*
     * Chỉnh sửa bài viết .
     */
    public function edit()
    {
        $id = $this->uri->rsegment('3');
        $intro = $this->IntroModel->get_info($id);
        if(!$intro)
        {

            $this->session->set_flashdata('message','Bài viết không tồn tại ');
            redirect(admin_url('intro'));
        }
        $this->data['news'] = $intro;
        $this->load->library('form_validation');
        $this->load->helper('form');

        if ($this->input->post()) {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('title','Nhập vào tiêu đề giới thiệu ','required');
            $this->form_validation->set_rules('name','Nhập vào tên công ty .','required');
            $this->form_validation->set_rules('phone','Nhập vào số điện thoại .','required|numeric');
            $this->form_validation->set_rules('email','Nhập vào email .','required|valid_email');
            $this->form_validation->set_rules('address','Nhập vào địa chỉ .','required');
            $this->form_validation->set_rules('content','Nhập vào nội dung giới thiệu . ','required');

            // nhâp liệu chính xác
            if ($this->form_validation->run()) {

                $title = $this->input->post('title');
                $name = $this->input->post('name');
                $phone = $this->input->post('phone');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                // lấy tên file ảnh được upload lên


                 $data= array(
                    'title'         => $title,
                    'name'          => $name,
                    'phone'         => $phone,
                    'email'         => $email,
                    'address'       => $address,
                    'content'       => $this->input->post('content'),
                    

                );
                if ($this->IntroModel->update($id, $data)) {
                    $this->session->set_flashdata('message', 'Update  thành công');
                } else {
                    $this->session->set_flashdata('message', 'Lỗi không thể update dữ liệu');
                }
                // chuyển tới trang danh sách quản trị viên.
                redirect(admin_url('intro'));

            }
        }

        // load view
        $this->data['temp'] = 'backend/intro/edit';
        $this->load->view('backend/main', $this->data);

    }

    /*
     * Delete Bài viết
     */
    public function delete()
    {
        $id = $this->uri->rsegment('3');
        $this->_del($id);

        $this->session->set_flashdata('message','Xóa thành công bài viết ');
        redirect(admin_url('intro'));

    }
    private  function _del($id, $rediect = true)
    {
        $new = $this->IntroModel->get_info($id);
        if(!$new)
        {

            $this->session->set_flashdata('message','Bài viết không tồn tại ');
            if ($rediect)
            {
                redirect(admin_url('intro'));
            }
            else
            {
                return false;
            }
        }

        // thực hiện xóa sản phẩm .
        $this->IntroModel->delete($id);


    }



}