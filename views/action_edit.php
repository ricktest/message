<?php  $this->section();?>
<div class="warp warp3">
<table class="table">
  <thead>
    <tr>
        <th>編號</th>
        <th>動作</th>
        <th>日期</th>
        <th>內容</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $count=1;
  if(isset($data)){
      $arr_action=array(
          'add'=>'新增',
          'edit'=>'修改',
          'delete'=>'刪除'
      );
    foreach($data as $k=>$v){
      ?>
    <tr>
    <th scope="row"><?=$count++?></th>
    <td ><?= $arr_action[$v['ar_action_type']]?></td>
    <td><?=$v['ar_date']?></td>
    <td><a href="?c=dashbord&m=action_content&ar_id=<?=$v['ar_id']?>">查看</a></td>
    </tr>
    <?php }
  }
    ?>
  </tbody>
</table>
</div>
<?php 
$this->endSection();
?>