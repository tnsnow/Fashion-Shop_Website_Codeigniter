<?php $this->load->view('backend/sales/head',$this->data); ?>
<div class="line"></div>
<div id="main_transaction" class="wrapper">
    <?php $this->load->view('backend/message',$this->data); ?>
    <div class="widget">
        <div class="title">
            <span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
            <h6>
                Danh sách doanh số thống kê
            </h6>
        </div>
        <table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
            <thead class="filter"><tr><td colspan="15">
                <form method="get" action="" class="list_filter form">
                    <table width="100%" cellspacing="0" cellpadding="0">
                        <tbody>

                            <tr>
                                <td style="width:40px;" class="label"><label for="filter_id">Ngày</label></td>
                                <td class="item">
                                    <select name="day">
                                        <option value=""></option>
                                        <?php for($i=1;$i < 32; $i++): ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php endfor ?>
                                        
                                    </select>
                                </td>

                                <td style="width:40px;" class="label"><label for="filter_id">Tháng</label></td>
                                <td class="item">
                                    <select name="mon">
                                        <option value=""></option>
                                        <?php for($i=1;$i < 13; $i++): ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php endfor ?>
                                        
                                    </select>
                                </td>

                                <td style="width:60px;" class="label"><label for="filter_status">Năm</label></td>
                                <td class="item">
                                    <select name="year">
                                        <option value=""></option>
                                        <?php for($i=2015;$i < 2030; $i++): ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                        <?php endfor ?>
                                        
                                    </select>
                                </td>

                                <td style="width:60px;" class="label"><label for="filter_status">Chính xác</label></td>
                                <td class="item">
                                    <select name="all">
                                        <option value=""></option>
                                        <?php foreach($lists as $vals): ?>
                                        <option value="<?php echo $vals->created ?>"><?php echo $vals->created ?></option>
                                        <?php endforeach ?>
                                        
                                    </select>
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
                    
                    <td style="width:60px;">Mã số</td>
                    <td>Tên người đặt</td>
                    <td>Tổng tiền</td>
                    <td style="width:75px;">Ngày tạo</td>
                    
                </tr>
            </thead>
            <tfoot class="auto_check_pages">
                <tr>
                    <td colspan="18">
                        <!-- <div class="list_action_transaction itemActions">
                            <a url="<?php //admin_url('transaction/deleteAll') ?>" class="button blueB" id="submit" href="#submit">
                            <span style="color:white;">Xóa hết</span>
                            </a>
                        </div> -->

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
                <?php if(isset($list) && !empty($list)): ?>
                    <?php $sum = 0 ?>
                <?php foreach ($list as  $item ) { ?>
                <tr class="row_<?php echo $item -> id; ?>">
                    <td class="textC"><?php echo $item ->id; ?></td>
                    <td class="textC"><?php echo $item ->user_name; ?></td>
                    <td class="textC"><?php echo number_format($item ->amount).'đ'; ?></td>
                   
                    
                    <td class="textC"> <?php echo  $item->created ?></td>
                    

                </tr>

                <?php $sum = $sum + $item ->amount ?>
                
                <?php } ?>
                <tr>
                    <td colspan="3" rowspan="" headers="" style="text-align: center;"> Tổng Tiền</td>
                    <<td><?php echo number_format($sum)."đ"; ?></td>
                </tr>
            <?php endif ?>
            </tbody>
        </table>
    </div>
</div>