<?php $this->load->view('backend/admin/head',$this->data); ?>
<div class="line"></div>

<div class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">

        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>Danh sách quản trị viên</h6>
            <div class="num f12">Tổng số: <?php  echo $total ?> </div>
        </div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
                <thead>
                <tr>
                    <td style="width:80px;">Mã số</td>
                    <td>Tên Đăng Nhập</td>
                    <td>Tên Thật </td>
                    <td>Email</td>
                    <td>Quyền</td>
                    <td>Trạng thái</td>
                    <td style="width:100px;">Hành động</td>
                </tr>
                </thead>
                <tbody>
                <!-- Filter -->
                <?php $stt = 0 ?>
                <?php if(isset($list)): ?>
                <?php foreach($list as $item): ?>
                

                <tr>

                    <td class="textC"><?php echo $stt = $stt +1; ?></td>

                    <td>
                        <span title="" class="tipS">
							<?php echo $item->username; ?>
                        </span>
                    </td>
                    <td>
                        <span title="" class="tipS">
							<?php echo $item->name; ?>
                        </span>
                    </td>


                    <td>
                        <span title="<?php echo $item->email; ?>" class="tipS">
							<?php echo $item->email; ?>
                        </span>
                    </td>

                    <td>
                        <span title="" class="tipS">
                            <?php
                                switch ($item ->roles) {
                                    case '0':
                                        # code...
                                        echo "Nhân viên";
                                        break;

                                    case '1':
                                        # code...
                                        echo "Quản trị viên";
                                        break;

                                    case '2':
                                        # code...
                                        echo "Quản lý";
                                        break;
                                    
                                    default:
                                        # code...
                                        #
                                        break;
                                }
                            ?>
                        </span>
                        <td>
                            <span title="" class="tipS">
                                <?php 
                                    if($item->status == 0){
                                        echo "Đang làm việc";
                                    }else{
                                        echo "Nghỉ việc";
                                    }
                                ?>
                            </span>
                        </td>
                    </td>
                    <td class="option">
                        <a href="<?php echo admin_url('admin/edit/'.$item->id) ?>" title="Chỉnh sửa" class="tipS ">
                            <img src="<?php echo public_url('admin') ?>/images/icons/color/edit.png" />
                        </a>

                        <a href="<?php echo admin_url('admin/delete/'.$item->id) ?>" title="Xóa" class="tipS verify_action" >
                            <img src="<?php echo public_url('admin') ?>/images/icons/color/delete.png" />
                        </a>
                    </td>
                </tr>
                <?php endforeach;?>
                <?php endif;?>
                </tbody>
            </table>

    </div>
</div>
<div class="clear mt30"></div>
