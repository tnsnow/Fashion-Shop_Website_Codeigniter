<html>
    <head>
        <?php $this->load->view('backend/head') ; ?>
    </head>
    <body class="nobg loginPage" style="min-height:100%;">
    <div style="top:45%;" class="loginWrapper">
          
        <div style="height:auto; margin:auto;" id="admin_login" class="widget">
            <div class="title"><img class="titleIcon" alt="" src="<?php echo public_url('admin') ?>/images/icons/dark/laptop.png">
                <h6>Lấy lại mật khẩu</h6>
            </div>

            <form method="post" action="" id="form" class="form">
            <?php echo isset($message)? '<p style="color:blue; font-weight:bold; text-align: center;">'.$message.'</p>':"" ?>
                <fieldset>
                    <div class="formRow">
                        <label for="param_username">Nhập vào email : </label>
                        <div class="loginInput"><input type="text" id="param_username" name="email" value="<?php  ?>"></div>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"> <?php echo form_error('email') ?></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <label for="param_username">Nhập vào captcha : </label>
                        <div class="loginInput"><input type="text" id="param_username" name="captcha" value="<?php  ?>"></div>
                        <span class="autocheck" name="name_autocheck"></span>
                        <div class="clear error" name="name_error"> <?php echo form_error('captcha') ?></div>
                        <div class="clear"></div>
                        
                    </div>
                    <input type="hidden" name="rcaptcha" id="re_captcha" class="show-re-captcha" value="<?php echo $captcha['word'] ?>" >
                    <div class="formRow">
                        <label for="param_password"></label>
                        <div class="loginInput">
                              <?php echo $captcha['image'] ?>
                              <a class="refresh-captcha" id="btnRefreshCapcha">
                              <i class="glyphicon glyphicon-refresh"></i>
                              </a>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="loginControl">
                       
                        <input type="hidden" value="1" name="submit">
                        <img src="<?php echo public_url('admin'); ?>/images/icons/color/logout.png" style="margin-top:7px;">
                        <a href="<?php echo admin_url() ?>" style="color: blue; font-weight: bold;"><i>Trở lại trang login</i> </a>
                        <input type="submit" class="dredB logMeIn" value="Lấy lại mật khẩu">
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php $this->load->view('backend/footer') ?>
    </body>
</html>