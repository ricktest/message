  <div class="warp">
    <h2>登入</h2>
    <form action="./?c=users&m=loginprogess" method="post">
        <span>帳號</span><input type="text" name="acount" value=""><p></p>
        <?php if(isset($data['erreo']['acount'])){?>
        <p><?=$data['erreo']['acount']?></p>
        <?php }?>
        <span>密碼</span><input type="text" name="pwd" ><p></p>
        <?php if(isset($data['erreo']['pwd'])){?>
        <p><?=$data['erreo']['pwd']?></p>
        <?php }?>
        <input type="submit" value="登入">
        <a href="./?c=users&m=register"><input type="button" value="註冊"></a>
    </form>
</div>
        

