
<div class="footer">

    <div class="footer-content clearfix">
        <div class="container">
            <div class="row">
                <div class="footer-box col-md-3 col-sm-12 col-xs-12">
                    <div class="item">
                        <h3>
                            <span>Giới thiệu</span>
                        </h3>
                    </div>
                    <ul>
                        <li>
                            <a href="<?php echo base_url('gioi-thieu.html')?>">
                                Về chúng tôi .
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('tin-tuc.html')?>">
                                Chương trình khuyến mãi.
                            </a>
                        </li>
                        
                    </ul>
                </div>
                <div class="footer-box col-md-3 col-sm-12 col-xs-12">
                    <div class="item">
                        <h3>
                            <span>Liên hệ hợp tác.</span>
                        </h3>
                    </div>
                    <ul>
                        <li>
                            <a href="<?php echo base_url('lien-he.html')?>">
                                Dành cho doanh nghiệp
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('lien-he.html')?>">
                                Liên hệ
                            </a>
                        </li>
                        <!-- <li>
                            <a href="<?php echo base_url('tin-tuc.html')?>">
                                Tuyển  dụng
                            </a>
                        </li> -->
                    </ul>
                </div>
                <div class="footer-box box-address col-md-3 col-sm-12 col-xs-12">
                    <div class="item">
                        <h3>
                            Thông tin công ty
                        </h3>


                        <div class="box-address-content">

                        <?php
                            if($this->session->flashdata('list_info'))
                            {
                                $phone = $this->session->flashdata('list_info');
                                foreach ($phone as $key => $value)
                                {

                            }
                            
                         ?>
                            <b><?php echo $value ->name; ?></b>
                            <p><i class="fa fa-map-marker"></i> <?php echo $value ->address; ?> </p>
                            <p>
                                <i class="fa fa-envelope"><?php echo $value ->email; ?></i>
                                <a href=""></a>
                            </p>
                            <p>
                                <i class="fa fa-phone"></i>
                                Phone: <?php echo $value ->phone; ?>
                            </p>

                        <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="footer-box box-social col-md-3 col-sm-12 col-xs-12">
                    <div class="item">
                        <h3>
                            Facebook
                        </h3>
                        <div class="fb-like-box" data-href="https://www.facebook.com/hoanghung.nguyen.10485" data-width="289"
                             data-height="190" data-colorscheme="dark" data-show-faces="true" data-header="false"
                             data-stream="false" data-show-border="false">
                        </div>
                        <div class="social-icon">
                            <ul>
                                <li><a href="https://plus.google.com/u/0/109667926466808755180" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://www.facebook.com/hoanghung.nguyen.10485" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UCucb2a5Tlknc1QtN0V2ZkWw?view_as=subscriber" target="_blank"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="" target="_blank"><i class="fa fa-twitter "></i></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="footer-box box-letter col-md-3 col-sm-12 col-xs-12 hide">
                    <div class="item">
                        <h3>
                            Đăng ký nhận tin
                        </h3>
                        <div class="letter-title">
                            <span>Hộp thư</span><i class="icon-title"></i>
                        </div>
                        <div class="letter-content">
                            <div class="new-paper">
                                <div class="input-box">
                                    <input type="text" name="email" id="txtNewsletter" class="input-text form-control" value="" placeholder="Your Emain Address" />
                                </div>
                                <div class="button text-center">
                                    <a class="btn btn-primary">Nhận tin</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>