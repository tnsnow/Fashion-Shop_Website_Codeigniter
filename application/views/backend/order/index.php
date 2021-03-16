<?php $this->load->view('backend/order/head',$this->data); ?>
<div class="line"></div>
<div id="main_transaction" class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách các đơn hàng
            </h6>
            <div class="num f12">Số lượng: <b> <?php echo $total_row ?> </b></div>
        </div>
        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
            <thead class="filter"><tr><td colspan="15">
                <form method="get" action="" class="list_filter form">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input type="text" style="width:55px;" id="filter_id" value=" <?php echo $this->input->get('id') ?>" name="id"></td>

                                <td style="width:40px;" class="label"><label for="filter_id">Tên sản phẩm</label></td>
                                <td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_title" value="<?php echo $this->input->get('title') ?>" name="title"></td>

                                <td style="width:60px;" class="label"><label for="filter_status">Tình trạng</label></td>
                                <td class="item">
                                    <select name="delivered">
                                        <option value=""></option>
                                        <option value="1">Đã giao hàng</option>
                                        <option value="2">Chưa giao hàng</option>
                                    </select>
                                </td>
                                <td style="width:60px;" class="label"><label for="filter_status">Ngày tháng</label></td>
                                <td class="item">
                                   <input type="date" style="width:155px;" id="filter_title" value="<?php echo $this->input->get('created') ?>" name="created">
                                </td>

                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url("order") ?>'; " value="Reset" class="basic">
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </form>
            </thead>
            <thead>
                <tr>
                    <td style="width:21px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png"></td>
                    <td style="width:60px;">Mã số</td>
                    <td>Mã giao dịch</td>
                    <td>Mã sản phẩm </td>
                    <td>Tổng số sản phẩm </td>
                    <td>Tên sản phẩm </td>
                    <td>Giá sản phẩm </td>
                    <td>Tổng số tiền</td>
                    <td style="width:75px;">Ngày tạo</td>
                    <td>Tình trạng giao hàng</td>
                    <td style="width:120px;">Hành động</td>
                </tr>
            </thead>
            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="12">
                        <div class="list_action_order itemActions">
                            <a url="<?php admin_url('order/deleteAll') ?>" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Xóa hết</span>
                            </a>
                        </div>

                        <!-- <div class="list itemActions">
                            <a href="<?php //echo admin_url('order/xuatExecl') ?>" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Xuất Excel</span>
                            </a>
                        </div> -->
                        <div class="pagination">
                            <?php
                                echo $this->pagination->create_links();
                                ?>
                        </div>
                    </td>
                </tr>
            </tfoot>
            <tbody class="list_item">

                <?php  foreach ($list as  $item ) { ?>
                <tr class="row_<?php echo $item ->id; ?>">
                    <td><input type="checkbox" value="<?php echo $item -> id; ?>" name="id[]"></td>
                    <td class="textC"><?php echo $item -> id; ?></td>
                    <td><b><?php echo $item->transaction_id ?> </b></td>
                    <td>
                        <a target="_blank" title="" class="tipS" href="">
                        <b><?php echo $item->product_id ?> </b>
                        </a>
                    </td>
                    <td><b><?php echo $item->qty ?> </b></td>
                    <td><b><?php echo $item->name_pr ?> </b></td>
                    <td><b><?php echo number_format($item->price) ?>đ</b></td>
                    <td class="textC"> <?php echo  number_format($item->amount) ?>đ</td>
                    <td class="textC"> <?php echo  strstr($item->created, '-') ? $item->created : get_date($item->created) ?></td>
                    <td class="textC"> <?php
                        if ( $item->delivered ==2)
                        {
                            echo " <a title='Sản phẩm chưa được giao' href='' class='delivered' delivered ='1' id ='".$item ->id."' qty ='".$item->qty."' product_id ='".$item->product_id."'  ><img src='".public_url('admin')."/images/icons/color/delete.png'> </a> ";
                        }
                        elseif( $item->delivered ==1)
                        {
                            echo " <a title='Sản phẩm đã được giao' href='' class='delivered' delivered ='2' id ='".$item ->id."' qty ='".$item->qty."' product_id ='".$item->product_id."'  ><img src='".public_url('admin')."/images/icons/color/accept.png'> </a> ";
                        }
                        
                        ?>
                        
                    </td>
                    <td class="option textC">
                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('order/delete/'. $item->id) ?>">
                        <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png">
                        </a>
                    </td>
                    
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>