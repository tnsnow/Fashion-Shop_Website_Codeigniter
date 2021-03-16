<?php $this->load->view('backend/image/head',$this->data); ?>
<div class="line"></div>

<div id="main_product" class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách ảnh bài viết
            </h6>
            <div class="num f12">Số lượng: <b> <?php echo $total_row ?> </b></div>
        </div>

        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">

            <thead class="filter"><tr><td colspan="15">
                    <form method="get" action="" class="list_filter form">
                        <table width="80%" cellspacing="0" cellpadding="0"><tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input type="text" style="width:55px;" id="filter_id" value=" <?php echo $this->input->get('id') ?>" name="id"></td>

                                <td style="width:40px;" class="label"><label for="filter_id">Tiêu Đề</label></td>
                                <td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_title" value="<?php echo $this->input->get('title') ?>" name="title"></td>

                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url("news") ?>'; " value="Reset" class="basic">
                                </td>

                            </tr>
                            </tbody></table>
                    </form>
                </td></tr></thead>

            <thead>
            <tr>
                <td style="width:21px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png"></td>
                <td style="width:60px;">Mã số</td>
                <td>Ảnh</td>
                <td>Tên ảnh</td>
                <td>Link</td>
                <td style="width:75px;">Ngày tạo</td>
                <td style="width:120px;">Hành động</td>
            </tr>
            </thead>

            <tfoot class="auto_check_pages">
            <tr>
                <td colspan="15">
                    <div class="list_action_image itemActions">
                        <a url="<?php admin_url('image/deleteAll') ?>" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Xóa hết</span>
                        </a>
                    </div>

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
                    <td><input type="checkbox" value="<?php echo $item -> id; ?>" name="id[]"></td>

                    <td class="textC"><?php echo $item -> id; ?></td>

                    <td>
                        <div class="image_thumb">
                            <img height="50" src="<?php echo $item ->link; ?>">
                            <div class="clear"></div>
                        </div>

                    </td>
                    <td >
                        <a target="_blank" title="" class="tipS" href="">
                        <b><?php echo $item->name ?> </b>
                        </a>
                    </td>
                    <td>
                        <a target="_blank" title="" class="tipS" href="">
                        <b><?php echo $item->link ?> </b>
                        </a>
                    </td>
                    
                    
                    <td class="textC"> <?php echo  $item->created_at; ?></td>

                    <td class="option textC">

                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('image/delete/'. $item->id) ?>">
                            <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>

</div>
