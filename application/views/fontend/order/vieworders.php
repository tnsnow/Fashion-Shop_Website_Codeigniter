<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3 " id="top">
                <script src="<?php echo public_url() ?>/app/services/accountServices.js"></script>
                <script src="<?php echo public_url() ?>/app/controllers/accountController.js"></script>
                <div class="menu-account" ng-controller="accountController">
                    <h3>
                        <span>
                            Quản lý cá nhân
                        </span>
                    </h3>
                    <ul>
                        <?php $name = "thong-tin-tai-khoan"; ?>
                        <li class="active"><a href="<?php echo base_url($name.'-u'.$user_info->id) ?>"><i class="glyphicon glyphicon-user"></i>Thông tin tài khoản</a></li>
                        <li><a href="<?php echo base_url('don-hang-cua-toi.html') ?>"><i class="glyphicon glyphicon-list-alt"></i>Đơn hàng của tôi</a></li>
                        <?php $pass = "thay-doi-mat-khau" ?>
                        <li><a href="<?php echo base_url($pass.'-ps'.$user_info->id) ?>"><i class="fa fa-key"></i>Thay đổi mật khẩu</a></li>
                        <li><a href="<?php echo base_url('thoat.html') ?>" ng-click="signOut()"><i class="glyphicon glyphicon-log-out"></i>Thoát</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
               <div class="breadcrumb clearfix">
                  <ul>
                     <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" class="home">
                        <a title="Đến trang chủ" href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                     </li>
                     <li class="icon-li"><strong>Đơn hàng của tôi</strong> </li>
                  </ul>
               </div>
                <?php $this->load->view('fontend/teamplate/alert'); ?>
               <script type="text/javascript">
                  $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
               </script>
               <div class="myorder-content myorder-detail-content clearfix">
                  <h1 class="title"><span>Đơn hàng của tôi</span></h1>
                  <div class="payment-order clearfix">
                        
                            
                            <h3>Mã đơn hàng của bạn: <b><?php echo $transaction->id ?> </b></h3>
                            <p><b>Khách hàng :</b> <i><?php echo  $transaction->user_name ?></i></p>
                            <p><b>Số điện thoại :</b> <i><?php echo  $transaction->user_phone ?></i></p>
                            <p><b>Địa chỉ :</b> <i><?php echo  $transaction->address ?></i></p>
                            <p><b>Ngày đặt:</b> <i><?php echo  $transaction->created ?></i></p>
                            <p><b>Phương thức thanh toán:  </b> <i><?php echo $transaction->payment ?> </i></p>
                            
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phâm</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>Vận chuyển</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($list)): ?>
                                    <?php
                                    $stt = 0;
                                    foreach ( $list as $item){

                                        ?>
                                        <tr>
                                            <td><?php echo $stt = $stt +1; ?></td>
                                            <td>
                                                <span><?php echo $item->name_pr ?> </span>
                                                <p class="note"></p>
                                            </td>
                                            <td><?php echo number_format($item->price) ?> ₫</td>
                                            <td><?php echo $item->qty ?></td>
                                            <td><?php  echo number_format($item->amount) ?> ₫</td>
                                            <td>
                                            <?php
                                                if ( $item->delivered ==2)
                                                {
                                                    echo "Đang chuyển hàng";
                                                }
                                                elseif( $item->delivered ==1)
                                                {
                                                    echo "Đã chuyển hàng";
                                                }
                                                  ?>                     
                        
                     
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right label-payment"><b>Tổng thanh toán:</b></td>
                                    <td class="total-payment"><?php
                                        $total_amount = 0;
                                        foreach ($list as $item)
                                        {
                                            $total_amount = $total_amount + $item->amount;
                                        }
                                        echo number_format($total_amount);
                                        ?> ₫</td>
                                </tr>
                                <?php else: ?>
                                    <h1> Không có sản phẩm nào trong hóa đơn.</h1>
                                <?php endif; ?>
                                </tfoot>
                            </table>
                            
                           <!--  <span class="print-order" onclick="window.print()" ><a href="#"><i class="fa fa-print"></i>In đơn hàng</a></span>
 -->
                        </div>
               </div>
            </div>
        </div>
    </div>
</div>