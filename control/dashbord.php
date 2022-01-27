<?php 
    class dashbord extends Control{

        public function __construct()
        {
            $this->userspost=$this->Model('userspost');
        }
        /*留言板*/
        public function index(){
        
            $arr_posts=$this->userspost->leftjoin([
                'left'=>'users',
                'ON'=>[
                    'users_post'=>'up_us_id',
                    'users'=>'id'
                ]
            ]);

            $this->view('dashboard',$arr_posts);
        }
        /*邊及留言版*/
        public function edit(){

            if(isset($_POST['up_id'])){
                $fun=new fun();
                $data=[
                    'message'=>['rules'=>'required|max[2000]',
                            'errors'=>[
                                'required'=>'請輸入內容',
                                'max'=>'超過最大值2000'
                            ]
                        ],
                ];
                $fun->run($data);
                $erreo=$fun->geterreos();
        
                if(isset($erreo)){
                    $this->redirect('./?c=dashbord&m=edit&up_id='.$_POST['up_id'],$erreo['message']);
                }

                $sql_where=[];
                
                if($_SESSION['acount']!='root'){
                    $sql_where['up_us_id']=$_SESSION['id'];
                }
                $sql_where['up_id']=$_POST['up_id'];
                $bool=$this->userspost->set(['up_content'=>$_POST['message'],'up_updatetime'=>date('Y-m-d H:i')])
                                ->where($sql_where)
                                ->Update();
                if($bool){
                    echo '<script> alert("修改成功");
                    document.location.href="./?c=dashbord&m=index";</script>';
                    exit;
                }
            }

            if(isset($_GET['up_id'])){
                if($_SESSION['acount']!='root'){
                    $sql_where['up_us_id']=$_SESSION['id'];
                }
                $sql_where['up_id']=$_GET['up_id'];
                $arr_posts=$this->userspost->where($sql_where)->SelectData();
                $this->view('edit',$arr_posts);
            }
           
        }
        /*刪除留言板*/
        public function delect(){

            if(isset($_GET['up_id'])){

                
                $sql_where=[];
                if($_SESSION['acount']!='root'){
                    $sql_where['up_us_id']=$_SESSION['id'];
                }
                
                $bool=$this->userspost
                                ->where($sql_where)
                                ->Delete($_GET['up_id']);
                if($bool){
                    echo '<script> alert("刪除成功");
                    document.location.href="./?c=dashbord&m=index";</script>';
                    exit;
                }
            }

        }
        /*新增留言*/
        public function message(){
           
            if(isset($_POST['message'])){
                $this->CheckData($_POST);
                $data['up_content']=$_POST['message'];
                $data['up_us_id']=$_SESSION['id'];
                $data['up_date']=date('Y-m-d H:i');
                
               if($this->userspost->Create($data)){
                    echo '<script> alert("留言成功");
                    document.location.href="./?c=dashbord&m=index";</script>';
                    exit;
                }
                echo '<script> alert("留言失敗");</script>';
            }
            $this->view('message');
            
        }


        public function logout(){
            session_destroy();
            header("Location: ./?c=users&m=login"); 
            exit;
        }

        private function CheckData($data){

            if($data['message']==''){
                echo '<script> alert("請輸入留言內容");
                    document.location.href="./?c=dashbord&m=message";</script>';
                    exit;
            }

        }
    }
?>