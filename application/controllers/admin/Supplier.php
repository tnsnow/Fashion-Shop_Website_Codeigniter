<?php 
	class Supplier extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('SupplierModel');
			$this->load->library('form_validation');
        	$this->load->helper('form');
            $user = $this->session->userdata('userdata');

            foreach ($user as $key => $value) {
                # code...
                $roles = $value ->roles ;
            }
            $roles = intval($roles);
            if(admin($roles,admin_url())){

                $this->session->set_flashdata('message','Bạn không có quyền truy cập');
                redirect(admin_url());
            }
		}

		public function index()
		{
			// lấy ra số lượng  bài viêt trên website
			$total_row = $this->SupplierModel->get_total();
			$this->data['total_row'] = $total_row;
        	// thư viện phân trang
			$this->load->library('pagination');
			$config  = array();
	        $config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
	        $config['base_url'] =  admin_url('supplier/index'); // link hiển thị dữ lieeu danh sách sản phẩm
	        $config['per_page'] =  8; // số sản phẩm hiển thị trên 1 trang
	        $config['uri_segment'] = 4; // phân đoạn hiển thị số trnag
	        $config['next_link']= 'Next' ; //Nhãn tên của nút Next
	        $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
	        // khởi tạo cấu hình phân trang
	        $this->pagination->initialize($config);

	        $segment = $this->uri->segment(4);
	        $segment = intval($segment);
	        $input = array();
	        $input['limit'] = array($config['per_page'],$segment );

            // kiem tra có thuc hiện lặp dứ liệu hay không
            $name = $this->input->get('name');
            $input['where'] = array();
            if($name)
            {
                $input['like'] = array('name' , $name);
            }
	        //lấy ra danh sách bài viết
	        $list = $this->SupplierModel->get_list($input);
	        //pre($list);
	        $this->data['list'] = $list;

	        // lấy ra nội dung của biến message
	        $message = $this->session->flashdata('message');
	        $this->data['message'] = $message;

			$this->data['temp'] = 'backend/supplier/index';
			$this->load->view('backend/main',$this->data);

		}
		public function add()
		{
			if($this->input->post())
        	{
        		$this->form_validation->set_rules('name','Bạn cần nhập vào tên nhà cung cấp','required');
        		$this->form_validation->set_rules('email','Bạn cần nhập vào Email nhà cung cấp','required|valid_email');
        		$this->form_validation->set_rules('phone','Bạn cần nhập vào số điện thoại nhà cung cấp','required|numeric|min_length[10]');
        		$this->form_validation->set_rules('address','Bạn cần nhập vào địa chỉ nhà cung cấp','required');
        		if($this->form_validation->run())
            	{
            		$name = $this->input->post('name');
            		$email = $this->input->post('email');
            		$phone = $this->input->post('phone');
            		$address = $this->input->post('address');
            		$fax = $this->input->post('fax');
            		$rdoStatus = $this->input->post('rdoStatus');

            		$data = array(
            			'name' => $name,
            			'email' => $email,
            			'phone' => $phone,
            			'address' => $address,
            			'fax' => $fax,
            			'status' => $rdoStatus,
            			);

            		if($this->SupplierModel->create($data))
            		{
            			$this->session->set_flashdata('message','Insert  thành công');
            		}
            		else{
            			$this->session->set_flashdata('message','Lỗi không thể insert dữ liệu');
            		}
                // chuyển tới trang danh sách quản trị viên.
            		redirect(admin_url('supplier'));
                // thêm vào csdl


            	}
        	}
			$this->data['temp'] = 'backend/supplier/add';
			$this->load->view('backend/main',$this->data);

		}

		public function edit()
		{
			$id = $this->uri->rsegment('3');
			$supplier = $this->SupplierModel->get_info($id);
			if(!$supplier)
			{

				$this->session->set_flashdata('message','Nhà cung cấp không tồn tại ');
            	redirect(admin_url('supplier'));
			}
			$this->data['supplier'] = $supplier;

			if($this->input->post())
        	{
        		$this->form_validation->set_rules('name','Bạn cần nhập vào tên nhà cung cấp','required');
        		$this->form_validation->set_rules('email','Bạn cần nhập vào Email nhà cung cấp','required|valid_email');
        		$this->form_validation->set_rules('phone','Bạn cần nhập vào số điện thoại nhà cung cấp','required|numeric');
        		$this->form_validation->set_rules('address','Bạn cần nhập vào địa chỉ nhà cung cấp','required');
        		if($this->form_validation->run())
            	{
            		$name = $this->input->post('name');
            		$email = $this->input->post('email');
            		$phone = $this->input->post('phone');
            		$address = $this->input->post('address');
            		$fax = $this->input->post('fax');
            		$rdoStatus = $this->input->post('rdoStatus');

            		$data = array(
            			'name' => $name,
            			'email' => $email,
            			'phone' => $phone,
            			'address' => $address,
            			'fax' => $fax,
            			'status' => $rdoStatus,
            			);

            		if($this->SupplierModel->update($id,$data))
            		{
            			$this->session->set_flashdata('message','Chỉnh sửa  thành công');
            		}
            		else{
            			$this->session->set_flashdata('message','Lỗi không thể chỉnh sửa dữ liệu');
            		}
                // chuyển tới trang danh sách quản trị viên.
            		redirect(admin_url('supplier'));
                // thêm vào csdl


            	}
        	}

			$this->data['temp'] = 'backend/supplier/edit';
			$this->load->view('backend/main',$this->data);
		}

		/*
     * Delete Bài viết
     */
    public function delete()
    {
        $id = $this->uri->rsegment('3');
        $this->_del($id);

        $this->session->set_flashdata('message','Xóa thành công nhà cung cấp');
        redirect(admin_url('supplier'));

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
        $supplier = $this->SupplierModel->get_info($id);
        if(!$supplier)
        {

            $this->session->set_flashdata('message','Nhà cung cấp không tồn tại');
            if ($rediect)
            {
                redirect(admin_url('supplier'));
            }
            else
            {
                return false;
            }
        }

        // thực hiện xóa sản phẩm .
        $this->SupplierModel->delete($id);
    }
        


	}
?>