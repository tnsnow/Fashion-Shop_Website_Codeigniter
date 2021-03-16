<?php $this->load->view('backend/transaction/head',$this->data); ?>
<div class="line"></div>
<div id="main_transaction" class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách các giao dịch
            </h6>
            <div class="num f12">Số lượng: <b> <?php echo $total_row ?> </b></div>
        </div>
        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
            <thead class="filter"><tr><td colspan="15">
                <form method="get" action="" class="list_filter form">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td>
                                <td class="item"><input type="text" style="width:55px;" id="filter_id" value=" <?php echo $this->input->get('id') ?>" name="id"></td>

                                <td style="width:40px;" class="label"><label for="filter_id">Tên</label></td>
                                <td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_title" value="<?php echo $this->input->get('title') ?>" name="title"></td>

                                <td style="width:60px;" class="label"><label for="filter_status">Tình trạng</label></td>
                                <td class="item">
                                    <select name="status">
                                        <option value=""></option>
                                        <option value="1">Đã thanh toán</option>
                                        <option value="2">Chưa thanh toán</option>
                                    </select>
                                </td>

                                <td style="width:60px;" class="label"><label for="filter_status">Ngày tháng</label></td>
                                <td class="item">
                                   <input type="date" style="width:155px;" id="filter_title" value="<?php echo $this->input->get('created') ?>" name="created">
                                </td>

                                <td style="width:150px">
                                    <input type="submit" value="Lọc" class="button blueB">
                                    <input type="reset" onclick="window.location.href = '<?php echo admin_url("news") ?>'; " value="Reset" class="basic">
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </form>
            </thead>
            <thead>
                <tr>
                    <td style="width:21px;"><img src="<?php echo public_url('admin') ?>/images/icons/tableArrows.png"></td>
                    <td style="width:60px;">Mã số</td>
                    <td>Tên người đặt</td>
                    <td>Email</td>
                    <td>Phone</td>
                    <td>Địa chỉ</td>
                    <td>Tổng tiền</td>
                    <td>Vận chuyển</td>
                    <td>Lưu ý </td>
                    <td>Cổng thanh toán</td>
                    <td style="width:75px;">Ngày tạo</td>
                    <td>Trang thái</td>
                    <td style="width:120px;">Hành động</td>
                </tr>
            </thead>
            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="18">
                        <div class="list_action_transaction itemActions">
                            <a url="<?php admin_url('transaction/deleteAll') ?>" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Xóa hết</span>
                            </a>
                        </div>

                       <!--  <div class="list_action_transaction itemActions">
                            <a url="<?php admin_url('transaction/deleteAll') ?>" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Xuất Excel</span>
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
                <?php //pre($list); ?>
                <?php foreach ($list as  $item ) { ?>
                <tr class="row_<?php echo $item -> id; ?>">
                    <td><input type="checkbox" value="<?php echo $item -> id; ?>" name="id[]"></td>
                    <td class="textC"><?php echo $item ->id; ?></td>
                    <td class="textC"><?php echo $item ->user_name; ?></td>
                    <td class="textC"><?php echo $item ->user_email; ?></td>
                    <td class="textC"><?php echo $item ->user_phone; ?></td>
                    <td class="textC"><?php echo $item ->address; ?></td>
                    <td class="textC"><?php echo number_format($item ->amount).'đ'; ?></td>
                    <td class="textC"><?php echo $item ->Transport; ?></td>
                    <td class="textC"><?php echo $item ->message; ?></td>
                    <td>
                        <b><?php echo $item->payment ?> </b>
                    </td>
                    <td class="textC"> <?php echo  $item->created ?></td>
                    <td class="textC"> <?php
                        if ( $item->status == 2)
                        {
                            echo " <a title='Chưa thanh toán' href=''  class='status' status ='1' id ='".$item ->id."'  ><img src='".public_url('admin')."/images/icons/color/delete.png'> </a> ";
                        }
                        elseif( $item->status == 1)
                        {
                           echo " <a title='Đã thanh toán' href='' class='status' status ='2' id ='".$item ->id."'  ><img src='".public_url('admin')."/images/icons/color/accept.png'> </a> ";
                        }
                        else
                        {
                            echo "Thanh toán thất bại";
                        }
                        ?>
                        
                    </td>

                    <td class="option textC">
                        <a title="Xem chi tiết giao dịch" class="tipS" target="_blank" href="<?php echo admin_url('transaction/order/'. $item->id) ?>">
                        <img src="<?php echo public_url('admin')?>/images/icons/color/view.png">
                        </a>
                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('transaction/delete/'. $item->id) ?>">
                        <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>