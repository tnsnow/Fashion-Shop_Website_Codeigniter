<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               
                <script type="text/javascript">
                    $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                </script>

                <section class="product-content clearfix">
                    <h1 class="title clearfix"><span>Sản Phẩm</span>
                        <div class=" col-sm-3 col-md-3 form-group " style="float: right; padding-top: 10px;">
                            
                                <select class="form-control" name="arrange" id = "order_product">
                                    <option value="az" <?= $sort == 'az' ? "selected = 'selected'" : '' ?> >Sắp xếp A > Z</option>
                                    <option value="za" <?= $sort == 'za' ? "selected = 'selected'" : '' ?> >Sắp xếp Z > A</option>
                                    <option value="tc" <?= $sort == 'tc' ? "selected = 'selected'" : '' ?> >Giá từ thấp đến cao</option>
                                    <option value="ct" <?= $sort == 'ct' ? "selected = 'selected'" : '' ?> >Giá từ cao đến thấp</option>
                                </select>
                            <div class="clear error" name="name_error"> </div>
                           
                        </div>
                    </h1>
                  
                    <div class="product-block product-grid row clearfix" id ="product_list">
                        <?php foreach ($list  as $item ): ?>
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
                                        <!-- <div class="ratings clearfix">
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
                                                <li> <a class="add-cart" href="<?php echo base_url('cart/add/'.$item->id) ?>" onclick="AddToCard(3329,1)" data-id="<?php echo $item->id ?>"></a></li>
                                                <!-- <li><a class="add-wishlist" href="#"></a></li>
                                                <li><a class="add-compare" href="#"></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <div class="navigation">
                        <ul class="pagination">
                            <?php
                            echo $this->pagination->create_links();
                            ?>
                        </ul>
                    </div>
                </section>
                <!--Template--
                --End-->
            </div>
        </div>
    </div>
</div>

