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
        $fun=new fun();
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
        $fun->run($data,true);
        $erreo=$fun->geterreos();
        //print_r($erreo);
        if(isset($erreo)){
            $msg['msg']=$erreo;
            echo json_encode($msg);
            return ;
        }

        if(empty($erreo) && isset($_POST)){
            $data2['acount']=$_POST['acount'];
            $data2['pwd']=$_POST['pwd'];
            $users=$this->usermodel->where($data2)->SelectData();
            if(isset($users)){      
                $_SESSION=$users[0];
                $msg['link']='./?c=dashbord&m=index';
                echo json_encode($msg);
                return ;
                //$this->redirect('./?c=dashbord&m=index','登入成功');
            }else{
                $msg['msg']='帳號密碼錯誤';
                echo json_encode($msg);
                return ;
                //$this->redirect('./?c=users&m=login','帳號密碼錯誤');
            }
        }
    }
    public function register(){
        
        $this->view('register');
    }
    public function registerpro(){
        
        $fun=new fun();
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
        $fun->run($data);
        $erreo=$fun->geterreos();

        if(isset($erreo)){
            $_SESSION['erreo']=$erreo;
            $this->redirect('./?c=users&m=register');
        }

        if(empty($erreo) && isset($_POST)){
            $sql_data['acount']=$_POST['acount'];
            $users=$this->usermodel->where($sql_data)->SelectData();
            
            if(isset($users)){
                $_SESSION['erreo']['重複']='帳號重複請重新輸入';
                $this->redirect('./?c=users&m=register');
            }else{
                $sql_data['name']=$_POST['name'];
                $sql_data['acount']=$_POST['acount'];
                $sql_data['pwd']=$_POST['pwd'];
                
                if($this->usermodel->Create($sql_data)){
                    $this->redirect('./?c=users&m=login','註冊成功');
                }else{
                    $this->redirect('./?c=users&m=register','註冊失敗');
                }
                
            }
        }
    }
}

?>
