<?php


class Transaction extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TransactionModel');
        $this->load->model('CatalogModel');
        $this->load->model('OrderModel');


    }
    /*
     * Danh sách giao dich cua website
     */
    public  function index()
    {
        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }
        $roles = intval($roles);
        if(admin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền truy cập ');
            redirect(admin_url());
        }
        // lấy ra số lượng các giao dich trên website
        $total_row = $this->TransactionModel->get_total();
        $this->data['total_row'] = $total_row;
        // thư viện phân trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url'] = admin_url('transaction/index'); // link hiển thị dữ lieeu danh sách sản phẩm
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
        
        // kiem tra có thuc hiện lặp dứ liệu hay không
        $id = $this->input->get("id");
        $title = $this->input->get('title');
        $status = $this->input->get("status");
        $created = $this->input->get("created");
        $id = intval($id);
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        if($status)
        {
            $input['where']['status'] = $status;
        }
        if($title)
        {
            $input['like'] = array('user_name' , $title);
        }

        if($created)
        {
            $input['like'] = array('created' , $created);
        }

        // lấy ra danh sách đơn hàng giao dịch
        $list = $this->TransactionModel->get_list($input);
        $this->data['list'] = $list;
        
        // lấy ra nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        // load view
        $this->data['temp'] = 'backend/transaction/index';
        $this->load->view('backend/main', $this->data);
    }

    // update tình trạng giao dịch 

    function update_status()
    {
        if(isset($_POST['status']) && isset($_POST['id']))
        {
            $id = $_POST['id'];
            $status = $_POST['status'];
            settype($id,"int");
            settype($status,"int");

            $data = array(
                    'status' => $status
                );

            if($this->TransactionModel->update($id,$data))
                {

                }
        }

    }
    
    /*
        Update tình trạng giao hàng 
    */
    

     /* xem chi tiết hóa đơn :
     */
    function order()
    {

        // id của giao dịch
        $id = $this->uri->rsegment(3);
        $this->data['id'] = $id;
        $input = array();
        $inputs['where'] = array('id' =>$id);
        $info_costomer = $this->TransactionModel->get_list($inputs);
        $this->data['info_costomer'] =$info_costomer;
        $input['where'] = array('transaction_id'=>$id);
        // lấy ra tổng số sản phẩm của giao dịch
        $total_row = $this->OrderModel->get_total($input);

        // lấy ra danh sách order thuộc giao dịch

        $list_order = $this->OrderModel->get_list($input);
       
        $this->data['total_row'] = $total_row;
        $this->data['list_order'] = $list_order;
        $this->data['temp'] = 'backend/transaction/view_order';
        $this->load->view('backend/mains', $this->data);
    }

    /*
    * delete sản phẩm
    */

    public function delete()
    {
        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }
        $roles = intval($roles);
        if(admin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền xóa giao dịch');
            redirect(admin_url());
        }
        $id = $this->uri->rsegment('3');
        $input['where'] = array('transaction_id' => $id);
        $data = $this->OrderModel->get_list($input);
        if(!empty($data)){
            $this->session->set_flashdata('message','Không thể xóa giao dịch bạn cần xóa đơn hàng thuộc giao dịch trước  ');
            redirect(admin_url('transaction'));
        }
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
            $input['where'] = array('transaction_id' => $id);
            $data = $this->OrderModel->get_list($input);
            if(!empty($data)){
                $this->session->set_flashdata('message','Không thể xóa giao dịch bạn cần xóa đơn hàng thuộc giao dịch trước  ');
                redirect(admin_url('transaction'));
            }
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


    public function sales(){

        $user = $this->session->userdata('userdata');

        foreach ($user as $key => $value) {
            # code...
            $roles = $value ->roles ;
        }
        $roles = intval($roles);
        if(admin($roles,admin_url())){

            $this->session->set_flashdata('message','Bạn không có quyền truy cập ');
            redirect(admin_url());
        }
        // lấy ra số lượng các giao dich trên website
        $total_row = $this->TransactionModel->get_total();
        $this->data['total_row'] = $total_row;
        // thư viện phân trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url'] = admin_url('transaction/index'); // link hiển thị dữ lieeu danh sách sản phẩm
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
        
        // kiem tra có thuc hiện lặp dứ liệu hay không
        $day = $this->input->get("day");
        $mon = $this->input->get('mon');
        $year = $this->input->get("year");
        $all = $this->input->get("all");
        $input['where'] = array();
        // if($day > 0)
        // {
        //     $input['like'] = array('user_name' , $title);
        // }
        // if($status)
        // {
        //     $input['where']['status'] = $status;
        // }
        // if($title)
        // {
        //     $input['like'] = array('user_name' , $title);
        // }
        if(isset($day)||isset($mon) || isset($year))
        {
            if($day > 0)
            {
                $input['like'] = array('created' ,$day);
            }

            if($mon > 0)
            {
                $input['like'] = array('created' ,$mon);
            }

            if($year > 0)
            {
                $input['like'] = array('created' ,$year);
            }

             if($all > 0)
            {
                $input['like'] = array('created' ,$all);
            }

            // if(isset($day) && isset($mon))
            // {
            //     $key = $day."-".$mon;
            //     $input['like'] = array('created' ,$key);

            // }

            // if(isset($day) && isset($mon) && isset($year))
            // {
            //     $key = $day."-".$mon."-".$year;
            //     $input['like'] = array('created' ,$key);

            // }

            // lấy ra danh sách đơn hàng giao dịch
            $list = $this->TransactionModel->get_list($input);
            $this->data['list'] = $list;

        }

        $lists = $this->TransactionModel->getCreated();
        $this->data['lists'] = $lists;

        

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        // load view
        $this->data['temp'] = 'backend/sales/index';
        $this->load->view('backend/main', $this->data);

    }


}