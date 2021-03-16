<?php


class Image extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ImageModel');
        //kiểm tra dữ liệu
        $this->load->library('form_validation');
        $this->load->helper('form');
    }
    /*
     * Hiển thị danh sách bài viết
     */
    public  function index()
    {
        // lấy ra số lượng  bài viêt trên website
        $total_row = $this->ImageModel->get_total();
        $this->data['total_row'] = $total_row;
        // thư viện phân trang
        $this->load->library('pagination');
        $config  = array();
        $config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
        $config['base_url'] =  admin_url('image/index'); // link hiển thị dữ lieeu danh sách sản phẩm
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
        $id = $this->input->get("id");
        $title = $this->input->get('title');
        $id = intval($id);
        $input['where'] = array();
        if($id > 0)
        {
            $input['where']['id'] = $id;
        }
        if($title)
        {
            $input['like'] = array('name' , $title);
        }
        //lấy ra danh sách bài viết
        $list = $this->ImageModel->get_list($input);
        $this->data['list'] = $list;

        // lấy ra nội dung của biến message
        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        // load view
        $this->data['temp'] = 'backend/image/index';
        $this->load->view('backend/main',$this->data);
    }

    /*
     * Thêm mới bài viết
     *
     */
    public function add()
    {

        

        if($this->input->post())
        {
            // vào system /language/english để sửa lỗi chũw
            $this->form_validation->set_rules('name','Nhập vào tên ảnh  ','required');
            

            // nhâp liệu chính xác
            if($this->form_validation->run())
            {

                $title              = $this->input->post('name');
                
                // lấy tên file ảnh được upload lên

                $this->load->library('upload_library');
                $upload_path ='./upload/news';
                $upload_data = $this->upload_library->upload($upload_path,'image');

                //pre($upload_path);

                $link_img ='';
                if(isset($upload_data['file_name']))
                {
                    $link_img = $upload_data['file_name'];

                }

                $link = base_url('upload/news/'.$link_img);
                //pre($link);
                $data= array(
                    'name'          =>  $title,
                    'name_img'      =>  $link_img,
                    'link'          =>  $link,

                );
                if($this->ImageModel->create($data))
                {
                    $this->session->set_flashdata('message','Insert  thành công');
                }
                else{
                    $this->session->set_flashdata('message','Lỗi không thể insert dữ liệu');
                }
                // chuyển tới trang danh sách quản trị viên.
                redirect(admin_url('image'));
                // thêm vào csdl
            }
        }
        // load view
        $this->data['temp'] = 'backend/image/add';
        $this->load->view('backend/main',$this->data);
    }
    /*
     * Chỉnh sửa bài viết .
     */
    

    /*
     * Delete Bài viết
     */
    public function delete()
    {
        $id = $this->uri->rsegment('3');
        $this->_del($id);

        $this->session->set_flashdata('message','Xóa thành công ảnh bài viết ');
        redirect(admin_url('image'));

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
        $img = $this->ImageModel->get_info($id);
        if(!$img)
        {

            $this->session->set_flashdata('message','Ảnh bài viết không tồn tại ');
            if ($rediect)
            {
                redirect(admin_url('image'));
            }
            else
            {
                return false;
            }
        }

        // thực hiện xóa sản phẩm .
        $this->ImageModel->delete($id);

        // xóa ảnh sản phẩm
        $image_link = 'upload/news/'.$img->name_img ;
        if(file_exists($image_link))
        {
            unlink($image_link);
        }

    }
}