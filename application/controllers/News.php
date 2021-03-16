<?php


class News extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('NewModel');
        $this->load->model('CategoryNewModel');
        $this->load->model('IntroModel');

    }
    function index()
    {
        $input['where'] = array('status'=>0);
        $list_categorynew = $this->CategoryNewModel->get_list($input);
        $this->session->set_flashdata('list_categorynew', $list_categorynew );

        // lấy danh sách bài viết mới
        $input= array();
        // lấy ra số lượng bài viết
        $total_row = $this->NewModel->get_total();
        $this->data['total_row'] = $total_row;
        // thư viện phân trang
        $this->load->library('pagination');
        $config  = array();
        $config['total_rows'] =  $total_row; // tổng tất cả các bài viết ;
        $config['base_url'] =  base_url('news/index'); // link hiển thị dữ lieeu danh sách bài viết
        $config['per_page'] = 6; // số sản phẩm hiển thị trên 1 trang
        $config['uri_segment'] = 3; // phân đoạn hiển thị số trnag
        $config['next_link']= 'Next' ; //Nhãn tên của nút Next
        $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
        // khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(3);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'],$segment );


        
        $new_list = $this->NewModel->get_list($input);

        $this->data['news'] = $new_list;

        // lấy ra danh sách bài viết được xem nhiều 
        $inputs['limit'] = array(0,5);
        $inputs['order'] = array('count_view','DESC');
        $list_new_host = $this->NewModel->get_list($inputs);
        $this->session->set_flashdata('list_new_host', $list_new_host );

        
        //lấy ra thông tin bảng giới thiệu
        $list_info = $this->IntroModel->get_list();
        $this->data['list_info'] = $list_info;

        $this->session->set_flashdata('list_info', $list_info );

        // lấy ra danh mục bài viết 
        
        $this->data['temp']= "fontend/news/index";
        $this ->load ->view('fontend/details',$this->data);
    }

    public function listNewCate()
    {
        $id = $this->uri->rsegment('3');

        $category = $this->CategoryNewModel->get_info($id);

        $this->data['category'] = $category;


        $inpusts['where'] = array('newcatalog_id' => $id);
        $categorynew = $this->NewModel->get_list($inpusts);
    
        $input= array();
        // lấy ra số lượng bài viết
        $total_row = count($categorynew);
        $this->data['total_row'] = $total_row;
        // thư viện phân trang
        $this->load->library('pagination');
        $config  = array();
        $config['total_rows'] =  $total_row; // tổng tất cả các bài viết ;
        $config['base_url'] =  base_url('news/listNewCate'); // link hiển thị dữ lieeu danh sách bài viết
        $config['per_page'] = 8; // số sản phẩm hiển thị trên 1 trang
        $config['uri_segment'] = 4; // phân đoạn hiển thị số trnag
        $config['next_link']= 'Next' ; //Nhãn tên của nút Next
        $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
        // khởi tạo cấu hình phân trang
        $this->pagination->initialize($config);

        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        $input['limit'] = array($config['per_page'],$segment );
        $input['where'] = array('newcatalog_id' => $id );
        $new_list = $this->NewModel->get_list($input);
        $this->data['news'] = $new_list;

        
        //lấy ra thông tin bảng giới thiệu
        $list_info = $this->IntroModel->get_list();
        $this->data['list_info'] = $list_info;

        $this->session->set_flashdata('list_info', $list_info );

        // lấy ra danh mục bài viết 
        $input['where'] = array('status'=>0);
        $list_categorynew = $this->CategoryNewModel->get_list($input);
        $this->session->set_flashdata('list_categorynew', $list_categorynew );

         // lấy ra danh sách bài viết được xem nhiều 
        $inputs['limit'] = array(0,5);
        $inputs['order'] = array('count_view','DESC');
        $list_new_host = $this->NewModel->get_list($inputs);
        $this->session->set_flashdata('list_new_host', $list_new_host );


        $this->data['temp']= "fontend/news/list_new_cate";
        $this ->load ->view('fontend/details',$this->data);

    }

    function view()
    {
        $id = intval($this->uri->rsegment('3'));
        $id = intval($id);
        $new = $this->NewModel->get_info($id);
        if(empty($new))
        {
            $this->session->set_flashdata('error','Bài viết không tồn tại');
            redirect(base_url('news'));

        }

        $data['count_view'] = $new ->count_view +1 ;
        $this->NewModel->update($new->id,$data);

        if(!empty($new)){
            $name_cate = $this->CategoryNewModel->get_info($new->newcatalog_id);
            $this->data['name_cate'] = $name_cate;
            $input['limit'] = array(0,5);
            $input['where'] = array('newcatalog_id' =>$new->newcatalog_id);
            $list = $this->NewModel ->get_list($input);
            $this->data['list'] = $list;
        }
        
        $this->data['new'] = $new;

        $input['where'] = array('status'=>0);
        $list_categorynew = $this->CategoryNewModel->get_list($input);
        $this->session->set_flashdata('list_categorynew', $list_categorynew );

         // lấy ra danh sách bài viết được xem nhiều 
        $inputs['limit'] = array(0,5);
        $inputs['order'] = array('count_view','DESC');
        $list_new_host = $this->NewModel->get_list($inputs);
        $this->session->set_flashdata('list_new_host', $list_new_host );


        
        $this->data['temp']= "fontend/news/view_new";
        $this ->load ->view('fontend/details',$this->data);
    }


}