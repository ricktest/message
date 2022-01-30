<?php  $this->section();?>
<div class="warp warp3">
<table class="table">
  <thead>
    <tr>
        <th>編號</th>
        <th>帳號</th>
        <th>名字</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $count=1;
  foreach($data as $k=>$v){
      ?>
    <tr>
    <th scope="row"><?=$count++?></th>
    <td ><?=$v['acount']?></td>
   
    <td ><?=$v['name']?></td>
    <td ><a href="./?c=dashbord&m=actionlist&us_id=<?=$v['id']?>">查詢</a></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>
<?php 
$this->endSection();
?>