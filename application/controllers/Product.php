<?php
    class Product extends MY_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('ProductModel');
            $this->load->model('SlideModel');
            $this->load->model('CatalogModel');
            $this->load->library("session");
        }
        public function index()
        {
            
            $slide_list = $this->SlideModel->get_list();

            // lấy ra danh sách sản phẩm bán chạy
            $input = array();
            if ($this->input->get('limit') && $this->input->get('limit') > 0  )
            {
                $number = $this->input->get('limit');
            }
            else
            {
                $number = 4;
            }
            $number = intval($number);

            $input['limit'] = array($number,0);
            $this->data['number'] = $number;
            $input['order'] = array('buyed','DESC');
            $product_by = $this->ProductModel->get_list($input);
            $this->data['product_by'] = $product_by;

            // lấy ra danh sách số sản phẩm và danh mục
           
            $inputs = array();
            $inputs['where'] = array('parent_id'=>0 ,'status' => 0);
            $inputs['order'] = array('id','ASC');
            $catalog_lists= $this->CatalogModel->get_list($inputs);

            foreach ($catalog_lists as $items)
            {
                // lay ra danh muc con
                $inputs['where'] = array('parent_id'=>$items->id , 'status' => 0);
                $cata_sub = $this->CatalogModel->get_list($inputs);
                $items->subs=$cata_sub;
                foreach ($cata_sub as $item )
                {
                    if ($this->input->get('limits') && $this->input->get('limits') > 0 && $this->input->get('cta') > 0 )
                    {
                        $numbers = $this->input->get('limits');
                        $cata = $this->input->get('cta');
                    }
                    else
                    {
                        $numbers = 4;
                        $cata = '';
                    }
                    $numbers = intval($numbers);
                    $inputs['limit'] = array($numbers,0);
                    $this->data['numbers'] = $numbers;
                    $inputs['where'] = array('catalog_id'=>$item->id , );
                    $sub = $this->ProductModel->get_list($inputs);
                    $item->subPro = $sub;
                }

            }
            $this->load->model('IntroModel');
            //lấy ra thông tin bảng giới thiệu
            $list_info = $this->IntroModel->get_list();
            $this->data['list_info'] = $list_info;

            $this->session->set_flashdata('list_info', $list_info );
            
            $this->data['catalog_lists'] = $catalog_lists;

            $this->data['slide'] = $slide_list;
            $this->data['temp']= "fontend/product/index";
            $this ->load ->view('fontend/details',$this->data);
        }
        // hien thi danh sach san pham theo danh muc
        function catalog()
        {
            $id = intval($this->uri->rsegment('3'));

            $this->load->model('CatalogModel');
            // 
            $catalog = $this->CatalogModel->get_info($id);

            if(!$catalog )
            {
                redirect(base_url());
            }

            // gửi thông tin biến cata log qua view hiển thị 
            $this->data['catalog'] = $catalog;
            $catalog_sub= '';
            $this->data['catalog_sub']=$catalog_sub;
            $input = array();
            // kiểm tra xem đây là danh mục con hay danh mục cha nếu parent_id == 0
            if($catalog ->parent_id == 0)
            {
                // lấy ra id của danh mục con danh mục hiện tại
                $input_ca = array();
                // điều kiện danh mục cha 
                $input_ca['where'] = array('parent_id'=> $id);
                $catalog_sub = $this->CatalogModel->get_list($input_ca);
                $this->data['catalog_sub'] = $catalog_sub ;
                if(!empty($catalog_sub)) // nếu danh mục hiện tại có danh mục con
                {
                    // lấy ra id thuộc danh mục con
                    $catalog_sub_id=array();
                    foreach ($catalog_sub as $sub) {
                        // lưu id danh mục con vào mảng
                        $catalog_sub_id[] = $sub->id;
                    }
                    // lấy tất cả sản phẩm thuộc danh mục con thuộc catalog_sub
                    $this->db->where_in('catalog_id',$catalog_sub_id);
                }else{
                    $input['where'] = array('catalog_id'=>$id);
                }
            }else
            {
                $input['where'] = array('catalog_id'=>$id);
            }

            $input['order']  = $this->session->userdata("order") ?  $this->session->userdata("order") : array('id','DESC');
            // lấy ra số lượng các sản phẩm trên website
            $total_row = $this->ProductModel->get_total($input);
            $this->data['total_row'] = $total_row;
            // thư viện phân trang
            $this->load->library('pagination');
            $config  = array();
            $config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
            $config['base_url'] =  base_url('product/catalog/'.$id); // link hiển thị dữ lieeu danh sách sản phẩm
            $config['per_page'] =  12; // số sản phẩm hiển thị trên 1 trang
            $config['uri_segment'] =4 ; // phân đoạn hiển thị số trnag
            $config['next_link']= 'Next' ; //Nhãn tên của nút Next
            $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
            // khởi tạo cấu hình phân trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(4);
            $segment = intval($segment);
            $input['limit'] = array($config['per_page'],$segment );
            

            // lấy ra danh sách sản phẩm
            if(isset($catalog_sub_id))
            {
                $this->db->where_in('catalog_id', $catalog_sub_id);
            }
            $list = $this->ProductModel->get_list($input);
            $this->data['list'] = $list;
            $this->data['sort'] = $this->session->userdata("sort");

            $this->load->model('IntroModel');
            //lấy ra thông tin bảng giới thiệu
            $list_info = $this->IntroModel->get_list();
            $this->data['list_info'] = $list_info;

            $this->session->set_flashdata('list_info', $list_info );

            // hiển thị ra phần view trang catalog
            $this->data['temp'] = 'fontend/product/catalog';
            $this ->load ->view('fontend/details',$this->data);

        }

        public function arrange()  {
            

            $id = $_POST['id']; 
            $this->load->model('CatalogModel');
            // 
            $catalog = $this->CatalogModel->get_info($id);

            if(!$catalog )
            {
                redirect(base_url());
            }

            // gửi thông tin biến cata log qua view hiển thị 
            $input = array();
            // kiểm tra xem đây là danh mục con hay danh mục cha nếu parent_id == 0
            if($catalog ->parent_id == 0)
            {
                // lấy ra id của danh mục con danh mục hiện tại
                $input_ca = array();
                // điều kiện danh mục cha 
                $input_ca['where'] = array('parent_id'=> $id);
                $catalog_sub = $this->CatalogModel->get_list($input_ca);
                $this->data['catalog_sub'] = $catalog_sub ;
                if(!empty($catalog_sub)) // nếu danh mục hiện tại có danh mục con
                {
                    // lấy ra id thuộc danh mục con
                    $catalog_sub_id=array();
                    foreach ($catalog_sub as $sub) {
                        // lưu id danh mục con vào mảng
                        $catalog_sub_id[] = $sub->id;
                    }
                    // lấy tất cả sản phẩm thuộc danh mục con thuộc catalog_sub
                    $this->db->where_in('catalog_id',$catalog_sub_id);
                }else{
                    $input['where'] = array('catalog_id'=>$id);
                }
            }else
            {
                $input['where'] = array('catalog_id'=>$id);
            }


            // lấy ra số lượng các sản phẩm trên website
            $total_row = $this->ProductModel->get_total($input);
            $this->data['total_row'] = $total_row;
            // thư viện phân trang
            $this->load->library('pagination');
            $config  = array();
            $config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
            $config['base_url'] =  base_url('product/catalog/'.$id); // link hiển thị dữ lieeu danh sách sản phẩm
            $config['per_page'] =  12; // số sản phẩm hiển thị trên 1 trang
            $config['uri_segment'] =4 ; // phân đoạn hiển thị số trnag
            $config['next_link']= 'Next' ; //Nhãn tên của nút Next
            $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
            // khởi tạo cấu hình phân trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(4);
            $segment = intval($segment);
            $input['limit'] = array($config['per_page'],$segment );
            
            // lấy ra danh sách sản phẩm
            if(isset($catalog_sub_id))
            {
                $this->db->where_in('catalog_id', $catalog_sub_id);
            }
            //$input['order'] = array('id','ASC');
            $arrange  = isset($_POST['arrange'])?$_POST['arrange'] : "";
            if(!empty($arrange)){
                if($arrange == "az"){
                    $this->session->set_userdata("order", array('name','ASC'));
                    $this->session->set_userdata("sort", 'az');
                }
                if($arrange == "za"){
                    $this->session->set_userdata("order", array('name','DESC'));
                    $this->session->set_userdata("sort", 'za');
                }

                if($arrange == "tc"){
                    $this->session->set_userdata("order", array('price','ASC'));
                    $this->session->set_userdata("sort", 'tc');
                }
                if($arrange == "ct"){
                    $this->session->set_userdata("order", array('price','DESC'));
                    $this->session->set_userdata("sort", 'ct');
                }
            }
            $input['order']  = $this->session->userdata("order") ?  $this->session->userdata("order") : array('id','DESC');
            $list = $this->ProductModel->get_list($input);
            $this->data['list'] = $list;

             foreach ($list  as $item )
             {
                $name = safe_title($item->name);
                $name = strtolower($name);
                echo ' <div class="col-md-3 col-sm-3 col-xs-12 product-resize product-item-box">
                            <div class="product-item">
                                <div class="image image-resize">
                                    <a href="'.base_url($name.'-sp'.$item->id).'" title="'.$item->name.'">
                                        <img src="'.base_url().'upload/shop151/images/product/'. $item->image_link .'" class="img-responsive" />
                                    </a>
                                    <a class="hover-image" href="'.base_url($name.'-sp'.$item->id).'">
                                        <img src="'. base_url().'upload/shop151/images/product/'.$item->image_link.'" class="img-responsive" />
                                    </a>
                                    <div class="view-more clearfix">
                                        <a href="'.base_url($name.'-sp'.$item->id).'" class="btn-quickview">Xem thêm</a>
                                    </div>';
                                    $now = getdate(); 
                                    $currentDate = $now["mon"]; 
                                    $string = $item->created;
                                    $mon = substr($string ,3,2);
                                    $mon = (int)$mon;
                                    $dates = $currentDate - $mon;
                                    // if(0 <= $dates && $dates < 2)
                                    // {
                                    //     if(10 < $item->buyed)
                                    //     {
                                    //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/hot-icon.gif " width="50"></span>';
                                    //     }else
                                    //     {
                                    //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/Temp.png " width="50"></span>';
                                    //     }
                                        
                                    // }

                                    echo ' <span class="promotion">-'.$item ->discount .'%</span>';
                                    echo '</div>
                                    <div class="right-block">
                                        <h2 class="name">
                                            <a href="'.base_url($name.'-sp'.$item->id).'" title="'.$item->name .'">'.$item->name .'</a>
                                        </h2>
                                        <div class="price">';
                                            if( $item ->discount  > 0){
                                                $price_new = ($item->price*(100-$item->discount))/100;
                                                echo'<span class="price-new">'.number_format($price_new).'</span>
                                                <span class="price-old">'.number_format($item->price).'</span>';

                                            }elseif($item ->discount == 0){
                                                echo '<span class="price-new">'.number_format($item->price).'</span>';
                                            }
                                                
                                                
                                        $name ="them-vao-gio-hang";
                                        echo '</div>
                                        <div class="box-inner clearfix">
                                            <ul class="add-to-links">
                                                <li> <a class=" add-cart" href="'.base_url($name.'-gh'.$item->id).'" onclick="AddToCard(3329,1)"></a></li>
                                                <!-- <li><a class="add-wishlist" href="#"></a></li>
                                                <li><a class="add-compare" href="#"></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>';
    
             }

        }




        // hiển thị tất cả sản phẩm 
        function showProduct()
        {
           
            // lấy ra số lượng các sản phẩm trên website
            $total_row = $this->ProductModel->get_total();
            $this->data['total_row'] = $total_row;
            // thư viện phân trang
            // thư viện phân trang
            $this->load->library('pagination');
            $config  = array();
            $config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
            $config['base_url'] =  base_url('product/showProduct');; // link hiển thị dữ lieeu danh sách sản phẩm
            $config['per_page'] =  16; // số sản phẩm hiển thị trên 1 trang
            $config['uri_segment'] = 3; // phân đoạn hiển thị số trnag
            $config['next_link']= 'Next' ; //Nhãn tên của nút Next
            $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
            // khởi tạo cấu hình phân trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(3);
            $segment = intval($segment);
            $input['limit'] = array($config['per_page'],$segment );
            //pre($input);
            $input['order']  = $this->session->userdata("order") ?  $this->session->userdata("order") : array('id','DESC');
            $this->data['sort'] = $this->session->userdata("sort");
            $list = $this->ProductModel->get_list($input);
            //pre($list);
            
            $this->data['list'] = $list;

            // hiển thị ra phần view trang catalog
            $this->data['temp'] = 'fontend/product/list_product';
            $this ->load ->view('fontend/details',$this->data);

        }

        function showProducts()
        {
           
            // lấy ra số lượng các sản phẩm trên website
            $total_row = $this->ProductModel->get_total();
            $this->data['total_row'] = $total_row;
            // thư viện phân trang
            // thư viện phân trang
            $this->load->library('pagination');
            $config  = array();
            $config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
            $config['base_url'] =  base_url('product/showProduct');; // link hiển thị dữ lieeu danh sách sản phẩm
            $config['per_page'] =  16; // số sản phẩm hiển thị trên 1 trang
            $config['uri_segment'] = 3; // phân đoạn hiển thị số trnag
            $config['next_link']= 'Next' ; //Nhãn tên của nút Next
            $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
            // khởi tạo cấu hình phân trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(3);
            $segment = intval($segment);
            $input['limit'] = array($config['per_page'],$segment );
            //pre($input);
            $arrange  = isset($_POST['arrange'])?$_POST['arrange'] : "";
            if(!empty($arrange)){
                if($arrange == "az"){
                    $this->session->set_userdata("order", array('name','ASC'));
                    $this->session->set_userdata("sort", 'az');
                }
                if($arrange == "za"){
                    $this->session->set_userdata("order", array('name','DESC'));
                    $this->session->set_userdata("sort", 'za');
                }

                if($arrange == "tc"){
                    $this->session->set_userdata("order", array('price','ASC'));
                    $this->session->set_userdata("sort", 'tc');
                }
                if($arrange == "ct"){
                    $this->session->set_userdata("order", array('price','DESC'));
                    $this->session->set_userdata("sort", 'ct');
                }
            }
            $input['order']  = $this->session->userdata("order") ?  $this->session->userdata("order") : array('id','DESC');
            $list = $this->ProductModel->get_list($input);
            //pre($list);
            
            foreach ($list  as $item )
             {
                echo ' <div class="col-md-3 col-sm-3 col-xs-12 product-resize product-item-box">
                            <div class="product-item">
                                <div class="image image-resize">
                                    <a href="'.base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'.'" title="'.$item->name.'">
                                        <img src="'.base_url().'upload/shop151/images/product/'. $item->image_link .'" class="img-responsive" />
                                    </a>
                                    <a class="hover-image" href="'.base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'.'">
                                        <img src="'. base_url().'upload/shop151/images/product/'.$item->image_link.'" class="img-responsive" />
                                    </a>
                                    <div class="view-more clearfix">
                                        <a href="'.base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'.'" class="btn-quickview">Xem thêm</a>
                                    </div>';
                                     $now = getdate(); 
                                    $currentDate = $now["mon"]; 
                                    $string = $item->created;
                                    $mon = substr($string ,3,2);
                                    $mon = (int)$mon;
                                    $dates = $currentDate - $mon;
                                    // if(0 <= $dates && $dates < 2)
                                    // {
                                    //     if(10 < $item->buyed)
                                    //     {
                                    //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/hot-icon.gif " width="50"></span>';
                                    //     }else
                                    //     {
                                    //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/Temp.png " width="50"></span>';
                                    //     }
                                        
                                    // }

                                    echo ' <span class="promotion">-'.$item ->discount .'%</span>';
                                    echo '</div>
                                    <div class="right-block">
                                        <h2 class="name">
                                            <a href="'.base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'.'" title="'.$item->name .'">'.$item->name .'</a>
                                        </h2>
                                        <div class="price">';
                                            if( $item ->discount  > 0){
                                                $price_new = ($item->price*(100-$item->discount))/100;
                                                echo'<span class="price-new">'.number_format($price_new).'</span>
                                                <span class="price-old">'.number_format($item->price).'</span>';

                                            }elseif($item ->discount == 0){
                                                echo '<span class="price-new">'.number_format($item->price).'</span>';
                                            }
                                                
                                                
                                        
                                        echo '</div>
                                        <div class="box-inner clearfix">
                                            <ul class="add-to-links">
                                                <li> <a class=" add-cart" href="'.base_url('cart/add/'.$item->id).'/'.safe_title($item->name).'.html'.'" onclick="AddToCard(3329,1)"></a></li>
                                                <!-- <li><a class="add-wishlist" href="#"></a></li>
                                                <li><a class="add-compare" href="#"></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>';
    
             }

        }


        /*
         * hiển thị chi tiết sản phẩm
         */

        function view()
        {
            // lấy id của sản phẩm muốn xem
            $id = intval($this->uri->rsegment('3'));
            $product = $this->ProductModel->get_info($id);
            if(!$product)
            {
                redirect();
            }
            //pre($product);
            $this->data['product'] = $product;
            // lấy ra ảnh sản phẩm
            $image_list = json_decode($product->image_list);
            $this->data['image_list'] = $image_list;

            // cập nhập lai lượt xem sản phẩm
            $data = array();
            $data['view'] = $product ->view +1 ;
            $this->ProductModel->update($product->id,$data);

            // lấy ra thông tin của danh mục sản phẩm
            $this->load->model('CatalogModel');
            $catalog = $this->CatalogModel->get_info($product->catalog_id);
            $this->data['catalog'] = $catalog;
            // lay ra san pham hot
            $input = array();
            $input['limit'] = array(5,0);
            $input['order'] = array('view','DESC');
            $product_hot = $this->ProductModel->get_list($input);
            $this->data['product_hot'] = $product_hot;

            $this->load->model('IntroModel');
            //lấy ra thông tin bảng giới thiệu
            $list_info = $this->IntroModel->get_list();
            $this->data['list_info'] = $list_info;

            $this->session->set_flashdata('list_info', $list_info );
            // hiển thị ra phần view
            $this->data['temp'] = 'fontend/product/view';
            $this ->load ->view('fontend/details',$this->data);
        }

        // tìm kiếm theo tên
        function search()
        {
            if ($this->uri->rsegment('3') == 1)
            {
                // lấy dữ liệu từ automatic complete
                $key = $this->input->get('term');
            }
            else{
                $key = $this->input->get('key-search');
            }

            $this->data['key'] = trim($key);
            $input = array();
            $input['like'] = array('name',$key);
            $list = $this->ProductModel->get_list($input);

            $this->data['list'] = $list;

            if ($this->uri->rsegment('3') == 1)
            {
                // xử lý autocomplete
                $result = array();
                foreach ($list as $row)
                {
                    $item = array();
                    $item['id'] = $row ->id;
                    $item['lable'] = $row->name;
                    $item['value'] = $row->name;
                    $result[] = $item;
                }
                // du lieu tra ve
                die(json_encode($result));
            }

            $this->load->model('IntroModel');
            //lấy ra thông tin bảng giới thiệu
            $list_info = $this->IntroModel->get_list();
            $this->data['list_info'] = $list_info;

            $this->session->set_flashdata('list_info', $list_info );
            
            // hiển thị ra phần view
            $this->data['temp'] = 'fontend/product/search';
            $this ->load ->view('fontend/details',$this->data);

        }

        /*
     * Tìm kiếm theo giá sản phẩm
     */

        function searchPrice()
        {
            $this->load->model('IntroModel');
            //lấy ra thông tin bảng giới thiệu
            $list_info = $this->IntroModel->get_list();
            $this->data['list_info'] = $list_info;

            $this->session->set_flashdata('list_info', $list_info );
                
            $from =  isset($_GET['from'])?$_GET['from']:"" ;
            $to =  isset($_GET['to'])?$_GET['to']:"" ;
            $from = intval($from);
            $to = intval($to);
            
            $id = isset($_GET['id'])?$_GET['id']:"";
            $id = intval($id) ;

            $this->load->model('CatalogModel');
            // 
            $catalog = $this->CatalogModel->get_info($id);

            if(!$catalog )
            {
                redirect(base_url());
            }

            // gửi thông tin biến cata log qua view hiển thị 
            $input = array();
            // kiểm tra xem đây là danh mục con hay danh mục cha nếu parent_id == 0
            if($catalog ->parent_id == 0)
            {
                // lấy ra id của danh mục con danh mục hiện tại
                $input_ca = array();
                // điều kiện danh mục cha 
                $input_ca['where'] = array('parent_id'=> $id);
                $catalog_sub = $this->CatalogModel->get_list($input_ca);
                $this->data['catalog_sub'] = $catalog_sub ;
                if(!empty($catalog_sub)) // nếu danh mục hiện tại có danh mục con
                {
                    // lấy ra id thuộc danh mục con
                    $catalog_sub_id=array();
                    foreach ($catalog_sub as $sub) {
                        // lưu id danh mục con vào mảng
                        $catalog_sub_id[] = $sub->id;
                    }
                    // lấy tất cả sản phẩm thuộc danh mục con thuộc catalog_sub
                    $this->db->where_in('catalog_id',$catalog_sub_id);
                }else{
                    $input['where'] = array('catalog_id'=>$id,'price >=' =>$from, 'price <='=> $to);
                }

                $input['where'] = array('price >=' =>$from, 'price <='=> $to);
            }else
            {
                $input['where'] = array('catalog_id'=>$id,'price >=' =>$from, 'price <='=> $to);
            }




            // lấy ra số lượng các sản phẩm trên website
            $total_row = $this->ProductModel->get_total($input);
            $this->data['total_row'] = $total_row;
            // thư viện phân trang
            $this->load->library('pagination');
            $config  = array();
            $config['total_rows'] =  $total_row; // tổng tất cả các sản phẩm trên website ;
            $config['base_url'] =  base_url('product/catalog/'.$id); // link hiển thị dữ lieeu danh sách sản phẩm
            $config['per_page'] =  12; // số sản phẩm hiển thị trên 1 trang
            $config['uri_segment'] =4 ; // phân đoạn hiển thị số trnag
            $config['next_link']= 'Next' ; //Nhãn tên của nút Next
            $config['prev_link']= 'Previous' ; //Nhãn tên của nút Previous
            // khởi tạo cấu hình phân trang
            $this->pagination->initialize($config);

            $segment = $this->uri->segment(4);
            $segment = intval($segment);
            $input['limit'] = array($config['per_page'],$segment );
            
            // lấy ra danh sách sản phẩm
            if(isset($catalog_sub_id))
            {
                $this->db->where_in('catalog_id', $catalog_sub_id);
            }

            $list = $this->ProductModel->get_list($input);
             foreach ($list  as $item )
             {
                $name = safe_title($item->name);
                $name = strtolower($name);
                echo ' <div class="col-md-3 col-sm-3 col-xs-12 product-resize product-item-box">
                            <div class="product-item">
                                <div class="image image-resize">
                                    <a href="'.base_url($name.'-sp'.$item->id).'" title="'.$item->name.'">
                                        <img src="'.base_url().'upload/shop151/images/product/'. $item->image_link .'" class="img-responsive" />
                                    </a>
                                    <a class="hover-image" href="'.base_url($name.'-sp'.$item->id).'">
                                        <img src="'. base_url().'upload/shop151/images/product/'.$item->image_link.'" class="img-responsive" />
                                    </a>
                                    <div class="view-more clearfix">
                                        <a href="'.base_url($name.'-sp'.$item->id).'" class="btn-quickview">Xem thêm</a>
                                    </div>';
                                     $now = getdate(); 
                                    $currentDate = $now["mon"]; 
                                    $string = $item->created;
                                    $mon = substr($string ,3,2);
                                    $mon = (int)$mon;
                                    $dates = $currentDate - $mon;
                                    // if(0 <= $dates && $dates < 2)
                                    // {
                                    //     if(10 < $item->buyed)
                                    //     {
                                    //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/hot-icon.gif " width="50"></span>';
                                    //     }else
                                    //     {
                                    //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/Temp.png " width="50"></span>';
                                    //     }
                                        
                                    // }

                                    echo ' <span class="promotion">-'.$item ->discount .'%</span>';
                                    echo '</div>
                                    <div class="right-block">
                                        <h2 class="name">
                                            <a href="'.base_url($name.'-sp'.$item->id).'" title="'.$item->name .'">'.$item->name .'</a>
                                        </h2>
                                        <div class="price">';
                                            if( $item ->discount  > 0){
                                                $price_new = ($item->price*(100-$item->discount))/100;
                                                echo'<span class="price-new">'.number_format($price_new).'</span>
                                                <span class="price-old">'.number_format($item->price).'</span>';

                                            }elseif($item ->discount == 0){
                                                echo '<span class="price-new">'.number_format($item->price).'</span>';
                                            }
                                                
                                                
                                        $name ="them-vao-gio-hang";
                                        echo '</div>
                                        <div class="box-inner clearfix">
                                            <ul class="add-to-links">
                                                <li> <a class=" add-cart" href="'.base_url($name.'-gh'.$item->id).'" onclick="AddToCard(3329,1)"></a></li>
                                                <!-- <li><a class="add-wishlist" href="#"></a></li>
                                                <li><a class="add-compare" href="#"></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>';
    
             }
            
    

        }
    }

?>