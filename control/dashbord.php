<?php 
    class dashbord extends Control{

        public function __construct()
        {
            $this->userspost=$this->Model('userspost');
        }

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

        public function edit(){
            if(isset($_POST['up_id'])){
                $bool=$this->userspost->set(['up_content'=>$_POST['message']])
                                ->where(['up_us_id'=>$_SESSION['id'],'up_id'=>$_POST['up_id']])
                                ->Update();
                if($bool){
                    echo '<script> alert("修改成功");
                    document.location.href="./?c=dashbord&m=edit";</script>';
                    exit;
                }else{
                    //echo '<script> alert("修改失敗");
                   // document.location.href="./?c=dashbord&m=edit";</script>';
                }
            }
            $arr_posts=$this->userspost->where(['up_us_id'=>$_SESSION['id']])->SelectData();
            $this->view('edit',$arr_posts);
        }
        public function delect(){
            if(isset($_POST['up_id'])){
                $bool=$this->userspost
                                ->where(['up_us_id'=>$_SESSION['id']])
                                ->Delete($_POST['up_id']);
                if($bool){
                    echo '<script> alert("刪除成功");
                    document.location.href="./?c=dashbord&m=delect";</script>';
                    exit;
                }
            }
            $arr_posts=$this->userspost->where(['up_us_id'=>$_SESSION['id']])->SelectData();
            $this->view('delect',$arr_posts);
        }
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