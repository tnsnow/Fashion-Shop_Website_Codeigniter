<div class="titleArea">
    <div class="wrapper">
        <div class="pageTitle">
            <h5>Bảng điều khiển</h5>
            <span>Trang quản lý hệ thống</span>
        </div>

        <div class="clear"></div>
    </div>
</div>
<div class="line"></div>

<div class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <div class="oneTwo">
            <div class="widget">
                <div class="title">
                    <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/money.png">
                    <h6>Doanh số</h6>
                </div>

                <table width="100%" cellspacing="0" cellpadding="0" class="sTable myTable">
                    <tbody>

                    <tr>
                        <td class="fontB blue f13">Đã thanh toán</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php
                            $S = 0;
                            foreach ($total_pay as $item)
                            {
                                $S = $S + $item->amount;
                            }

                            echo number_format($S) ."đ";
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="fontB blue f13">Đang chờ xủ lý</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php
                            $S = 0;
                            foreach ($total_un  as $item)
                            {
                                $S = $S + $item->amount;
                            }

                            echo number_format($S) ."đ";
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="fontB blue f13">Doanh số hôm nay</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php if(isset($lists)): ?>
                            <?php
                            $S = 0;
                            foreach ($lists  as $item)
                            {
                                $S = $S + $item->amount;
                            }

                            echo number_format($S) ."đ";
                            ?>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="fontB blue f13">Doanh số tháng này</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php if(isset($list_mon)): ?>
                            <?php
                                $S = 0;
                                foreach ($list_mon  as $item)
                                {
                                    $S = $S + $item->amount;
                                }

                            echo number_format($S) ."đ";
                            ?>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="fontB blue f13">Doanh số năm nay</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php
                                $S = 0;
                                foreach ($list_year  as $item)
                                {
                                    $S = $S + $item->amount;
                                }

                            echo number_format($S) ."đ";
                            ?>
                        </td>
                    </tr>

                    
                    <tr>
                        <td class="fontB blue f13">Tổng doanh số</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php
                                $S = 0;
                                foreach ($listtt  as $item)
                                {
                                    $S = $S + $item->amount;
                                }

                                echo number_format($S) ."đ";
                            ?>

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="oneTwo">
            <div class="widget">
                <div class="title">
                    <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/money.png">
                    <h6>Thống kê dữ liệu giao dịch</h6>
                </div>

                <table width="100%" cellspacing="0" cellpadding="0" class="sTable myTable">
                    <tbody>
                    <tr>
                        <td class="fontB blue f13">Giao dịch hôm nay</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php if(isset($lists)): ?>
                            <?php echo count($lists)?>
                            <?php endif ?>

                        </td>
                    </tr>
                    
                    <tr>
                        <td class="fontB blue f13">Giao dịch tháng này</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                           <?php if(isset($sum_list_mon)): ?>
                            <?php echo count($sum_list_mon)?>
                            <?php endif ?>

                        </td>
                    </tr>
                    <tr>
                        <td class="fontB blue f13">Tổng số giao dịch</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php
                                echo $total_row ;
                            ?>

                        </td>
                    </tr>

                    <tr>
                        <td class="fontB blue f13">Đang chờ xử lý</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php
                                $num = count($total_pay);
                                echo $total_row - $num ;
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td class="fontB blue f13">Đã Xử lý</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php
                                echo $num ;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fontB blue f13">Đơn hàng chưa giao</td>
                        <td style="width:120px;" class="textR webStatsLink red">
                            <?php if(isset($list_order)): ?>
                                <?php
                                    echo count($list_order) ;
                                ?>
                            <?php endif ?>
                        </td>
                    </tr>
                    

                    </tbody>
                </table>
                
            </div>
        </div>

        <div class="oneTwo">
            <div class="widget">
                <div class="title">
                    <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/users.png">
                    <h6>Thống kê dữ liệu</h6>
                </div>

                <table width="100%" cellspacing="0" cellpadding="0" class="sTable myTable">
                    <tbody>

                   

                    <tr>
                        <td>
                            <div class="left">Tổng số sản phẩm</div>
                            <div class="right f11"><a href=""></a></div>
                        </td>

                        <td class="textC webStatsLink">
                            <?php echo $total_row_pr ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="left">Tổng số bài viết</div>
                            <div class="right f11"><a href="<?php echo admin_url('news') ?>">Chi tiết</a></div>
                        </td>

                        <td class="textC webStatsLink">
                            <?php echo $total_row_nw ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="left">Tổng số thành viên</div>
                            <div class="right f11"><a href="<?php echo admin_url('user') ?>">Chi tiết</a></div>
                        </td>

                        <td class="textC webStatsLink">

                            <?php echo $total_row_us ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="left">Tổng số liên hệ</div>
                            <div class="right f11"><a href="<?php echo admin_url('contact') ?>">Chi tiết</a></div>
                        </td>

                        <td class="textC webStatsLink">
                            <?php echo $total_row_contact ?>				
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="left">Số liên hệ hôm nay</div>
                            <div class="right f11"><a href="<?php echo admin_url('contact') ?>">Chi tiết</a></div>
                        </td>

                        <td class="textC webStatsLink">
                            <?php if(isset($list_contact_day)): ?>
                                <?php echo count($list_contact_day) ?>
                            <?php endif; ?>      
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="left">Số liên hệ chưa được xử lý</div>
                            <div class="right f11"><a href="<?php echo admin_url('contact/sendEmailAll') ?>">Chi tiết</a></div>
                        </td>

                        <td class="textC webStatsLink">
                            <?php if(isset($list_contact_active)): ?>
                                <?php echo count($list_contact_active) ?>
                            <?php endif; ?>      
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>

        <div style="padding-right: 20px;" class="oneTwo">
            <div  class="widget">
                <div class="title">
                    <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/money.png">
                    <h6>Tốp 5 sản phẩm bán chạy</h6>
                </div>

                <table width="100%" cellspacing="0" cellpadding="0" class="sTable myTable">
                    <tbody>
                        <thead>
                            <tr>
                                
                                <td style="width:60px;">STT</td>
                                <td style="width:60px;">Mã sản phẩm</td>
                                <td style="width:75px;">Tên sản phẩm</td>
                                <td style="width:90px;">Số lượng bán được</td>
                                
                            </tr>
                        </thead>
                    <?php $stt =0; ?>
                    <?php if(!empty($product_by)): ?> 
                    <?php foreach($product_by as $val): ?>
                        <tr>
                            <td><?php echo $stt = $stt +1 ?></td>
                            <td><?php echo $val ->id  ?></td>
                            <td><?php echo $val ->name  ?></td>
                            <td><?php echo $val ->buyed  ?></td>
                        </tr>
                    <?php endforeach ?> 
                    <?php endif; ?>


                    </tbody>
                </table>
            </div>
        </div>
        <br>
    </div>

    <div class="clear"></div>
        <!-- Giao dich thanh cong gan day nhat -->
    <div class="widget">
        <div class="title">
            
            <h6>Danh sách Giao dịch</h6>
        </div>

        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
            


            <thead>
            <tr>
                
                <td style="width:60px;">Mã số</td>
                <td style="width:75px;">Thành viên</td>
                <td style="width:90px;">Số tiền</td>
                <td>Hình thức</td>
                <td style="width:75px;">Ngày tạo</td>
                <td style="width:55px;">Xem hóa đơn</td>
            </tr>
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

            <tbody class="list_item">
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $item): ?>
                <tr>
              

                <td class="textC"> <?php echo $item->id ?> </td>

                <td>
                    <?php echo $item->user_name ?>
                </td>

                <td class="textR red"><?php echo number_format($item->amount) ?> đ</td>

                <td>
                    <?php echo $item ->payment  ?>
                </td>



                <td class="textC"><?php echo  $item->created ?></td>

                <td class="option textC">

                    <a title="Xem chi tiết giao dịch" class="tipS" target="_blank" href="<?php echo admin_url('transaction/order/'. $item->id) ?>">
                        <img src="<?php echo public_url('admin')?>/images/icons/color/view.png">
                    </a>
                </td>
            </tr>
                <?php endforeach; ?>
            <?php else: ?>
                
            <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>

<div class="clear mt30"></div>