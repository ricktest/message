<?php

    Class user{

        private $db;

        function __construct(){
            $this->db=new database;
        }

        function SelectSingleUser($data){
            $data['pwd']= $this->db->replacedata($data['pwd']);
            $data['acount']= $this->db->replacedata($data['acount']);
            $sql="select `name` from `users` where `acount`="."'".$data['acount']."' AND `pwd`='".$data['pwd']."'";
           
            $Users=$this->db->sqlquery($sql);
            return mysqli_fetch_assoc($Users);
        }

        function SelectSingleacount($data){
            $data['acount']= $this->db->replacedata($data['acount']);
            $sql='select `name` from `users` where `acount`="'.$data['acount'].'"';
            $Users=$this->db->sqlquery($sql);
            return mysqli_fetch_assoc($Users);
        }

        function InsertUser($table,$data){

            $Users=$this->db->insertdata($table,$data);
            return $Users;
        }
    }

?>