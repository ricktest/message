<?php  $this->section();?>
<?php 
if(isset($data)){?>
<?php foreach($data as $k=>$v){?>
<form class="form<?=$v['up_id']?>">
<div class="warp message" style="<?=$v['level']=='1'?'border:2px red solid;':''?>" >
    <span class="message_name"><?=$v['name']?>:</span>
    <div class="button">
        <?php if( ($v['id']==$_SESSION['id'] && $_SESSION['level']=='2') ){?>

            <a href="./?c=dashbord&m=edit&up_id=<?=$v['up_id']?>" ><input type="button" value="編輯"></a>

            <input type="button" value="刪除" class="btn_delete" name="<?=$v['up_id']?>" >
         <?php }?>
         <?php if($_SESSION['level']=='1'){?>
            <?php if( ($v['id']==$_SESSION['id'] && $_SESSION['level']=='1') ){?>
                <a href="./?c=dashbord&m=edit&up_id=<?=$v['up_id']?>" ><input type="button" value="編輯"></a>
            <?php }?>
            <input type="button" value="刪除" class="btn_delete" name="<?=$v['up_id']?>" >
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
<input type="hidden" name="up_id" value="<?=$v['up_id']?>">
</form>
<?php }?>
<?php }?>
<?php 
$this->endSection();
?>
