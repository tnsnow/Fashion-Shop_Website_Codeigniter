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
                        <li class="icon-li"><strong>Tin tức</strong> </li>
                    </ul>
                </div>
                <div class="news-content">
                    <h1 class="title"><span>Tin tức</span></h1>
                    <?php if (!empty($news)): ?>
                    <?php foreach ($news as $item): ?>
                    <div class="news-block clearfix">
                        <div class="news-item clearfix">
                            <div class="col-md-3 col-sm-4 col-xs-12 image">
                                <a href="<?php echo base_url('news/view/'.$item->id).'/'.safe_title($item->title).'.html'; ?>">
                                <img src="<?php echo base_url(); ?>upload/news/<?php echo $item->image_link ?>" class="img-responsive" alt="<?php echo $item->title ?>" /></a>
                            </div>
                            <div class="col-md-9 col-sm-8 col-xs-12 news-info ">
                                <h2 class="name"><a href="<?php echo base_url('news/view/'.$item->id).'/'.safe_title($item->title).'.html'; ?>"><?php echo $item->title ?></a></h2>
                                <p class="date"><?php echo  $item->created ?></p>
                                <div class="desc">
                                    <p><?php echo $item->intro."..."  ?></p>
                                </div>
                                <div class="right" style="float: right;">
                                    <a href="<?php echo base_url('news/view/'.$item->id).'/'.safe_title($item->title).'.html';  ?>">Xem tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php  endforeach;?>
                    <div class="navigation">
                        <ul class="pagination">
                            <?php
                                echo $this->pagination->create_links();
                                ?>
                        </ul>
                    </div>
                    <?php else: ?>
                    <h1>
                        Không có bài viết nào
                    </h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    if($this->session->flashdata('error'))
    {
        echo '<script charset="utf-8"> alert("'.$this->session->flashdata('error').'")</script>';
        $this->session->unset_userdata('error');
    }
    ?>