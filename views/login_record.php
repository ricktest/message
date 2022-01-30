<?php  $this->section();?>
<style>
    th{
        color:black;
        font-size:12px;
    }
    .warp3{
        border:0px white solid;
    }
    td{
        font-size:12px;
    }
</style>
<div class="warp warp3">
<table class="table">
  <thead>
    <tr>
        <th>編號</th>
        <th>帳號</th>
        <th>密碼</th>
        <th>狀態</th>
        <th>時間</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $count=1;
  $arr_status=array(
        'Y001'=>'登入成功',
        'Y002'=>'登入失敗'
  );
  foreach($data as $k=>$v){
    $date=date_create($v['login_date']);
      ?>
    <tr>
      <th scope="row"><?=$count++?></th>
      <td ><?=$v['login_acount']?></td>
    <td ><?=$v['login_pwd']?></td>
    <td ><?=$arr_status[$v['login_status']]?></td>
    <td ><?=date_format($date,'Y-m-d H:i')?></td>
    </tr>
    <?php }?>
  </tbody>
</table>
</div>
<?php 
$this->endSection();
?>