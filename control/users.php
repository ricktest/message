<?php
 class users extends  Control{
    private $usermodel;
    public function __construct()
    {
        $this->usermodel=$this->Model('user');
      
    }

    public function login($data=array())
    {
        
       
        $this->view('login',$data);
    }
    public function loginprogess(){

        $data['erreo']['acount']='';
        $data['erreo']['pwd']='';

        if(empty($_POST['acount'])){
            $data['erreo']['acount']='請輸入帳號';
        }else if(empty($_POST['pwd'])){
            $data['erreo']['pwd']='請輸入密碼';
        }else{
           // $data=$_POST;
            $data2['acount']=$_POST['acount'];
            $data2['pwd']=$_POST['pwd'];
            $users=$this->usermodel->SelectSingleUser($data2);
            if(isset($users)){      
                $_SESSION=$users;
               echo '<script> alert("登入成功");
               document.location.href="./?c=dashbord&m=index";</script>';
            }else{
                echo '<script> alert("帳號密碼錯誤");document.location.href="./?c=users&m=login";</script>';
            }
        }
        $this->view('login',$data);
    }
    public function register(){
        
        $this->view('register');
    }
    public function registerpro(){
        
        if(empty($_POST['name'])){
            echo '<script> alert("請輸入名字");</script>';
        }else if(empty($_POST['acount'])){
            echo '<script> alert("請輸入帳號");</script>';
        }else if(strlen($_POST['acount'])>10){
            echo '<script> alert("帳號不得超過10個字");</script>';
        }else if(empty($_POST['pwd'])){
            echo '<script> alert("請輸入密碼");</script>';
        }else if(strlen($_POST['pwd'])>20){
            echo '<script> alert("密碼不得超過20個字");</script>';
        }else{
            $data['acount']=$_POST['acount'];
            $users=$this->usermodel->SelectSingleacount($data);
           // print_r($users);
            if(isset($users)){
                echo '<script> alert("帳號重複請重新輸入");</script>';
            }else{
                $data=$_POST;
                //$sql='INSERT INTO `users` (`name`, `acount`, `pwd`) VALUES ("'.$_POST['name'].'", "'.$_POST['acount'].'", "'.$_POST['pwd'].'")';
                //print_r($data);
                $users=$this->usermodel->InsertUser('users',$data);
                if(!$users){
                    echo '<script> alert("註冊失敗");</script>';
                }else{
                   echo '<script> alert("註冊成功");
                   document.location.href="./?c=users&m=login";</script>';
                }
            }
        }
        $this->view('register');
        //print_r($data);
    }
}

?>
