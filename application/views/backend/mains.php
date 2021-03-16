<html>
    <head>
        <?php $this ->load->view('backend/heads');?>
    </head>
    <bpdy>
        
        <div id="rightSide">
           
<!--            content-->
                <?php $this->load->view($temp,$this->data); ?>
<!--            end content-->
            
        </div>
        <div class="clear"></div>


    </bpdy>
</html>