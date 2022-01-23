<?php 
    class dashbord extends Control{

        public function index(){
            
            $this->view('dashboard');
        }

        public function logout(){
            session_destroy();
            header("Location: ./?c=users&m=login"); 
            exit;
        }
    }
?>