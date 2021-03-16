<?php $this->load->view('backend/supplier/head',$this->data); ?>

<div class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>Danh sách danh mục sản phẩm</h6>
            <div class="num f12">Tổng số: <?php  echo $total_row ?> <b></b></div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">

            <thead class="filter"><tr><td colspan="15">
                <form method="get" action="" class="list_filter form">
                    <table width="80%" cellspacing="0" cellpadding="0">
                        <tbody>

                            <tr>
                                
                                <td style="width:40px;" class="label"><label for="filter_id">Tên nhà cung cấp </label></td>
                                <td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_title" value="<?php echo $this->input->get('name') ?>" name="name"></td>

                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url("supplier") ?>'; " value="Reset" class="basic">
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </form>
            </thead>

            <thead>
            <thead>
            <tr>
            
                <td style="width:80px;">STT</td>
                <td style="width:80px;">Tên nhà cung cấp</td>
                <td>ĐỊa chỉ</td>
                <td>Email</td>
                <td>Số điện thoại</td>
                <td>Trạng thái</td>
                <td style="width:100px;">Hành động</td>
            </tr>
            </thead>


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

                        <td class="textC"><?php echo $stt; ?>  </td>
                        <td>
                        <span title="" class="tipS">
							<?php echo $item->name; ?>
                        </span>
                        </td>
                        <td>
                        <span title="" class="tipS">
							<?php echo $item->address; ?>
                        </span>
                        </td>
                        <td>
                        <span title="" class="tipS">
                            <?php echo $item->email; ?>
                        </span>
                        </td>
                        <td>
                            <span title="" class="tipS">
                                    <?php echo $item->phone; ?>
                            </span>
                        </td>
                        <td class="option">
                            <?php if($item->status == 0): ?>
                                <p>Đang cung cấp</p>
                            <?php elseif($item->status == 1): ?>
                                <p>Chưa cung cấp</p>
                            <?php endif; ?>

                        </td>
                        <td class="option">
                            <a href="<?php echo admin_url('supplier/edit/' . $item->id) ?>" title="Chỉnh sửa"
                               class="tipS ">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png"/>
                            </a>

                            <a href="<?php echo admin_url('supplier/delete/' . $item->id) ?>" title="Xóa"
                               class="tipS verify_action">
                                <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png"/>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }else
            {
                $this->session->set_flashdata('message','Không tồn tại nhà cung cấp nào trong cơ sở dữ liệu !');
            }
            ?>

            </tbody>
        </table>

    </div>
</div>
<div class="clear mt30"></div>

