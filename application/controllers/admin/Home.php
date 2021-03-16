<?php

class Home extends MY_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TransactionModel');
        $this->load->model('NewModel');
        $this->load->model('ProductModel');
        $this->load->model('CatalogModel');
        $this->load->model('UserModel');
        $this->load->model('ContactModel');
        $this->load->model('OrderModel');
    }
    /*
     * Danh sách giao dich cua website
     */
    public  function index()
    {
        $year = date('Y');
        $mon = date('m');
        $time = date('Y-m-d');

        // lấy ra tổng số các liên hệ
        
        $total_row_contact = $this->ContactModel->get_total();

        // lấy ra số liên hệ hôm nay 
        $contact['where'] = array('created' =>$time);

        $list_contact_day = $this->ContactModel->get_list($contact);

        // số liên hệ chưa được xử lý 
        
        $contacts['where'] = array('activel' =>0);

        $list_contact_active = $this->ContactModel->get_list($contacts);

        $this->data['list_contact_active']  = $list_contact_active;
        $this->data['list_contact_day']  = $list_contact_day;
        $this->data['total_row_contact'] = $total_row_contact;
        // lấy ra tổng số giao dịch
        $total_row = $this->TransactionModel->get_total();

        // tổng số giao dịch đã được sử lý 
        
        $inputpay['where'] = array('status'=>1);

        $total_pay = $this->TransactionModel->get_list($inputpay);

        // tổng số giao dịch chưa được xử lý 
        
        $inputun['where'] = array('status'=>2);

        $total_un = $this->TransactionModel->get_list($inputun);
        
        // lấy ra tổng số sản phẩm 
        $total_row_pr = $this->ProductModel->get_total();
        // Tổng số bài viết
        $total_row_nw = $this->NewModel->get_total();
        // Tổng số thành viên 
        $total_row_us = $this->UserModel->get_total();
        $this->data['total_row_us'] = $total_row_us;
        $this->data['total_row_nw'] = $total_row_nw;
        $this->data['total_row_pr'] = $total_row_pr;
        $this->data['total_row']    = $total_row;
        $this->data['total_pay']    = $total_pay;
        $this->data['total_un']     = $total_un;
        $inputs['where']            = array('status' => 1);
        
        $listtt = $this->TransactionModel->get_list($inputs);
        $this->data['listtt'] = $listtt;

        // lấy ra doanh số theo tháng 
        
        $input['where'] = array('status'=>1);
        $input['like'] = array('created',$mon);
        $list_mon = $this->TransactionModel->get_list($input);
        
        $this->data['list_mon'] = $list_mon;

        // lấy ra tổng số giao dịch của tháng .
        $inputmon['like'] = array('created',$mon);
        $sum_list_mon = $this->TransactionModel->get_list($inputmon);
        $this->data['sum_list_mon'] = $sum_list_mon;

        // doanh số theo năm 
        $input['where'] = array('status'=>1);
        $input['like'] = array('created',$year);
        $list_year = $this->TransactionModel->get_list($input);

        $this->data['list_year'] = $list_year;

        // thư viện phân trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url'] = admin_url('home/index'); // link hiển thị dữ lieeu danh sách sản phẩm
        $config['per_page'] = 15; // số sản phẩm hiển thị trên 1 trang
        $config['uri_segment'] = 4; // phân đoạn hiển thị số trnag
        $config['next_link'] = 'Next'; //Nhãn tên của nút Next
        $config['prev_link'] = 'Previous'; //Nhãn tên của nút Previous
        // khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input = array();
        $input['limit'] = array($config['per_page'], $segment);
        
        
        
        $list = $this->TransactionModel->get_list($input);
        $this->data['list'] = $list;

        // lấy ra doanh so ban theo ngay .

        $inputs = array();
               
        $inputs['where'] = array('created' => $time ,'status' => 1);
        $lists = $this->TransactionModel->get_list($inputs);
 
        $this->data['lists'] = $lists;

        // tốp 5 sản phẩm bán chạy nhất
        $hot['limit'] = array(5,0);
        $hot['order'] = array('buyed','DESC');
        $product_by = $this->ProductModel->get_list($hot);

        $this->data['product_by'] = $product_by;

        // lấy ra số đơn hàng chưa giao
        $order['where'] = array('delivered' =>2);
        
        $list_order = $this->OrderModel->get_list($order);

        $this->data['list_order'] = $list_order;
        // lấy ra nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        // load view
        $this->data['temp']='backend/home/index';
        $this->load->view('backend/main',$this->data);
    }

    /*
    * delete sản phẩm
    */

    public function delete()
    {
        $id = $this->uri->rsegment('3');
        $this->_del($id);

        $this->session->set_flashdata('message','Xóa thành công sản phẩm  ');
        redirect(admin_url('transaction'));

    }

    /*
     * Xóa nhiều sản phẩm
     */
    public function deleteAll()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $id)
        {
            $this->_del($id ,false);
        }
    }

    private  function _del($id, $rediect = true)
    {
        $transaction = $this->TransactionModel->get_info($id);
        if(!$transaction)
        {

            $this->session->set_flashdata('message','Không tồn tại giao dịch');
            if ($rediect)
            {
                redirect(admin_url('transaction'));
            }
            else
            {
                return false;
            }
        }

        // thực hiện xóa giao dịch
        $this->TransactionModel->delete($id);


    }

}