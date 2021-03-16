<div class="main">
    <div class="container">
        <div class="row">
            <?php $this->load->view('fontend/user/left_acc'); ?>
            <div class="col-md-9">
               <div class="breadcrumb clearfix">
                  <ul>
                     <li itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" class="home">
                        <a title="Đến trang chủ" href="<?php echo base_url() ?>" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                     </li>
                     <li class="icon-li"><strong>Quên mật khẩu</strong> </li>
                  </ul>
               </div>
               <script type="text/javascript">
                  $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
               </script>
               <div class="foget-password-content clearfix ng-scope" ng-controller="accountController" ng-init="initController()">
                  <h1 class="title"><span>Quên mật khẩu</span></h1>
                  <!-- ngIf: IsError -->
                  <!-- ngIf: IsSuccess -->
                  <!-- ngIf: InValid -->
                  <div class="alert alert-info fade in">
                     <button data-dismiss="alert" class="close"></button>
                     <i class="fa-fw fa fa-check"></i>
                     <?php $message = $this->session->flashdata('message'); ?>
                     <?php 
                     if(!isset($message)){
                        echo "Điền vào email của bạn để yêu cầu một mật khẩu mới. Một Email sẽ được gửi đến địa chỉ này để xác minh địa chỉ Email của bạn.";
                     }else{
                        echo $message;
                     } 
                     ?>
                     
                     

                  </div>
                  <div class="col-md-8 col-md-offset-2 col-xs-12 col-sm-12 col-xs-offset-0 col-sm-offset-0">
                     <form class="form-horizontal ng-pristine ng-valid-email ng-invalid ng-invalid-required" method="post" action="<?php echo base_url('user/forgotPassword') ?>">
                        <div class="form-group">
                           <label class="col-sm-4 control-label">Email</label>
                           <div class="col-sm-8">
                              <input type="email" name="email" class="form-control " ng-model="Email" ng-required="true" required="required">
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-sm-4 control-label">Mã xác nhận</label>
                           <div class="col-sm-8">
                              <input type="text" name="captcha" class="form-control " ng-model="Captcha" ng-required="true" required="required">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-offset-4 col-sm-8">
                              <?php echo $captcha['image'] ?>
                              <a class="refresh-captcha" id="btnRefreshCapcha">
                              <i class="glyphicon glyphicon-refresh"></i>
                              </a>
                           </div>
                        </div>
                        <input type="hidden" name="rcaptcha" id="re_captcha" class="show-re-captcha" value="<?php echo $captcha['word'] ?>" >

                        <div class="form-group">
                           <div class="col-sm-offset-4 col-sm-8">
                              <button type="submit" class="btn btn-default">Gửi mật khẩu</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <script type="text/javascript">
                  $("#btnRefreshCapcha").click(function () {
                    $.ajax({
                            url:'http://localhost/thanhcongmart/user/captcha',
                            type:'post',
                            async:true,
                            dataType:'json',
                            data:{},
                            success:function(data)
                            {
                                console.log(data)
                                $("#imgCaptcha").attr("src",data['image']);
                                $("#re_captcha").val(data['word']);
                               
                            }

                        });
                    });


               </script>
            </div>
        </div>
    </div>
</div>