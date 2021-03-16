
<div class="line"></div>

    <div class="wrapper">
        <div class="pageTitle">
            <h5>Danh sách sản phẩm thuộc giao dịch có mã <i> <?php echo $id ?> </i></h5>
            <?php if(isset($info_costomer)): ?>
                <?php foreach($info_costomer as $val): ?>
                    <span><b>Khách hàng : </b></span> <span> <?php echo $val ->user_name ?></span><br>
                    <span><b>Số điện thoại : </b></span> <span> <?php echo $val ->user_phone ?></span><br>
                    <span><b>Địa chỉ : </b></span> <span> <?php echo $val ->address ?></span><br>
                    <span><b>Hình thức thanh toán : </b></span> <span> <?php echo $val ->payment ?></span><br>
                    <span><b>Ngày đặt hàng : </b></span> <span> <?php echo $val ->created ?></span><br>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="horControlB menu_action">
            <ul>
                <li class="print" onclick=" window.print()" ><a href="">
                    <img src="<?php echo public_url('admin') ?>/images/icons/control/16/icon-printer.png">
                    <span>In đơn hàng</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>

<script type="text/javascript">
    (function($)
    {
        $(document).ready(function()
        {
            var main = $('#form');

            // Tabs
            main.contentTabs();

            $('.print')click(function() {
                $('#leftSide').hide();
            });
        });
    })(jQuery);
</script>
<div id="main_transaction" class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <div class="title">
           
            <h6>
                Danh sách các đơn hàng
            </h6>
            <div class="num f12">Số lượng: <b> <?php echo $total_row ?> </b></div>
        </div>
        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
            <thead>
                <tr>
                    <td style="width:60px;">Mã số</td>
                    <td>Mã giao dịch</td>
                    <td>Mã sản phẩm </td>
                    <td>Tổng số sản phẩm </td>
                    <td>Tên sản phẩm </td>
                    <td>Giá sản phẩm </td>
                    <td>Tổng số tiền</td>
                    <td style="width:75px;">Ngày tạo</td>
                </tr>
            </thead>
           
            <tbody class="list_item">
                <?php $stt = 0; ?>
                <?php  foreach ($list_order as  $item ) { ?>
                <tr class="row_<?php echo $item ->id; ?>">
                    
                    <td class="textC"><?php echo $stt = $stt +1; ?></td>
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

                    <td class="textC"> <?php echo  $item->created?></td>
                    
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="6" rowspan="" class="textC"><b>Tổng tiền</b></td>
                    
                    <td colspan="3" class="textC" ><?php
                        $total_amount = 0;
                        foreach ($list_order as $item)
                        {
                            $total_amount = $total_amount + $item->amount;
                        }
                        echo '<b style="color:red">'.number_format($total_amount) .'</b>';
                        ?> ₫</td>
                </tr>
                    

                
            </tbody>
        </table>
    </div>
</div>




