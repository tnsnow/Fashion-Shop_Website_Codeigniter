<div class="main">
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                     <?php if(!empty($catalog_sub)): ?>
                    <div class="menu-product">
                        <h3>
                            <span class="uppercase">
                                <?php echo $catalog ->name ?>
                            </span>
                        </h3>
                        <ul class='level0'>
                            <?php foreach ($catalog_sub as $item): ?>
                                <?php $name = safe_title($item->name); ?>
                                <?php $name = strtolower($name); ?>
                                <li><span><a href="<?php echo base_url($name.'-c'.$item->id);?>"><i class='fa fa-check'></i><?php  echo $item->name ?></a></span></li>
                            <?php endforeach; ?>
                        </ul class='level0'>
                    </div>
                    <?php endif; ?>

                    <div class="menu-product">
                        <h3>
                            <span class="uppercase">
                                Tìm Kiếm Theo Giá
                            </span>
                        </h3>
                        <ul class='level0'>
                            <?php ?>
                                <li><span><a class="seach_price" from="0" to="1000000" cata_id = "<?php echo $catalog ->id ?> "><i class='fa fa-check'></i>Dưới 1.000.000</a></span></li>
                                <li><span><a class="seach_price" from="1000000" to="2000000" cata_id = "<?php echo $catalog ->id ?> "><i class='fa fa-check'></i>Từ 1.000.000 đến 2.000.000 </a></span></li>
                                <li><span><a class="seach_price" from="2000000" to="3000000" cata_id = "<?php echo $catalog ->id ?> " ><i class='fa fa-check'></i>Từ 2.000.000 đến 3.000.000</a></span></li>
                                <li><span><a class="seach_price" from="3000000" to="4000000" cata_id = "<?php echo $catalog ->id ?> " ><i class='fa fa-check'></i>Từ 3.000.000 đến 4.000.000</a></span></li>
                                <li><span><a class="seach_price" from="4000000" to="5000000" cata_id = "<?php echo $catalog ->id ?> " ><i class='fa fa-check'></i>Từ 4.000.000 đến 5.000.000</a></span></li>
                                <li><span><a class="seach_price" from="5000000" to="6000000" cata_id = "<?php echo $catalog ->id ?> " ><i class='fa fa-check'></i>Từ 5.000.000 đến 6.000.000</a></span></li>
                                <li><span><a class="seach_price" from="6000000" to="7000000" cata_id = "<?php echo $catalog ->id ?> " ><i class='fa fa-check'></i>Từ 6.000.000 đến 7.000.000</a></span></li>
                                <li><span><a class="seach_price" from="7000000" to="8000000" cata_id = "<?php echo $catalog ->id ?> "><i class='fa fa-check'></i>Từ 7.000.000 đến 8.000.000</a></span></li>
                                <li><span><a class="seach_price" from="8000000" to="9000000" cata_id = "<?php echo $catalog ->id ?> "><i class='fa fa-check'></i>Từ 8.000.000 đến 9.000.000</a></span></li>
                                <li><span><a class="seach_price" from="9000000" to="10000000" cata_id = "<?php echo $catalog ->id ?> "><i class='fa fa-check'></i>Từ 9.000.000 đến 10.000.000</a></span></li>
                                <li><span><a class="seach_price" from="10000000" to="100000000" cata_id = "<?php echo $catalog ->id ?> "><i class='fa fa-check'></i>Trên 10.000.000</a></span></li>
                            <?php ?>
                        </ul class='level0'>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('.menu-product li.child .open-close').on('click', function () {
                                $(this).removeAttr('href');
                                var element = $(this).parent('li');
                                if (element.hasClass('open')) {
                                    element.removeClass('open');
                                    element.children('ul').slideUp();
                                }
                                else {
                                    element.addClass('open');
                                    element.children('ul').slideDown();
                                }
                            });
                        });
                    </script>
                </div>
            

            <div class="col-md-9">
                <div class="breadcrumb clearfix">
                    <ul>
                        <li itemtype="" itemscope="" class="home">
                            <a title="Đến trang chủ" href="<?php echo base_url() ?>" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                        </li>
                        <li itemtype="" itemscope="" class="category17 icon-li">
                            <div class="link-site-more">
                                <?php $name = safe_title($catalog->name); ?>
                                <?php $name = strtolower($name); ?>
                                <a title="" href="<?php echo base_url($name.'-c'.$catalog->id); ?>" itemprop="url">
                                    <span itemprop="title"><?php echo $catalog ->name ?></span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <script type="text/javascript">
                    $(".link-site-more").hover(function () { $(this).find(".s-c-n").show(); }, function () { $(this).find(".s-c-n").hide(); });
                </script>

                <section class="product-content clearfix">
                    <h1 class="title clearfix"><span><?php echo $catalog ->name ?> ( Có <?php echo $total_row ?> sản phẩm)</span>
                        <div class=" col-sm-3 col-md-3 form-group " style="float: right; padding-top: 10px;">
                            
                                <select class="form-control" name="arrange" id = "arrange" cata_id = "<?php echo $catalog ->id ?>">
                                    <option value="az" <?= $sort == 'az' ? "selected = 'selected'" : '' ?> >Sắp xếp A > Z</option>
                                    <option value="za" <?= $sort == 'za' ? "selected = 'selected'" : '' ?> >Sắp xếp Z > A</option>
                                    <option value="tc" <?= $sort == 'tc' ? "selected = 'selected'" : '' ?> >Giá từ thấp đến cao</option>
                                    <option value="ct" <?= $sort == 'ct' ? "selected = 'selected'" : '' ?> >Giá từ cao đến thấp</option>
                                </select>
                            <div class="clear error" name="name_error"> </div>
                           
                        </div>
                    </h1>
                    
                    <div class="product-block product-grid row clearfix" id="catalog">
                        <?php foreach ($list  as $item ): ?>
                            <?php $name = safe_title($item->name); ?>
                            <?php $name = strtolower($name); ?>
                            <div class="col-md-3 col-sm-3 col-xs-12 product-resize product-item-box">
                                <div class="product-item">
                                    <div class="image image-resize">
                                        <a href="<?php echo base_url($name.'-sp'.$item->id); ?>" title="<?php echo $item->name ?>">
                                            <img src="<?php echo base_url(); ?>upload/shop151/images/product/<?php echo $item->image_link ?>" class="img-responsive" />
                                        </a>
                                        <a class="hover-image" href="<?php echo base_url($name.'-sp'.$item->id); ?>">
                                            <img src="<?php echo base_url(); ?>upload/shop151/images/product/<?php echo $item->image_link ?>" class="img-responsive" />
                                        </a>
                                        <div class="view-more clearfix">
                                            <a href="<?php echo base_url($name.'-sp'.$item->id); ?>" class="btn-quickview">Xem thêm</a>
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
                                            <a href="<?php echo base_url($name.'-sp'.$item->id); ?>" title="<?php echo $item->name ?>"><?php echo $item->name ?></a>
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
                                                <?php $name ="them-vao-gio-hang"; ?> 
                                                <li> <a class="add-cart" href="<?php echo base_url($name.'-gh'.$item->id); ?>" onclick="AddToCard(3329,1)" data-id="<?php echo $item->id ?>"></a></li>
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

