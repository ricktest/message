<?php  $this->section();?>
<?php foreach($data as $k=>$v){?>
<div class="warp message">
    <span class="message_name"><?=$v['name']?>:</span>
    <div class="button">
        <?php if($v['id']==$_SESSION['id'] || $_SESSION['acount']=='root' ){?>
            <a href="./?c=dashbord&m=edit&up_id=<?=$v['up_id']?>" ><input type="submit" value="編輯"></a>
            <a href="./?c=dashbord&m=delect&up_id=<?=$v['up_id']?>" ><input type="submit" value="刪除"></a>
        <?php }?>
    </div>
    <div class="clear"></div>
    <div class="message_content">
        <?=htmlentities($v['up_content'])?>
    </div>
    <div class="date left">
        <?php 
            if($v['up_updatetime']!=''){
                echo '修改時間:'.$v['up_updatetime'];
            }
        ?>
        
    </div>
    <div class="date">
        
        <?=$v['up_date']?>
    </div>
    <div class="clear"></div> 
</div>
<?php }?>
<?php 
$this->endSection();
?>
