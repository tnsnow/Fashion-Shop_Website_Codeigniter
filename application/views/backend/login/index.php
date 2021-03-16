<html>
    <head>
        <?php $this->load->view('backend/head') ; ?>
    </head>
    <body class="nobg loginPage" style="min-height:100%;">
    <div style="top:45%;" class="loginWrapper">
          
        <div style="height:auto; margin:auto;" id="admin_login" class="widget">
            <div class="title"><img class="titleIcon" alt="" src="<?php echo public_url('admin') ?>/images/icons/dark/laptop.png">
                <h6>Đăng nhập</h6>
            </div>

            <form method="post" action="" id="form" class="form">
                <fieldset>
                    <div class="formRow">
                        <label for="param_username">Tên đăng nhập:</label>
                        <div class="loginInput"><input type="text" id="param_username" name="username" value="<?php echo isset($_COOKIE['username'])?$_COOKIE['username']:"" ?>"></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <label for="param_password">Mật khẩu:</label>
                        <div class="loginInput"><input type="password" id="param_password" name="password" value="<?php echo isset($_COOKIE['username'])?$_COOKIE['username']:"" ?>"></div>
                        <div class="clear"></div>
                    </div>

                    <div class="formRow">
                        <label for="param_password"></label>
                        <div class="loginInput">
                        <input type="checkbox" id="param_password" value="on" name="remember"><i>Remember me.</i></div>
                        <div class="clear"></div>
                    </div>

                    <div class="loginControl">
                        <ul>
                            <li style="color: red; font-weight: bold;"><?php echo form_error('login'); ?></li>

                        </ul>
                        <input type="hidden" value="1" name="submit">
                        <img src="<?php echo public_url('admin'); ?>/images/icons/color/block.png" style="margin-top:7px;">
                        <a href="<?php echo admin_url('ForgotPassword') ?>" style="color: blue; font-weight: bold;"><i>Lấy lại mật khẩu</i> </a>
                        <input type="submit" class="dredB logMeIn" value="Đăng nhập">
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <?php $this->load->view('backend/footer') ?>
    </body>
</html>