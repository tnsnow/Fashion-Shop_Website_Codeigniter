<?php $this->load->view('backend/catalog/head',$this->data); ?>

<div class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>Danh sách danh mục sản phẩm</h6>
            <div class="num f12">Tổng số: <?php  echo $total ?> <b></b></div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead class="filter"><tr><td colspan="10">
                    <form method="get" action="" class="list_filter form">
                        <table width="100%" cellspacing="0" cellpadding="0"><tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input type="text" style="width:55px;" id="filter_id" value=" <?php echo $this->input->get('id') ?>" name="id"></td>

                                <td style="width:40px;" class="label"><label for="filter_id">Tên</label></td>
                                <td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_iname" value="<?php echo $this->input->get('name') ?>" name="name"></td>



                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url("catalog") ?>'; " value="Reset" class="basic">
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </form>
                </td>
            </tr>
        </thead>

            <thead>
            <thead>
            <tr>
                <td style="width:10px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png" /></td>
                <td style="width:80px;">Mã số</td>
                <td style="width:80px;">Thứ tự hiển thị</td>
                <td>Tên Danh Mục</td>
                <td>Danh mục cha</td>
                <td>Trạng thái</td>
                <td style="width:100px;">Hành động</td>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <td colspan="7">
                    <div class="list_actions itemActions">
                        <a href="#submit" id="submit" class="button blueB" url="<?php admin_url('catalog/deleteAll/deleteAll') ?>">
                            <span style='color:white;'>Xóa hết</span>
                        </a>
                    </div>

                    <div class='pagination'>
                    </div>
                </td>
            </tr>
            </tfoot>

            <tbody>
            <!-- Filter -->
            <?php
            $stt = 0;
            if(isset($list) && !empty($list))
            {
                foreach($list as $item) {
                    $stt = $stt + 1;
                    ?>

                    <tr class="row_<?php echo $item -> id; ?>">
                        <td><input type="checkbox" name="id[]" value="<?php echo $item -> id; ?>"/></td>

                        <td class="textC"><?php echo $item -> id; ?>  </td>
                        <td>
                        <span title="" class="tipS">
							<?php echo $item->sort_order; ?>
                        </span>
                        </td>
                        <td>
                        <span title="" class="tipS">
							<?php echo $item->name; ?>
                        </span>
                        </td>
                        <td>
                            <span title="" class="tipS">
                                <?php 
                                    if(!empty($item->list_parent))
                                    {
                                        foreach($item->list_parent as $val)
                                        {
                                            echo $val->name;
                                        }
                                    }else{
                                        echo "Danh mục cha";
                                    }
                                ?>
                            </span>
                        </td>
                        <td class="option">
                            <?php if($item->status == 0): ?>

                            <img class='status'  src="<?php echo public_url('admin') ?>/images/icons/color/accept.png">

                            <?php elseif($item->status == 1): ?>

                            <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png">

                            <?php endif; ?>

                        </td>
                        <td class="option">

                            <!-- <a title="Xem chi tiết sản phẩm" class="tipS" target="_blank" href="<?php //echo admin_url('transaction/order/'. $item->id) ?>">
                                <img src="<?php //echo public_url('admin')?>/images/icons/color/view.png">
                            </a> -->
                            <a href="<?php echo admin_url('catalog/edit/' . $item->id) ?>" title="Chỉnh sửa"
                               class="tipS ">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png"/>
                            </a>

                            <a href="<?php echo admin_url('catalog/delete/' . $item->id) ?>" title="Xóa"
                               class="tipS verify_action">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png"/>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }else
            {
                $this->session->set_flashdata('message','Không tồn tại danh mục sản phẩm !');
            }
            ?>

            </tbody>
        </table>

    </div>
</div>
<div class="clear mt30"></div>

