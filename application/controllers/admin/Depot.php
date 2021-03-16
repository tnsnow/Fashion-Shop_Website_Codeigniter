<?php

class Depot extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TransactionModel');
        $this->load->model('NewModel');
        $this->load->model('ProductModel');
        $this->load->model('CatalogModel');
        $this->load->model('UserModel');
        $this->load->model('ContactModel');

        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }

        if(admin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền truy cập');
            redirect(admin_url());
        }
    }
    /*
     * Danh sách giao dich cua website
     */
    public  function index()
    {
        

        // lấy ra số lượng các sản phẩm trên website
        $total_row                  = $this->ProductModel->get_total();
        
        // thư viện phân trang
        $this->load->library('pagination');
        $config                 = array();
        $config['total_rows']   =  $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url']     =  admin_url('depot/index'); // link hiển thị dữ lieeu danh sách sản phẩm
        $config['per_page']     =  8; // số sản phẩm hiển thị trên 1 trang
        $config['uri_segment']  = 4; // phân đoạn hiển thị số trnag
        $config['next_link']    = 'Next' ; //Nhãn tên của nút Next
        $config['prev_link']    = 'Previous' ; //Nhãn tên của nút Previous
        // khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment        = $this->uri->segment(4);
        $segment        = intval($segment);
        $input          = array();
        $input['limit'] = array($config['per_page'],$segment );

        $input['order'] = array('total','DESC');
        $list = $this->ProductModel->get_list($input);

        $this->data['list'] =  $list;

       

        $this->data['temp']='backend/depot/index';
        $this->load->view('backend/main',$this->data);
    }

    public function showSelling()
    {

        // lấy ra số lượng các sản phẩm trên website
        $total_row                  = $this->ProductModel->get_total();
        
        // thư viện phân trang
        $this->load->library('pagination');
        $config                 = array();
        $config['total_rows']   =  $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url']     =  admin_url('depot/showSelling'); // link hiển thị dữ lieeu danh sách sản phẩm
        $config['per_page']     =  8; // số sản phẩm hiển thị trên 1 trang
        $config['uri_segment']  = 4; // phân đoạn hiển thị số trnag
        $config['next_link']    = 'Next' ; //Nhãn tên của nút Next
        $config['prev_link']    = 'Previous' ; //Nhãn tên của nút Previous
        // khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment        = $this->uri->segment(4);
        $segment        = intval($segment);
        $input          = array();
        $input['limit'] = array($config['per_page'],$segment );

        $input['order'] = array('buyed','DESC');
        $list = $this->ProductModel->get_list($input);

        $this->data['list'] =  $list;

        $this->data['temp']='backend/depot/selling';
        $this->load->view('backend/main',$this->data);
    }

    public function showEnd()
    {

        // lấy ra số lượng các sản phẩm trên website
        $total_row                  = $this->ProductModel->showSumEnd();
        
        $total_row = count($total_row);
        // thư viện phân trang
        $this->load->library('pagination');
        $config                 = array();
        $config['total_rows']   =  $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url']     =  admin_url('depot/showEnd'); // link hiển thị dữ lieeu danh sách sản phẩm
        $config['per_page']     =  10; // số sản phẩm hiển thị trên 1 trang
        $config['uri_segment']  = 4; // phân đoạn hiển thị số trnag
        $config['next_link']    = 'Next' ; //Nhãn tên của nút Next
        $config['prev_link']    = 'Previous' ; //Nhãn tên của nút Previous
        // khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment        = $this->uri->segment(4);
        $segment        = intval($segment);

        $list = $this->ProductModel->showEnd($segment ,$config['per_page']);


        $this->data['list'] =  $list;
        $this->data['temp']='backend/depot/end';
        $this->load->view('backend/main',$this->data);
    }
}