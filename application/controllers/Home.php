<?php
class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SlideModel');
        $this->load->model('ProductModel');
    }

    public function index()
    {

        $slide_list = $this->SlideModel->get_list();

        // lấy ra danh sách sản phẩm mới .

        $input = array();
        // lấy giá trị số sản phẩm hiển thị trên danh mục sản phẩm
        if ($this->input->get('limit') && $this->input->get('limit') > 0) {
            $number = $this->input->get('limit');
        } else {
            $number = 4;
        }
        $number = intval($number);


        $input['limit'] = array($number, 0);
        $this->data['number'] = $number;
        // lấy ra sản phẩm được mua nhiều 
        $input['order'] = array('buyed', 'DESC');
        $product_by = $this->ProductModel->get_list($input);
        $this->data['product_by'] = $product_by;


        // lấy ra danh sách sản phẩm mới
        $input['order'] = array('id', 'DESC');
        $product_new = $this->ProductModel->get_list($input);
        $this->data['product_new'] = $product_new;


        // lấy ra danh sách số sản phẩm và danh mục
        $this->load->model('CatalogModel');
        $inputs = array();
        // điều kiện các danh mục con có danh mục cha mới id = 0
        $inputs['where'] = array('parent_id' => 0, 'status' => 0);
        $inputs['order'] = array('id', 'ASC');

        // lấy ra các danh mục có parent id =0 và lưu vào biến  $catalog_lists
        $catalog_lists = $this->CatalogModel->get_list($inputs);


        // lặp ra các danh mục con 
        foreach ($catalog_lists as $items) {
            //lấy ra sản phẩm thuộc các danh mục con có id = 
            $inputs['where'] = array('parent_id' => $items->id);
            $cata_sub = $this->CatalogModel->get_list($inputs);
            //pre($cata_sub);
            $items->subs = $cata_sub;

            if ($this->input->get('limits') && $this->input->get('limits') > 0 && $this->input->get('cta') > 0) {
                $numbers = $this->input->get('limits');
                $cata = $this->input->get('cta');
            } else {
                $numbers = 4;
                $cata = '';
            }
            $numbers = intval($numbers);
            // $inputss['limit'] = array($numbers,0);
            // foreach ($cata_sub as $key => $item )
            // {

            //     $inputss['where'] = array('catalog_id'=>$item->id);
            //     $sub = $this->ProductModel->get_list($inputss);
            //     $item->subPro = $sub;
            // }
            $listCateSub = [];
            $sub = [];
            foreach ($cata_sub as $key => $item) {
                array_push($listCateSub, $item->id);
            }
            if (!empty($listCateSub)) {
                $In = implode(',', $listCateSub);
                $sub = $this->ProductModel->whereInPro($In, $numbers);
            }

            $items->subPro = $sub;
        }
        //pre($catalog_lists);
        $this->data['number_cate'] = $numbers;
        $this->data['catalog_lists'] = $catalog_lists;
        $this->data['slide'] = $slide_list;
        $this->data['temp'] = "fontend/home/index";
        $this->load->view('fontend/layout', $this->data);
    }
}
