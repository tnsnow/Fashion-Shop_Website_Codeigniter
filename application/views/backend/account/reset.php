<?php $this->load->view('backend/account/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title">
                        <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/add.png">
                        <h6>Thay đổi mật khẩu</h6>
                    </div>
                    <div class="tab_container">
                        <div class="tab_content pd0" id="tab1">
                            
                            <div class="formRow">
                                <label for="param_password" class="formLeft">Mật Khẩu Cũ:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="password" _autocheck="true" id="param_password" value="" name="PasswordOld"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('PasswordOld') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            
                            <div class="formRow">
                                <label for="param_password" class="formLeft">Mật Khẩu Mới:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="password" _autocheck="true" id="param_password" value="" name="Password"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('Password') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_re_password" class="formLeft"> Nhập Lại Mật Khẩu:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="password" _autocheck="true" id="param_re_password" name="RePassword"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('RePassword') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div><!-- End tab_container-->

                    <div class="formSubmit">
                        <input type="submit" class="redB" value="Thay đổi">
                        <input type="reset" class="basic" value="Hủy bỏ">
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>