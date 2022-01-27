<?php  $this->section();?>
<div class="warp warp2">
    <h3>留言內容</h3>
    <form action="./?c=dashbord&m=message" method="POST">
        <textarea id="w3review" name="message" rows="" cols=""></textarea>
        <input type="submit" value="送出">
    </form>
</div>
<?php 
$this->endSection();
?>