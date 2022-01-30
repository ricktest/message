<?php  $this->section();?>

  <div class="warp">
    <h2>登入</h2>
    <form action="" method="post" class="form">
        <span>帳號</span><input type="text" name="acount" value=""><p></p>
        <?php if(isset($_SESSION['erreo']['acount'])){?>
        <p><?=$_SESSION['erreo']['acount']?></p>
        <?php }?>
        <span>密碼</span><input type="text" name="pwd" ><p></p>
        <?php if(isset($_SESSION['erreo']['pwd'])){?>
        <p><?=$_SESSION['erreo']['pwd']?></p>
        <?php }?>
        <input type="button" value="登入" class="btnlogin">
        <a href="./?c=users&m=register"><input type="button" value="註冊"></a>
    </form>
</div>
<?php 
$this->endSection();
?>


        

