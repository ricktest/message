<?php 
    date_default_timezone_set("Asia/Taipei");
    spl_autoload_register(function($className){
        require_once 'lib/' . $className . '.php';

    });
    session_start();
    $Link_data=array(
        'dashbord'=>'./?c=users&m=login'
    );
    if(empty($_GET['c'])){
        header("Location: ./?c=users&m=login"); 
        exit;
    }
    if(empty($_SESSION) && array_key_exists($_GET['c'],$Link_data)){
       
        header("Location: ./?c=users&m=login"); 
        
        exit;
    }
    
    
    $control=$_GET['c'];
    if(file_exists('./control/' . $control . '.php')){
        
        require_once './control/' . $control . '.php';
        $control=new $_GET['c'];
        $m='';
        if(isset($_GET['m'])){
            $m=$_GET['m'];
        }

        if(method_exists($control,$m)){
            $control->$m();
        }else{
            die('method does not exist');
        }

    }else{
        die('Control does not exist');
    }
   
   
    

?>