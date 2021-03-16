<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($catalog_lists as $catalog): ?>
                <section class="product-content clearfix">
                    <h1 class="title clearfix"><span><?php echo $catalog->name  ?></span></h1>
                    <nav class="navbar navbar-default product-filter">
                        <ul class="display">
                            <li id="grid" class="active grid"><a href="#" title="Grid"><i class="fa fa-th-large"></i></a></li>
                            <li id="list" class="list"><a href="#" title="List"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                        <div class="limit">
                            <span>Sản phẩm/trang</span>
                            <select id="lblimit" name="lblimit" class="nb_item" onchange="window.location.href = this.options[this.selectedIndex].value">
                                <?php for ($i = 4; $i <= 12 ;  $i = $i+4 ): ?>
                                <option <?php echo $numbers==$i? 'selected':'' ?> value="?limits=<?php echo $i ?>&cta=<?php echo $catalog->id ?>"><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </nav>
                    <div class="product-block product-grid row clearfix">
                        <?php if(!empty($catalog->subs)): ?>
                        <?php foreach ($catalog->subs as $items ): ?>
                        <?php foreach ($items->subPro as $item): ?>
                        <div class="col-md-3 col-sm-3 col-xs-12 product-resize product-item-box">
                            <div class="product-item">
                                <div class="image image-resize">
                                    <a href="<?php echo base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'; ?>" title="<?php echo $item->name ?>">
                                    <img src="<?php echo base_url(); ?>upload/shop151/images/product/<?php echo $item->image_link ?>" class="img-responsive" />
                                    </a>
                                    <a class="hover-image" href="<?php echo base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'; ?>">
                                    <img src="<?php echo base_url(); ?>upload/shop151/images/product/<?php echo $item->image_link ?>" class="img-responsive" />
                                    </a>
                                    <div class="view-more clearfix">
                                        <a href="<?php echo base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'; ?>" class="btn-quickview">Xem thêm</a>
                                    </div>
                                    <?php 
                                        $now = getdate(); 
                                        $currentDate = $now["mon"]; 
                                        $string = $item->created;
                                        $mon = substr($string ,3,2);
                                        $mon = (int)$mon;
                                        $dates = $currentDate - $mon;
                                        // if(0 <= $dates && $dates < 2)
                                        // {
                                        //     if(10 < $item->buyed)
                                        //     {
                                        //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/hot-icon.gif " width="50"></span>';
                                        //     }else
                                        //     {
                                        //         echo '<span class="promotions"> <img src="'. base_url() .'upload/shop151/images/Temp.png " width="50"></span>';
                                        //     }
                                            
                                        // }
                                        ?>
                                    <span class="promotion">-<?php echo $item ->discount ?>%</span>
                                </div>
                                <div class="right-block">
                                    <h2 class="name">
                                        <a href="<?php echo base_url('product/view/'.$item->id).'/'.safe_title($item->name).'.html'; ?>" title="<?php echo $item->name ?>"><?php echo $item->name ?></a>
                                    </h2>
                                    <!--  <div class="ratings clearfix">
                                        <div class="rating-box">
                                            <div class="rating">
                                            </div>
                                        </div>
                                        </div> -->
                                    <div class="price">
                                        <?php  if( $item ->discount  > 0):?>
                                        <?php $price_new = ($item->price*(100-$item->discount))/100; ?>
                                        <span class="price-new"> <?php echo number_format($price_new).'&nbsp;₫' ?></span>
                                        <span class="price-old"> <?php  echo number_format($item->price); ?>&nbsp;₫</span>
                                        <?php elseif( $item ->discount == 0): ?>
                                        <span class="price-new"> <?php echo number_format($item->price).'&nbsp;₫' ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="box-inner clearfix">
                                        <ul class="add-to-links">
                                            <li> <a class="add-cart" href="<?php echo base_url('cart/add/'.$item->id) ?> data-id="<?php echo $item->id ?>"></a></li>
                                            <!-- <li><a class="add-wishlist" href="#"></a></li>
                                                <li><a class="add-compare" href="#"></a></li> -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <h1>Không có  sản phẩm nào !</h1>
                        <?php endif; ?>
                    </div>
                </section>
                <?php endforeach; ?>
                <!--Template End-->
            </div>
        </div>
    </div>
</div>