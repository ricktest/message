<?php

    class database{

        private $con;

        function __construct(){
            $this->con=new mysqli("localhost","root","","test");
            if(!$this->con){
                die("連線錯誤: " . mysqli_connect_error());
            }
            $this->con->query("SET NAMES utf8");
        }

        function replacedata($data){
           return  mysqli_real_escape_string($this->con,$data);
        }

        function sqlquery($sql,$debug=false){
            
           // echo $sql;
            //$sql=$this->replacesql($sql);
            if($debug){
                echo $sql.'</br>';
            }
            
            return  mysqli_query($this->con,$sql);  
        }

        function insertdata($table,$data,$debug=false){
            $sql="INSERT INTO `".$table."` (`".implode('`,`', array_keys($data))."`) VALUES ('".implode("','", $data)."')";
            $sql=$this->replacesql($sql);
            if($debug){
                echo $sql.'</br>';
            }

            return  mysqli_query($this->con,$sql);  
        }

        function replacesql($sql){
            $words = addslashes($sql);
            $words = str_replace("_","\_",$sql);
            $words = str_replace("%","\%",$sql);
            return $words;
        }
    }
    
?>