<div class="wrapper">
    <div class="main">
        <div class="container">
            <div class="row">
                <?php $this->load->view('fontend/news/left_new'); ?>
                <div class="col-md-9">

                    <div class="breadcrumb clearfix">
                        <ul>
                            <li itemtype="" itemscope="" class="home">
                                <a title="Đến trang chủ" href="<?php echo base_url() ?>" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                            </li>
                            <li itemtype="" itemscope="" class="icon-li">
                                <a title="Tin tức" href="<?php echo base_url('news')?>" itemprop="url"><span itemprop="title">Tin tức</span></a>
                            </li>
                            <?php if(isset($name_cate) && !empty($name_cate)): ?>
                            <li itemtype="" itemscope="" class="icon-li">
                                <a title="<?php echo $name_cate->name ?>" href="<?php echo base_url('news/listNewCate/'.$name_cate->id).'/'.safe_title($name_cate->name).'.html';?>" itemprop="url"><span itemprop="title"><?php echo $name_cate->name ?></span></a>
                            </li>
                            <?php endif; ?> 
                            
                        </ul>
                    </div>
                    <script type="text/javascript">
                        $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                    </script>

                    <div class="news-detail">
                        <div class="news-block">
                            <h1><?php echo $new->title ?></h1>
                            <div class="date"><p class="date"><?php echo  $new->created ?></p></div>
                            <p class="date"><?php echo "Lượt xem :".$new->count_view ?></p>
                            <div class="content">
                                <?php echo $new->content ?>
                            </div>
                            <div class="social-group">
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style">
                                    <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>


                                    <a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
                                    <a class="addthis_counter addthis_pill_style addthis_nonzero"></a>
                                </div>
                                <!-- AddThis Button END -->      
                            </div>
                        </div>
                        <div class="news-other">
                            <h3><span>Tin tức liên quan</span></h3>
                            <ul>
                                <?php if(isset($list)): ?>
                                    <?php foreach($list as $val): ?>
                                        <li><a href="<?php echo base_url('news/view/'.$val->id).'/'.safe_title($val->title).'.html'; ?>"><?php echo $val ->title?></a></li>
                                    <?php endforeach ?>
                                <?php endif; ?>

                            </ul>
                        </div>


                    <div class="usual" id="usual1">
                        <ul>
                            <li><a title="Chi tiết sản phẩm" rel='tab2' href='javascript:void(0)' class="tab selected">Để lại bình luận</a></li>
                            
                        </ul>
                    </div>
                    <div class="usual-content">
                        <div id="tab2" style="display: block;">
                            <!-- comment facebook -->
                            <center>
                                <div id="fb-root"></div>
                                <script src="http://connect.facebook.net/en_US/all.js#appId=170796359666689&amp;xfbml=1"></script>
                                <div class="fb-comments" data-href="<?php echo current_url();  ?>" data-num-posts="5" data-width="550" data-colorscheme="light"></div>
                            </center>
                        </div>
                        <div id="tab3" style="display: none;">
                            <!-- the div chay video -->
                            <div id='mediaspace' style="margin:5px;"></div>
                        </div>
                        <div id="tab4" style="display: none;">
                            <div class='box-show-product'>
                                <!-- hiển thị danh sách comment và form comment -->
                                
                                <div class='clear'></div>
                                <style>
                                    .error{
                                    margin:15px 0px;
                                    }
                                </style>
                                <form name='send_comment' id='show_box_comment' class="t-form form_action" method='post' action=''>
                                    <table width="90%" cellspacing="0" cellpadding="0" border="0" style="margin:10px auto">
                                        <tbody>
                                            <tr>
                                                <td style='width:210px;padding-right:15px;vertical-align:top'>
                                                    <input type="text" style="width:200px;" class='input' id="user_name" placeholder="Họ tên" value='' name="user_name">
                                                    <div name="user_name_error" class="error"></div>
                                                    <input type="text" style="width:200px;" id="user_email" class='input' placeholder="Email" value='' name="user_email">
                                                    <div name="user_email_error" class="error"></div>
                                                    <img id="imgsecuri"  src="" style="margin-bottom: -6px;" _captcha="" class="imgrefresh" >
                                                    <input type="text"  class='input'   style="width:80px;" id="security_code" placeholder="Mã xác nhận" name="security_code">
                                                    <div name="security_code_error" class="error"></div>
                                                </td>
                                                <td>
                                                    <textarea id="content_comment" cols="50" rows="3" style='width:320px' class='input' placeholder='Nội dung phản hồi' name="content">
                                                    </textarea>
                                                    <div name="content_error" class="error"></div>
                                                    <input type="hidden" name='product_id' value='9'>
                                                    <input type="hidden" name='parent_id' id='comment_parent_id' value=''>
                                                    <input type="submit" class="button button-border medium blue f" id=""   value="Gửi" name="_submit">
                                                    <input type="reset" class="button button-border medium red f"  value='Nhập lại'>
                                                    <div class='clear'></div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


   

  
    <script type="text/javascript">
        $(document).ready(function () {
            $(".menu-quick-select ul").hide();
            $(".menu-quick-select").hover(function () { $(".menu-quick-select ul").show(); }, function () { $(".menu-quick-select ul").hide(); });
        });
    </script>
</div>

<div style="display: none;" id="loading-mask">
    <div id="loading_mask_loader" class="loader">
        <img alt="Loading..." src="/Images/ajax-loader-main.gif" />
        <div>
            Please wait...
        </div>
    </div>
</div>


</body>
</html>
<script type="text/javascript">
    $(".header-content").css({ "background": '' });
    $("html").addClass('');
    $(document).ready(function () {
        $("img.lazy-img").each(function () {
            $(this).attr("data-original", $(this).attr("src"));
            $(this).attr("src", "/Images/blank.gif");
        });
        $("img.lazy-img").lazyload({
            effect: "fadeIn",
            threshold: 200
        });
    });
</script>

