<?php  if (isset( $message)) { ?>
    <div class="nNote nInformation hideit">
        <p><strong>Thông Báo : </strong><?php echo $message ?></p>
    </div>

<?php } ?>
<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb clearfix">
                    <ul>
                        <li itemtype="" itemscope="" class="home">
                            <a title="Đến trang chủ" href="<?php echo base_url() ?>" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                        </li>
                        <li class="icon-li"><strong>Thông tin thẻ ngân hàng</strong> </li>
                    </ul>
                </div>
                <script src="<?php echo public_url() ?>/app/services/orderServices.js"></script>
                <script src="<?php echo public_url() ?>/app/myjava.js"></script>
                <script src="<?php echo public_url() ?>/app/controllers/orderController.js"></script>
                <div class="payment-content" ng-controller="orderController" ng-init="initCheckoutController()">
                    <h1 class="title"><span>Thanh toán</span></h1>

                    <form class="payment-block clearfix" id="checkout-container" method="post" action="">
                        <div class="col-md-4 col-sm-12 col-xs-12 payment-step step2">
                            <h4>1. Thông tin thanh toán</h4>
                            <div class="step-preview clearfix">

                                <h2 class="title">Thông tin thẻ thanh toán</h2>

                                <div class="form-block" ng-if="CustomerId<=0">
                                    <div class="form-group">
                                        <label>Số thẻ :</label>
                                        <input class="form-control" placeholder="Số thẻ : 4123 4567 8901 2345" type="text" name="creditCard" value=""  required="true" />
                                        <div class="clear error" name="name_error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên in trên thẻ:</label>
                                        <input class="form-control" placeholder="NGUYEN VAN A" type="text" name="cardName" value=""  required="true" />
                                        <div class="clear error" name="name_error"> </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày hết hạn:</label>
                                        <input class="form-control" placeholder="MM/YY" type="text" name="expiryDate" value=""   required="true" style="width: 30%;" />
                                        <div class="clear error" name="name_error"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Mã bảo mật:</label>
                                        <input class="form-control" placeholder="Mã bảo mật" type="text" name="cvv" value=""   required="true" style="width: 30%;" />
                                        <div class="clear error" name="name_error"></div>
                                    </div>
                                    <div class="radio" ng-repeat="item in PaymentMethods">
                                        <label>
                                            <input type="checkbox" value="luu_bao_mat" name="optionsRadios" checked  /> Lưu và bảo mật thẻ cho lần thanh toán sau . <br>
                                        </label>
                                        <p style="text-align: justify; margin-top: 10px;">
                                            Chúng tôi không trực tiếp lưu thẻ của bạn. Để đảm bảo an toàn, thông tin thẻ của bạn chỉ được lưu bởi CyberSource, công ty quản lý thanh toán lớn nhất thế giới (thuộc tổ chức VISA)
                                        </p>
                                    </div>

                                    <div class="button-submit">
                                        <button class="btn btn-default"  type="submit" >Thanh toán</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>



            </div>
        </div>
    </div>
</div>
