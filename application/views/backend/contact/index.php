<?php $this->load->view('backend/contact/head',$this->data); ?>
<div class="line"></div>

<div id="main_product" class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách thông tin liên hệ
            </h6>
        </div>

        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">

            <thead class="filter"><tr><td colspan="12">
                    <form method="get" action="" class="list_filter form">
                        <table width="80%" cellspacing="0" cellpadding="0">
                            <tbody>

                            </tbody>
                        </table>
                    </form>
                </td></tr></thead>

            <thead>
            <tr>
                <td style="width:21px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png"></td>
                <td style="width:60px;">Mã số</td>
                <td>Tiêu đề</td>
                <td>Tên người gửi</td>
                <td>Nội dung</td>
                <td>Email</td>
                <td>Địa chỉ</td>
                <td>Số điện thoại</td>
                <td>Trạng thái</td>
                <td style="width:75px;">Ngày tạo</td>
                <td style="width:120px;">Hành động</td>
            </tr>
            </thead>

            <tfoot class="auto_check_pages">
                <tr>
                <td colspan="12">
                   
                    <!-- <div class="list_send itemActions">
                        <a url="" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Chọn Mail</span>
                        </a>
                    </div> -->
                    

                    <div class="pagination">
                        <?php
                            echo $this->pagination->create_links();
                        ?>
                    </div>
                </td>
            </tr>
            </tfoot>

            <tbody class="list_item">
            <?php foreach ($list as  $item ) { ?>
                <tr class="row_<?php echo $item -> id; ?>">
                    <td><input type="checkbox" value="<?php echo $item ->email; ?>" name="email[]"></td>
                    <td class="textC"><?php echo $item -> id; ?></td>

                    <td> <b><?php echo $item->title ?> </b> </td>

                    <td> <b><?php echo $item->name ?> </b> </td>

                    <td class="textC"> <?php echo  the_excerpt($item ->content) ?></td>
                    <td> <b><?php echo $item->email ?> </b> </td>
                    <td> <b><?php echo $item->address ?> </b> </td>
                    <td> <b><?php echo $item->phone ?> </b> </td>
                    <td class="textC"> <?php
                        if ( $item->activel ==0)
                        {
                            echo " <a title='Chưa phản hồi' href=''><img src='".public_url('admin')."/images/icons/color/delete.png'> </a> ";
                        }
                        elseif( $item->activel ==1)
                        {
                           echo " <a title='Đã phản hồi' href=''><img src='".public_url('admin')."/images/icons/color/accept.png'> </a> ";
                        }
                        else
                        {
                            echo "Thanh toán thất bại";
                        }
                        ?>
                        
                    </td>
                    <td class="textC"> <?php echo $item->created ?></td>

                    <td class="option textC">
                        <a href="<?php echo admin_url('contact/replyEmail/'.$item -> id)?>" title="Trả lời"
                               class="tipS ">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png"/>
                        </a>
                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('contact/delete/'. $item->id) ?>">
                            <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>

</div>
