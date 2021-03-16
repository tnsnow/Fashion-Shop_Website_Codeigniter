<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Bảng Thống kê kho hàng</h5>
            <span>Thống kê kho hàng</span>
        </div>

        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>

<div class="wrapper">

    <div class="widgets">
        <!-- Stats -->

        <!-- Amount -->
        

       


        <!-- User -->
       

        <div class="clear"></div>

        <!-- Giao dich thanh cong gan day nhat -->

        <div class="widget">
            <div class="title">
                
                <h6>Danh sách hàng tồn kho</h6>
            </div>

            <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
                


                <thead>
                <tr>
                    
                    <td style="width:60px;">STT</td>
                    <td style="width:60px;">Mã sản phẩm</td>
                    <td style="width:60px;">Ảnh</td>
                    <td style="width:75px;">Tên sản phẩm</td>
                    <td style="width:75px;">Số lượng đã bán</td>
                    
                    <td style="width:90px;">Số lượng</td>
                    <td style="width:100px;">Giá</td>
                    <td style="width:75px;">Ngày tạo</td>
                    
                
                </thead>

                <tfoot class="auto_check_pages">
                    <tr>
                        <td colspan="10">
                            

                            <div class="pagination">
                                <?php
                                    echo $this->pagination->create_links();
                                ?>
                            </div>
                        </td>
                    </tr>
                </tfoot>

                </tr>
                <?php $stt = 0; ?>
                <?php if(isset($list)): ?>
                    <?php foreach($list as $val): ?>
                        <tr>
                            <td><?php echo $stt  = $stt +1; ?></td>
                            <td><?php echo $val ->id ; ?></td>
                            <td>
                                <div class="image_thumb">
                                    <img height="50" src="<?php echo base_url(); ?>Upload/shop151/images/product/<?php echo $val->image_link ?>">
                                    <div class="clear"></div>
                                </div>
                            </td>
                            <td><?php echo $val ->name; ?></td>
                            <td><?php echo $val ->buyed; ?></td>
                            <td><?php echo $val ->total; ?></td>
                            <td><?php echo  number_format($val ->price) ?>đ</td>
                            <td><?php echo strstr($val->created, '-') ? $val->created : get_date($val->created); ?></td>
                        </tr>
                    <?php endforeach?>
                <?php endif ?>

                

            </table>
        </div>

    </div>

</div>

<div class="clear mt30"></div>