
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .content{
            width:100%;
        }
        .login{
            width:50%;
            text-align:center;
            line-height:10px;
            margin: auto;
           
        }
        .warp{
            border:1px black solid;
            letter-spacing: 5px;
            padding-bottom:50px;
            margin-top:100px;
           
        }
        
        .login .message{
            border:2px red solid;
            text-align:left;
            padding: 10px;
            margin-top:50px;
        }
        .message_name{
            text-align:left;
            color:black;
           
        }
        .button{
            float:right;
            
        }
        .message_content{
          
            width:100%;
            display:block;
            text-align: justify;
            text-justify:inter-ideograph;
            line-height:25px;
            word-break: break-all;
            padding-top:5px;
            padding-bottom:10px;
           
        }

        p{
            color:red;
           
        }
       
        
        .tour{
            width:50%;
            margin: auto;
            
        }
        .tour div{
            display:inline;
            letter-spacing: 2px;
            margin-right:20px;
            float:right;
        }
        .date{
            display:inline;
            font-size:5px;
            line-height:20px; 
            float:right;
            
        }
        .left{
            float:left;
            
        }
        .warp2{
            text-align:left;
            border:0px white solid;
        } 
        #w3review{
            font-size: 16px;
            line-height: 1.5;
            letter-spacing: 1px;
            width:80%;
            height:250px;
            display:block;  
            margin-bottom:10px;
        }
        .clear{
            clear:both;
        }
    </style>
    <script src="./js/jquery-3.6.0.js"></script>
</head>
<body>
<div class="content">
    <?php if(isset($_SESSION['id']) && isset($_GET['c']) && $_GET['c']=='dashbord'){?>
       
    <div class="tour">
        <h2><?=$_SESSION['name']?>你好~</h2>
        <div><a href="./?c=dashbord&m=logout">登出</a></div>
        <div><a href="./?c=dashbord&m=message">我要留言</a></div>
        <div><a href="./?c=dashbord&m=index">留言區</a></div>
    </div>
    <?php }?>
    <div class="clear" ></div>
<div class="login">
   <?php $this->renderSection(); ?>
</div>
</div>
</body>
</html>


