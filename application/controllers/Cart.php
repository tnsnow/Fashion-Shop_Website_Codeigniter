<?php

class Cart extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->library("session");

    }
    function add()
    {
        if(isset($_POST['number']))
        {
            $number = $_POST['number'];
        }
         
       
        $id = $this->uri->rsegment('3');
        $this->load->model('ProductModel');
        $product = $this->ProductModel->get_info($id);
        if(!$product )
        {
            redirect();
        }
        // Tong so san pham
        if(isset($number))
        {
            $qty = $number;
        }else
        {
            $qty = 1;
        }

        $price = $product->price;
        if($product->discount >0 )
        {
            $price = ($product->price*(100-$product->discount))/100;
        }
        // thong tin insert vao gio hang
        $data = array();
        $data['id'] = $product->id;
        $data['qty'] = $qty;
        $data['name'] = url_title($product->name);
        $data['image_link'] = $product->image_link;
        $data['price'] = $price;
        $this->cart->insert($data);

        // chuyen sang trang danh sach san pham trong gio hang
        redirect(base_url('gio-hang.html'));
    }
    /*
     * Hien thi tat ca cac san pham co trong gio hang
     */
    function  index()
    {
        // thong tin gio hang
        $carts = $this->cart->contents();
        // tong so san pahm
        $total_item = $this->cart->total_items();
        $this->data['carts'] = $carts;
        $this->data['total_item'] = $total_item;
        $this->data['temp'] = 'fontend/cart/index';
        $this ->load ->view('fontend/details',$this->data);



    }
    /*
     * cap nhat gio hang
     */

    function update_cart()
    {
        // thong tin gio hang
        $carts = $this->cart->contents();

        foreach ($carts as $key => $item)
        {
//            lấy ra tổng số lượng sản phẩm
            $total_qty = $this->input->post('qty_'.$item['id']);
            $data = array();
            $data['rowid'] = $key;
            $data['qty'] = $total_qty;
            $this->cart->update($data);


        }
        // chuyen sang trang danh sach san pham trong gio hang
        redirect(base_url('gio-hang.html'));

    }

    /*
     * Xoa San pham trong gio hang
     */
    function delete()
    {
        $id = $this->uri->rsegment('3');
        $id = intval($id);
        // truowngf hợp xóa 1 sản phẩm nào đó trong giỏ hang
        if($id >0 )
        {
            // thong tin gio hang
            $carts = $this->cart->contents();

            foreach ($carts as $key => $item)
            {
//
                if($item['id'] == $id)
                {
                    //lấy ra tổng số lượng sản phẩm
                    $data = array();
                    $data['rowid'] = $key;
                    $data['qty'] = 0;
                    $this->cart->update($data);
                }


            }

        }else{
            // xóa toàn bộ giỏ hàng
            $this->cart->destroy();
        }

        // chuyen sang trang danh sach san pham trong gio hang
        redirect(base_url('gio-hang.html'));
    }

    function checkAmountProduct()
    {

        $flgCheck = true;
        $id =  isset($_GET['id']) ? $_GET['id'] : "" ;
        $product = $this->ProductModel->get_info($id);
        $cartss = $this->cart->contents();

        if (!empty($cartss)) {
            foreach ($cartss as $row) {
                if (intval($id) == $row['id']) {
                    if (intval($row['qty']) >= intval($product->total)) {
                        $flgCheck = false;
                    }
                } else {
                    if (intval($product->total) < 1) {
                        $flgCheck = false;
                    }
                }
            }
        } else {
            if (intval($product->total) < 1) {
                $flgCheck = false;
            }
        }
        $data = [
            'flgCheck' => $flgCheck
        ];
        die(json_encode($data));
    }

    function checkQtyCart()
    {
        $id =  isset($_GET['id']) ? $_GET['id'] : "" ;
        $qty =  isset($_GET['qty']) ? $_GET['qty'] : "" ;
        $product = $this->ProductModel->get_info($id);
        $flgCheck = true;

        if (intval($qty)) {
            if (intval($qty) >= intval($product->total)) {
                $flgCheck = false;
            }
        }

        $data = [
            'flgCheck' => $flgCheck,
            'qty' => $qty
        ];

        die(json_encode($data));
    }
   
}