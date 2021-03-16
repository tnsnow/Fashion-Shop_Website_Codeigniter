<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
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
                        <a title="Đến trang chủ" href="<?php echo base_url(); ?>" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                     </li>
                     <li class="icon-li"><strong>Đơn hàng của tôi</strong> </li>
                  </ul>
               </div>
               <script type="text/javascript">
                  $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
               </script>
               <div class="myorder-content clearfix">
                  <h1 class="title"><span>Đơn hàng của tôi</span></h1>
                  <div class="myorder-block">
                     <div class="table-responsive clearfix myorder-info">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>STT</th>
                                 <th>Mã đơn hàng</th>
                                 <th>Tên khách hàng</th>
                                 <th>Tổng tiền</th>
                                 <th>Thanh toán</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php $stt = 0; ?>
                           <?php if(isset($list)): ?>
                            <?php foreach($list as $item): ?>
                              <tr>
                                 <td><?php echo $stt = $stt +1 ?></td>
                                 <td><a href=""><?php echo $item ->id ?></a></td>
                                 <td><a href="#"><?php echo $item ->user_name ?></a></td>
                                 <td><?php echo number_format($item ->amount)."đ"; ?></td>
                                 <td>
                                        <?php 
                                        if ( $item->status == 2)
                                            {
                                                echo "<p style='color:red'>Chưa thanh toán</p>";
                                            }
                                            elseif( $item->status == 1)
                                            {
                                               echo "<p style='color:#429a9d'>Đã thanh toán </p>";
                                            }
                                            else
                                            {
                                                echo "<p>Thanh toán thất bại </p>";
                                            }
                                        ?>
                                     
                                 </td>
                                 <?php $name = "chi-tiet-don-hang" ?>
                                 <td class="text-center"><a href="<?php echo base_url($name.'-od'.$item ->id) ?>"><i class="fa fa-angle-double-right "></i>Xem đơn hàng</a></td>
                              </tr>
                            <?php endforeach; ?>
                          <?php endif; ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </div>
</div>