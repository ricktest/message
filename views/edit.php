<?php foreach($data as $k=>$v){?>
<div class="warp warp2">
    <h3>留言內容</h3>
    <form action="./?c=dashbord&m=edit" method="POST">
        <textarea id="w3review" name="message" rows="" cols=""><?=$v['up_content']?></textarea>
        <input type="hidden" name="up_id" value="<?=$v['up_id']?>">
        <input type="submit" value="修改">
        
    </form>
</div>
<?php }?>
