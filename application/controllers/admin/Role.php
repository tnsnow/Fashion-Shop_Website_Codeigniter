<?php 
	class Role extends MY_Controller{

		public function __construct(){

			parent::__construct();
			$this->load->model('RoleModel');
			$this->load->library('form_validation');
        	$this->load->helper('form');
		}

		public function index(){
			$total = $this->RoleModel->get_total();
			$list = $this->RoleModel->get_list();
			$this->data['list'] = $list ;
			$this->data['total'] = $total ;
			
			//pre($list);
			$this->data['temp']='backend/role/index';
        	$this->load->view('backend/main',$this->data);
		}

		public function add(){

			$this->data['temp']='backend/role/add';
        	$this->load->view('backend/main',$this->data);
		}
		
	}
?>