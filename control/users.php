<?php
 class users extends  Control{
    private $usermodel;

    public function __construct()
    {
        $this->usermodel=$this->Model('user');
        $this->Login_record=$this->Model('Login_record');
      
    }

    public function login($data=array())
    {
       
        $this->view('login',$data);
       
    }

    public function CheckData($data){

        $fun=new fun();
        $fun->run($data,true);
        $erreo=$fun->geterreos();
        if(isset($erreo)){
            $msg['msg']=$erreo;
            echo json_encode($msg);
            return true;
        }

    }

    public function loginprogess(){
        
        $data=[
            'acount'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'請輸入帳號',
                    ]
            ],
            'pwd'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'請輸入密碼',
                    ]
            ]
        ];

        if($this->CheckData($data)){
            return;
        }
  
        if($this->CheckLoginUser()){      
            $msg['link']='./?c=dashbord&m=index';
            $msg['msg']='登入成功';
            echo json_encode($msg);
            $data_record['login_status']='Y001';
            $data_record['login_acount']=$_POST['acount'];
            $data_record['login_pwd']=$_POST['pwd'];
            $data_record['login_date']=date('Y-m-d H:i:s');
            $this->Login_record->Create($data_record);
            return ;
        }

        $msg['msg']='帳號密碼錯誤';
        echo json_encode($msg);
        $data_record['login_status']='Y002';
        $data_record['login_acount']=$_POST['acount'];
        $data_record['login_pwd']=$_POST['pwd'];
        $data_record['login_date']=date('Y-m-d H:i:s');
        $this->Login_record->Create($data_record);
        return ;
        
    }

    public function CheckLoginUser(){

        $data2['acount']=$_POST['acount'];
        $data2['pwd']=$_POST['pwd'];
        $users=$this->usermodel->where($data2)->SelectData();
        if(isset($users)){  
            $_SESSION=$users[0];
            return true;
        }
        return false;
    }
    public function CheckAcount(){
        $sql_data['acount']=$_POST['acount'];
        $users=$this->usermodel->where($sql_data)->SelectData();
        if(isset($users)){
            $msg['msg']='帳號重複請重新輸入';
            echo json_encode($msg);
            return true;
        }
        return false;
    }
    public function register(){
        
        $this->view('register');
    }
    public function registerpro(){
        
        $data=[
            'name'=>['rules'=>'required|max[20]',
                    'errors'=>[
                        'required'=>'請輸入名字',
                        'max'=>'超過最大值20'
                    ]
                ],
            'acount'=>[
                    'rules'=>'required|max[20]',
                    'errors'=>[
                        'required'=>'請輸入帳號',
                        'max'=>'超過最大值20'
                    ]
            ],
            'pwd'=>[
                    'rules'=>'required|max[20]',
                    'errors'=>[
                        'required'=>'請輸入密碼',
                        'max'=>'超過最大值20'
                    ]
            ]
        ];

        if($this->CheckData($data)){
            return;
        }

        if($this->CheckAcount()){
            return ;
        }

        $sql_data['name']=$_POST['name'];
        $sql_data['acount']=$_POST['acount'];
        $sql_data['pwd']=$_POST['pwd'];
        $sql_data['level']='2';
        $boo=$this->usermodel->Create($sql_data);
        if($boo){
            $msg['msg']='註冊成功';
            $msg['link']='./?c=users&m=login';
            echo json_encode($msg);
            return ;
        }
            $msg['msg']='註冊失敗';
            echo json_encode($msg);
            return ;
    }
}

?>
