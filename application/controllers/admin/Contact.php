<?php 
	
	class Contact extends MY_Controller
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('ContactModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('phpmailer_helper');
	        $this->load->helper('smtp_helper');	
		}

		public function index()
		{

			// lấy ra số lượng các sản phẩm trên website
        $total_row                  = $this->ContactModel->get_total();
        $this->data['total_row']    = $total_row;
        // thư viện phân trang
        $this->load->library('pagination');
        $config                 = array();
        $config['total_rows']   =  $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url']     =  admin_url('product/index'); // link hiển thị dữ lieeu danh sách sản phẩm
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

		$list = $this->ContactModel->get_list($input);

		$this->data['list'] = $list;

		// lấy ra nội dung của biến message
		$message = $this->session->flashdata('message');
		$this->data['message'] = $message;
		$this->data['temp'] = 'backend/contact/index';
    	$this->load->view('backend/main',$this->data);
		}
		/*
		@ trả lời email
		*/
		
		public function replyEmail()
		{
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->helper('phpmailer_helper');
	        $this->load->helper('smtp_helper');

			$id = $this->uri->rsegment('3');
			$contact = $this->ContactModel->get_info($id);
			if(!$contact)
			{

				$this->session->set_flashdata('message','Liên hệ không tồn tại ');
				redirect(admin_url('contact'));
			}
			//pre($contact->name);

			if($this->input->post())
        	{
        		$this->form_validation->set_rules('to', 'Nhập vào email ', 'required|valid_email');
        		$this->form_validation->set_rules('title', 'Nhập vào title ', 'required');

        		 if ($this->form_validation->run()) {
        		 	$to 		= $this->input->post('to');
        		 	$titles 	= $this->input->post('title');
        		 	$contents 	= $this->input->post('content');

        		 	 //gửi thông báo tới mail .
	                $title =$titles;

	                $content = $contents;
	                
	                $nTo = $contact->name;

	                $mTo = $to;
	                //pre($mTo);
	                if(sendMail($title, $content, $nTo, $mTo,$diachicc='')){
	                	$data = array(
	                			'activel' => 1,
	                		);
	                	$this->ContactModel->update($id,$data);
	                	$this->session->set_flashdata('message','Phản hồi thành công !!!');
	                }


	                
	                
	                // chuyển tới trang danh sách quản trị viên.
	                redirect(admin_url('contact/replyEmail/'.$id));
		            

        		 }
        	}
        	$message = $this->session->flashdata('message');
			$this->data['message'] = $message;
			
			$this->data['contact'] = $contact;
			$this->data['temp'] = 'backend/contact/reply';
			$this->load->view('backend/main',$this->data);
			
		}

		public function listEmail()
		{
			$email = $this->input->post('email');
			$this->session->set_userdata('email',$email);
		}

		public function sendEmailAll()
		{
			$email = $this->session->userdata('email');
			$this->data['email'] = $email;
			if(empty($email)){

				$this->session->set_flashdata('message','Bạn cần chọn Email !!!');
				redirect(admin_url('contact'));
			}

			if($this->input->post())
        	{
        		$this->form_validation->set_rules('title', 'Nhập vào title ', 'required');

        		 if ($this->form_validation->run()) {
        		 	$titles 	= $this->input->post('title');
        		 	$contents 	= $this->input->post('content');

        		 	 //gửi thông báo tới mail .
	                $title =$titles;

	                $content = $contents;
	                
	                $nTo = "Tin khuyến mại";

	                $number = count($email);
	                for($i =0 ; $i < $number ;$i++){

		                $mTo = $email[$i];
		                if(sendMail($title, $content, $nTo, $mTo,$diachicc='')){
		                	$this->session->set_flashdata('message','Phản hồi thành công !!!');
		                }

	                }
	                // chuyển tới trang danh sách quản trị viên.
	                redirect(admin_url('contact/sendEmailAll'));

                	$this->session->unset_userdata('email');

		            

        		 }
        	}
        	$message = $this->session->flashdata('message');
			$this->data['message'] = $message;
			
			$this->data['temp'] = 'backend/contact/send';
			$this->load->view('backend/main',$this->data);
		}

		/*
     * Delete Bài viết
     */
    public function delete()
    {
        $id = $this->uri->rsegment('3');
        $this->_del($id);

        $this->session->set_flashdata('message','Xóa thành công liên hệ ');
        redirect(admin_url('contact'));

    }

    private  function _del($id, $rediect = true)
    {
        $contact = $this->ContactModel->get_info($id);
        if(!$contact)
        {

            $this->session->set_flashdata('message','Liên hệ không tồn tại ');
            if ($rediect)
            {
                redirect(admin_url('contact'));
            }
            else
            {
                return false;
            }
        }

        // thực hiện xóa sản phẩm .
        $this->ContactModel->delete($id);


    }
	}
?>