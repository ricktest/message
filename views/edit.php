<?php  $this->section();?>
<?php 
if(isset($data)){
foreach($data as $k=>$v){?>
<div class="warp warp2">
    <h3>編輯留言</h3>
    <form  class="form">
        <textarea id="w3review" name="message" rows="" cols=""><?=$v['up_content']?></textarea>
        <input type="hidden" name="up_id" value="<?=$v['up_id']?>">
        <input type="hidden" name="c" value="dashbord">
        <input type="hidden" name="m" value="edit">
        <input type="button" value="修改" class="btn_content" >
    </form>
</div>
<?php }
}
?>
<?php 
$this->endSection();
?>