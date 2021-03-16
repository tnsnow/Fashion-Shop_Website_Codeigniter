<?php $this->load->view('backend/role/head',$this->data) ?>
<div class="line"></div>

<div class="wrapper">
    <div class="widget">
        <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title">
                        <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/add.png">
                        <h6>Thêm mới quyền </h6>
                    </div>
                    <div class="tab_container">
                        <div class="tab_content pd0" id="tab1">
                            <div class="formRow">
                                <label for="param_name" class="formLeft">Tên quyền : <span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo">
                                    <input type="text" _autocheck="true" id="param_username" value="<?php echo set_value('name') ?>" name="name">
                                    </span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('name') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_name" class="formLeft">Họ và tên:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_hoten" value ="<?php echo set_value('name') ?>" name="name"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('name') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_email" class="formLeft">Email:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_email" value="<?php echo set_value('email') ?>" name="email"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('email') ?> </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_password" class="formLeft">Mật Khẩu:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="password" _autocheck="true" id="param_password" value="<?php echo set_value('password') ?>" name="password"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('password') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_re_password" class="formLeft"> Nhập Lại Mật Khẩu:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="password" _autocheck="true" id="param_re_password" name="re_password"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('re_password') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>


                         <div class="formRow hide"></div>
                        </div>
                    </div><!-- End tab_container-->

                    <div class="formSubmit">
                        <input type="submit" class="redB" value="Thêm mới">
                        <input type="reset" class="basic" value="Hủy bỏ">
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>