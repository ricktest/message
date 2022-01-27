<?php 
class Control{
    private $contents;
    function Model($model){
        require_once './models/' . $model . '.php';
        return new $model();
    }

    public function section()
    {
        ob_start();
    }

    public function endSection()
    {
        $this->contents =ob_get_clean();

    }

    public function renderSection()
    {
        echo $this->contents;
    }

    public  function View($view , $data=array()){
       
        if(file_exists('./views/' . $view . '.php')){
            require_once './views/' . $view . '.php';
            unset($_SESSION['erreo']);
        } else {
            die('View does not exist');
        }
        require_once './views/head.php';
        

    }
    public  function redirect($lik,$msg=''){
        $str='<script>';
        if($msg){
            $str.='alert("'.$msg.'");';
        }
        $str.='document.location.href="'.$lik.'";</script>';
        echo $str;
        exit;
    }
}
?>
