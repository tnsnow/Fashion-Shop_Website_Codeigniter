<?php $this->load->view('backend/supplier/head',$this->data) ?>

<div class="wrapper">
    <div class="widget">
        <form enctype="multipart/form-data" method="post" action="" id="form" class="form">
            <fieldset>
                <div class="widget">
                    <div class="title">
                        <img class="titleIcon" src="<?php echo public_url('admin') ?>/images/icons/dark/add.png">
                        <h6>Thêm mới nhà cung cấp</h6>
                    </div>
                    
                    <div class="tab_container">
                        <div class="tab_content pd0" id="tab1">
                            <div class="formRow">
                                <label for="param_name" class="formLeft">Tên nhà cung cấp :<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $supplier->name ?>" name="name"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('name') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_name" class="formLeft">Email nhà cung cấp :<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_name" value="<?php echo $supplier->email ?>" name="email"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('email') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_sort_order" class="formLeft">Số điện thoại :<span class="req"></span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_sort_order" value="<?php echo $supplier->phone ?>" name="phone"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('phone') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow">
                                <label for="param_sort_order" class="formLeft">Địa chỉ nhà cung cấp:<span class="req"></span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_icon" value="<?php echo $supplier->address ?>" name="address"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('address') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow hide"></div>
                           

                            <div class="formRow">
                                <label for="param_sort_order" class="formLeft">Fax<span class="req"></span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input type="text" _autocheck="true" id="param_icon" value="<?php echo $supplier->fax ?>" name="fax"></span>
                                    <span class="autocheck" name="name_autocheck"></span>
                                    <div class="clear error" name="name_error"> <?php echo form_error('fax') ?></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="formRow hide"></div>


                            <div class="formRow">
                                <label for="param_sort_order" class="formLeft">Trạng thái :<span class="req"></span></label>
                                <div class="formRight">
                                    <span class="oneTwo">
                                        <label class="radio-inline">
                                            <input name="rdoStatus" value="0" <?php echo ($supplier->status =0)?"checked=''":"" ?> type="radio">Đang cung cấp 
                                        </label>
                                        <label class="radio-inline">
                                            <input name="rdoStatus" value="1" <?php echo ($supplier->status =1)?"checked=''":"" ?> type="radio">Chưa cung cấp 
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
                        <input type="submit" class="redB" value="Chỉnh sửa">
                        <input type="reset" class="basic" value="Hủy bỏ">
                    </div>
                    <div class="clear"></div>
                </div>
            </fieldset>
        </form>
    </div>
</div>