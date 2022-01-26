<script>
$(function(){ 
    
    function submitLoin(){
        $.ajax({
            type: "POST",
            url: './?c=users&m=loginprogess',
            data : $( '#logintForm').serialize(), 
            success: function (response) {
              //alert(response);
              var obj = jQuery.parseJSON(response);
              
              if(obj.msg==undefined){
                alert("登入成功");
                document.location.href=obj.link;
              }else{
                alert(obj.msg);
              }
             
             
             
            },
            error: function (thrownError) {
            console.log(thrownError);
            }
        });
    }
        $( "#lognbtn" ).click(function() {
            submitLoin();
        });
}); 
</script>
  <div class="warp">
    <h2>登入</h2>
    <form action="" method="post" id="logintForm">
        <span>帳號</span><input type="text" name="acount" value=""><p></p>
        <?php if(isset($_SESSION['erreo']['acount'])){?>
        <p><?=$_SESSION['erreo']['acount']?></p>
        <?php }?>
        <span>密碼</span><input type="text" name="pwd" ><p></p>
        <?php if(isset($_SESSION['erreo']['pwd'])){?>
        <p><?=$_SESSION['erreo']['pwd']?></p>
        <?php }?>
        <input type="button" value="登入" id="lognbtn">
        <a href="./?c=users&m=register"><input type="button" value="註冊"></a>
    </form>
</div>
        

