<?php

class CategoryNew extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('CategoryNewModel');
        $this->load->model('NewModel');
        $this->load->library('form_validation');
        $this->load->helper('form');

        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }

        if(admin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền vào đây');
            redirect(admin_url());
        }
    }

    function index()
    {
        $list = $this->CategoryNewModel->get_list();

        // lấy ra tổng số sản phẩm
        $total = $this->CategoryNewModel->get_total();

        $this->data['total']    = $total;
        $this->data['list']     = $list;
        

        // lấy ra nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;

        //pre($list);
        // load ra view
        $this->data['temp'] = 'backend/categorynew/index';
        $this->load->view('backend/main',$this->data);
    }
    // thêm mới dữ liệu

    function add()
    {
        //kiểm tra dữ liệu
       

        if($this->input->post())
        {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('name','Nhập vào tên danh mục ','required');
            $this->form_validation->set_rules('sort_order','Nhập vào thứ tự hiển thị danh mục ','required');

            // nhâp liệu chính xác
            if($this->form_validation->run())
            {

                $name       = $this->input->post('name');
                $sort_order = $this->input->post('sort_order');
                $status     = $this->input->post('rdoStatus');

                $data= array(
                    'name'          => $name,
                    'sort_order'    =>intval($sort_order),
                    'status'        =>$status,

                );
                $input['where'] = array('name' =>$name);

                $list_data = $this->CategoryNewModel->get_list($input);
                if(!empty($list_data))
                {
                    $this->session->set_flashdata('message','Tên danh mục đã tồn tại');
                    redirect(admin_url('categorynew'));
                }


                if($this->CategoryNewModel->create($data))
                {
                    $this->session->set_flashdata('message','Insert  thành công');
                }
                else{
                    $this->session->set_flashdata('message','Lỗi không thể insert dữ liệu');
                }
                // chuyển tới trang danh sách quản trị viên.
                redirect(admin_url('categorynew'));
                // thêm vào csdl
            }
        }
         // lấy ra danh mục cha

        $this->data['temp'] = 'backend/categorynew/add';
        $this->load->view('backend/main',$this->data);

    }
    function edit()
    {

      
        // lấy ra dữ liệu để hiển thị
        $id = $this->uri->rsegment(3);
        $list = $this->CategoryNewModel->get_info($id);
        if(!$list)
        {
            $this->session->set_flashdata('message','Không tồn tại danh mục tin tức');
            redirect(admin_url('categorynew'));
        }
        $this->data['list'] = $list;
        if($this->input->post())
        {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('name','Nhập vào tên danh mục tin tức ','required');
            $this->form_validation->set_rules('sort_order','Nhập vào thứ tự hiển thị danh mục ','required');

            // nhâp liệu chính xác
            if($this->form_validation->run())
            {

                $name           = $this->input->post('name');
                $sort_order     = $this->input->post('sort_order');
                $status         = $this->input->post('rdoStatus');

                $data= array(
                    'name'          => $name,
                    'sort_order'    =>$sort_order,
                    'status'        =>$status,
                );


                if($this->CategoryNewModel->update($id,$data))
                {
                    $this->session->set_flashdata('message','Update  thành công');
                }
                else{
                    $this->session->set_flashdata('message','Lỗi không thể Update dữ liệu');
                }
                // chuyển tới trang danh sách quản trị viên.
                redirect(admin_url('categorynew'));
                // thêm vào csdl
            }
        }
        
        $this->data['temp'] = 'backend/categorynew/edit';
        $this->load->view('backend/main',$this->data);

    }

    function delete()
    {
        $id = $this->uri->rsegment(3);
        $this->_del($id);
        $this->session->set_flashdata('message','Delet thành công danh mục tin tức');
        redirect(admin_url('categorynew'));


    }
    /*
     * Xóa nhiều sản phẩm
     */
    public  function deleteAll()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id,false);
        }
        $this->session->set_flashdata('message','Delet thành công danh mục tin tức');
        redirect(admin_url('categorynew'));
    }

//POST http://localhost/www/CodeIgniter/admin/product/deleteAll

/*
 * Thực hiện xóa
 */
    private function _del($id , $rediect = true)
    {
        $info = $this->CategoryNewModel->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Không tồn tại danh mục tin tức');
            if ($rediect)
            {
                redirect(admin_url('categorynew'));
            }
            else
            {
                return false;
            }
        }
        // kiểm tra xem danh mục này có sản phẩm không
        $input['where'] = array('newcatalog_id'=>$id);
        $news        = $this->NewModel->get_list($input);
        
        
        if(!empty($news))
        {
            $this->session->set_flashdata('message','Không thể xóa danh mục tin tức (Bạn cần xóa các bài viết thuộc danh mục trước)');
            if ($rediect)
            {
                redirect(admin_url('categorynew'));
            }
            else
            {
                return false;
            }

        }

         $this->CategoryNewModel->delete($id);
        

    }


}