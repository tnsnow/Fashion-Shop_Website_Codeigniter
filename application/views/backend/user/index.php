<?php $this->load->view('backend/user/head',$this->data); ?>
<div class="line"></div>

<div class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>Danh sách thành viên</h6>
            <div class="num f12">Tổng số: <?php  echo $total ?></div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
            <thead>
            <tr>
                <td style="width:10px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png" /></td>
                <td style="width:80px;">Mã số</td>
                <td>Tên Đăng Nhập</td>
                <td>Tên Thật </td>
                <td>Email</td>
                <td>Phone</td>
                <td>Address</td>
                <td style="width:100px;">Hành động</td>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <td colspan="10">
                    <div class="list_send itemActions">
                        <a href="#submit" id="submit" class="button blueB" >
                            <span style='color:white;'>Chọn Email</span>
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
            foreach($list as $item)
            {
                $stt = $stt +1;
                ?>

                <tr>
                    <td><input type="checkbox" value="<?php echo $item ->email; ?>" name="email[]" value="19" /></td>

                    <td class="textC"><?php echo $stt; ?>  </td>

                    <td>
                        <span title="" class="tipS">
							<?php echo $item->name; ?>
                        </span>
                    </td>
                    <td>
                        <span title="" class="tipS">
							<?php echo $item->user_name; ?>
                        </span>
                    </td>


                    <td>
                        <span title="<?php echo $item->email; ?>" class="tipS">
							<?php echo $item->email; ?>
                        </span>
                    </td>
                    <td>
                        <span title="<?php echo $item->phone; ?>" class="tipS">
							<?php echo $item->phone; ?>
                        </span>
                    </td>
                    <td>
                        <span title="<?php echo $item->address; ?>" class="tipS">
							<?php echo $item->address; ?>
                        </span>
                    </td>
                    <td class="option">
                        <a href="<?php echo admin_url('user/delete/'.$item->id) ?>" title="Xóa" class="tipS verify_action" >
                            <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png" />
                        </a>
                    </td>
                </tr>
                <?php
            }
            ?>

            </tbody>
        </table>

    </div>
</div>
<div class="clear mt30"></div>
