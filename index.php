<?php 
 
    $str = addslashes("'Shanghai is the 'biggest' city in China.");
    spl_autoload_register(function($className){
        require_once 'lib/' . $className . '.php';
    });
    session_start();
    $Link_data=array(
        'dashbord'=>'./?c=users&m=login'
    );
 
    if(empty($_SESSION) && array_key_exists($_GET['c'],$Link_data)){
        //print_r($_SESSION);
        header("Location: ./?c=users&m=login"); 
        
        exit;
    }
    require_once './views/head.php';
    $control=$_GET['c'];
    if(file_exists('./control/' . $control . '.php')){
        require_once './control/' . $control . '.php';
        $control=new $_GET['c'];
        $m=$_GET['m'];
        if(method_exists($control,$m)){
            $control->$m();
        }else{
            die('method does not exist');
        }
       
    }else{
        die('Control does not exist');
    }
    require_once './views/foot.php';
   
    

?>