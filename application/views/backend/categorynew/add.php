<?php $this->load->view('backend/categorynew/head',$this->data) ?>
<div class="line" xmlns="http://www.w3.org/1999/html"></div>

<div class="wrapper">
    <div class="widget">
        <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title">
                        <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/add.png">
                        <h6>Thêm mới danh mục tin tức</h6>
                    </div>
                    
                    <div class="tab_container">
                        <div class="tab_content pd0" id="tab1">
                            <div class="formRow">
                                <label for="param_name" class="formLeft">Tên danh mục :<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo set_value('name') ?>" name="name"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('name') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_sort_order" class="formLeft">Thứ tự hiển thị:<span class="req"></span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_sort_order" value="<?php echo set_value('sort_order') ?>" name="sort_order"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('sort_order') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow hide"></div>

                            <div class="formRow">
                                <label for="param_sort_order" class="formLeft">Trạng thái :<span class="req"></span></label>
                                <div class="formRight">
                                    <span class="oneTwo">
                                        <label class="radio-inline">
                                            <input name="rdoStatus" value="0" checked="" type="radio">Hiện
                                        </label>
                                        <label class="radio-inline">
                                            <input name="rdoStatus" value="1" type="radio">Ẩn
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