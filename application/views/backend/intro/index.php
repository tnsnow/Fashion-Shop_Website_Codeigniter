<?php $this->load->view('backend/intro/head',$this->data); ?>
<div class="line"></div>
<div id="main_product" class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <div class="title">
            <h6>
                Thông Tin
            </h6>
        </div>
        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
            <thead class="filter">
                <tr>
                    <td colspan="10">
                        <form method="get" action="" class="list_filter form">
                            <table width="80%" cellspacing="0" cellpadding="0">
                                <tbody>
                                </tbody>
                            </table>
                        </form>
                    </td>
                </tr>
            </thead>
            <thead>
                <tr>
                    <td style="width:60px;">Mã số</td>
                    <td>Tiêu đề</td>
                    <td>Tên CTY</td>
                    <td>Phone</td>
                    <td>Email</td>
                    <td>Địa chỉ</td>
                    <td style="width:75px;">Ngày tạo</td>
                    <td style="width:120px;">Hành động</td>
                </tr>
            </thead>
            <tfoot class="auto_check_pages">
            </tfoot>
            <tbody class="list_item">
                <?php foreach ($list as  $item ) { ?>
                <tr class="row_<?php echo $item -> id; ?>">
                    <td class="textC"><?php echo $item -> id; ?></td>
                    <td> <b><?php echo $item->title ?> </b> </td>
                    <td> <b><?php echo $item->name ?> </b> </td>
                    <td> <b><?php echo $item->phone ?> </b> </td>
                    <td> <b><?php echo $item->email ?> </b> </td>
                    <td> <b><?php echo $item->address ?> </b> </td>
                    <td class="textC"> <?php echo  $item->created ?></td>
                    <td class="option textC">
                        
                        <a class="tipS" title="Chỉnh sửa" href="<?php echo admin_url('intro/edit/'. $item->id) ?>">
                        <img src="<?php echo public_url('admin')?>/images/icons/color/edit.png">
                        </a>
                        <a class="tipS verify_action" title="Xóa" href="<?php echo admin_url('intro/delete/'. $item->id) ?>">
                        <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png">
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>