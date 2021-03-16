<?php

	class Order extends MY_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('OrderModel');
			$this->load->model('ProductModel');

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
			// load ra thư viện phân trang
			$this->load->library('pagination');
			// lấy ra tống số đơn hàng  
			$total_row = $this->OrderModel->get_total();
			// trả dữ liệu ra view
			$this->data['total_row'] = $total_row;
			// lấy ra dữ liệu bảng order
			$config  = array();
			$config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
	        $config['base_url'] =  admin_url('order/index'); // link hiển thị dữ lieeu danh sách sản phẩm
	        $config['per_page'] =  10; // số sản phẩm hiển thị trên 1 trang
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
            $id = $this->input->get("id");
        	$delivered = $this->input->get("delivered");
        	$title = $this->input->get('title');
            $created   = $this->input->get('created');
        	$id = intval($id);
        	$input['where'] = array();
        	if($id > 0)
        	{
        		$input['where']['transaction_id'] = $id;
        	}
            if($delivered)
            {
                $input['where']['delivered'] = $delivered;
            }
        	if($title)
        	{
        		$input['like'] = array('name_pr' , $title);
        	}
            if($created) {
                $input['where']['created'] = $created;
            }
			$list = $this->OrderModel->get_list($input);

			$this->data['list'] = $list;
            // lấy ra nội dung của biến message
            $message = $this->session->flashdata('message');
            $this->data['message'] = $message;
			$this->data['temp'] = 'backend/order/index';
        	$this->load->view('backend/main',$this->data);
		}

		 /*
        Update tình trạng giao hàng 
    	*/
    	function update_delivered()
        {
            
        	// kiểm tra có tồn tại dữ liệu gửi sang
            if(isset($_POST['delivered']) && isset($_POST['id']))
            {

            	//lấy ra dữ liệu từ bên ajax gửi qua biến id sản phẩm tình trạng đơn hàng tổng số sản phẩm đc mua
                $id = $_POST['id'];
                $delivered = $_POST['delivered'];
                $qty = $_POST['qty'];
                $product_id = $_POST['product_id'];
                // kiểm tra yêu cầu phải là số nguyên
                settype($id,"int");
                settype($delivered,"int");
                settype($qty,"int");
                $input= array();
            	$input['where'] = array('id'=>$product_id);
            	// lấy ra thông tin sản phẩm có cùng id
            	$product = $this->ProductModel->get_list($input);
                	
            	// cập nhật số lượng sản phẩm 
            	foreach ($product as $key => $value) {
            		# code...
            		if($value->total > $qty && $value->total >0 )
            		{
            			
                        if($delivered == 2){
                            $buyed = $value ->buyed - $qty;
                            $total = $value->total + $qty;
                        }elseif($delivered == 1){
                            $buyed = $value ->buyed + $qty;
                            $total = $value->total - $qty;
                        }
            		}
            		else
            		{
            			$this->session->set_flashdata('message','Số lượng sản phẩm không đủ');
            		}
            		
            	}
            	// nếu không tồn tại số lượng sản phẩm 
            	if(isset($total))
            	{
            		$data = array(
                    'total' => $total,
                    'buyed' => $buyed
                	);
            		// update số lượng sản phẩm và số lượng bán được
                	if($this->ProductModel->update($product_id,$data))
                	{

                		$data = array(
                        'delivered' => $delivered
                    	);

                    	// tiến hành update tình trạng đơn hàng
                		$this->OrderModel->update($id,$data);


                	}else
                	{
                		// sảy ra lỗi 
                		$this->session->set_flashdata('message','Lỗi không thể cập nhật dữ liệu');
                	}
            	}else{
                    $this->session->set_flashdata('message','Không tồn tại số lượng sản phẩm');
                }
                
            }

        }
    

		/*
			Xóa 1 đơn hàng
		*/
		 function delete()
	    {
	        $id = $this->uri->rsegment(3);
	        $this->_del($id);
	        $this->session->set_flashdata('message','Delet thành công đơn hàng');
	        redirect(admin_url('order'));


	    }

		 /*
	     * Xóa nhiều đơn hàng
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
	        $order = $this->OrderModel->get_info($id);
	        if(!$order)
	        {

	            $this->session->set_flashdata('message','Không tồn tại đơn hàng');
	            if ($rediect)
	            {
	                redirect(admin_url('order'));
	            }
	            else
	            {
	                return false;
	            }
	        }

	        // thực hiện xóa giao dịch
	        $this->OrderModel->delete($id);
	    }



        public function xuatExecl()  {

        
        
        require_once APPPATH . '/third_party/Phpexcel/Bootstrap.php';

        // Create new Spreadsheet object
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

    // Set document properties
        $spreadsheet->getProperties()->setCreator('Webeasystep.com ')
            ->setLastModifiedBy('Ahmed Fakhr')
            ->setTitle('Phpecxel codeigniter tutorial')
            ->setSubject('integrate codeigniter with PhpExcel')
            ->setDescription('this is the file test');

        // add style to the header
        $styleArray = array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'top' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ),
            ),
            'fill' => array(
                'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startcolor' => array(
                    'argb' => 'FFA0A0A0',
                ),
                'endcolor' => array(
                    'argb' => 'FFFFFFFF',
                ),
            ),
        );
        $spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);


        // auto fit column to content

        foreach(range('A','F') as $columnID) {
          $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
              ->setAutoSize(true);
        }
        // set the names of header cells
        
           

    
        
       


    // Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Users Information');

    // set right to left direction
    //    $spreadsheet->getActiveSheet()->setRightToLeft(true);

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="data_sheet.xlsx"');
        header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel2007');
        $writer->save('php://output');
        exit;

        //  create new file and remove Compatibility mode from word title

        redirect(keKhai('kekhaigiogiang'));
        $this->session_destroy();
        die();
    }

	}
?>