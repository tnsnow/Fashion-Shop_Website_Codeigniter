<?php $this->load->view('backend/admin/head',$this->data) ?>
<div class="line"></div>
<div class="wrapper">
    <div class="widget">
        <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title">
                        <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/add.png">
                        <h6>Chỉnh sửa thông tin </h6>
                    </div>
                    
                    <div class="tab_container">
                        <div class="tab_content pd0" id="tab1">
                            <div class="formRow">
                                <label for="param_username" class="formLeft">Tên đăng nhập:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_username" value="<?php echo $info->username; ?>" name="username"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('username') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_name" class="formLeft">Họ và tên:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_hoten" value ="<?php echo $info->name; ?>" name="name"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('name') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_email" class="formLeft">Email:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_email" value="<?php echo $info->email; ?>" name="email"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"><?php echo form_error('email') ?> </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_password" class="formLeft">Mật Khẩu:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="password" _autocheck="true" id="param_password"  name="password"></span>
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

                            <div class="formRow">
                                <label for="param_parent_id" class="formLeft">Chọn quyền :<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo">
                                        <select _autocheck="true" id="param_parent_id" name="roles">
                                            <option value="">Mời bạn chọn quyền</option>
                                            <option <?php echo $info->roles == 1 ? "selected" :""?> value="1">Quyền quản trị</option>
                                            <option <?php echo $info->roles == 2 ? "selected" :""?> value="2">Quyền quản lý</option>
                                            <option <?php echo $info->roles == 0 ? "selected" :""?> value="0">Nhân viên</option>
                                            
                                        </select>
                                    </span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('roles') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>


                            <div class="formRow">
                                <label for="param_sort_order" class="formLeft">Trạng thái :<span class="req"></span></label>
                                <div class="formRight">
                                    <span class="oneTwo">
                                        <label class="radio-inline">
                                            <input <?php echo $info->status == 0 ? "checked" :""?> name="rdoStatus" value="0"  type="radio">Đang làm việc 
                                        </label>
                                        <label class="radio-inline">
                                            <input <?php echo $info->status == 1 ? "checked" :""?> name="rdoStatus" value="1" type="radio">Nghỉ
                                        </label>
                                    </span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('icon') ?></div>
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