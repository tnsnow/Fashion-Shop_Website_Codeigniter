<?php $this->load->view('backend/account/head',$this->data); ?>
<div class="line"></div>

<div class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <div class="tab_container">
            <div class="formRow">
                <label for="param_username" class="formLeft">Tên đăng nhập:</label>
                <div class="formRight">
                    <span class="oneTwo">
                        <?php echo $user->username ?>
                    </span>
                    <span class="autocheck" name="name_autocheck"></span>
                    
                </div>
                <div class="clear"></div>

                <label for="param_username" class="formLeft">Họ và Tên:</label>
                <div class="formRight">
                    <span class="oneTwo">
                        <?php echo $user->name ?>
                    </span>
                    <span class="autocheck" name="name_autocheck"></span>
                    
                </div>
                <div class="clear"></div>

                <label for="param_username" class="formLeft">Email:</label>
                <div class="formRight">
                    <span class="oneTwo">
                        <?php echo $user->email ?>
                    </span>
                    <span class="autocheck" name="name_autocheck"></span>
                    
                </div>
                <div class="clear"></div>

                <label for="param_username" class="formLeft">Trạng thái:</label>
                <div class="formRight">
                    <span class="oneTwo">
                        <?php 
                            if($user->status == 0){
                                echo "Đang làm việc";
                            }else{
                                echo "Nghỉ việc";
                            }
                        ?>
                    </span>
                    <span class="autocheck" name="name_autocheck"></span>
                    
                </div>
                <div class="clear"></div>

                <label for="param_username" class="formLeft">Chức vụ:</label>
                <div class="formRight">
                    <span class="oneTwo">
                        <?php
                                switch ($user ->roles) {
                                    case '0':
                                        # code...
                                        echo "Nhân viên";
                                        break;

                                    case '1':
                                        # code...
                                        echo "Quản trị viên";
                                        break;

                                    case '2':
                                        # code...
                                        echo "Quản lý";
                                        break;
                                    
                                    default:
                                        # code...
                                        #
                                        break;
                                }
                            ?>
                    </span>
                    <span class="autocheck" name="name_autocheck"></span>
                    
                </div>
                <div class="clear"></div>
            </div>
        </div>            
        
    </div>
</div>
<div class="clear mt30"></div>
