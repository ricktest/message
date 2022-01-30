<?php  $this->section();?>
<div class="warp message"  >
    <span class="message_name">內容:</span>
    <?php if(count($data)==2){?>
    <div class="message_content">
        修改後:<?=htmlentities($data[0]['cr_content'])?>
    </div>
    <div class="message_content">
        修改前:<?=htmlentities($data[1]['cr_content'])?>
    </div>
    <?php }else{?>
    <div class="message_content">
        <?=htmlentities($data[0]['cr_content'])?>
    </div>
    <?php }?>
</div>
<?php 
$this->endSection();
?>