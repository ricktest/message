<?php 
    class dashbord extends Control{

        public function __construct()
        {
            $this->userspost=$this->Model('userspost');
            $this->action_record=$this->Model('action_record');
            $this->content_record=$this->Model('content_record');
            $this->Login_record=$this->Model('Login_record');
            $this->usermodel=$this->Model('user');
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
        /*編輯留言版*/
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
                $fun->run($data,TRUE);
                $erreo=$fun->geterreos();
        
                if(isset($erreo)){
                    $msg['msg']=$erreo;
                    echo json_encode($msg);
                    return;
                }

                $sql_where['up_us_id']=$_SESSION['id'];
                $sql_where['up_id']=$_POST['up_id'];
                $arr_posts=$this->userspost->where($sql_where)->SelectData();
                

                $sql_where=[];
                $sql_where['up_us_id']=$_SESSION['id'];
                $sql_where['up_id']=$_POST['up_id'];
                $bool=$this->userspost->set(['up_content'=>$_POST['message'],'up_updatetime'=>date('Y-m-d H:i')])
                                ->where($sql_where)
                                ->Update();

                if($bool){
                    $msg['msg']='修改成功';
                    $msg['link']='./?c=dashbord&m=index';
                    echo json_encode($msg);
                    
                    $action['ar_us_id']=$_SESSION['id'];
                    $action['ar_action_type']='edit';
                    $action['ar_date']=date('Y-m-d H:i:s');
                    $this->action_record->Create($action);

                    $content['cr_content']=$arr_posts[0]['up_content']; 
                    $content['cr_date']=date('Y-m-d H:i:s');
                    $content['cr_ar_id']=$this->action_record->GetMaxId('ar_id'); 
                    $this->content_record->Create($content);
                    $content['cr_content']=$_POST['message'];
                    $this->content_record->Create($content);
                    return;
                }
            }

            if(isset($_GET['up_id'])){
                $sql_where['up_us_id']=$_SESSION['id'];
                $sql_where['up_id']=$_GET['up_id'];
                $arr_posts=$this->userspost->where($sql_where)->SelectData();
                $this->view('edit',$arr_posts);
            }
           
        }
        /*刪除留言板*/
        public function delect(){

            if(isset($_POST['up_id'])){
                $sql_where=[];
                if($_SESSION['level']!='1'){
                    $sql_where['up_us_id']=$_SESSION['id'];
                   
                }
                $post=$this->userspost
                                ->where(['up_us_id'=>$_SESSION['id'],'up_id'=>$_POST['up_id']])
                                ->SelectData();

                $bool=$this->userspost
                                ->where($sql_where)
                                ->Delete($_POST['up_id']);
                if($bool){
                    $msg['msg']='刪除成功';
                    $msg['link']='./?c=dashbord&m=index';
                    echo json_encode($msg);

                    $action['ar_us_id']=$_SESSION['id'];
                    $action['ar_action_type']='delete';
                    $action['ar_date']=date('Y-m-d H:i:s');
                    $this->action_record->Create($action);

                    $content['cr_content']=$post[0]['up_content'];
                    $content['cr_date']=date('Y-m-d H:i:s');
                    $content['cr_ar_id']=$this->action_record->GetMaxId('ar_id'); 
                    $this->content_record->Create($content);
                    return;
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
                    $msg['msg']='留言成功';
                    $msg['link']='./?c=dashbord&m=index';
                    echo json_encode($msg);

                    $action['ar_us_id']=$_SESSION['id'];
                    $action['ar_action_type']='add';
                    $action['ar_date']=date('Y-m-d H:i:s');
                    $this->action_record->Create($action);

                   
                    $content['cr_content']=$data['up_content']; 
                    $content['cr_date']=date('Y-m-d H:i:s');
                    $content['cr_ar_id']=$this->action_record->GetMaxId('ar_id'); 
                    $this->content_record->Create($content);

                    return;
                }
                $msg['msg']='留言失敗';
                echo json_encode($msg);
                return;
            }
            $this->view('message');
            
        }
        public function action_content(){
            if(isset($_GET['ar_id'])){
                $content=$this->content_record->where(['cr_ar_id'=>$_GET['ar_id']])
                                        ->DESC('cr_id')
                                        ->SelectData();
                $arr_content=array();
                foreach($content as $k=>$v){
                    $arr_content[]=$v;
                }
                //print_r($arr_content);
                $this->view('action_content',$arr_content);

            }
        }
        public function actionlist(){
            if(isset($_GET['us_id'])){
                $data=$this->action_record->where(['ar_us_id'=>$_GET['us_id']])
                                    ->DESC('ar_id')
                                    ->SelectData();
                $this->view('action_edit',$data);
                return;
            }
            $this->view('action_edit');
        }

        public function action(){
            $user=$this->usermodel
                        ->where(['level'=>'2'])
                        ->SelectData();
            $this->view('action',$user);
        }

        public function login_record(){
            $record=$this->Login_record->SelectData();
            $this->view('login_record',$record);
        }

        public function logout(){
            session_destroy();
            header("Location: ./?c=users&m=login"); 
            exit;
        }

        private function CheckData($data){

            if($data['message']==''){
                $msg['msg']='內容不得為空';
                echo json_encode($msg);
                exit;
            }

        }
    }
?>