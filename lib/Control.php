<?php 
class Control{

    function Model($model){
        require_once './models/' . $model . '.php';
        return new $model();
    }

    public  function View($view , $data=array()){
        if(file_exists('./views/' . $view . '.php')){
            require_once './views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }

}
?>
