<?php  $this->section();?>
<div class="warp">
    <h2>註冊</h2>
    <form action="./?c=users&m=registerpro" method="post">
        <span>名字</span><input type="text" name="name" value=""><p>
        <?php if(isset($_SESSION['erreo']['name'])){?>
        <?=$_SESSION['erreo']['name']?>
        <?php }?></p>
        <span>帳號</span><input type="text" name="acount" value="">
        
        <p>
        <?php 
        if(isset($_SESSION['erreo']['acount'])){
            echo $_SESSION['erreo']['acount'];
        }
        ?>

        </p>
        
        <span>密碼</span><input type="text" name="pwd"><p>
        <?php 
        if(isset($_SESSION['erreo']['pwd'])){
            echo $_SESSION['erreo']['pwd'];
        }
        ?>
        </p>
        <input type="submit" value="註冊">
        <a href="./?c=users&m=login"><input type="button" value="登入"></a>
        <p>
        <?php 
        if(isset($_SESSION['erreo']['重複'])){
            echo $_SESSION['erreo']['重複'];
        }
        ?>
        </p>
    </form>
    </div>
    <?php 
$this->endSection();

?>