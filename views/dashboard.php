<?php foreach($data as $k=>$v){?>
<div class="warp message">
    <p class="message_name"><?=$v['name']?>:</p>
    <div class="message_content">
        <?=htmlentities($v['up_content'])?>
    </div>
    <div class="date">
    <?=$v['up_date']?>
    </div>
</div>
<?php }?>
