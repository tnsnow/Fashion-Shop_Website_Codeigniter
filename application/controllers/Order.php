<?php
class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('TransactionModel');
        $this->load->model('OrderModel');
        $this->load->helper('phpmailer_helper');
        $this->load->helper('smtp_helper');
    }
    /*
    * lấy thông tin khách hàng
    */
    function check_out()
    {
        $this->load->library('form_validation');
        $this->load->helper('form');
        // thong tin gio hang
        $cartss = $this->cart->contents();
        $total_ac = 0;
        foreach ($cartss as $item)
        {
            $total_ac = $total_ac + $item['subtotal'];
        }

        // tong so san pahm
        $total_item = $this->cart->total_items();
        if($total_item <= 0)
        {
            redirect(base_url());
        }
        $user_id = 0;
        $user = "";
        if($this->session->userdata('user_login'))
        {
            $user_id = $this->session->userdata('user_login');
            $user = $this->UserModel->get_info($user_id);
        }

        $this->data['user'] = $user;


        // insert thông tin khách hàng vào csdl
        if($this->input->post()) {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('name', 'Tên tài khoản', 'required');
            $this->form_validation->set_rules('email', 'Email nhận hàng', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Số điện thoai ở định dạng số', 'required|numeric');
            $this->form_validation->set_rules('address', 'Nhập vào địa chỉ', 'required');
            $this->form_validation->set_rules('Transport', 'Chọn hình thức vận chuyển', 'required');
            $this->form_validation->set_rules('optionsRadios', 'Chọn hình thức thanh toán', 'required');

            
            // nhâp liệu chính xác

                if ($this->form_validation->run()) {

                        $username  = $this->input->post('name');
                        $email     = $this->input->post('email');
                        $phone     = $this->input->post('phone');
                        $address   = $this->input->post('address');
                        $payment   = $this->input->post('optionsRadios');// cổng thanh toán
                        $Transport = $this->input->post('Transport');
                        $message   = $this->input->post('message');
                        $time      = date('Y-m-d');

                        if ($Transport == 'Chuyển phát nhanh') {
                            $total_ac = $total_ac + 30000;
                        }
                        //pre($total_ac);
                        $data = array(
                            'status'     => 2,
                            'user_id'    =>$user_id,
                            'user_name'  => $username,
                            'user_email' => $email,
                            'user_phone' => $phone,
                            'address'    => $address,// địa chỉ người nhận
                            'amount '    => $total_ac, // tong tien thanh toan
                            'payment'    => $payment,// hình thức thanh toán
                            'Transport'  => $Transport,// hìn thức vận chuyển
                            'message'    => $message,
                            'created'    => date("Y-m-d"),
                            // ghi chú cho đơn hàng
                            

                        );
                    // thêm dữ liệu vào bảng Transaction
                    $this->load->model('TransactionModel');

                    if($this->TransactionModel->create($data)){
                    }
                    $transaction_id = $this->db->insert_id();// lấy ra id cua giao dịch

                    // thêm dữ liệu vào bảng order
                    
                    foreach ($cartss as $row)
                    {
                        $data= array(
                            'transaction_id' => $transaction_id,
                            'product_id'     => $row['id'],
                            'delivered'      => 2,
                            'qty'            => $row['qty'],
                            'name_pr'        => $row['name'],
                            'price'          => $row['price'],
                            'amount'         => $row['subtotal'],
                            'created'        => date('Y-m-d'),

                        );

                        if($this->OrderModel->create($data)){

                            //gửi thông báo tới mail .
                        $title ="Cám ơn bạn đã mua hàng tại Website của chúng tôi";
                        $content ="Xin Chào " . $username;
                        $content .= " Cám ơn bạn đã mua hàng tại Website của chúng tôi . Mã đơn hàng của bạn là ".$transaction_id." với tổng tiền là ".$total_ac." .Chúng tôi sẽ chuyển hàng cho bạn sớm nhất có thể";
                        $nTo = $username;
                        $mTo = $email;
                        sendMail($title, $content, $nTo, $mTo,$diachicc='');
                        }




                    }

                    //chuyển tới trang chi tiết hóa đơn
                    if ($payment == 'ngan_luong') {
                        redirect(base_url("bank-payment.html"));
                    } else {
                        $this->cart->destroy();
                        redirect(base_url("hoa-don.html"));
                    }

                }


        }
        

        
        $this->data['cartss'] = $cartss;
        $this->data['total_item'] = $total_item;
        // nếu thành viên đăng nhập sẽ lấy ra thông tin thành viên
        $this->data['temp'] = 'fontend/cart/pay';
        $this ->load ->view('fontend/details',$this->data);
    }

    function view_order()
    {
        $cartss = $this->cart->contents();
        // thong tin gio hang
       
        $input = array();
        $input["order"] = array('id','DESC');
        $input['limit'] = array(1,0);
        $ma = $this->TransactionModel->get_list($input);
        $this->data['ma'] = $ma;
        foreach ($ma as $item)
        {
            $id_tran = $item->id;
        }
        $this->load->model('OrderModel');
        $inputs = array();
        $inputs['where'] = array('transaction_id'=>$id_tran);
        $product = $this->OrderModel->get_list($inputs);
        $this->data['product'] = $product;
        $this->data['temp'] = 'fontend/cart/view_order';
        $this ->load ->view('fontend/view',$this->data);
    }

    public function checkTransaction()
    {
        

        $this->data['temp'] = 'fontend/cart/';
        $this ->load ->view('fontend/details',$this->data);

    }

    public function viewOrderUser()
    {
        if($this->session->userdata('user_login'))
        {
            $user_id = $this->session->userdata('user_login');
            
        }

        $input['where'] = array('user_id'=>$user_id);
        $list = $this->TransactionModel->get_list($input);
        $this->data['list'] = $list;

        $this->data['temp'] = 'fontend/order/order';
        $this ->load ->view('fontend/details',$this->data);
    }


    public function viewListOrder()
    {
        $id = intval($this->uri->rsegment('3'));
        $transaction = $this->TransactionModel->get_info($id);
        if(empty($transaction)){
            $this->session->set_flashdata('error', 'Không tồn tại đơn hàng.');
            redirect(base_url('don-hang-cua-toi.html'));
        }
        //pre($transaction);
        $this->data['transaction'] = $transaction;

        $input['where'] = array('transaction_id'=>$id);
        $list= $this->OrderModel->get_list($input);
        //pre($list);
        $this->data['list'] = $list;
        $this->data['temp'] = 'fontend/order/vieworders';
        $this ->load ->view('fontend/details',$this->data);
    }

    public function bankPayment()
    {
        $this->data['temp'] = 'fontend/cart/bank';
        $this ->load ->view('fontend/details', $this->data);
    }
    
    
}