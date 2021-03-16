<div class="col-md-3">

    <div class="menu-news">
        <h3>
            <span>
                Tin tức
            </span>
        </h3>
        <ul class='level0'>
        <?php if($this->session->flashdata('list_categorynew')): ?>
            <?php $list_categorynew = $this->session->flashdata('list_categorynew');  ?> 
                <?php foreach($list_categorynew as $val): ?>
                <li><a href='<?php echo base_url('news/listNewCate/'.$val->id).'/'.safe_title($val->name).'.html'; ?>'><i class='fa fa-arrow-circle-o-right'></i> <?php echo $val->name ?></a></li>
                <?php endforeach ?>
        <?php endif; ?>
        </ul class='level0'>
    </div>

    <div class="box-news">
        <h3>
        <span>
            Tin tức nổi bật
        </span>
        </h3>
        <div class="news-content">
           <div class=" news-block clearfix">
                <?php if($this->session->flashdata('list_new_host')):?>
                    <?php $list_new_host = $this->session->flashdata('list_new_host') ?>
                    <?php foreach($list_new_host as $val): ?>
                       <div class="news-item clearfix">
                           <div class="col-md-4 col-sm-4 col-xs-4 image">
                              <a href="<?php echo base_url('news/view/'.$val->id).'/'.safe_title($val->title).'.html'; ?>">
                                <img class="img-responsive" src="<?php echo base_url(); ?>upload/news/<?php echo $val->image_link ?>" alt="<?php echo $val->title ?>" title="<?php echo $val->title ?>">
                              </a>
                           </div>
                           <div class="col-md-8 col-sm-8 col-xs-8 news-info ">
                              <h2 class="name"><a href="<?php echo base_url('news/view/'.$val->id).'/'.safe_title($val->title).'.html'; ?>"><?php echo $val->title ?></a></h2>
                           </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>