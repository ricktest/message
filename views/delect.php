<?php foreach($data as $k=>$v){?>
<div class="warp warp2">
    <h3>留言內容</h3>
    <form class="form">
        <textarea id="w3review" name="message" rows="" cols=""><?=$v['up_content']?></textarea>
        <input type="hidden" name="up_id" value="<?=$v['up_id']?>">
        <input type="button" value="刪除" class="btn">
        <input type="hidden" name="c" value="dashbord">
        <input type="hidden" name="m" value="delect">
    
    </form>
</div>
<?php }?>
